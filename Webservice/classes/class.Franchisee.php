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
        $data = $mysql->select("select * from _tbl_members where  EmailID='".$_POST['EmailID']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        $data = $mysql->select("select * from _tbl_members where  MobileNumber='".$_POST['MobileNumber']."'");
        if (sizeof($data)>0) {
            return Response::returnError("MobileNumber Already Exists");
        }
        if (strlen(trim($_POST['WhatsappNumber']))>0) {
        $data = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("WhatsappNumber Already Exists");
        }
        }
        $data = $mysql->select("select * from _tbl_members where  AadhaarNumber='".$_POST['AadhaarNumber']."'");
        if (sizeof($data)>0) {
            return Response::returnError("AadhaarNumber Already Exists");
        }
        if (!(strlen(trim($_POST['MemberName']))>0)) {
            return Response::returnError("Please enter your name");
        }
        if (!(strlen(trim($_POST['DateofBirth']))>0)) {
            return Response::returnError("Please enter your DateofBirth");
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
        if (!(strlen(trim($_POST['AadhaarNumber']))>0)) {
            return Response::returnError("Please enter AadhaarNumber");
        }
        if (!(strlen(trim($_POST['LoginPassword']))>0)) {
            return Response::returnError("Please enter MemberPassword");    
        }
        $login = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'");
       $id =  $mysql->insert("_tbl_members",array("MemberCode"              => $_POST['MemberCode'],
                                                           "MemberName"               => $_POST['MemberName'],  
                                                           "DateofBirth"              => $_POST['DateofBirth'],
                                                           "Sex"                      => $_POST['Sex'],
                                                           "MobileNumber"             => $_POST['MobileNumber'],
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
            return Response::returnSuccess("success",$Member[0]);
        }
        function SearchMemberDetails() {
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
            $Members=$mysql->select($sql);   
            $index = 0;
            foreach($Members as $Member) {
               $v = $mysql->select("select * from _tbl_draft_profiles where CreatedBy='".$Member['MemberID']."'");   
               if ($v[0]['ProfileID']>0) {
               $Members[$index]['IsEditable']= ($v[0]['IsApproved']==0 && $v[0]['RequestToVerify']==0) ? 1 : 0 ;
               $Members[$index]['ProfilesID']= $v[0]['ProfileID']  ;
               $Members[$index]['NoOfProfile']= sizeof($v)  ;
                   
               } else {
                $Members[$index]['IsEditable']=  0;
                $Members[$index]['ProfilesID']= 0;
                $Members[$index]['NoOfProfile']= 0;
                   
               }
               $index++;
            } 
            return Response::returnSuccess("success",$Members);
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
              $data = $mysql->select("select * from  _tbl_members where EmailID='".trim($_POST['EmailID'])."' and MemberID <>'".$_POST['Code']."' ");
              if (sizeof($data)>0) {
                    return Response::returnError("EmailID Already Exists");    
              }
                                                       
                    $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                    EmailID='".$_POST['EmailID']."',
                                                    MobileNumber='".$_POST['MobileNumber']."',
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
       
       $id =  $mysql->insert("_tbl_franchisees_staffs",array("FrCode"          => $loginInfo[0]['FranchiseeCode'],
                                                                 "StaffCode"       => $_POST['staffCode'],   
                                                                 "PersonName"      => $_POST['staffName'], 
                                                                 "Sex"             => $_POST['Sex'], 
                                                                 "DateofBirth"     => $_POST['DateofBirth'],
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
              $sql="select * from _tbl_franchisees_staffs where PersonID='".$_POST['Code']."'";
                return Response::returnSuccess("success",$Staffs);
    }
    function GetFranchiseeInfo(){
             global $mysql,$loginInfo;
             $Franchisee=$mysql->select("select * from `_tbl_franchisees_staffs` where `FranchiseeID`='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'"); 
             $Franchisee[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             return Response::returnSuccess("success"."select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['FranchiseeStaffID']."'",$Franchisee[0]);
         }
    function GetRefillWalletBankNameAndMode(){
           global $mysql,$loginInfo;    
              $BankName = $mysql->select("select * from `_tbl_bank_details`");
                return Response::returnSuccess("success",array("BankName" => $BankName,
                                                           "ModeOfTransfer" => CodeMaster::getData('MODEOFTRANSFER')));
                                                            
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
              $getpassword = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['StaffID']."'");
              if ($getpassword[0]['LoginPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Currentpassword"); } 
                                                      
              if ($getpassword[0]['LoginPassword']==$_POST['CurrentPassword']) {                                         
                    $mysql->execute("update _tbl_franchisees_staffs set LoginPassword='".$_POST['ConfirmNewPassword']."' where FranchiseeID='".$loginInfo[0]['FranchiseeID']."' and PersonID='".$loginInfo[0]['StaffID']."'");
              return Response::returnSuccess("Password Changed Successfully",array());
              }
                                                            
    } 
  function GetDraftProfileInformation() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");               
             $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `IsDeleted`='0' `ProfileCode`='".$_POST['ProfileCode']."'"); 
             $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['CreatedBy']."'");    
             $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
             $ProfilePhoto =      $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$Profiles[0]['CreatedBy']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
             
             $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$Profiles[0]['CreatedBy']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$_POST['ProfileCode']."'");
              $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$Profiles[0]['CreatedBy']."' and `IsDeleted`='0' and ProfileCode='".$Profiles[0]['ProfileCode']."'");
             
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
              
             $ProfilePhotoFirst = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$Profiles[0]['CreatedBy']."' and `IsDelete`='0' and `PriorityFirst`='1'");   
             
             if (sizeof($ProfilePhotoFirst)==0) {
                  for($i=sizeof($ProfilePhoto);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                        }
                   else{
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                        }
                  }  
              }
                                                          
             return Response::returnSuccess("success",array("ProfileInfo"            => $Profiles[0],
                                                            "ProfilePhotos"          => $ProfilePhoto,
                                                            "ProfilePhotoFirst"      => $ProfilePhotoFirst[0],        
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
                                                            "StateName"              => CodeMaster::getData('STATNAMES')));
         }   
          /* function GetDraftProfileInformation($ProfileCode="",$rtype="") {
             
             $ProfileCode = $ProfileCode != "" ? $ProfileCode : $_POST['ProfileCode'];
             
             global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where ProfileCode='".$ProfileCode."'");               
             
             $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['CreatedBy']."'");     
             $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
             $ProfilePhoto =      $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_draft_profiles_photos` where `ProfileID`='".$Profiles[0]['ProfileID']."' and `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
             
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
              
            
             $ProfilePhotoFirst = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_draft_profiles_photos` where `ProfileID`='".$Profiles[0]['ProfileID']."' and `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");                                        
              $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
              $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$Profiles[0]['CreatedBy']."' and `IsDelete`='0'  and ProfileID='".$Profiles[0]['ProfileID']."'");
              
             if (sizeof($ProfilePhotoFirst)==0) {
                  for($i=sizeof($ProfilePhoto);$i<4;$i++) {
                    if ($Profiles[0]['SexCode']=="SX002"){
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_female.png";
                        }
                   else{
                        $ProfilePhotoFirst[0]['ProfilePhoto'] = AppPath."assets/images/noprofile_male.png";
                        }
                  }  
              }
             
              $result = array("ProfileInfo"            => $Profiles[0],
                              "ProfileCode"                =>$ProfileCode,
                              "Members"                => $members[0],
                              "EducationAttachments"   => $Educationattachments,
                              "Documents"   => $Documents,
                              "PartnerExpectation"     => $PartnersExpectations[0],
                              "ProfilePhotos"           => $ProfilePhoto,
                              "ProfilePhotoFirst"      => $ProfilePhotoFirst[0],
                              
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
                                                            "CountryName"           => CodeMaster::getData('RegisterAllowedCountries'),
                                                            "AllCountryName"        => CodeMaster::getData('CONTNAMES'),
                                                            "RasiName"               => CodeMaster::getData('MONSIGNS'),
                                                            "Lakanam"                => CodeMaster::getData('LAKANAM'),
                                                            "StarName"               => CodeMaster::getData('STARNAMES'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "StateName"              => CodeMaster::getData('STATNAMES'));
             if ($rtype=="")  {
             return Response::returnSuccess("success",$result);
             } else {
                 return  $result;
             }                                                                                                              
         }    */
    function EditDraftGeneralInformation() {
             
             global $mysql, $loginInfo;
             
             $dob = strtotime($_POST['DateofBirth']);
             $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
             
             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $Sex            = CodeMaster::getData("SEX",$_POST['Sex']);
             $MotherTongue   = CodeMaster::getData("LANGUAGENAMES",$_POST['Language']); 
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Community      = CodeMaster::getData("COMMUNITY",$_POST['Community']);  
             $Nationality    = CodeMaster::getData("NATIONALNAMES",$_POST['Nationality']);  
          
             $updateSql = "update `_tbl_draft_profiles` set `ProfileFor`        = '".$_POST['ProfileFor']."',
                                                           `ProfileName`       = '".$_POST['ProfileName']."',
                                                           `DateofBirth`       = '".$dob."',
                                                           `SexCode`           = '".$_POST['Sex']."',
                                                           `Sex`               = '".$Sex[0]['CodeValue']."',
                                                           `MaritalStatusCode` = '".$_POST['MaritalStatus']."',
                                                           `MaritalStatus`     = '".$MaritalStatus[0]['CodeValue']."',
                                                           `MotherTongueCode`  = '".$_POST['Language']."',
                                                           `MotherTongue`      = '".$MotherTongue[0]['CodeValue']."',
                                                           `ReligionCode`      = '".$_POST['Religion']."',
                                                           `Religion`          = '".$Religion[0]['CodeValue']."',
                                                           `CasteCode`         = '".$_POST['Caste']."',
                                                           `Caste`             = '".$Caste[0]['CodeValue']."',
                                                           `Country`           = '".$_POST['Country']."',
                                                           `StateCode`         = '".$_POST['StateName']."',
                                                           `State`             = '".$State[0]['CodeValue']."',
                                                           `City`              = '".$_POST['City']."',
                                                           `OtherLocation`     = '".$_POST['OtherLocation']."',
                                                           `CommunityCode`     = '".$_POST['Community']."',
                                                           `Community`         = '".$Community[0]['CodeValue']."',
                                                           `NationalityCode`   = '".$_POST['Nationality']."',
                                                           `Nationality`       = '".$Nationality[0]['CodeValue']."',
                                                           `AboutMe`           = '".$_POST['AboutMe']."' where ProfileCode='".$_POST['Code']."'";
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
             return Response::returnSuccess("success",array("Attachments"     =>$SAttachments,
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
             $updateSql = "update `_tbl_draft_profiles` set  `EmployedAsCode`       = '".$_POST['EmployedAs']."',
                                                            `EmployedAs`           = '".$EmployedAs[0]['CodeValue']."',
                                                            `OccupationTypeCode`   = '".$_POST['OccupationType']."',
                                                            `OccupationType`       = '".$OccupationType[0]['CodeValue']."',
                                                            `TypeofOccupationCode` = '".$_POST['TypeofOccupation']."',
                                                            `TypeofOccupation`     = '".$TypeofOccupation[0]['CodeValue']."',
                                                            `AnnualIncomeCode`     = '".$_POST['IncomeRange']."',
                                                            `WorkedCountryCode`     = '".$_POST['WCountry']."',
                                                            `WorkedCountry`     = '".$Country[0]['CodeValue']."',
                                                            `AnnualIncome`         = '".$IncomeRange[0]['CodeValue']."' where `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
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
             $PartnersExpectation = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `CreatedBy`='".$Profiles[0]['CreatedBy']."' and ProfileCode='".$_POST['ProfileCode']."'");               
             return Response::returnSuccess("success",array("ProfileInfo"            =>$PartnersExpectation[0],
                                                            "MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "EmployedAs"              => CodeMaster::getData('OCCUPATIONS')));
         }
         function AddPartnersExpectaion() {

             global $mysql,$loginInfo;    

             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Education          = CodeMaster::getData("EDUCATETITLES",$_POST['Education']);  
             $EmployedAs       = CodeMaster::getData("OCCUPATIONS",$_POST["EmployedAs"]) ;
             $IncomeRange      = CodeMaster::getData("INCOMERANGE",$_POST["IncomeRange"]) ;
               $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");
             $check =  $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `CreatedBy`='".$Profiles[0]['CreatedBy']."' and ProfileCode='".$_POST['Code']."'");                      
             if (sizeof($check)>0) {
                   $updateSql = "update `_tbl_draft_profiles_partnerexpectation` set  `AgeFrom`           = '".$_POST['age']."',
                                                                         `AgeTo`             = '".$_POST['toage']."',
                                                                         `MaritalStatusCode` = '".$_POST['MaritalStatus']."',
                                                                         `MaritalStatus`     = '".$MaritalStatus[0]['CodeValue']."',
                                                                         `ReligionCode`      = '".$_POST['Religion']."',
                                                                         `Religion`          = '".$Religion[0]['CodeValue']."',
                                                                         `CasteCode`         = '".$_POST['Caste']."',
                                                                         `Caste`             = '". $Caste[0]['CodeValue']."',
                                                                         `EducationCode`     = '".$_POST['Education']."',
                                                                         `Education`         = '".$Education[0]['CodeValue']."',
                                                                         `AnnualIncomeCode`  = '".$_POST['IncomeRange']."',
                                                                         `AnnualIncome`      = '".$IncomeRange[0]['CodeValue']."',
                                                                         `EmployedAsCode`    = '".$_POST['EmployedAs']."',
                                                                         `EmployedAs`        = '".$EmployedAs[0]['CodeValue']."',
                                                                         `Details`           = '".$_POST['Details']."'
                                                                            where  `CreatedBy`='".$Profiles[0]['CreatedBy']."' and `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             } else {
                   $id = $mysql->insert("_tbl_draft_profiles_partnerexpectation",array("AgeFrom"             => $_POST['age'],
                                                                   "AgeTo"               => $_POST['toage'],
                                                                   "MaritalStatusCode"   => $_POST['MaritalStatus'],
                                                                   "MaritalStatus"       => $MaritalStatus[0]['CodeValue'],
                                                                   "ReligionCode"        => $_POST['Religion'],
                                                                   "Religion"            => $Religion[0]['CodeValue'],
                                                                   "CasteCode"           => $_POST['Caste'],
                                                                   "Caste"               => $Caste[0]['CodeValue'],
                                                                   "EducationCode"       => $_POST['Education'],
                                                                   "Education"           => $Education[0]['CodeValue'],
                                                                   "AnnualIncomeCode"    => $_POST['IncomeRange'],
                                                                   "AnnualIncome"        => $IncomeRange[0]['CodeValue'],
                                                                   "EmployedAsCode"      => $_POST['EmployedAs'],
                                                                   "EmployedAs"          => $EmployedAs[0]['CodeValue'],
                                                                   "Details"             => $_POST['Details'],
                                                                   "CreatedBy"           => $Profiles[0]['MemberID'],
                                                                   "ProfileCode"           => $_POST['Code'])) ;
             }
            return Response::returnSuccess("success",array("MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "EmployedAs"              => CodeMaster::getData('OCCUPATIONS')));
         }
         
         function EditDraftFamilyInformation() {
             
             global $mysql, $loginInfo;
             
             $FathersOccupation = CodeMaster::getData("Occupation",$_POST['FathersOccupation']);  
             $FamilyType        = CodeMaster::getData("FAMILYTYPE",$_POST['FamilyType']); 
             $FamilyValue       = CodeMaster::getData("FAMILYVALUE",$_POST['FamilyValue']);
             $FamilyAffluence   = CodeMaster::getData("FAMILYAFFLUENCE",$_POST['FamilyAffluence']);
             $MothersOccupation = CodeMaster::getData("Occupation",$_POST['MothersOccupation']);  
             $NumberofBrothers  = CodeMaster::getData("NUMBEROFBROTHER",$_POST['NumberofBrothers']);
             $younger           = CodeMaster::getData("YOUNGER",$_POST['younger']);
             $elder             = CodeMaster::getData("ELDER",$_POST['elder']);
             $married           = CodeMaster::getData("MARRIED",$_POST['married']);
             $NumberofSisters   = CodeMaster::getData("NOOFSISTER",$_POST['NumberofSisters']);
             $elderSister       = CodeMaster::getData("ELDERSIS",$_POST['elderSister']);
             $youngerSister     = CodeMaster::getData("YOUNGERSIS",$_POST['youngerSister']);
             $marriedSister     = CodeMaster::getData("MARRIEDSIS",$_POST['marriedSister']);
             
             $updateSql = "update `_tbl_draft_profiles` set `FathersName`           = '".$_POST['FatherName']."',
                                                           `FathersOccupationCode` = '".$_POST['FathersOccupation']."',
                                                           `FathersOccupation`     = '".$FathersOccupation[0]['CodeValue']."',
                                                           `MothersName`           = '".$_POST['MotherName']."',
                                                           `FamilyTypeCode`        = '".$_POST['FamilyType']."',
                                                           `FamilyType`            = '".$FamilyType[0]['CodeValue']."',
                                                           `FamilyValueCode`       = '".$_POST['FamilyValue']."',
                                                           `FamilyValue`           = '".$FamilyValue[0]['CodeValue']."',
                                                           `FamilyAffluenceCode`   = '".$_POST['FamilyAffluence']."',
                                                           `FamilyAffluence`       = '".$FamilyAffluence[0]['CodeValue']."',
                                                           `MothersOccupationCode` = '".$_POST['MothersOccupation']."',
                                                           `MothersOccupation`     = '".$MothersOccupation[0]['CodeValue']."',
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
                                                           `MarriedSister`         = '".$marriedSister[0]['CodeValue']."' where ProfileCode='".$_POST['Code']."'";
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
                return Response::returnError("Adharcard Already attached",$photos);
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
                                                                    "MemberID"          => $profiles[0]['CreatedBy']));
                 } else { 
                     return Response::returnError("Only 2 phots allowed",$photos);
                 }
             }
             $photos = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$profiles[0]['CreatedBy']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0' and Type='IDProof'");
             return Response::returnSuccess("success",$photos);
         }

         function EditDraftCommunicationDetails() {
             
             global $mysql,$loginInfo;
             
             $Country = CodeMaster::getData("CONTNAMES",$_POST['Country']);
             $State   = CodeMaster::getData("STATNAMES",$_POST['StateName']);
             
             $updateSql = "update `_tbl_draft_profiles` set `EmailID`        = '".$_POST['EmailID']."',
                                                            `MobileNumber`   = '".$_POST['MobileNumber']."',
                                                            `WhatsappNumber` = '".$_POST['WhatsappNumber']."',
                                                            `AddressLine1`   = '".$_POST['AddressLine1']."',
                                                            `AddressLine2`   = '".$_POST['AddressLine2']."',
                                                            `AddressLine3`   = '".$_POST['AddressLine3']."',
                                                            `CountryCode`    = '".$_POST['Country']."',
                                                            `Country`        = '".$Country[0]['CodeValue']."',
                                                            `StateCode`      = '".$_POST['StateName']."',
                                                            `State`          = '".$State[0]['CodeValue']."',
                                                            `City`           = '".$_POST['City']."',
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
             
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
              
             $MemberID =$mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'"); 
             
             if (isset($_POST['ProfilePhoto'])) {
                 if(sizeof($photos)<5){
                     $mysql->insert("_tbl_draft_profiles_photos",array("ProfileCode"    => $_POST['Code'],
                                                                "MemberID"    => $MemberID[0]['CreatedBy'],
                                                                "ProfilePhoto" => $_POST['ProfilePhoto'],
                                                                "UpdateOn"     => date("Y-m-d H:i:s")));
                 } else { 
                     return Response::returnError("Only 5 phots allowed",$photos);
                 }
             }
             
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             return Response::returnSuccess("success",$photos);
         }
         function DeletProfilePhoto() {
             
             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_draft_profiles_photos` set `IsDelete`='1' where `ProfilePhotoID`='".$_POST['ProfilePhotoID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
                 return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected profile photo  has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>';
                 
             
         }
         function EditDraftHoroscopeDetails() {
             global $mysql,$loginInfo;
             $StarName  = CodeMaster::getData("STARNAMES",$_POST['StarName']);
             $RasiName  = CodeMaster::getData("MONSIGNS",$_POST['RasiName']);
             $Lakanam   = CodeMaster::getData("LAKANAM",$_POST['Lakanam']);
             $updateSql = "update `_tbl_draft_profiles` set  `StarNameCode`  = '".$_POST['StarName']."',
                                                            `StarName`      = '".$StarName[0]['CodeValue']."',
                                                            `LakanamCode`   = '".$_POST['Lakanam']."',
                                                            `Lakanam`       = '".$Lakanam[0]['CodeValue']."',
                                                            `RasiNameCode`  = '".$_POST['RasiName']."',
                                                            `RasiName`      = '".$RasiName[0]['CodeValue']."',
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
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected document has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal"  >Yes</a> <h5>
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
                 return  $updateSql.'<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your attachment has been deleted.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>';

         }
         function GetCodeMasterDatas() {
             return Response::returnSuccess("success",array("Gender"        => CodeMaster::getData("SEX")));
         }
         function CreateProfile() {

             global $mysql,$loginInfo;

             if (!(strlen(trim($_POST['ProfileName']))>0)) {
                return Response::returnError("Please enter your name");
             }
             if (!(strlen(trim($_POST['DateofBirth']))>0)) {
                return Response::returnError("Please enter your date of birth");
             }
             if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0" )) {
                return Response::returnError("Please select sex");
             }
             $Sex           = CodeMaster::getData("SEX",$_POST["Sex"]); 
             $ProfileCode   =SeqMaster::GetNextDraftProfileCode();
             $id =  $mysql->insert("_tbl_draft_profiles",array("ProfileCode"      => $ProfileCode,
                                                              "ProfileName"       => $_POST['ProfileName'],
                                                              "DateofBirth"       => $_POST['DateofBirth'],        
                                                              "SexCode"           => $_POST['Sex'],      
                                                              "Sex"               => $Sex[0]['CodeValue'],      
                                                              "CreatedOn"         => date("Y-m-d H:i:s"),        
                                                              "CreatedBy"         => $loginInfo[0]['MemberID']));
             if (sizeof($id)>0) {
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='DraftProfile'");
                 return Response::returnSuccess("success",array("Code"=>$ProfileCode));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function AddEducationalDetails() {
             global $mysql,$loginInfo;
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'"); 
             $id = $mysql->insert("_tbl_draft_profiles_education_details",array("EducationDetails" => $_POST['Educationdetails'],
                                                                  "EducationDegree"  => $_POST['EducationDegree'],
                                                                  "EducationRemarks"  => $_POST['EducationRemarks'],
                                                                  "ProfileID"        => $profile[0]['ProfileID'],
                                                                  "ProfileCode"        => $_POST['Code'],
                                                                  "MemberID"         => $loginInfo[0]['MemberID']));
             return (sizeof($id)>0) ? Response::returnSuccess("success"."update `_tbl_draft_profiles_verificationdocs` set `IsDelete` = '1' where `AttachmentID`='".$_POST['AttachmentID']."' and `ProfileCode`='".$_POST['ProfileCode']."'",$_POST)
                                    : Response::returnError("Access denied. Please contact support");   
         }
         function ProfilePhotoBringToFront() {

             global $mysql,$loginInfo;
             
             $ProfilePhotoID = $_GET['ProfilePhotoID'];
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst`='0' where `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst` = '1' where `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
          }
        }
?>