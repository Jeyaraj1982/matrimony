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
                return Response::returnError("Please enter username ");
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
                return Response::returnError("Invalid username and password");
            }
        }
        
        function GetMemberCode(){
            return Response::returnSuccess("success",array("MemberCode" => SeqMaster::GetNextMemberNumber(),
                                                           "Gender"     => CodeMaster::getData('SEX')));
        }
        
        function CreateMember() {
                                                                            
        global $mysql,$loginid;  
       
        $data = $mysql->select("select * from _tbl_members where  MemberCode='".$_POST['MemberCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("MemberCode Already Exists");
        }
        $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateMobile'");
             if ($allowDuplicateMobile[0]['ParamA']==0) {
                $data = $mysql->select("select * from _tbl_members where  MobileNumber='".$_POST['MobileNumber']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("MobileNumber Already Exists");
                }
             }
        if (strlen(trim($_POST['WhatsappNumber']))>0) {
         $allowDuplicateWhatsapp = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateWhatsapp'");
             if ($allowDuplicateWhatsapp[0]['ParamA']==0) {
                $data = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
                    if (sizeof($data)>0) {
                        return Response::returnError("WhatsappNumber Already Exists");
                    }
             }
        }
        $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateEmail'");
             if ($allowDuplicateEmail[0]['ParamA']==0) {
                $data = $mysql->select("select * from _tbl_members where  EmailID='".$_POST['EmailID']."'");
                 if (sizeof($data)>0) {
                     return Response::returnError("EmailID Already Exists");
                 }
             }
        
        if (!(strlen(trim($_POST['MemberName']))>0)) {
            return Response::returnError("Please enter your name");
        }
        if (!(strlen(trim($_POST['Sex']))>0)) {
            return Response::returnError("Please enter your Sex");
        }
        if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return Response::returnError("Please enter your MobileNumber");
        }
        if (!(strlen(trim($_POST['EmailID']))>0)) {
            return Response::returnError("Please enter your email");
        }
        //if (!(strlen(trim($_POST['AadhaarNumber']))>0)) {
           // return Response::returnError("Please enter AadhaarNumber");
        //}
        if (!(strlen(trim($_POST['LoginPassword']))>0)) {                                                 
            return Response::returnError("Please enter MemberPassword");    
        }
        $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
         $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
       $id =  $mysql->insert("_tbl_members",array("MemberCode"              => $_POST['MemberCode'],
                                                  "MemberName"               => $_POST['MemberName'],  
                                                  "DateofBirth"              => $dob,
                                                  "Sex"                      => $_POST['Sex'],
                                                  "CountryCode"             => $_POST['CountryCode'],
                                                  "MobileNumber"             => $_POST['MobileNumber'],
                                                  "WhatsappCountryCode"           => $_POST['WhatsappCountryCode'],
                                                  "WhatsappNumber"           => $_POST['WhatsappNumber'],
                                                  "EmailID"                  => $_POST['EmailID'],
                                                  "AadhaarNumber"            => $_POST['AadhaarNumber'],
                                                  "CreatedOn"                => date("Y-m-d H:i:s"),
                                                  "ReferedBy"                => $login[0]['FranchiseeID'],
                                                  "MemberPassword"           => $_POST['LoginPassword']));
        if (sizeof($id)>0) {
            $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Member'");
                return Response::returnSuccess("success",array("MemberCode"=>$_POST['MemberCode']));
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
       
        function CheckVerification() {
            
            global $mysql,$loginInfo;
            
            $sql="select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
           
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['StaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==0) {
               return $this->ChangeMobileNumberFromVerificationScreen("",$loginid,"","");
            }
            
            if ($franchiseedata[0]['IsEmailVerified']==0) {
               return $this->ChangeEmailFromVerificationScreen("",$loginid,"","");
            }
            
           // return "<script>location.href='';</script>";
        }
        
        function VisitedWelcomeMsg(){
            global $mysql;
            $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$_GET['LoginID']."'");     
            $welcome=$mysql->execute("update _tbl_franchisees_staffs set WelcomeMsg='1' where  FranchiseeID='".$login[0]['FranchiseeID']."' and PersonID='".$login[0]['StaffID']."'");
            return true;
        }
        
        function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
            //if ($loginid=="") {
              //  $loginid = $_GET['LoginID'];
            //}
            
            global $mysql,$loginInfo;
                                                                                                                               
           // $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                
                $formid = "frmChangeMobileNumber_".rand(30,3000);
             
                return '<div id="otpfrm" style="width:100%;padding:15px;height:100%;">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -12px;">&times;</button>
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                                    <h5 style="color: #969292;font-weight: 100;padding-top: 21px;">In order to protect the security of your account,we will send you a text message with a verification that you will need to enter the next screen</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.ImagePath.'smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['CountryCode'].'&nbsp;'.$franchiseedata[0]['MobileNumber'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumberF()">Change</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><a  href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary" name="verifybtn" id="verifybtn">Continue to verify</a></div>
                                    </div>
                                </div>
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
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                $formid = "frmChangeMobileNo_".rand(30,3000);
                
                return '<div id="otpfrm" style="width:100%;padding-bottom: 0px;padding-top:20px;padding-left: 20px;padding-right: 20px;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                           <div class="form-group">
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;padding-top: 15%;">Change Mobile Number</h4>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <select name="CountryCode" id="CountryCode" style="padding-top: 12px;padding-bottom: 7px;padding-top: 4px;padding-bottom: 4px;text-align: center;font-family: Roboto;"> 
                                           <option value="+91">+91</option>
                                        </select>
                                        <input type="text" value="'.$scode.'" id="new_mobile_number" name="new_mobile_number"  maxlength="10" style="width: 73%;height: 27px;text-align: center;font-family:Roboto;"></div>
                                    </div>  
                                </div>
                            </div> 
                            <div class="col-sm-12" id="errormsg">'.$error.'</div>
                            <div class="col-sm-12" style="text-align:center">
                                    <button type="button" onclick="MobileNumberVerificationForm(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Save and verify</button>&nbsp;&nbsp;
                                    <a  href="javascript:void(0)" onclick="FCheckVerification()">back</a></div>
                                </div>
                            </div>
                           </div>
                        </form>                                                                                                       
                        </div>'; 
            }   
        }
        
        function MobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {
            
          //  if ($loginid=="") {
           //     $loginid = $_GET['LoginID'];
           // }
            
            global $mysql,$loginInfo;
            
           // $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            } 
            
            if (isset($_POST['new_mobile_number'])) {
                
                if (strlen(trim($_POST['new_mobile_number']))!=10) {
                   return $this->ChangeMobileNumber("Invalid Mobile Number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $duplicate = $mysql->select("select * from _tbl_franchisees_staffs where MobileNumber='".$_POST['new_mobile_number']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeMobileNumber("Mobile Number already in use.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $update = "update _tbl_franchisees_staffs set MobileNumber='".$_POST['new_mobile_number']."' , CountryCode='".$_POST['CountryCode']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute($update);
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MobileNumberChanged.',
                                                             "ActivityString" => 'Mobile Number Changed.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
            }
                                                                                                                                    
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
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
                                                                                 "Messagedon"=>date("Y-m-d h:i:s"))) ; 
                }  else {
                    $securitycode = $reqID;
                }
                                                          
                $formid = "frmMobileNoVerification_".rand(30,3000);
                
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.ImagePath.'smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9;font-size: 18px;">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['CountryCode'].'-'.$franchiseedata[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12" id="errormsg">'.$error.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the PIN?<a href="#">&nbsp;Resend</a><h5> 
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
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"></p>
                            <h5 style="text-align:center;color:#ada9a9">
                                Great! Your number has been<br>
                                successfully verified.
                            </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a> <h5>
                       </div>';
            } else {
                return $this->MobileNumberVerificationForm("You entered, invalid pin.",$_POST['loginId'],$_POST['mobile_otp_2'],$_POST['reqId']);
            }
        }
        
        function ChangeEmailFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
           // if ($loginid=="") {
           //     $loginid = $_GET['LoginID'];
           // }
            
            global $mysql,$loginInfo;                                
            
           // $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
             if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;padding:20px;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="FCheckVerification()">Continue</a>
                       </div>';    
            } else {
                
                $formid = "frmChangeEmail_".rand(30,3000);
             
                return '<div id="otpfrm" style="width:100%;padding:20px;">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;padding-top: 12%;">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.ImagePath.'emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><a  href="javascript:void(0)" onclick="EmailVerificationForm()" class="btn btn-primary" name="verifybtn" id="verifybtn">Continue to Verify</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>'; 
                }
        }
        
        function ChangeEmailID($error="",$loginid="",$scode="",$reqID="") {
            
            //if ($loginid=="") {
           ///     $loginid = $_GET['LoginID'];
           // }
            
            global $mysql,$loginInfo;
            
            //$login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
            
            if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
            $formid = "frmChangeEmail_".rand(30,3000);
                
                return '<div id="otpfrm" style="padding-bottom: 0px;padding-top:20px;padding-right:20px;padding-left:20px;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                           <div class="form-group">
                                 <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;padding-top: 15%;">Change Email ID</h4>
                                </div>
                            </div> 
                            <div class="form-group"> 
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <input type="text" value="'.$scode.'" id="new_email" name="new_email" class="form-control" style="font-family:Roboto;"></div>
                                    </div>  
                                </div>
                            </div> 
                            <div class="col-sm-12" id="errormsg">'.$error.'</div>
                            <div class="col-sm-12" style="text-align:center">
                                    <div class="col-sm-12" style="text-align:center"><button type="button" onclick="EmailVerificationForm(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Save and Verify</button>&nbsp;&nbsp;
                                    <a  href="javascript:void(0)" onclick="FCheckVerification()">back</a></div>
                                </div>
                            </div>
                           </div>
                        </form>                                                                                                       
                        </div>'; 
            }
        }
        
        function EmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {
            
          //  if ($loginid=="") {
          //      $loginid = $_GET['LoginID'];
          //  }
            
            global $mysql,$mail,$loginInfo;
           
           // $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
              
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            if (isset($_POST['new_email'])) {
                if (strlen(trim($_POST['new_email']))==0) {
                    return $this->ChangeEmailID("Invalid EmailID",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                }
                $duplicate = $mysql->select("select * from _tbl_franchisees_staffs where EmailID='".$_POST['new_email']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeEmailID("Email already in use.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                }
                
                $sql ="update _tbl_franchisees_staffs set EmailID='".$_POST['new_email']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'";
                $mysql->execute();
                $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'EmailIDChanged.',
                                                             "ActivityString" => 'Email ID Changed.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
            }
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
           
            if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">
                                Great! Your email has been<br> 
                                successfully verified.
                            </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
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
                        
                        return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                                    <form method="POST" id="'.$formid.'">
                                        <input type="hidden" value="'.$loginid.'" name="loginId">
                                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <h4 style="text-align:center;color:#6c6969;">Please verify your email</h4>
                                            </div>
                                            <p style="text-align:center;padding: 20px;"><img src=""'.ImagePath.'emailicon.png" width="10%"></p>
                                            <h5 style="text-align:center;color:#ada9a9;font-size: 18px;">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="col-sm-12">
                                                    <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                    <div class="col-sm-5"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Verify</button></div>
                                                </div>
                                                <div class="col-sm-12" id="errormsg">'.$error.'</div>
                                            </div>
                                        </div>
                                        <h5 style="text-align:center;color:#ada9a9">Did not receive the PIN?<a href="#">&nbsp;Resend</a><h5> 
                                    </form>                                                                                                       
                                </div>'; 
                    }

                }  else {
                    
                    $securitycode = $reqID;
                    
                    $formid = "frmMobileNoVerification_".rand(30,3000);
                    $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");                                                           
                    
                    return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                                <form method="POST" id="'.$formid.'">
                                    <input type="hidden" value="'.$loginid.'" name="loginId">
                                    <input type="hidden" value="'.$securitycode.'" name="reqId">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <h4 style="text-align:center;color:#ada9a9">Please verify your email</h4>
                                        </div>
                                        <p style="text-align:center;padding: 20px;"><img src="'.ImagePath.'emailicon.png" width="10%"></p>
                                        <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="col-sm-12">
                                                <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                <div class="col-sm-5"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                            </div>
                                            <div class="col-sm-12" id="errormsg">'.$error.'</div>
                                        </div>
                                    </div>
                                    <h5 style="text-align:center;color:#ada9a9">Did not receive the PIN?<a href="#">&nbsp;Resend</a><h5> 
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
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <p style="text-align:center"><a href="../Dashboard" class="btn btn-primary">Continue</a></p>
                            
                       </div>';
                                    } else {
                                        return $this->EmailVerificationForm("<span style='color:red'>You entered, invalid Pin.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
                                    }  
        }  
        
        function GetMyMembers() {
            global $loginInfo;     
            return ($loginInfo[0]['FranchiseeID']>0) ? Response::returnSuccess("success",$this->execute("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."'"))
                                                     : Response::returnError("Access denied. Please contact support"); 
        }
        function GetMyActiveMembers() {
            global $loginInfo;     
            return ($loginInfo[0]['FranchiseeID']>0) ? Response::returnSuccess("success",$this->execute("select * from _tbl_members where IsActive='1' and ReferedBy='".$loginInfo[0]['FranchiseeID']."'"))
                                                     : Response::returnError("Access denied. Please contact support");   
        }
        function GetMyDeactiveMembers() {
             global $loginInfo;     
            return ($loginInfo[0]['FranchiseeID']>0) ? Response::returnSuccess("success",$this->execute("select * from _tbl_members where IsActive='0' and ReferedBy='".$loginInfo[0]['FranchiseeID']."'"))
                                                     : Response::returnError("Access denied. Please contact support"); 
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
            $Member=$mysql->select(" SELECT 
                                     _tbl_members.*,
                                     _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                     _tbl_franchisees.FranchiseName AS FranchiseName,
                                     _tbl_franchisees.FranchiseeID AS FranchiseeID,
                                     _tbl_franchisees.IsActive AS FIsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.ReferedBy='".$loginInfo[0]['FranchiseeID']."' and _tbl_members.MemberID='".$_POST['Code']."'");
             $Member[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
            return Response::returnSuccess("success",$Member[0]);
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
        
        function EditMember(){
              global $mysql,$loginInfo;    
              
              $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'");

              $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateEmail'");
                    if ($allowDuplicateMobile[0]['ParamA']==0) {
                        $data = $mysql->select("select * from  _tbl_members where EmailID='".trim($_POST['EmailID'])."' and MemberID <>'".$_POST['Code']."' ");
                            if (sizeof($data)>0) {
                            return Response::returnError("EmailID Already Exists");    
                        }
                    }
              $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateMobile'");
                    if ($allowDuplicateEmail[0]['ParamA']==0) {
                        $data = $mysql->select("select * from  _tbl_members where MobileNumber='".trim($_POST['MobileNumber'])."' and MemberID <>'".$_POST['Code']."' ");
                            if (sizeof($data)>0) {
                            return Response::returnError("Mobile Number Already Exists");    
                        }
                    }
                                                       
                $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                    EmailID='".$_POST['EmailID']."',
                                                    MobileNumber='".$_POST['MobileNumber']."',
                                                    CountryCode='".$_POST['CountryCode']."',
                                                    IsActive='".$_POST['Status']."' where  MemberID='".$Member[0]['MemberID']."'");
      
     
             $Member = $mysql->select("select * from _tbl_members where ReferedBy='".$loginInfo[0]['FranchiseeID']."' and  MemberID='".$_POST['Code']."'");
            
    
                return Response::returnSuccess("success",array());
                                                            
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
       
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where staffCode='".$_POST['staffCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Staff Code Already Exists");
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
        $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
       $id =  $mysql->insert("_tbl_franchisees_staffs",array("FrCode"          => $loginInfo[0]['FranchiseeCode'],
                                                                 "StaffCode"       => $_POST['staffCode'],   
                                                                 "PersonName"      => $_POST['staffName'], 
                                                                 "Sex"             => $_POST['Sex'],                                 
                                                                 "DateofBirth"     => $dob,
                                                                 "CountryCode"    => $_POST['CountryCode'],
                                                                 "MobileNumber"    => $_POST['MobileNumber'],
                                                                 "EmailID"         => $_POST['EmailID'],
                                                                 "IsActive"        => "1",
                                                                 "UserRole"        => "Admin",
                                                                 "LoginName"       => $_POST['LoginName'],
                                                                 "FranchiseeID"    => $loginInfo[0]['FranchiseeID'],
                                                                 "ReferedBy"       => "0",
                                                                 "CreatedOn"       => date("Y-m-d H:i:s"), 
                                                                 "LoginPassword"   => $_POST['LoginPassword']));
                                                                       
           $mail2 = new MailController();
           $mail2->NewFranchiseeStaff(array("mailTo"         => $_POST['EmailID'] ,
                                             "StaffName"      => $_POST['staffName'],
                                             "StaffCode"      => $_POST['staffCode'],
                                             "FranchiseeName" => $login['FranchiseeName'],
                                             "LoginName"      => $_POST['LoginName'],
                                             "LoginPassword"  => $_POST['LoginPassword']));   
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function GetFranchiseeStaffCodeCode(){
            return Response::returnSuccess("success",array("staffCode" => SeqMaster::GetNextFranchiseeStaffNumber(),
                                                           "Gender"     => CodeMaster::getData('SEX')));
        }
    function EditFranchiseeStaff(){
              global $mysql,$loginInfo;    
                $data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."' and PersonID <>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("EmailID Already Exists");    
              }
                
                $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".$_POST['MobileNumber']."' and PersonID <>'".$_POST['Code']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("Mobile Number Already Exists");
                }   
                 $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_POST['Code']."'");
                  $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
                    $mysql->execute("update _tbl_franchisees_staffs set PersonName='".$_POST['staffName']."', 
                                                           Sex='".$_POST['Sex']."', 
                                                           DateofBirth='".$dob."',
                                                           CountryCode='".$_POST['CountryCode']."',
                                                           MobileNumber='".$_POST['MobileNumber']."',
                                                           EmailID='".$_POST['EmailID']."',                                 
                                                           UserRole='".$_POST['UserRole']."',
                                                           LoginPassword='".$_POST['LoginPassword']."'
                                                           where  PersonID='".$Staffs[0]['PersonID']."'");
                return Response::returnSuccess("success",array());
                                                                                               
    } 
    function GetStaffs(){
           global $mysql,$loginInfo;    
              
              $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where PersonID='".$_POST['Code']."'");
              $Sex =   $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$Staffs[0]['Sex']."'");
                return Response::returnSuccess("success",array("Staffs" => $Staffs,
                                                                "Gender"     =>$Sex));
    }
    function GetFranchiseeInfo(){
             global $mysql,$loginInfo;
             $Franchisee=$mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'"); 
             $Franchisee[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             return Response::returnSuccess("success",$Franchisee[0]);
         }
    function GetFranchiseeInformation(){
             global $mysql,$loginInfo;
             $Franchisee=$mysql->select("select * from `_tbl_franchisees` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'"); 
             $Franchisee[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             return Response::returnSuccess("success",$Franchisee[0]);
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
              return Response::returnSuccess("Password Changed Successfully",array());
              }
                                                            
    } 
  function GetDraftProfileInformation() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");               
             $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `IsDeleted`='0' and `ProfileCode`='".$_POST['ProfileCode']."'"); 
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
                                                          
             return Response::returnSuccess("success"."select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$Profiles[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'",array("ProfileInfo"            => $Profiles[0],
                                                            "ProfilePhotos"          => $ProfilePhoto,
                                                            "ProfilePhotoFirst"      => $ProfilePhotoFirst[0]['ProfilePhoto'],        
                                                            "EducationAttachments"   => $Educationattachments,
                                                            "Documents"              => $Documents,
                                                            "Members"                => $members[0],
                                                            "PartnerExpectation"     => $PartnersExpectations[0], 
                                                            "ProfileSignInFor"       => CodeMaster::getData('PROFILESIGNIN'),
                                                            "Gender"                 => CodeMaster::getData('SEX'),
                                                            "MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "Community"              => CodeMaster::getData('COMMUNITY'),
                                                            "Nationality"            => CodeMaster::getData('NATIONALNAMES'),
                                                            "EmployedAs"             => CodeMaster::getData('OCCUPATIONS'),
                                                            "Occupation"             => CodeMaster::getData('Occupation'),
                                                            "TypeofOccupation"       => CodeMaster::getData('TYPEOFOCCUPATIONS'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
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
                                                            "NumberofMarriedSisters" => CodeMaster::getData('MARRIEDSIS'),
                                                            "PhysicallyImpaired"     => CodeMaster::getData('PHYSICALLYIMPAIRED'),
                                                            "VisuallyImpaired"       => CodeMaster::getData('VISUALLYIMPAIRED'),
                                                            "VissionImpaired"        => CodeMaster::getData('VISSIONIMPAIRED'),
                                                            "SpeechImpaired"         => CodeMaster::getData('SPEECHIMPAIRED'),
                                                            "Height"                 => CodeMaster::getData('HEIGHTS'),
                                                            "Weight"                 => CodeMaster::getData('WEIGHTS'),
                                                            "BloodGroup"             => CodeMaster::getData('BLOODGROUPS'),
                                                            "Complexation"           => CodeMaster::getData('COMPLEXIONS'),
                                                            "BodyType"               => CodeMaster::getData('BODYTYPES'),
                                                            "Diet"                   => CodeMaster::getData('DIETS'),
                                                            "SmookingHabit"          => CodeMaster::getData('SMOKINGHABITS'),
                                                            "DrinkingHabit"          => CodeMaster::getData('DRINKINGHABITS'),
                                                            "DocumentType"           => CodeMaster::getData('DOCTYPES'),
                                                            "CountryName"            => CodeMaster::getData('RegisterAllowedCountries'),
                                                            "RasiName"               => CodeMaster::getData('MONSIGNS'),
                                                            "Lakanam"                => CodeMaster::getData('LAKANAM'),
                                                            "StarName"               => CodeMaster::getData('STARNAMES'),
                                                            "AllCountryName"        => CodeMaster::getData('CONTNAMES'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "ParentsAlive"              => CodeMaster::getData('PARENTSALIVE'),
                                                            "ChevvaiDhosham"              => CodeMaster::getData('CHEVVAIDHOSHAM'),
                                                            "PrimaryPriority"              => CodeMaster::getData('PRIMARYPRIORITY'),
                                                            "StateName"              => CodeMaster::getData('STATNAMES')));
         }   
          
    function EditDraftGeneralInformation() {
             
             global $mysql, $loginInfo;
             
            $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $Sex            = CodeMaster::getData("SEX",$_POST['Sex']);
             $MotherTongue   = CodeMaster::getData("LANGUAGENAMES",$_POST['Language']); 
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Community      = CodeMaster::getData("COMMUNITY",$_POST['Community']);  
             $Nationality    = CodeMaster::getData("NATIONALNAMES",$_POST['Nationality']);  
             $Childrens     = CodeMaster::getData("NUMBEROFBROTHER",$_POST['HowManyChildren']); 
             
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
          
             $updateSql =  "update `_tbl_draft_profiles` set `ProfileFor`        = '".$_POST['ProfileFor']."',
                                                           `ProfileName`       = '".$_POST['ProfileName']."',
                                                           `DateofBirth`       = '".$dob."',
                                                           `SexCode`           = '".$_POST['Sex']."',
                                                           `Sex`               = '".trim($Sex[0]['CodeValue'])."',
                                                           `MaritalStatusCode` = '".$_POST['MaritalStatus']."',
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
              $updateSql .= "where ProfileCode='".$_POST['Code']."'";                                                  
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberGeneralinformationupdated.',
                                                             "ActivityString" => 'Member General Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` and `ProfileCode`='".$_POST['Code']."'");      
             
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
             $SAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0'");
              $AttachAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0' and `AttachmentID`='".$_POST['AttachmentID']."'");
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
                                                                    `OccupationTypeCode`   = '',
                                                                    `OccupationType`       = '',
                                                                    `TypeofOccupationCode` = '',
                                                                    `TypeofOccupation`     = '',
                                                                    `AnnualIncomeCode`     = '',
                                                                    `WorkedCountryCode`    = '',
                                                                    `WorkedCountry`        = '',
                                                                    `WorkedCityName`        = '',
                                                                    `OccupationDescription`        = '',
                                                                    `OccupationAttachFileName`= '',
                                                                    `OccupationAttachmentType`= '',
                                                                    `OccupationDetails`   = '".$_POST['OccupationDetails']."',
                                                                    `LastUpdatedOn`     = '',
                                                                    `AnnualIncome`         = ''";
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
             $marriedSister     = CodeMaster::getData("MARRIEDSIS",$_POST['marriedSister']);
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
             $updateSql = "update `_tbl_draft_profiles` set `FathersName`           = '".$_POST['FatherName']."',
                                                           `FathersOccupationCode` = '".$_POST['FathersOccupation']."',
                                                           `FathersOccupation`     = '".$FathersOccupation[0]['CodeValue']."',
                                                           `FatherOtherOccupation`     = '',
                                                           `FathersContactCountryCode` = '".$_POST['FathersContactCountryCode']."',
                                                           `FathersContact`        = '".$_POST['FathersContact']."',
                                                           `FathersIncomeCode`         = '".$_POST['FathersIncome']."',
                                                           `FathersIncome`         = '".$FathersIncome[0]['CodeValue']."',
                                                           `FathersAlive`       = '".$Fathersstatus."',
                                                           `MothersName`           = '".$_POST['MotherName']."',
                                                           `MothersContactCountryCode`= '".$_POST['MotherContactCountryCode']."',
                                                           `MothersContact`        = '".$_POST['MotherContact']."',
                                                           `MothersIncomeCode`     = '".$_POST['MothersIncome']."',
                                                           `MothersIncome`         = '".$MothersIncome[0]['CodeValue']."',
                                                           `MothersAlive`           = '".$Mothersstatus."',
                                                           `FamilyLocation1`        = '".$_POST['FamilyLocation1']."',
                                                           `FamilyLocation2`        = '".$_POST['FamilyLocation2']."',
                                                           `Ancestral`              = '".$_POST['Ancestral']."',
                                                           `FamilyTypeCode`        = '".$_POST['FamilyType']."',
                                                           `FamilyType`            = '".$FamilyType[0]['CodeValue']."',              
                                                           `FamilyValueCode`       = '".$_POST['FamilyValue']."',
                                                           `FamilyValue`           = '".$FamilyValue[0]['CodeValue']."',
                                                           `FamilyAffluenceCode`   = '".$_POST['FamilyAffluence']."',
                                                           `FamilyAffluence`       = '".$FamilyAffluence[0]['CodeValue']."',
                                                           `AboutMyFamily`       = '".$_POST['AboutMyFamily']."',
                                                           `MothersOccupationCode` = '".$_POST['MothersOccupation']."',
                                                           `MothersOccupation`     = '".$MothersOccupation[0]['CodeValue']."',
                                                           `MotherOtherOccupation`     = '',
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
                                                           `MarriedSister`         = '".$marriedSister[0]['CodeValue']."'";
                                                           
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
             
              $updateSql .= " where ProfileCode='".$_POST['Code']."'";
             $mysql->execute($updateSql);
             
             
             $id = $mysql->insert("_tbl_logs_activity",array("Franchisee"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberFamilyinformationupdated.',
                                                             "ActivityString" => 'Member Family Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");      
      
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
                                                           `DrinkingHabit`          = '".$DrinkingHabit[0]['CodeValue']."' where ProfileCode='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberPhysicalinformationupdated.',
                                                             "ActivityString" => 'Member Physical Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");      
             
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
                                                            `OtherLocation`  = '".$_POST['OtherLocation']."' where `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
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
             $mysql->execute("update `_tbl_draft_profiles_photos` set `IsDelete`='1' where `ProfilePhotoID`='".$_POST['ProfilePhotoID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
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
                                                            `A16`            = '".$_POST['A16']."' where `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"       => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'MemberHoroscopeDetailsUpdated.',
                                                             "ActivityString" => 'Member Horoscope Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");      
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

             $updateSql = "update `_tbl_draft_profiles_education_details` set `IsDeleted` = '1' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
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
             
             $updateSql = "update `_tbl_draft_profiles_education_details` set `FileName` = '' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);
             $updateSql = "update `_tbl_draft_profile_education_attachments` set `FileName` = '' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
          
               return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Attachment has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/EducationDetails/'.$ProfileCode.'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
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
                return Response::returnError("Please select ProfileFor");
             }

             if (!(strlen(trim($_POST['ProfileName']))>0)) {
                return Response::returnError("Please enter your name");
             }
             
             if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0" )) {
                return Response::returnError("Please select sex");
             }
             
             $member =$mysql->select("Select * from `_tbl_members` where `MemberCode`='".$_POST['MemberCode']."'");
             if (sizeof($member)>0)  {
             $ProfileFors   = CodeMaster::getData("PROFILESIGNIN",$_POST["ProfileFor"]);
             $Sex           = CodeMaster::getData("SEX",$_POST["Sex"]); 
             $ProfileCode   =SeqMaster::GetNextDraftProfileCode();
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
             $id =  $mysql->insert("_tbl_draft_profiles",array("ProfileCode"      => $ProfileCode,
                                                               "ProfileForCode"    => $ProfileFors[0]['SoftCode'],
                                                              "ProfileFor"        => $ProfileFors[0]['CodeValue'],
                                                              "ProfileName"       => $_POST['ProfileName'],
                                                              "DateofBirth"       => $dob,        
                                                              "SexCode"           => $_POST['Sex'],      
                                                              "Sex"               => $Sex[0]['CodeValue'],      
                                                              "CreatedOn"         => date("Y-m-d H:i:s"), 
                                                              "MemberID"          => $member[0]['MemberID'],
                                                              "MemberCode"        => $member[0]['MemberCode'],
                                                              "CreatedByFranchiseeStaffID" => $loginInfo[0]['FranchiseeID']));
             if (sizeof($id)>0) {
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='DraftProfile'");
                 return Response::returnSuccess("success",array("Code"=>$ProfileCode));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
             } else{
                 return Response::returnError("Access denied. Please contact support..");     
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
          
        function PublishMemberProfile() {

             global $mysql,$loginInfo ;
             
                $EducationDetails =$mysql->select("Select * from `_tbl_draft_profiles_education_details` where `IsDeleted`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                 if (sizeof($EducationDetails)==0) {
                        return '<div style="background:white;width:100%;padding:20px;height:100%;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Missing</h4>  <br><br>
                                    <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                                    <h5 style="text-align:center;color:#ada9a9">You must Provide Your Education Details.</h5>
                                    <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/EducationDetails/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                               </div>'; 
                     }
                 $Documents =$mysql->select("Select * from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                 if (sizeof($Documents)==0) {
                        return '<div style="background:white;width:100%;padding:20px;height:100%;">
                                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Missing</h4>  <br><br>
                                    <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                                    <h5 style="text-align:center;color:#ada9a9">You must upload Documents Details.</h5>
                                    <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/DocumentAttachment/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                               </div>';                                                                      
                     }
                 $ProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                     if (sizeof($ProfilePhoto)==0) {
                            return '<div style="background:white;width:100%;padding:20px;height:100%;">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Missing</h4>  <br><br>
                                        <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                                        <h5 style="text-align:center;color:#ada9a9">You must upload Profile photo.</h5>
                                        <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/ProfilePhoto/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                                   </div>'; 
                         }
                 $DefaultProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `PriorityFirst`='1' and `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                     if (sizeof($DefaultProfilePhoto)==0) {
                            return '<div style="background:white;width:100%;padding:20px;height:100%;">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Missing</h4>  <br><br>
                                        <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                                        <h5 style="text-align:center;color:#ada9a9">You must Select Default Profile photo.</h5>
                                        <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/ProfilePhoto/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                                   </div>'; 
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
                            return '<div style="background:white;width:100%;padding:20px;height:100%;">
                                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Missing</h4>  <br><br>
                                        <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                                        <h5 style="text-align:center;color:#ada9a9">You must enter'.$About.'.</h5>
                                        <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/GeneralInformation/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                                   </div>'; 
                         } 
                if (strlen(trim($AboutMyself[0]['AboutMyFamily']))==0) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Missing</h4>  <br><br>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">You must enter about your family.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/FamilyInformation/'.$_POST['ProfileID'].'.htm" style="cursor:pointer">continue</a> <h5>
                       </div>'; 
             }
             
             $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
             
              $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   

                    $updateSql = "update `_tbl_draft_profiles` set  `RequestToVerify`      = '1',
                                                            `RequestVerifyOn`      = '".date("Y-m-d H:i:s")."'
                                                             where  `MemberID`='".$member[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
                                                             
             $id = $mysql->insert("_tbl_logs_activity",array("FranchiseeID"   => $loginInfo[0]['FranchiseeID'],
                                                             "ActivityType"   => 'RequestToVerifyPublishProfile.',
                                                             "ActivityString" => 'Request To Verify PublishProfile.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                  return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Publish Profile</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>            
                            <h5 style="text-align:center;color:#ada9a9">Your profile publish request has been submitted.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         } 
         
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
                 $data = $mysql->select("select * from `_tbl_franchisees_staffs` where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'");
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

             $sql = "SELECT * From `_tbl_franchisees_staffs` ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsActive`='1'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsActive`='0'"));    
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
             
             return Response::returnSuccess("success",array("Member"           =>$Member[0],
                                                            "DraftedProfiles"  =>$DraftedProfiles[0],
                                                            "PostedProfiles"   =>$PostedProfiles[0]));
         }
         function GetDraftedProfiles() {
           global $mysql,$loginInfo;    
             $sql = "SELECT *
                                    FROM _tbl_draft_profiles
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_draft_profiles.MemberID=_tbl_members.MemberID where _tbl_draft_profiles.CreatedByFranchiseeStaffID='".$loginInfo[0]['FranchiseeStaffID']."'";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Draft") {
                return Response::returnSuccess("success".$sql,$mysql->select($sql." and _tbl_draft_profiles.RequestToVerify='0'"));    
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

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and  `RequestToVerify`='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and  RequestToVerify='1'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."' and  `MemberID` = '".$loginInfo[0]['MemberID']."'");
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
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and RequestToVerify='0'");
                 
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
             
             $updateSql = "update `_tbl_draft_profiles` set `OccupationAttachFileName` = '' ,`OccupationAttachmentType` = '0' where `ProfileID`='".$_POST['ProfileID']."' and`ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$_POST['MemberID']."'";
             $mysql->execute($updateSql);
          
               return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Attachment has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/OccupationDetails/'.$ProfileCode.'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';                             

         }
         function SendRequestForEditPostedProfile() {

             global $mysql,$loginInfo;
             
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");

             $updateSql = "update `_tbl_draft_profiles` set `RequestToVerify` = '0' where `ProfileCode`='".$_POST['ProfileCode']."'";
             $mysql->execute($updateSql);
                  $mysql->insert("_tbl_request_edit",array("MemberID"                => $loginInfo[0]['MemberID'],
                                                           "ProfileID"               => $Profiles[0]['ProfileID'],
                                                           "EditRequestFromPostedOn" => date("Y-m-d H:i:s")));
            
               return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Profile</h4>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MemberProfileEdit/'.$_POST['FileName'].'/'.$_POST['ProfileCode'].'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
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

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and `MemberID`='".$_POST['Code']."' and  `RequestToVerify`='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and `MemberID`='".$_POST['Code']."' and  RequestToVerify='1'");
                 
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
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `CreatedByFranchiseeStaffID`='".$loginInfo[0]['FranchiseeStaffID']."' and RequestToVerify='0'");
                 
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
             
             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$_POST['Code']."'");
             $Franchisee = $mysql->select("select * from `_tbl_franchisees` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeTransferAmountToMember'");
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['FranchiseName'],$mContent[0]['Content']);
             $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#Amount#",$_POST['AmountToTransfer'],$content);

             MailController::Send(array("MailTo"   => $Franchisee[0]['ContactEmail'],
                                        "Category" => "AdminTransferAmountToFranchisee",
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
                                                                   
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberAmountReceivedFromAdmin'");
        
            
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
          
            if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="WalletRequests") {
                 $Requests = $mysql->select("select * from `_tbl_wallet_bankrequests` where `MemberID`='".$_POST['Code']."' and `IsMember`='1' order by `ReqID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="WalletTransactions") {
                 $Requests = $mysql->select("select * from `_tbl_wallet_transactions` where `MemberID`='".$_POST['Code']."' and `IsMember`='1' order by `TxnID` DESC");
             return Response::returnSuccess("success",$Requests);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Recentlyviewed") {
                
                 $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterMemberID` = '".$_POST['Code']."' order by LastSeenID DESC");
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
                 $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$_POST['Code']."' ORDER BY `LoginID` DESC LIMIT 0,10");
             return Response::returnSuccess("success",$LoginHistory);
             }
             if (isset($_POST['DetailFor']) && $_POST['DetailFor']=="Activities") {
                 $Activities = $mysql->select("select * from `_tbl_logs_activity` where `MemberID`='".$_POST['Code']."' ORDER BY `ActivityID` DESC LIMIT 0,5");
             return Response::returnSuccess("success",$Activities);
             }
         }
    }
//2747    
?> 