<?php
//sleep(60);
    // include_once("config.php");
    include_once("controller/DatabaseController.php");
    $mysql = new MySql("localhost","nahami_user","nahami_user","nahami_masterdb");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/mail/src/Exception.php';
    require 'lib/mail/src/PHPMailer.php';
    require 'lib/mail/src/SMTP.php';
    $mail = new PHPMailer;

    include_once("la-en.php");
    include_once("controller/MailController.php");  
    include_once("controller/MobileSMSController.php");  
    include_once("classes/class.Franchisee.php");
    
      $loginid = isset($_GET['LoginID']) ? $_GET['LoginID'] : "";
    $loginInfo = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
      $mail = new PHPMailer;
      
    if (isset($_GET['action'])) {
       echo json_encode($_GET['action']()); 
    } else {
        if(isset($_GET['m'])){
       $obj = new $_GET['m']();
       echo $obj->$_GET['a']();
        
        }else{
            echo "error";
        }
    }     

    function returnError($message) {
        return array("status"=>"failed","message"=>$message);
    }
    
    function returnSuccess($message,$data) {
        return array("status"=>"success","message"=>$message,"data"=>$data);
    }
    
    class Response {
         function returnError($message) {
        return json_encode(array("status"=>"failed","message"=>$message));
    }
    
    function returnSuccess($message,$data) {
        return json_encode(array("status"=>"success","message"=>$message,"data"=>$data));
    }
    }
        
    function Login() {
        
        global $mysql;
        
        if (!(strlen(trim($_POST['UserName']))>0)) {
        return returnError("Please enter username ");
        }
        if (!(strlen(trim($_POST['Password']))>0)) {
        return returnError("Please enter password ");
        }
        
        $data=$mysql->select("select * from _tbl_members where MemberLogin='".$_POST['UserName']."' or EmailID='".$_POST['UserName']."' or MobileNumber='".$_POST['UserName']."' and MemberPassword='".$_POST['Password']."'") ;
        if (sizeof($data)>0) {
            
            $loginid = $mysql->insert("_tbl_member_login",array("LoginOn"   => date("Y-m-d H:i:s"),
                                                                "MemberID"  => $data[0]['MemberID']));
            $data[0]['LoginID']=$loginid;
            if ($data[0]['IsActive']==1) {
                return array("status" => "success",
                             "data"   => $data[0]);
            } else{
                return returnError("Access denied. Please contact support");   
            }
        } else {
            return returnError("Invalid username and password");
        }
    }                                                                           
                                                                                                
    function Register() {
                                                                            
        global $mysql;      
       
        $data = $mysql->select("select * from _tbl_members where  MobileNumber='".$_POST['MobileNumber']."'");
        if (sizeof($data)>0) {
            return returnError("Mobile Number Already Exists");
        }
        $data = $mysql->select("select * from _tbl_members where  EmailID='".$_POST['Email']."'");
        if (sizeof($data)>0) {
            return returnError("Email Already Exists");
        }
        if (!(strlen(trim($_POST['Name']))>0)) {
            return returnError("Please enter your name");
        }
        if (!(strlen(trim($_POST['Email']))>0)) {
            return returnError("Please enter your email");
        }
        if (!(strlen(trim($_POST['Gender']))>0)) {
            return returnError("Please enter password");
        }
        if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return returnError("Please enter password");
        }
        if (!(strlen(trim($_POST['LoginPassword']))>0)) {
            return returnError("Please enter password");
        }
             
        $id = $mysql->insert("_tbl_members",array("MemberName" => $_POST['Name'],
                                                  "Sex"     => $_POST['Gender'],
                                                  "MobileNumber"     => $_POST['MobileNumber'],
                                                  "EmailID"  => $_POST['Email'],
                                                  "MemberPassword"  => $_POST['LoginPassword'],
                                                  "CountryCode"  => $_POST['CountryCode'],
                                                  "ReferedBy"  => "32",
                                                  "CreatedOn"       => date("Y-m-d H:i:s"))); 
            $data = $mysql->select("select * from _tbl_members where MemberID='".$id."'");
             $loginid = $mysql->insert("_tbl_member_login",array("LoginOn"   => date("Y-m-d H:i:s"),
                                                                "MemberID"  => $data[0]['MemberID']));
                                                               
        $data[0]['LoginID']=$loginid;       
        return returnSuccess("Registered successfully",$data[0]);
    }

    function forgotPassword() {
                
        global $mysql;            
        $data = $mysql->select("Select * from _tbl_members where MemberLogin='".$_POST['UserName']."' or EmailID='".$_POST['UserName']."'");
       
          if (sizeof($data)>0){
              $_SESSION['rDetails'] = $res[0];
            $otp=rand(1000,9999);
            $mail2 = new MailController();
                    $mail2->MemberForgetPassword(array("mailTo"     => $data[0]['EmailID'] ,
                                                        "MemberName" => $data[0]['MemberName'],
                                                        "code"       => $otp));
              $securitycode = $mysql->insert("_tbl_fp_securitycode",array("MemberId" =>$data[0]['MemberID'],
                                                          "SecurityCode" =>$otp,
                                                          "Requested"=>date("Y-m-d h:i:s"), 
                                                          "EmailId" =>$data[0]['EmailID'],
                                                          "IsCompleted" =>0)) ; 
             
              $cart = "<div>
                                    Dear (".$data[0]['MemberName']."),<br><br>
                                     
                                     Your forget password security code is : ".$otp."
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
                           
                  $mail = new PHPMailer;
                  $mail->isSMTP(); 
                  $mail->SMTPDebug = 0;
                  $mail->Host = "mail.nahami.online";
                  $mail->Port = 465;
                  $mail->SMTPSecure = 'ssl';
                  $mail->SMTPAuth = true;
                  $mail->Username = "support@nahami.online";
                  $mail->Password = "welcome@@82";
                  $mail->setFrom("support@nahami.online", "Support nahami");
                  $mail->addAddress($data[0]['EmailID'],"nahami.online");
                  $mail->Subject = 'Reset Password';
                  $mail->msgHTML($cart);
                  $mail->Body($cart);
                  $mail->AltBody = $cart;
                  
                  if(!$mail->send()){
              
                     return  returnError("Error. unable to process your request.". $mail->ErrorInfo);
                    
                  } else {
                     
                      return returnSuccess("email sent successfully",array("reqID"=>$securitycode,"email"=>$data[0]['EmailID']));
                  }
              } else {
                  
                 return returnError("Invalid mail or member not found");
                 
              }
              
          
    }
    
    function forgotPasswordOTPvalidation() {
         global $mysql;                  
          $data = $mysql->select("Select * from _tbl_fp_securitycode where id='".$_POST['reqID']."' ");
         
          if (sizeof($data)>0) {
              if ($data[0]['SecurityCode']==$_POST['scode']) {
                 return returnSuccess("email sent successfully",array("reqID"=>$_POST['reqID'],"email"=>$data[0]['EmailID'])); 
              } else {
                 return returnError("Invalid security code"); 
              }
          } else {
              return returnError("Invalid access");
          }
    }
    
    function forgotPasswordchangePassword() {
        
        global $mysql;
           $data = $mysql->select("Select * from _tbl_fp_securitycode where id='".$_POST['reqID']."' ");
       
              
        if (!(strlen(trim($_POST['newpassword']))>=6)) {
            return returnError("Please enter valid new password must have 6 characters");
        } 
        
        if (!(strlen(trim($_POST['confirmnewpassword']))>=6)) {
            return returnError("Please enter valid confirm new password  must have 6 characters"); 
        } 
         if ($_POST['confirmnewpassword']!=$_POST['newpassword']) {
            return returnError("Password do not match"); 
        }
                
        $mysql->execute("update _tbl_members set MemberPassword='".$_POST['newpassword']."' where EmailID='".$data[0]['Emailid']."'");  
        $data = $mysql->select("select * from _tbl_members where  EmailID='".$data[0]['Emailid']."'");
   
        return returnSuccess("New Password saved successfully",$data[0]);
    }
    
    
    class Member {
        
        function IsMobileVerified() {
            return false;
        }
        
        function CheckVerification() {
            
            global $mysql;
            $loginid = $_GET['LoginID'];
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsMobileVerified']==0) {
               return Views::ChangeMobileNumberFromVerificationScreen("",$loginid,"","");
            }
            
            if ($memberdata[0]['IsEmailVerified']==0) {
               return Views::ChangeEmailFromVerificationScreen("",$loginid,"","");
            }
            
            return "<script>location.href='http://nahami.online/sl/Dashboard/Profile/CreateProfile';</script>";
        }
    }
    
            
    class Views {
        
        function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
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
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['CountryCode'].'&nbsp;'.$memberdata[0]['MobileNumber'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumber()">Change</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><a  href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary" name="verifybtn" id="verifybtn">Continue to Verify</a></div>
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
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                $formid = "frmChangeMobileNo_".rand(30,3000);
                
                return '<div id="otpfrm" style="width:100%;padding-bottom: 0px;padding-top:20px;">
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
                                    <a  href="javascript:void(0)" onclick="CheckVerification()">back</a></div>
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
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            } 
            
            if (isset($_POST['new_mobile_number'])) {
                
                if (strlen(trim($_POST['new_mobile_number']))!=10) {
                    return $this->ChangeMobileNumber("Invalid Mobile Number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $duplicate = $mysql->select("select * from _tbl_members where MobileNumber='".$_POST['new_mobile_number']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeMobileNumber("Mobile Number already in use.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $mysql->execute("update _tbl_members set MobileNumber='".$_POST['new_mobile_number']."' , CountryCode='".$_POST['CountryCode']."' where MemberID='".$login[0]['MemberID']."'");
            }
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsMobileVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                          
                if ($error=="") {
                    $otp=rand(1111,9999);
                    $securitycode = $mysql->insert("_tbl_verification_otp",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                 "SMSTo" =>$memberdata[0]['MobileNumber'],
                                                                                 "SecurityCode" =>$otp,
                                                                                 "messagedon"=>date("Y-m-d h:i:s"))) ; 
                    MobileSMSController::sendSMS($memberdata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    
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
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9;font-size: 18px;">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['CountryCode'].'&nbsp;'.$memberdata[0]['MobileNumber'].'</h4>
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
            
            $otpInfo = $mysql->select("select * from _tbl_verification_otp where RequestID='".$_POST['reqId']."'");
            if (strlen(trim($_POST['mobile_otp_2']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['mobile_otp_2']))  {
                $sql = "update _tbl_members set IsMobileVerified='1', MobileVerifiedOn='".date("Y-m-d H:i:s")."' where MemberID='".$otpInfo[0]['MemberID']."'";
                $mysql->execute($sql);
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="CheckVerification()">Continue</a> <h5>
                       </div>';
                                    } else {
                                        return $this->MobileNumberVerificationForm("<span style='color:red'>You entered, invalid pin.</span>",$_POST['loginId'],$_POST['mobile_otp_2'],$_POST['reqId']);
                                    }

        }                             
         
          function ChangeEmailFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            
            if ($loginid=="") {
                $loginid = $_GET['LoginID'];
            }
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
             if ($memberdata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
                
                $formid = "frmChangeEmail_".rand(30,3000);
             
                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;padding-top: 12%;">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'&nbsp;&#65372&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
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
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
            $formid = "frmChangeEmail_".rand(30,3000);
                
                return '<div id="otpfrm" style="width:100%;padding-bottom: 0px;padding-top:20px;padding-right:20px;padding-left:20px;">
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
                                    <a  href="javascript:void(0)" onclick="CheckVerification()">back</a></div>
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
            
            global $mysql;
            
            $login = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");
            
            if (sizeof($login)==0) {
                return "Invalid request. Please login again.";
            }
            if (isset($_POST['new_email'])) {
                 if (strlen(trim($_POST['new_email']))==0) {
                    return $this->ChangeEmailID("Invalid EmailID",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                }
                $duplicate = $mysql->select("select * from _tbl_members where EmailID='".$_POST['new_email']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeEmailID("Email already in use.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                }
                
                $mysql->execute("update _tbl_members set EmailID='".$_POST['new_email']."' where MemberID='".$login[0]['MemberID']."'");
            }   
            
            $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
            
            if ($memberdata[0]['IsEmailVerified']==1) {
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
            } else {
            
                if ($error=="") {
                    
                    
                $otp=rand(1111,9999);
                $cart = '<div style="width:650px;margin:0px auto">
                                <table style="width:100%">
                                    <tr>
                                        <td colspan="2">Dear '.$memberdata[0]['MemberName'].', <Br><Br>Email Verification Security Code is '.$otp.'</td>
                                    </tr>
                                </table>
                                </div>';
                          $mail = new PHPMailer;
                  $mail->isSMTP(); 
                  $mail->SMTPDebug = 0;
                  $mail->Host = "mail.nahami.online";
                  $mail->Port = 465;
                  $mail->SMTPSecure = 'ssl';
                  $mail->SMTPAuth = true;
                  $mail->Username = "support@nahami.online";
                  $mail->Password = "welcome@@82";
                  $mail->setFrom("support@nahami.online", "Support nahami");
                  $mail->addAddress($memberdata[0]['EmailID'],"Support");
                  $mail->Subject = 'Email Verifications';
                  $mail->msgHTML($cart);
                  $mail->msgHTML($cart);
                  $mail->AltBody = $cart;
                          
                          
                          
                          if(!$mail->send()){
                            return "Mailer Error: " . $mail->ErrorInfo.
                             "Error. unable to process your request.";
                          } else {
                               $securitycode = $mysql->insert("_tbl_verification_otp",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                        "EmailTo" =>$memberdata[0]['EmailID'],
                                                                                        "SecurityCode" =>$otp,
                                                                                        "messagedon"=>date("Y-m-d h:i:s"))) ;
                              $formid = "frmMobileNoVerification_".rand(30,3000);
                 $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the PIN?<a href="#">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }
                          
                     
                 }  else {
                    $securitycode = $reqID;
                    
                    $formid = "frmMobileNoVerification_".rand(30,3000);
                 $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#ada9a9">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the PIN?<a href="#">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                }
                                                          
                
               
            }                                    
        }
    
        function EmailOTPVerification() {
            global $mysql;  
            
            $otpInfo = $mysql->select("select * from _tbl_verification_otp where RequestID='".$_POST['reqId']."'");
           if (strlen(trim($_POST['email_otp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['email_otp']))  {
                $sql = "update _tbl_members set IsEmailVerified='1', EmailVerifiedOn='".date("Y-m-d H:i:s")."' where MemberID='".$otpInfo[0]['MemberID']."'";
                $mysql->execute($sql); 
                return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="http://nahami.online/sl/Dashboard/assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <p style="text-align:center"><a href="CreateProfile" class="btn btn-primary">Continue</a></p>
                            
                       </div>';
                                    } else {
                                        return $this->EmailVerificationForm("<span style='color:red'>You entered, invalid security code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
                                    }  
        }   
      
    }
    
    
    
    class SeqMaster {
        
        function GetNextMemberNumber() {
            
            global $mysql;
        
            $prefix = "MEM";
            $Rows = $mysql->select("select * from _tbl_members");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
        }
        function GetNextFranchiseeStaffNumber() {
            
            global $mysql;
        
            $prefix = "FS";
            $Rows = $mysql->select("select * from _tbl_franchisees_staffs");
        
            $nextNumber = sizeof($Rows)+1; 
         
            if (sizeof($nextNumber)==1) {
                $prefix .= "000".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==2) {
                $prefix .= "00".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==3) {
                $prefix .= "0".$nextNumber; 
            }
        
            if (sizeof($nextNumber)==4) {   
                $prefix .= $nextNumber; 
            }
            
            return $prefix;
        }
    }
    
    class CodeMaster {
        
        function GetGender() {
            global $mysql;
            $Sexs = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX'") ;
            return $Sexs;
        }
        
        
    }
    function GetProfiles() {
          global $mysql,$loginInfo;    
              
              $Profile = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy = '".$loginInfo[0]['MemberID']."'");
              $sql="select * from _tbl_Profile_Draft where CreatedBy = '".$loginInfo[0]['MemberID']."'";
                return Response::returnSuccess("success".$sql,$Profile);
                                                            
        
    }

    
    ?>