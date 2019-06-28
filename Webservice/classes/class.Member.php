<?php

     class Member {
         
         function Login() {
             
             global $mysql;
             
             if (!(strlen(trim($_POST['UserName']))>0)) {
                 return Response::returnError("Please enter login name ");
             }
             
             if (!(strlen(trim($_POST['Password']))>0)) {
                 return Response::returnError("Please enter login password ");
             }
             
             $data=$mysql->select("select * from _tbl_members where MemberLogin='".$_POST['UserName']."' or EmailID='".$_POST['UserName']."' or MobileNumber='".$_POST['UserName']."' and MemberPassword='".$_POST['Password']."'") ;
             
             if (sizeof($data)>0) {
                 
                 $loginid = $mysql->insert("_tbl_member_login",array("LoginOn"   => date("Y-m-d H:i:s"),
                                                                     "MemberID"  => $data[0]['MemberID']));
                 if ($data[0]['IsActive']==1) {
                     
                     if($data[0]['WelcomeMsg']==0) {
                         $d=$mysql->select("Select * From _tbl_welcome_message where IsActive='1' and UserRole='Member'");
                         $data[0]['WelcomeMessage']=$d[0]['Message'];  
                     }
                     
                     $data[0]['LoginID']=$loginid;
                     return Response::returnSuccess("success",$data[0]);
                 } else {
                     return Response::returnError("Access denied. Please contact support");   
                 }
             } else {
                return Response::returnError("Invalid username and password");
             }
         }                                                                           
                                                                                                
         function Register() {
             
             global $mysql;
             
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
             
             $data = $mysql->select("select * from _tbl_members where  MobileNumber='".$_POST['MobileNumber']."'");
             if (sizeof($data)>0) {
                 return Response::returnError("Mobile Number Already Exists");
             }
             
             $data = $mysql->select("select * from _tbl_members where  EmailID='".$_POST['Email']."'");
             if (sizeof($data)>0) {
                return Response::returnError("Email Already Exists");
             }
             $MemberCode=SeqMaster::GetNextMemberNumber();
             $id = $mysql->insert("_tbl_members",array("MemberName"     => $_POST['Name'],
                                                       "MemberCode"     => $MemberCode,
                                                       "Sex"            => $_POST['Gender'],
                                                       "MobileNumber"   => $_POST['MobileNumber'],
                                                       "EmailID"        => $_POST['Email'],
                                                       "MemberPassword" => $_POST['LoginPassword'],
                                                       "CountryCode"    => $_POST['CountryCode'],
                                                       "ReferedBy"      => AdminFranchise,
                                                       "CreatedOn"      => date("Y-m-d H:i:s"))); 
             $data = $mysql->select("select * from _tbl_members where MemberID='".$id."'");
             
             $loginid = $mysql->insert("_tbl_member_login",array("LoginOn"  => date("Y-m-d H:i:s"),
                                                                 "MemberID" => $data[0]['MemberID']));
                                                                 
             $mContent = $mysql->select("select * from mailcontent where Category='NewMemberCreated'");
             $content  = str_replace("#MemberName#",$_POST['Name'],$mContent[0]['Content']);
             $content  = str_replace("#MemberID#",$MemberCode,$content);
             $content  = str_replace("#LoginPassword#",$_POST['LoginPassword'],$content);
             
             MailController::Send(array("MailTo"   => $_POST['Email'],
                                        "Category" => "NewMemberCreated",
                                        "MemberID" => $id,
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
                                                               
             $data[0]['LoginID']=$loginid;       
             return Response::returnSuccess("Registered successfully",$data[0]);
         }
            
         function forgotPassword() {
             
             global $mysql,$mail;            
             
             if (Validation::isEmail($_POST['FpUserName'])) {
                $data = $mysql->select("Select * from _tbl_members where EmailID='".$_POST['FpUserName']."'");
                if (sizeof($data)==0){
                    return Response::returnError("Invalid e-mail");
                }
             } else {
                $data = $mysql->select("Select * from _tbl_members where MemberLogin='".$_POST['FpUserName']."'");    
                if (sizeof($data)==0){
                    return Response::returnError("Invalid login name");
                }
             }
             
             $otp=rand(1000,9999);
             $securitycode = $mysql->insert("_tbl_fp_securitycode",array("MemberId"     => $data[0]['MemberID'],
                                                                         "SecurityCode" => $otp,
                                                                         "Requested"    => date("Y-m-d h:i:s"), 
                                                                         "EmailId"      => $data[0]['EmailID'],
                                                                         "IsCompleted"  => 0)) ; 
           
             $mContent = $mysql->select("select * from mailcontent where Category='MemberPasswordForget'");
             $content  = str_replace("#MemberName#",$data[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);
             
             MailController::Send(array("MailTo"   => $data[0]['EmailID'],
                                        "Category" => "MemberPasswordForget",
                                        "MemberID" => $data[0]['MemberID'],
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
             $data = $mysql->select("Select * from _tbl_fp_securitycode where id='".$_POST['reqID']."' ");
             if (sizeof($data)>0) {
                 if ($data[0]['SecurityCode']==$_POST['scode']) {
                    return Response::returnSuccess("email sent successfully",array("reqID"=>$_POST['reqID'],"email"=>$data[0]['EmailID'])); 
                 } else {
                    return Response::returnError("Invalid verification code"); 
                 }
             } else {
                return Response::returnError("Invalid access");
             }
         }
         
         function forgotPasswordchangePassword() {
             
             global $mysql;
             $data = $mysql->select("Select * from _tbl_fp_securitycode where id='".$_POST['reqID']."' ");
             
             if (!(strlen(trim($_POST['newpassword']))>=6)) {
                return Response::returnError("Please enter valid new password must have 6 characters");
             } 
             if (!(strlen(trim($_POST['confirmnewpassword']))>=6)) {
                return Response::returnError("Please enter valid confirm new password  must have 6 characters"); 
             } 
             if ($_POST['confirmnewpassword']!=$_POST['newpassword']) {
                return Response::returnError("Password do not match"); 
             }
             
             $mysql->execute("update _tbl_members set MemberPassword='".$_POST['newpassword']."' where EmailID='".$data[0]['Emailid']."'");  
             $data = $mysql->select("select * from _tbl_members where  EmailID='".$data[0]['Emailid']."'");
             
             return Response::returnSuccess("New Password saved successfully",$data[0]);
         }
                         
         function IsMobileVerified() {
             return false;
         }
       
         function GetMemberInfo(){
             global $mysql,$loginInfo;
             $Member=$mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",$Member[0]);
         }
         
         function EditMemberInfo() {
             global $mysql,$loginInfo;
             
             $Member = $mysql->select("select * from _tbl_members where MemberID='".$_POST['Code']."'");
             $data = $mysql->select("select * from  _tbl_members where EmailID='".trim($_POST['EmailID'])."' and MemberID <>'".$_POST['Code']."'");
             if (sizeof($data)>0) {
                 return Response::returnError("EmailID Already Exists");    
             }
             $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                      EmailID='".$_POST['EmailID']."',
                                                      MobileNumber='".$_POST['MobileNumber']."',
                                                      IsActive='".$_POST['Status']."' where  MemberID='".$Member[0]['MemberID']."'");
             $Member = $mysql->select("select * from _tbl_members where '".$_POST['Code']."'");
             return Response::returnSuccess("success",array());
         }
        
         function WelcomeMessage() {
             global $mysql,$loginInfo;
             $welcome=$mysql->execute("update _tbl_members set WelcomeMsg='1' where  MemberID='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("New Password saved successfully"."update _tbl_members set WelcomeMsg='1' where  MemberID='".$loginInfo[0]['MemberID']."'",array());
         }
         
         function GetCodeMasterDatas() {
             return Response::returnSuccess("success",array("Gender"        => CodeMaster::GetGender(),
                                                            "MaritalStatus" => CodeMaster::GetMaritalStatus(),
                                                            "Language"      => CodeMaster::GetLanguage(),
                                                            "Religion"      => CodeMaster::GetReligion(),
                                                            "Caste"         => CodeMaster::GetCaste(),
                                                            "Height"        => CodeMaster::GetHeight(),
                                                            "Community"     => CodeMaster::GetCommunity(),
                                                            "Nationality"   => CodeMaster::GetNationality(),
                                                            "ProfileFor"    => CodeMaster::GetProfileFor()));
         }
         
         function CreateProfile() {
             
             global $mysql,$loginInfo;
             
             if ((strlen(trim($_POST['ProfileFor']))=="0")) {    
                return Response::returnError("Please select ProfileFor");
             }
             if (!(strlen(trim($_POST['ProfileName']))>0)) {
                return Response::returnError("Please enter your name");
             }
             if (!(strlen(trim($_POST['DateofBirth']))>0)) {
                return Response::returnError("Please enter your date of birth");
             }
             if (strlen(trim($_POST['Sex']))=="0") {
                return Response::returnError("Please select sex");
             }
             if (strlen(trim($_POST['MaritalStatus']))=="0") {
                return Response::returnError("Please select marital status");
             }
             if (strlen(trim($_POST['Language']))=="0") {
                return Response::returnError("Please select language");
             }
             if (strlen(trim($_POST['Religion']))=="0") {
                return Response::returnError("Please select religion");
             }
             if (strlen(trim($_POST['Caste']))=="0") {
                return Response::returnError("Please select caste");
             }
             if (strlen(trim($_POST['Community']))=="0") {
                return Response::returnError("Please select community");
             }
             if (strlen(trim($_POST['Nationality']))=="0") {
                return Response::returnError("Please select nationality");
             }

             $MaritalStatus = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS' and SoftCode='".$_POST['MaritalStatus']."'");  
             $Sex = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX' and SoftCode='".$_POST['Sex']."'");  
             $MotherTongue = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES' and SoftCode='".$_POST['Language']."'");  
             $Religion = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and SoftCode='".$_POST['Religion']."'");  
             $Caste = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and SoftCode='".$_POST['Caste']."'");  
             $Community = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY' and SoftCode='".$_POST['Community']."'");  
             $Nationality = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and SoftCode='".$_POST['Nationality']."'");  
             
             $id =  $mysql->insert("_tbl_Profile_Draft",array("ProfileFor"        => $_POST['ProfileFor'],
                                                              "ProfileName"       => $_POST['ProfileName'],
                                                              "DateofBirth"       => $_POST['DateofBirth'],        
                                                              "SexCode"           => $_POST['Sex'],      
                                                              "Sex"               => $Sex[0]['CodeValue'],      
                                                              "MaritalStatusCode" => $_POST['MaritalStatus'],      
                                                              "MaritalStatus"     => $MaritalStatus[0]['CodeValue'],      
                                                              "MotherTongueCode"  => $_POST['Language'], 
                                                              "MotherTongue"      => $MotherTongue[0]['CodeValue'],      
                                                              "ReligionCode"      => $_POST['Religion'],
                                                              "Religion"          => $Religion[0]['CodeValue'],      
                                                              "CasteCode"         => $_POST['Caste'],
                                                              "Caste"             => $Caste[0]['CodeValue'],      
                                                              "CommunityCode"     => $_POST['Community'],        
                                                              "Community"         => $Community[0]['CodeValue'],           
                                                              "CreatedOn"         => date("Y-m-d H:i:s"),        
                                                              "CreatedBy"         => $loginInfo['MemberID'],        
                                                              "NationalityCode"   => $_POST['Nationality'],
                                                              "Nationality"       => $Nationality[0]['CodeValue'],
                                                              "CreatedBy"         => $loginInfo[0]['MemberID']));
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array());
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         
         function MemberChangePassword(){
             
             global $mysql,$loginInfo;
             $getpassword = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'");
             if ($getpassword[0]['MemberPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Current password"); 
             } 
             if ($getpassword[0]['MemberPassword']==$_POST['CurrentPassword']) {
                 $mysql->execute("update _tbl_members set MemberPassword='".$_POST['ConfirmNewPassword']."' where MemberID='".$loginInfo[0]['MemberID']."'");
                 return Response::returnSuccess("Password Changed Successfully",array());
             }
         }
            
         function GetAdvancedSearchElements() {
             return Response::returnSuccess("success",array("SkinType"        => CodeMaster::GetSkinType(),
                                                            "MaritalStatus" => CodeMaster::GetMaritalStatus(),
                                                            "Religion"      => CodeMaster::GetReligion(),
                                                            "Caste"         => CodeMaster::GetCaste(),
                                                            "Height"        => CodeMaster::GetHeight(),
                                                            "Diet"          => CodeMaster::GetDiet(),
                                                            "SmokingHabit"  => CodeMaster::GetSmokingHabit(),
                                                            "DrinkingHabit" => CodeMaster::GetDrinkingHabit(),
                                                            "BodyType"      => CodeMaster::GetBodyType()));
         }
         
         function GetBasicSearchElements() {
             return Response::returnSuccess("success",array("MaritalStatus" => CodeMaster::GetMaritalStatus(),
                                                            "Religion"      => CodeMaster::GetReligion(),
                                                            "Community"     => CodeMaster::GetCommunity()));
         }
         
         function CheckVerification() {
             
             global $mysql,$loginInfo;
             $memberdata = $mysql->select("select * from _tbl_members where MemberID='".$login[0]['MemberID']."'");
             
             if ($memberdata[0]['IsMobileVerified']==0) {
                 return $this->ChangeMobileNumberFromVerificationScreen("",$loginid,"","");
             }
             if ($memberdata[0]['IsEmailVerified']==0) {
                 return $this->ChangeEmailFromVerificationScreen("",$loginid,"","");
             }
             return "<script>location.href='http://nahami.online/sl/Dashboard/MyProfiles/CreateProfile';</script>";
         }
         
         function SaveBasicSearch() {
             
             global $mysql,$loginInfo; 
             $member = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $insertArray = array("MemberID"    => $loginInfo[0]['MemberID'],
                                  "SearchType"  => 'Basic Search',
                                  "CreatedOn"   => date("Y-m-d H:i:s"),
                                  "SearchParam" => json_encode(array("AgeFrom"           => $_POST['age'],
                                                                     "AgeTo"             => $_POST['toage'],
                                                                     "ReligionCode"      => $_POST['Religion'],
                                                                     "CommunityCode"     => $_POST['Community'],
                                                                     "MaritalStatusCode" => $_POST['MaritalStatus'])));
             if ($_POST['check']=="on") {
                if (strlen(trim($_POST['SaveSearchas']))==0) {
                    return Response::returnError("Please enter Save Searchas");
                }
                $data = $mysql->select("select * from _tbl_profile_search_history were SearchName='".$_POST['SaveSearchas']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("Search Name Already Exists");
                }
                $countofsearch= $mysql->select("select * from _tbl_profile_search_history where MemberID='".$loginInfo[0]['MemberID']."' and SearchType='Basic Search' and IsVisible='1' and IsSaved='1'");   
                if (sizeof($countofsearch)<5) {    
                    $insertArray["SearchName"] = $_POST['SaveSearchas'];
                    $insertArray["NotifyMe"]   = $_POST['EmailMe'];
                    $insertArray['IsVisible']  = "1";
                    $insertArray['IsSaved']    = "1";
                } else {
                    $insertArray["SearchName"] = ""; 
                    $insertArray["NotifyMe"]   = "";
                    $insertArray['IsVisible']  = "0";
                    $insertArray['IsSaved']    = "0";
                    return Response::returnError("saved only 5 searches");
                }
                $id =  $mysql->insert("_tbl_profile_search_history",$insertArray);
                if (sizeof($id)>0) {
                    return Response::returnSuccess("success",array());
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
             }
         }
      
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
                return '<div id="otpfrm" style="width:100%;padding:15px;height:100%;">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -12px;">&times;</button>
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                                    <h5 style="color: #969292;font-weight: 100;padding-top: 21px;">In order to protect the security of your account,we will send you a text message with a verification that you will need to enter the next screen</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="//nahami.online/sl/Dashboard/assets/images/smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['CountryCode'].'&nbsp;'.$memberdata[0]['MobileNumber'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumber()">Change</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><a href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary" name="verifybtn" id="verifybtn">Continue to verify</a></div>
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
                           <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right:8px;">&times;</button>
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
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
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
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
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
                           <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
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
                     
                     $mContent = $mysql->select("select * from mailcontent where Category='MemberEmailVerification'");
                     $content  = str_replace("#MemberName#",$memberdata[0]['MemberName'],$mContent[0]['Content']);
                     $content  = str_replace("#otp#",$otp,$content);
                     
                     MailController::Send(array("MailTo"   => $memberdata[0]['EmailID'],
                                                "Category" => "NewMemberCreated",
                                                "MemberID" => $memberdata[0]['MemberID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                                                
                     if($mailError){
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
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
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
                                        <div class="col-sm-7"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
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
                                        <div class="col-sm-7"><input type="text" value="'.$_POST['email_otp'].'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
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
                 return $this->EmailVerificationForm("<span style='color:red'>Invalid verification code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
             }  
         }
         
         function GetMyDraftProfiles() {
             
             global $mysql,$loginInfo;    
             $Profiles = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy = '".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",$Profiles);
         }
         
         function EditProfile() {
             
             global $mysql,$loginInfo;
             
            /* if ((strlen(trim($_POST['Country']))==0 || $_POST['Country']=="0" )) {
             return Response::returnError("Please select Country Name");
             }
             if ((strlen(trim($_POST['StateName']))==0 || $_POST['StateName']=="0" )) {
             return Response::returnError("Please select State Name");
             }
             if (!(strlen(trim($_POST['City']))>0)) {
             return Response::returnError("Please enter CityName");
             }
             if (!(strlen(trim($_POST['OtherLocation']))>0)) {
             return Response::returnError("Please enter Other Location");
             }
             if (!(strlen(trim($_POST['Occupation']))>0)) {
             return Response::returnError("Please enter Occupation");
             }
             if (!(strlen(trim($_POST['TypeofOccupation']))>0)) {
             return Response::returnError("Please enter Type of Occupation");
             }  */
             
             $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
             
             $MaritalStatus = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARTIALSTATUS' and SoftCode='".$_POST['MaritalStatus']."'");  
             $Sex = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SEX' and SoftCode='".$_POST['Sex']."'");  
             $MotherTongue = $mysql->select("select * from _tbl_master_codemaster Where HardCode='LANGUAGENAMES' and SoftCode='".$_POST['Language']."'");  
             $Religion = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and SoftCode='".$_POST['Religion']."'");  
             $Caste = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and SoftCode='".$_POST['Caste']."'");  
             $Community = $mysql->select("select * from _tbl_master_codemaster Where HardCode='COMMUNITY' and SoftCode='".$_POST['Community']."'");  
             $Nationality = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and SoftCode='".$_POST['Nationality']."'");  
             $Country = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and SoftCode='".$_POST['Country']."'");  
             $State = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and SoftCode='".$_POST['StateName']."'");  
             $EmployedAs = $mysql->select("selectselect * from _tbl_master_codemaster Where HardCode='OCCUPATIONS' and SoftCode='".$_POST['EmployedAs']."'");  
             $OccupationType = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$_POST['OccupationType']."'");  
             $TypeofOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='TYPEOFOCCUPATIONS' and SoftCode='".$_POST['TypeofOccupation']."'");  
             $IncomeRange = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and SoftCode='".$_POST['IncomeRange']."'");  
             $FathersOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$_POST['FathersOccupation']."'");  
             $MothersOccupation = $mysql->select("select * from _tbl_master_codemaster Where HardCode='OCCUPATIONTYPES' and SoftCode='".$_POST['MothersOccupation']."'");  
             $NumberofBrothers = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NUMBEROFBROTHER' and SoftCode='".$_POST['NumberofBrothers']."'");  
             $younger = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGER' and SoftCode='".$_POST['younger']."'");  
             $elder = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDER' and SoftCode='".$_POST['elder']."'");  
             $married = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIED' and SoftCode='".$_POST['married']."'");  
             $NumberofSisters = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NOOFSISTER' and SoftCode='".$_POST['NumberofSisters']."'");  
             $elderSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='ELDERSIS' and SoftCode='".$_POST['elderSister']."'");  
             $youngerSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='YOUNGERSIS' and SoftCode='".$_POST['youngerSister']."'");  
             $marriedSister = $mysql->select("select * from _tbl_master_codemaster Where HardCode='MARRIEDSIS' and SoftCode='".$_POST['marriedSister']."'");  
             $PhysicallyImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PHYSICALLYIMPAIRED' and SoftCode='".$_POST['PhysicallyImpaired']."'");  
             $VisuallyImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISUALLYIMPAIRED' and SoftCode='".$_POST['VisuallyImpaired']."'");  
             $VissionImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='VISSIONIMPAIRED' and SoftCode='".$_POST['VissionImpaired']."'");  
             $SpeechImpaired = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SPEECHIMPAIRED' and SoftCode='".$_POST['SpeechImpaired']."'");  
             $Height = $mysql->select("select * from _tbl_master_codemaster Where HardCode='HEIGHTS' and SoftCode='".$_POST['Height']."'");  
             $Weight = $mysql->select("select * from _tbl_master_codemaster Where HardCode='WEIGHTS' and SoftCode='".$_POST['Weight']."'");  
             $BloodGroup = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BLOODGROUPS' and SoftCode='".$_POST['BloodGroup']."'");  
             $Complexation = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='COMPLEXIONS' and SoftCode='".$_POST['Complexation']."'");  
             $BodyType = $mysql->select("select * from _tbl_master_codemaster Where HardCode='BODYTYPES' and SoftCode='".$_POST['BodyType']."'");  
             $Diet = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DIETS' and SoftCode='".$_POST['Diet']."'");  
             $SmookingHabit = $mysql->select("select * from _tbl_master_codemaster Where HardCode='SMOKINGHABITS' and SoftCode='".$_POST['SmookingHabit']."'");  
             $DrinkingHabit = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DRINKINGHABITS' and SoftCode='".$_POST['DrinkingHabit']."'");  
             
             
             
             $mysql->execute("update _tbl_Profile_Draft set ProfileFor='".$_POST['ProfileFor']."',
                                                       ProfileName='".$_POST['ProfileName']."',
                                                       DateofBirth='".$dob."',
                                                       SexCode='".$_POST['Sex']."',
                                                       Sex='".$Sex[0]['CodeValue']."',
                                                       MaritalStatusCode='".$_POST['MaritalStatus']."',
                                                       MaritalStatus='".$MaritalStatus[0]['CodeValue']."',
                                                       MotherTongueCode='".$_POST['Language']."',
                                                       MotherTongue='".$MotherTongue[0]['CodeValue']."',
                                                       ReligionCode='".$_POST['Religion']."',
                                                       Religion='".$Religion[0]['CodeValue']."',
                                                       CasteCode='".$_POST['Caste']."',
                                                       Caste='".$Caste[0]['CodeValue']."',
                                                       Country='".$_POST['Country']."',
                                                       StateCode='".$_POST['StateName']."',
                                                       State='".$State[0]['CodeValue']."',
                                                       City='".$_POST['City']."',
                                                       OtherLocation='".$_POST['OtherLocation']."',
                                                       CommunityCode='".$_POST['Community']."',
                                                       Community='".$Community[0]['CodeValue']."',
                                                       NationalityCode='".$_POST['Nationality']."',
                                                       Nationality='".$Nationality[0]['CodeValue']."',
                                                       AadhaarNo='".$_POST['Aadhaar']."',
                                                       Education='".$_POST['EducationDegree']."',
                                                       EmployedAsCode='".$_POST['EmployedAs']."',
                                                       EmployedAs='".$EmployedAs[0]['CodeValue']."',
                                                       OccupationTypeCode='".$_POST['OccupationType']."',
                                                       OccupationType='".$OccupationType[0]['CodeValue']."',
                                                       TypeofOccupationCode='".$_POST['TypeofOccupation']."',
                                                       TypeofOccupation='".$TypeofOccupation[0]['CodeValue']."',
                                                       AnnualIncomeCode='".$_POST['IncomeRange']."',
                                                       AnnualIncome='".$IncomeRange[0]['CodeValue']."',
                                                       FathersName='".$_POST['FatherName']."',
                                                       FathersOccupationCode='".$_POST['FathersOccupation']."',
                                                       FathersOccupation='".$FathersOccupation[0]['CodeValue']."',
                                                       MothersName='".$_POST['MotherName']."',
                                                       MothersOccupationCode='".$_POST['MothersOccupation']."',
                                                       MothersOccupation='".$MothersOccupation[0]['CodeValue']."',
                                                       NumberofBrothersCode='".$_POST['NumberofBrother']."',
                                                       NumberofBrothers='".$NumberofBrothers[0]['CodeValue']."',
                                                       YoungerCode='".$_POST['younger']."',
                                                       Younger='".$younger[0]['CodeValue']."',
                                                       ElderCode='".$_POST['elder']."',
                                                       Elder='".$elder[0]['CodeValue']."',
                                                       MarriedCode='".$_POST['married']."',
                                                       Married='".$married[0]['CodeValue']."',
                                                       NumberofSistersCode='".$_POST['NumberofSisters']."',
                                                       NumberofSisters='".$NumberofSisters[0]['CodeValue']."',
                                                       ElderSisterCode='".$_POST['elderSister']."',
                                                       ElderSister='".$elderSister[0]['CodeValue']."',
                                                       YoungerSisterCode='".$_POST['youngerSister']."',
                                                       YoungerSister='".$youngerSister[0]['CodeValue']."',
                                                       MarriedSisterCode='".$_POST['marriedSister']."',
                                                       MarriedSister='".$marriedSister[0]['CodeValue']."',
                                                       PhysicallyImpairedCode='".$_POST['PhysicallyImpaired']."',
                                                       PhysicallyImpaired='".$PhysicallyImpaired[0]['CodeValue']."',
                                                       VisuallyImpairedCode='".$_POST['VisuallyImpaired']."',
                                                       VisuallyImpaired='".$VisuallyImpaired[0]['CodeValue']."',
                                                       VissionImpairedCode='".$_POST['VissionImpaired']."',
                                                       VissionImpairedCode='".$VissionImpaired[0]['CodeValue']."',
                                                       SpeechImpairedCode='".$_POST['SpeechImpaired']."',
                                                       SpeechImpaired='".$SpeechImpaired[0]['CodeValue']."',
                                                       HeightCode='".$_POST['Height']."',
                                                       Height='".$Height[0]['CodeValue']."',
                                                       WeightCode='".$_POST['Weight']."',
                                                       Weight='".$Weight[0]['CodeValue']."',
                                                       BloodGroupCode='".$_POST['BloodGroup']."',
                                                       BloodGroup='".$BloodGroup[0]['CodeValue']."',
                                                       ComplexationCode='".$_POST['Complexation']."',
                                                       Complexation='".$Complexation[0]['CodeValue']."',
                                                       BodyTypeCode='".$_POST['BodyType']."',
                                                       BodyType='".$BodyType[0]['CodeValue']."',
                                                       DietCode='".$_POST['Diet']."',
                                                       Diet='".$Diet[0]['CodeValue']."',
                                                       SmokingHabitCode='".$_POST['SmookingHabit']."',
                                                       SmokingHabit='".$SmookingHabit[0]['CodeValue']."',
                                                       DrinkingHabitCode='".$_POST['DrinkingHabit']."',
                                                       DrinkingHabit='".$DrinkingHabit[0]['CodeValue']."',
                                                       EmailID='".$_POST['EmailID']."',
                                                       MobileNumber='".$_POST['MobileNumber']."',
                                                       WhatsappNumber='".$_POST['WhatsappNumber']."',
                                                       AddressLine1='".$_POST['AddressLine1']."',
                                                       AddressLine2='".$_POST['AddressLine2']."',
                                                       AddressLine3='".$_POST['AddressLine3']."'
                                                        where  CreatedBy='".$_Member['MemberID']."' and ProfileID'".$_POST['Code']."'");
             
             $Profiles = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy='".$loginInfo[0]['MemberID']."' and ProfileID='".$_POST['Code']."'");               
             return Response::returnSuccess("success",array("ProfileInfo"             => $Profiles[0],
                                                            "ProfileSignInFor"        => CodeMaster::GetProfileFor(),
                                                            "Gender"                  => CodeMaster::GetGender(),
                                                            "MaritalStatus"           => CodeMaster::GetMaritalStatus(),
                                                            "Language"                => CodeMaster::GetLanguage(),
                                                            "Religion"                => CodeMaster::GetReligion(),
                                                            "Caste"                   => CodeMaster::GetCaste(),
                                                            "Community"               => CodeMaster::GetCommunity(),
                                                            "Nationality"             => CodeMaster::GetNationality(),
                                                            "EmployedAs"              => CodeMaster::GetEmployedAs(),
                                                            "Occupation"              => CodeMaster::GetOccupation(),
                                                            "TypeofOccupation"        => CodeMaster::GetOccupationTypes(),
                                                            "IncomeRange"             => CodeMaster::GetIncomeRange(),
                                                            "NumberofBrother"         => CodeMaster::GetNumberOfBrother(),
                                                            "NumberofElderBrother"    => CodeMaster::GetNumberOfElderBrother(),
                                                            "NumberofYoungerBrother"  => CodeMaster::GetNumberOfYoungerBrother(),
                                                            "NumberofMarriedBrother"  => CodeMaster::GetNumberOfMarriedBrother(),
                                                            "NumberofSisters"         => CodeMaster::GetNumberOfSisters(),
                                                            "NumberofElderSisters"    => CodeMaster::GetNumberOfElderSisters(),
                                                            "NumberofYoungerSisters"  => CodeMaster::GetNumberOfYoungerSisters(),
                                                            "NumberofMarriedSisters"  => CodeMaster::GetNumberOfMarriedSisters(),
                                                            "PhysicallyImpaired"      => CodeMaster::GetPhysicallyImpaired(),
                                                            "VisuallyImpaired"        => CodeMaster::GetVisuallyImpaired(),
                                                            "VissionImpaired"         => CodeMaster::GetVisionImpaired(),
                                                            "SpeechImpaired"          => CodeMaster::GetSpeechImpaired(),
                                                            "Height"                  => CodeMaster::GetHeight(),
                                                            "Weight"                  => CodeMaster::GetWeight(),
                                                            "BloodGroup"              => CodeMaster::GetBloodGroups(),
                                                            "Complexation"            => CodeMaster::GetSkinType(),
                                                            "BodyType"                => CodeMaster::GetBodyType(),
                                                            "Diet"                    => CodeMaster::GetDiet(),
                                                            "SmookingHabit"           => CodeMaster::GetSmokingHabit(),
                                                            "DrinkingHabit"           => CodeMaster::GetDrinkingHabit(),
                                                            "DocumentType"            => CodeMaster::GetDocumentType(),
                                                            "CountryName"             => CodeMaster::GetCountryName(),
                                                            "StateName"               => CodeMaster::GetStateName()));
         } 
         function editprofileviewinfo(){
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from _tbl_Profile_Draft where CreatedBy='".$loginInfo[0]['MemberID']."' and ProfileID='".$_POST['Code']."'");               
             return Response::returnSuccess("success",array("ProfileInfo"             => $Profiles[0],
                                                            "ProfileSignInFor"        => CodeMaster::GetProfileFor(),
                                                            "Gender"                  => CodeMaster::GetGender(),
                                                            "MaritalStatus"           => CodeMaster::GetMaritalStatus(),
                                                            "Language"                => CodeMaster::GetLanguage(),
                                                            "Religion"                => CodeMaster::GetReligion(),
                                                            "Caste"                   => CodeMaster::GetCaste(),
                                                            "Community"               => CodeMaster::GetCommunity(),
                                                            "Nationality"             => CodeMaster::GetNationality(),
                                                            "EmployedAs"              => CodeMaster::GetEmployedAs(),
                                                            "Occupation"              => CodeMaster::GetOccupation(),
                                                            "TypeofOccupation"        => CodeMaster::GetOccupationTypes(),
                                                            "IncomeRange"             => CodeMaster::GetIncomeRange(),
                                                            "NumberofBrother"         => CodeMaster::GetNumberOfBrother(),
                                                            "NumberofElderBrother"    => CodeMaster::GetNumberOfElderBrother(),
                                                            "NumberofYoungerBrother"  => CodeMaster::GetNumberOfYoungerBrother(),
                                                            "NumberofMarriedBrother"  => CodeMaster::GetNumberOfMarriedBrother(),
                                                            "NumberofSisters"         => CodeMaster::GetNumberOfSisters(),
                                                            "NumberofElderSisters"    => CodeMaster::GetNumberOfElderSisters(),
                                                            "NumberofYoungerSisters"  => CodeMaster::GetNumberOfYoungerSisters(),
                                                            "NumberofMarriedSisters"  => CodeMaster::GetNumberOfMarriedSisters(),
                                                            "PhysicallyImpaired"      => CodeMaster::GetPhysicallyImpaired(),
                                                            "VisuallyImpaired"        => CodeMaster::GetVisuallyImpaired(),
                                                            "VissionImpaired"         => CodeMaster::GetVisionImpaired(),
                                                            "SpeechImpaired"          => CodeMaster::GetSpeechImpaired(),
                                                            "Height"                  => CodeMaster::GetHeight(),
                                                            "Weight"                  => CodeMaster::GetWeight(),
                                                            "BloodGroup"              => CodeMaster::GetBloodGroups(),
                                                            "Complexation"            => CodeMaster::GetSkinType(),
                                                            "BodyType"                => CodeMaster::GetBodyType(),
                                                            "Diet"                    => CodeMaster::GetDiet(),
                                                            "SmookingHabit"           => CodeMaster::GetSmokingHabit(),
                                                            "DrinkingHabit"           => CodeMaster::GetDrinkingHabit(),
                                                            "DocumentType"            => CodeMaster::GetDocumentType(),
                                                            "CountryName"             => CodeMaster::GetCountryName(),
                                                            "StateName"               => CodeMaster::GetStateName()));
         }
         function updateProfilePhoto() {
             
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("update  _tbl_members set FileName='".$_POST['filename']."'  where MemberID='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",array());
         }
         function GetMyEmails() {
           global $mysql;    
              $MyEmails = $mysql->select("select * from _tbl_logs_email where MemberID='".$loginInfo[0]['MemberID']."'");
                return Response::returnSuccess("success",$MyEmails);
                                                            
    }          
     }   
     
?> 