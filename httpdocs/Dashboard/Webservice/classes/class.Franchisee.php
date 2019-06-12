<?php
    define("ImagePath","http://nahami.online/sl/Dashboard/images/");
    
    class Franchisee {
        
        function Login() {
            
            global $mysql;  
        
            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter username ");
            }
            
            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }
        
            $data=$mysql->select("select * from _tbl_franchisees_staffs where LoginName='".$_POST['UserName']."' and LoginPassword='".$_POST['Password']."'") ;
            
            if (sizeof($data)>0) {
                
                $loginid = $mysql->insert("_tbl_franchisee_login",array("LoginOn"      => date("Y-m-d H:i:s"),
                                                                        "FranchiseeID" => $data[0]['FranchiseeID']));
                $data[0]['LoginID']=$loginid;
                
                if ($data[0]['IsActive']==1) {
                    return Response::returnSuccess("success",$data[0]);
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
                
            } else {
                return Response::returnError("Invalid username and password");
            }
        }
       
        function CheckVerification() {
            
            global $mysql;
            
            $loginid = $_GET['LoginID'];
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==0) {
               return $this->ChangeMobileNumberFromVerificationScreen("",$loginid,"","");
            }
            
            if ($franchiseedata[0]['IsEmailVerified']==0) {
               return $this->ChangeEmailFromVerificationScreen("",$loginid,"","");
            }
            
            return "<script>location.href='';</script>";
        }
        
        function VisitedWelcomeMsg(){
            global $mysql;
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$_GET['LoginID']."'");     
            $welcome=$mysql->execute("update _tbl_franchisees_staffs set WelcomeMsg='1' where  FranchiseeID='".$login[0]['FranchiseeID']."'");
            return true;
        }
        
        function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="FEmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                
                $formid = "frmChangeMobileNumber_".rand(30,3000);
             
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;padding-top: 10%;">Please verify your mobile number</h4>
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
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="FEmailVerificationForm()">Continue</a>
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
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-4" style="text-align:center"><button type="button" onclick="MobileNumberVerificationForm(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Save and verify</button></div>
                                    <div class="col-sm-6" style="text-align:center;line-height: 30px;"><a  href="javascript:void(0)" onclick="FCheckVerification()">back</a></div>
                                </div>
                            </div>
                           </div>
                        </form>                                                                                                       
                        </div>'; 
            }   
        }
        
        function MobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
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
                
                $mysql->execute("update _tbl_franchisees_staffs set MobileNumber='".$_POST['new_mobile_number']."' , CountryCode='".$_POST['CountryCode']."' where FranchiseeID='".$login[0]['FranchiseeID']."'");
            }
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
            if ($franchiseedata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="FEmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                          
                if ($error=="") {
                    $otp=rand(1111,9999);
                    MobileSMSController::sendSMS($franchiseedata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    $securitycode = $mysql->insert("_tbl_franchisee_verification_otp",array("FranchiseeID" =>$franchiseedata[0]['FranchiseeID'],
                                                                                 "SMSTo" =>$franchiseedata[0]['MobileNumber'],
                                                                                 "SecurityCode" =>$otp,
                                                                                 "messagedon"=>date("Y-m-d h:i:s"))) ; 
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
            
            $otpInfo = $mysql->select("select * from _tbl_franchisee_verification_otp where RequestID='".$_POST['reqId']."'");
             
            if (strlen(trim($_POST['mobile_otp_2']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['mobile_otp_2']))  {
                $sql = "update _tbl_franchisees_staffs set IsMobileVerified='1', MobileVerifiedOn='".date("Y-m-d H:i:s")."' where FranchiseeID='".$otpInfo[0]['FranchiseeID']."'";
                $mysql->execute($sql); 
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.ImagePath.'verifiedtickicon.jpg" width="10%"></p>
                            <h5 style="text-align:center;color:#ada9a9">
                                Great! Your number has been<br>
                                successfully verified.
                            </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="FCheckVerification()">Continue</a> <h5>
                       </div>';
            } else {
                return $this->MobileNumberVerificationForm("You entered, invalid pin.",$_POST['loginId'],$_POST['mobile_otp_2'],$_POST['reqId']);
            }
        }
        
        function ChangeEmailFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;                                
            
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
             if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;padding:20px;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
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
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/images/emailicon.png" width="10%"></p>
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
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
            
            if ($franchiseedata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/images/verifiedtickicon.jpg" width="10%"><p>
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
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><button type="button" onclick="EmailVerificationForm(\''.$formid.'\')" class="btn btn-primary" id="verifybtn" name="btnVerify">Save and Verify</button></div>
                                </div>
                            </div>
                           </div>
                        </form>                                                                                                       
                        </div>'; 
            }
        }
        
        function EmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql,$mail;
           
            $login = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'");
              
            if (sizeof($login)==0) {
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
                
                $mysql->execute("update _tbl_franchisees_staffs set EmailID='".$_POST['new_email']."' where FranchiseeID='".$login[0]['FranchiseeID']."'");
            }
            $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");
           
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
                    
                    $otp  = rand(1111,9999);
                    $cart = '<div style="width:650px;margin:0px auto">
                                <table style="width:100%">
                                    <tr>
                                        <td colspan="2">Dear '.$franchiseedata[0]['PersonName'].', <Br><Br>Email Verification Security Code is '.$otp.'</td>
                                    </tr>
                                </table>
                             </div>';
                             
                    $mail->isSMTP(); 
                    $mail->SMTPDebug = 0;
                    $mail->Host = "mail.nahami.online";
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPAuth = true;
                    $mail->Username = "support@nahami.online";
                    $mail->Password = "welcome@@82";
                    $mail->setFrom("support@nahami.online", "Support nahami");
                    $mail->addAddress($franchiseedata[0]['EmailID'],"Support");
                    $mail->Subject = 'Email Verifications';
                    $mail->msgHTML($cart);
                    $mail->Body=$cart;
                    $mail->AltBody = $cart;

                    if(!$mail->send()){
                        return "Mailer Error: " . $mail->ErrorInfo.
                             "Error. unable to process your request.";
                    } else {
                        $securitycode = $mysql->insert("_tbl_franchisee_verification_otp",array("FranchiseeID" => $franchiseedata[0]['FranchiseeID'],
                                                                                                "EmailTo"      => $franchiseedata[0]['EmailID'],
                                                                                                "SecurityCode" => $otp,
                                                                                                "messagedon"   => date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000);
                        $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");                                                          
                        
                        return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                                    <form method="POST" id="'.$formid.'">
                                        <input type="hidden" value="'.$loginid.'" name="loginId">
                                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <h4 style="text-align:center;color:#6c6969;">Please verify your email</h4>
                                            </div>
                                            <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/images/emailicon.png" width="10%"></p>
                                            <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$franchiseedata[0]['EmailID'].'</h4>
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
                    $franchiseedata = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$login[0]['FranchiseeID']."'");                                                          
                    
                    return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                                <form method="POST" id="'.$formid.'">
                                    <input type="hidden" value="'.$loginid.'" name="loginId">
                                    <input type="hidden" value="'.$securitycode.'" name="reqId">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
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
            
            $otpInfo = $mysql->select("select * from _tbl_franchisee_verification_otp where RequestID='".$_POST['reqId']."'");
            
           if (strlen(trim($_POST['email_otp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['email_otp']))  {
                $sql = "update _tbl_franchisees_staffs set IsEmailVerified='1', EmailVerifiedOn='".date("Y-m-d H:i:s")."' where FranchiseeID='".$otpInfo[0]['FranchiseeID']."'";
                $mysql->execute($sql); 
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <p style="text-align:center"><a href="../Dashboard" class="btn btn-primary">Continue</a></p>
                            
                       </div>';
                                    } else {
                                        return $this->EmailVerificationForm("<span style='color:red'>You entered, invalid Pin.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
                                    }  
        }    
    }
?>