<?php

     class Member {

         function Login() {

             global $mysql,$loginInfo,$j2japplication;

             if (!(strlen(trim($_POST['UserName']))>0)) {
                 return Response::returnError("Please enter login name ");
             }

             if (!(strlen(trim($_POST['Password']))>0)) {
                 return Response::returnError("Please enter login password ");
             }

             $data=$mysql->select("select * from `_tbl_members` where (`MemberLogin`='".$_POST['UserName']."' or `EmailID`='".$_POST['UserName']."' or `MobileNumber`='".$_POST['UserName']."') and `IsDeleted`='0'");
             $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
             $loginid = $mysql->insert("_tbl_logs_logins",array("LoginOn"       => date("Y-m-d H:i:s"),
                                                                 "LoginFrom"     => "Web",
                                                                 "Device"        => $clientinfo['Device'],
                                                                 "MemberID"      => $data[0]['MemberID'],
                                                                 "LoginName"     => $_POST['UserName'],
                                                                 "BrowserIP"     => $clientinfo['query'],
                                                                 "CountryName"   => $clientinfo['country'],
                                                                 "BrowserName"   => $clientinfo['UserAgent'],
                                                                 "APIResponse"   => json_encode($clientinfo),
                                                                 "LoginPassword" => $_POST['Password']));
             if (sizeof($data)>0) {

                 if ($data[0]['MemberPassword']==$_POST['Password']) {              

                     $mysql->execute("update `_tbl_logs_logins` set `LoginStatus`='1' where `LoginID`='".$loginid."'");

                     if ($data[0]['IsActive']==1) {

                         if($data[0]['WelcomeMsg']==0) {
                            $d=$mysql->select("Select * From `_tbl_welcome_message` where `IsActive`='1' and `UserRole`='Member'");
                            $data[0]['WelcomeMessage']=$d[0]['Message'];  
                         }
                         $data[0]['LoginID']=$loginid;
                         return Response::returnSuccess("success",$data[0]);

                     } else {
                        return Response::returnError("Access denied. Please contact support");   
                     }
                 } else {
                     return Response::returnError("Invalid username or password");
                 }
             } else {
                return Response::returnError("Invalid username and password");
             }
         }

         function Logout() {
             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_logs_logins` set `UserLogout`='".date("Y-m-d H:i:s")."' where `LoginID`='".$loginInfo[0]['LoginID']."'") ;
             return Response::returnSuccess("success",array()); 
         }

         function GetLoginHistory() {
             global $mysql,$loginInfo;
             $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$loginInfo[0]['MemberID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
                return Response::returnSuccess("success",$LoginHistory);
         }

         function GetNotificationHistory() {
             global $mysql,$loginInfo;
             $NotificationHistory = $mysql->select("select * from `_tbl_logs_activity` where `MemberID`='".$loginInfo[0]['MemberID']."' ORDER BY `ActivityID` DESC LIMIT 0,5");
                return Response::returnSuccess("success",$NotificationHistory);
         }

         function Register() {

             global $mysql;

             if (!(strlen(trim($_POST['Name']))>0)) {
                return Response::returnError("Please enter your name");
             }

             if (!(strlen(trim($_POST['Email']))>0)) {
                return Response::returnError("Please enter your email");
             }

             if (!(strlen(trim($_POST['Gender']))>0)) {
                return Response::returnError("Please enter password");
             }

             if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter password");
             }

             if (!(strlen(trim($_POST['LoginPassword']))>0)) {
                return Response::returnError("Please enter password");
             }

             $data = $mysql->select("select * from `_tbl_members` where  `MobileNumber`='".$_POST['MobileNumber']."'");
             if (sizeof($data)>0) {
                 return Response::returnError("Mobile Number Already Exists");
             }

             $data = $mysql->select("select * from `_tbl_members` where  `EmailID`='".$_POST['Email']."'");
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
             $data = $mysql->select("select * from `_tbl_members` where `MemberID`='".$id."'");

             $loginid = $mysql->insert("_tbl_logs_logins",array("LoginOn"  => date("Y-m-d H:i:s"),
                                                                "MemberID" => $data[0]['MemberID']));

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='NewMemberCreated'");
             $content  = str_replace("#MemberName#",$_POST['Name'],$mContent[0]['Content']);
             $content  = str_replace("#MemberID#",$MemberCode,$content);
             $content  = str_replace("#LoginPassword#",$_POST['LoginPassword'],$content);

             MailController::Send(array("MailTo"   => $_POST['Email'],
                                        "Category" => "NewMemberCreated",
                                        "MemberID" => $id,
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);

             $data[0]['LoginID']=$loginid; 
             $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Member'");      
             return Response::returnSuccess("Registered successfully",$data[0]);
         }

         function forgotPassword() {

             global $mysql,$mail;            

             if (Validation::isEmail($_POST['FpUserName'])) {
                $data = $mysql->select("Select * from `_tbl_members` where `EmailID`='".$_POST['FpUserName']."'");
                if (sizeof($data)==0){
                    return Response::returnError("E-mail address not available");
                }
             } else {
                $data = $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$_POST['FpUserName']."'");    
                if (sizeof($data)==0){
                    return Response::returnError("Member ID not available");
                }
             }

             $otp=rand(1000,9999);
             $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID"      => $data[0]['MemberID'],
                                                                           "RequestSentOn" => date("Y-m-d H:i:s"),
                                                                           "SecurityCode"  => $otp,
                                                                           "messagedon"    => date("Y-m-d h:i:s"), 
                                                                           "EmailTo"       => $data[0]['EmailID'],
                                                                           "Type"          => "Forget Password")) ; 

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberPasswordForget'");
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
             $data = $mysql->select("Select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqID']."' ");
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
             $data = $mysql->select("Select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqID']."' ");

             if (!(strlen(trim($_POST['newpassword']))>=6)) {
                return Response::returnError("Please enter valid new password must have 6 characters");
             } 
             if (!(strlen(trim($_POST['confirmnewpassword']))>=6)) {
                return Response::returnError("Please enter valid confirm new password  must have 6 characters"); 
             } 
             if ($_POST['confirmnewpassword']!=$_POST['newpassword']) {
                return Response::returnError("Password do not match"); 
             }
             $sqlQry ="update _tbl_members set `MemberPassword`='".$_POST['newpassword']."' where `MemberID`='".$data[0]['MemberID']."'";
             $mysql->execute($sqlQry);  
             $data = $mysql->select("select * from `_tbl_members` where  MemberID='".$data[0]['MemberID']."'");
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $data[0]['MemberID'],
                                                             "ActivityType"   => 'forgetpasswordchangepassword.',
                                                             "ActivityString" => 'forget password changed password.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

             return Response::returnSuccess("New Password saved successfully",$data[0]);  
         }

         function IsMobileVerified() {
             return false;
         }

         function GetMemberInfo(){
             global $mysql,$loginInfo;
             $Member=$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             $Member[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             return Response::returnSuccess("success",$Member[0]);
         }    

         function EditMemberInfo() {

             global $mysql,$loginInfo;

             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");

             $sqlQry = " update `_tbl_members` set `MemberName`='".$_POST['MemberName']."'   ";

             if($Member[0]['IsMobileVerified']==0) {
                 $sqlQry .= ", MobileNumber='".$_POST['MobileNumber']."' " ;
                 //mobile format

                 //duplicate, 
                 $data = $mysql->select("select * from `_tbl_members` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and MemberID <>'".$loginInfo[0]['MemberID']."'");
                 if (sizeof($data)>0) {
                    return Response::returnError("Mobile Number Already Exists");    
                 }
             } 
             if($Member[0]['IsEmailVerified']==0) {
                $sqlQry .= ", `EmailID`='".$_POST['EmailID']."', `CountryCode`='".$_POST['CountryCode']."' " ;
                //email format

                //duplicate,
                $data = $mysql->select("select * from  `_tbl_members` where `EmailID`='".trim($_POST['EmailID'])."' and `MemberID` <>'".$loginInfo[0]['MemberID']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("EmailID Already Exists");    
                }
             }

             $sqlQry .= " where  `MemberID`='".$Member[0]['MemberID']."'" ;  
             $mysql->execute($sqlQry)  ;
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Yourmemberinformationupdated.',
                                                             "ActivityString" => 'Your member information updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             return Response::returnSuccess("success",array());
         }

         function WelcomeMessage() {
             global $mysql,$loginInfo;
             $welcome=$mysql->execute("update `_tbl_members` set `WelcomeMsg`='1' where  `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("New Password saved successfully",array());
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
             if ((strlen(trim($_POST['MaritalStatus']))==0 || $_POST['MaritalStatus']=="0" )) {
                return Response::returnError("Please select marital status");
             }                                                                                                          
             if ((strlen(trim($_POST['Language']))==0 || $_POST['Language']=="0" )) {
                return Response::returnError("Please select language");
             }
             if ((strlen(trim($_POST['Religion']))==0 || $_POST['Religion']=="0" )) {
                return Response::returnError("Please select religion");
             }
             if ((strlen(trim($_POST['Caste']))==0 || $_POST['Caste']=="0" )) {
                return Response::returnError("Please select caste");
             }
             if ((strlen(trim($_POST['Community']))==0 || $_POST['Community']=="0" )) {
                return Response::returnError("Please select community");
             }
             if ((strlen(trim($_POST['Nationality']))==0 || $_POST['Nationality']=="0" )) {
                return Response::returnError("Please select nationality");
             }

             $member= $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             
             $ProfileFors = CodeMaster::getData("PROFILESIGNIN",$_POST["ProfileFor"]);
             $MaritalStatus = CodeMaster::getData("MARTIALSTATUS",$_POST["MaritalStatus"]);
             $Sex           = CodeMaster::getData("SEX",$_POST["Sex"]); 
             $MotherTongue  = CodeMaster::getData("LANGUAGENAMES",$_POST["Language"]); 
             $Religion      = CodeMaster::getData("RELINAMES",$_POST["Religion"]);
             $Caste         = CodeMaster::getData("CASTNAMES",$_POST["Caste"]);
             $Community     = CodeMaster::getData("COMMUNITY",$_POST["Community"]); 
             $Nationality   = CodeMaster::getData("NATIONALNAMES",$_POST["Nationality"]);
             $ProfileCode   =SeqMaster::GetNextDraftProfileCode();
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
             $id =  $mysql->insert("_tbl_draft_profiles",array("ProfileCode"      => $ProfileCode,
                                                              "ProfileForCode"    => $_POST['ProfileFor'],
                                                              "ProfileFor"        => $ProfileFors[0]['CodeValue'],
                                                              "ProfileName"       => $_POST['ProfileName'],
                                                              "DateofBirth"       => $dob,        
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
                                                              "NationalityCode"   => $_POST['Nationality'],
                                                              "Nationality"       => $Nationality[0]['CodeValue'],
                                                              "MemberID"          => $loginInfo[0]['MemberID'],
                                                              "MemberCode"          => $member[0]['MemberCode'],
                                                              "CreatedByMemberID" => $loginInfo[0]['MemberID']));
             if (sizeof($id)>0) {
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='DraftProfile'");
                 return Response::returnSuccess("success",array("Code"=>$ProfileCode));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }

         function MemberChangePassword(){

             global $mysql,$loginInfo;
             $getpassword = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             if ($getpassword[0]['MemberPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Current password"); 
             } 
             if ($getpassword[0]['MemberPassword']==$_POST['CurrentPassword']) {
                 $oldData = $mysql->select("select * from  `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
                 $sqlQry = "update `_tbl_members` set `MemberPassword`='".$_POST['ConfirmNewPassword']."' where `MemberID`='".$loginInfo[0]['MemberID']."'";
                 $mysql->execute($sqlQry);
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                                 "ActivityType"   => 'Passwordchanged',
                                                                 "ActivityString" => 'Password changed',
                                                                 "SqlQuery"       => base64_encode($sqlQry),
                                                                 "oldData"        => base64_encode(json_encode($oldData)),
                                                                 "ActivityOn"     => date("Y-m-d H:i:s"))); 
                 return Response::returnSuccess("Password Changed Successfully",array());
             }
         }

         function GetAdvancedSearchElements() {
             return Response::returnSuccess("success",array("SkinType"      => CodeMaster::getData('COMPLEXIONS'),
                                                            "MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"         => CodeMaster::getData('CASTNAMES'),
                                                            "Height"        => CodeMaster::getData('HEIGHTS'),
                                                            "Diet"          => CodeMaster::getData('DIETS'),
                                                            "SmokingHabit"  => CodeMaster::getData('SMOKINGHABITS'),
                                                            "DrinkingHabit" => CodeMaster::getData('DRINKINGHABITS'),
                                                            "BodyType"      => CodeMaster::getData('BODYTYPES')));
         }

         function GetBasicSearchElements() {
             return Response::returnSuccess("success",array("MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"      => CodeMaster::getData('CASTNAMES'),
                                                            "Community"     => CodeMaster::getData('COMMUNITY')));
         }

         function CheckVerification() {

             global $mysql,$loginInfo;
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             if ($memberdata[0]['IsMobileVerified']==0) {
                 return $this->ChangeMobileNumberFromVerificationScreen("",$loginInfo[0]["LoginID"],"","");
             }
             if ($memberdata[0]['IsEmailVerified']==0) {
                 return $this->ChangeEmailFromVerificationScreen("",$loginInfo[0]["LoginID"],"","");
             }
             return "<script>location.href='".AppPath."/MyProfiles/CreateProfile';</script>";
         }

         function SaveBasicSearch() {

             global $mysql,$loginInfo; 
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
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
                $data = $mysql->select("select * from `_tbl_profile_search_history` were `SearchName`='".$_POST['SaveSearchas']."'");
                if (sizeof($data)>0) {
                    return Response::returnError("Search Name Already Exists");
                }
                $countofsearch= $mysql->select("select * from `_tbl_profile_search_history` where `MemberID`='".$loginInfo[0]['MemberID']."' and SearchType='Basic Search' and IsVisible='1' and IsSaved='1'");   
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

             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");

             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
             } else {
                $formid = "frmChangeMobileNumber_".rand(30,3000);
                return '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">

                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -12px;">&times;</button>
                                <div class="input-group">
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                                    <h5 style="color: #777;line-height:20px;font-weight: 100;padding-top: 21px;">In order to protect the security of your account, we will send you a text message with a verification that you will need to enter the next screen</h4>
                                </div> 
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/smallmobile.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">+'.$memberdata[0]['CountryCode'].'&nbsp;'.$memberdata[0]['MobileNumber'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumber()">Change</h4>
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

             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");

             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");

             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="CheckVerification()">Continue</a>
                       </div>';    
            } else {
                $formid = "frmChangeMobileNo_".rand(30,3000);
                
                $countrycode=CodeMaster::getData('RegisterAllowedCountries');
                                                                                                          
                $return = '<div id="otpfrm" style="width:100%;padding-bottom: 0px;padding-top:20px;">
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
                                    <div class="col-sm-5" style="margin-right:-15px">
                                        <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="padding-top: 4px;padding-bottom: 4px;text-align: center;font-family: Roboto;"> ';
                                             foreach($countrycode as $CountryCode) {  
                                                $return .=' <option value="'.$CountryCode['ParamA'].'"  '.(($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "").' >'.$CountryCode['str'].'</option>';
                                             }
                                        $return .=   '</select>
                                    </div>
                                    <div class="col-sm-7">                                                                                                                                                                                          
                                        <input type="text" class="form-control" value="'.$scode.'" id="new_mobile_number"  name="new_mobile_number"  maxlength="10" style="font-family:Roboto;"></div>
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
                        return $return;
            
         }
         } 

         function MobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {

             if ($loginid=="") {
                 $loginid = $_GET['LoginID'];
             }
             global $mysql;
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             $updatemsg = "";
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";                               
             }
             if (isset($_POST['new_mobile_number'])) {
                 if (strlen(trim($_POST['new_mobile_number']))==0) {
                     return $this->ChangeMobileNumber("Please enter mobile number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 if (strlen(trim($_POST['new_mobile_number']))!=10) {
                     return $this->ChangeMobileNumber("Invalid Mobile Number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 

                 $duplicate = $mysql->select("select * from `_tbl_members` where `MobileNumber`='".$_POST['new_mobile_number']."' and MemberID <>'".$login[0]['MemberID']."'");
                 if (sizeof($duplicate)>0) {
                     return $this->ChangeMobileNumber("Mobile Number already in use.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 $sql="update `_tbl_members` set `MobileNumber`='".$_POST['new_mobile_number']."' , `CountryCode`='".$_POST['CountryCode']."' where `MemberID`='".$login[0]['MemberID']."'" ;
                 $mysql->execute($sql);
                 
                 $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
                 
                 $mContent = $mysql->select("select * from `mailcontent` where `Category`='MobileNumberChanged'");
                 $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],                        
                                        "Category" => "MobileNumberChanged",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Mobile Number has been changed.");  
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $login[0]['MemberID'],
                                                             "ActivityType"   => 'MonileNumberChanged.',
                                                             "ActivityString" => 'Mobile Number Changed.',
                                                             "SqlQuery"       => base64_encode($sql),            
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 $updatemsg = "<div class='successmessage'>Your new mobile number has been updated.</div>";
             }
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
             } else {
                 if ($error=="") {
                     $otp=rand(1111,9999);
                     $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                  "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                  "SMSTo" =>$memberdata[0]['MobileNumber'],
                                                                                  "SecurityCode" =>$otp,
                                                                                  "Type" =>"Mobile Verification",
                                                                                  "messagedon"=>date("Y-m-d h:i:s"))) ; 
                     MobileSMSController::sendSMS($memberdata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                 }  else {
                     $securitycode = $reqID;
                 }
                 $formid = "frmMobileNoVerification_".rand(30,3000);
                 return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">                      
                         <form method="POST" id="'.$formid.'">
                         <input type="hidden" value="'.$_GET['callfrom'].'" name="callfrom">     
                         <input type="hidden" value="'.$loginid.'" name="loginId">
                         <input type="hidden" value="'.$securitycode.'" name="reqId">                          
                            <div class="form-group">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                            '.(($updatemsg!="") ? $updatemsg : "").'
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                            </div> 
                            <div style="text-align:left"> Dear '.$memberdata[0]['MemberName'].',<br>
                                <h5 style="color: #777;line-height:20px;font-weight: 100;">Please enter the verification code which you have received on your mobile number ending with  +'.$memberdata[0]['CountryCode'].'&nbsp;'.J2JApplication::hideMobileNumberWithCharacters($memberdata[0]['MobileNumber']).'</h5>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>                                                              
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>'; 
             }
         }

         function MobileNumberOTPVerification() {

             global $mysql;

             $otpInfo = $mysql->select("select * from `_tbl_verification_code` where RequestID='".$_POST['reqId']."'");
             if (strlen(trim($_POST['mobile_otp_2']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['mobile_otp_2']))  {
                 $sql = "update `_tbl_members` set `IsMobileVerified`='1', `MobileVerifiedOn`='".date("Y-m-d H:i:s")."' where `MemberID`='".$otpInfo[0]['MemberID']."'";
                 $mysql->execute($sql);  
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $otpInfo[0]['MemberID'],
                                                             "ActivityType"   => 'MobileVerified.',
                                                             "ActivityString" => 'Mobile Number Verified.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                  return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h5>
                            <h5 style="text-align:center;"><a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
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
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
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
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'&nbsp;&#65372&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12" style="text-align:center"><a  href="javascript:void(0)" onclick="EmailVerificationForm()" class="btn btn-primary" name="verifybtn" id="verifybtn">Continue to verify</a></div>
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

             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");

             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
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
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             $updatemsg = "";
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }
             if (isset($_POST['new_email'])) {
                 if (strlen(trim($_POST['new_email']))==0) {
                     return $this->ChangeEmailID("Please enter valid email id",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                 }
                 $duplicate = $mysql->select("select * from _tbl_members where EmailID='".$_POST['new_email']."' and MemberID <>'".$login[0]['MemberID']."'");

                 if (sizeof($duplicate)>0) {
                     return $this->ChangeEmailID("Email already in use.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                 }
                 $sql="update `_tbl_members` set `EmailID`='".$_POST['new_email']."' where `MemberID`='".$login[0]['MemberID']."'";
                 $mysql->execute($sql);
                 
                 $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
                 
                 $mContent = $mysql->select("select * from `mailcontent` where `Category`='EmailIDChanged'");
                 $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],                        
                                        "Category" => "EmailIDChanged",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Email ID has been changed.");  
             
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $login[0]['MemberID'],
                                                             "ActivityType"   => 'EmailIDChanged.',
                                                             "ActivityString" => 'Email ID Changed.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 $updatemsg = "<div class='successmessage'>Your new email address has been updated.</div>";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");

             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
             } else {

                 if ($error=="") {
                     $otp=rand(1111,9999);

                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberEmailVerification'");
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
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                     "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" =>$memberdata[0]['EmailID'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" =>"EmailVerification",
                                                                                     "messagedon"=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    '.(($updatemsg!="") ? $updatemsg : "").'
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digits verification Code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
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
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }
                                                                                                                                                         
                 }  else {
                    $securitycode = $reqID;

                    $formid = "frmMobileNoVerification_".rand(30,3000);
                 $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#ada9a9">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
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
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>'; 
                }
            }                                    
         }
                                                                                     
         function EmailOTPVerification() {

             global $mysql;
             $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
             if (strlen(trim($_POST['email_otp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['email_otp']))  {
                 $sql = "update `_tbl_members` set `IsEmailVerified`='1', `EmailVerifiedOn`='".date("Y-m-d H:i:s")."' where `MemberID`='".$otpInfo[0]['MemberID']."'";
                 $mysql->execute($sql); 
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $otpInfo[0]['MemberID'],
                                                             "ActivityType"   => 'EmailIDVerified.',
                                                             "ActivityString" => 'Email ID Verified.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';
                       
             } else {
                 return $this->EmailVerificationForm("<span style='color:red'>Invalid verification code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
             }  
         }

         function GetMyProfiles() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */

                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and  RequestToVerify='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and  RequestToVerify='1' and IsApproved='0'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode']);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles['0']['ProfileID']."' and  `MemberID` = '".$loginInfo[0]['MemberID']."'");
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
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and RequestToVerify='0'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode']);
                        $result['mode']="Draft";
                        $Profiles[]=$result;   
                     }
                 }
                 
                 return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Posted") {    /* Profile => Posted */
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and RequestToVerify='1'");

                  if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode']);
                        $result['mode']="Posted";
                        $Profiles[]=$result;  
                     }
                 }
                 
                return Response::returnSuccess("success",$Profiles);
             }

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Published") {    /* Profile => Posted */
                
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and IsApproved='1'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInformation($PublishedProfile['ProfileCode']);
                        $result['mode']="Published";
                        $Profiles[]=$result; 
                     }
                }
                return Response::returnSuccess("success",$Profiles);
             }
         }
         
         function DownloadedProfiles() {
                global $mysql,$loginInfo;

                $DownloadProfiles = $mysql->select("select * from _tbl_profile_download where MemberID='".$loginInfo[0]['MemberID']."'");
                $Profiles = $mysql->select("SELECT *
                                                FROM _tbl_profiles
                                                LEFT JOIN _tbl_profile_download
                                                ON _tbl_profiles.ProfileCode = _tbl_profile_download.PartnerProfileCode"); 
                                                
                $ProdileDetails = $mysql->select("select * from _tbl_profile_credits where MemberID='".$loginInfo[0]['MemberID']."' and ProfileID ='".$_POST_['ProfileID']."'");

                  $result = array();
                  foreach($Profiles as $p) {
                      $p['profileImage']= $p['SexCode']=="SX002" ? "assets/images/noprofile_female.png" : "assets/images/noprofile_male.png";
                     $result[]=$p; 
                  }
                return Response::returnSuccess("success",array("Profiles" => $Profiles,"ProfileDetails" => $ProdileDetails));
     
         }  

         function  BasicSearchViewMemberPlan() {
             global $mysql,$loginInfo;
             $Plans = $mysql->select("select * from _tbl_member_plan");
             return Response::returnSuccess("success",$Plans);
         }
         
         function OverallSendOtp($errormessage="",$otpdata="",$reqID="",$PProfileID="") {
             
             global $mysql,$mail,$loginInfo;            

           $data = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['PProfileCode']."'");   

           $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
        if ($reqID=="")      {
             $otp=rand(1000,9999);

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ProfileOverAllOTP'");
             $content  = str_replace("#ProfileName#",$data[0]['ProfileName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ProfileOverAllOTP",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);

            if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$member[0]['MemberID'],
                                                                                     "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" =>$member[0]['EmailID'],
                                                                                     "SMSTo" =>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" =>"ProfileOverAllOTP",
                                                                                     "messagedon"=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmOverAllOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <input type="hidden" value="'.$_POST['PProfileCode'].'" name="PProfileCode">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#6c6969;">OTP</h4>
                                </div>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" id="otpcheck" maxlength="4" name="otpcheck" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ViewProfileOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }
        } else {
            $formid = "frmOverAllOTPVerification_".rand(30,3000);
                 return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$reqID.'" name="reqId">
                              <input type="hidden" value="'.$PProfileID.'" name="CProfileID">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#6c6969;">OTP</h4>
                                </div>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" value="'.$otpdata.'" id="otpcheck" maxlength="4" name="otpcheck" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ViewProfileOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$errormessage.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a href="#">&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
        }

         }
         function ViewProfileOTPVerification() {

             global $mysql,$loginInfo ;
             $data = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['PProfileCode']."'");   
             $Profiles = $mysql->select("Select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
             $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
             if (strlen(trim($_POST['otpcheck']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['otpcheck']))  {

                     $Did = $mysql->insert("_tbl_profile_download",array("MemberID" =>$otpInfo[0]['MemberID'],
                                                                          "ProfileCode" =>$Profiles[0]['ProfileCode'],
                                                                          "PartnerProfileCode" =>$data[0]['ProfileCode'],
                                                                          "DownLoadOn" =>date("Y-m-d H:i:s"))) ;  
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">successfully verified. </h5>
                            <p style="text-align:center"><a href="BasicSearchResult" class="btn btn-primary">Continue</a></p>
                       </div>';
             } else {
                 return $this->OverallSendOtp("<span style='color:red'>Invalid verification code.</span>",$_POST['otpcheck'],$_POST['reqId'],$_POST['PProfileCode']);
             } 

         }

         function VerifyProfileforPublish() {                          

             global $mysql,$loginInfo;

             $updateSql = "update `_tbl_draft_profiles` set  `RequestToVerify`      = '1',
                                                            `RequestVerifyOn`      = '".date("Y-m-d H:i:s")."'
                                                             where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileID`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'RequestToVerifyPublishProfile.',
                                                             "ActivityString" => 'Request To Verify PublishProfile.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 return  $updateSql.'<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your profile publish request has been submitted.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>';

         }
        function SendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {

        global $mysql,$mail,$loginInfo;      
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
        /* return $data[0]['ProfileName'].strlen(trim($data[0]['ProfileName'])); 
          /*   if (sizeof($data)==0) {
                return "Record not found.<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
             
             if ($data[0]['RequestToVerify']==1) {
                return "Already sent request to verify.<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
             
             if (strlen(trim($data[0]['ProfileFor']))==0) {
                return "Please choose Profile for in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             
             if (strlen(trim($data[0]['ProfileName']))==0) {
                return "Please choose Profile for Name in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
                                                                                                                         
             if (strlen(trim($data[0]['DateofBirth']))==0) {
                return "Please choose Date of Birth in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['Sex']))==0) {
                return "Please choose Sex in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['MaritalStatus']))==0) {
                return "Please choose Marital Status in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['MotherTongue']))==0) {
                return "Please choose Mother Tongue in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['Religion']))==0) {
                return "Please choose Religion in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['Caste']))==0) {
                return "Please choose Caste in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['Community']))==0) {
                return "Please choose Community in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['Nationality']))==0) {
                return "Please choose Nationality in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             }
             if (strlen(trim($data[0]['AboutMe']))=="") {
                return "Please choose About Me in General Information.<a data-dismiss='modal' style='cursor:pointer;text-align:center'>Continue</a>"; 
             } */     

           $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileID`='".$_POST['ProfileID']."'");   

           $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
        if ($reqID=="")      {
             $otp=rand(1000,9999);

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishProfile'");
             $content  = str_replace("#ProfileName#",$data[0]['ProfileName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RequestToVerifyPublishProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);

            if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$member[0]['MemberID'],
                                                                                     "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" =>$member[0]['EmailID'],
                                                                                     "SMSTo" =>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" =>"RequestToVerifyPublishProfile",
                                                                                     "messagedon"=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">Profile Publish</h4> <br>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>                                                                      
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }
        } else {
            $formid = "frmPuplishOTPVerification_".rand(30,3000);
                 return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$reqID.'" name="reqId">
                              <input type="hidden" value="'.$ProfileID.'" name="ProfileID">
                            <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#6c6969;">OTP</h4>
                                </div>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" value="'.$otpdata.'" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$errormessage.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
        }
                                                                                                                                                                              
         }
        function ProfilePublishOTPVerification() {

             global $mysql,$loginInfo ;
             
             $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
             
           /*  if (sizeof($data)==0) {
                return "Record not found.<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
             
             if ($data[0]['RequestToVerify']==1) {
                return "Already sent request to verify.<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
             
             if (strlen(trim($data[0]['ProfileFor']))>0) {
                return "Please choose Profile for in General Information.<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
             
             if (strlen(trim($data[0]['ProfileName']))>0) {
                return "Please choose Profile for .<a data-dismiss='modal' style='cursor:pointer'>Continue</a>"; 
             }
                  */ 
               
             
           $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
             $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
             if (strlen(trim($_POST['PublishOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['PublishOtp']))  {

                    $updateSql = "update `_tbl_draft_profiles` set  `RequestToVerify`      = '1',
                                                            `RequestVerifyOn`      = '".date("Y-m-d H:i:s")."'
                                                             where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
           /*  $mysql->execute("update `_tbl_draft_profiles_photos` set  `IsPublished`      = '1',
                                                            `PublishedOn`      = '".date("Y-m-d H:i:s")."'
                                                             where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileID`='".$data[0]['ProfileID']."'");  */
                                                             
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
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
                            <h5 style="text-align:center;"><a href="../../../Dashoard" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

             } else {
                 return $this->SendOtpForProfileforPublish("<span style='color:red'>Invalid verification code.</span>",$_POST['PublishOtp'],$_POST['reqId'],$_POST['ProfileID']);
             } 

         }
         function DeleteAttach() {

             global $mysql,$loginInfo;

             $updateSql = "update `_tbl_draft_profiles_education_details` set `IsDeleted` = '1' where `AttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
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
         
         function GetDraftProfileInfo() {                           
               
                global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
            
            
               $result =  Profiles::getDraftProfileInformation($Profiles[0]['ProfileCode']);
               return Response::returnSuccess("success",$result);
           }
         function GetPublishProfileInfo() {
               
                global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
            
            
               $result =  Profiles::getProfileInformation($Profiles[0]['ProfileCode']);
               return Response::returnSuccess("success",$result);
           }

         function GetDraftProfileInformation($ProfileCode="",$rtype="") {
             
             $ProfileCode = $ProfileCode != "" ? $ProfileCode : $_POST['ProfileCode'];
             
             global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
             
             $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
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
              $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0'  and ProfileID='".$Profiles[0]['ProfileID']."'");
              
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
                                                            "ParentsAlive"              => CodeMaster::getData('PARENTSALIVE'),
                                                            "ChevvaiDhosham"              => CodeMaster::getData('CHEVVAIDHOSHAM'),
                                                            "StateName"              => CodeMaster::getData('STATNAMES'));
             if ($rtype=="")  {
             return Response::returnSuccess("success",$result);
             } else {
                 return  $result;
             }                                                    
         }
       /*  function GetDownloadProfileInformation() {
             global $mysql,$loginInfo;        
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
             $Educationattachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileID='".$Profiles[0]['DraftProfileID']."'");
             $PartnersExpectations = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['DraftProfileID']."'");               
             $ProfilePhoto = $mysql->select("select * from `_tbl_draft_profiles_photos` where `ProfileID`='".$Profiles[0]['DraftProfileID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0'");               

               $IsDownload= $mysql->select("select * from `_tbl_profile_download` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");
              if (sizeof($IsDownload)>0) {              
                     $id = $mysql->insert("_tbl_profile_viewlog",array("MemberID"        => $loginInfo[0]['MemberID'],
                                                                 "ProfileID"    => $Profiles[0]['ProfileID'],
                                                                 "LoginOn"      => date("Y-m-d H:i:s")));
             return Response::returnSuccess("success"."select * from `_tbl_draft_profiles_photos` where `ProfileID`='".$Profiles[0]['DraftProfileID']."'",array("ProfileInfo"            => $Profiles[0],
                                                            "PartnerExpectation"     => $PartnersExpectations[0],
                                                            "ProfilePhoto"     => $ProfilePhoto,
                                                            "EducationAttachments"   => $Educationattachments[0]));
         }
         else{
             return Response::returnError("not authenticated");
         }
         } */
         function SelectPlanAndContinue() {

             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileID='".$_POST['Code']."'");               
              $plan =$mysql->select("select * from `_tbl_member_plan` where `PlanID`='".$_POST['PlanID']."'"); 
              $orderid=SeqMaster::GetNextOrderCode() ;     
            /* $id = $mysql->insert("_tbl_orders",array("ProfileID"       => $_POST['Code'],
                                                      "Plan"       => $plan[0]['PlanName'],
                                                      "Amount"       => $plan[0]['Amount'],
                                                      "Duration"       => $plan[0]['Decreation'],
                                                      "OrderOn"     => date("Y-m-d H:i:s")));   */

            $id = $mysql->insert("_tbl_orders",array("OrderDate"            => DATE("Y-m-d H:i:s"),
                                                     "OrderNumber"          => $orderid,
                                                     "ProfileID"            =>  $Profiles[0]['ProfileCode'],
                                                     "ProfileName"          => $Profiles[0]['ProfileName'],
                                                     "EmailID"              => $Profiles[0]['EmailID'],
                                                     "MobileNumber"         => $Profiles[0]['MobileNumber'],
                                                     "AddressLine1"         => $Profiles[0]['AddressLine1'],
                                                     "AddressLine2"         => $Profiles[0]['AddressLine2'],
                                                     "AddressLine3"         => $Profiles[0]['AddressLine3'],
                                                     "Pincode"              => $Profiles[0]['Pincode'],
                                                     "OrderValue"           => $plan[0]['Amount'],
                                                     "Createdon"            => DATE("Y-m-d H:i:s"),
                                                     "OrderedOn"            => "0000-00-00 00:00:00",
                                                     "OrderByMemberID"      => $loginInfo[0]['MemberID'],
                                                     "OrderedByProfileID"   => $Profiles[0]['ProfileID'],
                                                     "OrderByFranchisee"    => "0",
                                                     "InvoiceNumber"        => "",
                                                     "InvoiceID"            => "0"));
                   $mysql->insert("_tbl_orders_items",array("OrderID"       => $orderid,
                                                            "AddedOn"       => date("Y-m-d H:i:s"),
                                                            "ProfileID"     => $Profiles[0]['ProfileID'],
                                                            "ProfileCode"   => $Profiles[0]['ProfileCode'],
                                                            "ProfileName"   => $Profiles[0]['ProfileName'],
                                                            "ProductID"     => $plan[0]['PlanID'],
                                                            "ProductCode"   => $plan[0]['PlanCode'],
                                                            "ProductName"   => $plan[0]['PlanName'],
                                                            "ProfileToView" => $plan[0]['FreeProfiles'],
                                                            "Qty"           => "1",
                                                            "Amount"        => $plan[0]['Amount'],
                                                            "TAmount"       => "0",
                                                            "ServiceCharge" => "0",
                                                            "TsAmount"      => "0",
                                                            "Remarks"       => "0"));   
                $mysql->insert("_tbl_profile_credits",array("MemberID"      => $loginInfo[0]['MemberID'],
                                                            "ProfileID"     => $Profiles[0]['ProfileID'],
                                                            "ProfileCode"   => $Profiles[0]['ProfileCode'],
                                                            "Particulars"   => "0",
                                                            "Credits"       => $plan[0]['FreeProfiles'],
                                                            "CreditsOn"     => date("Y-m-d H:i:s"),
                                                            "Debits"        => "0",
                                                            "DebitsOn"      => date("Y-m-d H:i:s"),
                                                            "Available"     => $plan[0]['FreeProfiles']-"0",
                                                            "PartnerProfileID" => $Profiles[0]['ProfileID']));   

             return Response::returnSuccess("succss",array());
         }

         function updateProfilePhoto() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("update  `_tbl_members` set `FileName`='".$_POST['filename']."'  where `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",array());
         }

         function GetMyEmails() {
             global $mysql,$loginInfo;
             $MyEmails = $mysql->select("select * from `_tbl_logs_email` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",$MyEmails);
         }

         function GetKYC() {
             global $mysql,$loginInfo;    
             $KYCs = $mysql->select("select * from `_tbl_member_documents` where `MemberID`='".$loginInfo[0]['MemberID']."' order by `DocID` DESC ");
             $IDproof = $mysql->select("select * from `_tbl_member_documents` where `MemberID`='".$loginInfo[0]['MemberID']."' and DocumentType='Id Proof' order by DocID Desc");
             $Addressproof = $mysql->select("select * from `_tbl_member_documents` where `MemberID`='".$loginInfo[0]['MemberID']."' and DocumentType='Address Proof' order by DocID Desc");
             
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

         function UpdateKYC() {
             global $mysql,$loginInfo;
             $returnA = 0;
             $returnB = 0;
             $FileTypeA = CodeMaster::getData("IDPROOF",$_POST['IDType']); 

             if (isset($_POST['IDProofFileName']) && strlen($_POST['IDProofFileName'])>0) {

                 $id = $mysql->insert("_tbl_member_documents",array("MemberID"     => $loginInfo[0]['MemberID'],
                                                                    "DocumentType" => 'Id Proof',
                                                                    "FileName"     => $_POST['IDProofFileName'],
                                                                    "FileTypeCode" => $_POST['IDType'],
                                                                    "FileType"     => $FileTypeA[0]['CodeValue'],
                                                                    "SubmittedOn"  => date("Y-m-d H:i:s")));
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"        => $loginInfo[0]['MemberID'],
                                                                 "ActivityType"    => 'docidproof',
                                                                 "ActivityString"  => 'KYC Id proof has been submitted',
                                                                 "SqlQuery"        => '',
                                                                 "ActivityOn"      => date("Y-m-d H:i:s"))); 
                 $returnA = 1;
             }

             $FileTypeB = CodeMaster::getData("ADDRESSPROOF",$_POST['AddressProofType']);
             if (isset($_POST['AddressProofFileName']) && strlen($_POST['AddressProofFileName'])>0) {
                 $id = $mysql->insert("_tbl_member_documents",array("MemberID"     => $loginInfo[0]['MemberID'],
                                                                    "DocumentType" => 'Address Proof',
                                                                    "FileName"     => $_POST['AddressProofFileName'],
                                                                    "FiletypeCode" => $_POST['AddressProofType'],
                                                                    "FileType"     => $FileTypeB[0]['CodeValue'],
                                                                    "SubmittedOn"  => date("Y-m-d H:i:s"))); 
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"        => $loginInfo[0]['MemberID'],
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

         function UpdateNotification() {

             global $mysql,$loginInfo;
             $sqlQry = "update `_tbl_members` set `SMSNotification`='".(($_POST['Sms']=="on") ? '1' : '0')."',`EmailNotification`='".(($_POST['Email']=="on")? '1':'0')."' where `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($sqlQry);
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Yournotificationupdated.',
                                                             "ActivityString" => 'Your notification updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             $Member=$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             return Response::returnSuccess("Notifications are updated.",$Member[0]);
         }

         function UpdatePrivacy() {

             global $mysql,$loginInfo;
             $sqlQry="update `_tbl_members` set `PrivacyVerifiedMember`='".(($_POST['VerfiedMembers']=="on") ? '1' : '0')."',`PrivacyNonVerifiedMember`='".(($_POST['nonVerfiedMembers']=="on")? '1':'0')."' where `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($sqlQry);
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Yourprivacyupdated.',
                                                             "ActivityString" => 'Your privacy updated..',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             $Member=$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             return Response::returnSuccess("Privacy information updated.",$Member[0]);
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
                                                           `SubCaste`             = '".$_POST['SubCaste']."',
                                                           `CommunityCode`     = '".$_POST['Community']."',
                                                           `Community`         = '".$Community[0]['CodeValue']."',
                                                           `NationalityCode`   = '".$_POST['Nationality']."',
                                                           `Nationality`       = '".$Nationality[0]['CodeValue']."',
                                                           `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                           `AboutMe`           = '".$_POST['AboutMe']."'"; 
        if ($_POST['MaritalStatus'] == "MST004") {
            $updateSql .= " ,ChildrenCode ='".$_POST['HowManyChildren']."', Children='".$Childrens[0]['CodeValue']."',IsChildrenWithyou='".$_POST['ChildrenWithYou']."'";
        } 
        $updateSql .= " where  MemberID='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'";                 
        $ids = $mysql->execute($updateSql);
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Generalinformationupdated.',
                                                             "ActivityString" => 'General Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

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
             $FathersAlive     = CodeMaster::getData("PARENTSALIVE",$_POST['FathersAlive']);
             $MothersAlive     = CodeMaster::getData("PARENTSALIVE",$_POST['MothersAlive']);
             $MothersIncome     = CodeMaster::getData("INCOMERANGE",$_POST['MothersIncome']);
             $FathersIncome     = CodeMaster::getData("INCOMERANGE",$_POST['FathersIncome']);

             
             $updateSql = "update `_tbl_draft_profiles` set `FathersName`           = '".$_POST['FatherName']."',
                                                           `FathersOccupationCode` = '".$_POST['FathersOccupation']."',
                                                           `FathersOccupation`     = '".$FathersOccupation[0]['CodeValue']."',
                                                           `FathersContact`        = '".$_POST['FathersContact']."',
                                                           `FathersIncomeCode`         = '".$_POST['FathersIncome']."',
                                                           `FathersIncome`         = '".$FathersIncome[0]['CodeValue']."',
                                                           `FatherAliveCode`       = '".$_POST['FathersAlive']."',
                                                           `FathersAlive`           = '".$FathersAlive[0]['CodeValue']."',
                                                           `MothersName`           = '".$_POST['MotherName']."',
                                                           `MothersContact`        = '".$_POST['MotherContact']."',
                                                           `MothersIncomeCode`     = '".$_POST['MothersIncome']."',
                                                           `MothersIncome`         = '".$MothersIncome[0]['CodeValue']."',
                                                           `MothersAliveCode`       = '".$_POST['MothersAlive']."',
                                                           `MothersAlive`           = '".$MothersAlive[0]['CodeValue']."',
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
                                                           `LastUpdatedOn`         = '".date("Y-m-d H:i:s")."',
                                                           `MarriedSister`         = '".$marriedSister[0]['CodeValue']."' where  MemberID='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Familyinformationupdated.',
                                                             "ActivityString" => 'Family Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

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

             $updateSql = "update `_tbl_draft_profiles` set `PhysicallyImpairedCode`            = '".$_POST['PhysicallyImpaired']."',
                                                           `PhysicallyImpaired`                = '".$PhysicallyImpaired[0]['CodeValue']."',
                                                           `PhysicallyImpaireddescription`     = '".$_POST['PhysicallyImpairedDescription']."',
                                                           `VisuallyImpairedCode`              = '".$_POST['VisuallyImpaired']."',
                                                           `VisuallyImpaired`                  = '".$VisuallyImpaired[0]['CodeValue']."',
                                                           `VisuallyImpairedDescription`       = '".$_POST['VisuallyImpairedDescription']."',
                                                           `VissionImpairedCode`               = '".$_POST['VissionImpaired']."',
                                                           `VissionImpaired`                   = '".$VissionImpaired[0]['CodeValue']."',
                                                           `VissionImpairedDescription`        = '".$_POST['VissionImpairedDescription']."',
                                                           `SpeechImpairedCode`                = '".$_POST['SpeechImpaired']."',
                                                           `SpeechImpaired`                    = '".$SpeechImpaired[0]['CodeValue']."',
                                                           `SpeechImpairedDescription`         = '".$_POST['SpeechImpairedDescription']."',
                                                           `HeightCode`                        = '".$_POST['Height']."',
                                                           `Height`                            = '".$Height[0]['CodeValue']."',
                                                           `WeightCode`                        = '".$_POST['Weight']."',
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
                                                           `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                           `DrinkingHabit`          = '".$DrinkingHabit[0]['CodeValue']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Physicalinformationupdated.',
                                                             "ActivityString" => 'Physical Information Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

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

         function EditDraftCommunicationDetails() {

             global $mysql,$loginInfo;

             $Country = CodeMaster::getData("RegisterAllowedCountries",$_POST['Country']);
             $State   = CodeMaster::getData("STATNAMES",$_POST['StateName']);

             $updateSql = "update `_tbl_draft_profiles` set  `EmailID`        = '".$_POST['EmailID']."',
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
                                                            `Pincode`           = '".$_POST['Pincode']."',
                                                            `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                            `OtherLocation`  = '".$_POST['OtherLocation']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Communicationdetailsupdated.',
                                                             "ActivityString" => 'Communication Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

             return Response::returnSuccess("success",array("ProfileInfo" => $Profiles[0],
                                                            "CountryName" => CodeMaster::getData('CONTNAMES'),
                                                            "StateName"   => CodeMaster::getData('STATNAMES')));
         }

          function GetPartnersExpectaionInformation() {
             global $mysql,$loginInfo;
             $PartnersExpectation = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
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
             
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'"); 
             $check =  $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'");                      
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
                                                                            where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
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
                                                                   "MemberID"           => $loginInfo[0]['MemberID'],
                                                                   "ProfileID"           => $profile[0]['ProfileID'],
                                                                   "ProfileCode"         => $_POST['Code'])) ;
             }
            return Response::returnSuccess("success",array("MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "EmployedAs"              => CodeMaster::getData('OCCUPATIONS')));
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
                                                            `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                            `AnnualIncome`         = '".$IncomeRange[0]['CodeValue']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Occupationdetailsupdated.',
                                                             "ActivityString" => 'Occupation Details Updated.',                          
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

             return Response::returnSuccess("success",array("ProfileInfo"      => $Profiles[0],
                                                            "EmployedAs"       => CodeMaster::getData('OCCUPATIONS'),
                                                            "Occupation"       => CodeMaster::getData('Occupation'),
                                                            "TypeofOccupation" => CodeMaster::getData('TYPEOFOCCUPATIONS'),
                                                            "IncomeRange"      => CodeMaster::getData('INCOMERANGE')));
         }

         function AddEducationalDetails() {
             global $mysql,$loginInfo;
             
              if (!(strlen(trim($_POST['Educationdetails']))>0)) {                                                                               
                 return Response::returnError("Please select education details");
             }
             if (!(strlen(trim($_POST['EducationDegree']))>0)) {
                 return Response::returnError("Please select education degree ");
             }
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'");                         
             $id = $mysql->insert("_tbl_draft_profiles_education_details",array("EducationDetails" => $_POST['Educationdetails'],
                                                                  "EducationDegree"  => $_POST['EducationDegree'],
                                                                  "EducationRemarks"  => $_POST['EducationRemarks'],
                                                                  "ProfileID"        => $profile[0]['ProfileID'],
                                                                  "ProfileCode"        => $_POST['Code'],
                                                                  "MemberID"         => $loginInfo[0]['MemberID']));
             return (sizeof($id)>0) ? Response::returnSuccess("success",$_POST)
                                    : Response::returnError("Access denied. Please contact support");   
         }

         function AttachDocuments() {

             global $mysql,$loginInfo;       

             $photos = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             $profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");

             $DocumentType      = CodeMaster::getData("DOCTYPES",$_POST['Documents']) ;
             
             if (isset($_POST['File'])) {
             
             if(sizeof($photos)<2){
                     if ((strlen(trim($_POST['Documents']))==0 || $_POST['Documents']=="0" )) {
                return Response::returnError("Please select Document Type",$photos);
             }
             
             $data = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where  `DocumentTypeCode`='".$_POST['Documents']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             if (sizeof($data)>0) {
                return Response::returnError("Adharcard Already attached",$photos);
             }
             $data = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where  `AttachFileName`='".$_POST['File']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
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
                                                                    "MemberID"          => $loginInfo[0]['MemberID']));
                 } else { 
                     return Response::returnError("Only 2 photos allowed",$photos);
                 }
             }
             $photos = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             return Response::returnSuccess("success",$photos);
         }    

         function DeletDocumentAttachments() {

             global $mysql,$loginInfo;

             $mysql->execute("update `_tbl_draft_profiles_verificationdocs` set `IsDelete`='1' where `AttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");

                 return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected document has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         function DeletProfilePhoto() {

             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_draft_profiles_photos` set `IsDelete`='1' where `ProfilePhotoID`='".$_POST['ProfilePhotoID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
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
                                                            `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
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
                                                            `A16`            = '".$_POST['A16']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'HoroscopeDetailsUpdated.',
                                                             "ActivityString" => 'Horoscope Details Updated.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      
             return Response::returnSuccess("success",array("ProfileInfo" => $Profiles[0],
                                                            "StarName"    => CodeMaster::getData('STARNAMES'),
                                                            "RasiName"    => CodeMaster::getData('MONSIGNS'),
                                                            "Lakanam"     => CodeMaster::getData('LAKANAM')));
         }

         function AddProfilePhoto() {

             global $mysql,$loginInfo;   

                                     
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             $profile = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");

             if (isset($_POST['ProfilePhoto'])) {        
                 if(sizeof($photos)<5){
                     $mysql->insert("_tbl_draft_profiles_photos",array("MemberID"     => $loginInfo[0]['MemberID'],
                                                                "ProfileID"    => $profile[0]['ProfileID'],
                                                                "ProfileCode"    => $_POST['Code'],
                                                                "ProfilePhoto" => $_POST['ProfilePhoto'],
                                                                "UpdateOn"     => date("Y-m-d H:i:s")));
                 } else { 
                     return Response::returnError("Only 5 phots allowed",$photos);
                 }
             }
             $photos = $mysql->select("select * from `_tbl_draft_profiles_photos` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             return Response::returnSuccess("success",$photos);
         }

         function GetViewAttachments() {
             global $mysql,$loginInfo;    
             $SAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and  `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0'");
             
             return Response::returnSuccess("success"."select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0'",array("Attachments"     =>$SAttachments,
                                                            "EducationDetail" => CodeMaster::getData('EDUCATETITLES'),
                                                            "EducationDegree"  => CodeMaster::getData('EDUCATIONDEGREES')));
         }

         function GetBankNames() {
             global $mysql,$loginInfo;
             $BankNames = $mysql->select("select * from  `_tbl_settings_bankdetails` where `IsActive`='1'");                    
             return Response::returnSuccess("success",array("BankName" => $BankNames,
                                                            "Mode"     => CodeMaster::getData('MODE')));
         }

         function DeleteMember() {
             global $mysql,$loginInfo;
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteMember'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "DeleteMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Account has been Deleted.");  
             $mysql->execute("update `_tbl_members` set `IsDeleted`='1', `DeletedOn`='".date("Y-m-d H:i:s")."'  where  `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("successfully",array());
         }
         function SaveBankRequest() {

             global $mysql,$loginInfo;
             $BankNames = $mysql->select("select * from  `_tbl_settings_bankdetails` where BankID='".$_POST['BankName']."'"); 
             $TransferMode= CodeMaster::getData("MODE",$_POST['Mode']); 
             $id =  $mysql->insert("_tbl_wallet_bankrequests",array("RequestedOn" => date("Y-m-d H:i:s"),
                                                              "MemberID"          => $loginInfo[0]['MemberID'],
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
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array());
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function SavePayPalRequest() {

             global $mysql,$loginInfo;
             $PayPal = $mysql->select("select * from  `_tbl_settings_paypal` where `IsActive`='1'"); 
             $id =  $mysql->insert("_tbl_wallet_paypalrequests",array("TransactionOn" => date("Y-m-d H:i:s"),
                                                                      "MemberID"           => $loginInfo[0]['MemberID'],
                                                                      "PayPalCode"         => $PayPal[0]['PaypalCode'],        
                                                                      "PayPalName"         => $PayPal[0]['PaypalName'],      
                                                                      "PaypalAccountEmail" => $PayPal[0]['PaypalEmailID'],      
                                                                      "Amount"             => $_POST['Amount']));
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array("PaypalID" =>$id,"PaypalAccount" =>$PayPal[0]['PaypalEmailID']));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function GetListOfPreviousBankRequests() {
             global $mysql,$loginInfo;
             return Response::returnSuccess("success",$mysql->select("select * from  `_tbl_wallet_bankrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' order by `ReqID` DESC "));
         }
         function GetListOfPreviousPaypalRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_paypalrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' order by `PaypalID` DESC ");                    
             return Response::returnSuccess("success",$Paypal);
         }
         function GetViewPaypalRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_paypalrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' and `PaypalID`='".$_POST['Code']."'");                    
             return Response::returnSuccess("success",$Paypal[0]);
         }
         function GetViewBankRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_bankrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' and `ReqID`='".$_POST['Code']."'");                    
             return Response::returnSuccess("success",$Paypal[0]);
         }

         function IsPaypalTransferAllowed() {
             global $mysql,$loginInfo;
              $paypal = $mysql->select("select * from  `_tbl_settings_paypal` where `IsActive`='1'");   

             return Response::returnSuccess("success",array("IsAllowed"=>sizeof($paypal))); 
         }
         
          function GetMyActiveProfile() {
             global $mysql,$loginInfo;
              $profile= $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'") ;
              return $profile;
          }
         
          function RequestToDownload() {

             global $mysql,$loginInfo;
             
             $PProfileCode = $_GET['PProfileID'];
             
             $ActiveProfileID = $this->GetMyActiveProfile();
             
             if (sizeof($ActiveProfileID) > 0) {
                 
                 $memberdata = $mysql->select("select * from `_tbl_profile_credits` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileID` ='".$_POST['ProfileCode']."'");
             
             $BalanceCredits  = $mysql->select("select sum(Credits) as cr, Sum(Debits) as dr,  (sum(Credits) - Sum(Debits)) as bal from `_tbl_profile_credits` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileID` ='".$ActiveProfileID[0]['ProfileID']."'");
             
             if (isset($BalanceCredits) && $BalanceCredits[0]['bal']>0) {
             return '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">
                               <form method="post" id="frm_'.$PProfileCode.'" name="frm_'.$PProfileCode.'" action="" > 
                               <button type="button" class="close" data-dismiss="modal" style="margin-top: 0px;margin-right: 10px;">&times;</button>
                                <input type="hidden" value="'.$PProfileCode.'" name="PProfileCode">
                                <div align="center" style="padding-top: 33px;">
                                <table>
                                <tr>
                                    <td>Your Total Credits &nbsp;&nbsp;'.$BalanceCredits[0]['cr'].'</td>
                                </tr>
                                <tr>
                                    <td>Used Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$BalanceCredits[0]['dr'].'</td>
                                </tr>
                                <tr>
                                    <td>Balance Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$BalanceCredits[0]['bal'].'</td>
                                </tr>
                                </table>
                                <br>
                                <button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP(\''.$PProfileCode.'\')">Continue</button>&nbsp;
                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                                </div><br>
                            </form>
                        </div>'; 
             } else {
                   return '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">
                               <form method="post" id="frm_'.$PProfileCode.'" name="frm_'.$PProfileCode.'" action="" > 
                               <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -12px;">&times;</button>
                                <input type="hidden" value="'.$PProfileCode.'" name="PProfileCode">
                                <div style="text-align:center">Overall Profile&nbsp;:&nbsp;0<br><br>Viewed&nbsp;:&nbsp;0<br><br>Remaining&nbsp;:&nbsp;0<br><br> 
                                    <button type="button" class="btn btn-primary" name="Continue"  onclick="OverallSendOTP(\''.$PProfileCode.'\')">Upgrade</button>&nbsp;
                                    <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                                </div><br>
                            </form>
                        </div>'; 
             }
             } else {
                 return "select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"."you must create and publish your profile".'     <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>';
             }
             }
             
          function RequestToshowUpgrades() {

             global $mysql,$loginInfo;
             
              $ProfileID = $_GET['ProfileID'];
             $ActiveProfileID = $this->GetMyActiveProfile();
             
             if (sizeof($ActiveProfileID) > 0) {
                 
             
             $BalanceCredits  = $mysql->select("select sum(Credits) as cr, Sum(Debits) as dr,  (sum(Credits) - Sum(Debits)) as bal from `_tbl_profile_credits` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileID` ='".$ActiveProfileID[0]['ProfileID']."'");
             
             if (isset($BalanceCredits) && $BalanceCredits[0]['bal']>0) {
                       return '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">
                               <form method="post" id="frm_'.$ProfileID.'" name="frm_'.$ProfileID.'" action="" > 
                               <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;margin-right: 10px;">&times;</button>
                                <input type="hidden" value="'.$ProfileID.'" name="PProfileCode">
                                <div align="center" style="padding-top: 33px;">
                                <table>
                                <tr>
                                    <td>Your Total Credits &nbsp;&nbsp;'.$BalanceCredits[0]['cr'].'</td>
                                </tr>
                                <tr>
                                    <td>Used Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$BalanceCredits[0]['dr'].'</td>
                                </tr>
                                <tr>
                                    <td>Balance Credits &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$BalanceCredits[0]['bal'].'</td>
                                </tr>
                                </table>
                                <br>
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                                </div>
                                <br>
                            </form>
                        </div>';
             } else {
                        return '<div id="otpfrm" style="width:100%;padding:13px;height:100%;">
                               <form method="post" id="frm_'.$ProfileID.'" name="frm_'.$ProfileID.'" action="" > 
                               <button type="button" class="close" data-dismiss="modal" style="margin-top:0px;margin-right: 10px;">&times;</button>
                                <input type="hidden" value="'.$ProfileID.'" name="PProfileCode">
                                <div align="center" style="padding-top: 33px;">
                                 No credits found please upgrade<br><br> 
                                 <a href="'.AppPath.'/Matches/Search/ViewPlans/'.$ProfileID.'.htm" class="btn btn-primary">Continue</a>&nbsp;
                                <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                                </div><br>
                            </form>
                        </div>';
             }
             } else {
                 return "select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"."you must create and publish your profile".'     <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>';
             }
             }
          function ProfilePhotoBringToFront() {

             global $mysql,$loginInfo;
             
             $ProfilePhotoID = $_GET['ProfilePhotoID'];
             $ActiveProfileID = $this->GetMyActiveProfile();
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst`='0' where `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($updateSql);  
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst` = '1' where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
          }
          
          function GetDownloadProfileInformation() {
               
                global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['ProfileCode']."'"); 
             $visitorsDetails =$mysql->select("select * from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
               
               if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
                } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
                 }
               if($Profiles[0]['MemberID']>0 && $Profiles[0]['ProfileID']>0){            
               $id = $mysql->insert("_tbl_profiles_lastseen",array("MemberID"       => $Profiles[0]['MemberID'],
                                                                   "ProfileID"      => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"    => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"       => $visitorsDetails[0]['MemberID'],
                                                                   "VisterProfileID"      => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"    => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"       => date("Y-m-d H:i:s")));
               }
               $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "has viewd your profile",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
            
               $result =  Profiles::getDownloadProfileInformation($Profiles[0]['ProfileCode']);
               return Response::returnSuccess("success",$result);
           }
           
          /*fixed*/ 
           function GetFullProfileInformation() {
               
               global $mysql,$loginInfo;      
               $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['ProfileCode']."'"); 
               $member =$mysql->select("select * from `_tbl_members` where MemberID='".$loginInfo[0]['MemberID']."'"); 
               $visitorsDetails =$mysql->select("select * from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
               
               $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
               
               if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
                } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
                 }
                if($Profiles[0]['MemberID']>0 && $Profiles[0]['ProfileID']>0){                
              $id = $mysql->insert("_tbl_profiles_lastseen",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                  "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                  "ViewedOn"           => date("Y-m-d H:i:s")));
                }
              $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "has viewed your profile",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
            
               $result =  Profiles::getProfileInfo($_POST['ProfileCode'],2);
               return Response::returnSuccess("success",$result);                  
          }
          /*fixed*/
        
         function GetRecentlyViewedProfiles() {
          global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             //$myProfile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             //$RecentProfiles = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterMemberID` = '".$loginInfo[0]['MemberID']."' group by ProfileCode order by LastSeenID DESC ".$sql);
             $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterMemberID` = '".$loginInfo[0]['MemberID']."' order by LastSeenID DESC");
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['ProfileCode'], $profileCodes)))
                 {
                    $profileCodes[]=$RecentProfile['ProfileCode'];
                 }
             }
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) {  
                    $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         
          /*fixed*/
         function GetRecentlyWhoViewedProfiles() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             $myProfile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");
             //$RecentProfiles = $mysql->select("select * from `_tbl_profiles_lastseen` where `ProfileCode` = '".$myProfile[0]['ProfileCode']."' group by VisterProfileCode order by LastSeenID DESC ".$sql);
              $RecentProfiles = $mysql->select("select VisterProfileCode from `_tbl_profiles_lastseen` where `ProfileCode` = '".$myProfile[0]['ProfileCode']."'   order by LastSeenID DESC ");
              $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (trim(strlen($RecentProfile['VisterProfileCode']))>0) {
                     if (!(in_array($RecentProfile['VisterProfileCode'], $profileCodes)))
                     {
                        $profileCodes[]=$RecentProfile['VisterProfileCode'];     
                     }
                 }
             }

             if (sizeof($profileCodes)>0) {
                 for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) {  
                    $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,2);     
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         function AddToFavourite() {

             global $mysql,$loginInfo;
             
             $ProfileCode = $_GET['ProfileCode'];
             
             $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$ProfileCode."'"); 
               $member =$mysql->select("select * from `_tbl_members` where MemberID='".$loginInfo[0]['MemberID']."'"); 
               $visitorsDetails =$mysql->select("select * from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
               
                $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
               
               if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
                } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
                 }
               
                $isFavourite = $mysql->select("select * from `_tbl_profiles_favourites` where `IsHidden`='0' and ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."' order by FavProfileID desc limit 0,1");           
                 if (sizeof($isFavourite)==0)           {  
                     
               $id = $mysql->insert("_tbl_profiles_favourites",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
                    $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "Profile add to favourite",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
               return Response::returnSuccess($Profiles[0]['ProfileCode']." has been added to your favourites");                                               
                 } else {
                     $mysql->execute("update _tbl_profiles_favourites set IsHidden='1', HiddenOn='".date("Y-m-d H:i:s")."' where FavProfileID='".$isFavourite[0]['FavProfileID']."'");
                     $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $member[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "Profile removed favourite",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
                     return Response::returnSuccess($Profiles[0]['ProfileCode']." has been removed from your favourites");                                               
                 }
          }
          
          function GetFavouritedProfiles() {
              
          global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_favourites` where `IsHidden` ='0' and`VisterMemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC");
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['ProfileCode'], $profileCodes)))
                 {
                    $profileCodes[]=$RecentProfile['ProfileCode'];
                 }
             }
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                    if (strlen(trim($profileCodes[$i]))>0)  {
                        $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                    }
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         function GetWhoFavouriteMyProfiles() {
              
          global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             $RecentProfiles = $mysql->select("select VisterProfileCode from `_tbl_profiles_favourites` where `IsHidden` ='0' and`MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC");
             
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['VisterProfileCode'], $profileCodes)))
                  {
                      $profileCodes[]=$RecentProfile['VisterProfileCode'];
                 }                                                                           
             }
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                    if (strlen(trim($profileCodes[$i]))>0)  {
                        $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                    }
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         function ResendMobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {

             if ($loginid=="") {
                 $loginid = $_GET['LoginID'];
             }
             global $mysql;
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }
             
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
             
             $resend = $mysql->insert("_tbl_resend",array("MemberID" =>$memberdata[0]['MemberID'],
                                                          "Reason" =>"Resend Mobile Number Verfication Code",
                                                          "ResendOn"=>date("Y-m-d h:i:s"))) ;
             
             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
             } else {
                 if ($error=="") {
                     $otp=rand(1111,9999);
                     $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                  "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                  "SMSTo" =>$memberdata[0]['MobileNumber'],
                                                                                  "SecurityCode" =>$otp,
                                                                                  "Type" =>"Mobile Verification",
                                                                                  "messagedon"=>date("Y-m-d h:i:s"))) ; 
                     MobileSMSController::sendSMS($memberdata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                 }  else {
                     $securitycode = $reqID;
                 }
                 $formid = "frmMobileNoVerification_".rand(30,3000);
                 return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">                      
                         <form method="POST" id="'.$formid.'">
                         <input type="hidden" value="'.$_GET['callfrom'].'" name="callfrom">     
                         <input type="hidden" value="'.$loginid.'" name="loginId">
                         <input type="hidden" value="'.$securitycode.'" name="reqId">                          
                            <div class="form-group">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            '.(($updatemsg!="") ? $updatemsg : "").'
                                    <h4 style="text-align:center;color:#6c6969;">Please verify your mobile number</h4>
                            </div> 
                            <div style="text-align:left"> Dear '.$memberdata[0]['MemberName'].',<br>
                                <h5 style="color: #777;line-height:20px;font-weight: 100;">Please enter the verification code which you have received on your mobile number ending with  +'.$memberdata[0]['CountryCode'].'&nbsp;'.J2JApplication::hideMobileNumberWithCharacters($memberdata[0]['MobileNumber']).'</h5>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>                                                              
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>';
             }
         }
         function ResendEmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {

             if ($loginid=="") {                     
                $loginid = $_GET['LoginID'];
             }

             global $mysql;
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");

             if (sizeof($login)==0) {
                 return "Invalid request. Please login again.";
             }
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");
             $resend = $mysql->insert("_tbl_resend",array("MemberID" =>$memberdata[0]['MemberID'],
                                                          "Reason" =>"Resend Email ID Verfication Code",
                                                          "ResendOn"=>date("Y-m-d h:i:s"))) ;

             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified. </h5>
                            <h5 style="text-align:center;"><a  href="javascript:void(0)" onclick="EmailVerificationForm()">Continue</a>
                       </div>';    
             } else {

                 if ($error=="") {
                     $otp=rand(1111,9999);

                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberEmailVerification'");
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
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$memberdata[0]['MemberID'],
                                                                                     "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" =>$memberdata[0]['EmailID'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" =>"EmailVerification",
                                                                                     "messagedon"=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
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
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
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
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }

                 }  else {
                    $securitycode = $reqID;

                    $formid = "frmMobileNoVerification_".rand(30,3000);
                 $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="form-group">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#ada9a9">Please verify your email</h4>
                                </div>
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/emailicon.png" width="10%"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
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
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer">&nbsp;Resend</a><h5> 
                        </form>                                                                                                       
                        </div>'; 
                }
            }                                                                                     
         }
         function GetLandingPageProfiles() {
             
             global $mysql;
             $Profiles = array();
             $landingpageProfiles = $mysql->select("select * from `_tbl_landingpage_profiles` where Date(`DateTo`)>=Date('".date("Y-m-d")."') and `IsShow`='1'"); 
             foreach($landingpageProfiles as $profile) {
                $Profiles[] =Profiles::getProfileInfo($profile['ProfileCode'],2);
             }
             
                 return Response::returnSuccess("success".$Profiles,$Profiles);                                               
                 }
         
         function GetLandingpageProfileInfo() {
               
               global $mysql,$loginInfo;      
               $Profiles = $mysql->select("select * from `_tbl_landingpage_profiles` where Date(DateTo)>=Date('".date("Y-m-d")."') and `IsShow`='1' and ProfileCode='".$_POST['ProfileCode']."'"); 
            
                $tmp = Profiles::getProfileInfo($_POST['ProfileCode'],2);
                 $tmp['DateTo']=$Profiles[0]['DateTo'];
                 $tmp['DateFrom']=$Profiles[0]['DateFrom'];
                 $tmp['ShowCommunicationDetails']=$Profiles[0]['ShowCommunicationDetails'];
                 $tmp['ShowHoroscopeDetails']=$Profiles[0]['ShowHoroscopeDetails'];
                 $Profiles =$tmp;
            
               return Response::returnSuccess("success",$Profiles);
            
                    
          }
         
         function GetLatestUpdates() {
             
             global $mysql,$loginInfo;
             $Latestupdates = $mysql->select("select * from `_tbl_latest_updates` where MemberID='".$loginInfo[0]['MemberID']."' and IsHide='0' ORDER BY LatestID DESC LIMIT 0,5"); 
                 return Response::returnSuccess("success",$Latestupdates);                                               
     } 
       function ResendSendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {

        global $mysql,$mail,$loginInfo;      
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
           $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileID`='".$_POST['ProfileID']."'");   

           $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");  
           
             $resend = $mysql->insert("_tbl_resend",array("MemberID" =>$member[0]['MemberID'],
                                                          "Reason" =>"Resend Profile Publish Verfication Code",
                                                          "ResendOn"=>date("Y-m-d h:i:s"))) ;

            
        if ($reqID=="")      {
             $otp=rand(1000,9999);

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishProfile'");
             $content  = str_replace("#ProfileName#",$data[0]['ProfileName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RequestToVerifyPublishProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                                                                                                                          
            if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";                                                               
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" =>$member[0]['MemberID'],
                                                                                     "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" =>$member[0]['EmailID'],
                                                                                     "SMSTo" =>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type" =>"RequestToVerifyPublishProfile",
                                                                                     "messagedon"=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
                                   <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                   <h4 class="modal-title">Profile Publish</h4> <br>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$error.'</div>
                                </div>
                            </div>                                                                      
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
                          }
        } else {
            $formid = "frmPuplishOTPVerification_".rand(30,3000);
                 return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                            <input type="hidden" value="'.$reqID.'" name="reqId">
                              <input type="hidden" value="'.$ProfileID.'" name="ProfileID">
                                <div class="input-group">
                                    <button type="button" class="close" data-dismiss="modal" style="margin-top: -20px;margin-right: -20px;">&times;</button>
                                    <h4 style="text-align:center;color:#6c6969;">OTP</h4>
                                </div>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br></h5><h4 style="text-align:center;color:#ada9a9">'.$member[0]['EmailID'].'<br>&amp;<br>'.$member[0]['MobileNumber'].'</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-7"><input type="text"  class="form-control" value="'.$otpdata.'" id="PublishOtp" maxlength="4" name="PublishOtp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-5"><button type="button" onclick="ProfilePublishOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                    </div>
                                    <div class="col-sm-12">'.$errormessage.'</div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
                        </form>                                                                                                       
                        </div>
                        '; 
        }

         }
         function HideLatestUpdates() {

             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_latest_updates` set `IsHide`='1' where `LatestID`='".$_POST['LatestID']."' and `MemberID`='".$loginInfo[0]['MemberID']."'");
                       return  "update `_tbl_latest_updates` set `IsHide`='1' where `LatestID`='".$_POST['LatestID']."' and `MemberID`='".$loginInfo[0]['MemberID']."'".'<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your Updates  has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         function GetAllLatestUpdates() {
             
             global $mysql,$loginInfo;
             $Latestupdates = $mysql->select("select * from `_tbl_latest_updates` where MemberID='".$loginInfo[0]['MemberID']."' ORDER BY LatestID DESC"); 
                 return Response::returnSuccess("success",$Latestupdates);                                               
     }
     function GetSearchResultProfiles() {
                global $mysql,$loginInfo;
             
             $result = array();
             
             $myprofile = $mysql->select("select * from _tbl_profiles");
             if (sizeof($myprofile)==0) {
                return Response::returnSuccess("success",$result); 
             }
             
             $sexcode="";
             if ($myprofile[0]['SexCode']=="SX001") {
                $sexcode="SX002";  
             }
             
             if ($myprofile[0]['SexCode']=="SX002") {
                $sexcode="SX001";  
             }
             
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".$sexcode."'");
             
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         } 
     
     
     }  
   
?>                                                            
  