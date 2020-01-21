<?php
     class Member {

         
         public function Login() {

             global $mysql,$loginInfo,$j2japplication;

             if (!(strlen(trim($_POST['UserName']))>0)) {
                 return Response::returnError("Please enter member id / registered email");
             }

             if (!(strlen(trim($_POST['Password']))>0)) {
                 return Response::returnError("Please enter password ");
             }

             $data=$mysql->select("select * from `_tbl_members` where (`EmailID`='".$_POST['UserName']."' or `MobileNumber`='".$_POST['UserName']."' or `MemberCode`='".$_POST['UserName']."')");
             $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
             $loginid = $mysql->insert("_tbl_logs_logins",array("LoginOn"       => date("Y-m-d H:i:s"),
                                                                "LoginFrom"     => "Web",
                                                                "Device"        => $clientinfo['Device'],
                                                                "MemberID"      => $data[0]['MemberID'],
                                                                "MemberCode"    => $data[0]['MemberCode'],
                                                                "LoginName"     => $_POST['UserName'],
                                                                "BrowserIP"     => $clientinfo['query'],
                                                                "CountryName"   => $clientinfo['country'],
                                                                "BrowserName"   => $clientinfo['UserAgent'],
                                                                "APIResponse"   => json_encode($clientinfo),
                                                                "LoginPassword" => $_POST['Password']));
             if (sizeof($data)==1) { /* Single Information */
             
                 $settings = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='APPSETTINGS' and `CodeValue`='AllowToPasswordCaseSensitive'");
                 if($data[0]['IsActive']==0){
                      return Response::returnError("Account deactivated.Please contact administrator");
                 }
                 if($data[0]['IsDeleted']==1){
                      return Response::returnError("Please contact administrator");
                 }
                 if($settings[0]['ParamA']=="1"){
                     if(md5($data[0]['MemberPassword'])!=md5($_POST['Password'])) {              
                        return Response::returnError("Invalid login details ");
                     }
                 } else {
                     if ($data[0]['MemberPassword']!=$_POST['Password']) {              
                        return Response::returnError("Invalid login details");
                     }
                 }
                     
                 $mysql->execute("update `_tbl_logs_logins` set `LoginStatus`='1' where `LoginID`='".$loginid."'");
                 
                 if ($data[0]['IsActive']==0) {
                    return Response::returnError("Access denied. Please contact support");   
                 }

                 if($data[0]['WelcomeMsg']==0) {
                    $d=$mysql->select("Select * From `_tbl_welcome_message` where `IsActive`='1' and `UserRole`='Member'");
                    $data[0]['WelcomeMessage']=$d[0]['Message'];  
                 }
                 
                 $data[0]['LoginID']=$loginid;
                 
                 $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where    `IsDelete`='0' and `MemberID`='".$data[0]['MemberID']."' and `PriorityFirst`='1'");
                 $data[0]['FileName']=(sizeof($ProfileThumb)==0) ? "" : getDataURI($ProfileThumb[0]['ProfilePhoto']);
                 
                 return Response::returnSuccess("success",$data[0]);

             } elseif (sizeof($data)>1) { /* Same email more than one member */
                 
                 $data=$mysql->select("select * from `_tbl_members` where MemberPassword='".$_POST['Password']."' and (`MemberLogin`='".$_POST['UserName']."' or `EmailID`='".$_POST['UserName']."' or `MobileNumber`='".$_POST['UserName']."' or `MemberCode`='".$_POST['UserName']."')");
                  if($data[0]['IsActive']==0){
                      return Response::returnError("Account deactivated.Please contact administrator");
                 }
                 if($data[0]['IsDeleted']==1){
                      return Response::returnError("Please contact administrator");
                 }
                 if (sizeof($data)==0) {
                     return Response::returnError("Invalid login details"); 
                 } 
                 
                 if (sizeof($data)>1) {
                    return Response::returnError("Error occured login into your account, please contact support team");
                 }
                 
                 $mysql->execute("update `_tbl_logs_logins` set `LoginStatus`='1' where `LoginID`='".$loginid."'");
                 
                 if ($data[0]['IsActive']==0) {
                     return Response::returnError("Access denied. Please contact support");   
                 }
                     
                 if($data[0]['WelcomeMsg']==0) {
                    $d=$mysql->select("Select * From `_tbl_welcome_message` where `IsActive`='1' and `UserRole`='Member'");
                    $data[0]['WelcomeMessage']=$d[0]['Message'];  
                 }
                 
                 $data[0]['LoginID']=$loginid;
                 $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where    `IsDelete`='0' and `MemberID`='".$data[0]['MemberID']."' and `PriorityFirst`='1'");
                 $data[0]['FileName']=(sizeof($ProfileThumb)==0) ? "" : getDataURI($ProfileThumb[0]['ProfilePhoto']);
                 $data[0]['LoginOn'] = $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$data[0]['MemberID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
                 return Response::returnSuccess("success",$data[0]);
                
             } else {
                return Response::returnError("Invalid login details");
             }
         }

         public function Logout() {
             
             global $mysql, $loginInfo;
             $temp = $mysql->select("select * from `_tbl_logs_logins` where `LoginID`='".$loginInfo[0]['LoginID']."'");
             if (sizeof($temp)>0) {
                $mysql->execute("update `_tbl_logs_logins` set `UserLogout`='".date("Y-m-d H:i:s")."' where `LoginID`='".$loginInfo[0]['LoginID']."'") ;
                return Response::returnSuccess("Logged out successfully",array());     
             } else {
                return Response::returnError("Invalid logout request");  
             }
         }

         public function GetLoginHistory() {
             
             global $mysql,$loginInfo;
             
             $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `MemberID`='".$loginInfo[0]['MemberID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
             $IsDisplayLoginHistory = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE  `HardCode`='APPSETTINGS' and `CodeValue`='DisplayLastLoginInDashboard'");
             $Member = number_format($this->getAvailableBalance($loginInfo[0]['MemberID']),2);
             return Response::returnSuccess("success",array("LoginHistory" => $LoginHistory,"WalletBalance" => $Member,"IsDisplayLastLogin" => $IsDisplayLoginHistory[0]));
         }

         public function GetNotificationHistory() {
             global $mysql,$loginInfo;
             $NotificationHistory = $mysql->select("select * from `_tbl_logs_activity` where `MemberID`='".$loginInfo[0]['MemberID']."' ORDER BY `ActivityID` DESC LIMIT 0,5");
             return Response::returnSuccess("success",$NotificationHistory);
         }

         public function Register() {

             global $mysql;
				
             if (!(strlen(trim($_POST['Name']))>0)) {
                return Response::returnError("Please enter your name");
             }
			 
			 if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter mobile number");
             }

             if (!(strlen(trim($_POST['Email']))>0)) {
                return Response::returnError("Please enter your email");
             }

			if (!(strlen(trim($_POST['LoginPassword']))>0)) {
                return Response::returnError("Please enter password");
             }

             $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateMobile'");
            
             if ($allowDuplicateMobile[0]['ParamA']==0) {
                 $data = $mysql->select("select * from `_tbl_members` where  `MobileNumber`='".$_POST['MobileNumber']."'");
                 if (sizeof($data)>0) {
                     return Response::returnError("Mobile Number Already Exists");
                 }
             }
 
             $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateEmail'");
             
             if ($allowDuplicateEmail[0]['ParamA']==0) {
                 $data = $mysql->select("select * from `_tbl_members` where  `EmailID`='".$_POST['Email']."'");
                 if (sizeof($data)>0) {
                    return Response::returnError("Email Already Exists");
                 }
             }
             
             $MemberCode=SeqMaster::GetNextMemberNumber();
			 $Sex = CodeMaster::getData("SEX",$_POST['Gender']);
             $id = $mysql->insert("_tbl_members",array("MemberName"     => $_POST['Name'],
                                                       "MemberCode"     => $MemberCode,
                                                       "SexCode"        => $_POST['Gender'],
													   "Sex"            => $Sex[0]['CodeValue'],
                                                       "MobileNumber"   => $_POST['MobileNumber'],
                                                       "EmailID"        => $_POST['Email'],
                                                       "MemberPassword" => $_POST['LoginPassword'],
                                                       "CountryCode"    => $_POST['CountryCode'],
                                                       "ReferedBy"      => 1,
                                                       "CreatedBy"      => "Member",
                                                       "CreatedOn"      => date("Y-m-d H:i:s"))); 
			
					if (!is_dir('uploads/members/'.$MemberCode)) {
                        mkdir('uploads/members/'.$MemberCode, 0777, true);
                    }
                    
                    if (!is_dir('uploads/members/'.$MemberCode."/kyc")) {
                        mkdir('uploads/members/'.$MemberCode."/kyc", 0777, true);
                    }
                   
             $data = $mysql->select("select * from `_tbl_members` where `MemberID`='".$id."'");
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='NewMemberCreated'");
             $content  = str_replace("#MemberName#",$_POST['Name'],$mContent[0]['Content']);
             $content  = str_replace("#MemberID#",$MemberCode,$content);
             $content  = str_replace("#LoginPassword#",$_POST['LoginPassword'],$content);

             MailController::Send(array("MailTo"   => $_POST['Email'],
                                        "Category" => "NewMemberCreated",
                                        "MemberID" => $id,
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
			MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['Name'].",Member Created.Your Member ID is ".$MemberCode." and Member Password is ".$_POST['LoginPassword']." " );  

             $data[0]['LoginID']=$loginid; 
             $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Member'");      
             return Response::returnSuccess("Registered successfully",$data[0]);
         }

         public function forgotPassword() {

             global $mysql,$mail;            

             if (Validation::isEmail($_POST['FpUserName'])) {
                $data = $mysql->select("Select * from `_tbl_members` where `EmailID`='".$_POST['FpUserName']."'");
                if (sizeof($data)==0){
                    return Response::returnError("Account not found");
                }
             } else {
                $data = $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$_POST['FpUserName']."'");    
                if (sizeof($data)==0){
                    return Response::returnError("Account not found");
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

         public function forgotPasswordOTPvalidation() {

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

         public function forgotPasswordchangePassword() {

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
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

             return Response::returnSuccess("New Password saved successfully",$data[0]);  
         }

         public function getAvailableBalance($memberID) {
             global $mysql;
             $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where MemberID='".$memberID."'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
         }

         public function GetMemberInfo() {
             global $mysql,$loginInfo;
             $Member=$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             $Profile=$mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             $Member[0]['Country'] = CodeMaster::getData('RegisterAllowedCountries');
             $Member[0]['WalletBalance'] = number_format($this->getAvailableBalance($loginInfo[0]['MemberID']),2);
             return Response::returnSuccess("success",$Member[0],array("Profile"=>$Profile[0]));
         }    

         public function EditMemberInfo() {

             global $mysql,$loginInfo;

             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");

             $sqlQry = " update `_tbl_members` set `MemberName`='".$_POST['MemberName']."'   ";

             if($Member[0]['IsMobileVerified']==0) {
                 $sqlQry .= ", MobileNumber='".$_POST['MobileNumber']."' " ;
             $allowDuplicateMobile = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateMobile'");
                if ($allowDuplicateMobile[0]['ParamA']==0) {
                 $data = $mysql->select("select * from `_tbl_members` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and MemberID <>'".$loginInfo[0]['MemberID']."'");
                     if (sizeof($data)>0) {
                        return Response::returnError("Mobile Number Already Exists");    
                     }
                 }
             } 
             if($Member[0]['IsEmailVerified']==0) {
                 $sqlQry .= ", `EmailID`='".$_POST['EmailID']."', `CountryCode`='".$_POST['CountryCode']."' " ;
                 $allowDuplicateEmail = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateEmail'");
                 if ($allowDuplicateEmail[0]['ParamA']==0) {
                    $data = $mysql->select("select * from  `_tbl_members` where `EmailID`='".trim($_POST['EmailID'])."' and `MemberID` <>'".$loginInfo[0]['MemberID']."'");
                    if (sizeof($data)>0) {
                        return Response::returnError("EmailID Already Exists");    
                    }
                 }
             }

             $sqlQry .= " where  `MemberID`='".$Member[0]['MemberID']."'" ;  
             $mysql->execute($sqlQry)  ;
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Yourmemberinformationupdated.',
                                                             "ActivityString" => 'Your member information updated.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             "ActivityOn"     => date("Y-m-d H:i:s"))); 
             return Response::returnSuccess("success",array());
         }

         public function WelcomeMessage() {
             global $mysql,$loginInfo;
             $welcome=$mysql->execute("update `_tbl_members` set `WelcomeMsg`='1' where  `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("New Password saved successfully",array());
         }

         public function GetCodeMasterDatas() {
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

         public function CreateProfile() {
             
             global $mysql,$loginInfo;

             if ((strlen(trim($_POST['ProfileFor']))==0 || $_POST['ProfileFor']=="0" )) {
                return Response::returnError("Please select ProfileFor",array("param"=>"ProfileFor"));
             }
             
             if (!(strlen(trim($_POST['ProfileName']))>0)) {
                return Response::returnError("Please enter your name",array("param"=>"ProfileName"));
             }
             
             $member= $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             
             if($_POST['ProfileFor']=="PSF001" || $_POST['ProfileFor']=="PSF003" || $_POST['ProfileFor']=="PSF005" || $_POST['ProfileFor']=="PSF006") {
                 $SexCode = "SX001";
			 }
			 
             if($_POST['ProfileFor']=="PSF002" || $_POST['ProfileFor']=="PSF007" || $_POST['ProfileFor']=="PSF008" || $_POST['ProfileFor']=="PSF009") {
                 $SexCode = "SX002";
			 }
             
             if($_POST['ProfileFor']=="PSF004"){
                $SexCode = ($member[0]['Sex']=="Male") ? "SX001" : "SX002";
			 }
			 
             $ProfileFors   = CodeMaster::getData("PROFILESIGNIN",$_POST["ProfileFor"]);
             $Sex           = CodeMaster::getData("SEX",$SexCode); 
             $ProfileCode   = SeqMaster::GetNextDraftProfileCode();
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
			 
             $id =  $mysql->insert("_tbl_draft_profiles",array("ProfileCode"       => $ProfileCode,
                                                               "ProfileForCode"    => $ProfileFors[0]['SoftCode'],
                                                               "ProfileFor"        => $ProfileFors[0]['CodeValue'],
                                                               "ProfileName"       => trim($_POST['ProfileName']),
                                                               "DateofBirth"       => $dob,        
                                                               "SexCode"           => $Sex[0]['SoftCode'],      
                                                               "Sex"               => $Sex[0]['CodeValue'],      
                                                               "CreatedOn"         => date("Y-m-d H:i:s"),        
                                                               "MemberID"          => $loginInfo[0]['MemberID'],
                                                               "MemberCode"        => $member[0]['MemberCode'],
                                                               "CreatedByMemberID" => $loginInfo[0]['MemberID']));
             if (sizeof($id)>0) {
                 $mysql->execute("update `_tbl_sequence` set LastNumber=LastNumber+1 where `SequenceFor`='DraftProfile'");
                 return Response::returnSuccess("Profile Created",array("Code"=>$ProfileCode));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }

         public function MemberChangePassword(){

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

         public function GetAdvancedSearchElements() {
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

         public function GetBasicSearchElements() {
             return Response::returnSuccess("success",array("MaritalStatus" => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Religion"      => CodeMaster::getData('RELINAMES'),
                                                            "Caste"      => CodeMaster::getData('CASTNAMES'),
                                                            ));
         }

         public function CheckVerification() {

             global $mysql,$loginInfo;
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
           
		   if ($memberdata[0]['ChangePasswordFstLogin']==1) {
				return $this->ChangePasswordScreen("",$loginInfo[0]["MemberID"],"","");
             }
			 
			 if ($memberdata[0]['IsMobileVerified']==0) {
				return $this->ChangeMobileNumberFromVerificationScreen("",$loginInfo[0]["MemberID"],"","");
             }
             
			 if ($memberdata[0]['IsEmailVerified']==0) {
				return $this->ChangeEmailFromVerificationScreen("",$loginInfo[0]["MemberID"],"","");
             }
			 return true;
            // return "<script>location.href='".AppPath."MyProfiles/CreateProfile';</script>";
         }

		 function ChangePasswordScreen($error="",$loginid="",$npswd="",$cnpswd="",$reqID="") {
           
		   global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
            if ($memberdata[0]['ChangePasswordFstLogin']==0) {
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
											<span style="text-left:center;color:#ada9a9">The administartor requests to change your login password on your first signin.</span><br><br>
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
            $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
			if (isset($_POST['NewPassword'])) {
				if (strlen(trim($_POST['NewPassword']))<6) {
                   return $this->ChangePasswordScreen("Invalid new password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['reqId']);
                }
				if (strlen(trim($_POST['NewPassword']))!= strlen(trim($_POST['ConfirmNewPassword']))) {
                   return $this->ChangePasswordScreen("Do not match password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['ConfirmNewPassword'],$_POST['reqId']);
                }
               
                $update = "update _tbl_members set MemberPassword='".$_POST['NewPassword']."' ,ChangePasswordFstLogin='0' where MemberID='".$loginInfo[0]['MemberID']."'";
                $mysql->execute($update);
				
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangePassword'");
					$content  = str_replace("#MemberName#",$memberdata[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#MemberPassword#",$_POST['NewPassword'],$content);

					 MailController::Send(array("MailTo"         => $memberdata[0]['EmailID'],
												"Category"       => "MemberChangePassword",
												"MemberCode" 	 => $memberdata[0]['MemberCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($memberdata[0]['MobileNumber']," Dear ".$memberdata[0]['MemberName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['NewPassword']."");  
                
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your new password has been<br> saved successfully.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';   
            }
                                                                                                                                    
			}

         public function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {

             global $mysql,$loginInfo;
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             
             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div class="modal-header">
                            <h4 class="modal-title">Mobile Number Verification</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                                <p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">In order to protect your account, we will send a verification code for verification that you will need to enter the next screen.</p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">+'.$memberdata[0]['CountryCode'].'&nbsp;'.$memberdata[0]['MobileNumber'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumber()">Change</h4>
                            </div>
                            <div class="modal-footer">
								<a href="javascript:void(0)" onclick="Signout()">Sign out</a>&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary">Continue to verify</a>&nbsp;&nbsp;
                            </div>
                        </div>';
             }
         } 
                        
         public function ChangeMobileNumber($error="",$loginid="",$scode="",$reqID="") {
             
             global $mysql,$loginInfo;                                                                                                               
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");

             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div class="modal-header">
                            <h4 class="modal-title">Mobile Number Verification</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                $formid = "frmChangeMobileNo_".rand(30,3000);
                
                $countrycode=CodeMaster::getData('RegisterAllowedCountries');
                                                                                                          
                $return = '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Mobile Number</h4>
                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                                </div>
                                <div class="modal-body" style="max-height:400px;min-height:400px;">
                                    <p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
									<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;"><b>Caution!</b> You are going to change your primary Mobile Number. All further communication from us ill be delivered on this new Number.</p>
									<div class="form-group row" style="margin-bottom:0px">
										<div class="col-sm-2"></div>
										<label class="col-sm-10" style="color:#ada9a9;font-size: 14px;">Mobile Number</label>
									 </div>
									<div class="form-group row">
										<div class="col-sm-2"></div>
										<div class="col-sm-4" style="margin-right:-15px">
                                        <select class="selectpicker form-control" data-live-search="true" name="CountryCode" id="CountryCode" style="padding-top: 4px;padding-bottom: 4px;text-align: center;font-family: Roboto;height: 34px;"> ';
                                             foreach($countrycode as $CountryCode) {  
                                                $return .=' <option value="'.$CountryCode['ParamA'].'"  '.(($_POST[ 'CountryCode']==$CountryCode[ 'ParamA']) ? " selected='selected' " : "").' >'.$CountryCode['str'].'</option>';
                                             }
                                        $return .=   '</select>
                                        </div>
                                        <div class="col-sm-4">                                                                                                                                                                                          
                                            <input type="text" class="form-control" value="'.$scode.'" id="new_mobile_number"  name="new_mobile_number"  maxlength="10" style="font-family:Roboto;"></div>
                                        </div>
                                        <div class="col-sm-12" id="errormsg">'.$error.'</div>
									</div>
                                </div>
								 <div class="modal-footer">
									<a href="javascript:void(0)" onclick="CheckVerification()">back</a>&nbsp;&nbsp;
									<a href="javascript:void(0)" onclick="MobileNumberVerificationForm(\''.$formid.'\')" class="btn btn-primary" style="font-family:roboto">Save and verify</a>
									
								 </div>
                            </form>                                                                                                       
                        </div>';  
                        return $return;
                }
         } 
             
         public function MobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {

             global $mysql,$loginInfo;
             $updatemsg = "";
             
             if (isset($_POST['new_mobile_number'])) {
                 
                 if (strlen(trim($_POST['new_mobile_number']))==0) {
                     return $this->ChangeMobileNumber("<span style='color:red';>Please enter mobile number</span>.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 if (!($_POST['new_mobile_number']>6000000000 && $_POST['new_mobile_number']<9999999999)) {
                     return $this->ChangeMobileNumber("<span style='color:red';>Invalid mobile number</span>.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 if (strlen(trim($_POST['new_mobile_number']))!=10) {
                     return $this->ChangeMobileNumber("Invalid Mobile Number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 

                 $duplicate = $mysql->select("select * from `_tbl_members` where `MobileNumber`='".$_POST['new_mobile_number']."' and MemberID <>'".$loginInfo[0]['MemberID']."'");
                 if (sizeof($duplicate)>0) {
                     return $this->ChangeMobileNumber("<span style='color:red';>Mobile Number already in use</span>.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                 }
                 $sql="update `_tbl_members` set `MobileNumber`='".$_POST['new_mobile_number']."' , `CountryCode`='".$_POST['CountryCode']."' where `MemberID`='".$loginInfo[0]['MemberID']."'" ;
                 $mysql->execute($sql);
                 
                 $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
                 
                 $mContent = $mysql->select("select * from `mailcontent` where `Category`='MobileNumberChanged'");
                 $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],                        
                                        "Category" => "MobileNumberChanged",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Mobile Number has been changed.");  
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'MonileNumberChanged.',
                                                             "ActivityString" => 'Mobile Number Changed.',
                                                             "SqlQuery"       => base64_encode($sql),            
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 $updatemsg = "<div class='successmessage'>Your new mobile number has been updated.</div>";
             }
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             if ($memberdata[0]['IsMobileVerified']==1) {
                 return '<div class="modal-header">
                            <h4 class="modal-title">Mobile Number Verification</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                 return '<div id="otpfrm">
                            <form method="POST" id="'.$formid.'">
                            <input type="hidden" value="'.$_GET['callfrom'].'" name="callfrom">     
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">    
                            <div class="modal-header">                                                             
                                <h4 class="modal-title">Please verify your mobile number</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body">
                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                <p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">Please enter the verification code which you have received on your mobile number ending with  +'.$memberdata[0]['CountryCode'].'&nbsp;'.J2JApplication::hideMobileNumberWithCharacters($memberdata[0]['MobileNumber']).'</p>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="col-sm-12"> 
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                        <div class="col-sm-2"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmMobileNoVerification_error" >'.$error.'&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                            </form>                                                                                                       
                           </div>'; 
             }
         }
            
         public function MobileNumberOTPVerification() {

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
                  return '<div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';
                 
                 } else {
                     return $this->MobileNumberVerificationForm("<span style='color:red'>Invalid verification code.</span>",$_POST['loginId'],$_POST['mobile_otp_2'],$_POST['reqId']);
                 }
         }

         public function ChangeEmailFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
             
             global $mysql,$loginInfo;
             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
             } else {
                 $formid = "frmChangeEmail_".rand(30,3000);
                 return '<div id="otpfrm" >
                            <input type="hidden" value="'.$loginid.'" name="loginId">
                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="modal-header">
                                <h4 class="modal-title">Please verify your email</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                            <div class="modal-body" style="max-height:400px;min-height:400px;">
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
								<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">In order to protect your account, we will send a verification code for verification that you will need to enter the next screen.</p>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'&nbsp;&#65372&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" onclick="EmailVerificationForm()" class="btn btn-primary" >Continue to verify</a>&nbsp;&nbsp;
                            </div>
                        </div>'; 
                 
             }                  
         }

         public function ChangeEmailID($error="",$loginid="",$scode="",$reqID="") {

             global $mysql,$loginInfo;

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");

             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                                <div class="modal-body"style="max-height:400px;min-height:400px;">
                                    <p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
									<p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;"><b>Caution!</b> You are going to change your primary Email ID. All further communication from us ill be delivered on this new Email ID.</p>
									<div class="form-group row" style="margin-bottom:0px">
										<div class="col-sm-2"></div>
										<label class="col-sm-10" style="color:#ada9a9;font-size: 14px;">Email ID</label>
									 </div>
									<div class="form-group row">
										<div class="col-sm-2"></div>
										<div class="col-sm-8"><input type="text" value="'.$scode.'" id="new_email" name="new_email" class="form-control" style="font-family:Roboto;"></div>
                                    <div class="col-sm-12" id="errormsg">'.$error.'</div>
									</div>
								</div>
								<div class="modal-footer">
                                    <a href="javascript:void(0)" onclick="CheckVerification()">back</a>&nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="EmailVerificationForm(\''.$formid.'\')" class="btn btn-primary">Save to verify</a>
                                </div>
                            </form>                                                                                                       
                        </div>'; 
             }
         }
                   
         public function EmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {

             global $mysql,$loginInfo;
             $login = $mysql->select("Select * from `_tbl_logs_logins` where `LoginID`='".$loginid."'");
             $updatemsg = "";

             if (isset($_POST['new_email'])) {
                 if (strlen(trim($_POST['new_email']))==0) {
                     return $this->ChangeEmailID("<span style='color:red';>Please enter valid email id</span>",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                 }
                 $duplicate = $mysql->select("select * from _tbl_members where EmailID='".$_POST['new_email']."' and MemberID <>'".$loginInfo[0]['MemberID']."'");

                 if (sizeof($duplicate)>0) {
                     return $this->ChangeEmailID("<span style='color:red';>Email already in use</span>.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                 }
                 $sql="update `_tbl_members` set `EmailID`='".$_POST['new_email']."' where `MemberID`='".$loginInfo[0]['MemberID']."'";
                 $mysql->execute($sql);
                 
                 $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
                 
                 $mContent = $mysql->select("select * from `mailcontent` where `Category`='EmailIDChanged'");
                 $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],                        
                                        "Category" => "EmailIDChanged",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Email ID has been changed.");  
             
                 $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'EmailIDChanged.',
                                                             "ActivityString" => 'Email ID Changed.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                 $updatemsg = "<div class='successmessage'>Your new email address has been updated.</div>";
             }

             $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");

             if ($memberdata[0]['IsEmailVerified']==1) {
                 return '<div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
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
                                                <p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <p style="text-align:center;color:#ada9a9;padding:10px;font-size: 14px;">We have sent a 4 digits verification Code to<br>'.$memberdata[0]['EmailID'].'</p>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text"  class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;color:red" id="frmMobileNoVerification_error">'.$error.'</div>
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
                 $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                 return '<div id="otpfrm">
                        <form method="POST" id="'.$formid.'">
                        <input type="hidden" value="'.$loginid.'" name="loginId">
                        <input type="hidden" value="'.$securitycode.'" name="reqId">
                            <div class="modal-header">
                                <h4 class="modal-title">Please verify your email</h4>
                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
                            </div>
                             <div class="modal-body">
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="col-sm-12">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-4"><input type="text" value="'.$_POST['email_otp'].'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                            <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                            <div class="col-sm-3"></div>
                                        </div>															
                                        <div class="col-sm-12"  style="text-align:center;color:red" id="frmMobileNoVerification_error">'.$error.'&nbsp;</div>
                                    </div>
                                </div>
                             </div>
                        <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                    </form>                                                                                                       
                    </div>'; 
                }
            }                                    
         }
                                                                                     
         public function EmailOTPVerification() {

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
                 return '<div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';
                       
             } else {
                 return $this->EmailVerificationForm("<span style='color:red'>Invalid verification code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
             }  
         }

         public function GetMyProfiles() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */

                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and  RequestToVerify='0' and IsApproved='0' and IsDelete='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and  RequestToVerify='1' and IsDelete='0'");
                 
				  
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
							$result['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($PublishedProfile['ProfileCode']));
							$result['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($PublishedProfile['ProfileCode']));
							$result['MutualCount']= sizeof($this->GetMutualProfilesCount($PublishedProfile['ProfileCode']));
							$result['WhoShortListedcount']= Shortlist::WhoShortlisted($PublishedProfile['ProfileCode']);
                            $Profiles[]=$result;     
                         }
						 
                     } else {
						  
                        foreach($PostProfiles as $PostProfile) {
                            $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode']);
                            $result['mode']="Submitted";
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
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and RequestToVerify='1' and IsApproved='0'");

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
                
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where `MemberID` = '".$loginInfo[0]['MemberID']."' and IsApproved='1' and RequestToVerify='1'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInformation($PublishedProfile['ProfileCode']);
                        $result['mode']="Published";
						
							$result['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($PublishedProfile['ProfileCode']));
							$result['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($PublishedProfile['ProfileCode']));
							$result['MutualCount']= sizeof($this->GetMutualProfilesCount($PublishedProfile['ProfileCode']));
							$result['WhoShortListedcount']= Shortlist::WhoShortlisted($PublishedProfile['ProfileCode']);
                        $Profiles[]=$result; 
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         }
         
         public function DownloadedProfiles() {
                global $mysql,$loginInfo;

                $Profiles = $mysql->select("SELECT _tbl_profile_download.PartnerProfileCode as ProfileCode
                                                FROM _tbl_profiles
                                                LEFT JOIN _tbl_profile_download
                                                ON _tbl_profiles.ProfileCode = _tbl_profile_download.ProfileCode where _tbl_profile_download.MemberID='".$loginInfo[0]['MemberID']."'"); 
                  $result = array();
                  foreach($Profiles as $p) {
                     $temp = Profiles::getProfileInfo($p['ProfileCode'],1,1);
                      $result[]=$temp;
                  }
                return Response::returnSuccess("success",array("Profiles" => $result));
     
         }  

         public function  BasicSearchViewMemberPlan() {
             global $mysql,$loginInfo; 
             $Plans = $mysql->select("select * from _tbl_member_plan");
             return Response::returnSuccess("success",$Plans);
         }
         public function SaveBasicSearch() {

             global $mysql,$loginInfo; 
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
         public function OverallSendOtp($errormessage="",$otpdata="",$reqID="",$PProfileID="") {
             
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
                                return '<div id="otpfrm" style="width:100%;padding:20px;">
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
                 return '<div id="otpfrm" style="width:100%;padding:20px;">
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
         
         public function ViewProfileOTPVerification() {

             global $mysql,$loginInfo ;
             $data = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['PProfileCode']."'");   
             $Profiles = $mysql->select("Select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
             $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
             if (strlen(trim($_POST['otpcheck']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['otpcheck']))  {

                     $Did = $mysql->insert("_tbl_profile_download",array("MemberID" =>$otpInfo[0]['MemberID'],
                                                                          "ProfileCode" =>$Profiles[0]['ProfileCode'],
                                                                          "PartnerProfileCode" =>$_POST['PProfileCode'],
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

         public function VerifyProfileforPublish() {                          

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
          
         /* Submit Profile */ 
         public function SendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {
			global $mysql,$mail,$loginInfo;      
        
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
        
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
					return Response::returnError("You must enter about your family",array("ProfileCode"=>$_POST['ProfileID'],"MemberCode"=>$data[0]['MemberCode'],"EditPage"=>"FamilyInformation"));
				}
				   
				if ($reqID=="")      {
					$otp=rand(1000,9999);
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishProfile'");
					$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#otp#",$otp,$content);

					MailController::Send(array("MailTo"   => $member[0]['EmailID'],
											   "Category" => "RequestToVerifyPublishProfile",
											   "MemberID" => $member[0]['MemberID'],
											   "Subject"  => $mContent[0]['Title'],
											   "Message"  => $content),$mailError);
					MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']."Verification Security Code is ".$otp);

					if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID"      =>$member[0]['MemberID'],
                                                                                      "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                      "EmailTo"       =>$member[0]['EmailID'],
                                                                                      "SMSTo"         =>$member[0]['MobileNumber'],
                                                                                      "SecurityCode"  =>$otp,
                                                                                      "Type"          =>"RequestToVerifyPublishProfile",
                                                                                      "messagedon"    =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
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
											</div>
											<div class="col-sm-12" style="text-align:center">'.$errormessage.'</div>
										</div>
										<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
									</form>                                                                                                       
								</div>'; 
				}
        }
         
         public function ProfilePublishOTPVerification() {
            global $mysql,$loginInfo ;
             
            $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
			$otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
			
            if (strlen(trim($_POST['PublishOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['PublishOtp']))  {

                $mysql->execute("update `_tbl_draft_profiles` set  `RequestToVerify`      = '1',
																`RequestVerifyOn`      = '".date("Y-m-d H:i:s")."'
																 where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
				
				$mysql->insert("_tbl_request_edit",array("MemberID"          	=> $loginInfo[0]['MemberID'],
														 "MemberCode"        	=> $member[0]['MemberCode'],
														 "DraftProfileID"    	=> $data[0]['ProfileID'],
														 "DraftProfileCode"  	=> $data[0]['ProfileCode'],
														 "RequestToSubmit"   	=> "1",
														 "RequestToSubmittedOn" => date("Y-m-d H:i:s")));
             
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='SubmitToVerifyPublishProfile'");
				$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
				$content  = str_replace("#ProfileCode#",$data[0]['ProfileCode'],$content);

				MailController::Send(array("MailTo"   => $member[0]['EmailID'],
										   "Category" => "SubmitToVerifyPublishProfile",
										   "MemberID" => $member[0]['MemberID'],
										   "Subject"  => $mContent[0]['Title'],
										   "Message"  => $content),$mailError);
				MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." [ ".$data[0]['ProfileCode']." ] Your profile submitted to verify ");
			  
				$id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
																"ActivityType"   => 'RequestToVerifyPublishProfile.',
																"ActivityString" => 'Request To Verify PublishProfile.',
																"SqlQuery"       => base64_encode($updateSql),
																//"oldData"      => base64_encode(json_encode($oldData)),
																"ActivityOn"     => date("Y-m-d H:i:s")));
				return Response::returnSuccess("Your profile has been submitted to verify.");
                
            } else {
                 return $this->SendOtpForProfileforPublish("<span style='color:red'>Invalid verification code.</span>",$_POST['PublishOtp'],$_POST['reqId'],$_POST['ProfileID']);
				} 
        }
		
         public function ResendSendOtpForProfileforPublish($errormessage="",$otpdata="",$reqID="",$ProfileID="") {
			global $mysql,$mail,$loginInfo;      
			
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");  
             
				$resend = $mysql->insert("_tbl_resend",array("MemberID" =>$member[0]['MemberID'],
															 "Reason" 	=>"Resend Profile Publish Verfication Code",
															 "ResendOn" =>date("Y-m-d h:i:s"))) ;
				if ($reqID=="") {
					$otp=rand(1000,9999);

					$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToVerifyPublishProfile'");
					$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#otp#",$otp,$content);

					MailController::Send(array("MailTo"   => $member[0]['EmailID'],
											   "Category" => "RequestToVerifyPublishProfile",
											   "MemberID" => $member[0]['MemberID'],
											   "Subject"  => $mContent[0]['Title'],
											   "Message"  => $content),$mailError);
					MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." Verification Security Code is ".$otp);
                                                                                                                          
					if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";                                                               
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" 	=>$member[0]['MemberID'],
                                                                                     "RequestSentOn"=>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" 		=>$member[0]['EmailID'],
                                                                                     "SMSTo" 		=>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type"         =>"RequestToVerifyPublishProfile",
                                                                                     "messagedon"  	=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmPuplishOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
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
													<div class="col-sm-12">'.$errormessage.'</div>
												</div>
											</div>
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileforPublish(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
				}
        }
		 /* end Submit profile */  
		 
		 /* Delete Draft Profile */
		
         public function SendOtpForProfileDelete($errormessage="",$otpdata="",$reqID="",$ProfileID="") {
			global $mysql,$mail,$loginInfo;      
        
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
			
				if ($reqID=="")      {
					$otp=rand(1000,9999);
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToDeleteDraftProfile'");
					$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#otp#",$otp,$content);

					MailController::Send(array("MailTo"   => $member[0]['EmailID'],
											   "Category" => "RequestToDeleteDraftProfile",
											   "MemberID" => $member[0]['MemberID'],
											   "Subject"  => $mContent[0]['Title'],
											   "Message"  => $content),$mailError);
					MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']."Verification Security Code is ".$otp);

					if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID"      =>$member[0]['MemberID'],
                                                                                      "RequestSentOn" =>date("Y-m-d H:i:s"),
                                                                                      "EmailTo"       =>$member[0]['EmailID'],
                                                                                      "SMSTo"         =>$member[0]['MobileNumber'],
                                                                                      "SecurityCode"  =>$otp,
                                                                                      "Type"          =>"RequestToDeleteDraftProfile",
                                                                                      "messagedon"    =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmDeleteOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm">
											<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<input type="hidden" value="'.$securitycode.'" name="reqId">
											<input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
												<div class="modal-header">
													<h4 class="modal-title">Delete draft profile</h4>
													<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
												</div>
												<div class="modal-body">
													<p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
													<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9;font-size: 15px;">'.$memberdata[0]['EmailID'].' & '.$memberdata[0]['MobileNumber'].'</h4>
													<div class="form-group">
														<div class="input-group">
															<div class="col-sm-12">
																<div class="col-sm-3"></div>
																<div class="col-sm-4"><input type="text"  class="form-control" id="DeleteOtp" maxlength="4" name="DeleteOtp" style="width: 126%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
																<div class="col-sm-2"><button type="button" onclick="ProfileDeleteOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
																<div class="col-sm-3"></div>
															</div>															
															<div class="col-sm-12" style="text-align:center;color:red" id="Error_delete_otp">'.$errormessage.'&nbsp;</div>
														</div>
													</div>
												</div>
												<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileDelete(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
											</form>                                                                                                       
										</div>'; 
					}
				} else {
					$memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
						$formid = "frmDeleteOTPVerification_".rand(30,3000);
								return '<div id="otpfrm" >
									<form method="POST" id="'.$formid.'" name="'.$formid.'">
										<input type="hidden" value="'.$reqID.'" name="reqId">
										<input type="hidden" value="'.$ProfileID.'" name="ProfileID">
										<div class="modal-header">
											<h4 class="modal-title">Delete draft profile</h4>
											<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
										</div>
										<div class="modal-body">
											<p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
											<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9;font-size: 15px;">'.$memberdata[0]['EmailID'].' & '.$memberdata[0]['MobileNumber'].'</h4>
											<div class="form-group">
												<div class="input-group">
													<div class="col-sm-12">
														<div class="col-sm-3"></div>
														<div class="col-sm-4"><input type="text"  class="form-control" value="'.$otpdata.'" id="DeleteOtp" maxlength="4" name="DeleteOtp" style="width: 126%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
														<div class="col-sm-2"><button type="button" onclick="ProfileDeleteOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
														<div class="col-sm-3"></div>
													</div>															
													<div class="col-sm-12" style="text-align:center;color:red" id="Error_delete_otp">'.$errormessage.'&nbsp;</div>
												</div>
											</div>
										</div>
										<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileDelete(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
									</form>                                                                                                       
								</div>'; 
				}
        }
         
         public function ProfileDeleteOTPVerification() {
            global $mysql,$loginInfo ;
             
            $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
			$otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
			
			 if(strlen(trim($_POST['DeleteOtp'])) == 0) {
				 return Response::returnError("Please enter security code");
			 }
			
            if (strlen(trim($_POST['DeleteOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['DeleteOtp']))  {

                $mysql->execute("update `_tbl_draft_profiles` set  `IsDelete`      = '1',
																	`DeletedRemarks` ='".$_POST['DeleteRemarks_DraftProfile']."',
																`DeletedOn`      = '".date("Y-m-d H:i:s")."'
																 where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
				
				
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberDeleteDraftProfile'");
				$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
				$content  = str_replace("#ProfileCode#",$data[0]['ProfileCode'],$content);

				MailController::Send(array("MailTo"   => $member[0]['EmailID'],
										   "Category" => "MemberDeleteDraftProfile",
										   "MemberID" => $member[0]['MemberID'],
										   "Subject"  => $mContent[0]['Title'],
										   "Message"  => $content),$mailError);
				MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." [ ".$data[0]['ProfileCode']." ] Your profile deleted ");
			  
				$id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
																"ActivityType"   => 'DeleteDraftProfile.',
																"ActivityString" => 'Delete Draft Profile.',
																"SqlQuery"       => base64_encode($updateSql),
																//"oldData"      => base64_encode(json_encode($oldData)),
																"ActivityOn"     => date("Y-m-d H:i:s")));
				return Response::returnSuccess("Your profile has been deleted.");
                
            } else {
                 return $this->SendOtpForProfileDelete("<span style='color:red'>Invalid verification code.</span>",$_POST['DeleteOtp'],$_POST['reqId'],$_POST['ProfileID']);
				} 
        }
		
		public function ResendSendOtpForProfileDelete($errormessage="",$otpdata="",$reqID="",$ProfileID="") {
			global $mysql,$mail,$loginInfo;      
			
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");  
             
				$resend = $mysql->insert("_tbl_resend",array("MemberID" =>$member[0]['MemberID'],
															 "Reason" 	=>"Resend Profile Delete Verfication Code",
															 "ResendOn" =>date("Y-m-d h:i:s"))) ;
				if ($reqID=="") {
					$otp=rand(1000,9999);

					$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToDeleteDraftProfile'");
					$content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
					$content  = str_replace("#otp#",$otp,$content);

					MailController::Send(array("MailTo"   => $member[0]['EmailID'],
											   "Category" => "RequestToDeleteDraftProfile",
											   "MemberID" => $member[0]['MemberID'],
											   "Subject"  => $mContent[0]['Title'],
											   "Message"  => $content),$mailError);
					MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear ".$member[0]['MemberName']." Verification Security Code is ".$otp);
                                                                                                                          
					if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";                                                               
                    } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("MemberID" 	=>$member[0]['MemberID'],
                                                                                     "RequestSentOn"=>date("Y-m-d H:i:s"),
                                                                                     "EmailTo" 		=>$member[0]['EmailID'],
                                                                                     "SMSTo" 		=>$member[0]['MobileNumber'],
                                                                                     "SecurityCode" =>$otp,
                                                                                     "Type"         =>"RequestToDeleteDraftProfile",
                                                                                     "messagedon"  	=>date("Y-m-d h:i:s"))) ;
                        $formid = "frmDeleteOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
                            return '<div id="otpfrm">
										<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<input type="hidden" value="'.$securitycode.'" name="reqId">
											<input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
												<div class="modal-header">
													<h4 class="modal-title">Delete draft profile</h4>
													<button type="button" class="close" data-dismiss="modal" style="padding-top:5px;"></button>
												</div>
												<div class="modal-body">
													<p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
													<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9;font-size: 15px;">'.$memberdata[0]['EmailID'].' & '.$memberdata[0]['MobileNumber'].'</h4>
													<div class="form-group">
														<div class="input-group">
															<div class="col-sm-12">
																<div class="col-sm-3"></div>
																<div class="col-sm-4"><input type="text"  class="form-control" id="DeleteOtp" maxlength="4" name="DeleteOtp" style="width: 126%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
																<div class="col-sm-2"><button type="button" onclick="ProfileDeleteOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
																<div class="col-sm-3"></div>
															</div>															
															<div class="col-sm-12" style="text-align:center;color:red" id="Error_delete_otp">'.$errormessage.'&nbsp;</div>
														</div>
													</div>
												</div>
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileDelete(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
                    }
			    } else {
						$formid = "frmDeleteOTPVerification_".rand(30,3000);
							return '<div id="otpfrm">
										<form method="POST" id="'.$formid.'" name="'.$formid.'">
											<input type="hidden" value="'.$reqID.'" name="reqId">
											<input type="hidden" value="'.$ProfileID.'" name="ProfileID">
											<div class="modal-body">
												<p style="text-align:center;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
												<h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9;font-size: 15px;">'.$memberdata[0]['EmailID'].' & '.$memberdata[0]['MobileNumber'].'</h4>
												<div class="form-group">
													<div class="input-group">
														<div class="col-sm-12">
															<div class="col-sm-3"></div>
															<div class="col-sm-4"><input type="text"  class="form-control" id="DeleteOtp" maxlength="4" name="DeleteOtp" style="width: 126%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
															<div class="col-sm-2"><button type="button" onclick="ProfileDeleteOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
															<div class="col-sm-3"></div>
														</div>															
														<div class="col-sm-12" style="text-align:center;color:red" id="Error_delete_otp">'.$errormessage.'&nbsp;</div>
													</div>
												</div>
											</div>
											<h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendSendOtpForProfileDelete(\''.$formid.'\')" style="cursor: pointer;color: #1694b5;">&nbsp;Resend</a></h5> 
										</form>                                                                                                       
									</div>'; 
				}
        }
                                                             
         public function DeleteAttach() {

             global $mysql,$loginInfo;

             $updateSql = "update `_tbl_draft_profiles_education_details` set `IsDelete` = '1' where `AttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);
             $updateSql = "update `_tbl_draft_profile_education_attachments` set `IsDeleted` = '1' where `EducationAttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Delete Attachment',
                                                             "ActivityString" => 'Delete attachment.',
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
               return  '<div class="modal-header">
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="height:100px;"></p>
                            <h5 style="text-align:center;color:#ada9a9">Record has been removed successfully</h4>    <br>
                            <a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';

         }
         
         public function DeleteEducationAttachmentOnly() {

             global $mysql,$loginInfo;

             $ProfileCode= $_POST['ProfileID'];
             
             $updateSql = "update `_tbl_draft_profiles_education_details` set `FileName` = '' where `AttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($updateSql);
             $updateSql = "update `_tbl_draft_profile_education_attachments` set `FileName` = '' where `EducationAttachmentID`='".$_POST['AttachmentID']."' and `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($updateSql);  
          
               return  '<div class="modal-header">
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="height:100px;"></p>
                            <h5 style="text-align:center;color:#ada9a9">Record has been removed successfully</h4>    <br>
                            <a href="'.AppPath.'MyProfiles/Draft/Edit/EducationDetails/'.$ProfileCode.'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';                             

         }
         
         public function GetDraftProfileInfo() {
             
             global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
             $result =  Profiles::getDraftProfileInformation($Profiles[0]['ProfileCode']);
             return Response::returnSuccess("success",$result);
           }
         
         /*Checked*/
         public function GetPublishProfileInfo() {
             global $mysql,$loginInfo;      
             $result =  Profiles::getProfileInfo($_POST['ProfileCode']);
             return (is_array($result)) ? Response::returnSuccess("success",$result) : Response::returnError($result);
         }

         public function GetDraftProfileInformation($ProfileCode="",$rtype="") {
             
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
                              
                              "ProfileSignInFor"       => CodeMaster::getActiveData("PROFILESIGNIN"),
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
							"CountryName"           => CodeMaster::getActiveData('RegisterAllowedCountries'),
							"AllCountryName"        => CodeMaster::getActiveData('CONTNAMES'),
							"RasiName"               => CodeMaster::getActiveData('MONSIGNS'),
							"Lakanam"                => CodeMaster::getActiveData('LAKANAM'),
							"StarName"               => CodeMaster::getActiveData('STARNAMES'),
							"Education"              => CodeMaster::getActiveData('EDUCATETITLES'),
							"ParentsAlive"              => CodeMaster::getActiveData('PARENTSALIVE'),
							"ChevvaiDhosham"              => CodeMaster::getActiveData('CHEVVAIDHOSHAM'),
							"PrimaryPriority"              => CodeMaster::getActiveData('PRIMARYPRIORITY'),
							"StateName"              => CodeMaster::getActiveData('STATNAMES'));
             if ($rtype=="")  {
             return Response::returnSuccess("success"."select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'",$result);
             } else {
                 return  $result;
             }                                                    
         }
       
         public function SelectPlanAndContinue() {

             global $mysql,$loginInfo;
             $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['Code']."'");     
             $OwnlProfile = $mysql->select("select * from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'");               
              $plan =$mysql->select("select * from `_tbl_member_plan` where `PlanCode`='".$_POST['PlanCode']."'"); 
              $Member =$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
              $orderid=SeqMaster::GetNextOrderCode() ;     
            /* $id = $mysql->insert("_tbl_orders",array("ProfileID"       => $_POST['Code'],
                                                      "Plan"       => $plan[0]['PlanName'],
                                                      "Amount"       => $plan[0]['Amount'],
                                                      "Duration"       => $plan[0]['Decreation'],
                                                      "OrderOn"     => date("Y-m-d H:i:s")));   */

            $id = $mysql->insert("_tbl_orders",array("OrderDate"            => DATE("Y-m-d H:i:s"),
                                                     "OrderNumber"          => $orderid,
                                                     "ProfileID"            =>  $OwnlProfile[0]['ProfileID'],
                                                     "ProfileCode"          =>  $OwnlProfile[0]['ProfileCode'],
                                                     "MemberName"           => $Member[0]['MemberName'],
                                                     "EmailID"              => $Member[0]['EmailID'],
                                                     "MobileNumber"         => $Member[0]['MobileNumber'],
                                                     "AddressLine1"         => $Profiles[0]['AddressLine1'],
                                                     "AddressLine2"         => $Profiles[0]['AddressLine2'],
                                                     "AddressLine3"         => $Profiles[0]['AddressLine3'],
                                                     "Pincode"              => $Profiles[0]['Pincode'],
                                                     "OrderValue"           => $plan[0]['Amount'],
                                                     "Description"          => "Days :" .$plan[0]['Decreation'] .","."Free Profiles :" .$plan[0]['FreeProfiles'],
                                                     "Createdon"            => DATE("Y-m-d H:i:s"),
                                                     "OrderByMemberID"      => $loginInfo[0]['MemberID'],
                                                     "OrderByMemberCode"    => $OwnlProfile[0]['MemberCode'],
                                                     "OrderedProfileID"     => $Profiles[0]['ProfileID'],
                                                     "OrderedProfileCode"   => $Profiles[0]['ProfileCode'],
                                                     "OrderByFranchisee"    => "0",
                                                     "InvoiceNumber"        => "",
                                                     "InvoiceID"            => "0"));
            $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Order'");
           $mysql->insert("_tbl_orders_items",array("OrderID"               => $orderid,
                                                    "AddedOn"               => date("Y-m-d H:i:s"),
                                                    "ProfileID"             => $OwnlProfile[0]['ProfileID'],
                                                    "ProfileCode"           => $OwnlProfile[0]['ProfileCode'],
                                                    "ProfileName"           => $OwnlProfile[0]['ProfileName'],
                                                    "ProductID"             => $plan[0]['PlanID'],
                                                    "ProductCode"           => $plan[0]['PlanCode'],
                                                    "ProductName"           => $plan[0]['PlanName'],
                                                    "ProfileToView"         => $plan[0]['FreeProfiles'],
                                                    "Qty"                   => "1",
                                                    "Amount"                => $plan[0]['Amount'],
                                                    "TAmount"               => "0",
                                                    "ServiceCharge"         => "0",
                                                    "Remarks"               => "0"));   
         
             return Response::returnSuccess("succss",array("OrderNumber"=>$orderid));
         }

         public function updateProfilePhoto() {
             global $mysql,$loginInfo;
             $Profiles = $mysql->select("update  `_tbl_members` set `FileName`='".$_POST['filename']."'  where `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",array());
         }

         public function GetMyEmails() {
             global $mysql,$loginInfo;
             $MyEmails = $mysql->select("select * from `_tbl_logs_email` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             return Response::returnSuccess("success",$MyEmails);
         }

         public function GetKYC() {
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

         public function UpdateKYC() {
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

         public function UpdateNotification() {

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

         public function UpdatePrivacy() {

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

         public function EditDraftGeneralInformation() {

             global $mysql, $loginInfo;

             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $MotherTongue   = CodeMaster::getData("LANGUAGENAMES",$_POST['Language']); 
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Community      = CodeMaster::getData("COMMUNITY",$_POST['Community']);  
             $Nationality    = CodeMaster::getData("NATIONALNAMES",$_POST['Nationality']);
             $Childrens     = CodeMaster::getData("NUMBEROFBROTHER",$_POST['HowManyChildren']);  

             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date']; 
             
             $updateSql = "update `_tbl_draft_profiles` set `MaritalStatusCode` = '".$_POST['MaritalStatus']."',
                                                           `MaritalStatus`     = '".$MaritalStatus[0]['CodeValue']."',
                                                           `ChildrenCode`      ='0',     
                                                           `Children`          ='0',
                                                           `IsChildrenWithyou` ='0',
                                                           `MotherTongueCode`  = '".$_POST['Language']."',
                                                           `MotherTongue`      = '".$MotherTongue[0]['CodeValue']."',
                                                           `ReligionCode`      = '".$_POST['Religion']."',
                                                           `Religion`          = '".$Religion[0]['CodeValue']."',
                                                           `OtherReligion`     = '',
                                                           `CasteCode`         = '".$_POST['Caste']."',
                                                           `Caste`             = '".$Caste[0]['CodeValue']."',
                                                           `OtherCaste`        = '',
                                                           `SubCaste`          = '".$_POST['SubCaste']."',
                                                           `CommunityCode`     = '".$_POST['Community']."',
                                                           `Community`         = '".$Community[0]['CodeValue']."',
                                                           `NationalityCode`   = '".$_POST['Nationality']."',
                                                           `Nationality`       = '".$Nationality[0]['CodeValue']."',
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

         public function EditDraftFamilyInformation() {

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
             $DuplicateOccupationType = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='OCCUPATIONTYPES' and `CodeValue`='".trim($_POST['OtherOccupation'])."'");
                    if (sizeof($DuplicateOccupationType)>0) {
                        return Response::returnError("Occupation Already Exists");    
                    }
             
            $updateSql = "update `_tbl_draft_profiles` set `FathersName`               = '".$_POST['FatherName']."',
                                                           `FathersAlive`               = '".$Fathersstatus."',
                                                           `FathersContactCountryCode`  = '".$_POST['FathersContactCountryCode']."',
                                                           `FathersContact`             = '".$_POST['FathersContact']."',
                                                           `FathersOccupationCode`     = '".$_POST['FathersOccupation']."',
                                                           `FathersOccupation`          = '".$FathersOccupation[0]['CodeValue']."',
                                                           `FatherOtherOccupation`      = '',
                                                           `FathersIncomeCode`          = '".$_POST['FathersIncome']."',
                                                           `FathersIncome`              = '".$FathersIncome[0]['CodeValue']."',
                                                           `MothersName`                = '".$_POST['MotherName']."',
                                                           `MothersContactCountryCode`  = '".$_POST['MotherContactCountryCode']."',
                                                           `MothersContact`             = '".$_POST['MotherContact']."',
                                                           `MothersIncomeCode`          = '".$_POST['MothersIncome']."',
                                                           `MothersIncome`              = '".$MothersIncome[0]['CodeValue']."',
                                                           `MothersAlive`               = '".$Mothersstatus."',
                                                           `FamilyLocation1`            = '".$_POST['FamilyLocation1']."',
                                                           `FamilyLocation2`            = '".$_POST['FamilyLocation2']."',
                                                           `Ancestral`                  = '".$_POST['Ancestral']."',
                                                           `FamilyTypeCode`             = '".$_POST['FamilyType']."',
                                                           `FamilyType`                 = '".$FamilyType[0]['CodeValue']."',              
                                                           `FamilyValueCode`            = '".$_POST['FamilyValue']."',
                                                           `FamilyValue`                = '".$FamilyValue[0]['CodeValue']."',
                                                           `FamilyAffluenceCode`        = '".$_POST['FamilyAffluence']."',
                                                           `FamilyAffluence`            = '".$FamilyAffluence[0]['CodeValue']."',
                                                           `AboutMyFamily`              = '".$_POST['AboutMyFamily']."',
                                                           `MothersOccupationCode`      = '".$_POST['MothersOccupation']."',
                                                           `MothersOccupation`          = '".$MothersOccupation[0]['CodeValue']."',
                                                           `MotherOtherOccupation`      = '',
                                                           `NumberofBrothersCode`       = '".$_POST['NumberofBrother']."',
                                                           `NumberofBrothers`           = '".$NumberofBrothers[0]['CodeValue']."',
                                                           `YoungerCode`                = '".$_POST['younger']."',                    
                                                           `Younger`                    = '".$younger[0]['CodeValue']."',
                                                           `ElderCode`                  = '".$_POST['elder']."',
                                                           `Elder`                      = '".$elder[0]['CodeValue']."',
                                                           `MarriedCode`                = '".$_POST['married']."',
                                                           `Married`                    = '".$married[0]['CodeValue']."',
                                                           `NumberofSistersCode`        = '".$_POST['NumberofSisters']."',
                                                           `NumberofSisters`            = '".$NumberofSisters[0]['CodeValue']."',
                                                           `ElderSisterCode`            = '".$_POST['elderSister']."',
                                                           `ElderSister`                = '".$elderSister[0]['CodeValue']."',
                                                           `YoungerSisterCode`          = '".$_POST['youngerSister']."',
                                                           `YoungerSister`              = '".$youngerSister[0]['CodeValue']."',
                                                           `MarriedSisterCode`          = '".$_POST['marriedSister']."',
                                                           `LastUpdatedOn`              = '".date("Y-m-d H:i:s")."',
                                                           `MarriedSister`              = '".$marriedSister[0]['CodeValue']."'";
                                                           
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
             
              $updateSql .= " where  MemberID='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'";
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

         public function EditDraftPhysicalInformation() {

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
                                                           `PhysicalDescription`       = '".$_POST['PhysicalDescription']."',
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

         public function EditDraftCommunicationDetails() {

             global $mysql,$loginInfo;

             $Country = CodeMaster::getData("RegisterAllowedCountries",$_POST['Country']);
             $State   = CodeMaster::getData("STATNAMES",$_POST['StateName']);

             $updateSql = "update `_tbl_draft_profiles` set `ContactPersonName`         = '".$_POST['ContactPersonName']."',
                                                            `Relation`                  = '".$_POST['Relation']."',
                                                            `PrimaryPriority`           = '".$_POST['PrimaryPriority']."',
                                                            `EmailID`                   = '".$_POST['EmailID']."',
                                                            `MobileNumber`              = '".$_POST['MobileNumber']."',
                                                            `MobileNumberCountryCode`   = '".$_POST['MobileNumberCountryCode']."',
                                                            `WhatsappNumber`            = '".$_POST['WhatsappNumber']."',
                                                            `WhatsappCountryCode`       = '".$_POST['WhatsappCountryCode']."',
                                                            `AddressLine1`              = '".$_POST['AddressLine1']."',
                                                            `AddressLine2`              = '".$_POST['AddressLine2']."',
                                                            `AddressLine3`              = '".$_POST['AddressLine3']."',
                                                            `CountryCode`               = '".$_POST['Country']."',
                                                            `Country`                   = '".$Country[0]['CodeValue']."',
                                                            `StateCode`                 = '".$_POST['StateName']."',
                                                            `State`                     = '".$State[0]['CodeValue']."',
                                                            `City`                      = '".$_POST['City']."',
                                                            `Pincode`                   = '".$_POST['Pincode']."',
                                                            `CommunicationDescription`  = '".$_POST['CommunicationDescription']."',
                                                            `LastUpdatedOn`             = '".date("Y-m-d H:i:s")."',
                                                            `OtherLocation`             = '".$_POST['OtherLocation']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
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

         public function GetPartnersExpectaionInformation() {
             global $mysql,$loginInfo;
             $PartnersExpectation = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
             
             return Response::returnSuccess("success",array("ProfileInfo"            =>$PartnersExpectation[0],
                                                            "MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "RasiName"               => CodeMaster::getData('MONSIGNS'),
                                                            "StarName"               => CodeMaster::getData('STARNAMES'),
                                                            "ChevvaiDhosham"         => CodeMaster::getData('CHEVVAIDHOSHAM'),
                                                            "EmployedAs"             => CodeMaster::getData('Occupation')));
         }
         
         public function AddPartnersExpectaion() {

             global $mysql,$loginInfo;    

             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",explode(",",$_POST['MaritalStatus']));
             $Religion       = CodeMaster::getData("RELINAMES",explode(",",$_POST['Religion'])); 
             $Caste          = CodeMaster::getData("CASTNAMES",explode(",",$_POST['Caste']));  
             $Education      = CodeMaster::getData("EDUCATETITLES",explode(",",$_POST['Education']));  
             $EmployedAs     = CodeMaster::getData("Occupation",explode(",",$_POST["EmployedAs"])) ;
             $IncomeRange    = CodeMaster::getData("INCOMERANGE",explode(",",$_POST["IncomeRange"])) ;
             $RasiName       = CodeMaster::getData("MONSIGNS",explode(",",$_POST["RasiName"])) ;
             $StarName       = CodeMaster::getData("STARNAMES",explode(",",$_POST["StarName"])) ;
             $ChevvaiDhosham = CodeMaster::getData("CHEVVAIDHOSHAM",$_POST["ChevvaiDhosham"]);
             
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
             
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'"); 
             $check =  $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'");                      
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
                                                                                   `Details`           = '".$_POST['Details']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
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
                                                                                     "Details"           => $_POST['Details'],
                                                                                     "MemberID"          => $loginInfo[0]['MemberID'],
                                                                                     "ProfileID"         => $profile[0]['ProfileID'],
                                                                                     "ProfileCode"       => $_POST['Code'])) ;
                 $sql=$mysql->qry;
             }
            return Response::returnSuccess("Success",array());
         }

         public function EditDraftOccupationDetails() {

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
                                                                `TypeofOccupation`      = '".$TypeofOccupation[0]['CodeValue']."',
                                                                `OccupationDescription` = '".$_POST['OccupationDescription']."',
                                                                `AnnualIncomeCode`      = '".$_POST['IncomeRange']."',
                                                                `AnnualIncome`          = '".$IncomeRange[0]['CodeValue']."',
                                                                `WorkedCountryCode`     = '".$_POST['WCountry']."',
                                                                `WorkedCountry`         = '".$Country[0]['CodeValue']."',
                                                                `WorkedCityName`     = '".$_POST['WorkedCityName']."',
                                                                `OccupationAttachmentType`     = '".$_POST['OccupationAttachmentType']."',
                                                                `OccupationDetails`     = '".$_POST['OccupationDetails']."',
                                                                `LastUpdatedOn`         = '".date("Y-m-d H:i:s")."'";
                 if (isset($_POST['File'])) {
                    $updateSql .= " , `OccupationAttachmentType`= '".$_POST['OccupationAttachmentType']."' ,`OccupationAttachFileName`     = '".$_POST['File']."' ";
                 }
              }
                                                            
              if ($_POST['EmployedAs']=="O002") {
                    $updateSql = "update `_tbl_draft_profiles` set  `EmployedAsCode`       ='".$_POST['EmployedAs']."',
                                                                    `EmployedAs`           = '".$EmployedAs[0]['CodeValue']."',
                                                                    `OccupationDetails`   = '".$_POST['OccupationDetails']."'";
                } 
                if ($_POST['OccupationType']=="OT112") {
                
                    $DuplicateOccupationType = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='OCCUPATIONTYPES' and `CodeValue`='".trim($_POST['OtherOccupation'])."'");
                    if (sizeof($DuplicateOccupationType)>0) {
                        return Response::returnError("Occupation Already Exists");    
                    }
                $updateSql .= " ,OtherOccupation ='".$_POST['OtherOccupation']."'";
                }
                
              $updateSql .= " where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
             
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

         public function AddEducationalDetails() {
             global $mysql,$loginInfo;
             
              if (!(trim($_POST['Educationdetails']))>0) {                                                                               
                 return Response::returnError("Please select education details");
             }
             if (!(trim($_POST['EducationDegree']))>0) {                                
                 return Response::returnError("Please select education degree ");
             }
             $data = $mysql->select("select * from `_tbl_draft_profiles_education_details` where  `FileName`='".$_POST['FileName']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             if (sizeof($data)>0) {
				 return Response::returnError("Document  Already attached.");
             }
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'"); 
             if($_POST['EducationDegree']=="Others"){
                 $OtherEducation =  $_POST['OtherEducationDegree'];
             }  
             else {
                  $OtherEducation =  "";
             }
             if ($_POST['EducationDegree']=="Others") {
            $DuplicateEducationDegree = $mysql->select("SELECT * FROM `_tbl_master_codemaster` WHERE `HardCode`='EDUCATIONDEGREES' and `CodeValue`='".trim($_POST['OtherEducationDegree'])."'");
            if (sizeof($DuplicateEducationDegree)>0) {
                return Response::returnError("Education Details Already Exists");    
            }
        }                          
             $id = $mysql->insert("_tbl_draft_profiles_education_details",array("EducationDetails" => $_POST['Educationdetails'],
                                                                  "EducationDegree"  => $_POST['EducationDegree'],
                                                                  "OtherEducationDegree"  =>$OtherEducation,
                                                                  "EducationDescription"  => $_POST['EducationDescription'],
                                                                  "FileName"            => $_POST['File'],
                                                                  "ProfileID"        => $profile[0]['ProfileID'],
                                                                  "ProfileCode"        => $_POST['Code'],
                                                                  "MemberID"         => $loginInfo[0]['MemberID'])); 
            $mysql->insert("_tbl_draft_profile_education_attachments",array("EducationAttachmentID" => $id,
                                                                            "MemberID"              => $loginInfo[0]['MemberID'],
                                                                            "ProfileID"             => $profile[0]['ProfileID'], 
                                                                            "ProfileCode"           => $profile[0]['ProfileCode'], 
                                                                            "FileName"              => $_POST['File'])); 
             
             return (sizeof($id)>0) ? Response::returnSuccess("success",array("Code"=>$_POST['Code']))
                                    : Response::returnError("Access denied. Please contact support");   
         }
         
         public function AddEducationalAttachment() {

             global $mysql,$loginInfo;
             
             $profile = $mysql->select("select * from _tbl_draft_profiles where ProfileCode='".$_POST['Code']."'");  
             
             $EducationID= $mysql->select("select * from _tbl_draft_profiles_education_details where ProfileCode='".$_POST['Code']."' and MemberID='".$loginInfo[0]['MemberID']."'");      
             
              $mysql->insert("_tbl_draft_profile_education_attachments",array("EducationAttachmentID" => $EducationID[0]['AttachmentID'],
                                                                            "MemberID"              => $loginInfo[0]['MemberID'],
                                                                            "ProfileID"             => $profile[0]['ProfileID'], 
                                                                            "ProfileCode"           => $profile[0]['Code'], 
                                                                            "FileName"              => $_POST['File'])); 

           $updateSql = "update `_tbl_draft_profiles_education_details` set  `FileName`= '".$_POST['File']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `AttachmentID`='".$_POST['AttachmentID']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'EducationAttachmentupdated.',
                                                             "ActivityString" => 'Education Attachment Updated.',                           
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

             return Response::returnSuccess("success");
         }

         public function AttachDocuments() {

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
                return Response::returnError("Document type attached",$photos);
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
             return Response::returnSuccess("Your Document Information has successfully updated and waiting for verification",$photos);
         }    
                   
         public function DeletDocumentAttachments() {

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
         
         public function DeletProfilePhoto() {

             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_draft_profiles_photos` set `IsDelete`='1',`IsDeletedOn`='".date("Y-m-d H:i:s")."' where `ProfilePhotoID`='".$_POST['ProfilePhotoID']."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileID']."'");
                       return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your selected profile photo  has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         
         public function EditDraftHoroscopeDetails() {
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

         public function AddProfilePhoto() {

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
             return Response::returnSuccess("Your profile photo has successfully updated and waiting for verification",$photos);
         }

         public function GetViewAttachments() {
             global $mysql,$loginInfo;    
             
             $SAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and  `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             $AttachAttachments = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `AttachmentID`='".$_POST['AttachmentID']."' and `IsDelete`='0'");
             
             return Response::returnSuccess("success",array("Attachments"       =>  $SAttachments,
                                                            "AttachAttachments" =>  $AttachAttachments[0],
                                                            "EducationDetail"   =>  CodeMaster::getData('EDUCATETITLES'),
                                                            "EducationDegree"   =>  CodeMaster::getData('EDUCATIONDEGREES')));
         }

         public function GetBankNames() {
             global $mysql,$loginInfo;
             $BankNames = $mysql->select("select * from  `_tbl_settings_bankdetails` where `IsActive`='1'");                    
             return Response::returnSuccess("success",array("BankName" => $BankNames,
                                                            "ModeOfTransfer"     => CodeMaster::getData('MODE')));
         }

         public function DeleteMember() {
             global $mysql,$loginInfo;
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             $deletereason= CodeMaster::getData("DELETEREASON",$_POST['DeleteReason']); 
             $mysql->insert("_tbl_member_delete_request",array("MemberID"      => $loginInfo[0]['MemberID'],
                                                               "MemberCode"    => $member[0]['MemberCode'],
                                                               "DeleteReasonCode"  => $_POST['DeleteReason'],
                                                               "DeleteReason"  => $deletereason[0]['CodeValue'],
                                                               "DeleteReason"  => $_POST['DeleteReason'],
                                                               "MemberCommemnts"     => $_POST['Commemnts'],
                                                               "AddOn"      => date("Y-m-d H:i:s")));
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteMember'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "DeleteMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Account has been Deleted.");  
             $mysql->execute("update `_tbl_members` set `IsDeleted`='1', `DeletedOn`='".date("Y-m-d H:i:s")."'  where  `MemberID`='".$loginInfo[0]['MemberID']."'");
             //_draft
             //_profile
             return Response::returnSuccess("successfully",array());
             return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete Member</h4>
                            <h5 style="text-align:center;color:#ada9a9">Your account was deleted successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'?action=logout&redirect=../index" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';
         }
       
         public function SaveBankRequest() {

             global $mysql,$loginInfo;
             $BankNames = $mysql->select("select * from  `_tbl_settings_bankdetails` where BankID='".$_POST['BankName']."'"); 
             $TransferMode= CodeMaster::getData("MODE",$_POST['Mode']); 
             $id =  $mysql->insert("_tbl_wallet_bankrequests",array("RequestedOn" => date("Y-m-d H:i:s"),
                                                              "MemberID"          => $loginInfo[0]['MemberID'],
                                                              "IsMember"          => "1",
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
      
         public function SavePayPalRequest() {

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

         public function GetListOfPreviousBankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_wallet_bankrequests` ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."Where `MemberID`='". $loginInfo[0]['MemberID']."' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `MemberID`='". $loginInfo[0]['MemberID']."' and `IsApproved`='0' and `IsRejected`='0' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `MemberID`='". $loginInfo[0]['MemberID']."' and `IsApproved`='1' and `IsRejected`='0' order by `ReqID` DESC "));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Reject") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `MemberID`='". $loginInfo[0]['MemberID']."' and `IsApproved`='0' and `IsRejected`='1' order by `ReqID` DESC "));    
             }
         }
         
         public function GetListOfPreviousPaypalRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_paypalrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' order by `PaypalID` DESC ");                    
             return Response::returnSuccess("success",$Paypal);
         }
         
         public function GetViewPaypalRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_paypalrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' and `PaypalID`='".$_POST['Code']."'");                    
             return Response::returnSuccess("success",$Paypal[0]);
         }
         
         public function GetViewBankRequests() {
             global $mysql,$loginInfo;
             $Paypal = $mysql->select("select * from  `_tbl_wallet_bankrequests` where `MemberID`='". $loginInfo[0]['MemberID']."' and `ReqID`='".$_POST['Code']."'");                    
             return Response::returnSuccess("success",$Paypal[0]);
         }

         public function IsPaypalTransferAllowed() {
             global $mysql,$loginInfo;
              $paypal = $mysql->select("select * from  `_tbl_settings_paypal` where `IsActive`='1'");   

             return Response::returnSuccess("success",array("IsAllowed"=>sizeof($paypal))); 
         }
         
         public function GetMyActiveProfile() {
              global $mysql,$loginInfo;
              $profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'") ;
              return $profile;
          }
         
         public function RequestToDownload() { /* verified */
              global $mysql,$loginInfo;
              $myprofile = $this->GetMyActiveProfile();
              $PartnerProfile =  $mysql->select("select * from _tbl_profiles where ProfileCode='".$_GET['PProfileID']."'") ;
              
              $id =  $mysql->insert("_tbl_requestto_download",array("MemberID"           =>  $loginInfo[0]['MemberID'],
                                                                    "MemberCode"         => (isset($myprofile[0]['MemberCode']) ? $myprofile[0]['MemberCode'] : 0) ,        
                                                                    "ProfileID"          => (isset($myprofile[0]['ProfileID']) ? $myprofile[0]['ProfileID'] : 0),      
                                                                    "ProfileCode"        => (isset($myprofile[0]['ProfileCode']) ? $myprofile[0]['ProfileCode'] : 0),      
                                                                    "DownloadProfileID"  => (isset($PartnerProfile[0]['ProfileID']) ? $PartnerProfile[0]['ProfileID'] : 0),          
                                                                    "DownloadProfileCode"=> (isset($PartnerProfile[0]['ProfileCode']) ? $PartnerProfile[0]['ProfileCode'] : 0),       
                                                                    "RequestedOn"        => date("Y-m-d H:i:s"))); 
                 
              if (sizeof($myprofile) > 0) {
                
                  $credits  = $mysql->select("select (sum(Credits)-Sum(Debits)) as bal from `_tbl_profile_credits` where `MemberID`='".$loginInfo[0]['MemberID']."' and `MemberCode` ='".$myprofile[0]['MemberCode']."'");
                  return Response::returnSuccess("success",array("balancecredits"=>isset($credits[0]['bal']) ? $credits[0]['bal'] : 0)); 
              } else {
                  return Response::returnError("You must be submit your profile"); 
              }
          }
                  
         public function RequestToshowUpgrades() {

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
         
         public function ProfilePhotoBringToFront() {

             global $mysql,$loginInfo;
             
             $ProfilePhotoID = $_GET['ProfilePhotoID'];
             $ActiveProfileID = $this->GetMyActiveProfile();
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst`='0' where `MemberID`='".$loginInfo[0]['MemberID']."'";
             $mysql->execute($updateSql);  
             
             $updateSql = "update `_tbl_draft_profiles_photos` set `PriorityFirst` = '1' where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfilePhotoID`='".$ProfilePhotoID."'";
             $mysql->execute($updateSql);  
          }
          
         public function GetDownloadProfileInformation() {
               
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
         public function GetFullProfileInformation() {
               
               global $mysql,$loginInfo;      
               $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['ProfileCode']."'"); 
               if (sizeof($Profiles)==0) {
                    return Response::returnError("Requested profile information not found");
               }
               if (sizeof($Profiles)>1) {
                    return Response::returnError("Requested profile may be unauthorized.");
               }
               
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
                    
                    
                
             $ViewTime = $mysql->select("select * from `_tbl_profiles_lastseen` where `VisterMemberID`='".$loginInfo[0]['MemberID']."'");
             
             if(sizeof($ViewTime)==0){
             $FirstTimeProfileView = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='FirstTimeProfileView'");
             
             if($FirstTimeProfileView[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FirstTimeProfileView'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "FirstTimeProfileView",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             
             if($FirstTimeProfileView[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has viewed. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             } 
             }
             if(sizeof($ViewTime)>0){
             
             $EveryTimeProfileView = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='EveryTimeProfileView'");
             
             if($EveryTimeProfileView[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='EveryTimeProfileView'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "EveryTimeProfileView",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             if($EveryTimeProfileView[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has viewed. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             } 
             }                   
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
         public function GetRecentlyViewedProfiles() {
          global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
           /*  if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }*/

             $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterMemberID` = '".$loginInfo[0]['MemberID']."' order by LastSeenID DESC");
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['ProfileCode'], $profileCodes)))
                 {
                    $profileCodes[]=$RecentProfile['ProfileCode'];
                 }
             }
             if (sizeof($profileCodes)>0) {
                //for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
				foreach($profileCodes as $profileCode) {
                    if (strlen(trim($profileCode))>0)  {
                        $Profiles[]=Profiles::getProfileInfo($profileCode,1,1);     
                    }
                 } 
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         
         /*fixed*/
         public function GetRecentlyWhoViewedProfiles() {

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
             if (isset($myProfile[0]['ProfileCode'])) {
                 $RecentProfiles = $mysql->select("select VisterProfileCode from `_tbl_profiles_lastseen` where `ProfileCode` = '".$myProfile[0]['ProfileCode']."'   order by LastSeenID DESC ");
                 $profileCodes  = array();
                 foreach($RecentProfiles as $RecentProfile) {
                     if (trim(strlen($RecentProfile['VisterProfileCode']))>0) {
                         if (!(in_array($RecentProfile['VisterProfileCode'], $profileCodes))) {
                            $profileCodes[]=$RecentProfile['VisterProfileCode'];     
                         }
                     }
                 }

                 if (sizeof($profileCodes)>0) {
                     for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) {  
                         if (isset($profileCodes[$i])) {
                            $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                         }
                     }
                 }
             }
             return Response::returnSuccess("success",$Profiles);
         }

         
         
         
         
         /* Favourited Section */
         public function AddToFavourite() {
             
             global $mysql,$loginInfo;
             
             $Profiles = $mysql->select("select SexCode,MemberID,ProfileID,ProfileCode from `_tbl_profiles` where ProfileCode='".$_GET['ProfileCode']."'"); 
			 
             if (sizeof($Profiles)==0) {
                return Response::returnError("Couldn't favorite, please contact support team"); 
             }
          
             $visitorsDetails =$mysql->select("select ProfileID,ProfileCode from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
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
			
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
             
             $FirstTime = $mysql->select("select * from `_tbl_profiles_favourites` where `VisterMemberID`='".$loginInfo[0]['MemberID']."'");
             if(sizeof($FirstTime)==0) {
                 $FirstTimeProfileFavorite = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='FirstTimeProfileFavorite'");
             
             if($FirstTimeProfileFavorite[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddToFavoriteProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AddToFavoriteProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             if($FirstTimeProfileFavorite[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has favorited. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             }
             }
             
			  
             $EveryTimeProfileFavorite = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='EveryTimeProfileFavorite'");
             
			  
             if($EveryTimeProfileFavorite[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddToFavoriteProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);
 
             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AddToFavoriteProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
			 
			 
             if($EveryTimeProfileFavorite[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has favorited. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             } 
			 
			 
             $id = $mysql->insert("_tbl_profiles_favourites",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $loginInfo[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s"),
                                                                   "IsFavorite"         => "1",
                                                                   "IsVisible"          => "1",
                                                                   "IsFavoriteOn"       => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                        "ProfileID"          => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"     => $loginInfo[0]['MemberID'],
                                                        "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"       => $ProfileThumbnail,
                                                        "Subject"            => "has favorited your profile",
                                                        "ViewedOn"           => date("Y-m-d H:i:s")));
                                                            
             return Response::returnSuccess($Profiles[0]['ProfileCode']." has favorited.");                                               
         }
         
         public function RemoveFromFavourite() {
             
             global $mysql,$loginInfo;
             
             $Profiles = $mysql->select("select MemberID,ProfileID,ProfileCode,SexCode from `_tbl_profiles` where ProfileCode='".$_GET['ProfileCode']."'"); 
             if (sizeof($Profiles)==0) {
                return Response::returnError("Couldn't favorite, please contact support team"); 
             }
             
             $visitorsDetails =$mysql->select("select ProfileID,ProfileCode from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
             if (sizeof($ProfileThumb)==0) {
                 if ($Profiles[0]['SexCode']=="SX002"){
                     $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                 } else { 
                     $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                 }
             } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); 
             }
             $mysql->execute("update `_tbl_profiles_favourites` set `IsVisible`='0' where `IsFavorite`='1' and  ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."'");
          
             $FirstTime = $mysql->select("select * from `_tbl_profiles_favourites` where `VisterMemberID`='".$loginInfo[0]['MemberID']."'");
             if(sizeof($FirstTime)==0){
             
             $FirstTimeProfileFavorite = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='FirstTimeProfileFavorite'");
             
             if($FirstTimeProfileFavorite[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RemoveFavoriteProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RemoveFavoriteProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             if($FirstTimeProfileFavorite[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has unfavorited. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             }
             }
          
          
             $EveryTimeProfileUnFavorite = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='EveryTimeProfileUnFavorite'");
             
             if($EveryTimeProfileUnFavorite[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RemoveFavoriteProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RemoveFavoriteProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             if($EveryTimeProfileUnFavorite[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has unfavorited. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             }
          
             $id = $mysql->insert("_tbl_profiles_favourites",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $loginInfo[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s"),
                                                                   "IsFavorite"         => "0",
                                                                   "IsVisible"          => "0",
                                                                   "IsFavoriteOn"       => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"          => $Profiles[0]['MemberID'],
                                                        "ProfileID"         => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"       => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"    => $loginInfo[0]['MemberID'],
                                                        "VisterProfileID"   => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode" => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"      => $ProfileThumbnail,
                                                        "Subject"           => "has unfavorited your profile.",
                                                        "ViewedOn"          => date("Y-m-d H:i:s")));
             return Response::returnSuccess($Profiles[0]['ProfileCode']." has unfavorited.");      
          }
		  
         public function GetFavouritedProfiles() {
              global $mysql,$loginInfo; 
              $Profiles = array();
              $sql = (isset($_POST['requestfrom']) && isset($_POST['requestto'])) ?  " limit ".$_POST['requestfrom'].",". $_POST['requestto'] : " limit 0,5 ";
              $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and`VisterMemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC ".$sql);
              $profileCodes  = array();
              foreach($RecentProfiles as $RecentProfile) {
                  if (!(in_array($RecentProfile['ProfileCode'], $profileCodes))) {
                      $profileCodes[]=$RecentProfile['ProfileCode'];
                  }
              }
              if (sizeof($profileCodes)>0) {
                  for($i=0;$i<sizeof($profileCodes);$i++) {
                      $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                  }
              }
              return Response::returnSuccess("success",$Profiles);
         }
      
         public function GetWhoFavouriteMyProfiles() {
             
             global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             $RecentProfiles = $mysql->select("select VisterProfileCode from `_tbl_profiles_favourites` where `IsFavorite` ='1' and`MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC");
             
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['VisterProfileCode'], $profileCodes)))
                  {
                      $profileCodes[]=$RecentProfile['VisterProfileCode'];
                 }                                                                           
             }
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                    if (isset($profileCodes[$i]))  {
                        $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                    }
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
	
    	 public function GetWhoShortListedMyProfiles() {
             
             global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }

             $RecentProfiles = $mysql->select("select VisterProfileCode from `_tbl_profiles_shortlists` where `IsShortList` ='1' and`MemberID` = '".$loginInfo[0]['MemberID']."' order by ShortListProfileID DESC");
             
             $profileCodes  = array();
             foreach($RecentProfiles as $RecentProfile) {
                 if (!(in_array($RecentProfile['VisterProfileCode'], $profileCodes)))
                  {
                      $profileCodes[]=$RecentProfile['VisterProfileCode'];
                 }                                                                           
             }
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                    if (isset($profileCodes[$i]))  {
                        $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                    }
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }
         
         public function GetMutualProfiles() {
             global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
             if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }
             
             $MutualProfiles = $mysql->select("select * from _tbl_profiles_favourites where `IsFavorite` ='1' and `IsVisible`='1' and  `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `MemberID` = '".$loginInfo[0]['MemberID']."' order by FavProfileID DESC)");
             
             $profileCodes = array();
             foreach($MutualProfiles as $mprofile) {
                 if (!(in_array($mprofile['ProfileCode'], $profileCodes)))
                  {
                      $profileCodes[]=$mprofile['ProfileCode'];
                 }                                                                           
             }
             
             if (sizeof($profileCodes)>0) {
                for($i=$_POST['requestfrom'];$i<$_POST['requestto'];$i++) { 
                    if (isset($profileCodes[$i]))  {
                        $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                    }
                }
             }
                  
             return Response::returnSuccess("success",$Profiles);
         }

		 public function GetShortListProfiles() {
              global $mysql,$loginInfo; 
              $Profiles = array();
              $sql = (isset($_POST['requestfrom']) && isset($_POST['requestto'])) ?  " limit ".$_POST['requestfrom'].",". $_POST['requestto'] : " limit 0,5 ";
              $ShortListProfiles = $mysql->select("select ProfileCode from `_tbl_profiles_shortlists` where `IsVisible`='1' and `IsShortList` ='1' and`VisterMemberID` = '".$loginInfo[0]['MemberID']."' order by ShortListProfileID DESC ".$sql);
              $profileCodes  = array();
              foreach($ShortListProfiles as $ShortListProfile) {
                  if (!(in_array($ShortListProfile['ProfileCode'], $profileCodes))) {
                      $profileCodes[]=$ShortListProfile['ProfileCode'];
                  }
              }
              if (sizeof($profileCodes)>0) {
                  for($i=0;$i<sizeof($profileCodes);$i++) {
                      $Profiles[]=Profiles::getProfileInfo($profileCodes[$i],1,1);     
                  }
              }
              return Response::returnSuccess("success",$Profiles);
         }
         /* End Favourited Section */
                        
        
         public function ResendMobileNumberVerificationForm($error="",$loginid="",$scode="",$reqID="") {

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
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Mobile Number Verification</h4>
                            <p style="text-align:center"><br><br><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
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
                 return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$_GET['callfrom'].'" name="callfrom">     
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">    
                                            <div class="modal-header">                                                             
                                                <h4 class="modal-title">Please verify your mobile number</h4>
                                                <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                 '.(($updatemsg!="") ? $updatemsg : "").'
                                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                <h4 style="text-align:center;color:#ada9a9">Please enter the verification code which you have received on your mobile number ending with  +'.$memberdata[0]['CountryCode'].'&nbsp;'.J2JApplication::hideMobileNumberWithCharacters($memberdata[0]['MobileNumber']).'</h4>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="col-sm-12"> 
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-4"><input type="text" value="'.$scode.'" class="form-control" id="mobile_otp_2" maxlength="4" name="mobile_otp_2" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                        <div class="col-sm-2"><button type="button" onclick="MobileNumberOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                        <div class="col-sm-3"></div>
                                                        <div class="col-sm-12" style="text-align:center;">'.$error.'</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification Code?<a onclick="ResendMobileNumberVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                            </form>                                                                                                       
                                </div>';
             }
         }
  
         public function ResendEmailVerificationForm($error="",$loginid="",$scode="",$reqID="") {

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
                 return '<div class="modal-header">
                            <h4 class="modal-title">Email Verification</h4>
                            <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                                return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Please verify your email</h4>
                                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                                                </div>
                                                 <div class="modal-body">
                                                    <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                    <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3"></div>
                                                                <div class="col-sm-4"><input type="text" value="'.$_POST['email_otp'].'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                                <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                                <div class="col-sm-3"></div>
                                                            </div>
                                                            <div class="col-sm-12"  style="text-align:center;">'.$error.'</div>
                                                        </div>
                                                    </div>
                                                 </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                        </form>                                                                                                       
                                    </div>'; 
                          }

                 }  else {
                    $securitycode = $reqID;

                    $formid = "frmMobileNoVerification_".rand(30,3000);
                 $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$login[0]['MemberID']."'");                                                          
                                return '<div id="otpfrm">
                                            <form method="POST" id="'.$formid.'">
                                            <input type="hidden" value="'.$loginid.'" name="loginId">
                                            <input type="hidden" value="'.$securitycode.'" name="reqId">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Please verify your email</h4>
                                                    <button type="button" class="close" data-dismiss="modal" style="padding-top:5px;">&times;</button>
                                                </div>
                                                 <div class="modal-body">
                                                    <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/email_verification.png"></p>
                                                    <h5 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$memberdata[0]['EmailID'].'</h4>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="col-sm-12">
                                                                <div class="col-sm-3"></div>
                                                                <div class="col-sm-4"><input type="text" value="'.$_POST['email_otp'].'" class="form-control" id="email_otp" maxlength="4" name="email_otp" style="width:50%;width: 117%;font-weight: bold;font-size: 22px;text-align: center;letter-spacing: 10px;font-family:Roboto;"></div>
                                                                <div class="col-sm-2"><button type="button" onclick="EmailOTPVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button></div>
                                                                <div class="col-sm-3"></div>
                                                            </div>
                                                            <div class="col-sm-12"  style="text-align:center;">'.$error.'</div>
                                                        </div>
                                                    </div>
                                                 </div>
                                            <h5 style="text-align:center;color:#ada9a9">Did not receive the verification code?<a onclick="ResendEmailVerificationForm(\''.$formid.'\')" style="cursor:pointer;color:#1694b5">&nbsp;Resend</a><h5> 
                                        </form>                                                                                                       
                                    </div>'; 
                }
            }                                                                                     
         }
  
         public function GetLandingPageProfiles() {
             
             global $mysql;
             $Profiles = array();
            if ($_POST['show']=="male") { 
             $landingpageProfiles = $mysql->select("select ProfileCode from _tbl_profiles where SexCode='SX001' and  ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where Date(`DateTo`)>=Date('".date("Y-m-d")."') and `IsShow`='1')"); 
            } else  if ($_POST['show']=="female") { 
             $landingpageProfiles = $mysql->select("select ProfileCode from _tbl_profiles where SexCode='SX002' and  ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where Date(`DateTo`)>=Date('".date("Y-m-d")."') and `IsShow`='1')"); 
            } else {
             $landingpageProfiles = $mysql->select("select ProfileCode from _tbl_profiles where ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where Date(`DateTo`)>=Date('".date("Y-m-d")."') and `IsShow`='1')"); 
            }
             
             foreach($landingpageProfiles as $profile) {
                $Profiles[] =Profiles::getProfileInfo($profile['ProfileCode'],2);
             } 
             
                 return Response::returnSuccess("success",$Profiles);                                               
         }
		
         public function GetFeatureGroom () {
			global $mysql;
				$landingpageProfiles = $mysql->select("select ProfileCode from _tbl_profiles where SexCode='SX001' and  ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where `IsShow`='1') group by `ProfileCode`"); 
                foreach($landingpageProfiles as $profile) {
					$Profiles[] =Profiles::getProfileInfo($profile['ProfileCode'],2);
				} 
            return Response::returnSuccess("success",$Profiles);                                               
        }
		 
         public function GetFeatureBride (){
			global $mysql;
				$landingpageProfiles = $mysql->select("select ProfileCode from _tbl_profiles where SexCode='SX002' and  ProfileCode in (select ProfileCode from `_tbl_landingpage_profiles` where `IsShow`='1') group by `ProfileCode`"); 
                foreach($landingpageProfiles as $profile) {
					$Profiles[] =Profiles::getProfileInfo($profile['ProfileCode'],2);
				} 
            return Response::returnSuccess("success",$Profiles);                                               
        }
         
         public function GetLandingpageProfileInfo() {
               
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
         
         public function GetLatestUpdates() {
             
             global $mysql,$loginInfo;
             $Latestupdates = $mysql->select("select * from `_tbl_latest_updates` where MemberID='".$loginInfo[0]['MemberID']."' and IsHide='0' ORDER BY LatestID DESC LIMIT 0,5"); 
                 return Response::returnSuccess("success",$Latestupdates);                                               
     } 
                  
         public function HideLatestUpdates() {

             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_latest_updates` set `IsHide`='1' where `LatestID`='".$_POST['LatestID']."' and `MemberID`='".$loginInfo[0]['MemberID']."'");
                       return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Delete</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your Updates  has been deleted successfully.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';

         }
         
         public function GetAllLatestUpdates() {
             
             global $mysql,$loginInfo;
             $Latestupdates = $mysql->select("select * from `_tbl_latest_updates` where MemberID='".$loginInfo[0]['MemberID']."' ORDER BY LatestID DESC"); 
                 return Response::returnSuccess("success",$Latestupdates);                                               
     }
         
         public function GetSearchResultProfiles() {
                global $mysql,$loginInfo;
             
             $result = array();
             $myprofile = $mysql->select("select * from _tbl_profiles");
             if (sizeof($myprofile)==0) {
                return Response::returnSuccess("success",$result); 
             }
             
			 $ReligionCode=array();
             foreach(explode(",",$_POST['Religion']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$_POST['Caste']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
			 
			 $AllCaste =explode(",",$_POST['Caste']);
			 

		if(trim($AllCaste[0])=="All"){ 
			$Profiles = $mysql->select("select * from _tbl_profiles where ( (YEAR(DateofBirth)>='".(DATE("Y")-$_POST['toage'])."') and (YEAR(DateofBirth)<='".(DATE("Y")-$_POST['age'])."') ) and `SexCode`='".$_POST['LookingFor']."' and `ReligionCode` in (".implode(",",$ReligionCode).")");
		} else{
			$Profiles = $mysql->select("select * from _tbl_profiles where ( (YEAR(DateofBirth)>='".(DATE("Y")-$_POST['toage'])."') and (YEAR(DateofBirth)<='".(DATE("Y")-$_POST['age'])."') ) and `SexCode`='".$_POST['LookingFor']."' and `ReligionCode` in (".implode(",",$ReligionCode).") and `CasteCode` in (".implode(",",$CasteCode).")");
        }
             foreach($Profiles as $p) { 
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         }
		 
         public function GetAllRecentlyAdded() {
		  global $mysql,$loginInfo;
                                                                                 
             $result = array();
             
            if($_POST['ProfileFrom']=="HomePage"){
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."' order by `ProfileID` DESC  LIMIT 18");
			}
			if($_POST['ProfileFrom']=="ListPage"){
             $Profiles = $mysql->select("select * from _tbl_profiles where `SexCode`='".(($myprofile[0]['SexCode']=="SX001") ? "SX002" : "SX001")."' order by `ProfileID` DESC  LIMIT 10");
			}
             foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success",$result);
         
		 }
		 
         public function SearchByProfileIDResult() {
            global $mysql,$loginInfo;
             $result = array();
            $Profiles = $mysql->select("select * from _tbl_profiles where `ProfileCode`='".$_POST['profileid']."'");
            foreach($Profiles as $p) {
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             return Response::returnSuccess("success",$result);
         }
		 
		 public function GetAdvanceSearchResultProfiles() {
                global $mysql,$loginInfo;
             $result = array(); 
             $MatrialStatusCode=array();
             foreach(explode(",",$_POST['MaritalStatus']) as $ms) {
               $MatrialStatusCode[] = "'".trim($ms)."'";
             }
			 $ReligionCode=array();
             foreach(explode(",",$_POST['Religion']) as $rc) {
               $ReligionCode[] = "'".trim($rc)."'";
             }
             $CasteCode=array();
             foreach(explode(",",$_POST['Caste']) as $cc) {
               $CasteCode[] = "'".trim($cc)."'";
             }
			 $IncomeRangeCode=array();
             foreach(explode(",",$_POST['IncomeRange']) as $IR) {  
               $IncomeRangeCode[] = "'".trim($IR)."'"; 
             }
             $OccupationCode=array();
             foreach(explode(",",$_POST['Occupation']) as $ON) {
               $OccupationCode[] = "'".trim($ON)."'"; 
             }
             $FamilyTypeCode=array();
             foreach(explode(",",$_POST['FamilyType']) as $FT) {
               $FamilyTypeCode[] = "'".trim($FT)."'";
             }
             $WorkingPlaceCode=array();
             foreach(explode(",",$_POST['WorkingPlace']) as $WP) {
               $WorkingPlaceCode[] = "'".trim($WP)."'";
             }
             $DietCode=array();
             foreach(explode(",",$_POST['Diet']) as $dtc) {
               $DietCode[] = "'".trim($dtc)."'";
             }
             $SmokeCode=array();
             foreach(explode(",",$_POST['Smoke']) as $skc) {
               $SmokeCode[] = "'".trim($skc)."'";
             }
             $DrinkCode=array();
             foreach(explode(",",$_POST['Drink']) as $dkc) {
               $DrinkCode[] = "'".trim($dkc)."'";
             }
             $BodyTypeCode=array();
             foreach(explode(",",$_POST['BodyType']) as $btc) {
               $BodyTypeCode[] = "'".trim($btc)."'";
             }
             $ComplexionCode=array();
             foreach(explode(",",$_POST['Complexion']) as $cmc) {
               $ComplexionCode[] = "'".trim($cmc)."'"; 
             }
			$sql=""; 
			$AllMaritalStatus =explode(",",$_POST['MaritalStatus']);
			if (isset($AllMaritalStatus[0]) && $AllMaritalStatus[0]!="All") {
              $sql .=" and `MaritalStatusCode` in (".implode(",",$MatrialStatusCode).") ";    
            }
			
			$AllReligion =explode(",",$_POST['Religion']);
			if (isset($AllReligion[0]) && $AllReligion[0]!="All") {
              $sql .=" and `ReligionCode` in (".implode(",",$ReligionCode).") ";    
            }
			$AllCaste =explode(",",$_POST['Caste']);
			if (isset($AllCaste[0]) && $AllCaste[0]!="All") {
              $sql .=" and `CasteCode` in (".implode(",",$CasteCode).") ";    
            }
			$AllIncomeRange =explode(",",$_POST['IncomeRange']);
			if (isset($AllIncomeRange[0]) && $AllIncomeRange[0]!="All") {
              $sql .=" and `AnnualIncomeCode` in (".implode(",",$IncomeRangeCode).") ";    
            }
			$AllOccupation =explode(",",$_POST['Occupation']);
			if (isset($AllOccupation[0]) && $AllOccupation[0]!="All") {
              $sql .=" and `OccupationTypeCode` in (".implode(",",$OccupationCode).") ";    
            }
			$AllFamilyType =explode(",",$_POST['FamilyType']); 
			if (isset($AllFamilyType[0])!="All" && $AllFamilyType[0]!="All") {
              $sql .=" and `FamilyTypeCode` in (".implode(",",$FamilyTypeCode).") ";    
            }
			$AllWorkingPlace =explode(",",$_POST['WorkingPlace']);
			if (isset($AllWorkingPlace[0]) && $AllWorkingPlace[0]!="All") {
              $sql .=" and `WorkedCountryCode` in (".implode(",",$WorkingPlaceCode).") ";    
            } 
			$AllDiet =explode(",",$_POST['Diet']);
			if (isset($AllDiet[0]) && $AllDiet[0]!="All") {
              $sql .=" and `DietCode` in (".implode(",",$DietCode).") ";    
            }
			$AllSmoke =explode(",",$_POST['Smoke']);
			if (isset($AllSmoke[0]) && $AllSmoke[0]!="All") {
              $sql .=" and `SmokeCode` in (".implode(",",$SmokeCode).") ";    
            }
			$AllDrink =explode(",",$_POST['Drink']); 
			if (isset($AllDrink[0]) && $AllDrink[0]!="All") {
              $sql .=" and `DrinkCode` in (".implode(",",$DrinkCode).") ";    
            }
			$AllBodyType =explode(",",$_POST['BodyType']);
			if (isset($AllBodyType[0]) && $AllBodyType[0]!="All") {
              $sql .=" and `BodyTypeCode` in (".implode(",",$BodyTypeCode).") ";    
            }
			$AllComplexion =explode(",",$_POST['Complexion']);
			if (isset($AllComplexion[0]) && $AllComplexion[0]!="All") {
              $sql .=" and `ComplexionCode` in (".implode(",",$ComplexionCode).") ";    
            }  
			 
			$Profiles = $mysql->select("select * from _tbl_profiles where ( (YEAR(DateofBirth)>='".(DATE("Y")-$_POST['toage'])."') and (YEAR(DateofBirth)<='".(DATE("Y")-$_POST['age'])."') ) and `SexCode`='".$_POST['LookingFor']."' ".$sql);
             
             foreach($Profiles as $p) { 
                $result[]=Profiles::getProfileInfo($p['ProfileCode'],1); 
             }
             
             return Response::returnSuccess("success"."select * from _tbl_profiles where ( (YEAR(DateofBirth)>='".(DATE("Y")-$_POST['toage'])."') and (YEAR(DateofBirth)<='".(DATE("Y")-$_POST['age'])."') ) and `SexCode`='".$_POST['LookingFor']."' ".$sql,$result);
         }
         
         public function GetMemberDeleteReason() {
             return Response::returnSuccess("success",array("DeleteReason"        => CodeMaster::getData("DELETEREASON")));
         }
         
         public function GetMyNotifications(){
             global $mysql,$loginInfo;
             $Member=$mysql->select("select * from `_tbl_member_profile_modify_notification` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             return Response::returnSuccess("success",isset($Member[0]) ? $Member[0] : array());
         }
         
         public function GetPublishedProfileInformation($ProfileCode="",$rtype="") {
             
             $ProfileCode = $ProfileCode != "" ? $ProfileCode : $_POST['ProfileCode'];
             
             global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$ProfileCode."'");               
             $members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");     
             $PartnersExpectations = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `ProfileID`='".$Profiles[0]['ProfileID']."'");
             $ProfilePhoto =      $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto  from `_tbl_profiles_photos` where `ProfileID`='".$Profiles[0]['ProfileID']."' and `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='0'");                                        
             
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
              
             
             $ProfilePhotoFirst = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where `ProfileID`='".$Profiles[0]['ProfileID']."' and `ProfileCode`='".$ProfileCode."' and `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `PriorityFirst`='1'");                                        
              $Documents = $mysql->select("select concat('".AppPath."uploads/',AttachFileName) as AttachFileName,DocumentType as DocumentType from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0' and `Type`!='EducationDetails' and ProfileCode='".$ProfileCode."'");
              $Educationattachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `IsDelete`='0'  and ProfileID='".$Profiles[0]['ProfileID']."'");
              
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
         
         public function GetViewPublishAttachments() {
             global $mysql,$loginInfo;    
             $SAttachments = $mysql->select("select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and  `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0'");
             
             return Response::returnSuccess("success"."select * from `_tbl_profiles_education_details` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDeleted`='0'",array("Attachments"     =>$SAttachments,
                                                            "EducationDetail" => CodeMaster::getData('EDUCATETITLES'),
                                                            "EducationDegree"  => CodeMaster::getData('EDUCATIONDEGREES')));
         }
         
         public function PublishedAttachDocuments() {

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
                return Response::returnError("Document type attached",$photos);
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
             $photos = $mysql->select("select * from `_tbl_profiles_verificationdocs` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             return Response::returnSuccess("Your Document Information has successfully updated and waiting for verification",$photos);
         }
         
         public function AddPublishProfilePhoto() {

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
             $photos = $mysql->select("select * from `_tbl_profiles_photos` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."' and `IsDelete`='0'");
             return Response::returnSuccess("Your profile photo has successfully updated and waiting for verification",$photos);
         }
         
         
         
         public function GetPublishPartnersExpectaionInformation() {
             global $mysql,$loginInfo;
             $PartnersExpectation = $mysql->select("select * from `_tbl_profiles_partnerexpectation` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['ProfileCode']."'");               
             return Response::returnSuccess("success",array("ProfileInfo"            =>$PartnersExpectation[0],
                                                            "MaritalStatus"          => CodeMaster::getData('MARTIALSTATUS'),
                                                            "Language"               => CodeMaster::getData('LANGUAGENAMES'),
                                                            "Religion"               => CodeMaster::getData('RELINAMES'),
                                                            "Caste"                  => CodeMaster::getData('CASTNAMES'),
                                                            "IncomeRange"            => CodeMaster::getData('INCOMERANGE'),
                                                            "Education"              => CodeMaster::getData('EDUCATETITLES'),
                                                            "EmployedAs"              => CodeMaster::getData('OCCUPATIONS')));
         }
         
         public function EditGeneralInformation() {

             global $mysql, $loginInfo;

             $MaritalStatus  = CodeMaster::getData("MARTIALSTATUS",$_POST['MaritalStatus']);
             $Sex            = CodeMaster::getData("SEX",$_POST['Sex']);
             $MotherTongue   = CodeMaster::getData("LANGUAGENAMES",$_POST['Language']); 
             $Religion       = CodeMaster::getData("RELINAMES",$_POST['Religion']); 
             $Caste          = CodeMaster::getData("CASTNAMES",$_POST['Caste']);  
             $Community      = CodeMaster::getData("COMMUNITY",$_POST['Community']);  
             $Nationality    = CodeMaster::getData("NATIONALNAMES",$_POST['Nationality']);
             $Childrens      = CodeMaster::getData("NUMBEROFBROTHER",$_POST['HowManyChildren']);  
             $ProfileFors    = CodeMaster::getData("PROFILESIGNIN",$_POST['ProfileFor']);  
              $ProfileCode   = SeqMaster::GetNextPublishProfileCode();
              
             $PublishProfileCode = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and ProfileCode='".$_POST['Code']."'");  
             $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];           
             
               
            $InsertSql = array("ProfileCode"            => $ProfileCode, 
                               "PublishProfileID"       => $PublishProfileCode[0]['ProfileID'],
                               "PublishProfileCode"     => $PublishProfileCode[0]['ProfileCode'],
                               "ProfileFor"             => $_POST['ProfileFor'],
                               "ProfileName"            => $_POST['ProfileName'],
                               "DateofBirth"            => $dob,
                               "SexCode"                => $_POST['Sex'],
                               "Sex"                    => $Sex[0]['CodeValue'],
                               "MaritalStatusCode"      => $_POST['MaritalStatus'],
                               "MaritalStatus"          => $MaritalStatus[0]['CodeValue'],
                               "ChildrenCode"           => '0',     
                               "Children"               => '0',
                               "IsChildrenWithyou"      => '0',
                               "MotherTongueCode"       => $_POST['Language'],
                               "MotherTongue"           => $MotherTongue[0]['CodeValue'],
                               "ReligionCode"           => $_POST['Religion'],
                               "Religion"               => $Religion[0]['CodeValue'],
                               "OtherReligion"          => '',
                               "CasteCode"              => $_POST['Caste'],
                               "Caste"                  => $Caste[0]['CodeValue'],
                               "OtherCaste"             => '',
                               "SubCaste"               => $_POST['SubCaste'],
                               "CommunityCode"          => $_POST['Community'],
                               "Community"              => $Community[0]['CodeValue'],
                               "NationalityCode"        => $_POST['Nationality'],
                               "Nationality"            => $Nationality[0]['CodeValue'],
                               "MainEducation"          => $_POST['MainEducation'],
                               "LastUpdatedOn"          => date("Y-m-d H:i:s"),
                               "AboutMe"                => $_POST['AboutMe'],
                               "MemberID"                =>$loginInfo[0]['MemberID']); 
                               
        if ($_POST['Religion']=="RN009") {
            $DuplicateReligionNames = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='RELINAMES' and CodeValue='".trim($_POST['ReligionOthers'])."'");
            if (sizeof($DuplicateReligionNames)>0) {
                return Response::returnError("Religion Already Exists");    
            }
            $InsertSql["OtherReligion"] = $_POST['ReligionOthers'];
        }
        if ($_POST['Caste']=="CSTN248") {
            $DuplicateCasteName = $mysql->select("SELECT * FROM _tbl_master_codemaster WHERE HardCode='CASTNAMES' and CodeValue='".trim($_POST['OtherCaste'])."'");
            if (sizeof($DuplicateCasteName)>0) {
                return Response::returnError("Caste  Already Exists");    
            }
            $InsertSql["OtherCaste"] = $_POST['OtherCaste'];
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
             $InsertSql["ChildrenCode"] = $_POST['HowManyChildren'];
             $InsertSql["Children"] = $Childrens[0]['CodeValue'];
             $InsertSql["IsChildrenWithyou"] = $Childrens[0]['ChildrenWithYou'];
        }
        $id = $mysql->insert("_tbl_publish_profiles",$InsertSql);
        $sql=$mysql->qry;     
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
         
         public function AddPublishEducationalDetails() {
             global $mysql,$loginInfo;
             
              if (!(trim($_POST['Educationdetails']))>0) {                                                                               
                 return Response::returnError("Please select education details");
             }
             if (!(trim($_POST['EducationDegree']))>0) {                                
                 return Response::returnError("Please select education degree ");
             }
             $profile = $mysql->select("select * from _tbl_profiles where ProfileCode='".$_POST['Code']."'");                         
             $id = $mysql->insert("_tbl_publish_profiles_education_details",array("EducationDetails" => $_POST['Educationdetails'],
                                                                  "EducationDegree"  => $_POST['EducationDegree'],
                                                                  "EducationRemarks"  => $_POST['EducationRemarks'],
                                                                  "FileName"            => $_POST['File'],
                                                                  "ProfileID"        => $profile[0]['ProfileID'],
                                                                  "ProfileCode"        => $_POST['Code'],
                                                                  "MemberID"         => $loginInfo[0]['MemberID']));
             
             return (sizeof($id)>0) ? Response::returnSuccess("success",$_POST)
                                    : Response::returnError("Access denied. Please contact support");   
         }
         
         public function EditPublishOccupationDetails() {

             global $mysql,$loginInfo;

             $EmployedAs       = CodeMaster::getData("OCCUPATIONS",$_POST["EmployedAs"]) ;
             $OccupationType   = CodeMaster::getData("Occupation",$_POST["OccupationType"]) ;
             $TypeofOccupation = CodeMaster::getData("TYPEOFOCCUPATIONS",$_POST["TypeofOccupation"]) ;
             $IncomeRange      = CodeMaster::getData("INCOMERANGE",$_POST["IncomeRange"]) ;
             $Country          = CodeMaster::getData("CONTNAMES",$_POST['WCountry']);
             $updateSql = "update `_tbl_publish_profiles` set  `EmployedAsCode`       = '".$_POST['EmployedAs']."',
                                                            `EmployedAs`           = '".$EmployedAs[0]['CodeValue']."',
                                                            `OccupationTypeCode`   = '".$_POST['OccupationType']."',
                                                            `OccupationType`       = '".$OccupationType[0]['CodeValue']."',
                                                            `TypeofOccupationCode` = '".$_POST['TypeofOccupation']."',
                                                            `TypeofOccupation`     = '".$TypeofOccupation[0]['CodeValue']."',
                                                            `AnnualIncomeCode`     = '".$_POST['IncomeRange']."',
                                                            `WorkedCountryCode`     = '".$_POST['WCountry']."',
                                                            `WorkedCountry`     = '".$Country[0]['CodeValue']."',
                                                            `OccupationAttachFileName`     = '".$_POST['File']."',
                                                            `OccupationDetails`   = '".$_POST['OccupationDetails']."',
                                                            `LastUpdatedOn`     = '".date("Y-m-d H:i:s")."',
                                                            `AnnualIncome`         = '".$IncomeRange[0]['CodeValue']."' where  `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'";
             $mysql->execute($updateSql);  
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
                                                             "ActivityType"   => 'Occupationdetailsupdated.',
                                                             "ActivityString" => 'Occupation Details Updated.',                           
                                                             "SqlQuery"       => base64_encode($updateSql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['Code']."'");      

             return Response::returnSuccess("success",array("ProfileInfo"      => $Profiles[0],
                                                            "EmployedAs"       => CodeMaster::getData('OCCUPATIONS'),
                                                            "Occupation"       => CodeMaster::getData('Occupation'),
                                                            "TypeofOccupation" => CodeMaster::getData('TYPEOFOCCUPATIONS'),
                                                            "IncomeRange"      => CodeMaster::getData('INCOMERANGE')));
         }
         
         
		 
		 public function GetMyRecentlyViewed($ProfileCode) {
			 
			global $mysql;           
			$result = $mysql->select("select `ProfileCode` from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$ProfileCode."' AND `MemberID`>0 AND `ProfileID`>0  group by `ProfileCode`"); 
			return $result;
		 }
		
         public function GetWhoRecentlyViewedMyProfile($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select `VisterProfileCode` from `_tbl_profiles_lastseen` where `ProfileCode` = '".$ProfileCode."' AND `VisterMemberID`>0 AND `VisterProfileID`>0  group by `VisterProfileCode`"); 
			return $result;
		 }
		
         public function GetMyFavorited($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode`='".$ProfileCode."'");       
			return $result;
		 }
		
         public function GetWhoFavoritedMyProfile($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode`='".$ProfileCode."'");       
			return $result;
		 }
		
         public function GetMutualProfilesCount($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1' and `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$ProfileCode."')");       
			return $result;
		 }
		 
		 public function GetMyShortListed($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_shortlists` where `IsVisible`='1' and `IsShortList` ='1' and  `VisterProfileCode`='".$ProfileCode."'");       
			return $result;
		 }
		
         public function DashboardCounts() {
              
             global $mysql,$loginInfo; 
             $myProfile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'");                         
			
			  
             if (isset($myProfile[0]['ProfileCode'])) {   
			
				return Response::returnSuccess("success",array(/*"MyRecentlyViewedCount"=> isset($RecentlyViewed[0]) ? $RecentlyViewed[0] : array(),
                                                                "RecentlyWhoViewed"     => isset($RecentlyWhoViewed) ? $RecentlyWhoViewed : array(),*/
                                                                "MyRecentlyViewed"      => sizeof($this->GetMyRecentlyViewed($myProfile[0]['ProfileCode'])), 
                                                                "MyRecentlyWhoViewed"   => sizeof($this->GetWhoRecentlyViewedMyProfile($myProfile[0]['ProfileCode'])), 
                                                                "MyFavorited"           => sizeof($this->GetMyFavorited($myProfile[0]['ProfileCode'])), 
                                                                "WhoFavorited"          => sizeof($this->GetWhoFavoritedMyProfile($myProfile[0]['ProfileCode'])), 
                                                                "MyShortListed"         => sizeof($this->GetMyShortListed($myProfile[0]['ProfileCode'])),
                                                                "WhoShortListed"        => Shortlist::WhoShortlisted($myProfile[0]['ProfileCode']),
                                                                "Mutual"         		=> sizeof($this->GetMutualProfilesCount($myProfile[0]['ProfileCode']))
                                                                )); 
             } else {
                 return Response::returnSuccess("success",array("MyRecentlyViewedCount"  => 0, 
                                                                "RecentlyWhoViewed"      => 0,
                                                                "MyFavorited"            => 0,
                                                                "WhoFavorited"           => 0,
                                                                "Mutual"                 => 0));
             }
         }
         
         public function GetMemberVerfiedDetails(){
             global $mysql,$loginInfo;
             $Member=$mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             $Documents=$mysql->select("select * from `_tbl_member_documents` where `MemberID`='".$loginInfo[0]['MemberID']."'"); 
             
             return Response::returnSuccess("success"."select * from `_tbl_member_documents` where `MemberID`='".$loginInfo[0]['MemberID']."'",array("Member"=>$Member[0],"Documents"=>$Documents[0]));
         }
         
         public function SendToInterest() {
             
             global $mysql,$loginInfo;
             
             $Profiles = $mysql->select("select SexCode,MemberID,ProfileID,ProfileCode from `_tbl_profiles` where ProfileCode='".$_GET['ProfileCode']."'"); 
             if (sizeof($Profiles)==0) {
                return Response::returnError("Couldn't favorite, please contact support team"); 
             }
             
             $visitorsDetails =$mysql->select("select ProfileID,ProfileCode from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
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
             
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Profiles[0]['MemberID']."'");
          
             $id = $mysql->insert("_tbl_profiles_favourites",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "SendInterestMemberID"     => $loginInfo[0]['MemberID'],
                                                                   "SendInterestProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "SendInterestProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "InterestedOn"           => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                        "ProfileID"          => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"     => $loginInfo[0]['MemberID'],
                                                        "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"       => $ProfileThumbnail,
                                                        "Subject"            => "has send interest request",
                                                        "ViewedOn"           => date("Y-m-d H:i:s")));
                                                            
             return Response::returnSuccess($Profiles[0]['ProfileCode']." has send interest request.");                                               
         }
         
         public function DeleteOccupationAttachmentOnly() {
             
             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_draft_profiles` set `OccupationAttachFileName` = '' ,`OccupationAttachmentType` = '0' where `ProfileID`='".$_POST['ProfileID']."' and`ProfileCode`='".$_POST['ProfileCode']."' and `MemberID`='".$loginInfo[0]['MemberID']."'");
             return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Remove</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Attachment has been removed successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MyProfiles/Draft/Edit/OccupationDetails/'.$_POST['ProfileCode'].'.htm" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';                             

         }  
         
         public function ViewOrders() {
             global $mysql,$loginInfo;
             $Orders = $mysql->select("select * from `_tbl_orders` where `OrderByMemberID`='".$loginInfo[0]['MemberID']."' and `OrderNumber`='".$_POST['Code']."'");
             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Orders[0]['OrderByMemberID']."'");
             $plan =$mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Orders[0]['OrderValue']."'");
             return Response::returnSuccess("success",array("Order" => $Orders[0],
                                                            "Member" => $Member[0],
                                                            "Plan"   => $plan));
         }
         
         public function ViewOrdersAmountForTransaction() {
             global $mysql,$loginInfo;
             $Orders = $mysql->select("select * from `_tbl_orders` where `OrderByMemberID`='".$loginInfo[0]['MemberID']."' and OrderNumber='".$_POST['Code']."'");
             $MemberWallet = number_format($this->getAvailableBalance($loginInfo[0]['MemberID']),2);
             return Response::returnSuccess("success",array("Order" => $Orders[0],
                                                            "Wallet" => $MemberWallet));
         }
         
         public function GetWalletBankRequests() {
             
             global $mysql,$loginInfo;
             $sql = "SELECT * From `_tbl_wallet_transactions` ";
             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."Where `MemberID`='". $loginInfo[0]['MemberID']."' and `IsMember`='1' order by `TxnID` DESC"));    
             }
         }
         
         public function AddMemberBasicSearchDetails() {

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
             
             $profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $Member = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'"); 
              
                   $id = $mysql->insert("_tbl_member_basic_search",array("MemberID"          => $loginInfo[0]['MemberID'],
                                                                         "ProfileID"         => $profile[0]['ProfileID'],
                                                                         "Sex"               => $Member[0]['Sex'],
                                                                         "MaritalStatusCode" => substr($MaritalStatus_SoftCode,0,strlen($MaritalStatus_SoftCode)-2),
                                                                         "MaritalStatus"     => substr($MaritalStatus_CodeValue,0,strlen($MaritalStatus_CodeValue)-2),
                                                                         "ReligionCode"      => substr($Religion_SoftCode,0,strlen($Religion_SoftCode)-2),
                                                                         "Religion"          => substr($Religion_CodeValue,0,strlen($Religion_CodeValue)-2),
                                                                         "CasteCode"         => substr($Caste_SoftCode,0,strlen($Caste_SoftCode)-2),
                                                                         "Caste"             => substr($Caste_CodeValue,0,strlen($Caste_CodeValue)-2),
                                                                         "SearchName"        => "ABCD",
                                                                         "SearchFrom"        => "Member",
                                                                         "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success",array("ReqID"=>$id));
               // echo "<script>location.href='../BasicSearchResult/".$id.".htm?Req=BasicSearchResult'</script>";
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
                                                                         
         }
         
         public function AddMemberProfileSearchByProfileID() {

             global $mysql,$loginInfo;    
           
             $profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
              
                   $id = $mysql->insert("_tbl_member_search_by_profileid",array("MemberID"          => $loginInfo[0]['MemberID'],
                                                                                "ProfileID"         => $_POST['profileid'],
                                                                                "SearchName"        => "ABCD",
                                                                                "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success",array("ReqID"=>$id));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
                                                                         
         }
         
         public function AddMemberAdvanceSearchDetails() {

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
             
             $profile = $mysql->select("select * from _tbl_profiles where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $Member = $mysql->select("select * from _tbl_members where MemberID='".$loginInfo[0]['MemberID']."'"); 
              
                  $id = $mysql->insert("_tbl_member_advance_search",array("MemberID"         => $loginInfo[0]['MemberID'],
                                                                         "ProfileID"         => $profile[0]['ProfileID'],
                                                                         "Sex"               => $Member[0]['Sex'],
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
                                                                         "SearchFrom"        => "Member",
                                                                         "SearchRequestedOn" => date("Y-m-d H:i:s"))) ;
              
               if (sizeof($id)>0) {
                   return Response::returnSuccess("success",array("ReqID"=>$id));
               // echo "<script>location.href='../BasicSearchResult/".$id.".htm?Req=BasicSearchResult'</script>";
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
                                                                         
         }
         
         public function CollectPaymentFromWallet() {
             
             
             global $mysql,$loginInfo;
             
             $Orders = $mysql->select("select * from `_tbl_orders` where `OrderByMemberID`='".$loginInfo[0]['MemberID']."' and `OrderNumber`='".$_POST['Code']."'");
             $Profiles = $mysql->select("select * from `_tbl_profiles` where `ProfileCode`='".$Orders[0]['OrderedProfileCode']."'");
             $OwnProfile = $mysql->select("select * from `_tbl_profiles` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");
             
             if (sizeof($Orders)==0) {
                  return Response::returnError("Order process failed. Invalid order number."); 
             }
             
             if (sizeof($Orders)>1) {
                 return Response::returnError("Order process failed. Please contact administrator.");  
             }
             
             if ($Orders[0]['IsPaid']==1) {
                return Response::returnError("Order process failed. It may be already processed.");   
             }
             
             $WalletBalance=$this->getAvailableBalance($loginInfo[0]['MemberID']);
             if($WalletBalance < $Orders[0]['OrderValue']) {
                return Response::returnError("Order process failed. You don't have sufficiant balance in your wallet."); 
             }
             
             $Plan = $mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Orders[0]['OrderValue']."'");
             
             $id=$mysql->insert("_tbl_wallet_transactions",array("MemberID"         => $loginInfo[0]['MemberID'],
                                                                 "MEMFRANCode"      => "",        
                                                                 "Particulars"      => 'Payments/Odr: '. $Orders[0]['OrderNumber']."/MEMUpgrade: ". $Plan[0]['PlanName'],                    
                                                                 "Credits"          => "0",                    
                                                                 "Debits"           => $Orders[0]['OrderValue'], 
                                                                 "AvailableBalance" => $WalletBalance-$Orders[0]['OrderValue'],                   
                                                                 "TxnDate"          => date("Y-m-d H:i:s"),
                                                                 "IsMember"         => "1")); 
             
             if (sizeof($id)>0) {
				 
				$date = date_create(date("Y-m-d"));					
				$e = $Plan[0]['Decreation']. " days";				
				date_add($date,date_interval_create_from_date_string($e));
				$endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
				$endingdate= date_format($date,"Y-m-d");
				
				$mysql->insert("_tbl_profile_credits",array("MemberID"     		   => $loginInfo[0]['MemberID'],
															"MemberCode"           => $OwnProfile[0]['MemberCode'],
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
															"OrderID"              => $Orders[0]['OrderID'],
															"OrderCode"            => $Orders[0]['OrderCode'],
															"MemberPlanID"         => $Plan[0]['PlanID'],
															"MemberPlanCode"       => $Plan[0]['PlanCode'],
															"PlanName"             => $Plan[0]['PlanName'], 
															"TxnDate"         	   => date("Y-m-d H:i:s"),
															"StartingDate"         => date("Y-m-d H:i:s"),
															"EndingDate"           => $endingdate));
                 
                 // Invoice Table
                 $invoiceCode=SeqMaster::GetNextInvoiceCode(); 
				 
				 
                 
                 $invoiceid = $mysql->insert("_tbl_invoices",array("OrderID"              => $Orders[0]['OrderID'],
                                                                   "OrderDate"            => DATE("Y-m-d H:i:s"),
                                                                   "OrderNumber"          => $Orders[0]['OrderNumber'],
                                                                   "InvoiceDate"          => DATE("Y-m-d H:i:s"),
                                                                   "InvoiceNumber"        => $invoiceCode,
                                                                   "MemberID"             => $loginInfo[0]['MemberID'],
                                                                   "MemberCode"           => $Member[0]['MemberCode'],
                                                                   "ProfileID"            => $OwnProfile[0]['ProfileID'],
                                                                   "ProfileCode"          => $OwnProfile[0]['ProfileCode'],
                                                                   "MemberName"           => $Member[0]['MemberName'],
                                                                   "EmailID"              => $Member[0]['EmailID'],
                                                                   "MobileNumber"         => $Member[0]['MobileNumber'],
                                                                   "AddressLine1"         => $OwnProfile[0]['AddressLine1'],
                                                                   "AddressLine2"         => $OwnProfile[0]['AddressLine2'],
                                                                   "AddressLine3"         => $OwnProfile[0]['AddressLine3'],
                                                                   "Pincode"              => $OwnProfile[0]['Pincode'],
                                                                   "InvoiceValue"         => $Orders[0]['OrderValue'],
                                                                   "Createdon"            => DATE("Y-m-d H:i:s"),
                                                                   "CreatedBy"            => $loginInfo[0]['MemberID'],
                                                                   "PaidAmount"           => $Orders[0]['OrderValue']));
                                                                   
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Invoice'");
                 
                  // Order Table Update 
                   $mysql->execute("update `_tbl_orders` set  `InvoiceID`       = '".$invoiceid."',
                                                           `InvoiceNumber`   = '".$invoiceCode."', 
                                                           `IsPaid`          = '1' where  `OrderNumber`='".$Orders[0]['OrderNumber']."'");
             
                 // Invoice Item Table
                 $invoiceitemid = $mysql->insert("_tbl_invoices_items",array("InvoiceID"      => $invoiceid,
                                                                             "AddedOn"        => date("Y-m-d H:i:s"),
                                                                             "ProfileID"      => $OwnProfile[0]['ProfileID'],
                                                                             "ProfileCode"    => $OwnProfile[0]['ProfileCode'],
                                                                             "MemberID"       => $Member[0]['MemberID'],
                                                                             "MemberCode"     => $Member[0]['MemberCode'],
                                                                             "MemberName"     => $Member[0]['MemberName'],
                                                                             "ProductID"      => $Plan[0]['PlanID'],
                                                                             "ProductCode"    => $Plan[0]['PlanCode'],
                                                                             "ProductName"    => $Plan[0]['PlanName'],
                                                                             "Qty"            => "1",
                                                                             "Amount"         => $Plan[0]['Amount'],
                                                                             "TAmount"        => $Plan[0]['Amount'],
                                                                             "ServiceCharge"  => "0",
                                                                             "Remarks"        => "0"));   
             
                 // Download Table
                /* $Did = $mysql->insert("_tbl_profile_download",array("MemberID"             =>  $Member[0]['MemberID'],
                                                                     "ProfileCode"          =>  $OwnProfile[0]['ProfileCode'],
                                                                     "PartnerProfileCode"   =>  $Profiles[0]['ProfileCode'],
                                                                     "DownLoadOn"           =>  date("Y-m-d H:i:s"))) ;  
												*/
                 // Receipt Table
                 
                 $receiptCode=SeqMaster::GetNextReceiptCode(); 
                 
                 $receiptid = $mysql->insert("_tbl_receipts",array("InvoiceID"            => $invoiceid,
                                                                   "InvoiceNumber"        => $invoiceCode,
                                                                   "ReceiptDate"          => date("Y-m-d H:i:s"),
                                                                   "ReceiptNumber"        => $receiptCode,
                                                                   "MemberID"             => $loginInfo[0]['MemberID'],
                                                                   "MemberCode"           => $Member[0]['MemberCode'],
                                                                   "ProfileID"            => $OwnProfile[0]['ProfileID'],
                                                                   "ProfileCode"          => $OwnProfile[0]['ProfileCode'],
                                                                   "MemberName"           => $Member[0]['MemberName'],
                                                                   "EmailID"              => $Member[0]['EmailID'],
                                                                   "MobileNumber"         => $Member[0]['MobileNumber'],
                                                                   "AddressLine1"         => $OwnProfile[0]['AddressLine1'],
                                                                   "AddressLine2"         => $OwnProfile[0]['AddressLine2'],
                                                                   "AddressLine3"         => $OwnProfile[0]['AddressLine3'],
                                                                   "Pincode"              => $OwnProfile[0]['Pincode'],
                                                                   "ReceiptAmount"        => $Orders[0]['OrderValue'],
                                                                   "Createdon"            => DATE("Y-m-d H:i:s"),
                                                                   "CreatedBy"            => $loginInfo[0]['MemberID'],
                                                                   "Remarks"              =>"0"));
                                                                   
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Receipt'");
                 
                 // Member Latest Updates
                 $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$Profiles[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
               
               if (sizeof($ProfileThumb)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
                } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
                 }
                 
                        $mysql->insert("_tbl_latest_updates",array("MemberID"           => $loginInfo[0]['MemberID'],
                                                                   "ProfileID"          => $OwnProfile[0]['ProfileID'],
                                                                   "ProfileCode"        => $OwnProfile[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $Profiles[0]['MemberID'],
                                                                   "VisterProfileID"    => $Profiles[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $Profiles[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "download profile",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
                 
                 // Opp Member Latest Updates
                 $ProfileThumbs = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$OwnProfile[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
               
               if (sizeof($ProfileThumbs)==0) {
                if ($Profiles[0]['SexCode']=="SX002"){
                    $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                } else { 
                    $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                }
                } else {
                 $ProfileThumbnail = getDataURI($ProfileThumbs[0]['ProfilePhoto']); //$ProfileThumb[0]['ProfilePhoto'];                                              
                 }
                         $mysql->insert("_tbl_latest_updates",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $OwnProfile[0]['MemberID'],
                                                                   "VisterProfileID"    => $OwnProfile[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $OwnProfile[0]['ProfileCode'],
                                                                   "ProfilePhoto"       => $ProfileThumbnail,
                                                                   "Subject"            => "has download your profile",
                                                                   "ViewedOn"           => date("Y-m-d H:i:s")));
                 
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
             } else{
                 return Response::returnError("Order process failed. Invalid wallet request.");   
             }
         }
         
         public function GetOrderInvoiceReceiptDetails() {
             
             global $mysql,$loginInfo;
             
             if (isset($_POST['Request']) && $_POST['Request']=="Order") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_orders` Where `OrderByMemberID`='". $loginInfo[0]['MemberID']."' order by `OrderID` DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Invoice") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_invoices` Where `MemberID`='". $loginInfo[0]['MemberID']."' order by `InvoiceID` DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Receipt") {
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_receipts` Where `MemberID`='". $loginInfo[0]['MemberID']."' order by `ReceiptID` DESC"));    
             }
         }

         public function ViewOrderInvoiceReceiptDetails() {
             
             global $mysql,$loginInfo;
             
             $Order=$mysql->select("SELECT * From `_tbl_orders` Where `OrderByMemberID`='".$loginInfo[0]['MemberID']."' and `OrderNumber`='".$_POST['Code']."'"); 
              $plan =$mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Order[0]['OrderValue']."'"); 
             $Invoice=$mysql->select("SELECT * From `_tbl_invoices` Where `MemberID`='". $loginInfo[0]['MemberID']."' and `InvoiceNumber`='".$_POST['Code']."'");
             $Invoiceplan =$mysql->select("select * from `_tbl_member_plan` where `Amount`='".$Invoice[0]['InvoiceValue']."'"); 
             $Receipt=$mysql->select("SELECT * From `_tbl_receipts` Where `MemberID`='". $loginInfo[0]['MemberID']."' and `ReceiptNumber`='".$_POST['Code']."'"); 
              return Response::returnSuccess("success",array("Order"   =>$Order[0],
                                                             "Plan" =>$plan,
                                                             "InvoicePlan" =>$Invoiceplan,
                                                             "Invoice" =>$Invoice[0],
                                                             "Receipt" =>$Receipt[0]));
         }

         public function CancelOrder() {

             global $mysql,$loginInfo;
             $mysql->execute("update `_tbl_orders` set `IsCancelled`='1' where `OrderNumber`='".$_POST['OrderNumber']."' and `MemberID`='".$loginInfo[0]['MemberID']."'");
                       return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation For Cancell</h4>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" style="width:18%"></p>
                            <h5 style="text-align:center;color:#ada9a9">Your order  has been cancel successfully.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'MyAccounts/MyOrders" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a> <h5>
                       </div>';                            

         }
         
         public function AddToShortList() {
             
             global $mysql,$loginInfo;    
             
             $PartnerProfile = Profiles::ActiveProfileInfoByProfileCode($_GET['ProfileCode'],array("SexCode","MemberID","ProfileID","ProfileCode")); 
             if (sizeof($PartnerProfile)==0) {
                return Response::returnError("Couldn't be process to add shortlist, please contact support team"); 
             }
             
             $MyProfile = Profiles::ActiveProfileInfoByMemberID($loginInfo[0]['MemberID'],array("SexCode","MemberID","ProfileID","ProfileCode"));
             if (sizeof($MyProfile)==0) {
                return Response::returnError("Couldn't be process. You don't have active profile."); 
             }
 
             if (Shortlist::AddToShortList($MyProfile, $PartnerProfile, $success, $error)) {
                return Response::returnSuccess($PartnerProfile[0]['ProfileCode']." has shortlisted.");  
             } else {
                return Response::returnError($error);  
             }
         }
		 
		 public function RemoveFromShortList() {
             
             global $mysql,$loginInfo;
             
             $Profiles = $mysql->select("select MemberID,ProfileID,ProfileCode,SexCode from `_tbl_profiles` where ProfileCode='".$_GET['ProfileCode']."'"); 
             if (sizeof($Profiles)==0) {
                return Response::returnError("Couldn't able to remove from shortlisted, please contact support team"); 
             }
             
             $visitorsDetails =$mysql->select("select ProfileID,ProfileCode from `_tbl_profiles` where MemberID='".$loginInfo[0]['MemberID']."'"); 
             $ProfileThumb = $mysql->select("select concat('".AppPath."uploads/',ProfilePhoto) as ProfilePhoto from `_tbl_profiles_photos` where   `ProfileCode`='".$visitorsDetails[0]['ProfileCode']."' and `IsDelete`='0' and `MemberID`='".$loginInfo[0]['MemberID']."' and `PriorityFirst`='1'");
             if (sizeof($ProfileThumb)==0) {
                 if ($Profiles[0]['SexCode']=="SX002"){
                     $ProfileThumbnail = AppPath."assets/images/noprofile_female.png";
                 } else { 
                     $ProfileThumbnail = AppPath."assets/images/noprofile_male.png";
                 }
             } else {
                 $ProfileThumbnail = getDataURI($ProfileThumb[0]['ProfilePhoto']); 
             }
             $mysql->execute("update `_tbl_profiles_shortlists` set `IsVisible`='0' where `IsShortList`='1' and  ProfileID='".$Profiles[0]['ProfileID']."' and VisterMemberID='".$loginInfo[0]['MemberID']."'");
          
             $FirstTime = $mysql->select("select * from `_tbl_profiles_shortlists` where `VisterMemberID`='".$loginInfo[0]['MemberID']."'");
             if(sizeof($FirstTime)==0){
             
             $FirstTimeProfileRemoveShortList = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='FirstTimeProfileRemoveShortList'");
             
             if($FirstTimeProfileRemoveShortList[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RemoveShortlistProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RemoveShortListProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'], 
                                        "Message"  => $content),$mailError);
             }
             if($FirstTimeProfileRemoveShortList[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has remove from shortlist. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             }
             }
          
          
             $EveryTimeProfileRemoveShortList = $mysql->select("select * from `_tbl_general_settings` where  `Settings`='EveryTimeProfileRemoveShortList'");
             
             if($EveryTimeProfileRemoveShortList[0]['Email']=="1"){
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RemoveShortListProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$Profiles[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$Profiles[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RemoveShortListProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             }
             if($EveryTimeProfileRemoveShortList[0]['SMS']=="1"){
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$Profiles[0]['PersonName'].") has remove from shortlist. Your Profile ID is ".$Profiles[0]['ProfileCode']);
             }
          
             $id = $mysql->insert("_tbl_profiles_shortlists",array("MemberID"           => $Profiles[0]['MemberID'],
                                                                   "ProfileID"          => $Profiles[0]['ProfileID'],
                                                                   "ProfileCode"        => $Profiles[0]['ProfileCode'],
                                                                   "VisterMemberID"     => $loginInfo[0]['MemberID'],
                                                                   "VisterProfileID"    => $visitorsDetails[0]['ProfileID'],
                                                                   "VisterProfileCode"  => $visitorsDetails[0]['ProfileCode'],
                                                                   "ViewedOn"           => date("Y-m-d H:i:s"),
                                                                   "IsShortList"         => "0",
                                                                   "IsVisible"          => "0",
                                                                   "IsShortListOn"       => date("Y-m-d H:i:s")));
                                                                   
             $mysql->insert("_tbl_latest_updates",array("MemberID"          => $Profiles[0]['MemberID'],
                                                        "ProfileID"         => $Profiles[0]['ProfileID'],
                                                        "ProfileCode"       => $Profiles[0]['ProfileCode'],
                                                        "VisterMemberID"    => $loginInfo[0]['MemberID'],
                                                        "VisterProfileID"   => $visitorsDetails[0]['ProfileID'],
                                                        "VisterProfileCode" => $visitorsDetails[0]['ProfileCode'],
                                                        "ProfilePhoto"      => $ProfileThumbnail,
                                                        "Subject"           => "has remove shortlist your profile.",
                                                        "ViewedOn"          => date("Y-m-d H:i:s")));
             return Response::returnSuccess($Profiles[0]['ProfileCode']." has remove shorlist.");      
          }
 
	    public function SendOtpForEditSubmittedProfile($errormessage="",$otpdata="",$reqID="",$ProfileCode="") {
        global $mysql,$mail,$loginInfo;      
        
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
        if ($reqID=="")      {
            $otp=rand(1000,9999);
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToEditForSubmittedProfile'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#otp#",$otp,$content);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                       "Category" => "RequestToEditForSubmittedProfile",
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
                                                                                      "Type" 		  =>"RequestToEditForSubmittedProfile",
                                                                                      "messagedon"    =>date("Y-m-d h:i:s"))) ;
                        $formid = "frmEditForSubmittedProfileOTPVerification_".rand(30,3000);
                        $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
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
	
	    public function SubmittedProfileforEditOTPVerification() {
        
		global $mysql,$loginInfo ;
             
        $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");   
        $otpInfo = $mysql->select("select * from `_tbl_verification_code` where `RequestID`='".$_POST['reqId']."'");
            if (strlen(trim($_POST['EditOtp']))==4 && ($otpInfo[0]['SecurityCode']==$_POST['EditOtp']))  {
				
				$mysql->execute("update `_tbl_draft_profiles` set `RequestToVerify` = '0' where `MemberID`='".$loginInfo[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");
				
				$mysql->insert("_tbl_request_edit",array("MemberID"                		=> $loginInfo[0]['MemberID'],
														 "MemberCode"            		=> $member[0]['MemberCode'],
														 "DraftProfileID"            	=> $data[0]['ProfileID'],
														 "DraftProfileCode"            	=> $data[0]['ProfileCode'],
														 "RequestToEditFromSubmitted"   => "1",
														 "RequestToEditFromSubmittedOn" => date("Y-m-d H:i:s")));
         
				$id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $loginInfo[0]['MemberID'],
																"ActivityType"   => 'EditForSubmittedProfile.',
																"ActivityString" => 'Edit For Submitted Profile.',
																"SqlQuery"       => base64_encode($updateSql),
																//"oldData"      => base64_encode(json_encode($oldData)),
																"ActivityOn"     => date("Y-m-d H:i:s")));
				return Response::returnSuccess("Your submitted profile has been changed to draft profile.",array("FileName"=>$_POST['FileName'],"ProfileCode"=>$_POST['ProfileCode']));
            } else {
                 return $this->SendOtpForEditSubmittedProfile("<span style='color:red'>Invalid verification code.</span>",$_POST['EditOtp'],$_POST['reqId'],$_POST['ProfileCode']);
            } 
	}
	
	    public function ResendSendOtpForSubmittedProfileProfileForEdit($errormessage="",$otpdata="",$reqID="",$ProfileCode="") {
        
		global $mysql,$mail,$loginInfo;   
			
		$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'"); 
		$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");  
        
		$resend = $mysql->insert("_tbl_resend",array("MemberID" =>$member[0]['MemberID'],
                                                     "Reason"   =>"Resend Edit For Submitted Profile Verfication Code",
                                                     "ResendOn" =>date("Y-m-d h:i:s"))) ;
		if ($reqID=="")      {
            $otp=rand(1000,9999);
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToEditForSubmittedProfile'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#otp#",$otp,$content);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                       "Category" => "RequestToEditForSubmittedProfile",
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
                $memberdata = $mysql->select("select * from `_tbl_members` where `MemberID`='".$loginInfo[0]['MemberID']."'");                                                          
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
    
 }  
//4084   5500

// html 
//ResendSendOtpForSubmittedProfileProfileForEdit
//SendOtpForEditSubmittedProfile
//ResendEmailVerificationForm
//ChangeMobileNumberFromVerificationScreen  
//ChangeMobileNumber 
//MobileNumberVerificationForm 
//MobileNumberOTPVerification  
//ChangeEmailFromVerificationScreen
//ChangeEmailID    EmailVerificationForm    
//EmailOTPVerification 
 //OverallSendOtp 
 //ViewProfileOTPVerification  
 //VerifyProfileforPublish  
 //SendOtpForProfileforPublish
//ResendSendOtpForProfileforPublish 
//DeleteProfile 
//DeleteAttach
//DeleteAttach  
//DeleteEducationAttachmentOnly   
//DeletDocumentAttachments  
//DeletProfilePhoto   
//RequestToshowUpgrades   
//ResendMobileNumberVerificationForm  
//HideLatestUpdates
?>                                                            
  