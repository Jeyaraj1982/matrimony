<?php
    class Franchisee {
        
        function GetMyProfile() {                                                          
            
            global $mysql,$loginInfo;  
            $franchiseedata = $mysql->select("select * from `_tbl_franchisees_staffs` where `PersonID`='".$loginInfo[0]['FranchiseeStaffID']."'");
          
            if (sizeof($franchiseedata)>0) {
                return Response::returnSuccess("success",$franchiseedata[0]);
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
        }
        
        function Login() {
            
            global $mysql,$j2japplication;  
        
            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter login name ");
            }
            
            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }
        
            $data=$mysql->select("select * from `_tbl_franchisees_staffs` where `LoginName`='".$_POST['UserName']."' and `LoginPassword`='".$_POST['Password']."'") ;
            $fdata=$mysql->select("select * from `_tbl_franchisees` where `FranchiseeID`='".$data[0]['FranchiseeID']."'");
            
            if (sizeof($data)>0) {
                $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
                $loginid = $mysql->insert("_tbl_logs_logins",array("LoginOn"             => date("Y-m-d H:i:s"),
                                                                 "LoginFrom"          => "Web",
                                                                 "Device"             => $clientinfo['Device'],
                                                                 "FranchiseeID"       => $data[0]['FranchiseeID'],
                                                                 "FranchiseeStaffID"  => $data[0]['PersonID'],
                                                                 "LoginName"          => $_POST['UserName'],
                                                                 "BrowserIP"          => $clientinfo['query'],
                                                                 "CountryName"        => $clientinfo['country'],
                                                                 "BrowserName"        => $clientinfo['UserAgent'],
                                                                 "APIResponse"        => json_encode($clientinfo),
                                                                 "LoginPassword"      => $_POST['Password']));
                $data[0]['LoginID']=$loginid;
                
                if ($data[0]['IsActive']==1) {
                    return Response::returnSuccess("success"."select * from `_tbl_franchisees` where `FranchiseeID`='".$data[0]['FranchiseeID']."'",array("UserDetails"=>$data[0],"FranchiseeDetails"=>$fdata[0]));
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
                
            } else {
                return Response::returnError("Invalid login name and password");
            }
        }
        
        function GetMemberCode(){
            return Response::returnSuccess("success",array("MemberCode" => SeqMaster::GetNextMemberNumber(),
                                                           "Gender"     => CodeMaster::getData('SEX')));
        }
        
        function CreateMember() {
                                                                            
        global $mysql,$loginInfo;  
        
        $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
       
        $data = $mysql->select("select * from _tbl_members where  MemberCode='".$_POST['MemberCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("MemberCode Already Exists");
        }
        $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_MOBILE'");
             if ($allowDuplicateMobile[0]['ParamA']==0) {
                $data = $mysql->select("select * from _tbl_members where  MobileNumber='".$_POST['MobileNumber']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("MobileNumber Already Exists");
                }
             }
        if (strlen(trim($_POST['WhatsappNumber']))>0) {
         $allowDuplicateWhatsapp = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_WHATSAPP'");
             if ($allowDuplicateWhatsapp[0]['ParamA']==0) {
                $data = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
                    if (sizeof($data)>0) {
                        return Response::returnError("WhatsappNumber Already Exists");
                    }
             }
        }
        $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_EMAIL'");
             if ($allowDuplicateEmail[0]['ParamA']==0) {
                $data = $mysql->select("select * from _tbl_members where  EmailID='".$_POST['EmailID']."'");
                 if (sizeof($data)>0) {
                     return Response::returnError("EmailID Already Exists");
                 }
             }
        
        if (!(strlen(trim($_POST['MemberName']))>0)) {
            return Response::returnError("Please enter your name");
        }
       if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return Response::returnError("Please enter your MobileNumber");
        }
        if (!(strlen(trim($_POST['EmailID']))>0)) {
            return Response::returnError("Please enter your email");
        }
        if (!(strlen(trim($_POST['LoginPassword']))>0)) {                                                 
            return Response::returnError("Please enter MemberPassword");    
        }
        
        $plan =  $mysql->select("select * from _tbl_member_plan where IsActive='1'");
             if(sizeof($plan)==0) {
                return Response::returnError("Sorry, something went wrong"); 
             }
        $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
         $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
         $MemberCode   = SeqMaster::GetNextMemberNumber();
		 $Sex = CodeMaster::getData("SEX",$_POST['Sex']);
		 
       $id =  $mysql->insert("_tbl_members",array("MemberCode"              => $MemberCode,
                                                  "MemberName"               => $_POST['MemberName'],  
                                                  "DateofBirth"              => $dob,
                                                  "SexCode"                  => $_POST['Sex'],
                                                  "Sex"                      => $Sex[0]['CodeValue'],
                                                  "CountryCode"             => $_POST['CountryCode'],
                                                  "MobileNumber"             => $_POST['MobileNumber'],
                                                  "WhatsappCountryCode"           => $_POST['WhatsappCountryCode'],
                                                  "WhatsappNumber"           => $_POST['WhatsappNumber'],
                                                  "EmailID"                  => $_POST['EmailID'],
                                                  "CreatedOn"                => date("Y-m-d H:i:s"),
                                                  "ReferedBy"                => $loginInfo[0]['FranchiseeID'],
                                                  "CreatedBy"                => "Franchisee",
												  "ChangePasswordFstLogin"   => (($_POST['PasswordFstLogin']=="on") ? '1' : '0'),
                                                  "MemberPassword"           => $_POST['LoginPassword']));
                                                  
       $Plan = $mysql->select("select * from _tbl_member_plan where IsDefault='1'");                                          
                                                       
             $date = date_create(date("Y-m-d"));                    
                $e = $Plan[0]['Decreation']. " days";                
                date_add($date,date_interval_create_from_date_string($e));
                $endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
                $endingdate= date_format($date,"Y-m-d");
                
                $mysql->insert("_tbl_profile_credits",array("MemberID"                => $id,
                                                            "MemberCode"           => $MemberCode,
                                                            "ProfileID"            => "0",
                                                            "ProfileCode"          => "0",
                                                            "Particulars"          => "0",
                                                            "Credits"              => $Plan[0]['FreeProfiles'],
                                                            "Debits"               => "0",
                                                            "Available"            =>  $Plan[0]['FreeProfiles']-"0",
                                                            "DownloadedProfileID"  => "0",
                                                            "DownloadedProfileCode"=> "0",
                                                            "DownloadedMemberID"   => "0",
                                                            "DownloadedMemberCode" => "0",
                                                            "OrderID"              => "0",
                                                            "OrderCode"            => "0",
                                                            "MemberPlanID"         => $Plan[0]['PlanID'],
                                                            "MemberPlanCode"       => $Plan[0]['PlanCode'],
                                                            "PlanName"             => $Plan[0]['PlanName'], 
                                                            "TxnDate"                => date("Y-m-d H:i:s"),
                                                            "StartingDate"         => date("Y-m-d H:i:s"),
                                                            "EndingDate"           => $endingdate));
        if (sizeof($id)>0) {
            $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Member'");
              return Response::returnSuccess("success",array("MemberCode"=>$MemberCode));
           return Response::returnSuccess('<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><br><br><img src="'.AppUrl.'CreateProfile/'.$MemberCode.'.htm" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your Profile Created Successfully. </h5>
                            <h5 style="text-align:center;"><a  href="Draft/Edit/GeneralInformation/'+$id+'htm?msg=1">Continue</a>
                       </div>'.$sql,array("Code"=>$MemberCode));
            } else{                                                 
                return Response::returnError("Access denied. Please contact support");   
            }
    }
        /* Verified Subbu Dec 26, 2019 */
        function CheckVerification() {
            
            global $mysql,$loginInfo;
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
			
			if ($franchiseedata[0]['ChangePasswordFstLogin']==1) {
               return $this->ChangePasswordScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
			if (strlen(trim($franchiseedata[0]['TransactionPassword']))<6) {
               return $this->TransactionPasswordScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
			if ($franchiseedata[0]['IsMobileVerified']==0) {
               return $this->ChangeMobileNumberFromVerificationScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
            
            if ($franchiseedata[0]['IsEmailVerified']==0) {
               return $this->ChangeEmailFromVerificationScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
			
			
        }
		function ChangePasswordScreen($error="",$loginid="",$npswd="",$cnpswd="",$reqID="") {
           
		   global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            if ($franchiseedata[0]['ChangePasswordFstLogin']==0) {
				return '<div class="modal-body" style="text-align:center"><br><br>
							<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your password has been<br>saved successfully.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                $formid = "frmChnPass_".rand(30,3000);
                return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                               <div class="modal-header">
                                    <h4 class="modal-title">Change Login Password</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                </div>
								<div class="modal-body" style="min-height: 261px;max-height: 261px;">
									<div class="form-group row">
										<div class="col-sm-4" style="text-align:center;padding-top: 15px;">
											<img src="'.AppPath.'assets/images/icon_change_password.png">
										</div>
										<div class="col-sm-8">
											<span style="text-left:center;color:#ada9a9">The administartor requests to change your login password on your first login.</span><br><br>
											<div class="row">
												<div class="col-sm-8"><h6 style="color:#ada9a9">New Password<span style="color:red">*</span></h6></div>
											</div>                             
											<div class="row">
												<div class="col-sm-11">  
													<div class="input-group">
														<input type="password" class="form-control" value="'.$npswd.'" id="NewPassword"  name="NewPassword" maxlength="20" style="font-family:Roboto;" placeholder="New Password">
														<span class="input-group-btn">
															<button  onclick="showHidePwd(\''.NewPassword.'\',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
														</span>          
													</div>
													<div id="frmNewPass_error" style="color:red;font-size:12px;">'.$error.'</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-8"><h6 style="color:#ada9a9">Confirm New Password<span style="color:red">*</span></h6></div>
											</div>
											<div class="row">
												<div class="col-sm-11">
													<div class="input-group">
														<input type="password" class="form-control" value="'.$cnpswd.'" id="ConfirmNewPassword"  name="ConfirmNewPassword"  maxlength="20" style="font-family:Roboto;" placeholder="Confirm New Password">
														<span class="input-group-btn">
															<button  onclick="showHidePwd(\''.ConfirmNewPassword.'\',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
														</span>          
													</div>
													<div id="frmCfmNewPass_error" style="color:red;font-size:12px">'.$error.'</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
                                   <a href="javascript:void(0)" onclick="Signout()">Sign out</a>&nbsp;&nbsp;
									<a href="javascript:void(0)" onclick="ChangeNewPassword(\''.$formid.'\')" class="btn btn-primary" >Change Password</a>&nbsp;&nbsp;
								</div>
                             </div>
                            </form>                                                                                                       
                        </div>
						<script>
							$(document).ready(function () {
								$("#NewPassword").blur(function () {
									if(IsNonEmpty("NewPassword","frmNewPass_error","Please enter new password")){
										IsAlphaNumeric("NewPassword","frmNewPass_error","Please enter alpha numerics characters only");
									}
								});
								$("#ConfirmNewPassword").blur(function () {
									if(IsNonEmpty("ConfirmNewPassword","frmCfmNewPass_error","Please enter confirm new password")){
										IsAlphaNumeric("ConfirmNewPassword","frmCfmNewPass_error","Please enter alpha numerics characters only");
									}
								});
							});
							document.getElementById(\'NewPassword\').onkeydown = function(event) {
							   var k;
							   if(event.keyCode)
							   {
								   k = event.keyCode;
								   if(k == 13)
								   {                            
									  
										 document.getElementById(\'ConfirmNewPassword\').focus();
								   }
								}
							}
							document.getElementById(\'ConfirmNewPassword\').onkeydown = function(event) {
							   var k;
							   if(event.keyCode)
							   {
								   k = event.keyCode;
								   if(k == 13)
								   {                            
									  
										 ChangeNewPassword(\''.$formid.'\');
								   }
								}
							}
						</script>'; 
            }   
        }
		function ChangeNewPassword($error="",$loginid="",$npswd="",$cnpswd="",$reqID="") {
           global $mysql,$loginInfo;
			if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            } 
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
			if (isset($_POST['NewPassword'])) {
				if (strlen(trim($_POST['NewPassword']))<6) {
                   return $this->ChangePasswordScreen("Invalid new password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['reqId']);
                }
				if (strlen(trim($_POST['NewPassword']))!= strlen(trim($_POST['ConfirmNewPassword']))) {
                   return $this->ChangePasswordScreen("Do not match password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['ConfirmNewPassword'],$_POST['reqId']);
                }
               
                $update = "update _tbl_franchisees_staffs set LoginPassword='".$_POST['NewPassword']."' ,ChangePasswordFstLogin='0' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute($update);
				
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangePassword'");
					$content  = str_replace("#FranchiseeName#",$franchiseedata[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#LoginPassword#",$_POST['NewPassword'],$content);

					 MailController::Send(array("MailTo"         => $franchiseedata[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangePassword",
												"FranchiseeCode" => $franchiseedata[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($franchiseedata[0]['MobileNumber']," Dear ".$franchiseedata[0]['PersonName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['NewPassword']."");  
                
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your new password has been<br> saved successfully.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';   
            }
                                                                                                                                    
			}  
       
		function TransactionPasswordScreen($error="",$loginid="",$scode="",$Rcode="",$reqID="") {
           
		   global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            if (strlen(trim($franchiseedata[0]['TransactionPassword']))>8) {
				return '<div class="modal-body" style="text-align:center"><br><br>
							<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your transaction password has been<br> successfully added.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                $formid = "frmTxnPass_".rand(30,3000);
				/*if ($scode=="") {
					$serror = "Please enter transaction password";
				} else {
				if (strlen($scode)<6 || strlen($scode)>20) {
					$serror = "Transaction password length 6-20 characters";
				}
				}*/
				
                return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                               <div class="modal-header">
                                    <h4 class="modal-title">Transaction Password</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                </div>
								<div class="modal-body" style="min-height: 261px;max-height: 261px;">
									<div class="form-group row">
										<div class="col-sm-4" style="text-align:center;padding-top: 15px;">
											<img src="'.AppPath.'assets/images/icon_transaction_password.png">
										</div>
										<div class="col-sm-8">
											<span style="text-left:center;color:#ada9a9">For security reasons, you must to maintain different passwords for Login and Transaction!</span><br><br>
											<div class="row">
												<div class="col-sm-8"><h6 style="color:#ada9a9">Transaction Password<span style="color:red">*</span></h6></div>
											</div>                             
											<div class="row">
												<div class="col-sm-11">  
													<div class="input-group">
														<input type="password" class="form-control" value="'.$scode.'" id="TransactionPassword"  name="TransactionPassword" maxlength="20" style="font-family:Roboto;" placeholder="Transaction password">
														<span class="input-group-btn">
															<button  onclick="showHidePwd(\''.TransactionPassword.'\',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
														</span>          
													</div>
													<div id="frmTxnPass_error" style="color:red;font-size:12px;">'.$error.'</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-8"><h6 style="color:#ada9a9">Confirm Transaction Password<span style="color:red">*</span></h6></div>
											</div>
											<div class="row">
												<div class="col-sm-11">
													<div class="input-group">
														<input type="password" class="form-control" value="'.$Rcode.'" id="ConfirmTransactionPassword"  name="ConfirmTransactionPassword"  maxlength="20" style="font-family:Roboto;" placeholder="Confirm transaction password">
														<span class="input-group-btn">
															<button  onclick="showHidePwd(\''.ConfirmTransactionPassword.'\',$(this))" class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-close"></i></button>
														</span>          
													</div>
													<div id="frmCTxnPass_error" style="color:red;font-size:12px">'.$error.'</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<a href="javascript:void(0)" onclick="Signout()">Sign out</a>&nbsp;&nbsp;
									<a href="javascript:void(0)" onclick="AddTransactionPassword(\''.$formid.'\')" class="btn btn-primary" >Save Password</a>&nbsp;&nbsp;
								</div>
                             </div>
                            </form>                                                                                                       
                        </div>
						<script>
							$(document).ready(function () {
								$("#TransactionPassword").blur(function () {
									if(IsNonEmpty("TransactionPassword","frmTxnPass_error","Please enter transaction password")){
										IsAlphaNumeric("TransactionPassword","frmTxnPass_error","Please enter alpha numerics characters only");
									}
								});
								$("#ConfirmTransactionPassword").blur(function () {
									if(IsNonEmpty("ConfirmTransactionPassword","frmCTxnPass_error","Please enter confirm transaction password")){
										IsAlphaNumeric("ConfirmTransactionPassword","frmCTxnPass_error","Please enter alpha numerics characters only");
									}
								});
							});
							document.getElementById(\'TransactionPassword\').onkeydown = function(event) {
							   var k;
							   if(event.keyCode)
							   {
								   k = event.keyCode;
								   if(k == 13)
								   {                            
									  
										 document.getElementById(\'ConfirmTransactionPassword\').focus();
								   }
								}
							}
							document.getElementById(\'ConfirmTransactionPassword\').onkeydown = function(event) {
							   var k;
							   if(event.keyCode)
							   {
								   k = event.keyCode;
								   if(k == 13)
								   {                            
									  
										 AddTransactionPassword(\''.$formid.'\');
								   }
								}
							}
						</script>'; 
            }   
        }
		function AddTransactionPassword($error="",$loginid="",$scode="",$Rcode="",$reqID="") {
           global $mysql,$loginInfo;
			
			if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            } 
            
            if (isset($_POST['TransactionPassword'])) {
                
                if (strlen(trim($_POST['TransactionPassword']))<6) {
                   return $this->TransactionPasswordScreen("Invalid transaction passwords.",$_POST['loginId'],$_POST['TransactionPassword'],$_POST['ConfirmTransactionPassword'],$_POST['reqId']);
                }
				if (strlen(trim($_POST['ConfirmTransactionPassword']))<6) {
                   return $this->TransactionPasswordScreen("Invalid confirm transaction password.",$_POST['loginId'],$_POST['TransactionPassword'],$_POST['ConfirmTransactionPassword'],$_POST['reqId']);
                }
				if (strlen(trim($_POST['TransactionPassword']))!= strlen(trim($_POST['ConfirmTransactionPassword']))) {
                   return $this->TransactionPasswordScreen("Do not match password.",$_POST['loginId'],$_POST['ConfirmTransactionPassword'],$_POST['reqId']);
                }
               $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
                $update = "update _tbl_franchisees_staffs set TransactionPassword='".$_POST['TransactionPassword']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute($update);
				
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangeTxnPassword'");
					$content  = str_replace("#FranchiseeName#",$franchiseedata[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#TransactionPassword#",$_POST['TransactionPassword'],$content);

					 MailController::Send(array("MailTo"         => $franchiseedata[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangeTxnPassword",
												"FranchiseeCode" => $franchiseedata[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($franchiseedata[0]['MobileNumber']," Dear ".$franchiseedata[0]['PersonName'].",Your Transaction Password has been changed successfully. Your New Transaction Password is ".$_POST['TransactionPassword']."");  
                
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your transaction password has been<br> successfully updated.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';   
            }
                                                                                                                                    
           
        }
        
        function VisitedWelcomeMsg(){
			global $mysql,$loginInfo;
            return $mysql->execute("update _tbl_franchisees_staffs set WelcomeMsg='1' where  FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
        }
        
        function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your mobile number has been<br> verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                
                $formid = "frmChangeMobileNumber_".rand(30,3000);
             
                return '<div id="otpfrm" >
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="modal-header">
                                <h4 class="modal-title">Please verify mobile number</h4>
								<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body" style="max-height:400px;min-height:400px;">
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                <h4 style="text-align:center;color:#ada9a9">In order to protect your account, we will send a verification code for verification that you will need to enter the next screen.</h4>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">+'.$franchiseedata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($franchiseedata[0]['MobileNumber']).'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumberF()">Change</h4>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary">Continue to verify</a>&nbsp;&nbsp;
                            </div>
                        </div>'; 
                }
        } 
        
        function ChangeMobileNumber($error="",$loginid="",$scode="",$reqID="") {
            
            //if ($loginid=="") {
               // $loginid = $_GET['LoginID'];
            //}
            
            global $mysql,$loginInfo;
            
           // $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your mobile number has been<br> verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                $formid = "frmChangeMobileNo_".rand(30,3000);
                 $countrycode=CodeMaster::getData('RegisterAllowedCountries');
                return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Mobile Number</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                </div>
								<div class="modal-body">
									<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>                                 
									<h4 style="text-align:center;color:#ada9a9">Please enter the new mobile number</h4>
									<div class="form-group row">
										<div class="col-sm-2"></div>
                                        <div class="col-sm-4" style="margin-right:-15px">
                                            <select name="CountryCode" Class="form-control" id="CountryCode" style="height:34px;text-align: center;font-family: Roboto;"> 
                                               <option value="+91">( +91 India )</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">                                                                                                                                                                                          
                                            <input type="text" class="form-control" value="'.$scode.'" id="new_mobile_number"  name="new_mobile_number"  maxlength="10" style="font-family:Roboto;">
                                        </div>
										<div class="col-sm-2"></div>
									</div>
									<div class="form-group row">	
                                        <div class="col-sm-12" id="frmMobileNoVerification_error"  style="color:red;text-align:center">'.$error.'</div>
									</div>                         
								</div>
                                 <div style="text-align:center">
										<a href="javascript:void(0)" onclick="FCheckVerification()">back</a>
                                        <a href="javascript:void(0)" onclick="MobileNumberVerificationForm(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify" style="font-family:roboto">Save and verify</a>
                                 </div>
                             </div>
                            </form>                                                                                                       
                        </div>'; 
            }   
        }
        
        function MobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {
           
            global $mysql,$loginInfo;
             
			$updatemsg = "";
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            } 
            
            if (isset($_POST['new_mobile_number'])) {
                
                if (strlen(trim($_POST['new_mobile_number']))!=10) {
                   return $this->ChangeMobileNumber("Invalid Mobile Number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $duplicate = $mysql->select("select * from _tbl_franchisees_staffs where MobileNumber='".$_POST['new_mobile_number']."' and FranchiseeID <>'".$loginInfo[0]['FranchiseeID']."'");
                
				if (sizeof($duplicate)>0) {
                   return $this->ChangeMobileNumber("Mobile Number already in use.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
				
				$duplicates = $mysql->select("select * from _tbl_franchisees_staffs where MobileNumber='".$_POST['new_mobile_number']."' and FranchiseeID ='".$loginInfo[0]['FranchiseeID']."'");
                
				if (sizeof($duplicates)>0) {
                   return $this->ChangeMobileNumber("you enter your old mobile number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $update = "update _tbl_franchisees_staffs set MobileNumber='".$_POST['new_mobile_number']."' , CountryCode='".$_POST['CountryCode']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute($update);
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                                "RequestSentOn" =>date("Y-m-d H:i:s"),    
                                                             "ActivityType"   => 'MobileNumberChanged.',
                                                             "ActivityString" => 'Mobile Number Changed.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                $updatemsg = "<div class='successmessage'>Your new mobile number has been updated.</div>";
            }
                                                                                                                                    
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your mobile number has been<br> verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                          
                if ($error=="") {
                    $otp=rand(1111,9999);
                    MobileSMSController::sendSMS($franchiseedata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    $securitycode = $mysql->insert("_tbl_verification_code",array("FranchiseeID" =>$franchiseedata[0]['FranchiseeID'],
                                                                                  "StaffID" =>$franchiseedata[0]['PersonID'],
                                                                                 "SMSTo" =>$franchiseedata[0]['MobileNumber'],
                                                                                 "SecurityCode" =>$otp,
                                                                                 "Type" =>"Franchisee Mobile Verificatiom",
                                                                                 "Messagedon"=>date("Y-m-d h:i:s"),
                                                                                 "RequestSentOn"=>date("Y-m-d h:i:s"))) ; 
                }  else {
                    $securitycode = $reqID;
                }
                                                          
                $formid = "frmMobileNoVerification_".rand(30,3000);
                
                return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">   
                            <div class="modal-header">                                                             
                                <h4 class="modal-title">Please verify your mobile number</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body">
                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>                                 
                                <h4 style="text-align:center;color:#ada9a9">Please enter the verification code which you have received on your mobile number ending with  <br>+ '.$franchiseedata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($franchiseedata[0]['MobileNumber']).'</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="col-sm-12"> 
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-2"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmMobileNoVerification_error">'.$error.'</div>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                            </form>                                                                                                       
                           </div>'; 
            }
        }
        function ResendMobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {
             if ($loginid=="") {
                 $loginid = $_GET['LoginID'];
             }
             global $mysql,$loginInfo;
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }
             
             $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
             
             if ($franchiseedata[0]['IsMobileVerified']==1) {
                 return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your mobile number has been<br> verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
             } else {
                 if ($error=="") {                                          
                    $otp=rand(1111,9999);
                    MobileSMSController::sendSMS($franchiseedata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    $securitycode = $mysql->insert("_tbl_verification_code",array("FranchiseeID" =>$franchiseedata[0]['FranchiseeID'],
                                                                                  "StaffID" =>$franchiseedata[0]['PersonID'],
                                                                                  "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                 "SMSTo" =>$franchiseedata[0]['MobileNumber'],
                                                                                 "SecurityCode" =>$otp,
                                                                                 "Type" =>"Franchisee Mobile Verificatiom",
                                                                                 "Messagedon"=>date("Y-m-d h:i:s"),
                                                                                 "RequestSentOn"=>date("Y-m-d h:i:s"))) ; 
                }  else {
                    $securitycode = $reqID;
                }
                 $formid = "frmMobileNoVerification_".rand(30,3000);
                 return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">   
                            <div class="modal-header">                                                             
                                <h4 class="modal-title">Please verify your mobile number</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body">
                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>                                 
                                <h4 style="text-align:center;color:#ada9a9">Please enter the verification code which you have received on your mobile number ending with  +'.$franchiseedata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($franchiseedata[0]['MobileNumber']).'</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="col-sm-12"> 
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-2"><a onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn" style="color:white">Verify</a></div>
                                        <div class="col-sm-3"></div>                         
                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmMobileNoVerification_error">'.$error.'</div>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                            </form>                                                                                                       
                           </div>';
             }
         }
        
                                                                                                                    
        function MobileNumberOTPVerification() {
            
            global $mysql;  
            
            $otpInfo = $mysql->select("select * from _tbl_verification_code where RequestID='".$_POST['reqId']."'");
            if (strlen(trim($_POST['mobile_otp_2']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['mobile_otp_2']))  {
                
                $sql = "update _tbl_franchisees_staffs set IsMobileVerified='1', MobileVerifiedOn='".date("Y-m-d H:i:s")."' where FranchiseeID='".$otpInfo[0]['FranchiseeID']."'";
                $mysql->execute($sql);
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $otpInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MobileNumberVerified.',
                                                             "ActivityString" => 'Mobile Number Verified.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),            
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your mobile number has been<br> verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';
            } else {
                return $this->MobileNumberVerificationForm("You entered, invalid verification code.",$_POST['loginId'],$_POST['mobile_otp_2'],$_POST['reqId']);
            }
        }
        
        
        function ChangeEmailFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            global $mysql,$loginInfo;                                
            
			if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
             if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                
                $formid = "frmChangeEmail_".rand(30,3000);
             
                return '<div id="otpfrm">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="modal-header">
                                <h4 class="modal-title">Please verify your email</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body" style="max-height:400px;min-height:400px;">
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" onclick="EmailVerificationForm()" class="btn btn-primary">Continue to verify</a>&nbsp;&nbsp;
                            </div>
                        </div>'; 
                }
        }
        
        function ChangeEmailID($error="",$loginid="",$scode="",$reqID="") {
             
            global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
            $formid = "frmChangeEmail_".rand(30,3000);
                
                return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Email ID</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                </div>
								<div class="modal-body">
									<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>                                 
									<h4 style="text-align:center;color:#ada9a9">Please enter the new emai id</h4>
									<div class="form-group row">
										<div class="col-sm-2"></div>
                                        <div class="col-sm-8">
											<input type="text" value="'.$scode.'" id="new_email" name="new_email" class="form-control" style="font-family:Roboto;">
                                        </div>
										<div class="col-sm-2"></div>
									</div>
									<div class="form-group row">   
                                        <div class="col-sm-12" id="frmEmailIDVerification_error"  style="color:red;text-align:center">'.$error.'</div>
									</div>                         
								</div>
                                 <div style="text-align:center">
										<a href="javascript:void(0)" onclick="FCheckVerification()">back</a>
                                        <a href="javascript:void(0)" onclick="EmailVerificationForm(\''.$formid.'\')" class="btn btn-primary" style="font-family:roboto" id="verifybtn" name="btnVerify">Save and verify</a>
                                 </div>
                             </div>
                            </form>                                                                                                       
                        </div>'; 
            }
        }
        
        function EmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {
			global $mysql,$mail,$loginInfo;
           
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            if (isset($_POST['new_email'])) {
                if (strlen(trim($_POST['new_email']))==0) {
                    return $this->ChangeEmailID("Invalid EmailID",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                }
                $duplicate = $mysql->select("select * from _tbl_franchisees_staffs where EmailID='".$_POST['new_email']."' and FranchiseeID <>'".$loginInfo[0]['FranchiseeID']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeEmailID("Email already in use.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                }
				
				$duplicates = $mysql->select("select * from _tbl_franchisees_staffs where EmailID='".$_POST['new_email']."' and FranchiseeID ='".$loginInfo[0]['FranchiseeID']."'");
                
				if (sizeof($duplicates)>0) {
                   return $this->ChangeEmailID("you entered your old email id.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                }
                
                $sql ="update _tbl_franchisees_staffs set EmailID='".$_POST['new_email']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute($sql);
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'EmailIDChanged.',
                                                             "ActivityString" => 'Email ID Changed.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
            }
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
           
            if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                if ($error=="") {
                     $otp=rand(1111,9999);
                     
                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeEmailVerification'");
                     $content  = str_replace("#FranchiseeName#",$franchiseedata[0]['PersonName'],$mContent[0]['Content']);
                     $content  = str_replace("#otp#",$otp,$content);
                     
                     MailController::Send(array("MailTo"   => $franchiseedata[0]['EmailID'],
                                                "Category" => "Email Verifications",
                                                "FranchiseeID" => $franchiseedata[0]['FranchiseeID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                                                
                     if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("FranchiseeID"  => $franchiseedata[0]['FranchiseeID'],
                                                                                      "StaffID"  => $franchiseedata[0]['PersonID'],
                                                                                      "EmailTo"      => $franchiseedata[0]['EmailID'],
                                                                                      "SecurityCode" => $otp,
                                                                                      "Type"         => "Franchisee Email Verification",
                                                                                      "Messagedon"   => date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000); 
                
                        $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");                                                          
                        
                        return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Please verify your email</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                            </div>
                                            <div class="modal-body">
                                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmEmailIDVerification_error">'.$error.'</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                            </form>                                                                                                       
                                </div>'; 
                    }

                }  else {
                    
                    $securitycode = $reqID;
                    
                    $formid = "frmMobileNoVerification_".rand(30,3000);
                    $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");                                                           
                    
                    return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Please verify your email</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                            </div>
                                            <div class="modal-body">
                                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmEmailIDVerification_error">'.$error.'</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                            </form>                                                                                                       
                                </div>'; 
                }
            }                                    
        }
        
        function ResendEmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {

            global $mysql,$mail,$loginInfo;
            
             if (sizeof($loginInfo)==0) {
                 return "Invalid request. Please login again.";
             }
             $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
             if ($franchiseedata[0]['IsEmailVerified']==1) {
                 return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="FCheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
             } else {

                 if ($error=="") {
                      $otp=rand(1111,9999);
                     
                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeEmailVerification'");
                     $content  = str_replace("#FranchiseeName#",$franchiseedata[0]['PersonName'],$mContent[0]['Content']);
                     $content  = str_replace("#otp#",$otp,$content);
                     
                     MailController::Send(array("MailTo"   => $franchiseedata[0]['EmailID'],
                                                "Category" => "Email Verifications",
                                                "FranchiseeID" => $franchiseedata[0]['FranchiseeID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                                                
                     if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("FranchiseeID"  => $franchiseedata[0]['FranchiseeID'],
                                                                                      "StaffID"  => $franchiseedata[0]['PersonID'],
                                                                                      "EmailTo"      => $franchiseedata[0]['EmailID'],
                                                                                      "SecurityCode" => $otp,
                                                                                      "Type"         => "Franchisee Email Verification",
                                                                                      "Messagedon"   => date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000); 
                
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Please verify your email</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                            </div>
                                            <div class="modal-body">
                                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmEmailIDVerification_error">'.$error.'</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                            </form>                                                                                                       
                                </div>'; 
                          }

                 }  else {
                   $securitycode = $reqID;
                    
                    $formid = "frmMobileNoVerification_".rand(30,3000);
                    $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");                                                           
                    
                    return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Please verify your email</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmEmailIDVerification_error">'.$error.'</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                            </form>                                                                                                       
                                </div>'; 
                }
            }                                    
        }
     
        function EmailOTPVerification() {
            global $mysql;  
            
            $otpInfo = $mysql->select("select * from _tbl_verification_code where RequestID='".$_POST['reqId']."'");
            
           if (strlen(trim($_POST['email_otp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['email_otp']))  {
                $sql = "update _tbl_franchisees_staffs set IsEmailVerified='1', EmailVerifiedOn='".date("Y-m-d H:i:s")."' where FranchiseeID='".$otpInfo[0]['FranchiseeID']."'";
                $mysql->execute($sql); 
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $otpInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'EmailIDVerified.',
                                                             "ActivityString" => 'Email ID Verified.',
                                                             "SqlQuery"       => base64_encode($sql),                               
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';
                                    } else {
                                        return $this->EmailVerificationForm("<span style='color:red'>You entered, invalid verification code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
                                    }  
        }  
        
		
        function GetMyMembers() {
           
             global $mysql,$loginInfo;
             
              $sql = "SELECT `_tbl_members`.MemberID AS MemberID,
                            _tbl_members.MemberCode AS MemberCode,
                            _tbl_members.MemberName AS MemberName,
                            _tbl_members.Sex AS Gender,
                            _tbl_members.IsDeleted AS IsDeleted,
                            _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                            _tbl_franchisees.FranchiseName AS FranchiseeName,
                            _tbl_members.CreatedBy AS CreatedBy,
                            _tbl_members.CreatedOn AS CreatedOn,
                            _tbl_members.IsActive AS IsActive
                        FROM _tbl_members
                        INNER JOIN _tbl_franchisees
                        ON _tbl_members.ReferedBy=`_tbl_franchisees`.FranchiseeID where `_tbl_members`.`ReferedBy`='".$loginInfo[0]['FranchiseeID']."'";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `_tbl_members`.`IsActive`='1' and `_tbl_members`.`IsDeleted`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `_tbl_members`.`IsActive`='0' and `_tbl_members`.`IsDeleted`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Deleted") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `_tbl_members`.`IsDeleted`='1'"));    
             }
         }
            
        
        function GetMyDeletedMembers() {
             global $loginInfo;     
            return ($loginInfo[0]['FranchiseeID']>0) ? Response::returnSuccess("success"."select * from _tbl_members where IsDeleted='1' and ReferedBy='".$loginInfo[0]['FranchiseeID']."'",$this->execute("select * from _tbl_members where IsDeleted='1' and ReferedBy='".$loginInfo[0]['FranchiseeID']."'"))
                                                     : Response::returnError("Access denied. Please contact support"); 
        }  
        function execute($Qry) {
            
        
            global $mysql;  
            return $mysql->select($Qry);
        }
        
        function GetMemberDetails() {
            global $mysql,$loginInfo; 
			$MemberCode = "";
			if (strlen($_POST['Code'])<=15) {
				$MemberCode = $_POST['Code'];
			} else {
				$Member_session = $mysql->select("select * from _tbl_member_edit where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `FranchiseeStaffID`='".$loginInfo[0]['FranchiseeID']."' and `Session`='".$_POST['Code']."' and `IsAllow`='1'" );
				if (sizeof($Member_session)==0) {
					return Response::returnError("Access denied",array("errorcode" => "access_denied"));
				} else {
					$MemberCode = $Member_session[0]['MemberCode'];
				}
			}	
            $Members = $mysql->select("SELECT 
                                     _tbl_members.MemberID AS MemberID,
                                     _tbl_members.MemberCode AS MemberCode,
                                     _tbl_members.MemberName AS MemberName,
                                     _tbl_members.DateofBirth AS DateofBirth,
                                     _tbl_members.Sex AS Sex,
                                     _tbl_members.CountryCode AS CountryCode,
                                     _tbl_members.MobileNumber AS MobileNumber,
                                     _tbl_members.WhatsappCountryCode AS WhatsappCountryCode,
                                     _tbl_members.WhatsappNumber AS WhatsappNumber,
                                     _tbl_members.EmailID AS EmailID,
                                     _tbl_members.MemberPassword AS MemberPassword,
                                     _tbl_members.IsMobileVerified AS IsMobileVerified,
                                     _tbl_members.IsEmailVerified AS IsEmailVerified,
                                     _tbl_members.IsDeleted AS IsDeleted,
                                     _tbl_members.DeletedOn AS DeletedOn,
                                     _tbl_members.DeactiveRequest AS DeactiveRequest,
                                     _tbl_members.DeactiveRequestOn AS DeactiveRequestOn,
                                     _tbl_members.DeactivatedOn AS DeactivatedOn,
                                     _tbl_members.DeleteRequest AS DeleteRequest,
                                     _tbl_members.DeleteRequestOn AS DeleteRequestOn,
                                     _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                     _tbl_franchisees.FranchiseName AS FranchiseName,
                                     _tbl_franchisees.FranchiseeID AS FranchiseeID,
                                     _tbl_members.CreatedBy AS CreatedBy,
                                     _tbl_members.CreatedOn AS CreatedOn,
                                     _tbl_franchisees.IsActive AS FIsActive,
                                     _tbl_members.IsActive AS IsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.MemberCode='".$MemberCode."'");
        
        $Documents = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."'");               
        $IDProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."' and DocumentType='Id Proof' order by `DocID` DESC ");               
        $AddressProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."' and DocumentType='Address Proof' order by `DocID` DESC ");               
        $CurrentPlan = $mysql->select("select * from `_tbl_profile_credits` where MemberCode='".$MemberCode."' order by `ProfileCreditID` DESC ");               
        $Plan =  $mysql->select("SELECT *
                                FROM _tbl_member_plan
                                LEFT  JOIN _tbl_profile_credits  
                                ON _tbl_member_plan.PlanCode=_tbl_profile_credits.MemberPlanCode where _tbl_profile_credits.MemberCode='".$MemberCode."'");    
        $BoardMessage = $mysql->select("select * from `_tbl_board` where ToMemberCode='".$MemberCode."' and BoardID='".$_POST['BoardID']."'");
        $IndividualSMS = $mysql->select("select * from `_tbl_send_individual_message` where MessageToMemberCode='".$MemberCode."' and ManualSendID='".$_POST['ManualSendID']."' and IsSms='1'");
        $IndividualEmail = $mysql->select("select * from `_tbl_send_individual_message` where MessageToMemberCode='".$MemberCode."' and ManualSendID='".$_POST['ManualSendID']."' and IsEmail='1'");
        return Response::returnSuccess("success"."select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."'",array("MemberInfo"    => $Members[0],
                                                                                                                                            "Countires"     =>CodeMaster::getData('RegisterAllowedCountries'),
                                                                                                                                            "Gender"        =>CodeMaster::getData('SEX'),
                                                                                                                                            "IDProof"       => $IDProofs,
                                                                                                                                            "AddressProof"  => $AddressProofs,
                                                                                                                                            "BoardMessage"  => $BoardMessage[0],
                                                                                                                                            "IndividualSMS"  => $IndividualSMS[0],
                                                                                                                                            "IndividualEmail"  => $IndividualEmail[0],
                                                                                                                                            "Plan" => $Plan[0]));
        }
        function SearchMemberDetails() {
            global $mysql,$loginInfo;                                                                      
            $sql="SELECT tb1_1.MemberID AS MemberID,
                         tb1_1.MemberName AS MemberName,
                         tb1_1.MemberCode AS MemberCode,
                         tb1_1.MobileNumber AS MobileNumber,
                         tb1_1.CountryCode AS CountryCode,
                         _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                         _tbl_franchisees.FranchiseName AS FranchiseeName,
                         tb1_1.CreatedOn AS CreatedOn,
                         tb1_1.IsActive AS IsActive
                   FROM 
                        (select * from _tbl_members where  MemberCode like '%".$_POST['MemberDetails']."%' or MemberName like '%".$_POST['MemberDetails']."%' or MobileNumber like '%".$_POST['MemberDetails']."%' or EmailID like '%".$_POST['MemberDetails']."%') AS tb1_1
                   INNER JOIN 
                        _tbl_franchisees 
                   ON 
                        tb1_1.ReferedBy=_tbl_franchisees.FranchiseeID
                   where 
                    _tbl_franchisees.FranchiseeID='".$loginInfo[0]['FranchiseeID']."'";
            $Members=$mysql->select($sql);   
            $index = 0;
            foreach($Members as $Member) {
               $v = $mysql->select("select * from _tbl_draft_profiles where MemberID='".$Member['MemberID']."'");   
               //if ($v[0]['ProfileID']>0) {
               if ( sizeof($v)>0) {
               $Members[$index]['IsEditable']= ($v[0]['IsApproved']==0 && $v[0]['RequestToVerify']==0) ? 1 : 0 ;
               $Members[$index]['ProfilesID']= $v[0]['ProfileID']  ;
               $Members[$index]['ProfilesCode']= $v[0]['ProfileCode']  ;
               $Members[$index]['NoOfProfile']= sizeof($v)  ;
                   
               } else {
                $Members[$index]['IsEditable']=  0;
                $Members[$index]['ProfilesID']= 0;
                $Members[$index]['ProfilesCode']= 0;
                $Members[$index]['NoOfProfile']= 0;
                   
               }
               $index++;
            } 
            return Response::returnSuccess("success".$sql."select * from _tbl_draft_profiles where MemberID='".$Member['MemberID']."'",$Members);
        }
       /* function NewProfile() {
            global $mysql,$loginInfo;                                                                      
            $sql="SELECT tb1_1.MemberID AS MemberID,
                         tb1_1.MemberName AS MemberName,
                         tb1_1.MemberCode AS MemberCode,
                         tb1_1.MobileNumber AS MobileNumber,
                         _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                         _tbl_franchisees.FranchiseName AS FranchiseeName,
                         tb1_1.CreatedOn AS CreatedOn,
                         tb1_1.IsActive AS IsActive
                   FROM 
                        (select * from _tbl_members where  MemberCode like '%".$_POST['MemberDetails']."%' or MemberName like '%".$_POST['MemberDetails']."%' or MobileNumber like '%".$_POST['MemberDetails']."%' or EmailID like '%".$_POST['MemberDetails']."%') AS tb1_1
                   INNER JOIN 
                        _tbl_franchisees 
                   ON 
                        tb1_1.ReferedBy=_tbl_franchisees.FranchiseeID
                   
                   where 
                    _tbl_franchisees.FranchiseeID='".$loginInfo[0]['FranchiseeID']."'";
            $Member=$mysql->select($sql);     
            $Profile = $mysql->select("select * from _tbl_draft_profiles where CreatedBy='".$Member[0]['MemberID']."'");                                               
            return Response::returnSuccess("success",array("Member" => $Member,"Profile" =>$Profile[0]));
        }  */
         
		 function ViewMemberEditScreen(){
              global $mysql,$loginInfo;    
			   $rand = md5(time().$_POST['MemberCode']."@#!-&*+");	
			   $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			   if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
					$id = $mysql->insert("_tbl_member_edit",array("MemberCode"       	 => $_POST['MemberCode'],
																  "TransactionPassword"  => $_POST['txnPassword'],
																  "Session" 			 => $rand,
																  "FranchiseeID" 	     => $loginInfo[0]['FranchiseeID'],
																  "FranchiseeStaffID" 	 => $loginInfo[0]['FranchiseeStaffID'],
																  "ViewEditOn"     		 => date("Y-m-d H:i:s"))); 
					 echo "<script>location.href='".AppPath."Members/EditMember/".$rand.".html'</script>";
				
				} else {
					return Response::returnError("Invalid transaction password");
				}
		 }
		 function ViewMemberScreen(){
              global $mysql,$loginInfo;    
			   $rand = md5(time().$_POST['MemberCode']."@#!-&*+");	
			   $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			   if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
					$id = $mysql->insert("_tbl_member_edit",array("MemberCode"       	 => $_POST['MemberCode'],
																  "TransactionPassword"  => $_POST['txnPassword'],
																  "Session" 			 => $rand,
																  "FranchiseeID" 	     => $loginInfo[0]['FranchiseeID'],
																  "FranchiseeStaffID" 	 => $loginInfo[0]['FranchiseeStaffID'],
																  "ViewEditOn"     		 => date("Y-m-d H:i:s"))); 
					 echo "<script>location.href='".AppPath."Members/ViewMember/".$rand.".html'</script>";
				
				} else {
					return Response::returnError("Invalid transaction password");
				}
		 }
		 
        function EditMember(){
              global $mysql,$loginInfo;    
              
               $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
                    if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                    }
				
			  $Member_session = $mysql->select("select * from _tbl_member_edit where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `FranchiseeStaffID`='".$loginInfo[0]['FranchiseeID']."' and `Session`='".$_POST['SCode']."' and `IsAllow`='1'" );	
              
              $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberCode='".$Member_session[0]['MemberCode']."'");

              $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_EMAIL'");
                    if ($allowDuplicateMobile[0]['ParamA']==0) {
                        $data = $mysql->select("select * from  _tbl_members where EmailID='".trim($_POST['EmailID'])."' and MemberCode <>'".$_POST['MemberCode']."' ");
                            if (sizeof($data)>0) {
                            return Response::returnError("EmailID Already Exists");    
                        }
                    }
              $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_MOBILE'");
                    if ($allowDuplicateEmail[0]['ParamA']==0) {
                        $data = $mysql->select("select * from  _tbl_members where MobileNumber='".trim($_POST['MobileNumber'])."' and MemberCode <>'".$_POST['MemberCode']."' ");
                            if (sizeof($data)>0) {
                            return Response::returnError("Mobile Number Already Exists");    
                        }
                    }
              if (strlen(trim($_POST['WhatsappNumber']))>0) {
			$allowDuplicateWhatsapp = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IS_ALLOW_DUPLICATE_WHATSAPP'");
             if ($allowDuplicateWhatsapp[0]['ParamA']==0) {
                $data = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."' and MemberCode <>'".$_POST['MemberCode']."' ");
                    if (sizeof($data)>0) {
                        return Response::returnError("WhatsappNumber Already Exists");
                    }
             }
			}
                 $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];  
				$Sex = CodeMaster::getData("SEX",$_POST['Sex']);	
				
                $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                         DateofBirth='".$dob."',
                                                         SexCode='".$_POST['Sex']."',
                                                         Sex='".$Sex[0]['CodeValue']."',
                                                         EmailID='".$_POST['EmailID']."',
                                                         CountryCode='".$_POST['CountryCode']."',
                                                         MobileNumber='".$_POST['MobileNumber']."',
                                                         WhatsappCountryCode='".$_POST['WhatsappCountryCode']."',
                                                         WhatsappNumber='".$_POST['WhatsappNumber']."' where  MemberCode='".$_POST['MemberCode']."'");
      
				$mysql->execute("update _tbl_member_edit set IsAllow='0' where MemberCode='".$_POST['MemberCode']."' and `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `FranchiseeStaffID`='".$loginInfo[0]['FranchiseeID']."'");
      
      $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberCode='".$_POST['MemberCode']."'");
            
    
                return Response::returnSuccess("success",array());
                                                            
    } 
    function MemberChnPswd() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid Member information"); 
            }
        if($Member[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        if (isset($_POST['NewPswd'])) {
                if (strlen(trim($_POST['NewPswd']))<6) {
                   return Response::returnError("Please enter password more than 6 character "); 
                }
                if (strlen(trim($_POST['NewPswd']))!= strlen(trim($_POST['ConfirmNewPswd']))) {
                   return Response::returnError("Password do not match"); 
                }
               
               $mysql->execute("update _tbl_members set MemberPassword='".$_POST['NewPswd']."' ,ChangePasswordFstLogin='".(($_POST['ChnPswdFstLogin']=="on") ? '1' : '0')."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$Member[0]['MemberCode']."'");
                 
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangePassword'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#MemberPassword#",$_POST['ConfirmNewPswd'],$content);

                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberChangePassword",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPswd']."");   
                 
                 return Response::returnSuccess("Success",array());  
            }
        
    }
    function ResetMemberPassword(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        $ResetPasswordlink = md5(time().$Member[0]['MemberCode'].$Member[0]['MobileNumber'].$Member[0]['EmailID']);
        $Link = DomainPath."ResetPassword.php?link=".$ResetPasswordlink;
        $date = date_create(date("Y-m-d"));                    
                $e = "3 days";                
                date_add($date,date_interval_create_from_date_string($e));
                $endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
                $endingdate= date_format($date,"Y-m-d");
         $mysql->insert("_tbl_member_reset_password",array("MemberID"       => $Member[0]['MemberID'],
                                                           "MemberCode"     => $Member[0]['MemberCode'], 
                                                           "ResetBy"        => "Franchisee", 
                                                           "ResetByID"      => $loginInfo[0]['FranchiseeID'], 
                                                           "ResetByName"    => $txnPwd[0]['PersonName'], 
                                                           "SmsTo"          => $Member[0]['MobileNumber'], 
                                                           "EmailTo"        => $Member[0]['EmailID'], 
                                                           "ResetLink"      => $ResetPasswordlink, 
                                                           "CreatedOn"      => date("Y-m-d H:i:s"),  
                                                           "ExpiredOn"      => $endingdate));  
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberResetPassword'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#Link#",$Link,$content);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberResetPassword",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
       return Response::returnSuccess("Reset Password Successfully",array());
    }
    function ChangeMemberMobileNumber(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        $ResetMobileNumberlink = md5(time().$Member[0]['MemberCode'].$Member[0]['MobileNumber'].$Member[0]['EmailID']);
        $Link = DomainPath."ChangeMobileNumber.php?link=".$ResetMobileNumberlink;
        $date = date_create(date("Y-m-d"));                    
                $e = "3 days";                
                date_add($date,date_interval_create_from_date_string($e));
                $endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
                $endingdate= date_format($date,"Y-m-d");
         $mysql->insert("_tbl_member_reset_mobilenumber",array("MemberID"       => $Member[0]['MemberID'],
                                                               "MemberCode"     => $Member[0]['MemberCode'], 
                                                               "ResetBy"        => "Franchisee", 
                                                               "ResetByID"      => $loginInfo[0]['FranchiseeID'], 
                                                               "ResetByName"    => $txnPwd[0]['PersonName'], 
                                                               "SmsTo"          => $Member[0]['MobileNumber'], 
                                                               "EmailTo"        => $Member[0]['EmailID'], 
                                                               "ResetLink"      => $ResetMobileNumberlink, 
                                                               "CreatedOn"      => date("Y-m-d H:i:s"),  
                                                               "ExpiredOn"      => $endingdate));  
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangeMobileNumberFromFranchisee'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#Link#",$Link,$content);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberChangeMobileNumberFromFranchisee",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
        
       return Response::returnSuccess("Change Mobile Number Successfully",array());
    }
    function ChangeMemberEmailID(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        $ResetEmailIDlink = md5(time().$Member[0]['MemberCode'].$Member[0]['MobileNumber'].$Member[0]['EmailID']);
        $Link = DomainPath."ChangeEmailID.php?link=".$ResetEmailIDlink;
        $date = date_create(date("Y-m-d"));                    
                $e = "3 days";                
                date_add($date,date_interval_create_from_date_string($e));
                $endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
                $endingdate= date_format($date,"Y-m-d");
              $mysql->insert("_tbl_member_reset_emailid",array("MemberID"       => $Member[0]['MemberID'],
                                                               "MemberCode"     => $Member[0]['MemberCode'], 
                                                               "ResetBy"        => "Franchisee", 
                                                               "ResetByID"      => $loginInfo[0]['FranchiseeID'], 
                                                               "ResetByName"    => $txnPwd[0]['PersonName'], 
                                                               "SmsTo"          => $Member[0]['MobileNumber'], 
                                                               "EmailTo"        => $Member[0]['EmailID'], 
                                                               "ResetLink"      => $ResetEmailIDlink, 
                                                               "CreatedOn"      => date("Y-m-d H:i:s"),  
                                                               "ExpiredOn"      => $endingdate));  
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangeEmailIDFromFranchisee'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#Link#",$Link,$content);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberChangeEmailIDFromFranchisee",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
        
       return Response::returnSuccess("Change EmailID Successfully",array());
    }
    function ReqToDeactiveMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            } 
        if($Member[0]['DeactiveRequest']==1){
            return Response::returnError("Deactive Request already sent"); 
        }
        $mysql->execute("update _tbl_members set DeactiveRequest='1', DeactiveRequestOn='".date("Y-m-d H:i:s")."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$Member[0]['MemberCode']."'");
        $id =  $mysql->insert("_tbl_franchisee_requests",array("RequestByID"        => $txnPwd[0]['FranchiseeID'],
                                                               "RequestByCode"      => $txnPwd[0]['FrCode'], 
                                                               "RequestByStaffID"   => $txnPwd[0]['PersonID'], 
                                                               "RequestByStaffCode" => $txnPwd[0]['StaffCode'], 
                                                               "MemberID"           => $Member[0]['MemberID'], 
                                                               "MemberCode"         => $Member[0]['MemberCode'], 
                                                               "IsDeactive"         => "1", 
                                                               "DeactiveReason"     => $_POST['DeactiveRemarks'], 
                                                               "DeactiveRequestOn"  => date("Y-m-d H:i:s"))); 
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberDeactiveRequestFromFranchisee'");
        $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
        $content  = str_replace("#FrCode#",$txnPwd[0]['FrCode'],$content);

         MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                    "Category"       => "MemberDeactiveRequestFromFranchisee",
                                    "MemberID"       => $Member[0]['MemberID'],
                                    "Subject"        => $mContent[0]['Title'],
                                    "Message"        => $content),$mailError);
         MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your account deactivate request from franchisee(".$txnPwd[0]['FrCode'].") has been Sent.");  
                                                               
        $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $Member[0]['MemberID'],
                                                         "ActivityType"   => 'MemberDeactiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Member Deactive Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'F',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['FrCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['PersonName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
        $Msgid = $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $txnPwd[0]['FranchiseeID'],
                                                                         "ToFranchiseeCode"  => $txnPwd[0]['FrCode'],
                                                                         "Message"           => "Member (".$Member[0]['MemberCode'].") account deactive request has been sent to admin"));
        
       return Response::returnSuccess("Deactive Request Sent",array());
    }
    function ReqToActiveMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            } 
        if($Member[0]['DeactiveRequest']==2){
            return Response::returnError("Active Request already sent"); 
        }
        $mysql->execute("update _tbl_members set DeactiveRequest='2', DeactiveRequestOn='".date("Y-m-d H:i:s")."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$Member[0]['MemberCode']."'");
        $id =  $mysql->insert("_tbl_franchisee_requests",array("RequestByID"        => $txnPwd[0]['FranchiseeID'],
                                                               "RequestByCode"      => $txnPwd[0]['FrCode'], 
                                                               "RequestByStaffID"   => $txnPwd[0]['PersonID'], 
                                                               "RequestByStaffCode" => $txnPwd[0]['StaffCode'], 
                                                               "MemberID"           => $Member[0]['MemberID'], 
                                                               "MemberCode"         => $Member[0]['MemberCode'], 
                                                               "IsDeactive"         => "2", 
                                                               "DeactiveReason"     => $_POST['ActiveRemarks'], 
                                                               "DeactiveRequestOn"  => date("Y-m-d H:i:s"))); 
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberActiveRequestFromFranchisee'");
        $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
        $content  = str_replace("#FrCode#",$txnPwd[0]['FrCode'],$content);

         MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                    "Category"       => "MemberActiveRequestFromFranchisee",
                                    "MemberID"       => $Member[0]['MemberID'],
                                    "Subject"        => $mContent[0]['Title'],
                                    "Message"        => $content),$mailError);
         MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your account activate request from franchisee(".$txnPwd[0]['FrCode'].") has been Sent.");  
                                                               
        $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $Member[0]['MemberID'],
                                                         "ActivityType"   => 'MemberActiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Member Active Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'F',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['FrCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['PersonName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
        $Msgid = $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $txnPwd[0]['FranchiseeID'],
                                                                         "ToFranchiseeCode"  => $txnPwd[0]['FrCode'],
                                                                         "Message"           => "Member (".$Member[0]['MemberCode'].") account active request has been sent to admin"));
        
       return Response::returnSuccess("Deactive Request Sent",array());
    }
    function ReqToDeleteMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            } 
        if($Member[0]['DeleteRequest']==1){
            return Response::returnError("Delete Request already sent"); 
        }
        $mysql->execute("update _tbl_members set DeleteRequest='1', DeleteRequestOn='".date("Y-m-d H:i:s")."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$Member[0]['MemberCode']."'");
        $id =  $mysql->insert("_tbl_franchisee_requests",array("RequestByID"        => $txnPwd[0]['FranchiseeID'],
                                                               "RequestByCode"      => $txnPwd[0]['FrCode'], 
                                                               "RequestByStaffID"   => $txnPwd[0]['PersonID'], 
                                                               "RequestByStaffCode" => $txnPwd[0]['StaffCode'], 
                                                               "MemberID"           => $Member[0]['MemberID'], 
                                                               "MemberCode"         => $Member[0]['MemberCode'], 
                                                               "IsDelete"           => "1", 
                                                               "DeleteReason"       => $_POST['DeleteRemarks'], 
                                                               "DeleteRequestOn"    => date("Y-m-d H:i:s")));
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberDeleteRequestFromFranchisee'");
        $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
        $content  = str_replace("#FrCode#",$txnPwd[0]['FrCode'],$content);

         MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                    "Category"       => "MemberDeleteRequestFromFranchisee",
                                    "MemberID"       => $Member[0]['MemberID'],
                                    "Subject"        => $mContent[0]['Title'],
                                    "Message"        => $content),$mailError);
         MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your account delete request from franchisee(".$txnPwd[0]['FrCode'].") has been Sent.");  
     
        $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $Member[0]['MemberID'],
                                                         "ActivityType"   => 'MemberDeleteRequestFromFranchisee.',
                                                         "ActivityString" => 'Member Delete Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'F',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['FrCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['PersonName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
        $Msgid = $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $txnPwd[0]['FranchiseeID'],
                                                                         "ToFranchiseeCode"  => $txnPwd[0]['FrCode'],
                                                                         "Message"           => "Member (".$Member[0]['MemberCode'].") account delete request has been sent to admin"));
        
       return Response::returnSuccess("Delete Request Sent",array());
    }
    function ReqToRestoreMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
            return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            } 
        if($Member[0]['DeleteRequest']==2){
            return Response::returnError("Restore Request already sent"); 
        }
        $mysql->execute("update _tbl_members set DeleteRequest='2', DeleteRequestOn='".date("Y-m-d H:i:s")."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$Member[0]['MemberCode']."'");
        $id =  $mysql->insert("_tbl_franchisee_requests",array("RequestByID"        => $txnPwd[0]['FranchiseeID'],
                                                               "RequestByCode"      => $txnPwd[0]['FrCode'], 
                                                               "RequestByStaffID"   => $txnPwd[0]['PersonID'], 
                                                               "RequestByStaffCode" => $txnPwd[0]['StaffCode'], 
                                                               "MemberID"           => $Member[0]['MemberID'], 
                                                               "MemberCode"         => $Member[0]['MemberCode'], 
                                                               "IsDelete"           => "2", 
                                                               "DeleteReason"       => $_POST['DeleteRemarks'], 
                                                               "DeleteRequestOn"    => date("Y-m-d H:i:s")));
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberRestoreRequestFromFranchisee'");
        $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
        $content  = str_replace("#FrCode#",$txnPwd[0]['FrCode'],$content);

         MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                    "Category"       => "MemberRestoreRequestFromFranchisee",
                                    "MemberID"       => $Member[0]['MemberID'],
                                    "Subject"        => $mContent[0]['Title'],
                                    "Message"        => $content),$mailError);
         MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your account restore request from franchisee(".$txnPwd[0]['FrCode'].") has been Sent.");  
     
        $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $Member[0]['MemberID'],
                                                         "ActivityType"   => 'MemberRestoreRequestFromFranchisee.',
                                                         "ActivityString" => 'Member Restore Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'F',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['FrCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['PersonName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
        $Msgid = $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $txnPwd[0]['FranchiseeID'],
                                                                         "ToFranchiseeCode"  => $txnPwd[0]['FrCode'],
                                                                         "Message"           => "Member (".$Member[0]['MemberCode'].") account restore request has been sent to admin"));
        
       return Response::returnSuccess("Restore Request Sent",array());
    }
    function RefillWallet(){
           global $mysql,$loginInfo;    
              
              $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'");
              $sql="select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'";
                return Response::returnSuccess("success".$sql,$Member);
                                                            
    }
    function ResetPassword(){
           global $mysql,$loginInfo;    
              
              $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'");
              $sql="select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'";
                return Response::returnSuccess("success".$sql,$Member);
                                                            
    }
    function GetManageStaffs(){
           global $mysql,$loginInfo;    
              
              $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where ReferedBy<>'1' and FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
              $sql="select * from _tbl_franchisees_staffs where ReferedBy<>'1' and FranchiseeID='".$loginInfo[0]['FranchiseeID']."'";
                return Response::returnSuccess("success".$sql,$Staffs);
                                                            
    }
    function CreateFranchiseeStaff() {
                                                                            
        global $mysql,$loginInfo;  
		
		$txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
            }
		$data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".$_POST['EmailID']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".$_POST['MobileNumber']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".$_POST['LoginName']."'");
        if (sizeof($data)>0) {
            return Response::returnError("LoginName Already Exists");
        }
        $Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'"); 
        $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
		$StaffCode =SeqMaster::GetNextFranchiseeStaffNumber();
		$country = CodeMaster::getData("CONTNAMES",$_POST['CountryName']);
		$Sex = CodeMaster::getData("SEX",$_POST['Sex']);
          $id =  $mysql->insert("_tbl_franchisees_staffs",array("FrCode"          => $Franchisee[0]['FranchiseeCode'],
                                                                 "StaffCode"       => $StaffCode,   
                                                                 "PersonName"      => $_POST['staffName'], 
                                                                 "SexCode"             => $_POST['Sex'],                                 
                                                                 "Sex"             => $Sex[0]['CodeValue'],                                 
                                                                 "DateofBirth"     => $dob,
                                                                 "MobileNumberCode"    => $country[0]['SoftCode'],
                                                                 "CountryCode"    => $_POST['MobileNumberCountryCode'],
                                                                 "MobileNumber"    => $_POST['MobileNumber'],
                                                                 "EmailID"         => $_POST['EmailID'],
                                                                 "IsActive"        => "1",
                                                                 "UserRole"        => "Admin",
                                                                 "LoginName"       => $_POST['LoginName'],
                                                                 "FranchiseeID"    => $loginInfo[0]['FranchiseeID'],
                                                                 "ReferedBy"       => "0",
                                                                 "CreatedOn"       => date("Y-m-d H:i:s"), 
                                                                 "LoginPassword"   => $_POST['LoginPassword'],
                                                                 "ChangePasswordFstLogin"   => (($_POST['PasswordFstLogin']=="on") ? '1' : '0')));
																 
										$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='FranchiseeStaff'");                                  
                                                                       
					 $mContent = $mysql->select("select * from `mailcontent` where `Category`='NewFranchiseeStaffCreate'");
					 $content  = str_replace("#PersonName#",$_POST['staffName'],$mContent[0]['Content']);
					 $content  = str_replace("#FranchiseeName#",$Franchisee[0]['FranchiseName'],$content);
					 $content  = str_replace("#LoginName#",$_POST['LoginName'],$content);
					 $content  = str_replace("#LoginPassword#",$_POST['LoginPassword'],$content);

					 MailController::Send(array("MailTo"   => $_POST['EmailID'],
												"Category" => "NewFranchiseeStaffCreate",
												"MemberID" => $id,
												"Subject"  => $mContent[0]['Title'],
												"Message"  => $content),$mailError);
					MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['staffName'].",You have added as a staff in ".$Franchisee[0]['FranchiseName']." <br> Your StaffID ID is ".$StaffCode." ,Login Name is ".$_POST['LoginName']." and Login Password is ".$_POST['LoginPassword']." " );

			if ($id>0) {
                return Response::returnSuccess("success",array("StaffCode" => $StaffCode));
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function GetFranchiseeStaffCodeCode(){                                
            return Response::returnSuccess("success",array("staffCode" => SeqMaster::GetNextFranchiseeStaffNumber(),
                                                           "Gender"     => CodeMaster::getData('SEX'),
                                                           "Country"     => CodeMaster::getData('RegisterAllowedCountries')));
        }
    function EditFranchiseeStaff(){
              global $mysql,$loginInfo;    
			  
			  $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
				if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
					return Response::returnError("Invalid transaction password");   
				}
                $data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."' and StaffCode <>'".$_POST['StaffCode']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("EmailID Already Exists");    
              }
                
                $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".$_POST['MobileNumber']."' and StaffCode <>'".$_POST['StaffCode']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("Mobile Number Already Exists");
                }   
                 $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where StaffCode='".$_POST['StaffCode']."'");
                 
				 if($Staffs[0]['MobileNumber'] != $_POST['MobileNumber']){
					 
					 $mysql->execute("update _tbl_franchisees_staffs set IsMobileVerified='0' where  StaffCode='".$_POST['StaffCode']."' and FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
					
					 $mysql->insert("_tbl_change_mobile_email",array("FranchiseeCode"   => $Staffs[0]['FrCode'],
																	"FranchiseeID"     => $Staffs[0]['FranchiseeID'],   
																	"FranchiseeStaffID"=> $Staffs[0]['PersonID'],   
																	"CountryCode"      => $Staffs[0]['CountryCode'],
																	"MobileNumber"     => $Staffs[0]['MobileNumber'],
																	"ChangedOn"        => date("Y-m-d H:i:s")));
					 
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangeMobileNumber'");
					$content  = str_replace("#FranchiseeName#",$Staffs[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#CountryCode#",$_POST['CountryCode'],$content);
					$content  = str_replace("#MobileNumber#",$_POST['MobileNumber'],$content);

					 MailController::Send(array("MailTo"         => $Staffs[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangeMobileNumber",
												"FranchiseeCode" => $Staffs[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($Staffs[0]['MobileNumber']," Dear ".$Staffs[0]['PersonName'].",Your Mobile Number has been changed successfully. Your New Mobile Number is ".$_POST['MobileNumber']."");  
					 MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$Staffs[0]['PersonName'].",Your Mobile Number has been changed successfully.");  
				 
				 }
				 if($Staffs[0]['EmailID'] != $_POST['EmailID']){
					 
					 $mysql->execute("update _tbl_franchisees_staffs set IsEmailVerified='0' where  StaffCode='".$_POST['StaffCode']."' and FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
					
					$mysql->insert("_tbl_change_mobile_email",array("FranchiseeCode"   => $Staffs[0]['FrCode'],
																	"FranchiseeID"     => $Staffs[0]['FranchiseeID'],   
																	"FranchiseeStaffID"=> $Staffs[0]['PersonID'],   
																	"EmailID"      	   => $Staffs[0]['EmailID'],
																	"ChangedOn"        => date("Y-m-d H:i:s")));
																	
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangeEmail'");
					$content  = str_replace("#FranchiseeName#",$Staffs[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#EmailID#",$_POST['EmailID'],$content);
					
					 MailController::Send(array("MailTo"         => $Staffs[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangeEmail",
												"FranchiseeCode" => $Staffs[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
												
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangedEmail'");
					$content  = str_replace("#FranchiseeName#",$Staffs[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#EmailID#",$_POST['EmailID'],$content);
					
					 MailController::Send(array("MailTo"         => $_POST['EmailID'],
												"Category"       => "FranchiseeStaffChangedEmail",
												"FranchiseeCode" => $Staffs[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($Staffs[0]['MobileNumber']," Dear ".$Staffs[0]['PersonName'].",Your Email ID has been changed successfully. Your New Email ID is ".$_POST['EmailID']."");  
					 
				 }
				
				
				 $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
				 $Sex = CodeMaster::getData("SEX",$_POST['Sex']);
                    $mysql->execute("update _tbl_franchisees_staffs set PersonName='".$_POST['staffName']."', 
                                                           SexCode='".$_POST['Sex']."', 
                                                           Sex='".$Sex[0]['CodeValue']."', 
                                                           DateofBirth='".$dob."',
                                                           CountryCode='".$_POST['CountryCode']."',
                                                           MobileNumber='".$_POST['MobileNumber']."',
                                                           EmailID='".$_POST['EmailID']."',                                 
                                                           UserRole='".$_POST['UserRole']."'
                                                           where  StaffCode='".$Staffs[0]['StaffCode']."'");
                return Response::returnSuccess("success",array());
                                                                                               
    } 
	
	function DeactiveFranchiseeStaff(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
			return Response::returnError("Staff already deactivated"); 
		}
		$mysql->execute("update _tbl_franchisees_staffs set IsActive='0' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='DeactivateFranchiseeStaff'");
					$content  = str_replace("#FranchiseeName#",$staff[0]['PersonName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
												"Category"       => "DeactivateFranchiseeStaff",
												"FranchiseeCode" => $staff[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['PersonName'].",Your staff account has been deactivated.");  
		
		return Response::returnSuccess("Deactivated Successfully",array());
	}
	function ActiveFranchiseeStaff(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==1){
			return Response::returnError("Staff already Activated"); 
		}
		$mysql->execute("update _tbl_franchisees_staffs set IsActive='1' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("Activated Successfully",array());
	}
	function ResetTxnPswdFranchiseeStaff(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		/*if(strlen($staff[0]['TransactionPassword']==0)){
			return Response::returnError("Transaction password already reseted"); 
		}*/
		if($staff[0]['IsActive']==0){
			return Response::returnError("Account is deactivated so Could not process"); 
		}
		$mysql->execute("update _tbl_franchisees_staffs set TransactionPassword='' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffResetTxnPassword'");
					$content  = str_replace("#FranchiseeName#",$staff[0]['PersonName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
												"Category"       => "FranchiseeStaffResetTxnPassword",
												"FranchiseeCode" => $staff[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['PersonName'].",Your Transaction Password has been reset successfully.");  
		
		return Response::returnSuccess("success",array());
	}
	function DeleteFranchiseeStaff(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
			if($staff[0]['Deleted']==1){
			return Response::returnError("Account is already deleted"); 
		}
		$mysql->execute("update _tbl_franchisees_staffs set IsDeleted='1' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("success",array());
	}
	function FranchiseeStaffMobverification(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
				return Response::returnError("Account is deactivated so Could not process"); 
			}
		$mysql->execute("update _tbl_franchisees_staffs set IsMobileVerified='1',MobileVerifiedOn='".date("Y-m-d H:i:s")."' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("Success",array());
	}
	function FranchiseeStaffEmailverification(){
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
				return Response::returnError("Account is deactivated so Could not process"); 
			}
		$mysql->execute("update _tbl_franchisees_staffs set IsEmailVerified='1',EmailVerifiedOn='".date("Y-m-d H:i:s")."' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("Success",array());
	}
	function FranchiseeStaffChnPswdFstLogin() {
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
				return Response::returnError("Account is deactivated so Could not process"); 
			}
		$mysql->execute("update _tbl_franchisees_staffs set ChangePasswordFstLogin='0' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("Success",array());
	}
	function FranchiseeStaffChnPswd() {
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
		$staff = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
				return Response::returnError("Account is deactivated so Could not process"); 
			}
		if (isset($_POST['NewPswd'])) {
				if (strlen(trim($_POST['NewPswd']))<6) {
                   return Response::returnError("Please enter new password"); 
                }
				if (strlen(trim($_POST['NewPswd']))!= strlen(trim($_POST['ConfirmNewPswd']))) {
                   return Response::returnError("Password do not match"); 
                }
               
               $mysql->execute("update _tbl_franchisees_staffs set LoginPassword='".$_POST['NewPswd']."' ,ChangePasswordFstLogin='".(($_POST['ChnPswdFstLogin']=="on") ? '1' : '0')."' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
                 
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangePassword'");
					$content  = str_replace("#FranchiseeName#",$staff[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#LoginPassword#",$_POST['ConfirmNewPswd'],$content);

					 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangePassword",
												"FranchiseeCode" => $staff[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['PersonName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPswd']."");  
				 
				 return Response::returnSuccess("Success",array());  
            }
		
	}
    function GetStaffs(){
           global $mysql,$loginInfo;    
              
              $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where StaffCode='".$_POST['Code']."' and FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
              $Sex =   $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$Staffs[0]['Sex']."'");
              $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `FranchiseeStaffID`='".$Staffs[0]['PersonID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
                return Response::returnSuccess("success",array("Staffs" => $Staffs,
                                                                "Gender"     =>$Sex,
                                                                "LastLogin"     =>$LoginHistory));
    }
    function GetFranchiseeInfo(){
             global $mysql,$loginInfo;
             $Franchisee=$mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'"); 
             $Franchisee[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             $Document = $mysql->select("select * from `_tbl_franchisee_documents` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
             return Response::returnSuccess("success",$Franchisee[0],array("Documents" => $Document));
         }
    function GetFranchiseeInformation(){
             global $mysql,$loginInfo;
             $Franchisee=$mysql->select("select * from `_tbl_franchisees` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'"); 
             $Franchisee[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
			 $FranchiseeStaff=$mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
			 $PrimaryBankAccount = $mysql->select("select * from _tbl_bank_details where FranchiseeID='".$Franchisee[0]['FranchiseeID']."' and IsDelete='0'");
			return Response::returnSuccess("success",array("Franchisee"         => $Franchisee[0],
													       "FranchiseeStaff"    => $FranchiseeStaff[0],
														   "PrimaryBankAccount" => $PrimaryBankAccount));
         }
    function GetRefillWalletBankNameAndMode(){
           global $mysql,$loginInfo;    
              $BankName = $mysql->select("select * from `_tbl_settings_bankdetails` where IsActive='1'");
                return Response::returnSuccess("success",array("BankName" => $BankName,
                                                           "ModeOfTransfer" => CodeMaster::getData('MODE')));
                                                            
    }
    
    function FranchiseeRefillWallet() {
                                                                            
        global $mysql,$loginInfo;                                                                                                          
       
       
       $id =  $mysql->insert("_tbl_franchisees_refillwallet",array("RefillAmount"     => $_POST['RefillAmount'],
                                                                       "BankName"         => $_POST['BankName'],
                                                                       "DateofBirth"      => $_POST['DateofBirth'],
                                                                       "TransactionID"    => $_POST['TransactionID'],
                                                                       "Remarks"          => $_POST['Remarks']));
                return Response::returnSuccess("success",array());
    }
    
    function ChangePassword(){
         global $mysql,$loginInfo;
              $getpassword = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
              if ($getpassword[0]['LoginPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Currentpassword"); } 
               
              if ($getpassword[0]['LoginPassword']==$_POST['CurrentPassword']) {                                         
                    $mysql->execute("update _tbl_franchisees_staffs set LoginPassword='".$_POST['ConfirmNewPassword']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
                    $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'PasswordChanged.',
                                                             "ActivityString" => 'Password Changed.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
              
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffChangePassword'");
					$content  = str_replace("#FranchiseeName#",$getpassword[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#LoginPassword#",$_POST['ConfirmNewPassword'],$content);

					 MailController::Send(array("MailTo"         => $getpassword[0]['EmailID'],
												"Category"       => "FranchiseeStaffChangePassword",
												"FranchiseeCode" => $getpassword[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					// MobileSMSController::sendSMS($getpassword[0]['MobileNumber']," Dear ".$getpassword[0]['PersonName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPassword']."");  
			  
			  return Response::returnSuccess("Password Changed Successfully",array());
              }
                                                            
    }
	function ChangeTransactionPassword(){
         global $mysql,$loginInfo;
              $getpassword = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
              if ($getpassword[0]['TransactionPassword']!=$_POST['CurrentTransactionPassword']) {
                return Response::returnError("Incorrect Current Transaction Password"); } 
               
              if ($getpassword[0]['TransactionPassword']==$_POST['CurrentTransactionPassword']) {                                         
                    $mysql->execute("update _tbl_franchisees_staffs set TransactionPassword='".$_POST['ConfirmNewTransactionPassword']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
                    $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"   => $loginInfo[0]['FranchiseeID'],
																	"ActivityType"   => 'TransactionPasswordChanged.',
																	"ActivityString" => 'Transaction Password Changed.',
																	"SqlQuery"       => base64_encode($updateSql),
																	//"oldData"      => base64_encode(json_encode($oldData)),
																	"ActivityOn"     => date("Y-m-d H:i:s")));
																	
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeChangeTxnPassword'");
					$content  = str_replace("#FranchiseeName#",$getpassword[0]['PersonName'],$mContent[0]['Content']);
					$content  = str_replace("#TransactionPassword#",$_POST['ConfirmNewTransactionPassword'],$content);

					 MailController::Send(array("MailTo"         => $getpassword[0]['EmailID'],
												"Category"       => "FranchiseeChangeTxnPassword",
												"FranchiseeCode" => $getpassword[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($getpassword[0]['MobileNumber']," Dear ".$getpassword[0]['PersonName'].",Your Transaction Password has been changed successfully. Your new transaction password is ".$_POST['ConfirmNewTransactionPassword']."");  
					
              return Response::returnSuccess("Password Changed Successfully",array());
              }
                                                            
    } 
  function GetDraftProfileInformation() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."' and `RequestToVerify`='0' and `IsApproved`='0'");               
             $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileCode']."'"); 
             $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");    
             $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
             $ProfilePhoto =      $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
             
             $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and ProfileCode='".$_POST['ProfileCode']."'");
             
              if (sizeof($ProfilePhoto)<4) {
                  for($i=sizeof($ProfilePhoto);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                     $ProfilePhoto[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                  }
                  else{
                        $ProfilePhoto[$i]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                  }
                  }  
              }
              
             $ProfilePhotoFirst = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");   
             
             if (sizeof($ProfilePhotoFirst)==0) {
                
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                        }else{
                
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                        }
                   
              } 
             
             return Response::returnSuccess("success",array("ProfileInfo"            => $Profiles[0],
                                                            "ProfilePhotos"          => $ProfilePhoto,
                                                            "ProfilePhotoFirst"      => $ProfilePhotoFirst[0]['ProfilePhoto'],        
                                                            "EducationAttachments"   => $Educationattachments,
                                                            "Documents"              => $Documents,
                                                            "Members"                => $members[0],
                                                            "PartnerExpectation"     => $PartnersExpectations[0], 
                                                            "ProfileSignInFor"       => CodeMaster::getActiveData('PROFILESIGNIN'),
                                                            "Gender"                 => CodeMaster::getActiveData('SEX'),
                                                            "MaritalStatus"          => CodeMaster::getActiveData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getActiveData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getActiveData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getActiveData('CASTNAMES'),
                                                            "Community"              => CodeMaster::getActiveData('COMMUNITY'),
                                                            "Nationality"            => CodeMaster::getActiveData('NATIONALNAMES'),
                                                            "EmployedAs"             => CodeMaster::getActiveData('OCCUPATIONS'),
                                                            "Occupation"             => CodeMaster::getActiveData('Occupation'),
                                                            "TypeofOccupation"       => CodeMaster::getActiveData('TYPEOFOCCUPATIONS'),
                                                            "IncomeRange"            => CodeMaster::getActiveData('INCOMERANGE'),
                                                            "FamilyType"             => CodeMaster::getActiveData('FAMILYTYPE'),
                                                            "FamilyValue"            => CodeMaster::getActiveData('FAMILYVALUE'),
                                                            "FamilyAffluence"        => CodeMaster::getActiveData('FAMILYAFFLUENCE'),
                                                            "NumberofBrother"        => CodeMaster::getActiveData('NUMBEROFBROTHER'),
                                                            "NumberofElderBrother"   => CodeMaster::getActiveData('ELDER'),
                                                            "NumberofYoungerBrother" => CodeMaster::getActiveData('YOUNGER'),
                                                            "NumberofMarriedBrother" => CodeMaster::getActiveData('MARRIED'),
                                                            "NumberofSisters"        => CodeMaster::getActiveData('NOOFSISTER'),
                                                            "NumberofElderSisters"   => CodeMaster::getActiveData('ELDERSIS'),
                                                            "NumberofYoungerSisters" => CodeMaster::getActiveData('YOUNGERSIS'),
                                                            "NumberofMarriedSisters" => CodeMaster::getActiveData('MARRIEDSIS'),
                                                            "PhysicallyImpaired"     => CodeMaster::getActiveData('PHYSICALLYIMPAIRED'),
                                                            "VisuallyImpaired"       => CodeMaster::getActiveData('VISUALLYIMPAIRED'),
                                                            "VissionImpaired"        => CodeMaster::getActiveData('VISSIONIMPAIRED'),
                                                            "SpeechImpaired"         => CodeMaster::getActiveData('SPEECHIMPAIRED'),
                                                            "Height"                 => CodeMaster::getActiveData('HEIGHTS'),
                                                            "Weight"                 => CodeMaster::getActiveData('WEIGHTS'),
                                                            "BloodGroup"             => CodeMaster::getActiveData('BLOODGROUPS'),
                                                            "Complexation"           => CodeMaster::getActiveData('COMPLEXIONS'),
                                                            "BodyType"               => CodeMaster::getActiveData('BODYTYPES'),
                                                            "Diet"                   => CodeMaster::getActiveData('DIETS'),
                                                            "SmookingHabit"          => CodeMaster::getActiveData('SMOKINGHABITS'),
                                                            "DrinkingHabit"          => CodeMaster::getActiveData('DRINKINGHABITS'),
                                                            "DocumentType"           => CodeMaster::getActiveData('DOCTYPES'),
                                                            "CountryName"            => CodeMaster::getActiveData('RegisterAllowedCountries'),
                                                            "RasiName"               => CodeMaster::getActiveData('MONSIGNS'),
                                                            "Lakanam"                => CodeMaster::getActiveData('LAKANAM'),
                                                            "StarName"               => CodeMaster::getActiveData('STARNAMES'),
                                                            "AllCountryName"        => CodeMaster::getActiveData('CONTNAMES'),
                                                            "Education"              => CodeMaster::getActiveData('EDUCATETITLES'),
                                                            "ParentsAlive"              => CodeMaster::getActiveData('PARENTSALIVE'),
                                                            "ChevvaiDhosham"              => CodeMaster::getActiveData('CHEVVAIDHOSHAM'),
                                                            "PrimaryPriority"              => CodeMaster::getActiveData('PRIMARYPRIORITY'),
                                                            "StateName"              => CodeMaster::getActiveData('STATNAMES')));
         }   
          
    function EditDraftGeneralInformation() {
             
             global $mysql, $loginInfo;
			 
			 $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
            $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $MotherTongue   = CodeMaster::getData("LANGUAGENAMES",$_POST['Language']); 
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Community      = CodeMaster::getData("COMMUNITY",$_POST['Community']);  
             $Nationality    = CodeMaster::getData("NATIONALNAMES",$_POST['Nationality']);  
             $Childrens     = CodeMaster::getData("NUMBEROFBROTHER",$_POST['HowManyChildren']); 
             
             $updateSql =  "update `_tbl_draft_profiles` set`MaritalStatusCode` = '".$_POST['MaritalStatus']."',
                                                           `MaritalStatus`     = '".trim($MaritalStatus[0]['CodeValue'])."',
                                                           `ChildrenCode`      ='0',     
                                                           `Children`          ='0',
                                                           `IsChildrenWithyou` ='0',
                                                           `MotherTongueCode`  = '".$_POST['Language']."',
                                                           `MotherTongue`      = '".trim($MotherTongue[0]['CodeValue'])."', 
                                                           `ReligionCode`      = '".$_POST['Religion']."',
                                                           `OtherReligion`     = '',
                                                           `Religion`          = '".trim($Religion[0]['CodeValue'])."',
                                                           `CasteCode`         = '".$_POST['Caste']."',
                                                           `Caste`             = '".trim($Caste[0]['CodeValue'])."',
                                                           `OtherCaste`        = '', 
                                                           `SubCaste`          = '".$_POST['SubCaste']."',
                                                           `CommunityCode`     = '".$_POST['Community']."',  
                                                           `Community`         = '".trim($Community[0]['CodeValue'])."',
                                                           `NationalityCode`   = '".$_POST['Nationality']."',   
                                                           `Nationality`        = '".trim($Nationality[0]['CodeValue'])."',
														   `mainEducation`     = '".$_POST['MainEducation']."',
                                                           `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                           `AboutMe`           = '".$_POST['AboutMe']."'";  
                if ($_POST['Religion']=="RN009") {
                    $DuplicateReligionNames = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='RELINAMES' and CodeValue='".trim($_POST['ReligionOthers'])."'");
                    if (sizeof($DuplicateReligionNames)>0) {
                        return Response::returnError("Religion Already Exists");    
                    }
                $updateSql .= " ,OtherReligion ='".$_POST['ReligionOthers']."'";
                }
                if ($_POST['Caste']=="CSTN248") {
                    $DuplicateCasteName = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='CASTNAMES' and CodeValue='".trim($_POST['OtherCaste'])."'");
                    if (sizeof($DuplicateCasteName)>0) {
                        return Response::returnError("Caste  Already Exists");    
                    }
                $updateSql .= " ,OtherCaste ='".$_POST['OtherCaste']."'";
                }
                                
             if ($_POST['MaritalStatus'] != "MST001") {
                 if($_POST['HowManyChildren']==-1){
                 return Response::returnError("Please select how many children");
             } else {
                 if ($_POST['HowManyChildren']=="NOB001") {
                     
                 } else {
                 if($_POST['ChildrenWithYou']==-1){
                    return Response::returnError("Please select IsChildrenWithyou");
                }
                 }
             }
            $updateSql .= " ,ChildrenCode ='".$_POST['HowManyChildren']."', Children='".$Childrens[0]['CodeValue']."',IsChildrenWithyou='".$_POST['ChildrenWithYou']."'";
        }
              $updateSql .= "where ProfileCode='".$_POST['ProfileCode']."'";                                                  
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberGeneralinformationupdated.',
                                                             "ActivityString" => 'Member General Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");      
             $Member = $mysql->select("select * from `_tbl_members` where `MemberCode`='".$Profiles[0]['MemberCode']."'");      
			 
			 $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeDraftGInfoUpdate'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
			 
			 $content .= "<table>
								<tr>
									<td>Marital Status</td>
									<td>: Married</td>
								</tr>
							</table>";

             MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                        "Category"       => "FranchiseeDraftGInfoUpdate",
                                        "MemberCode" 	 => $Member[0]['FranchiseeCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             
             return Response::returnSuccess("success",array("ProfileInfo"      => $Profiles[0],
                                                            "ProfileSignInFor" => CodeMaster::getData('PROFILESIGNIN'),
                                                            "Gender"           => CodeMaster::getData('SEX'),
                                                            "MaritalStatus"    => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"         => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"         => CodeMaster::getData('RELINAMES'),
                                                            "Caste"            => CodeMaster::getData('CASTNAMES'),
                                                            "Community"        => CodeMaster::getData('COMMUNITY'),
                                                            "Nationality"      => CodeMaster::getData('NATIONALNAMES')));
         }                                                                                                                           
         function GetViewAttachments() {
             global $mysql,$loginInfo;    
             $SAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['Code']."' and  `IsDelete`='0'");
              $AttachAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0' and `AttachmentID`='".$_POST['AttachmentID']."'");
             return Response::returnSuccess("success",array("Attachments"     =>$SAttachments,
                                                            "AttachAttachments" =>  $AttachAttachments[0],    
                                                            "EducationDetail" => CodeMaster::getData('EDUCATETITLES'),
                                                            "EducationDegree"  => CodeMaster::getData('EDUCATIONDEGREES')));
            
         }
         
         function EditDraftOccupationDetails() {
             
             global $mysql,$loginInfo;
             $EmployedAs       = CodeMaster::getData("OCCUPATIONS",$_POST["EmployedAs"]) ;
             $OccupationType   = CodeMaster::getData("Occupation",$_POST["OccupationType"]) ;
             $TypeofOccupation = CodeMaster::getData("TYPEOFOCCUPATIONS",$_POST["TypeofOccupation"]) ;
             $IncomeRange      = CodeMaster::getData("INCOMERANGE",$_POST["IncomeRange"]) ;
              $Country          = CodeMaster::getData("CONTNAMES",$_POST['WCountry']);
              if ($_POST['EmployedAs']=="O001") {
                 $updateSql = "update `_tbl_draft_profiles` set `EmployedAsCode`        = '".$_POST['EmployedAs']."',
                                                                `EmployedAs`            = '".$EmployedAs[0]['CodeValue']."',
                                                                `OccupationTypeCode`    = '".$_POST['OccupationType']."',
                                                                `OccupationType`        = '".$OccupationType[0]['CodeValue']."',
                                                                `TypeofOccupationCode`  = '".$_POST['TypeofOccupation']."',
                                                                `OccupationDescription` = '".$_POST['OccupationDescription']."',
                                                                `TypeofOccupation`      = '".$TypeofOccupation[0]['CodeValue']."',
                                                                `AnnualIncomeCode`      = '".$_POST['IncomeRange']."',
                                                                `WorkedCountryCode`     = '".$_POST['WCountry']."',
                                                                `WorkedCountry`         = '".$Country[0]['CodeValue']."',
                                                                `WorkedCityName`     = '".$_POST['WorkedCityName']."',
                                                                `OccupationDetails`     = '".$_POST['OccupationDetails']."',
                                                                `LastUpdatedOn`         = '".date("Y-m-d H:i:s")."',
                                                                `AnnualIncome`          = '".$IncomeRange[0]['CodeValue']."'";
                 if (isset($_POST['File'])) {
                    $updateSql .= " , `OccupationAttachFileName`     = '".$_POST['File']."' ";
                 }
              }
                                                            
              if ($_POST['EmployedAs']=="O002") {
                    $updateSql = "update `_tbl_draft_profiles` set  `EmployedAsCode`       ='".$_POST['EmployedAs']."',
                                                                    `EmployedAs`           = '".$EmployedAs[0]['CodeValue']."',
                                                                    `OccupationDetails`   = '".$_POST['OccupationDetails']."',
                                                                    `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."'";
                } 
                if ($_POST['EmployedAs']=="O001" && $_POST['OccupationType']=="OT112") {
                    $DuplicateOccupationType = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='OCCUPATIONTYPES' and `CodeValue`='".trim($_POST['OtherOccupation'])."'");
                    if (sizeof($DuplicateOccupationType)>0) {
                        return Response::returnError("Occupation Already Exists");    
                    }
                $updateSql .= " ,OtherOccupation ='".$_POST['OtherOccupation']."'";
                }
                
                 $updateSql .= " where `ProfileCode`='".$_POST['Code']."'";
             
             $mysql->execute($updateSql);  
             
             //`OccupationAttachmentType`     = '".(isset($_POST['OccupationAttachmentType'])?$_POST['OccupationAttachmentType'] : '0')."',
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberOccupationdetailsupdated.',
                                                             "ActivityString" => 'Member Occupation Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),              
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");      
            
             
             return Response::returnSuccess("success",array("ProfileInfo"      => $Profiles[0],
                                                            "EmployedAs"       => CodeMaster::getData('OCCUPATIONS'),
                                                            "Occupation"       => CodeMaster::getData('OCCUPATIONTYPES'),
                                                            "TypeofOccupation" => CodeMaster::getData('TYPEOFOCCUPATIONS'),
                                                            "IncomeRange"      => CodeMaster::getData('INCOMERANGE')));
         }                                                              
         function GetPartnersExpectaionInformation() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");
             $PartnersExpectation = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where ProfileCode='".$_POST['ProfileCode']."'");               
             return Response::returnSuccess("success",array("ProfileInfo"            =>$PartnersExpectation[0],
                                                            "MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "RasiName"              => CodeMaster::getData('MONSIGNS'),
                                                            "StarName"              => CodeMaster::getData('STARNAMES'),
                                                            "ChevvaiDhosham"              => CodeMaster::getData('CHEVVAIDHOSHAM'),
                                                            "EmployedAs"              => CodeMaster::getData('Occupation')));
         }
         function AddPartnersExpectaion() {

             global $mysql,$loginInfo;    

              $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",explode(",",$_POST['MaritalStatus']));
             $Religion       = CodeMaster::getData("RELINAMES",explode(",",$_POST['Religion'])); 
             $Caste          = CodeMaster::getData("CASTNAMES",explode(",",$_POST['Caste']));  
             $Education      = CodeMaster::getData("EDUCATETITLES",explode(",",$_POST['Education']));  
             $EmployedAs     = CodeMaster::getData("Occupation",explode(",",$_POST["EmployedAs"])) ;
             $IncomeRange    = CodeMaster::getData("INCOMERANGE",explode(",",$_POST["IncomeRange"])) ;
             $RasiName       = CodeMaster::getData("MONSIGNS",explode(",",$_POST["RasiName"])) ;
             $StarName       = CodeMaster::getData("STARNAMES",explode(",",$_POST["StarName"])) ;
             $ChevvaiDhosham       = CodeMaster::getData("CHEVVAIDHOSHAM",$_POST["ChevvaiDhosham"]) ;
             
              $MaritalStatus_CodeValue="";
             foreach($MaritalStatus as $M) {
               $MaritalStatus_CodeValue .= $M['CodeValue'].", ";  
             }
             $Religion_CodeValue="";
             foreach($Religion as $R) {
               $Religion_CodeValue .= $R['CodeValue'].", ";  
             }
             $Caste_CodeValue="";
             foreach($Caste as $C) {
               $Caste_CodeValue .= $C['CodeValue'].", ";  
             }
             $Education_CodeValue="";
             foreach($Education as $E) {
               $Education_CodeValue .= $E['CodeValue'].", ";  
             }
             $IncomeRange_CodeValue="";
             foreach($IncomeRange as $I) {
               $IncomeRange_CodeValue .= $I['CodeValue'].", ";  
             }
             $EmployedAs_CodeValue="";
             foreach($EmployedAs as $EM) {
               $EmployedAs_CodeValue .= $EM['CodeValue'].", ";  
             }
             $RasiName_CodeValue="";
             foreach($RasiName as $RA) {
               $RasiName_CodeValue .= $RA['CodeValue'].", ";  
             }
             $StarName_CodeValue="";
             foreach($StarName as $ST) {
               $StarName_CodeValue .= $ST['CodeValue'].", ";  
             }
             
               $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");
             $check =  $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where ProfileCode='".$_POST['Code']."'");                      
             if (sizeof($check)>0) {
                  $updateSql = "update `_tbl_draft_profiles_partnerexpectation` set `AgeFrom`           = '".$_POST['age']."',
                                                                                   `AgeTo`             = '".$_POST['toage']."',
                                                                                   `MaritalStatusCode` = '".$_POST['MaritalStatus']."',
                                                                                   `MaritalStatus`     = '".substr($MaritalStatus_CodeValue,0,strlen($MaritalStatus_CodeValue)-2)."',
                                                                                   `ReligionCode`      = '".$_POST['Religion']."',
                                                                                   `Religion`          = '".substr($Religion_CodeValue,0,strlen($Religion_CodeValue)-2)."',
                                                                                   `CasteCode`         = '".$_POST['Caste']."',
                                                                                   `Caste`             = '".substr($Caste_CodeValue,0,strlen($Caste_CodeValue)-2)."',
                                                                                   `EducationCode`     = '".$_POST['Education']."',
                                                                                   `Education`         = '".substr($Education_CodeValue,0,strlen($Education_CodeValue)-2)."',
                                                                                   `AnnualIncomeCode`  = '".$_POST['IncomeRange']."',
                                                                                   `AnnualIncome`      = '".substr($IncomeRange_CodeValue,0,strlen($IncomeRange_CodeValue)-2)."',
                                                                                   `EmployedAsCode`    = '".$_POST['EmployedAs']."',
                                                                                   `EmployedAs`        = '".substr($EmployedAs_CodeValue,0,strlen($EmployedAs_CodeValue)-2)."',
                                                                                   `RasiNameCode`      = '".$_POST['RasiName']."',
                                                                                   `RasiName`          = '".substr($RasiName_CodeValue,0,strlen($RasiName_CodeValue)-2)."',
                                                                                   `StarNameCode`      = '".$_POST['StarName']."',
                                                                                   `StarName`          = '".substr($StarName_CodeValue,0,strlen($StarName_CodeValue)-2)."',
                                                                                   `ChevvaiDhoshamCode`= '".$_POST['ChevvaiDhosham']."',
                                                                                   `ChevvaiDhosham`    = '".$ChevvaiDhosham[0]['CodeValue']."',
                                                                                   `Details`           = '".$_POST['Details']."' where  `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             } else {
          $id = $mysql->insert("_tbl_draft_profiles_partnerexpectation",array("AgeFrom"           => $_POST['age'],
                                                                             "AgeTo"             => $_POST['toage'],
                                                                             "MaritalStatusCode" => $_POST['MaritalStatus'],
                                                                             "MaritalStatus"     => substr($MaritalStatus_CodeValue,0,strlen($MaritalStatus_CodeValue)-2),
                                                                             "ReligionCode"      => $_POST['Religion'],
                                                                             "Religion"          => substr($Religion_CodeValue,0,strlen($Religion_CodeValue)-2),
                                                                             "CasteCode"         => $_POST['Caste'],
                                                                             "Caste"             => substr($Caste_CodeValue,0,strlen($Caste_CodeValue)-2),
                                                                             "EducationCode"     => $_POST['Education'],
                                                                             "Education"         => substr($Education_CodeValue,0,strlen($Education_CodeValue)-2),
                                                                             "AnnualIncomeCode"  => $_POST['IncomeRange'],
                                                                             "AnnualIncome"      => substr($IncomeRange_CodeValue,0,strlen($IncomeRange_CodeValue)-2),
                                                                             "EmployedAsCode"    => $_POST['EmployedAs'],
                                                                             "EmployedAs"        => substr($EmployedAs_CodeValue,0,strlen($EmployedAs_CodeValue)-2),
                                                                             "RasiNameCode"      => $_POST['RasiName'],
                                                                             "RasiName"          => substr($RasiName_CodeValue,0,strlen($RasiName_CodeValue)-2),
                                                                             "StarNameCode"      => $_POST['StarName'],
                                                                             "StarName"          => substr($StarName_CodeValue,0,strlen($StarName_CodeValue)-2),
                                                                             "ChevvaiDhoshamCode"=>$_POST['ChevvaiDhosham'],
                                                                             "ChevvaiDhosham"    => $ChevvaiDhosham[0]['CodeValue'],
                                                                             "Details"             => $_POST['Details'],
                                                                             "CreatedBy"   => $Profiles[0]['MemberID'],
                                                                             "MemberID"   => $Profiles[0]['MemberID'],
                                                                             "ProfileID"   => $Profiles[0]['ProfileID'],
                                                                             "ProfileCode"         => $_POST['Code'])) ;
             }
            return Response::returnSuccess("Partner's expectations are updated successfully",array());
         }
         
         function EditDraftFamilyInformation() {
             
             global $mysql, $loginInfo;
             
             $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
             $FathersOccupation = CodeMaster::getData("Occupation",$_POST['FathersOccupation']);  
             $FamilyType        = CodeMaster::getData("FAMILYTYPE",$_POST['FamilyType']); 
             $FamilyValue       = CodeMaster::getData("FAMILYVALUE",$_POST['FamilyValue']);
             $FamilyAffluence   = CodeMaster::getData("FAMILYAFFLUENCE",$_POST['FamilyAffluence']);
             $MothersOccupation = CodeMaster::getData("Occupation",$_POST['MothersOccupation']);  
             $NumberofBrothers  = CodeMaster::getData("NUMBEROFBROTHER",$_POST['NumberofBrother']);
             $younger           = CodeMaster::getData("YOUNGER",$_POST['younger']);
             $elder             = CodeMaster::getData("ELDER",$_POST['elder']);
             $married           = CodeMaster::getData("MARRIED",$_POST['married']);
             $NumberofSisters   = CodeMaster::getData("NOOFSISTER",$_POST['NumberofSisters']);
             $elderSister       = CodeMaster::getData("ELDERSIS",$_POST['elderSister']);
             $youngerSister     = CodeMaster::getData("YOUNGERSIS",$_POST['youngerSister']);
             $ms     = CodeMaster::getData("MARRIEDSIS",$_POST['marriedSister']);
            // $FathersAlive     = CodeMaster::getData("PARENTSALIVE",$_POST['FathersAlive']);
            // $MothersAlive     = CodeMaster::getData("PARENTSALIVE",$_POST['MothersAlive']);
             $MothersIncome     = CodeMaster::getData("INCOMERANGE",$_POST['MothersIncome']);
             $FathersIncome     = CodeMaster::getData("INCOMERANGE",$_POST['FathersIncome']);
             
              $Fathersstatus = ($_POST['FathersAlive']=='on' ? 1 : 0);
             $Mothersstatus = ($_POST['MothersAlive']=='on' ? 1 : 0);
             
              if($NumberofBrothers[0]['CodeValue']>0){
           
                 if($NumberofBrothers[0]['CodeValue'] != ($elder[0]['CodeValue'] + $younger[0]['CodeValue'])) {
                      return Response::returnError("Please select equal to number of brothers");
                 }
             }
             if($NumberofSisters[0]['CodeValue']>0){
           
                 if($NumberofSisters[0]['CodeValue'] != ($elderSister[0]['CodeValue'] + $youngerSister[0]['CodeValue'])) {
                      return Response::returnError("Please select equal to number of sisters");
                 }
             }
             $updateSql = "update `_tbl_draft_profiles` set `FathersName`          = '".$_POST['FatherName']."',
                                                           `FathersOccupationCode` = '".$_POST['FathersOccupation']."',
                                                           `FathersOccupation`     = '".$FathersOccupation[0]['CodeValue']."',
                                                           `FatherOtherOccupation`     = '',
                                                           `FathersContactCountryCode` = '".$_POST['FathersContactCountryCode']."',
                                                           `FathersContact`        = '".$_POST['FathersContact']."',
                                                           `FathersIncomeCode`     = '".$_POST['FathersIncome']."',
                                                           `FathersIncome`         = '".$FathersIncome[0]['CodeValue']."',
                                                           `FathersAlive`          = '".$Fathersstatus."',
                                                           `MothersName`           = '".$_POST['MotherName']."',
                                                           `MothersContactCountryCode`= '".$_POST['MotherContactCountryCode']."',
                                                           `MothersContact`        = '".$_POST['MotherContact']."',
                                                           `MothersIncomeCode`     = '".$_POST['MothersIncome']."',
                                                           `MothersIncome`         = '".$MothersIncome[0]['CodeValue']."',
                                                           `MothersAlive`          = '".$Mothersstatus."',
                                                           `FamilyLocation1`       = '".$_POST['FamilyLocation1']."',
                                                           `FamilyLocation2`       = '".$_POST['FamilyLocation2']."',
                                                           `Ancestral`             = '".$_POST['Ancestral']."',
                                                           `FamilyTypeCode`        = '".$_POST['FamilyType']."',
                                                           `FamilyType`            = '".$FamilyType[0]['CodeValue']."',              
                                                           `FamilyValueCode`       = '".$_POST['FamilyValue']."',
                                                           `FamilyValue`           = '".$FamilyValue[0]['CodeValue']."',
                                                           `FamilyAffluenceCode`   = '".$_POST['FamilyAffluence']."',
                                                           `FamilyAffluence`       = '".$FamilyAffluence[0]['CodeValue']."',
                                                           `AboutMyFamily`         = '".$_POST['AboutMyFamily']."',
                                                           `MothersOccupationCode` = '".$_POST['MothersOccupation']."',
                                                           `MothersOccupation`     = '".$MothersOccupation[0]['CodeValue']."',
                                                           `MotherOtherOccupation` = '',
                                                           `NumberofBrothersCode`  = '".$_POST['NumberofBrother']."',
                                                           `NumberofBrothers`      = '".$NumberofBrothers[0]['CodeValue']."',
                                                           `YoungerCode`           = '".$_POST['younger']."',                    
                                                           `Younger`               = '".$younger[0]['CodeValue']."',
                                                           `ElderCode`             = '".$_POST['elder']."',
                                                           `Elder`                 = '".$elder[0]['CodeValue']."',
                                                           `MarriedCode`           = '".$_POST['married']."',
                                                           `Married`               = '".$married[0]['CodeValue']."',
                                                           `NumberofSistersCode`   = '".$_POST['NumberofSisters']."',
                                                           `NumberofSisters`       = '".$NumberofSisters[0]['CodeValue']."',
                                                           `ElderSisterCode`       = '".$_POST['elderSister']."',
                                                           `ElderSister`           = '".$elderSister[0]['CodeValue']."',
                                                           `YoungerSisterCode`     = '".$_POST['youngerSister']."',
                                                           `YoungerSister`         = '".$youngerSister[0]['CodeValue']."',
                                                           `MarriedSisterCode`     = '".$_POST['marriedSister']."',
                                                           `LastUpdatedOn`         = '".date("Y-m-d H:i:s")."',
                                                           `MarriedSister`         = '".$ms[0]['CodeValue']."'";
                                                           
             if ($_POST['FathersOccupation']=="OT112") {
                    $DuplicateFathersOccupationType = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='OCCUPATIONTYPES' and `CodeValue`='".trim($_POST['FatherOtherOccupation'])."'");
                    if (sizeof($DuplicateFathersOccupationType)>0) {
                        return Response::returnError("Fathers Occupation Already Exists");    
                    }
                $updateSql .= " ,`FatherOtherOccupation`     = '".$_POST['FatherOtherOccupation']."'";
                }
             if ($_POST['MothersOccupation']=="OT112") {
                    $DuplicateMothersOccupationType = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='OCCUPATIONTYPES' and `CodeValue`='".trim($_POST['MotherOtherOccupation'])."'");
                    if (sizeof($DuplicateMothersOccupationType)>0) {
                        return Response::returnError("Mothers Occupation Already Exists");    
                    }
                $updateSql .= " ,`MotherOtherOccupation`     = '".$_POST['MotherOtherOccupation']."'";
                }
             
              $updateSql .= " where ProfileCode='".$_POST['ProfileCode']."'";
             $mysql->execute($updateSql);
             
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");  
              $Member = $mysql->select("select * from `_tbl_members` where `MemberCode`='".$Profiles[0]['MemberCode']."'");    
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeDraftFInfoUpdate'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             
             $content .= "<table>
                                <tr>
                                       <td>Fathers Name</td>                    
                                       <td>Fathers Occupation Code</td>         
                                       <td>FathersOccupation</td>         
                                       <td>FathersOccupation</td>     
                                       <td>FathersContactCountryCode</td> 
                                       <td>FathersContact</td>        
                                       <td>FathersIncomeCode</td>     
                                       <td>FathersIncome</td>         
                                       <td>FathersAlive</td>          
                                       <td>MothersName</td>           
                                       <td>MothersContactCountryCode</td>
                                       <td>MothersContact</td>        
                                       <td>MothersIncomeCode</td>     
                                       <td>MothersIncome</td>         
                                       <td>MothersAlive</td>          
                                       <td>FamilyLocation1</td>       
                                       <td>FamilyLocation2</td>       
                                       <td>Ancestral</td>             
                                       <td>FamilyTypeCode</td>        
                                       <td>FamilyType</td>                         
                                       <td>FamilyValueCode</td>       
                                       <td>FamilyValue</td>           
                                       <td>FamilyAffluenceCode</td>   
                                       <td>FamilyAffluence</td>       
                                       <td>AboutMyFamily</td>         
                                       <td>MothersOccupationCode</td> 
                                       <td>MothersOccupation</td>     
                                       <td>MotherOtherOccupation</td> 
                                       <td>NumberofBrothersCode</td>  
                                       <td>NumberofBrothers</td>      
                                       <td>YoungerCode</td>                            
                                       <td>Younger</td>               
                                       <td>ElderCode</td>             
                                       <td>Elder</td>                 
                                       <td>MarriedCode</td>           
                                       <td>Married</td>               
                                       <td>NumberofSistersCode</td>   
                                       <td>NumberofSisters</td>      
                                       <td>ElderSisterCode</td>       
                                       <td>ElderSister</td>           
                                       <td>YoungerSisterCode</td>     
                                       <td>YoungerSister</td>         
                                       <td>MarriedSisterCode</td>     
                                       <td>MarriedSister</td>         
                                </tr>
                                <tr>
                                                   
                                       <td>".$_POST['FatherName']."</td>
                                       <td>".$_POST['FathersOccupation']."</td>
                                       <td>".$FathersOccupation[0]['CodeValue']."</td>
                                       <td>".$FathersOccupation[0]['CodeValue']."</td>
                                       <td>".$_POST['FathersContactCountryCode']."</td>
                                       <td>".$_POST['FathersContact']."</td>
                                       <td>".$_POST['FathersIncome']."</td>
                                       <td>".$FathersIncome[0]['CodeValue']."</td>
                                       <td>".$Fathersstatus."</td>
                                       <td>".$_POST['MotherName']."</td>
                                       <td>".$_POST['MotherContactCountryCode']."</td>
                                       <td>".$_POST['MotherContact']."</td>
                                       <td>".$_POST['MothersIncome']."</td>
                                       <td>".$MothersIncome[0]['CodeValue']."</td>
                                       <td>".$Mothersstatus."</td>
                                       <td>".$_POST['FamilyLocation1']."</td>
                                       <td>".$_POST['FamilyLocation2']."</td>
                                       <td>".$_POST['Ancestral']."</td>
                                       <td>".$_POST['FamilyType']."</td>
                                       <td>".$FamilyType[0]['CodeValue']."</td>              
                                       <td>".$_POST['FamilyValue']."</td>
                                       <td>".$FamilyValue[0]['CodeValue']."</td>
                                       <td>".$_POST['FamilyAffluence']."</td>
                                       <td>".$FamilyAffluence[0]['CodeValue']."</td>
                                       <td>".$_POST['AboutMyFamily']."</td>
                                       <td>".$_POST['MothersOccupation']."</td>
                                       <td>".$MothersOccupation[0]['CodeValue']."</td>
                                       <td>'' </td>
                                       <td>".$_POST['NumberofBrother']."</td>
                                       <td>".$NumberofBrothers[0]['CodeValue']."</td>
                                       <td>".$_POST['younger']."</td>                    
                                       <td>".$younger[0]['CodeValue']."</td>
                                       <td>".$_POST['elder']."</td>
                                       <td>".$elder[0]['CodeValue']."</td>
                                       <td>".$_POST['married']."</td>
                                       <td>".$married[0]['CodeValue']."</td>
                                       <td>".$_POST['NumberofSisters']."</td>
                                       <td>".$NumberofSisters[0]['CodeValue']."</td>
                                       <td>".$_POST['elderSister']."</td>
                                       <td>".$elderSister[0]['CodeValue']."</td>
                                       <td>".$_POST['youngerSister']."'
                                       <td>".$youngerSister[0]['CodeValue']."</td>
                                       <td>".$_POST['marriedSister']."</td>
                                       <td>".$ms[0]['CodeValue']."</td>
                                </tr>
                            </table>";

             MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                        "Category"       => "FranchiseeDraftFInfoUpdate",
                                        "MemberCode"      => $Member[0]['MemberCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             
             
             $id = $mysql->insert("_tbl_logs_activity",array("Franchisee"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberFamilyinformationupdated.',
                                                             "ActivityString" => 'Member Family Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 
      
             return Response::returnSuccess("success",array("ProfileInfo"            => $Profiles[0],
                                                            "Occupation"             => CodeMaster::getData('Occupation'),
                                                            "FamilyType"             => CodeMaster::getData('FAMILYTYPE'),
                                                            "FamilyValue"            => CodeMaster::getData('FAMILYVALUE'),
                                                            "FamilyAffluence"        => CodeMaster::getData('FAMILYAFFLUENCE'),
                                                            "NumberofBrother"        => CodeMaster::getData('NUMBEROFBROTHER'),
                                                            "NumberofElderBrother"   => CodeMaster::getData('ELDER'),
                                                            "NumberofYoungerBrother" => CodeMaster::getData('YOUNGER'),
                                                            "NumberofMarriedBrother" => CodeMaster::getData('MARRIED'),
                                                            "NumberofSisters"        => CodeMaster::getData('NOOFSISTER'),
                                                            "NumberofElderSisters"   => CodeMaster::getData('ELDERSIS'),
                                                            "NumberofYoungerSisters" => CodeMaster::getData('YOUNGERSIS'),
                                                            "NumberofMarriedSisters" => CodeMaster::getData('MARRIEDSIS')));
         }
         function EditDraftPhysicalInformation() {
             
             global $mysql,$loginInfo;
             
              $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
             $PhysicallyImpaired = CodeMaster::getData("PHYSICALLYIMPAIRED",$_POST['PhysicallyImpaired']); 
             $VisuallyImpaired   = CodeMaster::getData("VISUALLYIMPAIRED",$_POST['VisuallyImpaired']); 
             $VissionImpaired    = CodeMaster::getData("VISSIONIMPAIRED",$_POST['VissionImpaired']);
             $SpeechImpaired     = CodeMaster::getData("SPEECHIMPAIRED",$_POST['SpeechImpaired']);
             $Height             = CodeMaster::getData("HEIGHTS",$_POST['Height']);
             $Weight             = CodeMaster::getData("WEIGHTS",$_POST['Weight']);
             $BloodGroup         = CodeMaster::getData("BLOODGROUPS",$_POST['BloodGroup']);
             $Complexation       = CodeMaster::getData("COMPLEXIONS",$_POST['Complexation']);
             $BodyType           = CodeMaster::getData("BODYTYPES",$_POST['BodyType']);
             $Diet               = CodeMaster::getData("DIETS",$_POST['Diet']);
             $SmookingHabit      = CodeMaster::getData("SMOKINGHABITS",$_POST['SmookingHabit']);
             $DrinkingHabit      = CodeMaster::getData("DRINKINGHABITS",$_POST['DrinkingHabit']);
             
             $updateSql = "update `_tbl_draft_profiles` set `PhysicallyImpairedCode` = '".$_POST['PhysicallyImpaired']."',
                                                           `PhysicallyImpaired`     = '".$PhysicallyImpaired[0]['CodeValue']."',
                                                           `PhysicallyImpaireddescription`     = '".$_POST['PhysicallyImpairedDescription']."',
                                                           `VisuallyImpairedCode`   = '".$_POST['VisuallyImpaired']."',
                                                           `VisuallyImpairedDescription`       = '".$_POST['VisuallyImpairedDescription']."',
                                                           `VisuallyImpaired`       = '".$VisuallyImpaired[0]['CodeValue']."', 
                                                           `VissionImpairedCode`    = '".$_POST['VissionImpaired']."',
                                                           `VissionImpairedDescription`        = '".$_POST['VissionImpairedDescription']."',
                                                           `VissionImpaired`        = '".$VissionImpaired[0]['CodeValue']."',
                                                           `SpeechImpairedCode`     = '".$_POST['SpeechImpaired']."',
                                                           `SpeechImpaired`         = '".$SpeechImpaired[0]['CodeValue']."',
                                                           `SpeechImpairedDescription`         = '".$_POST['SpeechImpairedDescription']."',
                                                           `HeightCode`             = '".$_POST['Height']."',
                                                           `Height`                 = '".$Height[0]['CodeValue']."',
                                                           `WeightCode`             = '".$_POST['Weight']."',
                                                           `Weight`                 = '".$Weight[0]['CodeValue']."',
                                                           `BloodGroupCode`         = '".$_POST['BloodGroup']."',
                                                           `BloodGroup`             = '".$BloodGroup[0]['CodeValue']."',
                                                           `ComplexationCode`       = '".$_POST['Complexation']."',
                                                           `Complexation`           = '".$Complexation[0]['CodeValue']."',
                                                           `BodyTypeCode`           = '".$_POST['BodyType']."',
                                                           `BodyType`               = '".$BodyType[0]['CodeValue']."',
                                                           `DietCode`               = '".$_POST['Diet']."',
                                                           `Diet`                   = '".$Diet[0]['CodeValue']."',
                                                           `SmokingHabitCode`       = '".$_POST['SmookingHabit']."',
                                                           `SmokingHabit`           = '".$SmookingHabit[0]['CodeValue']."',
                                                           `DrinkingHabitCode`      = '".$_POST['DrinkingHabit']."',
                                                           `PhysicalDescription`       = '".$_POST['PhysicalDescription']."',
                                                           `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                           `DrinkingHabit`          = '".$DrinkingHabit[0]['CodeValue']."' where ProfileCode='".$_POST['ProfileCode']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberPhysicalinformationupdated.',
                                                             "ActivityString" => 'Member Physical Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");    
             
             $Member = $mysql->select("select * from `_tbl_members` where `MemberCode`='".$Profiles[0]['MemberCode']."'");    
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeDraftPInfoUpdate'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             
             $content .= "<table>
                                <tr>
                                       <td>Physically Impaired</td>         
                                       <td>PhysicallyImpaireddescription</td>         
                                       <td>VisuallyImpaired</td>         
                                       <td>VisuallyImpairedDescription</td>         
                                       <td>VissionImpaired</td>         
                                       <td>VissionImpairedDescription</td>         
                                       <td>SpeechImpaired</td>
                                       <td>SpeechImpairedDescription</td> 
                                      <td>Height</td>               
                                       <td>Weight</td>               
                                       <td>BloodGroup</td>           
                                       <td>Complexation</td>          
                                       <td>BodyType</td>           
                                       <td>Diet</td>               
                                       <td>SmokingHabit</td>         
                                       <td>DrinkingHabit</td>         
                                       <td>PhysicalDescription</td>           
                                                
                                </tr>
                                <tr>
                                                   
                                       <td>".$PhysicallyImpaired[0]['CodeValue']."</td>
                                       <td>".$_POST['PhysicallyImpaireddescription']."</td>
                                       <td>".$VisuallyImpaired[0]['CodeValue']."</td>
                                       <td>".$_POST['VisuallyImpairedDescription']."</td>
                                       <td>".$VissionImpaired[0]['CodeValue']."</td>
                                       <td>".$_POST['VissionImpairedDescription']."</td>
                                       <td>".$SpeechImpaired[0]['CodeValue']."</td>
                                       <td>".$_POST['SpeechImpairedDescription']."</td>
                                       <td>".$Height[0]['CodeValue']."</td>
                                       <td>".$Weight[0]['CodeValue']."</td>
                                       <td>".$BloodGroup[0]['CodeValue']."</td>
                                       <td>".$Complexation[0]['CodeValue']."</td>
                                       <td>".$BodyType[0]['CodeValue']."</td>
                                       <td>".$Diet[0]['CodeValue']."</td>
                                       <td>".$SmookingHabit[0]['CodeValue']."</td>
                                       <td>".$DrinkingHabit[0]['CodeValue']."</td>
                                       <td>".$_POST['PhysicalDescription']."</td>
                                     
                                </tr>
                            </table>";

             MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                        "Category"       => "FranchiseeDraftPInfoUpdate",
                                        "MemberCode"      => $Member[0]['MemberCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
               
             
             return Response::returnSuccess("success",array("ProfileInfo"        => $Profiles[0],
                                                            "PhysicallyImpaired" => CodeMaster::getData('PHYSICALLYIMPAIRED'),
                                                            "VisuallyImpaired"   => CodeMaster::getData('VISUALLYIMPAIRED'),
                                                            "VissionImpaired"    => CodeMaster::getData('VISSIONIMPAIRED'),
                                                            "SpeechImpaired"     => CodeMaster::getData('SPEECHIMPAIRED'),
                                                            "Height"             => CodeMaster::getData('HEIGHTS'),
                                                            "Weight"             => CodeMaster::getData('WEIGHTS'),
                                                            "BloodGroup"         => CodeMaster::getData('BLOODGROUPS'),
                                                            "Complexation"       => CodeMaster::getData('COMPLEXIONS'),
                                                            "BodyType"           => CodeMaster::getData('BODYTYPES'),
                                                            "Diet"               => CodeMaster::getData('DIETS'),
                                                            "SmookingHabit"      => CodeMaster::getData('SMOKINGHABITS'),
                                                            "DrinkingHabit"      => CodeMaster::getData('DRINKINGHABITS')));
         }
          function AttachDocuments() {

             global $mysql,$loginInfo;   

             $photos = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0' and Type='IDProof'");
             $profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");

             $DocumentType      = CodeMaster::getData("DOCTYPES",$_POST['Documents']) ;

             if (isset($_POST['File'])) {
             
             if(sizeof($photos)<2){
                     if ((strlen(trim($_POST['Documents']))==0 || $_POST['Documents']=="0" )) {
                return Response::returnError("Please select Document Type",$photos);
             }
             
             $data = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where  `DocumentTypeCode`='".$_POST['Documents']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             if (sizeof($data)>0) {
                return Response::returnError("Document type already attached",$photos);
             }
             $data = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where  `AttachFileName`='".$_POST['File']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             if (sizeof($data)>0) {
                return Response::returnError("Document  Already attached",$photos);
             }
                     $mysql->insert("_tbl_draft_profiles_verificationdocs",array("DocumentTypeCode"  => $_POST['Documents'],
                                                                    "DocumentType"      => $DocumentType[0]['CodeValue'],
                                                                    "AttachedOn"        => date("Y-m-d H:i:s"),
                                                                    "AttachFileName"    => $_POST['File'],
                                                                    "Type"              =>'IDProof',
                                                                    "ProfileID"         => $profiles[0]['ProfileID'],
                                                                    "ProfileCode"         => $_POST['Code'],
                                                                    "MemberID"          => $profiles[0]['MemberID']));
                 } else {                                                                  
                     return Response::returnError("Only 2 phots allowed",$photos);
                 }
             }
             $photos = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$profiles[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0' and Type='IDProof'");
             return Response::returnSuccess("Your Document Information has successfully updated and waiting for verification",$photos);
         }

         function EditDraftCommunicationDetails() {
             
             global $mysql,$loginInfo;
             
               $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
             $Country = CodeMaster::getData("CONTNAMES",$_POST['Country']);
             $State   = CodeMaster::getData("STATNAMES",$_POST['StateName']);
             
             $updateSql = "update `_tbl_draft_profiles` set `ContactPersonName`        = '".$_POST['ContactPersonName']."',
                                                            `Relation`        = '".$_POST['Relation']."',
                                                            `PrimaryPriority`        = '".$_POST['PrimaryPriority']."',
                                                            `EmailID`        = '".$_POST['EmailID']."',
                                                            `MobileNumber`   = '".$_POST['MobileNumber']."',
                                                            `MobileNumberCountryCode`   = '".$_POST['MobileNumberCountryCode']."',
                                                            `WhatsappNumber` = '".$_POST['WhatsappNumber']."',
                                                            `WhatsappCountryCode` = '".$_POST['WhatsappCountryCode']."',
                                                            `AddressLine1`   = '".$_POST['AddressLine1']."',
                                                            `AddressLine2`   = '".$_POST['AddressLine2']."',
                                                            `AddressLine3`   = '".$_POST['AddressLine3']."',
                                                            `CountryCode`    = '".$_POST['Country']."',
                                                            `Country`        = '".$Country[0]['CodeValue']."',
                                                            `StateCode`      = '".$_POST['StateName']."',
                                                            `State`          = '".$State[0]['CodeValue']."',
                                                            `City`           = '".$_POST['City']."',
                                                            `Pincode`        = '".$_POST['Pincode']."',
                                                            `CommunicationDescription`        = '".$_POST['CommunicationDescription']."',
                                                            `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                            `OtherLocation`  = '".$_POST['OtherLocation']."' where `ProfileCode`='".$_POST['ProfileCodeCode']."'";
             $mysql->execute($updateSql);  
             
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");
             $Member = $mysql->select("select * from `_tbl_members` where `MemberCode`='".$Profiles[0]['MemberCode']."'");    
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeDraftCDInfoUpdate'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             
             $content .= "<table>
                                <tr>
                                       <td>ContactPersonName</td>         
                                       <td>Relation</td>         
                                       <td>PrimaryPriority</td>         
                                       <td>EmailID</td>         
                                       <td>MobileNumber</td>         
                                       <td>WhatsappNumber</td>         
                                       <td>AddressLine1</td>
                                       <td>AddressLine2</td> 
                                      <td>AddressLine3</td>               
                                       <td>Country</td>               
                                       <td>State</td>           
                                       <td>City</td>          
                                       <td>OtherLocation</td>           
                                       <td>PinCode</td>           
                                       <td>CommunicationDescription</td>           
                                </tr>
                                <tr>
                                                   
                                       <td>".$_POST['ContactPersonName']."</td>
                                       <td>".$_POST['Relation']."</td>
                                       <td>".$_POST['PrimaryPriority']."</td>
                                       <td>".$_POST['EmailID']."</td>
                                       <td>".$_POST['MobileNumber']."</td>
                                       <td>".$_POST['WhatsappNumber']."</td>
                                       <td>".$_POST['AddressLine1']."</td>
                                       <td>".$_POST['AddressLine2']."</td>
                                       <td>".$_POST['AddressLine3']."</td>
                                       <td>".$Country[0]['CodeValue']."</td>
                                       <td>".$State[0]['CodeValue']."</td>
                                       <td>".$_POST['OtherLocation']."</td>
                                       <td>".$_POST['PinCode']."</td>
                                       <td>".$_POST['CommunicationDescription']."</td>
                                     
                                </tr>
                            </table>";

             MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                        "Category"       => "FranchiseeDraftCDInfoUpdate",
                                        "MemberCode"      => $Member[0]['MemberCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"      => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberCommunicationdetailsupdated.',
                                                             "ActivityString" => 'Member Communication Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where`ProfileCode`='".$_POST['Code']."'");      
             
             return Response::returnSuccess("success",array("ProfileInfo" => $Profiles[0],
                                                            "CountryName" => CodeMaster::getData('CONTNAMES'),
                                                            "StateName"   => CodeMaster::getData('STATNAMES')));
         }
         function AddProfilePhoto() {
             
             global $mysql,$loginInfo;   
             
             $ProfileInfo =$mysql->select("select * from `_tbl_draft_profiles` where   `ProfileCode`='".$_POST['Code']."'"); 
             
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where   MemberID='".$ProfileInfo[0]['MemberID']."' and `ProfileCode`='".$ProfileInfo[0]['ProfileCode']."' and `IsDelete`='0'");
             
             if (isset($_POST['ProfilePhoto'])) {
                 if(sizeof($photos)<5){
                     $mysql->insert("_tbl_draft_profiles_photos",array("ProfileID"    => $ProfileInfo[0]['ProfileID'],
                                                                       "ProfileCode"  => $ProfileInfo[0]['ProfileCode'],
                                                                       "MemberID"     => $ProfileInfo[0]['MemberID'],
                                                                       "ProfilePhoto" => $_POST['ProfilePhoto'],   
                                                                       "UpdateOn"     => date("Y-m-d H:i:s")));     
                 } else { 
                     return Response::returnError("Only 5 phots allowed",$photos);
                 }
             }
             
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where `ProfileCode`='".$ProfileInfo[0]['ProfileCode']."' and MemberID='".$ProfileInfo[0]['MemberID']."' and `IsDelete`='0'");
                                       
             return Response::returnSuccess("success",$photos);
         }
         function DeletProfilePhoto() {
             
             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_draft_profiles_photos` set `IsDelete`='1' ,`IsDeletedOn`='".date("Y-m-d H:i:s")."' where `ProfilePhotoID`='".$_POST['ProfilePhotoID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
                 return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected profile photo  has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';
                 
             
         }
         function EditDraftHoroscopeDetails() {
             global $mysql,$loginInfo;
             
             $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
             $StarName  = CodeMaster::getData("STARNAMES",$_POST['StarName']);
             $RasiName  = CodeMaster::getData("MONSIGNS",$_POST['RasiName']);
             $Lakanam   = CodeMaster::getData("LAKANAM",$_POST['Lakanam']);
              $ChevvaiDhosham   = CodeMaster::getData("CHEVVAIDHOSHAM",$_POST['ChevvaiDhosham']);
              $tob = $_POST['hour'].":".$_POST['minute'].":".$_POST['Second'];
             $updateSql = "update `_tbl_draft_profiles` set  `StarNameCode`  = '".$_POST['StarName']."',
                                                            `StarName`      = '".$StarName[0]['CodeValue']."',
                                                            `LakanamCode`   = '".$_POST['Lakanam']."',
                                                            `Lakanam`       = '".$Lakanam[0]['CodeValue']."',
                                                            `RasiNameCode`  = '".$_POST['RasiName']."',
                                                            `RasiName`      = '".$RasiName[0]['CodeValue']."',
                                                            `TimeOfBirth`      = '".$tob."',
                                                            `PlaceOfBirth`      = '".$_POST['PlaceOfBirth']."',
                                                            `ChevvaiDhoshamCode`      = '".$_POST['ChevvaiDhosham']."',
                                                            `ChevvaiDhosham`      = '".$ChevvaiDhosham[0]['CodeValue']."',
                                                            `HoroscopeDetails`      = '".$_POST['HoroscopeDetails']."',
                                                            `R1`            = '".$_POST['RA1']."',
                                                            `R2`            = '".$_POST['RA2']."',
                                                            `R3`            = '".$_POST['RA3']."',
                                                            `R4`            = '".$_POST['RA4']."',
                                                            `R5`            = '".$_POST['RB1']."',
                                                            `R8`            = '".$_POST['RB4']."',
                                                            `R9`            = '".$_POST['RC1']."',
                                                            `R12`            = '".$_POST['RC4']."',
                                                            `R13`            = '".$_POST['RD1']."',
                                                            `R14`            = '".$_POST['RD2']."',
                                                            `R15`            = '".$_POST['RD3']."',
                                                            `R16`            = '".$_POST['RD4']."',
                                                            `A1`            = '".$_POST['A1']."',
                                                            `A2`            = '".$_POST['A2']."',
                                                            `A3`            = '".$_POST['A3']."',
                                                            `A4`            = '".$_POST['A4']."',
                                                            `A5`            = '".$_POST['A5']."',
                                                            `A8`            = '".$_POST['A8']."',
                                                            `A9`            = '".$_POST['A9']."',
                                                            `A12`            = '".$_POST['A12']."',
                                                            `A13`            = '".$_POST['A13']."',
                                                            `A14`            = '".$_POST['A14']."',
                                                            `A15`            = '".$_POST['A15']."',
                                                            `A16`            = '".$_POST['A16']."' where `ProfileCode`='".$_POST['ProfileCode']."'";
             $mysql->execute($updateSql);  
              $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");
             $Member = $mysql->select("select * from `_tbl_members` where `MemberCode`='".$Profiles[0]['MemberCode']."'");    
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeDraftHDInfoUpdate'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             
             $content .= "<table>
                                <tr>
                                       <td>StarName</td>         
                                       <td>Lakanm</td>         
                                       <td>RasiName</td>         
                                       <td>TimeOfBirth</td>         
                                       <td>PlaceOfBirth</td>         
                                       <td>ChevvaiDhosham</td>         
                                       <td>HoroscopeDetails</td>         
                                             
                                </tr>
                                <tr>
                                                   
                                       <td>".$StarName[0]['CodeValue']."</td>
                                       <td>".$Lakanam[0]['CodeValue']."</td>
                                       <td>".$RasiName[0]['CodeValue']."</td>
                                       <td>".$tob."</td>
                                       <td>".$_POST['PlaceOfBirth']."</td>
                                       <td>".$ChevvaiDhosham[0]['CodeValue']."</td>
                                       <td>".$_POST['HoroscopeDetails']."</td>
                                     
                                </tr>
                            </table>";

             MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                        "Category"       => "FranchiseeDraftHDInfoUpdate",
                                        "MemberCode"      => $Member[0]['MemberCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberHoroscopeDetailsUpdated.',
                                                             "ActivityString" => 'Member Horoscope Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");      
             return Response::returnSuccess("success",array("ProfileInfo" => $Profiles[0],
                                                            "StarName"    => CodeMaster::getData('STARNAMES'),
                                                            "RasiName"    => CodeMaster::getData('MONSIGNS'),
                                                            "Lakanam"     => CodeMaster::getData('LAKANAM')));
         }
         function DeletDocumentAttachments() {

             global $mysql,$loginInfo;

             $mysql->execute("update `_tbl_draft_profiles_verificationdocs` set `IsDelete`='1' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'");

                 return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected document has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         function DeleteAttach() {

             global $mysql,$loginInfo;

             $updateSql = "update `_tbl_draft_profiles_education_details` set `IsDelete` = '1' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'Delete Attachment',
                                                             "ActivityString" => 'Delete attachment.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Record has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         
          function DeleteEducationAttachmentOnly() {

             global $mysql,$loginInfo;
                                                                                 
             $ProfileCode= $_POST['ProfileID'];
             $doc= $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['ProfileID']."'");
             $mem= $mysql->select("select * from `_tbl_members` where `MemberID`='".$doc[0]['MemberID']."'");
			
				$updateSql = "update `_tbl_draft_profiles_education_details` set `FileName` = '' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);
             $updateSql = "update `_tbl_draft_profile_education_attachments` set `FileName` = '' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
          
               return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Attachment has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'Member/'.$mem[0]['MemberCode'].'/ProfileEdit/EducationDetails/'.$ProfileCode.'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';                                                

         }
         
         function GetCodeMasterDatas() {
             return Response::returnSuccess("success",array("Gender"        => CodeMaster::getData("SEX"),
                                                            "MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"      => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"         => CodeMaster::getData('CASTNAMES'),
                                                            "Height"        => CodeMaster::getData('HEIGHTS'),
                                                            "Community"     => CodeMaster::getData('COMMUNITY'),
                                                            "Nationality"   => CodeMaster::getData('NATIONALNAMES'),
                                                            "ProfileFor"    => CodeMaster::getData('PROFILESIGNIN'),
                                                            "MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                             "Caste"        => CodeMaster::getData('CASTNAMES'),
                                                            "Education"     => CodeMaster::getData('EDUCATETITLES'),
                                                            "IncomeRange"   => CodeMaster::getData('INCOMERANGE'),
                                                            "EmployedAs"    => CodeMaster::getData('OCCUPATIONS')));
         }
         function CreateProfile() {

             global $mysql,$loginInfo;

             if ((strlen(trim($_POST['ProfileFor']))==0 || $_POST['ProfileFor']=="0" )) {
                return Response::returnError("Please select ProfileFor",array("param"=>"ProfileFor"));
             }
             if (!(strlen(trim($_POST['ProfileName']))>0)) {
                return Response::returnError("Please enter your name",array("param"=>"ProfileName"));
             }
            

             $member= $mysql->select("select * from `_tbl_members` where `MemberCode`='".$_POST['MemberCode']."'");
             
             if($_POST['ProfileFor']=="PSF001" || $_POST['ProfileFor']=="PSF003" || $_POST['ProfileFor']=="PSF005" || $_POST['ProfileFor']=="PSF006"){
                  $SexCode = "SX001";
             }
             if($_POST['ProfileFor']=="PSF002" || $_POST['ProfileFor']=="PSF007" || $_POST['ProfileFor']=="PSF008" || $_POST['ProfileFor']=="PSF009"){
                $SexCode = "SX002";
            }
            if($_POST['ProfileFor']=="PSF004"){
                if($member[0]['Sex']=="Male"){
                    $SexCode = "SX001";
                } else {
                    $SexCode = "SX002";
                }
            }
             
             $ProfileFors   = CodeMaster::getData("PROFILESIGNIN",$_POST["ProfileFor"]);
             $Sex           = CodeMaster::getData("SEX",$SexCode); 
             $ProfileCode   = SeqMaster::GetNextDraftProfileCode();
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
             
             
             
             $id =  $mysql->insert("_tbl_draft_profiles",array("ProfileCode"      => $ProfileCode,
                                                              "ProfileForCode"    => $ProfileFors[0]['SoftCode'],
                                                              "ProfileFor"        => $ProfileFors[0]['CodeValue'],
                                                              "ProfileName"       => trim($_POST['ProfileName']),
                                                              "DateofBirth"       => $dob,        
                                                              "SexCode"           => $Sex[0]['SoftCode'],      
                                                              "Sex"               => $Sex[0]['CodeValue'],      
                                                              "CreatedOn"         => date("Y-m-d H:i:s"),        
                                                              "MemberID"          => $member[0]['MemberID'],
                                                              "MemberCode"        => $member[0]['MemberCode'],
                                                              "CreatedByFranchiseeStaffID" => $loginInfo[0]['FranchiseeStaffID']));
             $sql=$mysql->qry;
             if (sizeof($id)>0) {
                 $mysql->execute("update `_tbl_sequence` set LastNumber=LastNumber+1 where `SequenceFor`='DraftProfile'");
                 return Response::returnSuccess("Profile Created.",array("Code"=>$ProfileCode,"MCode"=>$_POST['MemberCode']));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
                 
             }
         }
         
         function AddEducationalDetails() {
             global $mysql,$loginInfo;
              if (!(trim($_POST['Educationdetails']))>0) {                                                                               
                 return Response::returnError("Please select education details");
             }
             if (!(trim($_POST['EducationDegree']))>0) {                                
                 return Response::returnError("Please select education degree ");
             }
             $data = $mysql->select("select * from `_tbl_draft_profiles_education_details` where  `FileName`='".$_POST['File']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             if (sizeof($data)>0) {
                return Response::returnError("Document  Already attached",$data);
             }
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'");
             if($_POST['EducationDegree']=="Others"){
                 $OtherEducation =  $_POST['OtherEducationDegree'];
             }  
             else {
                  $OtherEducation =  "";
             }
             if ($_POST['EducationDegree']=="Others") {
            $DuplicateEducationDegree = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='EDUCATIONDEGREES' and CodeValue='".trim($_POST['OtherEducationDegree'])."'");
            if (sizeof($DuplicateEducationDegree)>0) {
                return Response::returnError("Education Details Already Exists");    
            }
        }                       
             $id = $mysql->insert("_tbl_draft_profiles_education_details",array("EducationDetails" => $_POST['Educationdetails'],
                                                                  "EducationDegree"  => $_POST['EducationDegree'],
                                                                 "OtherEducationDegree"  => $OtherEducation,
                                                                  "EducationDescription"  => $_POST['EducationDescription'],
                                                                  "FileName"            => $_POST['File'],
                                                                  "ProfileID"        => $profile[0]['ProfileID'],
                                                                  "ProfileCode"        => $_POST['Code'],
                                                                  "MemberID"         => $profile[0]['MemberID']));
             return (sizeof($id)>0) ? Response::returnSuccess("success",$_POST)
                                    : Response::returnError("Access denied. Please contact support");   
         }
          function AddEducationalAttachment() {

             global $mysql,$loginInfo;
             
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'");  
             
             $EducationID= $mysql->select("select * from _tbl_draft_profiles_education_details where ProfileCode='".$_POST['Code']."'");      
             
              $mysql->insert("_tbl_draft_profile_education_attachments",array("EducationAttachmentID" => $EducationID[0]['AttachmentID'],
                                                                            "MemberID"              => $profile[0]['MemberID'],
                                                                            "ProfileID"             => $profile[0]['ProfileID'], 
                                                                            "ProfileCode"           => $profile[0]['Code'], 
                                                                            "FileName"              => $_POST['File'])); 

           $updateSql = "update `_tbl_draft_profiles_education_details` set  `FileName`= '".$_POST['File']."' where `ProfileCode`='".$_POST['Code']."' and `AttachmentID`='".$_POST['AttachmentID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $profile[0]['MemberID'],
                                                             "ActivityType"   => 'EducationAttachmentupdated.',
                                                             "ActivityString" => 'Education Attachment Updated.',                           
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");      

             return Response::returnSuccess("success");
         }
         function ProfilePhotoBringToFront() {

             global $mysql,$loginInfo;
             
             $ProfilePhotoID = $_GET['ProfilePhotoID'];
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst`='0' where `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst` = '1' where `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
          }
/*Submit Profile */
        function SendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {

			global $mysql,$mail,$loginInfo;      
        
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'");
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
                
				$EducationDetails =$mysql->select("Select * from `_tbl_draft_profiles_education_details` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
					if (sizeof($EducationDetails)==0) {
						return Response::returnError("You must Provide Your Education Details.",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"EducationDetails"));
					}
                $Documents =$mysql->select("Select * from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
					if (sizeof($Documents)==0) {
						return Response::returnError("You must upload Documents Details.",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"DocumentAttachment"));
					}
                $ProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
					if (sizeof($ProfilePhoto)==0) {
						return Response::returnError("You must upload Profile photo.",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"ProfilePhoto"));
                }
                $DefaultProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `PriorityFirst`='1' and `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
					if (sizeof($DefaultProfilePhoto)==0) {
						return Response::returnError("You must Select Default Profile photo.",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"ProfilePhoto"));	
				}
                $AboutMyself =$mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
                    if (strlen(trim($AboutMyself[0]['AboutMe']))==0) {
                        if($AboutMyself[0]['ProfileFor']=="Myself"){
                            $About = "about yourself";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Brother"){
                            $About = "about your brother";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Sister"){
							$About = "about your sister";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Daughter"){
							$About = "about your daughter";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Son"){
                            $About = "about your son";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Brother In Law"){
                            $About = "about your brother in law";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Son In Law"){
                            $About = "about your son in law";
                        }
                        if($AboutMyself[0]['ProfileFor']=="Daughter In Law"){
                            $About = "about your daughter in law";
                        } 
					      return Response::returnError("You must enter ".$About.".",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"GeneralInformation"));	
					} 
					if (strlen(trim($AboutMyself[0]['AboutMyFamily']))==0) {
						return Response::returnError("You must enter about your family.",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"FamilyInformation"));	
					}
		    
				if ($reqID=="")      {
					$otp=rand(1000,9999);

					$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishMemberProfile'");
					$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#otp#",$otp,$content);

					MailController::Send(array("MailTo"   => $member[0]['EmailID'],
											   "Category" => "RequestToVerifyPublishMemberProfile",
											   "MemberID" => $member[0]['MemberID'],
                                               "Subject"  => $mContent[0]['Title'],
                                               "Message"  => $content),$mailError);
					MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['ProfileName']." Verification Security Code is ".$otp);

					if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
							"Error. unable to process your request.";
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" 	=>$member[0]['MemberID'],
                                                                                     "RequestSentOn"=>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" 		=>$member[0]['EmailID'],
                                                                                     "SMSTo" 		=>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" 		=>"RequestToVerifyPublishMemberProfile",
                                                                                     "messagedon"   =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");                                                          
                            return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
										<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<div class="form-group">
												<input type="hidden" value="'.$securitycode.'" name="reqId">
													<input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Submit profile for verify</h4> <br>
													<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="col-sm-12">
														<div class="col-sm-3"></div>
														<div class="col-sm-6">
															<input type="text"  class="form-control" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
															<button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
														</div>
														<div class="col-sm-3"></div>
													</div>
													<div class="col-sm-12" style="text-align:center">'.$error.'</div>
												</div>
											</div>                                                                      
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
                    }
				} else {
					$formid = "frmPuplishOTPVerification_".rand(30,3000);
						return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
									<form method="POST" id="'.$formid.'" name="'.$formid.'">
										<div class="form-group">
											<input type="hidden" value="'.$reqID.'" name="reqId">
											<input type="hidden" value="'.$ProfileID.'" name="ProfileID">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Submit profile for verify</h4> <br>
											<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
										</div>
										<div class="form-group">
											<div class="input-group">
												<div class="col-sm-12">
													<div class="col-sm-3"></div>
													<div class="col-sm-6">
														<input type="text"  class="form-control" value="'.$otpdata.'" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
														<button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
													</div>
													<div class="col-sm-3"></div>
											   </div>
												<div class="col-sm-12" style="text-align:center">'.$errormessage.'</div>
											</div>
										</div>
										<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
									</form>                                                                                                       
								</div>'; 
				}
        }
		
        function ProfilePublishOTPVerification() {

            global $mysql,$loginInfo ;
            
            $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
            if (strlen(trim($_POST['PublishOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['PublishOtp']))  {

				$mysql->execute("update `_tbl_draft_profiles` set  `RequestToVerify`      = '1',
																   `RequestVerifyOn`      = '".date("Y-m-d H:i:s")."'
                                                                    where  `MemberID`='".$data[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
																	
				$mysql->insert("_tbl_request_edit",array("MemberID"          	=> $member[0]['MemberID'],
														 "MemberCode"        	=> $member[0]['MemberCode'],
														 "DraftProfileID"    	=> $data[0]['ProfileID'],
														 "DraftProfileCode"  	=> $data[0]['ProfileCode'],
														 "RequestToSubmit"   	=> "1",
														 "RequestToSubmittedOn" => date("Y-m-d H:i:s")));
													 
			
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='SubmitToVerifyPublishMemberProfile'");
				$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
				$content  = str_replace("#ProfileCode#",$data[0]['ProfileCode'],$content);

				MailController::Send(array("MailTo"   => $member[0]['EmailID'],
										   "Category" => "SubmitToVerifyPublishMemberProfile",
										   "MemberID" => $member[0]['MemberID'],
                                           "Subject"  => $mContent[0]['Title'],
                                           "Message"  => $content),$mailError);
				MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." [ ".$data[0]['ProfileCode']." ] Your profile submitted to verify ");
			
				$id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"   => $loginInfo[0]['FranchiseeID'],
																"ActivityType"   => 'RequestToVerifyPublishMemberProfile.',
																"ActivityString" => 'Request To Verify Publish Member Profile.',
																"SqlQuery"       => base64_encode($updateSql),
																//"oldData"      => base64_encode(json_encode($oldData)),
																"ActivityOn"     => date("Y-m-d H:i:s")));
					return Response::returnSuccess("Your profile has been submitted to verify.");
            } else {
                return $this->SendOtpForProfileforPublish("<span style='color:red'>Invalid verification code.</span>",$_POST['PublishOtp'],$_POST['reqId'],$_POST['ProfileID']);
            } 

        }
		
		function ResendSendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {

			global $mysql,$mail,$loginInfo;      
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");  
           
             $resend = $mysql->insert("_tbl_resend",array("MemberID" =>$data[0]['MemberID'],
                                                          "Reason" =>"Resend Profile Publish Verfication Code",
                                                          "ResendOn"=>date("Y-m-d h:i:s"))) ;

            if ($reqID==""){
				
				$otp=rand(1000,9999);
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishMemberProfile'");
				$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
				$content  = str_replace("#otp#",$otp,$content);

				MailController::Send(array("MailTo"   => $member[0]['EmailID'],
										   "Category" => "RequestToVerifyPublishMemberProfile",
                                           "MemberID" => $member[0]['MemberID'],
                                           "Subject"  => $mContent[0]['Title'],
                                           "Message"  => $content),$mailError);
				MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." Verification Security Code is ".$otp);
                                                                                                                          
				if($mailError){
                    return "Mailer Error: " . $mail->ErrorInfo.
						"Error. unable to process your request.";                                                               
                } else {
                    $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" 	 =>$member[0]['MemberID'],
                                                                                  "RequestSentOn"=>date("Y-m-d H:i:s"),
                                                                                  "EmailTo" 	 =>$member[0]['EmailID'],
                                                                                  "SMSTo" 		 =>$member[0]['MobileNumber'],
                                                                                  "SecurityCode" =>$otp,
                                                                                  "Type" 		 =>"RequestToVerifyPublishMemberProfile",
                                                                                  "messagedon"	 =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");                                                          
                            return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
										<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<div class="form-group">
												<input type="hidden" value="'.$securitycode.'" name="reqId">
												<input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Submit profile for verify</h4> <br>
												<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="col-sm-12">
														<div class="col-sm-3"></div>
														<div class="col-sm-6">
															<input type="text"  class="form-control" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"> 
															<button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
														</div>
														<div class="col-sm-3"></div>
												    </div>
													<div class="col-sm-12">'.$error.'</div>
												</div>
											</div>                                                                      
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
                }
			} else {
				$formid = "frmPuplishOTPVerification_".rand(30,3000);
					return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
								<form method="POST" id="'.$formid.'" name="'.$formid.'">
									<div class="form-group">
										<input type="hidden" value="'.$reqID.'" name="reqId">
										<input type="hidden" value="'.$ProfileID.'" name="ProfileID">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Submit profile for verify</h4>
										<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
									</div>
									<div class="form-group">
										<div class="input-group">
											<div class="col-sm-12">
												<div class="col-sm-3"></div>
												<div class="col-sm-6">
													<input type="text"  class="form-control" value="'.$otpdata.'" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
													<button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
												</div>
											</div>
											<div class="col-sm-12">'.$errormessage.'</div>
										</div>
									</div>
									<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
								</form>                                                                                                       
							</div>'; 
			}
		}
		function DeleteProfile() {
			return '<div class="modal-body" style="text-align:center;height: 300px;">
						<p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
						<h5 style="text-align:center;color:#ada9a9">Your Profile has been deleted</h4>    <br>
						<a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
					</div>';
		}
	/* End profile submit */
         function GetDraftProfileInfo() {
             
             global $mysql,$loginInfo;      
             $result =  Profiles::getDraftProfileInformation($_POST['ProfileCode'],2);
             if (sizeof($result)>0) {
                 return Response::returnSuccess("success",$result);
             } else {
                 return Response::returnError("No profile found");
             }
         }
         function GetPublishProfileInfo() {
               
                global $mysql,$loginInfo;      
            
               $result =  Profiles::getProfileInfo($_POST['ProfileCode'],2);
                  if (sizeof($result)>0) {
                     return Response::returnSuccess("success",$result);
                 } else {
                     return Response::returnError("No profile found");
                 }
            }
          
         function AddToLandingPage() {

        global $mysql;  
        
        $data = $mysql->select("select * from _tbl_profiles where ProfileCode='".$_POST['ProfileCode']."'");
        $fromdate=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
        $todate=$_POST['toyear']."-".$_POST['tomonth']."-".$_POST['todate'];
        
       $id =  $mysql->insert("_tbl_landingpage_profiles",array("ProfileID"     => $data[0]['ProfileID'],
                                                               "ProfileCode"   => $data[0]['ProfileCode'],
                                                               "DateFrom"      => $fromdate,
                                                               "DateTo"        => $todate,
                                                               "IsShow"        => $_POST['IsShow'],
                                                               "AddOn"        => date("Y-m-d H:i:s")));

        if (sizeof($id)>0) {
                return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your profile publish request has been submitted.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>';
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
     function BlockMember() {

            global $mysql,$mail,$loginInfo;
        
        $members = $mysql->select("select * from _tbl_members where MemberID='".$_POST['Code']."'");
         
         $mContent = $mysql->select("select * from `mailcontent` where `Category`='BlockMember'");
         $GUID= md5(time().rand(3000,3000000).time());
         
             $content  = str_replace("#MemberName#",$members[0]['MemberName'],$mContent[0]['Content']);
                                                                                                                       
             MailController::Send(array("MailTo"   => $members[0]['EmailID'],               
                                        "Category" => "BlockMember",
                                        "MemberID" => $members[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);              
             $updateSql = "update `_tbl_members` set `IsActive`='0' where `MemberID`='".$_POST['Code']."'";
           $mysql->execute($updateSql); 
         
             if($mailError){
                return  Response::returnError("Error: unable to process your request.");
             } else {
                return Response::returnSuccess("Email sent successfully",array());
             }
         }
         function EditFranchiseeInfo() {

             global $mysql,$loginInfo;
                                                                                                                                     
             $Franchisee = $mysql->select("select * from `_tbl_franchisees_staffs` where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");

             $sqlQry = " update `_tbl_franchisees_staffs` set `PersonName`='".$_POST['FranchiseeName']."'   ";

             if($Franchisee[0]['IsMobileVerified']==0) {
                 $sqlQry .= ", MobileNumber='".$_POST['MobileNumber']."' " ;
                 //mobile format

                 //duplicate, 
                 $data = $mysql->select("select * from `_tbl_franchisees_staffs` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and PersonID <>'".$loginInfo[0]['FranchiseeStaffID']."'");
                 if (sizeof($data)>0) {
                    return Response::returnError("Mobile Number Already Exists");    
                 }
             } 
             if($Franchisee[0]['IsEmailVerified']==0) {
                $sqlQry .= ", `EmailID`='".$_POST['EmailID']."', `CountryCode`='".$_POST['CountryCode']."' " ;
                //email format

                //duplicate,
                $data = $mysql->select("select * from  `_tbl_franchisees_staffs` where `EmailID`='".trim($_POST['EmailID'])."' and `PersonID` <>'".$loginInfo[0]['FranchiseeStaffID']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("EmailID Already Exists");    
                }
             }

             $sqlQry .= " where  `PersonID`='".$Franchisee[0]['PersonID']."'" ;  
             $mysql->execute($sqlQry)  ;
             $id = $mysql->insert("_tbl_logs_activity",array("PersonID"       => $loginInfo[0]['FranchiseeStaffID'],
                                                             "ActivityType"   => 'Yourfranchiseeinformationupdated.',
                                                             "ActivityString" => 'Your franchisee information updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             return Response::returnSuccess("success",array());
         }
         function UpdateKYC() {
             global $mysql,$loginInfo;
             $returnA = 0;
             $returnB = 0;
             $FileTypeA = CodeMaster::getData("IDPROOF",$_POST['IDType']); 

             if (isset($_POST['IDProofFileName']) && strlen($_POST['IDProofFileName'])>0) {

                 $id = $mysql->insert("_tbl_franchisee_documents",array("FranchiseeID"     => $loginInfo[0]['FranchiseeID'],
                                                                        "FranchiseeStaffID"=> $loginInfo[0]['FranchiseeStaffID'],
                                                                        "DocumentType" => 'Id Proof',
                                                                        "FileName"     => $_POST['IDProofFileName'],
                                                                        "FileTypeCode" => $_POST['IDType'],
                                                                        "FileType"     => $FileTypeA[0]['CodeValue'],
                                                                        "SubmittedOn"  => date("Y-m-d H:i:s")));
                        $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"        => $loginInfo[0]['FranchiseeID'],
                                                                        "ActivityType"    => 'docidproof',
                                                                        "ActivityString"  => 'KYC Id proof has been submitted',
                                                                        "SqlQuery"        => '',
                                                                        "ActivityOn"      => date("Y-m-d H:i:s"))); 
                 $returnA = 1;
             }

             $FileTypeB = CodeMaster::getData("ADDRESSPROOF",$_POST['AddressProofType']);
             if (isset($_POST['AddressProofFileName']) && strlen($_POST['AddressProofFileName'])>0) {
                 $id = $mysql->insert("_tbl_franchisee_documents",array("FranchiseeID"     => $loginInfo[0]['FranchiseeID'],
                                                                        "FranchiseeStaffID"=> $loginInfo[0]['FranchiseeStaffID'],
                                                                        "DocumentType" => 'Address Proof',
                                                                        "FileName"     => $_POST['AddressProofFileName'],
                                                                        "FiletypeCode" => $_POST['AddressProofType'],
                                                                        "FileType"     => $FileTypeB[0]['CodeValue'],
                                                                        "SubmittedOn"  => date("Y-m-d H:i:s"))); 
                        $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"        => $loginInfo[0]['FranchiseeID'],
                                                                        "ActivityType"    => 'docaddressproof',
                                                                        "ActivityString"  => 'KYC address proof has been submitted',
                                                                        "SqlQuery"        => '',
                                                                        "ActivityOn"      => date("Y-m-d H:i:s")));
                 $returnB = 1;
             }

             if ($returnA==1 && $returnB==1) {
                 return Response::returnSuccess("successfully updated idproof and address proof",array());
             }

             if ($returnA==1 && $returnB==0) {
                return Response::returnSuccess("successfully updated idproof",array());
             }

             if ($returnA==0 && $returnB==1) {
                return Response::returnSuccess("successfully updated address proof",array());
             }

             if ($returnA==0 && $returnB==0) {
                return Response::returnSuccess("Please choose document",array());
             }
         }
         function GetKYC() {
             global $mysql,$loginInfo;    
             $KYCs = $mysql->select("select * from `_tbl_franchisee_documents` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' order by `DocID` DESC ");
             $IDproof = $mysql->select("select * from `_tbl_franchisee_documents` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and DocumentType='Id Proof' order by DocID Desc");
             $Addressproof = $mysql->select("select * from `_tbl_franchisee_documents` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and DocumentType='Address Proof' order by DocID Desc");
             
             if (sizeof($IDproof)==0) {         
                $isAllowToUploadIDproof = 1;    
             } else {
                 
                 if ($IDproof[0]['IsVerified']==0 && $IDproof[0]['IsRejected']==0) {
                   $isAllowToUploadIDproof = 0;    
                 }
                 
                if ($IDproof[0]['IsVerified']==1 && $IDproof[0]['IsRejected']==1) {
                   $isAllowToUploadIDproof = 1;    
                 } 
                 
                 if ($IDproof[0]['IsVerified']==1 && $IDproof[0]['IsRejected']==0) {
                   $isAllowToUploadIDproof = 0;    
                 } 
             }
             
             
             if (sizeof($Addressproof)==0) {
                $isAllowToUploadAddressproof = 1;    
             } else {
                 
                 if ($Addressproof[0]['IsVerified']==0 && $Addressproof[0]['IsRejected']==0) {
                   $isAllowToUploadAddressproof = 0;    
                 }
                 
                if ($Addressproof[0]['IsVerified']==1 && $Addressproof[0]['IsRejected']==1) {
                   $isAllowToUploadAddressproof = 1;    
                 } 
                 
                 if ($Addressproof[0]['IsVerified']==1 && $Addressproof[0]['IsRejected']==0) {
                   $isAllowToUploadAddressproof = 0;    
                 } 
             }
             
             
             return Response::returnSuccess("success",array("IDProof"      => CodeMaster::getData('IDPROOF'),
                                                            "AddressProof" => CodeMaster::getData('ADDRESSPROOF'),
                                                            "KYCView"      => $KYCs,
                                                            "IdProofDocument" => $IDproof,
                                                            "isAllowToUploadAddressproof" => $isAllowToUploadAddressproof,
                                                            "isAllowToUploadIDproof" => $isAllowToUploadIDproof,
                                                            "AddressProofDocument" => $Addressproof));
         }
         function ManageFranchiseeStaffs() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `PersonID`!='".$loginInfo[0]['FranchiseeStaffID']."' and `IsDeleted`='0'";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsActive`='1'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsActive`='0'"));    
             }
         }
         function GetCountryCode(){
             global $mysql,$loginInfo;
             $Country = CodeMaster::getData('RegisterAllowedCountries');
             return Response::returnSuccess("success",array("CountryCode"      =>$Country));
         } 
          
         function DashboardCounts() {
             
             global $mysql,$loginInfo;
         
             $Member = $mysql->select("select count(*) as cnt from `_tbl_members` where `ReferedBy`='".$loginInfo[0]['FranchiseeStaffID']."'");      
             $DraftedProfiles = $mysql->select("select count(*) as cnt from `_tbl_draft_profiles` where `RequestToVerify`='0' and `IsApproved`='0' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."'");      
             $PostedProfiles = $mysql->select("select count(*) as cnt from `_tbl_draft_profiles` where `RequestToVerify`='1' and `IsApproved`='0' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."'");      
             $Popup =$mysql->select("select * from `_tbl_franchisee_req_verification` where `ToFranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `IsRead`='0' order by `ReqID` limit 0,1"); 
             return Response::returnSuccess("success",array("Member"           =>$Member[0],
                                                            "DraftedProfiles"  =>$DraftedProfiles[0],
                                                            "PostedProfiles"   =>$PostedProfiles[0],
                                                            "Popup"   =>$Popup[0]));
         }
         public function BoardMessage() {
             global $mysql,$loginInfo;
             $welcome=$mysql->execute("update `_tbl_franchisee_req_verification` set `IsRead`='1',`ReadOn`='".date("Y-m-d H:i:s")."' where `ToFranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `ReqID`='".$_POST['ReqID']."'");
             return Response::returnSuccess("Success",array());
         }
         function GetDraftedProfiles() {
           global $mysql,$loginInfo;  
			
 	 
             $sql = "SELECT *
                                    FROM _tbl_draft_profiles
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_draft_profiles.MemberID=_tbl_members.MemberID where _tbl_draft_profiles.ProfileID>0 ";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Draft") {
                return Response::returnSuccess("success",$mysql->select($sql." and _tbl_draft_profiles.RequestToVerify='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Post") {
                return Response::returnSuccess("success".$sql,$mysql->select($sql." and _tbl_draft_profiles.RequestToVerify='1' and _tbl_draft_profiles.IsApproved='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Publish") {
                return Response::returnSuccess("success",$mysql->select($sql."  and _tbl_draft_profiles.IsApproved='1'"));    
             }
         }
         function forgotPassword() {

             global $mysql,$mail;            

             if (Validation::isEmail($_POST['FpUserName'])) {
                $data = $mysql->select("Select * from `_tbl_franchisees_staffs` where `LoginName`='".$_POST['UserName']."'");
                if (sizeof($data)==0){
                    return Response::returnError("Login name not available");
                }
             } else {
                $data = $mysql->select("Select * from `_tbl_franchisees_staffs` where `EmailID`='".$_POST['UserName']."'");    
                if (sizeof($data)==0){
                    return Response::returnError("Email ID not available");
                }
             }

             $otp=rand(1000,9999);
             $securitycode = $mysql->insert("_tbl_verification_code",array("FranchiseeID"      => $data[0]['FranchiseeID'],
                                                                           "RequestSentOn" => date("Y-m-d H:i:s"),
                                                                           "SecurityCode"  => $otp,
                                                                           "messagedon"    => date("Y-m-d h:i:s"), 
                                                                           "EmailTo"       => $data[0]['EmailID'],
                                                                           "Type"          => "Forget Password")) ; 

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeForgetPassword'");
             $content  = str_replace("#FranchiseeName#",$data[0]['PersonName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $data[0]['EmailID'],
                                        "Category" => "FranchiseeForgetPassword",
                                        "FranchiseeID" => $data[0]['FranchiseeID'],                 
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);

             if($mailError){
                return  Response::returnError("Error: unable to process your request.");
             } else {
                return Response::returnSuccess("Email sent successfully",array("reqID"=>$securitycode,"email"=>$data[0]['EmailID']));
             }
         }
         function forgotPasswordOTPvalidation() {

             global $mysql;                  
             $data = $mysql->select("Select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqID']."' ");
             if (sizeof($data)>0) {
                 if ($data[0]['SecurityCode']==$_POST['scode']) {
                    return Response::returnSuccess("email sent successfully",array("reqID"=>$_POST['reqID'],"email"=>$data[0]['EmailID'])); 
                 } else {
                    return Response::returnError("Invalid verification code"); 
                 }
             } else {
                return Response::returnError("Invalid access".json_encode($_POST));
             }
         }
         function forgotPasswordchangePassword() {

             global $mysql;
             $data = $mysql->select("Select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqID']."' ");

             if (!(strlen(trim($_POST['Password']))>=6)) {
                return Response::returnError("Please enter valid new password must have 6 characters");
             } 
             if (!(strlen(trim($_POST['RePassword']))>=6)) {
                return Response::returnError("Please enter valid confirm new password  must have 6 characters"); 
             } 
             if ($_POST['Password']!=$_POST['RePassword']) {
                return Response::returnError("Password do not match"); 
             }
             $sqlQry ="update _tbl_franchisees_staffs set `LoginPassword`='".$_POST['RePassword']."' where `PersonID`='".$data[0]['FranchiseeID']."'";
             $mysql->execute($sqlQry);  
             $data = $mysql->select("select * from `_tbl_franchisees_staffs` where  PersonID='".$data[0]['FranchiseeID']."'");
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $data[0]['FranchiseeID'],
                                                             "ActivityType"   => 'forgetpasswordchangepassword.',
                                                             "ActivityString" => 'forget password changed password.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

             return Response::returnSuccess("New Password saved successfully",$data[0]);  
         }
         function GetMyProfiles() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All)  `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."'  */
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where  `RequestToVerify`='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where    RequestToVerify='1' and IsApproved='1'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."'");
                         foreach($PublishedProfiles as $PublishedProfile) {
                            $result = Profiles::getProfileInformation($PublishedProfile['ProfileCode']);
                            $result['mode']="Published";
                            $Profiles[]=$result;     
                         }
                         
                     } else {
                        foreach($PostProfiles as $PostProfile) {
                            $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode']);
                            $result['mode']="Posted";
                            $Profiles[]=$result;     
                        }
                     }
                     
                 }  
                  return Response::returnSuccess("success",$Profiles);
             }
             

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Draft") {  /* Profile => Drafted */
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where   `RequestToVerify`='0'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft";
                        $Profiles[]=$result;   
                     }
                 }
                 
                 return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Posted") {    /* Profile => Posted */
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and RequestToVerify='1' and IsApproved='0'");

                  if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode'],2);
                        $result['mode']="Posted";
                        $Profiles[]=$result;  
                     }
                 }
                 
                return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Published") {    /* Profile => Posted */
             
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and IsApproved='1' and RequestToVerify='1'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $RecentlyViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['RecentlyViewed']= sizeof($RecentlyViewedcount);
                        
                        $MyFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['MyFavorited']= sizeof($MyFavoritedcount);
                        
                        $WhoViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `VisterProfileCode` ");
                        $result['RecentlyWhoViwed']= sizeof($WhoViewedcount);
                        
                        $WhoFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['WhoFavorited']= sizeof($WhoFavoritedcount);
                        
                        $MutualCount = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' order by FavProfileID DESC)");
                        $result['MutualCount']= sizeof($WhoFavoritedcount);
                        
                        $Profiles[]=$result; 
                        
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         } 
         function GetMemberProfileData() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             
             $Profiles["primarydata"] = Profiles::getProfileInfo($_POST['ProfileCode'],2);
             $Profiles['results'] = array();
             $Profiles['statistics']=array();
             
             
             if ($_POST['request']=="MyRecentViews") {
                $reqProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID` ");
             }
             
             if ($_POST['request']=="MyFavorited") {
                $reqProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID`");
             }
             
             if ($_POST['request']=="RecentlyWhoViewed") {
                $reqProfiles = $mysql->select("select VisterProfileCode as ProfileCode from `_tbl_profiles_lastseen` where `ProfileCode` = '".$_POST['ProfileCode']."' group by `VisterProfileCode`");
             }
             if ($_POST['request']=="WhoFavorited") {
                                                 
                $reqProfiles = $mysql->select("select VisterProfileCode as ProfileCode from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID`");
             }
             if ($_POST['request']=="Mutual") {
                                              
                $reqProfiles = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and `VisterProfileCode` = '".$_POST['ProfileCode']."' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$_POST['ProfileCode']."' order by FavProfileID DESC)");
             }
             
             foreach($reqProfiles as $reqProfile) {
                $Profiles['results'][]=Profiles::getProfileInfo($reqProfile['ProfileCode'],1,1);   
             } 
             
             $RecentlyViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID` ");
             $Profiles['statistics']['RecentlyViewedCount']= sizeof($RecentlyViewedcount);
             
             $MyFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID` ");
             $Profiles['statistics']['MyFavoritedCount']= sizeof($MyFavoritedcount);
                        
             $WhoViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `ProfileCode` = '".$_POST['ProfileCode']."' group by `VisterProfileCode` ");
             $Profiles['statistics']['RecentlyWhoViwedCount']= sizeof($WhoViewedcount);
                        
             $WhoFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode` = '".$_POST['ProfileCode']."' group by `ProfileID` ");
             $Profiles['statistics']['WhoFavoritedCount']= sizeof($WhoFavoritedcount);
                        
             $MutualCount = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and `VisterProfileCode` = '".$_POST['ProfileCode']."' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$_POST['ProfileCode']."' order by FavProfileID DESC)");
             $Profiles['statistics']['MutualCount']= sizeof($MutualCount);  
                         
                return Response::returnSuccess("success"."select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$_POST['ProfileCode']."' order by FavProfileID DESC)",$Profiles);
         }
         function DeleteOccupationAttachmentOnly() {

             global $mysql,$loginInfo;

             $ProfileCode= $_POST['ProfileCode'];
			 
			 $mem= $mysql->select("select * from `_tbl_members` where `MemberID`='".$_POST['MemberID']."'");
             
             $updateSql = "update `_tbl_draft_profiles` set `OccupationAttachFileName` = '' ,`OccupationAttachmentType` = '0' where `ProfileID`='".$_POST['ProfileID']."' and`ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$_POST['MemberID']."'";
             $mysql->execute($updateSql);
          
               return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Attachment has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'Member/'.$mem[0]['MemberCode'].'/ProfileEdit/OccupationDetails/'.$ProfileCode.'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';                             

         }
         
         function SaveBankRequest() {

             global $mysql,$loginInfo;
             $BankNames = $mysql->select("select * from  `_tbl_bank_details` where BankID='".$_POST['BankName']."'"); 
             $TransferMode= CodeMaster::getData("MODE",$_POST['Mode']); 
             $id =  $mysql->insert("_tbl_wallet_bankrequests",array("RequestedOn" => date("Y-m-d H:i:s"),
                                                              "FranchiseeID"          => $loginInfo[0]['FranchiseeStaffID'],
                                                              "IsMember"          => "0",
                                                              "BankCode"          => $BankNames[0]['BankCode'],        
                                                              "BankName"          => $BankNames[0]['BankName'],      
                                                              "AccountName"       => $BankNames[0]['AccountName'],      
                                                              "AccountNumber"     => $BankNames[0]['AccountNumber'],      
                                                              "IFSCode"           => $BankNames[0]['IFSCode'],      
                                                              "RefillAmount"      => $_POST['Amount'],      
                                                              "TransferedOn"      => date("Y-m-d H:i:s"),
                                                              "TransferModeCode"  =>  $TransferMode[0]['SoftCode'],
                                                              "TransferMode"      =>  $TransferMode[0]['CodeValue'],
                                                              "TransactionID"      =>  $_POST['TxnId']));
             $sql=$mysql->qry;
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array());
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function GetListOfPreviousBankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_wallet_bankrequests` ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."Where `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' and `IsApproved`='0' and `IsRejected`='0' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' and `IsApproved`='1' and `IsRejected`='0' order by `ReqID` DESC "));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Reject") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' and `IsApproved`='0' and `IsRejected`='1' order by `ReqID` DESC "));    
             }
         }
         function GetWalletBankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_wallet_transactions` ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."Where `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' and `IsMember`='0' order by `TxnID` DESC"));    
             }
         }
				  
        function GetMemberProfileforView() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   
				if (isset($_POST['XMCode'])) {
					$_POST['Code']=$_POST['XMCode'];
				}
					$m = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and MemberID='".$_POST['Code']."'");
				if (sizeof($m)==0) {
					$sql = " and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."'  ";
				} else {
					$sql = " and `CreatedByFranchiseeStaffID`='0' ";
				}
				
             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$_POST['Code']."' and  `RequestToVerify`='0' and IsApproved='0' ".$sql);
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$_POST['Code']."' and  RequestToVerify='1' ".$sql);
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."' and  `MemberID` = '".$_POST['Code']."'");
                         foreach($PublishedProfiles as $PublishedProfile) {
                            $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                            $result['mode']="Published";
                            $Profiles[]=$result;     
                         }
                         
                         // return Response::returnSuccess("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."' and  `MemberID` = '".$_POST['Code']."'",$Profiles);
                         
                     } else {
                        foreach($PostProfiles as $PostProfile) {
                            $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode'],2);
                            $result['mode']="Posted";
                            $Profiles[]=$result;     
                        }
                     }
                     
                 }  
                  return Response::returnSuccess("success",$Profiles);
             }
             

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Draft") {  /* Profile => Drafted */
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where   RequestToVerify='0' ".$sql);
                 
                 if (sizeof($DraftProfiles)>0) {
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft";
                        $Profiles[]=$result;   
                     }
                 }
                 
                 return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Posted") {    /* Profile => Posted */
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where   RequestToVerify='1' and IsApproved='0' ".$sql);

                  if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode'],2);
                        $result['mode']="Posted";
                        $Profiles[]=$result;  
                     }
                 }
                 
                return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Published") {    /* Profile => Posted */
             
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where  IsApproved='1' and RequestToVerify='1' ".$sql);
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $RecentlyViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['RecentlyViewed']= sizeof($RecentlyViewedcount);
                        
                        $MyFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['MyFavorited']= sizeof($MyFavoritedcount);
                        
                        $WhoViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `VisterProfileCode` ");
                        $result['RecentlyWhoViwed']= sizeof($WhoViewedcount);
                        
                        $WhoFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['WhoFavorited']= sizeof($WhoFavoritedcount);
                        
                        $MutualCount = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' order by FavProfileID DESC)");
                                       
                        $result['MutualCount']= sizeof($WhoFavoritedcount);
                        
                        $Profiles[]=$result; 
                        
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         }
         function getAvailableBalance() {
             global $mysql,$loginInfo;
             $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
         }
         function GetMemberWalletBalance($memberid) {
             
             global $mysql,$loginInfo;
             
             $Balance = $mysql->select("select  (sum(Credits)-sum(Debits)) as bal from `_tbl_wallet_transactions` where `MemberID`='".$memberid."' and IsMember='1'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;
         } 
         
         function FranchiseeTransferAmountToMemberWallet() {

             global $mysql,$loginInfo;
             
             $txnPwd = $mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
             
             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$_POST['MemberID']."'");
             $Franchisee = $mysql->select("select * from `_tbl_franchisees` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
             
             if($this->getAvailableBalance() > $_POST['AmountToTransfer']) {
                return Response::returnError("You don't have sufficiant balance in your wallet."); 
             }
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeTransferAmountToMember'");
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['FranchiseName'],$mContent[0]['Content']);
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$content);
             $content  = str_replace("#Amount#",$_POST['AmountToTransfer'],$content);

             MailController::Send(array("MailTo"   => $Franchisee[0]['ContactEmail'],
                                        "Category" => "FranchiseeTransferAmountToMember",
                                        "FranchiseeID" => $Franchisee[0]['FranchiseeID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($Franchisee[0]['ContactNumber'],"Dear ".$Franchisee[0]['FranchiseName']." your transfer amount to ".$Member[0]['MemberName']."  has been transfered successfully");
                
               $id=$mysql->insert("_tbl_wallet_transactions",array("FranchiseeID"     =>$loginInfo[0]['FranchiseeID'],
                                                                   "MEMFRANCode"      =>$Member[0]['MemberCode'],                    
                                                                   "Particulars"      =>'Transfer to   '. $Member[0]['MemberCode'],                    
                                                                   "Credits"          =>"0",                    
                                                                   "Debits"           => $_POST['AmountToTransfer'], 
                                                                   "AvailableBalance" => $this->getAvailableBalance()+$_POST['AmountToTransfer'],                   
                                                                   "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                   "IsMember"         =>"0"));  
                                                                   
               
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberAmountReceivedFromFranchisee'");
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['MemberName'],$content);
             $content  = str_replace("#Amount#",$_POST['AmountToTransfer'],$content);

             MailController::Send(array("MailTo"   => $Member[0]['EmailID'],
                                        "Category" => "MemberAmountReceivedFromFranchisee",
                                        "MemberID" => $Member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($Member[0]['EmailID'],"Dear ".$Member[0]['MemberName']." your received amount from ".$Franchisee[0]['FranchiseName']."");
                
                   $mysql->insert("_tbl_wallet_transactions",array("MemberID"         =>$_POST['Code'],
                                                                   "MEMFRANCode"      => $Franchisee[0]['MemberCode'],        
                                                                   "Particulars"      =>'Transfer from  '. $Franchisee[0]['FranchiseeCode'],                    
                                                                   "Credits"          => $_POST['AmountToTransfer'],                    
                                                                   "Debits"           =>"0", 
                                                                   "AvailableBalance" => $this->GetMemberWalletBalance($_POST['Code'])+$_POST['AmountToTransfer'],                   
                                                                   "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                   "IsMember"         =>"1")); 
             
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         
         function GetFranchiseeWalletBalance() {
             
             global $mysql,$loginInfo;
          
             return Response::returnSuccess("success",array("WalletBalance" => number_format($this->getAvailableBalance(),2)));
         }
         
          
         function GetMemberWalletAndProfileDetails() {
             
             global $mysql,$loginInfo;
             
             $Mem = $mysql->select("select * from _tbl_members where MemberCode='".$_POST['MCode']."'");
          
            if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="WalletRequests") {
                 $Requests = $mysql->select("select * from `_tbl_wallet_bankrequests` where `MemberID`='".$Mem[0]['MemberID']."' and `IsMember`='1' order by `ReqID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="WalletTransactions") {
                 $Requests = $mysql->select("select * from `_tbl_wallet_transactions` where `MemberID`='".$Mem[0]['MemberID']."' and `IsMember`='1' order by `TxnID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Order") {
                 $Requests = $mysql->select("select * from `_tbl_orders` where `OrderByMemberID`='".$Mem[0]['MemberID']."' order by `OrderID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Invoice") {
                 $Requests = $mysql->select("select * from `_tbl_invoices` where `MemberID`='".$Mem[0]['MemberID']."' order by `InvoiceID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Recentlyviewed") {
                
                 $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterMemberID` = '".$Mem[0]['MemberID']."' order by LastSeenID DESC");
                     $profileCodes  = array();
                     foreach($RecentProfiles as $RecentProfile) {
                         if (!(in_array($RecentProfile['ProfileCode'], $profileCodes)))
                         {
                            $profileCodes[]=$RecentProfile['ProfileCode'];
                         }
                     }
                     if (sizeof($profileCodes)>0) {
                        for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                            if (isset($profileCodes[$i]))  {
                                $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,2);     
                            }
                        }
                     }
                  
             return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="LoginLogs") {
                 $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$Mem[0]['MemberID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
             return Response::returnSuccess("success",$LoginHistory);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Activities") {
                 $Activities = $mysql->select("select * from `_tbl_logs_activity` where `MemberID`='".$Mem[0]['MemberID']."' ORDER BY `ActivityID` DESC LIMIT 0,5");
             return Response::returnSuccess("success",$Activities);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="EmailLog") {
                 $EmailLog = $mysql->select("select * from `_tbl_logs_email` where `MemberID`='".$Mem[0]['MemberID']."' ORDER BY `EmailLogID` DESC LIMIT 0,5");
             return Response::returnSuccess("success",$EmailLog);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="SMSLog") {
                 $SMSLog = $mysql->select("select * from `_tbl_logs_mobilesms` where `MemberID`='".$Mem[0]['MemberID']."' ORDER BY `ReqID` DESC LIMIT 0,5");
             return Response::returnSuccess("success",$SMSLog);
             }
         }
         function GetMemberOrderInvoiceReceiptDetails() {
             
             global $mysql,$loginInfo;
             
             if (isset($_POST['Request']) && $_POST['Request']=="Order") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_orders` order by `OrderID` DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Invoice") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_invoices` order by `InvoiceID` DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Receipt") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_receipts` order by `ReceiptID` DESC"));    
             }
         }
         function ViewMemberOrderInvoiceReceiptDetails() {
             
             global $mysql,$loginInfo;
             
             $Order=$mysql->select("SELECT * From `_tbl_orders` Where `OrderNumber`='".$_POST['Code']."'"); 
             $plan =$mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Order[0]['OrderValue']."'");
             $Invoice=$mysql->select("SELECT * From `_tbl_invoices` Where `InvoiceNumber`='".$_POST['Code']."'"); 
             $Invoiceplan =$mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Invoice[0]['InvoiceValue']."'"); 
             $Receipt=$mysql->select("SELECT * From `_tbl_receipts` Where `ReceiptNumber`='".$_POST['Code']."'"); 
              return Response::returnSuccess("success",array("Order"   =>$Order[0],
                                                             "Plan" =>$plan,
                                                             "InvoicePlan" =>$Invoiceplan,   
                                                             "Invoice" =>$Invoice[0],
                                                             "Receipt" =>$Receipt[0]));
         }
         function GetLoginHistory() {
             
             global $mysql,$loginInfo;
             
             $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
             $StaffLoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `FranchiseeStaffID`='".$_POST['Code']."' ORDER BY `LoginID` DESC LIMIT 0,10");
             return Response::returnSuccess("success",array("LoginHistory" => $LoginHistory,"StaffLoginHistory" => $StaffLoginHistory));
         }
         function UpdateNotification() {

             global $mysql,$loginInfo;
             $sqlQry = "update `_tbl_franchisees_staffs` set `SMSNotification`='".(($_POST['Sms']=="on") ? '1' : '0')."',`EmailNotification`='".(($_POST['Email']=="on")? '1':'0')."' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `PersonID`='".$loginInfo[0]['FranchiseeStaffID']."'";
             $mysql->execute($sqlQry);
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'Yournotificationupdated.',
                                                             "ActivityString" => 'Your notification updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             $Franchisee=$mysql->select("select * from `_tbl_franchisees_staffs` where `PersonID`='".$loginInfo[0]['FranchiseeID']."'"); 
             return Response::returnSuccess("Notifications are updated.",$Franchisee[0]);
         }
         function UpdatePrivacy() {

             global $mysql,$loginInfo;
             $sqlQry="update `_tbl_franchisees_staffs` set `PrivacyVerifiedMember`='".(($_POST['VerfiedMembers']=="on") ? '1' : '0')."',`PrivacyNonVerifiedMember`='".(($_POST['nonVerfiedMembers']=="on")? '1':'0')."' where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and `PersonID`='".$loginInfo[0]['FranchiseeStaffID']."'";
             $mysql->execute($sqlQry);
              $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'Yourprivacyupdated.',
                                                             "ActivityString" => 'Your privacy updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             $Franchisee=$mysql->select("select * from `_tbl_franchisees_staffs` where `PersonID`='".$loginInfo[0]['FranchiseeID']."'"); 
             return Response::returnSuccess("Notifications are updated.",$Franchisee[0]);
         }
     function GetBasicSearchElements() {
             return Response::returnSuccess("success",array("MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"      => CodeMaster::getData('CASTNAMES'),
                                                            ));
         }
     function AddMemberBasicSearchDetails() {

             global $mysql,$loginInfo;    

             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",explode(",",$_POST['MaritalStatus']));
             $Religion       = CodeMaster::getData("RELINAMES",explode(",",$_POST['Religion'])); 
             $Caste       = CodeMaster::getData("CASTNAMES",explode(",",$_POST['Caste'])); 
             
             $MaritalStatus_CodeValue="";
             foreach($MaritalStatus as $M) {
               $MaritalStatus_CodeValue .= $M['CodeValue'].", ";
               $MaritalStatus_SoftCode .= $M['SoftCode'].", ";  
             }
             $Religion_CodeValue="";
             foreach($Religion as $R) {
               $Religion_CodeValue .= $R['CodeValue'].", ";  
               $Religion_SoftCode .= $R['SoftCode'].", ";  
             }
             $Caste_CodeValue="";
             foreach($Caste as $C) {
               $Caste_CodeValue .= $C['CodeValue'].", ";  
               $Caste_SoftCode .= $C['SoftCode'].", ";  
             }
             
             //$profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $Franchisee = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'"); 
              
                   $id = $mysql->insert("_tbl_member_basic_search",array("MemberID"          => $loginInfo[0]['FranchiseeID'],
                                                                         //"ProfileID"         => $profile[0]['ProfileID'],
                                                                         "Sex"               => $Franchisee[0]['Sex'],
                                                                         "MaritalStatusCode" => substr($MaritalStatus_SoftCode,0,strlen($MaritalStatus_SoftCode)-2),
                                                                         "MaritalStatus"     => substr($MaritalStatus_CodeValue,0,strlen($MaritalStatus_CodeValue)-2),
                                                                         "ReligionCode"      => substr($Religion_SoftCode,0,strlen($Religion_SoftCode)-2),
                                                                         "Religion"          => substr($Religion_CodeValue,0,strlen($Religion_CodeValue)-2),
                                                                         "CasteCode"         => substr($Caste_SoftCode,0,strlen($Caste_SoftCode)-2),
                                                                         "Caste"             => substr($Caste_CodeValue,0,strlen($Caste_CodeValue)-2),
                                                                         "SearchName"        => "ABCD",
                                                                         "SearchFrom"        => "Franchisee",
                                                                         "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success",array("ReqID"=>$id));
               // echo "<script>location.href='../BasicSearchResult/".$id.".htm?Req=BasicSearchResult'</script>";
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
                                                                         
         }
         function GetViewBankRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_bankrequests` where `FranchiseeID`='". $loginInfo[0]['FranchiseeStaffID']."' and `ReqID`='".$_POST['Code']."'");                    
             return Response::returnSuccess("success",$Paypal[0]);
         }
          function GetAdvancedSearchElements() {
             return Response::returnSuccess("success",array("SkinType"      => CodeMaster::getData('COMPLEXIONS'),
                                                            "MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"         => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"   => CodeMaster::getData('INCOMERANGE'),
                                                            "Occupation"    => CodeMaster::getData('Occupation'),
                                                            "Country"       => CodeMaster::getData('CONTNAMES'),
                                                            "FamilyType"    => CodeMaster::getData('FAMILYTYPE'),
                                                            "Height"        => CodeMaster::getData('HEIGHTS'),
                                                            "Diet"          => CodeMaster::getData('DIETS'),
                                                            "SmokingHabit"  => CodeMaster::getData('SMOKINGHABITS'),
                                                            "DrinkingHabit" => CodeMaster::getData('DRINKINGHABITS'),
                                                            "BodyType"      => CodeMaster::getData('BODYTYPES')));
         }
         function AddFranchiseeAdvanceSearchDetails() {

             global $mysql,$loginInfo;  
             
             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",explode(",",$_POST['MaritalStatus']));
             $Religion       = CodeMaster::getData("RELINAMES",explode(",",$_POST['Religion'])); 
             $Caste          = CodeMaster::getData("CASTNAMES",explode(",",$_POST['Caste'])); 
             $IncomeRange    = CodeMaster::getData("INCOMERANGE",explode(",",$_POST['IncomeRange'])); 
             $Occupation     = CodeMaster::getData("Occupation",explode(",",$_POST['Occupation'])); 
             $WorkingPlace        = CodeMaster::getData("CONTNAMES",explode(",",$_POST['WorkingPlace'])); 
             $FamilyType     = CodeMaster::getData("FAMILYTYPE",explode(",",$_POST['FamilyType'])); 
             $Diet           = CodeMaster::getData("DIETS",explode(",",$_POST['Diet'])); 
             $Smoke          = CodeMaster::getData("SMOKINGHABITS",explode(",",$_POST['Smoke'])); 
             $Drink          = CodeMaster::getData("DRINKINGHABITS",explode(",",$_POST['Drink'])); 
             $BodyType       = CodeMaster::getData("BODYTYPES",explode(",",$_POST['BodyType'])); 
             $Complexion     = CodeMaster::getData("COMPLEXIONS",explode(",",$_POST['Complexion'])); 
             
             $MaritalStatus_CodeValue="";
             foreach($MaritalStatus as $M) {
               $MaritalStatus_CodeValue .= $M['CodeValue'].", ";
               $MaritalStatus_SoftCode .= $M['SoftCode'].", ";  
             }
             $Religion_CodeValue="";
             foreach($Religion as $R) {
               $Religion_CodeValue .= $R['CodeValue'].", ";  
               $Religion_SoftCode .= $R['SoftCode'].", ";  
             }
             $Caste_CodeValue="";
             foreach($Caste as $C) {
               $Caste_CodeValue .= $C['CodeValue'].", ";  
               $Caste_SoftCode .= $C['SoftCode'].", ";  
             }
             $IncomeRange_CodeValue="";
             foreach($IncomeRange as $IR) {
               $IncomeRange_CodeValue .= $IR['CodeValue'].", ";  
               $IncomeRange_SoftCode .= $IR['SoftCode'].", ";  
             }
             $Occupation_CodeValue="";
             foreach($Occupation as $ON) {
               $Occupation_CodeValue .= $ON['CodeValue'].", ";  
               $Occupation_SoftCode .= $ON['SoftCode'].", ";  
             }
             $FamilyType_CodeValue="";
             foreach($FamilyType as $FT) {
               $FamilyType_CodeValue .= $FT['CodeValue'].", ";  
               $FamilyType_SoftCode .= $FT['SoftCode'].", ";  
             }
             $WorkingPlace_CodeValue="";
             foreach($WorkingPlace as $WP) {
               $WorkingPlace_CodeValue .= $WP['CodeValue'].", ";  
               $WorkingPlace_SoftCode .= $WP['SoftCode'].", ";  
             }
             $Diet_CodeValue="";
             foreach($Diet as $DT) {
               $Diet_CodeValue .= $DT['CodeValue'].", ";  
               $Diet_SoftCode .= $DT['SoftCode'].", ";  
             }
             $Smoke_CodeValue="";
             foreach($Smoke as $SK) {
               $Smoke_CodeValue .= $SK['CodeValue'].", ";  
               $Smoke_SoftCode .= $SK['SoftCode'].", ";  
             }
             $Drink_CodeValue="";
             foreach($Drink as $DK) {
               $Drink_CodeValue .= $DK['CodeValue'].", ";  
               $Drink_SoftCode .= $DK['SoftCode'].", ";  
             }
             $BodyType_CodeValue="";
             foreach($BodyType as $BT) {
               $BodyType_CodeValue .= $BT['CodeValue'].", ";  
               $BodyType_SoftCode .= $BT['SoftCode'].", ";  
             }
             $Complexion_CodeValue="";
             foreach($Complexion as $CN) {
               $Complexion_CodeValue .= $CN['CodeValue'].", ";  
               $Complexion_SoftCode .= $CN['SoftCode'].", ";  
             }
             
             //$profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
            // $Member = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'"); 
                $Franchisee = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."'");               
                  $id = $mysql->insert("_tbl_member_advance_search",array("MemberID"         => $loginInfo[0]['FranchiseeID'],
                                                                        // "ProfileID"         => $profile[0]['ProfileID'],
                                                                         "Sex"               => $Franchisee[0]['Sex'],
                                                                         "MaritalStatusCode" => substr($MaritalStatus_SoftCode,0,strlen($MaritalStatus_SoftCode)-2),
                                                                         "MaritalStatus"     => substr($MaritalStatus_CodeValue,0,strlen($MaritalStatus_CodeValue)-2),
                                                                         "ReligionCode"      => substr($Religion_SoftCode,0,strlen($Religion_SoftCode)-2),
                                                                         "Religion"          => substr($Religion_CodeValue,0,strlen($Religion_CodeValue)-2),
                                                                         "CasteCode"         => substr($Caste_SoftCode,0,strlen($Caste_SoftCode)-2),
                                                                         "Caste"             => substr($Caste_CodeValue,0,strlen($Caste_CodeValue)-2),
                                                                         "IncomeRangeCode"   => substr($IncomeRange_SoftCode,0,strlen($IncomeRange_SoftCode)-2),
                                                                         "IncomeRange"       => substr($IncomeRange_CodeValue,0,strlen($IncomeRange_CodeValue)-2),
                                                                         "OccupationCode"    => substr($Occupation_SoftCode,0,strlen($Occupation_SoftCode)-2),
                                                                         "Occupation"        => substr($Occupation_CodeValue,0,strlen($Occupation_CodeValue)-2),
                                                                         "FamilyTypeCode"    => substr($FamilyType_SoftCode,0,strlen($FamilyType_SoftCode)-2),
                                                                         "FamilyType"        => substr($FamilyType_CodeValue,0,strlen($FamilyType_CodeValue)-2),
                                                                         "WorkingPlaceCode"  => substr($WorkingPlace_SoftCode,0,strlen($WorkingPlace_SoftCode)-2),
                                                                         "WorkingPlace"      => substr($WorkingPlace_CodeValue,0,strlen($WorkingPlace_CodeValue)-2),
                                                                         "DietCode"          => substr($Diet_SoftCode,0,strlen($Diet_SoftCode)-2),
                                                                         "Diet"              => substr($Diet_CodeValue,0,strlen($Diet_CodeValue)-2),
                                                                         "SmokeCode"         => substr($Smoke_SoftCode,0,strlen($Smoke_SoftCode)-2),
                                                                         "Smoke"             => substr($Smoke_CodeValue,0,strlen($Smoke_CodeValue)-2),
                                                                         "DrinkCode"         => substr($Drink_SoftCode,0,strlen($Drink_SoftCode)-2),
                                                                         "Drink"             => substr($Drink_CodeValue,0,strlen($Drink_CodeValue)-2),
                                                                         "BodyTypeCode"      => substr($BodyType_SoftCode,0,strlen($BodyType_SoftCode)-2),
                                                                         "BodyType"          => substr($BodyType_CodeValue,0,strlen($BodyType_CodeValue)-2),
                                                                         "ComplexionCode"    => substr($Complexion_SoftCode,0,strlen($Complexion_SoftCode)-2),
                                                                         "Complexion"        => substr($Complexion_CodeValue,0,strlen($Complexion_CodeValue)-2),
                                                                         "SearchName"        => "ABCD",
                                                                         "SearchFrom"        => "Franchisee",
                                                                         "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
                $sql =$mysql->qry;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success".$sql,array("ReqID"=>$id));
               // echo "<script>location.href='../BasicSearchResult/".$id.".htm?Req=BasicSearchResult'</script>";
             } else{
                 return Response::returnError("Access denied. Please contact support".$sql);   
             }
                                                                         
         }
         function AddFranchiseeProfileSearchByProfileID() {

             global $mysql,$loginInfo;    
           
           //  $profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
              
                   $id = $mysql->insert("_tbl_member_search_by_profileid",array("MemberID"          => $loginInfo[0]['FranchiseeID'],
                                                                                "ProfileID"         => $_POST['profileid'],
                                                                                "SearchName"        => "ABCD",
                                                                                "SearchFrom"        => "Franchisee",
                                                                                "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success",array("ReqID"=>$id));
               // echo "<script>location.href='../BasicSearchResult/".$id.".htm?Req=BasicSearchResult'</script>";
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
                                                                         
         }
         function GetMemberProfile() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and  `RequestToVerify`='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and  RequestToVerify='1'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."'");
                         foreach($PublishedProfiles as $PublishedProfile) {
                            $result = Profiles::getProfileInformation($PublishedProfile['ProfileCode']);
                            $result['mode']="Published";
                            $Profiles[]=$result;     
                         }
                         
                     } else {
                        foreach($PostProfiles as $PostProfile) {
                            $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode']);
                            $result['mode']="Posted";
                            $Profiles[]=$result;     
                        }
                     }
                     
                 }  
                  return Response::returnSuccess("success",$Profiles);
             }
             

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Draft") {  /* Profile => Drafted */
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and `RequestToVerify`='0'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft";
                        $Profiles[]=$result;   
                     }
                 }
                 
                 return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Posted") {    /* Profile => Posted */
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and RequestToVerify='1' and IsApproved='0'");

                  if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode'],2);
                        $result['mode']="Posted";
                        $Profiles[]=$result;  
                     }
                 }
                 
                return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Published") {    /* Profile => Posted */
             
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and IsApproved='1' and RequestToVerify='1'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $RecentlyViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['RecentlyViewed']= sizeof($RecentlyViewedcount);
                        
                        $MyFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['MyFavorited']= sizeof($MyFavoritedcount);
                        
                        $WhoViewedcount = $mysql->select("select * from `_tbl_profiles_lastseen` where `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `VisterProfileCode` ");
                        $result['RecentlyWhoViwed']= sizeof($WhoViewedcount);
                        
                        $WhoFavoritedcount = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' group by `ProfileID` ");
                        $result['WhoFavorited']= sizeof($WhoFavoritedcount);
                        
                        $MutualCount = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$PublishedProfile['ProfileCode']."' order by FavProfileID DESC)");
                        $result['MutualCount']= sizeof($WhoFavoritedcount);
                        
                        $Profiles[]=$result; 
                        
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         }
		 function checkdraftprofile (){
			 global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   
			$DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and `RequestToVerify`='0'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft";
                        $Profiles[]=$result;   
                     }
                 }
                 
                 return Response::returnSuccess("success",$Profiles);
             }
	    /*Edit submitted Profile */
	function SendOtpForEditSubmittedProfile($errormessage="",$otpdata="",$reqID="",$ProfileCode="") {
        global $mysql,$mail,$loginInfo;      
        
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
        if ($reqID=="")      {
            $otp=rand(1000,9999);
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToEditForSubmittedMemberProfile'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#otp#",$otp,$content);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                       "Category" => "RequestToEditForSubmittedMemberProfile",
                                       "MemberID" => $member[0]['MemberID'],
                                       "Subject"  => $mContent[0]['Title'],
                                       "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." Verification Security Code is ".$otp);
            if($mailError){
                    return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID"      =>$member[0]['MemberID'],
                                                                                      "RequestSentOn" =>date("Y-m-d H:i:s"),
																					  "EmailTo" 	  =>$member[0]['EmailID'],
                                                                                      "SMSTo" 		  =>$member[0]['MobileNumber'],
                                                                                      "SecurityCode"  =>$otp,
                                                                                      "Type" 		  =>"RequestToEditForSubmittedMemberProfile",
                                                                                      "messagedon"    =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmEditForSubmittedProfileOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$member[0]['MemberID']."'");                                                          
                            return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
										<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<div class="form-group">
												<input type="hidden" value="'.$securitycode.'" name="reqId">
												<input type="hidden" value="'.$_POST['ProfileCode'].'" name="ProfileCode">
												<input type="hidden" value="'.$_POST['FileName'].'" name="FileName">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Profile Edit</h4> <br>
												<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
											</div>
											<div class="form-group">
												<div class="input-group">
													<div class="col-sm-12">
														<div class="col-sm-3"></div>
														<div class="col-sm-6">
															<input type="text"  class="form-control" id="EditOtp" maxlength="4" name="EditOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
															<button type="button" onclick="SubmittedProfileforEditOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
														</div>
														<div class="col-sm-3"></div>
													</div>
													<div class="col-sm-12" style="text-align:center">'.$error.'</div>
												</div>
											</div>                                                                      
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForSubmittedProfileProfileForEdit(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
                    }
        } else {
            $formid = "frmEditForSubmittedProfileOTPVerification_".rand(30,3000);
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
							<form method="POST" id="'.$formid.'" name="'.$formid.'">
								<div class="form-group">
									<input type="hidden" value="'.$reqID.'" name="reqId">
									<input type="hidden" value="'.$ProfileCode.'" name="ProfileCode">
									<input type="hidden" value="'.$_POST['FileName'].'" name="FileName">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Profile Edit</h4> <br>
									<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="col-sm-12">
											<div class="col-sm-3"></div>
											<div class="col-sm-6">
												<input type="text"  class="form-control" value="'.$otpdata.'" id="EditOtp" maxlength="4" name="EditOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
												<button type="button" onclick="SubmittedProfileforEditOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
											</div>
											<div class="col-sm-3"></div>
										</div>
										<div class="col-sm-12" style="text-align:center">'.$errormessage.'</div>
									</div>
								</div>
								<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForSubmittedProfileProfileForEdit(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
							</form>                                                                                                       
                        </div>'; 
        }
    }
	
	function SubmittedProfileforEditOTPVerification() {
        
		global $mysql,$loginInfo ;
             
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
        $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
            if (strlen(trim($_POST['EditOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['EditOtp']))  {
				
				$mysql->execute("update `_tbl_draft_profiles` set `RequestToVerify` = '0' where `MemberID`='".$member[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");
				
				$mysql->insert("_tbl_request_edit",array("MemberID"                		=> $member[0]['MemberID'],
														 "MemberCode"            		=> $member[0]['MemberCode'],
														 "DraftProfileID"            	=> $data[0]['ProfileID'],
														 "DraftProfileCode"            	=> $data[0]['ProfileCode'],
														 "RequestToEditFromSubmitted"   => "1",
														 "RequestToEditFromSubmittedOn" => date("Y-m-d H:i:s")));
         
				$id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
																"ActivityType"   => 'EditForSubmittedMemberProfile.',
																"ActivityString" => 'Edit For Submitted Member Profile.',
																"SqlQuery"       => base64_encode($updateSql),
																//"oldData"      => base64_encode(json_encode($oldData)),
																"ActivityOn"     => date("Y-m-d H:i:s")));
				return Response::returnSuccess("Your submitted profile has been changed to draft profile.",array("FileName"=>$_POST['FileName'],"ProfileCode"=>$_POST['ProfileCode'],"MemberCode"=>$member[0]['MemberCode']));
            } else {
                 return $this->SendOtpForEditSubmittedProfile("<span style='color:red'>Invalid verification code.</span>",$_POST['EditOtp'],$_POST['reqId'],$_POST['ProfileCode']);
            } 
	}
	
	function ResendSendOtpForSubmittedProfileProfileForEdit($errormessage="",$otpdata="",$reqID="",$ProfileCode="") {
        
		global $mysql,$mail,$loginInfo;   
			 
		$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");  
        
		$resend = $mysql->insert("_tbl_resend",array("MemberID" =>$member[0]['MemberID'],
                                                     "Reason"   =>"Resend Edit For Submitted Profile Verfication Code",
                                                     "ResendOn" =>date("Y-m-d h:i:s"))) ;
		if ($reqID=="")      {
            $otp=rand(1000,9999);
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToEditForSubmittedMemberProfile'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#otp#",$otp,$content);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                       "Category" => "RequestToEditForSubmittedMemberProfile",
                                       "MemberID" => $member[0]['MemberID'],
                                       "Subject"  => $mContent[0]['Title'],
                                       "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." Verification Security Code is ".$otp);
                                                                                                                          
            if($mailError){
                return "Mailer Error: " . $mail->ErrorInfo.
                    "Error. unable to process your request.";                                                               
            } else {
                $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID"      =>$member[0]['MemberID'],
                                                                              "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                              "EmailTo" 	  =>$member[0]['EmailID'],
                                                                              "SMSTo" 		  =>$member[0]['MobileNumber'],
                                                                              "SecurityCode"  =>$otp,
                                                                              "Type"          =>"RequestToEditForSubmittedProfile",
                                                                              "messagedon"    =>date("Y-m-d h:i:s"))) ;
                $formid = "frmEditForSubmittedProfileOTPVerification_".rand(30,3000);
                $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$member[0]['MemberID']."'");                                                          
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
							<form method="POST" id="'.$formid.'" name="'.$formid.'">
								<div class="form-group">
									<input type="hidden" value="'.$securitycode.'" name="reqId">
									<input type="hidden" value="'.$_POST['ProfileCode'].'" name="ProfileCode">
									<input type="hidden" value="'.$_POST['FileName'].'" name="FileName">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Profile Edit</h4> <br>
									<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="col-sm-12">
											<div class="col-sm-3"></div>
											<div class="col-sm-6">
												<input type="text"  class="form-control" id="EditOtp" maxlength="4" name="EditOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"> 
												<button type="button" onclick="SubmittedProfileforEditOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
											</div>
											<div class="col-sm-3"></div>
										</div>
										<div class="col-sm-12">'.$error.'</div>
									</div>
								</div>                                                                      
								<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForSubmittedProfileProfileForEdit(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
							</form>                                                                                                       
                        </div>'; 
            }
        } else {
            $formid = "frmEditForSubmittedProfileOTPVerification_".rand(30,3000);
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
							<form method="POST" id="'.$formid.'" name="'.$formid.'">
								<div class="form-group">
									<input type="hidden" value="'.$reqID.'" name="reqId">
									<input type="hidden" value="'.$ProfileCode.'" name="ProfileCode">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Submit profile for verify</h4>
									<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
								</div>
								<div class="form-group">
									<div class="input-group">
										<div class="col-sm-12">
											<div class="col-sm-3"></div>
											<div class="col-sm-6">
												<input type="text"  class="form-control" value="'.$otpdata.'" id="EditOtp" maxlength="4" name="EditOtp" style="width:50%;width: 67%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;">
												<button type="button" onclick="SubmittedProfileforEditOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
											</div>
										</div>
										<div class="col-sm-12">'.$errormessage.'</div>
									</div>
								</div>
								<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForSubmittedProfileProfileForEdit(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
							</form>                                                                                                       
                        </div>'; 
        }

    }
    
   /*end edit submit profile */  
   
   
			 
    }
//2747    
?> 