<?php
 class Admin extends Master {

    function AdminLogin() {

            global $mysql,$j2japplication;  

            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter login name ");
            }

            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }

            $data=$mysql->select("select * from _tbl_admin where AdminLogin='".$_POST['UserName']."' and AdminPassword='".$_POST['Password']."'") ;
            if (sizeof($data)==0) {
                return Response::returnError("Invalid login name and password");
            }
                
            $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
            $loginid    = $mysql->insert("_tbl_logs_logins",array("LoginOn"       => date("Y-m-d H:i:s"),
                                                                  "LoginFrom"     => "Web",
                                                                  "Device"        => $clientinfo['Device'],
                                                                  "AdminID"       => $data[0]['AdminID'],
                                                                  "LoginName"     => $_POST['UserName'],
                                                                  "BrowserIP"     => $clientinfo['query'],
                                                                  "CountryName"   => $clientinfo['country'],
                                                                  "BrowserName"   => $clientinfo['UserAgent'],
                                                                  "APIResponse"   => json_encode($clientinfo),
                                                                  "LoginPassword" => $_POST['Password']));
            $data[0]['LoginID']=$loginid;
            return ($data[0]['IsActive']==1) ? Response::returnSuccess("success",$data[0]) : Response::returnError("Access denied. Please contact support");
        }

        function AdminChangePassword(){
            
            global $mysql,$loginInfo;
            
            $getpassword = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");  
            
            if ($getpassword[0]['AdminPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Currentpassword"); 
            }
            
            $mysql->execute("update _tbl_admin set AdminPassword='".$_POST['ConfirmNewPassword']."' where AdminID='".$loginInfo[0]['AdminID']."'");
            return Response::returnSuccess("Password Changed Successfully",array());
        }

        function GetFranchiseeCode() {
             global $mysql,$loginInfo;
            $DefaultPlan = $mysql->select("select * from _tbl_franchisees_plans where IsDefault='1'");
             
            return Response::returnSuccess("success",array("FranchiseeCode" => SeqMaster::GetNextFranchiseeNumber(),
                                                           "Plans"          => Plans::GetFranchiseePlans(),
                                                           "DefaultPlanCode"=> $DefaultPlan[0]['PlanCode'],
                                                           "CountryCode"    => CodeMaster::getData('RegisterAllowedCountries'),
                                                           "CountryName"    => CodeMaster::getData('CONTNAMES'),
                                                           "IDProof"    	=> CodeMaster::getData('DOCTYPES'),
														   "BankName"       => CodeMaster::getData('BANKNAMES'),
                                                           "AccountType"    => CodeMaster::getData('AccountType'),
                                                           "Gender"         => CodeMaster::getData('SEX')));
        }
		
		function AddFranchiseeBankDetails() {
			global $mysql,$loginInfo;
			
			if ((strlen(trim($_POST['BankName']))==0 || $_POST['BankName']=="0")) {
                return Response::returnError("Please select Bank Name");
            }
            
            if (!(strlen(trim($_POST['AccountName']))>0)) {
                return Response::returnError("Please enter Account Name");
            }
            
            if (!(strlen(trim($_POST['AccountNumber']))>0)) {
                return Response::returnError("Please enter Account Number");
            }
            
            if (!(strlen(trim($_POST['IFSCode']))>0)) {
                return Response::returnError("Please enter IFS Code");
            }
            
            if ((strlen(trim($_POST['AccountType']))==0 || $_POST['AccountType']=="0")) {
                return Response::returnError("Please select Account Type");
            }
            
            if (!(strlen(trim($_POST['AccountType']))>0)) {
                return Response::returnError("Please enter Account Type");
            }
			
			if ((strlen(trim($_POST['BankName']))==0 || $_POST['BankName']=="0")) {
                return Response::returnError("Please select Bank Name");
            }
            
            if (!(strlen(trim($_POST['AccountName']))>0)) {
                return Response::returnError("Please enter Account Name");
            }
            
            if (!(strlen(trim($_POST['AccountNumber']))>0)) {
                return Response::returnError("Please enter Account Number");
            }
            
            if (!(strlen(trim($_POST['IFSCode']))>0)) {
                return Response::returnError("Please enter IFS Code");
            }
            
            if ((strlen(trim($_POST['AccountType']))==0 || $_POST['AccountType']=="0")) {
                return Response::returnError("Please select Account Type");
            }
			
			$data = $mysql->select("select * from  _tbl_bank_details where AccountNumber='".trim($_POST['AccountNumber'])."' and IsDelete='0'");
			if (sizeof($data)>0) {
				return Response::returnError("Account Number Already Exists");
			}
			
			$bank = CodeMaster::getData("BANKNAMES",$_POST['BankName']);
			$AccountType = CodeMaster::getData("AccountType",$_POST['AccountType']);
			$mysql->insert("_tbl_bank_details",array("BankCode"        => $_POST['BankName'],
													 "BankName"        => $bank[0]['CodeValue'],
													 "FranchiseeID"    => $_POST['FranchiseeID'],
													 "AccountName"     => $_POST['AccountName'],
													 "AccountNumber"   => $_POST['AccountNumber'],  
													 "IFSCode"         => $_POST['IFSCode'],
													 "AccountTypeCode" => $AccountType[0]['SoftCode'],
													 "AccountType"     => $AccountType[0]['CodeValue']));
			$data = $mysql->select("select * from  _tbl_bank_details where FranchiseeID='".trim($_POST['FranchiseeID'])."' and IsDelete='0'");
													 
			return Response::returnSuccess("success",$data);
		}
		function DeleteFrBankDetails() {

             global $mysql,$loginInfo;
			 
			 $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeCode='".$_POST['FranchiseeID']."'");

             $updateSql = $mysql->execute("update `_tbl_bank_details` set `IsDelete` = '1' where `BankID`='".$_POST['BankID']."' and `FranchiseeID`='".$Franchisees[0]['FranchiseeID']."'");
            
				$data = $mysql->select("select * from  _tbl_bank_details where FranchiseeID='".trim($Franchisees[0]['FranchiseeID'])."' and IsDelete='0'");
				return Response::returnSuccess("success",$data);
				
				//if (sizeof($updateSql)>0) {
					//return Response::returnSuccess("success",$data);
				//} else{
					//return Response::returnError("Access denied. Please contact support",$data);      
				//}
			}
               
       
        function CreateFranchisee() {
            
            global $mysql,$loginInfo;
            
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            if (!(strlen(trim($_POST['FranchiseeName']))>0)) {
                return Response::returnError("Please enter your name");                                          
            }
            
            if (!(strlen(trim($_POST['FranchiseeEmailID']))>0)) {
                return Response::returnError("Please enter FranchiseeEmailID");
            }
            
            if (!(strlen(trim($_POST['BusinessMobileNumber']))>0)) {
                return Response::returnError("Please enter BusinessMobileNumber");
            }
            
            if (!(strlen(trim($_POST['BusinessAddress1']))>0)) {
                return Response::returnError("Please enter BusinessAddress1");
            }       
            
            if (!(strlen(trim($_POST['CityName']))>0)) {
                return Response::returnError("Please enter CityName");
            }                        
            
            if ((strlen(trim($_POST['CountryName']))==0 || $_POST['CountryName']=="0" )) {
                return Response::returnError("Please select Country Name");
            }
            
            if ((strlen(trim($_POST['StateName']))==0 || $_POST['StateName']=="0" )) {
                return Response::returnError("Please select State Name");
            }
            
            if ((strlen(trim($_POST['DistrictName']))==0 || $_POST['DistrictName']=="0")) {
                return Response::returnError("Please select District Name");
            }
            
            if (!(strlen(trim($_POST['PinCode']))>0)) {
                return Response::returnError("Please enter PinCode");
            }
            
            if ((strlen(trim($_POST['BankName']))==0 || $_POST['BankName']=="0")) {
                return Response::returnError("Please select Bank Name");
            }
            
            if (!(strlen(trim($_POST['AccountName']))>0)) {
                return Response::returnError("Please enter Account Name");
            }
            
            if (!(strlen(trim($_POST['AccountNumber']))>0)) {
                return Response::returnError("Please enter Account Number");
            }
            
            if (!(strlen(trim($_POST['IFSCode']))>0)) {
                return Response::returnError("Please enter IFS Code");
            }
            
            if ((strlen(trim($_POST['AccountType']))==0 || $_POST['AccountType']=="0")) {
                return Response::returnError("Please select Account Type");
            }
            
            if (!(strlen(trim($_POST['AccountType']))>0)) {
                return Response::returnError("Please enter Account Type");
            }
            
            if (!(strlen(trim($_POST['PersonName']))>0)) {
                return Response::returnError("Please enter Person Name");
            }
            if (!(strlen(trim($_POST['FatherName']))>0)) {
                return Response::returnError("Please enter Father Name");
            }
            if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
                return Response::returnError("Please select Sex");
            }
            if ((strlen(trim($_POST['IDProof']))==0 || $_POST['IDProof']=="0")) {
                return Response::returnError("Please select ID Proof");
            }
            
            if (!(strlen(trim($_POST['EmailID']))>0)) {
                return Response::returnError("Please enter EmailID");
            }
            
            if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter MobileNumber");
            }
            
            if (!(strlen(trim($_POST['Address1']))>0)) {
                return Response::returnError("Please enter Address1");
            }
            
            if (!(strlen(trim($_POST['IDProofNumber']))>0)) {
                return Response::returnError("Please enter ID Proof Number");
            }
            
            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter UserName");
            }
            
            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter Password");
            }  

            $data = $mysql->select("select * from  _tbl_franchisees where FranchiseeCode='".trim($_POST['FranchiseeCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Franchisee Code Already Exists");
            }
            
            $data = $mysql->select("select * from  _tbl_franchisees where ContactEmail='".trim($_POST['FranchiseeEmailID'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("EmailID Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_franchisees where ContactNumber='".trim($_POST['BusinessMobileNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Business MobileNumber Already Exists");
            }
            if(strlen(trim($_POST['BusinessWhatsappNumber']))>0) {
            $data = $mysql->select("select * from  _tbl_franchisees where ContactWhatsapp='".trim($_POST['BusinessWhatsappNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Business WhatsappNumber Already Exists");
            }
            }
            if(strlen(trim($_POST['BusinessLandlineNumber']))>0){
            $data = $mysql->select("select * from  _tbl_franchisees where ContactLandline='".trim($_POST['BusinessLandlineNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Business LandlineNumber Already Exists");
            }
            if (!(strlen(trim($_POST['LandlineStdCode']))>0)) {
                return Response::returnError("Please enter Std code");
            }
            }
            $data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Email ID Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Mobile Number Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_franchisees_staffs where WhatsappNumber='".trim($_POST['WhatsappNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Whatsapp Number Already Exists");
            }
            
            $data = $mysql->select("select * from  _tbl_franchisees_staffs where IDProofNumber='".trim($_POST['IDProofNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("ID Proof Number Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Login Name Already Exists");
            }
            $plan = $mysql->select("select * from _tbl_franchisees_plans where PlanID='".$_POST['Plan']."'");
            $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
           
            $country = CodeMaster::getData("CONTNAMES",$_POST['CountryName']);
            $state = CodeMaster::getData("STATNAMES",$_POST['StateName']);
            $dist = CodeMaster::getData("DistrictName",$_POST['DistrictName']);
            $bank = CodeMaster::getData("BANKNAMES",$_POST['BankName']);
            $AccountType = CodeMaster::getData("AccountType",$_POST['AccountType']);
            $sex = CodeMaster::getData("SEX",$_POST['Sex']);
            $ID = CodeMaster::getData("DOCTYPES",$_POST['IDProof']); 
           
            if($_POST['IsAdmin']=="on"){
                $IsAdmin='1';
                $mysql->execute("Update _tbl_franchisees set IsAdmin='0'");
            }   else {
                $IsAdmin='0';
            }  
            
             $id =  $mysql->insert("_tbl_franchisees",array("FranchiseeCode"                => $_POST['FranchiseeCode'],
                                                            "FranchiseName"                 => $_POST['FranchiseeName'],
                                                            "ContactEmail"                   => $_POST['FranchiseeEmailID'],
                                                            "ContactNumberCode"             => $country[0]['SoftCode'],
                                                            "ContactNumberCountryCode"   => $_POST['ContactNumberCountryCode'],
                                                            "ContactNumber"                 => $_POST['BusinessMobileNumber'],
                                                            "ContactWhatsappCode"           => $country[0]['SoftCode'],
                                                            "ContactWhatsappCountryCode" => $_POST['ContactWhatsappCountryCode'],
                                                            "ContactWhatsapp"               => $_POST['BusinessWhatsappNumber'],
                                                            "LandlineCode"                  => $country[0]['SoftCode'],
                                                            "LandlineCountryCode"          => $_POST['LandlineCountryCode'],
                                                            "LandlineStdCode"              => $_POST['LandlineStdCode'],
                                                            "ContactLandline"                 => $_POST['BusinessLandlineNumber'],
                                                            "BusinessAddressLine1"          => $_POST['BusinessAddress1'],
                                                            "BusinessAddressLine2"          => $_POST['BusinessAddress2'],
                                                            "BusinessAddressLine3"          => $_POST['BusinessAddress3'],
                                                            "Landmark"                      => $_POST['Landmark'],
                                                            "DistrictName"                  => $dist[0]['CodeValue'],
                                                            "DistrictNameCode"              => $_POST['DistrictName'],
                                                            "StateName"                     => $state[0]['CodeValue'],
                                                            "StateNameCode"                 => $_POST['StateName'],
                                                            "CountryName"                   => $country[0]['CodeValue'],
                                                            "CountryNameCode"               => $_POST['CountryName'],
                                                            "CityName"                        => $_POST['CityName'],
                                                            "PinCode"                       => $_POST['PinCode'],
                                                            "ValidUpto"                     => date("Y-m-d H:i:s"),
                                                            "CreatedOn"                        => date("Y-m-d H:i:s"),
                                                            "PlanCode"                        => $plan[0]['PlanCode'],
                                                            "IsAdmin"                        => $IsAdmin,
                                                            "Plan"                          => $plan[0]['PlanName'] )); 
                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Franchisees'");  
                $mysql->insert("_tbl_bank_details",array("BankCode"        => $_POST['BankName'],
                                                         "BankName"        => $bank[0]['CodeValue'],
                                                         "FranchiseeID"    => $id,
                                                         "AccountName"     => $_POST['AccountName'],
                                                         "AccountNumber"   => $_POST['AccountNumber'],  
                                                         "IFSCode"         => $_POST['IFSCode'],
                                                         "IsPrimary"         => "1",
                                                         "AccountTypeCode" => $AccountType[0]['SoftCode'],
                                                         "AccountType"     => $AccountType[0]['CodeValue']));
                                                        
                 
                $mysql->insert("_tbl_franchisees_staffs",array("StaffCode"                       => SeqMaster::GetNextFranchiseeStaffNumber(),
                                                               "PersonName"                => $_POST['PersonName'],
                                                               "FatherName"                => $_POST['FatherName'],
                                                               "FranchiseeID"              => $id,
                                                               "DateofBirth"               => $dob,
                                                               "SexCode"                   => $_POST['Sex'],
                                                               "Sex"                       => $sex[0]['CodeValue'],
                                                               "FrCode"                    => $_POST['FranchiseeCode'],
                                                               "EmailID"                   => $_POST['EmailID'],
                                                               "MobileNumberCode"            => $country[0]['SoftCode'],
                                                               "CountryCode"                  => $_POST['MobileNumberCountryCode'],
                                                               "MobileNumber"              => $_POST['MobileNumber'],
                                                               "WhatsappNumberCode"        => $country[0]['SoftCode'],
                                                               "WhatsappNumberCountryCode" => $_POST['WhatsappNumberCountryCode'],
                                                               "WhatsappNumber"            => $_POST['WhatsappNumber'],
                                                               "AddressLine1"              => $_POST['Address1'],
                                                               "AddressLine2"              => $_POST['Address2'],
                                                               "CreatedOn"                 => date("Y-m-d H:i:s"),
                                                               "AddressLine3"              => $_POST['Address3'],
                                                               "IDProofCode"                    => $ID[0]['SoftCode'],
                                                               "IDProof"                        => $ID[0]['CodeValue'],
                                                               "IDProofNumber"             => $_POST['IDProofNumber'],
                                                               "IsActive"                  => "1",
                                                               "IsAdmin"                         => "1",
                                                               "LoginName"                 => $_POST['UserName'],
                                                               "ReferedBy"                 => $loginInfo[0]['AdminID'],
                                                               "LoginPassword"             => $_POST['Password'],
                                                               "ChangePasswordFstLogin"    => ($_POST['PasswordFstLogin']=="on") ? '1' : '0'));
             $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='FranchiseeStaff'");                                  
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='NewFranchiseeCreate'");
             $content  = str_replace("#FranchiseeName#",$_POST['FranchiseeName'],$mContent[0]['Content']);
             $content  = str_replace("#FranchiseeCode#",$_POST['FranchiseeCode'],$content);

             MailController::Send(array("MailTo"         => $_POST['FranchiseeEmailID'],
                                        "Category"       => "NewFranchiseeCreate",
                                        "FranchiseeCode" => $_POST['FranchiseeCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($_POST['BusinessMobileNumber']," Dear ".$_POST['FranchiseeName'].",Your Profile has been created successfully");  

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='NewFranchiseeStaffCreate'");
                     $content  = str_replace("#PersonName#",$_POST['PersonName'],$mContent[0]['Content']);
                     $content  = str_replace("#FranchiseeName#",$_POST['FranchiseeName'],$content);
                     $content  = str_replace("#LoginName#",$_POST['UserName'],$content);
                     $content  = str_replace("#LoginPassword#",$_POST['Password'],$content);

                     MailController::Send(array("MailTo"   => $_POST['EmailID'],
                                                "Category" => "NewFranchiseeStaffCreate",
                                                "MemberID" => $id,
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['PersonName'].",Your Profile has been created successfully");  
             
            if (sizeof($id)>0) {
                
                return Response::returnSuccess("success",array("FranchiseeCode" => $_POST['FranchiseeCode']));
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }

    function EditFranchisee(){
              global $mysql,$loginInfo;

		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
              
        if (!(strlen(trim($_POST['FranchiseeName']))>0)) {
            return Response::returnError("Please enter your name");
        }
        if (!(strlen(trim($_POST['FranchiseeEmailID']))>0)) {
            return Response::returnError("Please enter FranchiseeEmailID");
        }
        if (!(strlen(trim($_POST['BusinessMobileNumber']))>0)) {
            return Response::returnError("Please enter BusinessMobileNumber");
        }
        if (!(strlen(trim($_POST['BusinessAddress1']))>0)) {
            return Response::returnError("Please enter BusinessAddress1");
        }
        if (!(strlen(trim($_POST['CityName']))>0)) {
            return Response::returnError("Please enter CityName");
        }
        if (!(strlen(trim($_POST['PinCode']))>0)) {
            return Response::returnError("Please enter PinCode");
        }
        
        if (!(strlen(trim($_POST['PersonName']))>0)) {
            return Response::returnError("Please enter Person Name");
        }
        if (!(strlen(trim($_POST['FatherName']))>0)) {
            return Response::returnError("Please enter Father Name");
        }
         if (!(strlen(trim($_POST['EmailID']))>0)) {
            return Response::returnError("Please enter EmailID");
        }
        if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return Response::returnError("Please enter MobileNumber");
        }
        if (!(strlen(trim($_POST['Address1']))>0)) {
            return Response::returnError("Please enter Address1");
        }
        if ((strlen(trim($_POST['IDProof']))==0 || $_POST['IDProof']=="0")) {
                return Response::returnError("Please select ID Proof");
            }
		if (!(strlen(trim($_POST['IDProofNumber']))>0)) {
			return Response::returnError("Please enter ID Proof Number");
		}
 
        $data = $mysql->select("select * from  _tbl_franchisees where ContactEmail='".trim($_POST['FranchiseeEmailID'])."' and FranchiseeCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees where ContactNumber='".trim($_POST['BusinessMobileNumber'])."' and FranchiseeCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Business MobileNumber Already Exists");
        }
        if(strlen(trim($_POST['BusinessWhatsappNumber']))>0){
        $data = $mysql->select("select * from  _tbl_franchisees where ContactWhatsapp='".trim($_POST['BusinessWhatsappNumber'])."' and FranchiseeCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Business WhatsappNumber Already Exists");
        }
        }
        
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Email ID Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where WhatsappNumber='".trim($_POST['WhatsappNumber'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Whatsapp Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LandlineNumber='".trim($_POST['LandlineNumber'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Landline Number Already Exists");
            if (!(strlen(trim($_POST['LandlineStdCode']))>0)) {
                return Response::returnError("Please enter Std code");
            }
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where IDProofNumber='".trim($_POST['IDProofNumber'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("ID Proof Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."' and FrCode <>'".$_POST['FranCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Login Name Already Exists");
        } 
        if(!($_POST['IsAdmin']=="on")){
             $data = $mysql->select("select * from  _tbl_franchisees where IsAdmin='1' FranchiseeCode<>'".$_POST['FranCode']."'");
             if(sizeof($data)==0){
                return Response::returnError("Please select one admin");
             }
        }
        $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);
			   
		$Franchisee = $mysql->select("select * from  _tbl_franchisees where FranchiseeCode='".$_POST['FranCode']."'");

			$country = CodeMaster::getData("CONTNAMES",$_POST['CountryName']);
            $state = CodeMaster::getData("STATNAMES",$_POST['StateName']);
			$dist = CodeMaster::getData("DistrictName",$_POST['DistrictName']);
			$sex = CodeMaster::getData("SEX",$_POST['Sex']);
			$ID = CodeMaster::getData("DOCTYPES",$_POST['IDProof']);
            if($_POST['IsAdmin']=="on"){
                $IsAdmin='1';
                $mysql->execute("Update _tbl_franchisees set IsAdmin='0'");
            }   else {
                $IsAdmin='0';
            }
            
	 $Fid = $mysql->execute("update _tbl_franchisees set FranchiseName			     ='".$_POST['FranchiseeName']."',
														 ContactEmail				 ='".$_POST['FranchiseeEmailID']."',
														 ContactNumberCode        	 ='".$country[0]['SoftCode']."',
														 ContactNumberCountryCode    ='".$_POST['ContactNumberCountryCode']."',
														 ContactNumber				 ='".$_POST['BusinessMobileNumber']."',
														 ContactWhatsappCode	     ='".$country[0]['SoftCode']."',
														 ContactWhatsapp			 ='".$_POST['BusinessWhatsappNumber']."',
														 ContactWhatsappCountryCode  ='".$_POST['ContactWhatsappCountryCode']."',
														 LandlineCode		 		 ='".$country[0]['SoftCode']."',
														 LandlineCountryCode		 ='".$_POST['LandlineCountryCode']."',
														 LandlineStdCode			 ='".$_POST['LandlineStdCode']."',
														 ContactLandline			 ='".$_POST['BusinessLandlineNumber']."',
														 BusinessAddressLine1		 ='".$_POST['BusinessAddress1']."',
														 BusinessAddressLine2		 ='".$_POST['BusinessAddress2']."',
														 BusinessAddressLine3		 ='".$_POST['BusinessAddress3']."',
														 DistrictName				 ='".$dist[0]['CodeValue']."',
														 DistrictNameCode			 ='".$_POST['DistrictName']."',
														 StateName					 ='".$state[0]['CodeValue']."',
														 StateNameCode				 ='".$_POST['StateName']."',
														 CountryName				 ='".$country[0]['CodeValue']."',
														 CountryNameCode			 ='".$_POST['CountryName']."',
														 CityName					 ='".$_POST['CityName']."',
														 Landmark					 ='".$_POST['Landmark']."',
                                                         PinCode                     ='".$_POST['PinCode']."',
														 IsAdmin					 ='".$IsAdmin."'
																 where FranchiseeCode='".$_POST['FranCode']."'");

				
	$FSid = $mysql->execute("update _tbl_franchisees_staffs set PersonName	 	 		 ='".$_POST['PersonName']."',
																FatherName	 			 ='".$_POST['FatherName']."',
																DateofBirth	 			 ='".$_POST['year']."-".$_POST['month']."-".$_POST['date']."',
																SexCode		 			 ='".$sex[0]['SoftCode']."',
																Sex			 			 ='".$sex[0]['CodeValue']."',
																EmailID		 			 ='".$_POST['EmailID']."',
																MobileNumberCode		 ='".$country[0]['SoftCode']."',
																CountryCode				 ='".$_POST['CountryCode']."',
																MobileNumber			 ='".$_POST['MobileNumber']."',
																WhatsappNumberCode		 ='".$country[0]['SoftCode']."',
																WhatsappNumberCountryCode='".$_POST['WhatsappNumberCountryCode']."',
																WhatsappNumber			 ='".$_POST['WhatsappNumber']."',
																AddressLine1		     ='".$_POST['Address1']."',
																AddressLine2		     ='".$_POST['Address2']."',
																AddressLine3			 ='".$_POST['Address3']."',
																IDProofCode				 ='".$ID[0]['SoftCode']."',
																IDProof					 ='".$ID[0]['CodeValue']."',
																IDProofNumber			 ='".$_POST['IDProofNumber']."'
																where  ReferedBy='1' and FrCode='".$_POST['FranCode']."'");
				//$FidB
			if($Fid>0 ) {
			
			 $mContent = $mysql->select("select * from `mailcontent` where `Category`='EditFranchisee'");
             $content  = str_replace("#FranchiseeName#",$_POST['FranchiseeName'],$mContent[0]['Content']);
             $content  = str_replace("#FranchiseeCode#",$_POST['FranchiseeCode'],$content);

             MailController::Send(array("MailTo"         => $_POST['FranchiseeEmailID'],
                                        "Category"       => "EditFranchisee",
                                        "FranchiseeCode" => $_POST['FranchiseeCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($_POST['BusinessMobileNumber']," Dear ".$_POST['FranchiseeName'].",Your Profile has been updated successfully");  
			} 
			
			if($FSid>0) {
			
			 $mContent = $mysql->select("select * from `mailcontent` where `Category`='EditFranchiseeStaff'");
             $content  = str_replace("#PersonName#",$_POST['PersonName'],$mContent[0]['Content']);
             

             MailController::Send(array("MailTo"         => $_POST['EmailID'],
                                        "Category"       => "EditFranchiseeStaff",
                                        "FranchiseeCode" => $_POST['FranchiseeCode'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['PersonName'].",Your Profile has been updated successfully");  
			}



			
                return Response::returnSuccess("success",array());

    } 

    function GetManageFranchisee() {
           global $mysql;    
              $Franchisees = $mysql->select("select * from _tbl_franchisees");
                return Response::returnSuccess("success",$Franchisees);

    }
    
    function GetDraftedProfiles() {
           global $mysql;    
             $sql = "SELECT *
                                    FROM _tbl_draft_profiles
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_draft_profiles.MemberID=_tbl_members.MemberID where _tbl_draft_profiles.IsDelete='0'";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Draft") {
                return Response::returnSuccess("success",$mysql->select($sql." and _tbl_draft_profiles.RequestToVerify='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Publish") {
                return Response::returnSuccess("success",$mysql->select($sql."  and _tbl_draft_profiles.IsApproved='1'"));    
             }
         }

    function GetProfilesRequestVerify() {
           global $mysql;    
           $Profiles = array();
             $Position = "";
          /*    $Profiles = $mysql->select("SELECT *
                               FROM _tbl_draft_profiles
                               LEFT  JOIN _tbl_members
                               ON _tbl_draft_profiles.MemberID=_tbl_members.MemberID WHERE _tbl_draft_profiles.RequestToVerify='1' and _tbl_draft_profiles.IsApproved='0'");

                return Response::returnSuccess("success",$Profiles);*/
            $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `RequestToVerify`='1' and IsApproved='0' and IsSendToAdmin='0' Order by `RequestVerifyOn` DESC");
            if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 }
            return Response::returnSuccess("success",$Profiles);
    }
    function GetProfilesRequestVerifyFrAdmin() {
           global $mysql;    
		   $Profiles = array();
             $Position = "";
          /*    $Profiles = $mysql->select("SELECT *
                               FROM _tbl_draft_profiles
                               LEFT  JOIN _tbl_members
                               ON _tbl_draft_profiles.MemberID=_tbl_members.MemberID WHERE _tbl_draft_profiles.RequestToVerify='1' and _tbl_draft_profiles.IsApproved='0'");

                return Response::returnSuccess("success",$Profiles);*/
			$DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `RequestToVerify`='1' and IsApproved='0' and IsSendToAdmin='1' Order by `RequestVerifyOn` DESC");
			if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 }
            return Response::returnSuccess("success",$Profiles);
    }
    
     function ViewRequestedProfile() {         
         global $mysql;

         $Profiles = $mysql->select("SELECT * FROM _tbl_draft_profiles
                                    INNER JOIN _tbl_members
                                    ON _tbl_members.MemberID = _tbl_draft_profiles.MemberID
                                    INNER JOIN _tbl_draft_profiles_education_details
                                    ON _tbl_draft_profiles_education_details.ProfileID = _tbl_draft_profiles.ProfileID WHERE _tbl_draft_profiles.ProfileID=".$_POST['Code']."'");
         return Response::returnSuccess("success",$Profiles[0]);
     }
                                                                                          
     function ViewMemberProfiles() {

             global $mysql,$loginInfo; 
             $Profiles = array();
             $Position = "";   

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="All") {  /* Profile => Manage Profile (All) */

                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileID` = '".$_POST['Code']."' and  RequestToVerify='1'");
                
                 if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $Profiles[]=Profiles::getProfileInformation($PostProfile['ProfileID']);     
                     }
                 }
             }
              
             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Posted") {    /* Profile => Posted */
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileID` = '".$_POST['Code']."' and RequestToVerify='1'");

                  if (sizeof($PostProfiles)>0) {
                      foreach($PostProfiles as $PostProfile) {
                        $Profiles[]=Profiles::getProfileInformation($PostProfile['ProfileID']);     
                     }
                 }
                 
                return Response::returnSuccess("success",$Profiles);
             }

         }
     
     function ApproveProfile() {

             global $mysql,$loginInfo; 
             $d = $mysql->select("select * from _tbl_profiles where DraftProfileCode='".$_POST['ProfileID']."'");
             if (sizeof($d)>0) {
                 return Response::returnError("Already processed.");
             }
              
             $draft = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'");
             
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$draft[0]['MemberID']."'");
             
             if ($draft[0]['IsApproved']=="1") {
                return Response::returnError("Your selected Profile already approvd");
             }
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ProfilePublished'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$draft[0]['ProfileCode'],$content);
             $content  = str_replace("#ProfileName#",$draft[0]['ProfileName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ProfilePublished",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$draft[0]['PersonName'].") has been published. Your Profile ID is ".$draft[0]['ProfileCode']);  
             
			if($draft[0]['CreatedByFranchiseeStaffID']>0){ 
				$Franchisee = $mysql->select("select * from `_tbl_franchisees_staffs` where `PersonID`='".$draft[0]['CreatedByFranchiseeStaffID']."'");
				
			 $mContent = $mysql->select("select * from `mailcontent` where `Category`='CreatedByFranchiseeStaffProfilePublished'");
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['PersonName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$draft[0]['ProfileCode'],$content);
             $content  = str_replace("#ProfileName#",$draft[0]['ProfileName'],$content);

             MailController::Send(array("MailTo"   => $Franchisee[0]['EmailID'],
                                        "Category" => "CreatedByFranchiseeStaffProfilePublished",
                                        "FranchiseeID" => $Franchisee[0]['PersonID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($Franchisee[0]['MobileNumber']," Dear ".$Franchisee[0]['PersonName'].",Profile (".$draft[0]['ProfileName'].") has been published. Profile ID is ".$draft[0]['ProfileCode']);  
			 
			 }
			 
             $updateSql = "update `_tbl_draft_profiles` set `IsApproved`      = '1',
                                                             `IsApprovedOn`    = '".date("Y-m-d H:i:s")."'
                                                              where `ProfileCode`='".$_POST['ProfileID']."'";
                                                            
             $mysql->execute($updateSql); 
               
                                                             //approved by   //admin remarks
             $draft = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'");
             $ProfileCode   = SeqMaster::GetNextProfileCode();
             
             $pid =  $mysql->insert("_tbl_profiles",array("ProfileCode"                  => $ProfileCode,
                                                          "DraftProfileID"               => $draft[0]['ProfileID'],
                                                          "DraftProfileCode"             => $draft[0]['ProfileCode'],
                                                          "ProfileForCode"               => $draft[0]['ProfileForCode'],
                                                          "ProfileFor"                   => $draft[0]['ProfileFor'],
                                                          "ProfileName"                  => $draft[0]['ProfileName'],
                                                          "DateofBirth"                  => $draft[0]['DateofBirth'],
                                                          "SexCode"                      => $draft[0]['SexCode'],
                                                          "Sex"                          => $draft[0]['Sex'],
                                                          "MaritalStatusCode"            => $draft[0]['MaritalStatusCode'], 
                                                          "MaritalStatus"                => $draft[0]['MaritalStatus'],
                                                          "ChildrenCode"                 => $draft[0]['ChildrenCode'],
                                                          "Children"                     => $draft[0]['Children'],
                                                          "IsChildrenWithyou"            => $draft[0]['IsChildrenWithyou'],
                                                          "MotherTongueCode"             => $draft[0]['MotherTongueCode'],
                                                          "MotherTongue"                 => $draft[0]['MotherTongue'],
                                                          "ReligionCode"                 => $draft[0]['ReligionCode'],
                                                          "Religion"                     => $draft[0]['Religion'],
                                                          "OtherReligion"                => $draft[0]['OtherReligion'],
                                                          "CasteCode"                    => $draft[0]['CasteCode'],
                                                          "Caste"                        => $draft[0]['Caste'],
                                                          "OtherCaste"                   => $draft[0]['OtherCaste'],
                                                          "SubCaste"                     => $draft[0]['SubCaste'],
                                                          "CommunityCode"                => $draft[0]['CommunityCode'],
                                                          "Community"                    => $draft[0]['Community'], 
                                                          "NationalityCode"              => $draft[0]['NationalityCode'],
                                                          "Nationality"                  => $draft[0]['Nationality'],
                                                          "mainEducation"                  => $draft[0]['mainEducation'],
                                                          "AboutMe"                      => $draft[0]['AboutMe'],
             /* Occupation Details */                     "EmployedAsCode"               => $draft[0]['EmployedAsCode'],
                                                          "EmployedAs"                   => $draft[0]['EmployedAs'],
                                                          "OccupationTypeCode"           => $draft[0]['OccupationTypeCode'],
                                                          "OccupationType"               => $draft[0]['OccupationType'], 
                                                          "TypeofOccupationCode"         => $draft[0]['TypeofOccupationCode'],
                                                          "TypeofOccupation"             => $draft[0]['TypeofOccupation'],
                                                          "OtherOccupation"              => $draft[0]['OtherOccupation'],
                                                          "OccupationDescription"        => $draft[0]['OccupationDescription'],
                                                          "AnnualIncomeCode"             => $draft[0]['AnnualIncomeCode'],
                                                          "AnnualIncome"                 => $draft[0]['AnnualIncome'],
                                                          "WorkedCountryCode"            => $draft[0]['WorkedCountryCode'],
                                                          "WorkedCountry"                => $draft[0]['WorkedCountry'],
                                                          "WorkedCityName"               => $draft[0]['WorkedCityName'],
                                                          "OccupationAttachmentType"     => $draft[0]['OccupationAttachmentType'],
                                                          "OccupationAttachFileName"     => $draft[0]['OccupationAttachFileName'],
                                                          "OccupationDetails"            => $draft[0]['OccupationDetails'],
          /* Family Information */                        "FathersName"                  => $draft[0]['FathersName'],
                                                          "FathersAliveCode"             => $draft[0]['FathersAliveCode'],
                                                          "FathersAlive"                 => $draft[0]['FathersAlive'],
                                                          "FathersContactCountryCode"    => $draft[0]['FathersContactCountryCode'],
                                                          "FathersContact"               => $draft[0]['FathersContact'],
                                                          "FathersOccupationCode"        => $draft[0]['FathersOccupationCode'],
                                                          "FathersOccupation"            => $draft[0]['FathersOccupation'],
                                                          "FatherOtherOccupation"        => $draft[0]['FatherOtherOccupation'],
                                                          "FathersIncomeCode"            => $draft[0]['FathersIncomeCode'],
                                                          "FathersIncome"                => $draft[0]['FathersIncome'],
                                                          "MothersName"                  => $draft[0]['MothersName'],
                                                          "MothersAliveCode"             => $draft[0]['MothersAliveCode'],
                                                          "MothersAlive"                 => $draft[0]['MothersAlive'],
                                                          "MothersContactCountryCode"    => $draft[0]['MothersContactCountryCode'],
                                                          "MothersContact"               => $draft[0]['MothersContact'],
                                                          "MothersOccupationCode"        => $draft[0]['MothersOccupationCode'],
                                                          "MothersOccupation"            => $draft[0]['MothersOccupation'],
                                                          "MotherOtherOccupation"        => $draft[0]['MotherOtherOccupation'],
                                                          "MothersIncomeCode"            => $draft[0]['MothersIncomeCode'],
                                                          "MothersIncome"                => $draft[0]['MothersIncome'],
                                                          "FamilyLocation1"              => $draft[0]['FamilyLocation1'],
                                                          "FamilyLocation2"              => $draft[0]['FamilyLocation2'],
                                                          "Ancestral"                    => $draft[0]['Ancestral'],
                                                          "FamilyTypeCode"               => $draft[0]['FamilyTypeCode'],
                                                          "FamilyType"                   => $draft[0]['FamilyType'],
                                                          "FamilyAffluenceCode"          => $draft[0]['FamilyAffluenceCode'],
                                                          "FamilyAffluence"              => $draft[0]['FamilyAffluence'],
                                                          "FamilyValueCode"              => $draft[0]['FamilyValueCode'],
                                                          "FamilyValue"                  => $draft[0]['FamilyValue'],
                                                          "NumberofBrothersCode"         => $draft[0]['NumberofBrothersCode'],
                                                          "NumberofBrothers"             => $draft[0]['NumberofBrothers'],
                                                          "YoungerCode"                  => $draft[0]['YoungerCode'],
                                                          "Younger"                      => $draft[0]['Younger'],
                                                          "ElderCode"                    => $draft[0]['ElderCode'],
                                                          "Elder"                        => $draft[0]['Elder'],
                                                          "MarriedCode"                  => $draft[0]['MarriedCode'],
                                                          "Married"                      => $draft[0]['Married'],
                                                          "NumberofSistersCode"          => $draft[0]['NumberofSistersCode'],
                                                          "NumberofSisters"              => $draft[0]['NumberofSisters'],
                                                          "YoungerSisterCode"            => $draft[0]['YoungerSisterCode'],
                                                          "YoungerSister"                => $draft[0]['YoungerSister'],
                                                          "ElderSisterCode"              => $draft[0]['ElderSisterCode'],
                                                          "ElderSister"                  => $draft[0]['ElderSister'],
                                                          "MarriedSisterCode"            => $draft[0]['MarriedSisterCode'],
                                                          "MarriedSister"                => $draft[0]['MarriedSister'],
                                                          "AboutMyFamily"                => $draft[0]['AboutMyFamily'],
          /* Physical Information */                      "PhysicallyImpairedCode"       => $draft[0]['PhysicallyImpairedCode'],
                                                          "PhysicallyImpaired"           => $draft[0]['PhysicallyImpaired'],
                                                          "PhysicallyImpaireddescription"=> $draft[0]['PhysicallyImpaireddescription'], 
                                                          "VisuallyImpairedCode"         => $draft[0]['VisuallyImpairedCode'],
                                                          "VisuallyImpaired"             => $draft[0]['VisuallyImpaired'],
                                                          "VisuallyImpairedDescription"  => $draft[0]['VisuallyImpairedDescription'],
                                                          "VissionImpairedCode"          => $draft[0]['VissionImpairedCode'],
                                                          "VissionImpaired"              => $draft[0]['VissionImpaired'],
                                                          "VissionImpairedDescription"   => $draft[0]['VissionImpairedDescription'],
                                                          "SpeechImpairedCode"           => $draft[0]['SpeechImpairedCode'],
                                                          "SpeechImpaired"               => $draft[0]['SpeechImpaired'],
                                                          "SpeechImpairedDescription"    => $draft[0]['SpeechImpairedDescription'],   
                                                          "HeightCode"                   => $draft[0]['HeightCode'],
                                                          "Height"                       => $draft[0]['Height'],
                                                          "WeightCode"                   => $draft[0]['WeightCode'],
                                                          "Weight"                       => $draft[0]['Weight'],  
                                                          "BloodGroupCode"               => $draft[0]['BloodGroupCode'],
                                                          "BloodGroup"                   => $draft[0]['BloodGroup'],
                                                          "ComplexationCode"             => $draft[0]['ComplexationCode'],
                                                          "Complexation"                 => $draft[0]['Complexation'],  
                                                          "BodyTypeCode"                 => $draft[0]['BodyTypeCode'],
                                                          "BodyType"                     => $draft[0]['BodyType'],
                                                          "DietCode"                     => $draft[0]['DietCode'],
                                                          "Diet"                         => $draft[0]['Diet'],  
                                                          "SmokingHabitCode"             => $draft[0]['SmokingHabitCode'],
                                                          "SmokingHabit"                 => $draft[0]['SmokingHabit'],
                                                          "DrinkingHabitCode"            => $draft[0]['DrinkingHabitCode'],
                                                          "DrinkingHabit"                => $draft[0]['DrinkingHabit'],
                                                          "PhysicalDescription"          => $draft[0]['PhysicalDescription'],
          /* Communication Details */                     "ContactPersonName"            => $draft[0]['ContactPersonName'],
                                                          "Relation"                     => $draft[0]['Relation'],
                                                          "PrimaryPriority"              => $draft[0]['PrimaryPriority'], 
                                                          "EmailID"                      => $draft[0]['EmailID'],
                                                          "MobileNumberCountryCode"      => $draft[0]['MobileNumberCountryCode'],
                                                          "MobileNumber"                 => $draft[0]['MobileNumber'],
                                                          "WhatsappCountryCode"          => $draft[0]['WhatsappCountryCode'],
                                                          "WhatsappNumber"               => $draft[0]['WhatsappNumber'],
                                                          "AddressLine1"                 => $draft[0]['AddressLine1'],
                                                          "AddressLine2"                 => $draft[0]['AddressLine2'],
                                                          "AddressLine3"                 => $draft[0]['AddressLine3'],
                                                          "Pincode"                      => $draft[0]['Pincode'],
                                                          "City"                         => $draft[0]['City'],
                                                          "OtherLocation"                => $draft[0]['OtherLocation'],
                                                          "CountryCode"                  => $draft[0]['CountryCode'],
                                                          "Country"                      => $draft[0]['Country'],
                                                          "StateCode"                    => $draft[0]['StateCode'],
                                                          "State"                        => $draft[0]['State'],
                                                          "CommunicationDescription"     => $draft[0]['CommunicationDescription'],
          /* Horoscope Details */                                       "TimeOfBirth"                  => $draft[0]['TimeOfBirth'],
                                                          "PlaceOfBirth"                 => $draft[0]['PlaceOfBirth'],
                                                          "StarNameCode"                 => $draft[0]['StarNameCode'],
                                                          "StarName"                     => $draft[0]['StarName'], 
                                                          "RasiNameCode"                 => $draft[0]['RasiNameCode'],
                                                          "RasiName"                     => $draft[0]['RasiName'],
                                                          "LakanamCode"                  => $draft[0]['LakanamCode'],
                                                          "Lakanam"                      => $draft[0]['Lakanam'],
                                                          "ChevvaiDhoshamCode"           => $draft[0]['ChevvaiDhoshamCode'],
                                                          "ChevvaiDhosham"               => $draft[0]['ChevvaiDhosham'],
                                                          "HoroscopeDetails"             => $draft[0]['HoroscopeDetails'], 
                                                          "R1"                           => $draft[0]['R1'],                    
                                                          "R2"                           => $draft[0]['R2'],
                                                          "R3"                           => $draft[0]['R3'],
                                                          "R4"                           => $draft[0]['R4'],
                                                          "R5"                           => $draft[0]['R5'],
                                                          "R8"                           => $draft[0]['R8'],
                                                          "R9"                           => $draft[0]['R9'],
                                                          "R12"                          => $draft[0]['R12'],
                                                          "R13"                          => $draft[0]['R13'],
                                                          "R14"                          => $draft[0]['R14'],
                                                          "R15"                          => $draft[0]['R15'],
                                                          "R16"                          => $draft[0]['R16'],
                                                          "A1"                           => $draft[0]['A1'],
                                                          "A2"                           => $draft[0]['A2'],
                                                          "A3"                           => $draft[0]['A3'],
                                                          "A4"                           => $draft[0]['A4'],
                                                          "A5"                           => $draft[0]['A5'],
                                                          "A8"                           => $draft[0]['A8'],
                                                          "A9"                           => $draft[0]['A9'],
                                                          "A12"                          => $draft[0]['A12'],
                                                          "A13"                          => $draft[0]['A13'],
                                                          "A14"                          => $draft[0]['A14'],
                                                          "A15"                          => $draft[0]['A15'],
                                                          "A16"                          => $draft[0]['A16'],
                                                          "CreatedOn"                    => $draft[0]['CreatedOn'],
                                                          "LastUpdatedOn"                => $draft[0]['LastUpdatedOn'], 
                                                          "MemberID"                     => $draft[0]['MemberID'],
                                                          "MemberCode"                   => $draft[0]['MemberCode'],
                                                          "ReferBy"                      => $draft[0]['ReferBy'],
                                                          "RequestToVerify"              => $draft[0]['RequestToVerify'],
                                                          "RequestVerifyOn"              => $draft[0]['RequestVerifyOn'],
                                                          "CreatedByMemberID"            => $draft[0]['CreatedByMemberID'],
                                                          "CreatedByFranchiseeID"        => $draft[0]['CreatedByFranchiseeID'],
                                                          "CreatedByFranchiseeStaffID"   => $draft[0]['CreatedByFranchiseeStaffID'],
                                                          "IsApproved"                   => "1",                                   
                                                          "IsApprovedOn"                 => date("Y-m-d H:i:s")));
             $sql[]=$mysql->qry;
                                                  
     $draftEducationDetails = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileCode`='".$_POST['ProfileID']."' and IsDelete='0'");   
       foreach($draftEducationDetails as $ded) {
       $mysql->insert("_tbl_profiles_education_details",array("EducationDetails"         => $ded['EducationDetails'],
                                                              "EducationDegree"          => $ded['EducationDegree'],
                                                              "OtherEducationDegree"     => $ded['OtherEducationDegree'],
                                                              "EducationDescription"     => $ded['EducationDescription'],
                                                              "FileName"                 => $ded['FileName'],
                                                              "DraftProfileID"           => $ded['ProfileID'],
                                                              "DraftProfileCode"         => $ded['ProfileCode'],
                                                              "DraftEducationID"         => $ded['AttachmentID'],
                                                              "IsDeleted"                => $ded['IsDelete'],
                                                              "ProfileID"                => $pid,
                                                              "ProfileCode"              => $ProfileCode,
                                                              "MemberID"                 => $draft[0]['MemberID'],
                                                              "IsApproved"               => "1",
                                                              "IsApprovedOn"             => date("Y-m-d H:i:s")));
       }
       $sql[]=$mysql->qry;
       
       $draftProfilePhotos = $mysql->select("select * from `_tbl_draft_profiles_photos` where  `ProfileCode`='".$_POST['ProfileID']."' and IsDelete='0'");   
       foreach($draftProfilePhotos as $dPp) {
                      $mysql->insert("_tbl_profiles_photos",array("ProfilePhoto"         => $dPp['ProfilePhoto'],
                                                                  "UpdateOn"             => $dPp['UpdateOn'],
                                                                  "PriorityFirst"        => $dPp['PriorityFirst'],
                                                                  "DraftProfileID"       => $dPp['ProfileID'],
                                                                  "DraftProfileCode"     => $dPp['ProfileCode'],
                                                                  "IsDelete"             => $dPp['IsDelete'],
                                                                  //"IsDeletedOn"          => $dPp['IsDeletedOn'],
                                                                  "DraftProfilePhotoID"  => $dPp['ProfilePhotoID'],
                                                                  "ProfileID"            => $pid,
                                                                  "ProfileCode"          => $ProfileCode,
                                                                  "MemberID"             => $draft[0]['MemberID'],
                                                                  "IsApproved"           => "1",
                                                                  "IsApprovedOn"         => date("Y-m-d H:i:s"),
																  "IsPublished"           => "1",
                                                                  "PublishedOn"         => date("Y-m-d H:i:s")));
       }
       
       $draftProfilePartnersExpectatipns = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileCode`='".$_POST['ProfileID']."'");   
       foreach($draftProfilePartnersExpectatipns as $dPE) {
    $mysql->insert("_tbl_profiles_partnerexpectation",array("AgeFrom"                    => $dPE['AgeFrom'],
                                                            "AgeTo"                      => $dPE['AgeTo'],
                                                            "MaritalStatusCode"          => $dPE['MaritalStatusCode'],
                                                            "MaritalStatus"              => $dPE['MaritalStatus'],
                                                            "ReligionCode"               => $dPE['ReligionCode'],
                                                            "Religion"                   => $dPE['Religion'],
                                                            "CasteCode"                  => $dPE['CasteCode'],
                                                            "Caste"                      => $dPE['Caste'],
                                                            "EducationCode"              => $dPE['EducationCode'],
                                                            "Education"                  => $dPE['Education'],
                                                            "AnnualIncomeCode"           => $dPE['AnnualIncomeCode'],
                                                            "AnnualIncome"               => $dPE['AnnualIncome'],
                                                            "EmployedAsCode"             => $dPE['EmployedAsCode'],
                                                            "EmployedAs"                 => $dPE['EmployedAs'],
                                                            "RasiNameCode"               => $dPE['RasiNameCode'],
                                                            "RasiName"                   => $dPE['RasiName'],
                                                            "StarNameCode"               => $dPE['StarNameCode'],
                                                            "StarName"                   => $dPE['StarName'],
                                                            "ChevvaiDhoshamCode"         => $dPE['ChevvaiDhoshamCode'],
                                                            "ChevvaiDhosham"             => $dPE['ChevvaiDhosham'],
                                                            "Details"                    => $dPE['Details'],
                                                            "DraftPartnersExpectationID" => $dPE['ParnersExpectationId'],
                                                            "DraftProfileID"             => $draft[0]['ProfileID'],
                                                            "DraftProfileCode"           =>$draft[0]['ProfileCode'],
                                                            "ProfileID"                  => $pid,
                                                            "ProfileCode"                => $ProfileCode,
                                                            "MemberID"                   => $draft[0]['MemberID'],
                                                            "IsApproved"                 => "1",
                                                            "IsApprovedOn"               => date("Y-m-d H:i:s")));
       }
       $draftdocuments = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `ProfileCode`='".$_POST['ProfileID']."'");   
    
       foreach($draftdocuments as $dPD) {
            $mysql->insert("_tbl_profiles_verificationdocs",array("DocumentTypeCode"    => $dPD['DocumentTypeCode'],
                                                                  "DocumentType"        => $dPD['DocumentType'],
                                                                  "AttachFileName"      => $dPD['AttachFileName'],
                                                                  "AttachedOn"          => $dPD['AttachedOn'],
                                                                  "IsVerified"          => $dPD['IsVerified'],
                                                                  "IsDelete"            => $dPD['IsDelete'],
                                                                  "Type"                => $dPD['Type'],
                                                                  "DraftProfileID"      => $dPD['ProfileID'],
                                                                  "DraftProfileCode"    => $dPD['ProfileCode'],
                                                                  "DraftAttachmentID"   => $dPD['AttachmentID'],
                                                                  "ProfileID"           => $pid,
                                                                  "ProfileCode"         => $ProfileCode,
                                                                  "MemberID"            => $draft[0]['MemberID'],
                                                                  "IsApproved"          =>  "1",
                                                                  "ApprovedOn"          => date("Y-m-d H:i:s")));
       }
        $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='Profile'");
            /* return Response::returnSuccess('<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/icon_success_verification.png" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your profile Approved.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>',array("ProfileCode"=>$ProfileCode));  */
             return (array("ProfileCode"=>$ProfileCode));
			 return Response::returnSuccess("success".$sql,array("ProfileCode"=>$ProfileCode,"Sql"=>$sql));
         }
		 
		function TransactionPasswordSubmit($errormessage="",$ProfileID="") {

			global $mysql,$mail,$loginInfo;      
        
			$d = $mysql->select("select * from _tbl_profiles where DraftProfileCode='".$_POST['ProfileID']."'");
             if (sizeof($d)>0) {
                 return Response::returnError("Already processed.");
             }
              
             $EducationDetails =$mysql->select("Select * from `_tbl_draft_profiles_education_details` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                 if (sizeof($EducationDetails)==0) {
                        return Response::returnError("Education details not found."); 
                     }
             $Documents =$mysql->select("Select * from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
             if (sizeof($Documents)==0) {
                return Response::returnError("Document details not found.");                                                                  
             }
             
             $ProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                if (sizeof($ProfilePhoto)==0) {
                    return Response::returnError("Profile photo not found.");
             } 
             $DefaultProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `PriorityFirst`='1' and `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
             if (sizeof($DefaultProfilePhoto)==0) {
                return Response::returnError("Default Profile photo not found.");
             } 
			 $formid = "frmPuplishOTPVerification_".rand(30,3000);
		     return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
						<form method="POST" id="'.$formid.'" name="'.$formid.'">
							<div class="form-group">
								<input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Submit profile for verify</h4> <br>
								<h4 style="text-align:center;color:#ada9a9">Please Enter Your Transaction Password</h4>
							</div>
							<div class="form-group">
								<div class="input-group">
									<div class="col-sm-12">
										<div class="col-sm-2"></div>
										<div class="col-sm-8">
											<input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="width: 67%;font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">
											<button type="button" onclick="TransactionPasswordVerification(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
										</div>
										<div class="col-sm-2"></div>
									</div>
									<div class="col-sm-12" style="text-align:center">'.$errormessage.'</div>
								</div>
							</div>                                                                      
							
						</form>                                                                                                       
					</div>'; 
              
        }
		function TransactionPasswordVerification() {

            global $mysql,$loginInfo ;
            
            $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            $TransactionPassword = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (strlen(trim($TransactionPassword[0]['TransactionPassword']==$_POST['TransactionPassword'])))  {
				$res = $this->ApproveProfile();
                 
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $member[0]['MemberID'],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $data[0]['ProfileID'],
                                                              "DraftProfileCode"      => $data[0]['ProfileCode'],
                                                              "Activity"              => "Profile Approved By Admin",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $TransactionPassword[0]['AdminCode'],
                                                              "Remarks"               => "" ));
               
				return Response::returnSuccess("Profile has been Published. Profile Code ".$res['ProfileCode']);
            } else {
                return $this->TransactionPasswordSubmit("<span style='color:red'>Invalid Transaction Password.</span>",$_POST['ProfileID']);
            } 

        }

        function TransactionPasswordSubmitDAT($errormessage="",$ProfileID="") {

            global $mysql,$mail,$loginInfo;      
        
            $d = $mysql->select("select * from _tbl_profiles where DraftProfileCode='".$_POST['ProfileID']."'");
             if (sizeof($d)>0) {
                 return Response::returnError("Already processed.");
             }
              
             $EducationDetails =$mysql->select("Select * from `_tbl_draft_profiles_education_details` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                 if (sizeof($EducationDetails)==0) {
                        return Response::returnError("Education details not found."); 
                     }
             $Documents =$mysql->select("Select * from `_tbl_draft_profiles_verificationdocs` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
             if (sizeof($Documents)==0) {
                return Response::returnError("Document details not found.");                                                                  
             }
             
             $ProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
                if (sizeof($ProfilePhoto)==0) {
                    return Response::returnError("Profile photo not found.");
             } 
             $DefaultProfilePhoto =$mysql->select("Select * from `_tbl_draft_profiles_photos` where `PriorityFirst`='1' and `IsDelete`='0' and `ProfileCode`='".$_POST['ProfileID']."'"); 
             if (sizeof($DefaultProfilePhoto)==0) {
                return Response::returnError("Default Profile photo not found.");
             } 
             $formid = "frmPuplishOTPVerification_".rand(30,3000);
             return '<div id="otpfrm" style="width:100%;padding:20px;height:100%;">
                        <form method="POST" id="'.$formid.'" name="'.$formid.'">
                            <div class="form-group">
                                <input type="hidden" value="'.$_POST['ProfileID'].'" name="ProfileID">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Submit profile for verify</h4> <br>
                                <h4 style="text-align:center;color:#ada9a9">Please Enter Your Transaction Password</h4>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="col-sm-12">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-8">
                                            <input type="password"  class="form-control" id="TransactionPassword" name="TransactionPassword" style="width: 67%;font-weight: normal;font-size: 13px;text-align: center;letter-spacing: 5px;font-family:Roboto;">
                                            <button type="button" onclick="TransactionPasswordVerificationDAT(\''.$formid.'\')" class="btn btn-primary" name="btnVerify" id="verifybtn">Verify</button>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>
                                    <div class="col-sm-12" style="text-align:center">'.$errormessage.'</div>
                                </div>
                            </div>                                                                      
                            
                        </form>                                                                                                       
                    </div>'; 
              
        }
        function TransactionPasswordVerificationDAT() {

            global $mysql,$loginInfo ;
            
            $data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileID']."'"); 
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            $TransactionPassword = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (strlen(trim($TransactionPassword[0]['TransactionPassword']==$_POST['TransactionPassword'])))  {
                //$res = $this->ApproveProfile();
                $mysql->execute("update `_tbl_draft_profiles` set  `IsObservation`      = '2',
                                                                    `IsSendToAdmin`      = '1',
                                                                    `ObservationCompletedOn`      = '".date("Y-m-d H:i:s")."',
                                                                    `SendToAdminOn`      = '".date("Y-m-d H:i:s")."'
                                                                    where `ProfileCode`='".$_POST['ProfileID']."'");  
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $member[0]['MemberID'],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $data[0]['ProfileID'],
                                                              "DraftProfileCode"      => $data[0]['ProfileCode'],
                                                              "Activity"              => "Verification Proccess completed",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $TransactionPassword[0]['AdminCode'],
                                                              "Remarks"               => "" ));
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $member[0]['MemberID'],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $data[0]['ProfileID'],
                                                              "DraftProfileCode"      => $data[0]['ProfileCode'],
                                                              "Activity"              => "SubmittedToAdmin",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $TransactionPassword[0]['AdminCode'],
                                                              "Remarks"               => "" ));
                return Response::returnSuccess("Profile has been Published. Profile Code ".$res['ProfileCode']);
            } else {
                return $this->TransactionPasswordSubmit("<span style='color:red'>Invalid Transaction Password.</span>",$_POST['ProfileID']);
            } 

        }
        
    function GetManageActiveFranchisee() {
           global $mysql;    
              $Franchisees = $mysql->select("select * from _tbl_franchisees where IsActive='1'");
                return Response::returnSuccess("success",$Franchisees);

    }

    function GetManageDeactiveFranchisee() {
           global $mysql;    
              $Franchisees = $mysql->select("select * from _tbl_franchisees where IsActive='0'");
                return Response::returnSuccess("success",$Franchisees);

    }

    function GetFranchiseeInfo(){

        global $mysql;
        $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeCode='".$_POST['Code']."'");
        $FranchiseeStaff = $mysql->select("select * from _tbl_franchisees_staffs where ReferedBy='1' and FrCode='".$_POST['Code']."'");
        $PrimaryBankAccount = $mysql->select("select * from _tbl_bank_details where FranchiseeID='".$Franchisees[0]['FranchiseeID']."' and IsDelete='0'");

        return Response::returnSuccess("success",array("Franchisee"         => $Franchisees[0],
                                                       "FranchiseeStaff"    => $FranchiseeStaff[0],
                                                       "CountryNames"        => CodeMaster::getData('CONTNAMES'),
                                                       "CountryCode"    	=> CodeMaster::getData('RegisterAllowedCountries'),
                                                       "StateName"          => CodeMaster::getData('STATNAMES'),
                                                       "DistrictName"       => CodeMaster::getData('DistrictName'),
                                                       "BankNames"          => CodeMaster::getData('BANKNAMES'),
                                                       "AccountType"        => CodeMaster::getData('AccountType'),
                                                       "IDProof"        	=> CodeMaster::getData('DOCTYPES'),
                                                       "PrimaryBankAccount" => $PrimaryBankAccount,
                                                       "Gender"             => CodeMaster::getData('SEX')));

    }                                                                                  
    
    function FranchiseeResetPasswordSendMail() {
        global $mysql,$mail;
        
        $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_POST['Code']."'");
         
         $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeResetPassword'");
             $content  = str_replace("#FranchiseeName#",$Franchisees[0]['FranchiseName'],$mContent[0]['Content']);
             
             MailController::Send(array("MailTo"   => $Franchisees[0]['ContactEmail'],               
                                        "Category" => "FranchiseeResetPassword",
                                        "FranchiseeID" => $Franchisees[0]['FranchiseeID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
         
             if($mailError){
                return  Response::returnError("Error: unable to process your request.");
             } else {
                return Response::returnSuccess("Email sent successfully",array());
             }
         }
         
    function GetManagePlans() {
           global $mysql;    
           //   $Plans = $mysql->select("SELECT t1.*,  COUNT(t2.PlanID) AS cnt FROM _tbl_franchisees_plans AS t1 LEFT OUTER JOIN _tbl_franchisees AS t2 ON t1.PlanID = t2.PlanID GROUP BY t1.PlanID");
              $Plans = $mysql->select("select * from _tbl_franchisees_plans");
                return Response::returnSuccess("success",$Plans);
    }

    function GetManageActivePlans() {
           global $mysql;    
              $Plans = $mysql->select("select * from _tbl_franchisees_plans where IsActive='1'");
                return Response::returnSuccess("success",$Plans);
    }

    function GetManageDeactivePlans() {
           global $mysql;    
              $Plans = $mysql->select("select * from _tbl_franchisees_plans where IsActive='0'");
                return Response::returnSuccess("success",$Plans);
    }

    function GetNextFranchiseePlanNumber(){
            return Response::returnSuccess("success",array("PlanCode" => SeqMaster::GetNextFranchiseePlanNumber(),
                                                            "Currency"       => Configuration::CURRENCY_VALUE));
    }

    function CreateFranchiseePlan() {                                               
        global $mysql,$loginInfo;
        
        $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }

        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanName='".trim($_POST['PlanName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanCode='".trim($_POST['PlanCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Code Already Exists");
        }
        
        if($_POST['IsDefault']=="on"){
                $IsDefault='1';
                $mysql->execute("Update _tbl_franchisees_plans set IsDefault='0'");
            }   else {
                $IsDefault='0';
            } 

        $insArray = array("PlanCode"  => $_POST['PlanCode'],
                          "PlanName"  => $_POST['PlanName'],
                          "Duration"     => $_POST['Duration'],
                          "IsDefault"     => $IsDefault,
                          "CurrencyCode"  => Configuration::CURRENCY_VALUE,
                          "CreatedOn"  => date("Y-m-d H:i:s"),
                          "Amount"    => $_POST['Amount']);

        if ($_POST['ProfileActiveCommissionType'] == "INR") {
            $insArray["ProfileCommissionWithPercentage"] = '0';
            $insArray["ProfileCommissionWithRupees"] = $_POST['ProfileActiveCommission'];
        }
        if ($_POST['ProfileActiveCommissionType'] == "Percentage") {
            $insArray["ProfileCommissionWithPercentage"] = $_POST['ProfileActiveCommission'];
            $insArray["ProfileCommissionWithRupees"] = '0';
        }
        if ($_POST['ProfileRenewalCommissionType'] == "INR") {
            $insArray["RenewalCommissionWithPercentage"] ='0' ;
            $insArray["RenewalCommissionWithRupees"] = $_POST['ProfileRenewalCommission'];
        }
        if ($_POST['ProfileRenewalCommissionType'] == "Percentage") {
            $insArray["RenewalCommissionWithPercentage"] =$_POST['ProfileRenewalCommission'];
            $insArray["RenewalCommissionWithRupees"] =  '0';
        }
        if ($_POST['WalletRefillCommissionType'] == "INR") {
            $insArray["RefillCommissionWithPercentage"] = '0' ;
            $insArray["RefillCommissionWithRupees"] =$_POST['WalletRefillCommission'] ;
        }
        if ($_POST['WalletRefillCommissionType'] == "Percentage") {
            $insArray["RefillCommissionWithPercentage"] = $_POST['WalletRefillCommission'];
            $insArray["RefillCommissionWithRupees"] =  '0';
        }
        if ($_POST['ProfiledownloadCommissionType'] == "INR") {
            $insArray["ProfileDownloadCommissionWithPercentage"] = '0';
            $insArray["ProfileDownloadCommissionWithRupees"] = $_POST['ProfiledownloadCommission'];
        }
        if ($_POST['ProfiledownloadCommissionType'] == "Percentage") {
            $insArray["ProfileDownloadCommissionWithPercentage"] =$_POST['ProfiledownloadCommission'];
            $insArray["ProfileDownloadCommissionWithRupees"] =  '0';
        }

         $id = $mysql->insert("_tbl_franchisees_plans",$insArray);

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array("PlanCode"=>$_POST['PlanCode']));
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }

    function EditFranchiseePlan(){
              global $mysql,$loginInfo;
        
        $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }

        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanName='".trim($_POST['PlanName'])."' and PlanCode <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        } 
        
        if(!($_POST['IsDefault']=="on")){
             $data = $mysql->select("select * from  _tbl_franchisees_plans where IsDefault='1' PlanCode<>'".$_POST['Code']."'");
             if(sizeof($data)==0){
                return Response::returnError("Please select one default plan");
             }
        }
        
        if($_POST['IsDefault']=="on"){
                $IsDefault='1';
                $mysql->execute("Update _tbl_franchisees_plans set IsDefault='0'");
            }   else {
                $IsDefault='0';
            }
        $sql = "update _tbl_franchisees_plans set PlanName='".$_POST['PlanName']."',
                                                  Duration='".$_POST['Duration']."',
                                                  IsDefault='".$IsDefault."',
                                                  Amount='".$_POST['Amount']."',";

        if ($_POST['ProfileActiveCommissionType'] == "INR") {
            $sql .= " ProfileCommissionWithPercentage ='0', ProfileCommissionWithRupees='".$_POST['ProfileActiveCommission']."', ";
        } else if ($_POST['ProfileActiveCommissionType'] == "Percentage") {
           $sql .= " ProfileCommissionWithRupees ='0', ProfileCommissionWithPercentage='".$_POST['ProfileActiveCommission']."', ";
        }

        if ($_POST['ProfileRenewalCommissionType'] == "INR") {
            $sql .= " RenewalCommissionWithPercentage ='0', RenewalCommissionWithRupees='".$_POST['ProfileRenewalCommission']."', ";
        } else if ($_POST['ProfileRenewalCommissionType'] == "Percentage") {
            $sql .= " RenewalCommissionWithRupees ='0', RenewalCommissionWithPercentage='".$_POST['ProfileRenewalCommission']."', ";
        }

        if ($_POST['WalletRefillCommissionType'] == "INR") {
            $sql .= " RefillCommissionWithPercentage ='0', RefillCommissionWithRupees='".$_POST['WalletRefillCommission']."', ";
        } else if ($_POST['WalletRefillCommissionType'] == "Percentage") {
            $sql .= " RefillCommissionWithRupees ='0', RefillCommissionWithPercentage='".$_POST['WalletRefillCommission']."', ";
        }

        if ($_POST['ProfiledownloadCommissionType'] == "INR") {
            $sql .= " ProfileDownloadCommissionWithPercentage ='0', ProfileDownloadCommissionWithRupees='".$_POST['ProfiledownloadCommission']."' ";
        } else if ($_POST['ProfiledownloadCommissionType'] == "Percentage") {
            $sql .= " ProfileDownloadCommissionWithRupees ='0', ProfileDownloadCommissionWithPercentage='".$_POST['ProfiledownloadCommission']."' ";
        }

        $sql .= " where PlanCode='".$_POST['Code']."'";                 
        $id = $mysql->execute($sql);

        return Response::returnSuccess("success",$_POST);

    }

    function GetFranchiseePlanInfo() {
           global $mysql;    
              $Plans = $mysql->select("select * from _tbl_franchisees_plans where PlanCode='".$_POST['Code']."'");
                return Response::returnSuccess("success",array("Plan"      => $Plans[0],
                                                               "Currency"  => Configuration::CURRENCY_VALUE));
    }

    function GetFranchiseeRefillWalletManage() {
           global $mysql;    
              $RefillWallet = $mysql->select("select * from _tbl_refillwallet");
              $Franchisee = $mysql->select("select * from _tbl_franchisees where IsActive='1'");
                return Response::returnSuccess("success",array("RefillWallet" => $RefillWallet,
                                                               "Franchisee"   => $Franchisee ));
    }

    function GetFranchiseeManageNewsandEvents() {
           global $mysql;    
              $NewsandEvents = $mysql->select("select * from _tbl_franchisees_news where NewsFor='NF001'");
                return Response::returnSuccess("success",$NewsandEvents);
    }
    /* Masters */
    function GetMastersManageDetails() {
           global $mysql;
            return Response::returnSuccess("success",array("ReligionCode"        => SeqMaster::GetNextCode('RELINAMES'),
                                                           "ReligionNames"       => CodeMaster::getData('RELINAMES'),
                                                           "CasteCode"           => SeqMaster::GetNextCode('CASTNAMES'),
                                                           "CasteNames"          => CodeMaster::getData('CASTNAMES'),
                                                           "StarCode"            => SeqMaster::GetNextCode('STARNAMES'),
                                                           "StarNames"           => CodeMaster::getData('STARNAMES'),
                                                           "NationalityNameCode" => SeqMaster::GetNextCode('NATIONALNAMES'),
                                                           "NationalityNames"    => CodeMaster::getData('NATIONALNAMES'),
                                                           "IncomeRangeCode"     => SeqMaster::GetNextCode('INCOMERANGE'),
                                                           "IncomeRange"         => CodeMaster::getData('INCOMERANGE'),
                                                           "CountryCode"         => SeqMaster::GetNextCode('CONTNAMES'),
                                                           "CountryName"         => CodeMaster::getData('CONTNAMES'),
                                                           "DistrictCode"        => SeqMaster::GetNextCode('DISTNAMES'),
                                                           "DistrictName"        => CodeMaster::getData('DistrictName'),
                                                           "StateCode"           => SeqMaster::GetNextCode('STATNAMES'),
                                                           "StateName"           => CodeMaster::getData('STATNAMES'),
                                                           "ProfileSignInForCode"=> SeqMaster::GetNextCode('PROFILESIGNIN'),
                                                           "ProfileSignInFor"    => CodeMaster::getData('PROFILESIGNIN'),
                                                           "LanguageNameCode"    => SeqMaster::GetNextCode('LANGUAGENAMES'),
                                                           "LanguageName"        => CodeMaster::getData('LANGUAGENAMES'),
                                                           "MaritalStatusCode"    => SeqMaster::GetNextCode('MARTIALSTATUS'),
                                                           "MaritalStatus"        => CodeMaster::getData('MARTIALSTATUS'),
                                                           "BloodGroupCode"    => SeqMaster::GetNextCode('BLOODGROUPS'),
                                                           "BloodGroup"        => CodeMaster::getData('BLOODGROUPS'),
                                                           "ComplexionCode"    => SeqMaster::GetNextCode('COMPLEXIONS'),
                                                           "Complexion"        => CodeMaster::getData('COMPLEXIONS'),
                                                           "BodyTypeCode"    => SeqMaster::GetNextCode('BODYTYPES'),
                                                           "BodyType"        => CodeMaster::getData('BODYTYPES'),
                                                           "DietCode"    => SeqMaster::GetNextCode('DIETS'),
                                                           "Diet"        => CodeMaster::getData('DIETS'),
                                                           "HeightCode"    => SeqMaster::GetNextCode('HEIGHTS'),
                                                           "Height"        => CodeMaster::getData('HEIGHTS'),
                                                           "BankCode"    => SeqMaster::GetNextCode('BANKNAMES'),
                                                           "BankName"        => CodeMaster::getData('BANKNAMES'),
                                                           "LakanamCode"    => SeqMaster::GetNextCode('LAKANAM'),
                                                           "Lakanam"        => CodeMaster::getData('LAKANAM'),
                                                           "MonsignCode"    => SeqMaster::GetNextCode('MONSIGNS'),
                                                           "Monsign"        => CodeMaster::getData('MONSIGNS'),
                                                           "EducationDegreeCode"    => SeqMaster::GetNextCode('EDUCATIONDEGREES'),
                                                           "EducationDegree"        => CodeMaster::getData('EDUCATIONDEGREES'),
                                                           "EducationTitleCode"    => SeqMaster::GetNextCode('EDUCATETITLES'),
                                                           "EducationTitle"        => CodeMaster::getData('EDUCATETITLES'),
                                                           "OccupationTypesCode"    => SeqMaster::GetNextCode('OCCUPATIONTYPES'),
                                                           "OccupationTypes"        => CodeMaster::getData('Occupation'),
                                                           "OccupationCode"    => SeqMaster::GetNextCode('OCCUPATIONS'),          
                                                           "Occupation"        => CodeMaster::getData('OCCUPATIONS'),
                                                           "WeightCode"    => SeqMaster::GetNextCode('WEIGHTS'),
                                                           "Weight"        => CodeMaster::getData('WEIGHTS'),
                                                           "FamilyTypeCode"    => SeqMaster::GetNextCode('FAMILYTYPE'),
                                                           "FamilyType"        => CodeMaster::getData('FAMILYTYPE'),
                                                           "FamilyValueCode"    => SeqMaster::GetNextCode('FAMILYVALUE'),          
                                                           "FamilyValue"        => CodeMaster::getData('FAMILYVALUE'),
                                                           "FamilyAffluenceCode"    => SeqMaster::GetNextCode('FAMILYAFFLUENCE'),          
                                                           "FamilyAffluence"        => CodeMaster::getData('FAMILYAFFLUENCE'),
                                                           "TimeZoneCode"    => SeqMaster::GetNextCode('TIMEZONE'),          
                                                           "TimeZone"        => CodeMaster::getData('TIMEZONE'),
                                                           "CurrencyCode"    => SeqMaster::GetNextCode('CURRENCY'),          
                                                           "Currency"        => CodeMaster::getData('CURRENCY'),
                                                           "DocumentTypeCode"    => SeqMaster::GetNextCode('DOCTYPES'),          
                                                           "DocumentType"        => CodeMaster::getData('DOCTYPES'),
                                                           "CommunityCode"    => SeqMaster::GetNextCode('COMMUNITY'),          
                                                           "Community"        => CodeMaster::getData('COMMUNITY'),
                                                           "IDProofCode"    => SeqMaster::GetNextCode('IDPROOF'),          
                                                           "IDProof"        => CodeMaster::getData('IDPROOF'),
                                                           "AddressProofCode"    => SeqMaster::GetNextCode('ADDRESSPROOF'),          
                                                           "AddressProof"        => CodeMaster::getData('ADDRESSPROOF'),
                                                           "VenderTypeCode"    => SeqMaster::GetNextCode('VENDORTYPE'),          
                                                           "VenderType"        => CodeMaster::getData('VENDORTYPE')));    
    }                                                                          

    function CreateEmailApi() {

        global $mysql;  

        if (!(strlen(trim($_POST['ApiCode']))>0)) {
            return Response::returnError("Please enter api code");
        }
        if (!(strlen(trim($_POST['ApiName']))>0)) {
            return Response::returnError("Please enter api name");
        }
        if (!(strlen(trim($_POST['HostName']))>0)) {
            return Response::returnError("Please enter host name");
        }
        if (!(strlen(trim($_POST['PortNo']))>0)) {
            return Response::returnError("Please enter port number");
        }
        if (!(strlen(trim($_POST['Secure']))>0)) {
            return Response::returnError("Please enter port number");
        }
        if (!(strlen(trim($_POST['UserName']))>0)) {
            return Response::returnError("Please enter user name");
        }
        if (!(strlen(trim($_POST['Password']))>0)) {
            return Response::returnError("Please enter password");
        }
        if (!(strlen(trim($_POST['SendersName']))>0)) {
            return Response::returnError("Please enter senders name");
        }
        if (!(strlen(trim($_POST['Remarks']))>0)) {
            return Response::returnError("Please enter remarks");
        }
        $data = $mysql->select("select * from _tbl_settings_emailapi where ApiCode='".trim($_POST['ApiCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Code Already Exists");
        }
        $data = $mysql->select("select * from _tbl_settings_emailapi where ApiName='".trim($_POST['ApiName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Name Already Exists");
        }
        $data = $mysql->select("select * from _tbl_settings_emailapi where HostName='".trim($_POST['HostName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Host Name Already Exists");
        }
        $data = $mysql->select("select * from _tbl_settings_emailapi where PortNumber='".trim($_POST['PortNo'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Port Number Already Exists");
        }
        $data = $mysql->select("select * from _tbl_settings_emailapi where SMTPUserName='".trim($_POST['UserName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("User Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_settings_emailapi",array("ApiCode"     => $_POST['ApiCode'],
                                                          "ApiName"     => $_POST['ApiName'],
                                                          "HostName"    => $_POST['HostName'],
                                                          "PortNumber"  => $_POST['PortNo'],
                                                          "Secure"      => $_POST['Secure'],
                                                          "SMTPUserName"    => $_POST['UserName'],
                                                          "SMTPPassword"    => $_POST['Password'],
                                                          "SendersName" => $_POST['SendersName'],
                                                          "CreatedOn"   => date("Y-m-d H:i:s"),
                                                          "Remarks"     => $_POST['Remarks']));

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    
    function GetEmailApiCode(){
            return Response::returnSuccess("success",array("EmailApiCode"   => SeqMaster::GetNextEmailApiNumber(),
                                                           "Secure"         => CodeMaster::getData('Secure')));
    }
    
    function GetManageEmailApi() {
           global $mysql;    
              $EmailApi = $mysql->select("select * from _tbl_settings_emailapi");
                return Response::returnSuccess("success",$EmailApi);

    }
    function GetManageActiveEmailApi() {
           global $mysql;    
              $EmailApi = $mysql->select("select * from _tbl_settings_emailapi where IsActive='1'");
                return Response::returnSuccess("success",$EmailApi);

    }
    function GetManageDeactiveEmailApi() {
           global $mysql;    
              $EmailApi = $mysql->select("select * from _tbl_settings_emailapi where IsActive='0'");
                return Response::returnSuccess("success",$EmailApi);

    }
    function GetEmailApiInfo(){

        global $mysql;
        $Api = $mysql->select("select * from _tbl_settings_emailapi where ApiID='".$_POST['Code']."'");
        return Response::returnSuccess("success",array("Api"         => $Api[0],
                                                       "Secure"         => CodeMaster::getData('Secure')));

    }
    function EditEmailApi(){  

              global $mysql;     

              $data = $mysql->select("select * from _tbl_settings_emailapi where ApiName='".trim($_POST['ApiName'])."'and ApiID<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Api Name already exists");    
              }
              $data = $mysql->select("select * from _tbl_settings_emailapi where HostName='".trim($_POST['HostName'])."'and ApiID<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Host Name already exists");    
              }
              $data = $mysql->select("select * from _tbl_settings_emailapi where PortNumber='".trim($_POST['PortNo'])."'and ApiID<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Port Number already exists");    
              }
              $data = $mysql->select("select * from _tbl_settings_emailapi where SMTPUserName='".trim($_POST['UserName'])."'and ApiID<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("User Name already exists");    
              }

              if (isset($_POST['Status']) && $_POST['Status']==1) {
                   $mysql->execute("update _tbl_settings_emailapi set IsActive='0'");
              }

              $mysql->execute("update _tbl_settings_emailapi set ApiName='".$_POST['ApiName']."',
                                                        HostName='".$_POST['HostName']."',
                                                        PortNumber='".$_POST['PortNo']."',
                                                        Secure='".$_POST['Secure']."',
                                                        SMTPUserName='".$_POST['UserName']."',
                                                        SMTPPassword='".$_POST['Password']."',
                                                        SendersName='".$_POST['SendersName']."',
                                                        Remarks='".$_POST['Remarks']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  ApiID='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageBanks() {
           global $mysql;    
              $Banks = $mysql->select("select * from _tbl_settings_bankdetails");
                return Response::returnSuccess("success",$Banks);

    }

    function GetManageActiveBanks() {
           global $mysql;    
              $Banks = $mysql->select("select * from _tbl_settings_bankdetails where IsActive='1'");
                return Response::returnSuccess("success",$Banks);

    }

    function GetManageDeactiveBanks() {
           global $mysql;    
              $Banks = $mysql->select("select * from _tbl_settings_bankdetails where IsActive='0'");
                return Response::returnSuccess("success",$Banks);

    }
    function CreateBank() {

        global $mysql,$loginInfo;
        if (!(strlen(trim($_POST['AccountName']))>0)) {
            return Response::returnError("Please enter your account name");
        }
        if (!(strlen(trim($_POST['AccountNumber']))>0)) {
            return Response::returnError("Please enter account number");
        }
        if (!(strlen(trim($_POST['IFSCode']))>0)) {
            return Response::returnError("Please enter IFSCode");
        }

        $data = $mysql->select("select * from  _tbl_settings_bankdetails where AccountName='".trim($_POST['AccountName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Account Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_settings_bankdetails where AccountNumber='".trim($_POST['AccountNumber'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Account Number Already Exists");
        }
        $BankName = CodeMaster::getData("BANKNAMES",$_POST['BankName']);
         $id = $mysql->insert("_tbl_settings_bankdetails",array("BankCode"             => $BankName[0]['SoftCode'],
                                                                "BankName"             => $BankName[0]['CodeValue'],
                                                                "AccountName"             => $_POST['AccountName'],
                                                                "AccountNumber"           => $_POST['AccountNumber'],
                                                                "IFSCode"                 => $_POST['IFSCode'] ));

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function GetBank(){
            return Response::returnSuccess("success",array("BankName"    => CodeMaster::getData('BANKNAMES')));
        }
    function BankDetailsForView() {
           global $mysql;    
        $Banks = $mysql->select("select * from _tbl_settings_bankdetails where BankID='".$_POST['Code']."'");

        return Response::returnSuccess("success",array("ViewBankDetails"    => $Banks[0],
                                                       "BankName"           => CodeMaster::getData('BANKNAMES')));
    }
    function EditBankDetails(){
              global $mysql,$loginInfo;
       if (!(strlen(trim($_POST['AccountName']))>0)) {
            return Response::returnError("Please enter your account name");
        }
        if (!(strlen(trim($_POST['AccountNumber']))>0)) {
            return Response::returnError("Please enter account number");
        }
        if (!(strlen(trim($_POST['IFSCode']))>0)) {
            return Response::returnError("Please enter IFSCode");
        }
        $data = $mysql->select("select * from  _tbl_settings_bankdetails where AccountName='".trim($_POST['AccountName'])."' and BankID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Account Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_settings_bankdetails where AccountNumber='".trim($_POST['AccountNumber'])."' and BankID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Account Number Already Exists");
        } 
        $mysql->execute("update _tbl_settings_bankdetails set BankName='".$_POST['BankName']."',
                                                        AccountName='".$_POST['AccountName']."',
                                                        AccountNumber='".$_POST['AccountNumber']."',
                                                        IFSCode='".$_POST['IFSCode']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  BankID='".$_POST['Code']."'");

         return Response::returnSuccess("success",array());

    }
     function GetListMemberBankRequests() {
             global $mysql,$loginInfo;
             return Response::returnSuccess("success",$mysql->select("select * from  `_tbl_wallet_bankrequests` order by `ReqID` DESC "));
         }

     function PaypalRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT PaypalID,TransactionOn,Amount, 
                            CASE
                                WHEN   ((IsSuccess=0) AND (IsFailure=0)) THEN 'Pending'
                                WHEN   ((IsSuccess=1) AND (IsFailure=0)) THEN 'Success'
                                WHEN   ((IsSuccess=0) AND (IsFailure=1)) THEN 'Failure'
                            END AS TxnStatus
                     FROM _tbl_wallet_paypalrequests ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql." order by `PaypalID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsSuccess='0' AND IsFailure='0'ORDER BY `PaypalID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsSuccess='1' AND IsFailure='0'ORDER BY `PaypalID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsSuccess='0' AND IsFailure='1'ORDER BY `PaypalID` DESC "));
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Report") {

                 $fromDate = $_POST['FromDate'];
                 $toDate   = $_POST['ToDate'];

                 switch ($_POST['filter']) {

                     case 'All'     : $sql .= " where ( date(`TransactionOn`)>=date('".$fromDate."') and date(`TransactionOn`)<=date('".$toDate."'))";
                                      break;
                     case 'Pending' : $sql .= "  where `IsSuccess`='0' and `IsFailure`='0' and ( date(`TransactionOn`)>=date('".$fromDate."') and date(`TransactionOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Success' : $sql .= "  where `IsSuccess`='1' and `IsFailure`='0' and ( date(`TransactionOn`)>=date('".$fromDate."') and date(`TransactionOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Failure' : $sql .= "  where `IsSuccess`='0' and `IsFailure`='1' and ( date(`TransactionOn`)>=date('".$fromDate."') and date(`TransactionOn`)<=date('".$toDate."'))   ";
                                      break;
                     default :  Response::returnSuccess("success",array());  
                                  break; 
                 }
                 if (isset($_POST['MemberCode']) && strlen(trim($_POST['MemberCode']))>0 ) {
                    $mem = $mysql->select("select * from _tbl_members where `MemberCode`='".$_POST['MemberCode']."'");
                    if (sizeof($mem)>0) {
                        $sql .=  ($_POST['filter']=="All")  ? " where `MemberID`='".$mem[0]['MemberID']."' "         
                                                            : " and `MemberID`='".$mem[0]['MemberID']."' " ;
                    } else {
                       Response::returnSuccess("success",array());
                    }
                 }
                 $sql .= "  order by `PaypalID` DESC ";

                return Response::returnSuccess("success",$mysql->select($sql));    
             } 
             //return error
         }

     function MemberBankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT *, 
                            CASE
                                WHEN   ((IsApproved=0) AND (IsRejected=0)) THEN 'Pending'
                                WHEN   ((IsApproved=1) AND (IsRejected=0)) THEN 'Success'
                                WHEN   ((IsApproved=0) AND (IsRejected=1)) THEN 'Failure'
                            END AS TxnStatus
                     FROM _tbl_wallet_bankrequests ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."WHERE IsMember='1' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='1' and IsApproved='0' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='1' and IsApproved='1' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='1' and IsApproved='0' AND IsRejected='1' ORDER BY `ReqID` DESC "));
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Report") {

                 $fromDate = $_POST['FromDate'];
                 $toDate   = $_POST['ToDate'];

                 switch ($_POST['filter']) {

                     case 'All'     : $sql .= " where `IsMember`='1' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))";
                                      break;
                     case 'Pending' : $sql .= "  where `IsMember`='1' and `IsApproved`='0' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Success' : $sql .= "  where `IsMember`='1' and `IsApproved`='1' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Failure' : $sql .= "  where `IsMember`='1' and `IsApproved`='0' and `IsRejected`='1' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     default :  Response::returnSuccess("success",array());  
                                  break; 
                 }
                 if (isset($_POST['MemberCode']) && strlen(trim($_POST['MemberCode']))>0 ) {
                    $mem = $mysql->select("select * from _tbl_members where `MemberCode`='".$_POST['MemberCode']."'");
                    if (sizeof($mem)>0) {
                        $sql .=  ($_POST['filter']=="All")  ? " where `MemberID`='".$mem[0]['MemberID']."' "         
                                                            : " and `MemberID`='".$mem[0]['MemberID']."' " ;
                    } else {
                       Response::returnSuccess("success",array());
                    }
                 }
                 $sql .= "  order by `ReqID` DESC ";

                return Response::returnSuccess("success",$mysql->select($sql));    
             } 
             //return error
         }
         function FranchiseeBankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT *, 
                            CASE
                                WHEN   ((IsApproved=0) AND (IsRejected=0)) THEN 'Pending'
                                WHEN   ((IsApproved=1) AND (IsRejected=0)) THEN 'Success'
                                WHEN   ((IsApproved=0) AND (IsRejected=1)) THEN 'Failure'
                            END AS TxnStatus
                     FROM _tbl_wallet_bankrequests ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql."WHERE IsMember='0' order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='0' and IsApproved='0' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='0' and IsApproved='1' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsMember='0' and IsApproved='0' AND IsRejected='1' ORDER BY `ReqID` DESC "));
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Report") {

                 $fromDate = $_POST['FromDate'];
                 $toDate   = $_POST['ToDate'];

                 switch ($_POST['filter']) {

                     case 'All'     : $sql .= " where `IsMember`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))";
                                      break;
                     case 'Pending' : $sql .= "  where `IsMember`='0' and `IsApproved`='0' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Success' : $sql .= "  where `IsMember`='0' and `IsApproved`='1' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Failure' : $sql .= "  where `IsMember`='0' and `IsApproved`='0' and `IsRejected`='1' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     default :  Response::returnSuccess("success",array());  
                                  break; 
                 }
                 if (isset($_POST['MemberCode']) && strlen(trim($_POST['MemberCode']))>0 ) {
                    $mem = $mysql->select("select * from _tbl_members where `MemberCode`='".$_POST['MemberCode']."'");
                    if (sizeof($mem)>0) {
                        $sql .=  ($_POST['filter']=="All")  ? " where `MemberID`='".$mem[0]['MemberID']."' "         
                                                            : " and `MemberID`='".$mem[0]['MemberID']."' " ;
                    } else {
                       Response::returnSuccess("success",array());
                    }
                 }
                 $sql .= "  order by `ReqID` DESC ";

                return Response::returnSuccess("success",$mysql->select($sql));    
             } 
             //return error
         }

         function ManagePaypal() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_settings_paypal` ";

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
    function PaypalDetailsForView() {
           global $mysql;    
        $Paypals = $mysql->select("select * from `_tbl_settings_paypal` where `PaypalID`='".$_POST['Code']."'");

        return Response::returnSuccess("success",array("ViewPaypalDetails"    => $Paypals[0]));
    }
    function GetPaypalCode(){
            return Response::returnSuccess("success",array("PaypalCode" => SeqMaster::GetNextPaypalNumber()));
    }
    /*function CreatePaypal() {

        global $mysql,$loginInfo;
        if (!(strlen(trim($_POST['PaypalName']))>0)) {
            return Response::returnError("Please enter paypal name");
        }
        if (!(strlen(trim($_POST['PaypalEmailID']))>0)) {
            return Response::returnError("Please enter paypal email id");
        }
        if (!(strlen(trim($_POST['Remarks']))>0)) {
            return Response::returnError("Please enter remarks");
        }
        if (!(strlen(trim($_POST['PaypalCode']))>0)) {
            return Response::returnError("Please enter paypal code");
        }

        $data = $mysql->select("select * from  _tbl_settings_paypal where PaypalCode='".trim($_POST['PaypalCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Paypal Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_settings_paypal where PaypalName='".trim($_POST['PaypalName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Paypal Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_settings_paypal where PaypalEmailID='".trim($_POST['PaypalEmailID'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Paypal Email ID Already Exists");
        }

         $id =  $mysql->insert("_tbl_settings_paypal",array("PaypalCode"     => $_POST['PaypalCode'],
                                                            "PaypalName"     => $_POST['PaypalName'],
                                                            "PaypalEmailID"  => $_POST['PaypalEmailID'],
                                                            "Remarks"        => $_POST['Remarks']));  
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }*/
    function EditPaypal(){
              global $mysql,$loginInfo;

    $mysql->execute("update `_tbl_settings_paypal` set Remarks='".$_POST['Remarks']."',
                                                 IsActive='".$_POST['Status']."'
                                                 where  PaypalID='".$_POST['Code']."'");

                return Response::returnSuccess("success",array());

    }
    function ManageSettingsMobileSms() {    

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_settings_mobilesms` ";

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
         function GetIndividualMessage() {    

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_send_individual_message` WHERE `MessageFromID`='".$loginInfo[0]['AdminID']."'";

             if (isset($_POST['Request']) && $_POST['Request']=="SMS") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsSMS`='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Email") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsEmail`='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Messages") {
                 return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_board` where `FromID`='".$loginInfo[0]['AdminID']."'"));    
             }
         }
         function GetIndividualMessageInfo() {    

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_send_individual_message` WHERE `MessageFromID`='".$loginInfo[0]['AdminID']."' and `ManualSendID`='".$_POST['Code']."'";

             if (isset($_POST['Request']) && $_POST['Request']=="SMS") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsSMS`='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Email") {
                 return Response::returnSuccess("success",$mysql->select($sql." and `IsEmail`='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Messages") {
                 return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_board` where `FromID`='".$loginInfo[0]['AdminID']."' and `BoardID`='".$_POST['Code']."'"));    
             }
         }
    function GetSettingsMobileApiCode(){     
            return Response::returnSuccess("success",array("MobileApiCode" => SeqMaster::GetNextMobileApiNumber(),
                                                           "SMSMethod"        => CodeMaster::getData('SMSMETHOD'),
                                                           "Timedout"        => CodeMaster::getData('TIMEDOUT')));
    }
     function CreateSettingsMobileSms() {

        global $mysql,$loginInfo;
        if (!(strlen(trim($_POST['ApiCode']))>0)) {
            return Response::returnError("Please enter api code");
        }
        if (!(strlen(trim($_POST['ApiName']))>0)) {
            return Response::returnError("Please enter api name");
        }
        if (!(strlen(trim($_POST['ApiUrl']))>0)) {
            return Response::returnError("Please enter api url");
        }
        if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return Response::returnError("Please enter mobile number");
        }
        if (!(strlen(trim($_POST['MessageText']))>0)) {
            return Response::returnError("Please enter message");
        }
        if (!(strlen(trim($_POST['Method']))>0)) {
            return Response::returnError("Please enter method");
        }
        if (!(strlen(trim($_POST['TimedOut']))>0)) {
            return Response::returnError("Please enter timed out");
        }
        if (!(strlen(trim($_POST['Remarks']))>0)) {
            return Response::returnError("Please enter remarks");
        }

        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `ApiCode`='".trim($_POST['ApiCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Code Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `ApiName`='".trim($_POST['ApiName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Name Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `ApiUrl`='".trim($_POST['ApiUrl'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api url Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `MobileNumber`='".trim($_POST['MobileNumber'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Mobile Number Already Exists");
        }

         $id =  $mysql->insert("_tbl_settings_mobilesms",array("ApiCode"      => $_POST['ApiCode'],
                                                          "ApiName"      => $_POST['ApiName'],
                                                          "ApiUrl"       => $_POST['ApiUrl'],
                                                          "MobileNumber" => $_POST['MobileNumber'],
                                                          "MessageText"  => $_POST['MessageText'],
                                                          "Method"       => $_POST['Method'],
                                                          "TimedOut"     => $_POST['TimedOut'],
                                                          "CreatedOn"   => date("Y-m-d H:i:s"),
                                                          "Remarks"      => $_POST['Remarks']));  
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");     
            }
    }
    function EditSettingsMobileApi(){
              global $mysql,$loginInfo;
        if (!(strlen(trim($_POST['ApiName']))>0)) {
            return Response::returnError("Please enter api name");
        }
        if (!(strlen(trim($_POST['ApiUrl']))>0)) {
            return Response::returnError("Please enter api url");
        }
        if (!(strlen(trim($_POST['MobileNumber']))>0)) {
            return Response::returnError("Please enter mobile number");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `ApiName`='".trim($_POST['ApiName'])."' and `ApiID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Name Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `ApiUrl`='".trim($_POST['ApiUrl'])."' and `ApiID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Api Url Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_settings_mobilesms` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and `ApiID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("mobile number Already Exists");
        } 
        $mysql->execute("update _tbl_settings_mobilesms set ApiName='".$_POST['ApiName']."',
                                                        ApiUrl='".$_POST['ApiUrl']."',
                                                        MobileNumber='".$_POST['MobileNumber']."',
                                                        MessageText='".$_POST['MessageText']."',
                                                        Method='".$_POST['Method']."',
                                                        TimedOut='".$_POST['TimedOut']."',
                                                        Remarks='".$_POST['Remarks']."',
                                                        IsActive='".$_POST['Status']."'
                                                        where  ApiID='".$_POST['Code']."'");

         return Response::returnSuccess("success",array());

    }
    function SettingsMobileApiDetailsForView() {
           global $mysql;    
        $MobileApis = $mysql->select("select * from `_tbl_settings_mobilesms` where `ApiID`='".$_POST['Code']."'");

        return Response::returnSuccess("success",array("ViewMobileApiDetails"    => $MobileApis[0],
                                                        "SMSMethod"        => CodeMaster::getData('SMSMETHOD'),
                                                        "Timedout"        => CodeMaster::getData('TIMEDOUT')));
    }
    function GetListMemberDocuments() {
             global $mysql,$loginInfo;
             return Response::returnSuccess("success",$mysql->select("select * from  `_tbl_member_documents` order by `DocID` DESC "));
         }
     function GetManageMembers() {    

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
                        ON _tbl_members.ReferedBy=`_tbl_franchisees`.FranchiseeID ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `_tbl_members`.`IsActive`='1' and `_tbl_members`.`IsDeleted`='0'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `_tbl_members`.`IsActive`='0' and `_tbl_members`.`IsDeleted`='0'"));    
             }
             
             if (isset($_POST['Request']) && $_POST['Request']=="Deleted") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `_tbl_members`.`IsDeleted`='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="FranchiseeWise") {
                 return Response::returnSuccess("success",$mysql->select("SELECT t1.*,  COUNT(t2.MemberID) AS MemberCount FROM _tbl_franchisees AS t1
                                                                            LEFT OUTER JOIN _tbl_members AS t2 ON t1.FranchiseeID = t2.ReferedBy GROUP BY t1.FranchiseeID"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="OnlineMembers") {
                 $Onlines=$mysql->select("SELECT MemberID FROM _tbl_logs_logins where FranchiseeID='0' and FranchiseeStaffID='0' and AdminID='0' and AdminStaffID='0' and date(LoginOn)=date('".date("Y-m-d")."')");
                 foreach($Onlines as $Online){
                    return Response::returnSuccess("success",$mysql->select($sql." where `_tbl_members`.`MemberID`='".$Online['MemberID']."'"));    
                 }
             }
         }
         function GetManageFreeMembers() {
           global $mysql;    
           $Plan= $mysql->select("select * from _tbl_member_plan where IsDefault='1'");
             $sql = $mysql->select("SELECT * FROM _tbl_members
                              LEFT  JOIN _tbl_profile_credits
                              ON _tbl_members.MemberID=_tbl_profile_credits.MemberID where _tbl_profile_credits.MemberPlanCode='".$Plan[0]['PlanCode']."'");
            return Response::returnSuccess("success",$sql);    
         }
         function GetManagePaidMembers() {
           global $mysql;    
           $Plan= $mysql->select("select * from _tbl_member_plan where IsDefault<>'1'");
             $sql = $mysql->select("SELECT * FROM _tbl_members
                              LEFT  JOIN _tbl_profile_credits
                              ON _tbl_members.MemberID=_tbl_profile_credits.MemberID where _tbl_profile_credits.MemberPlanCode='".$Plan[0]['PlanCode']."'");
            return Response::returnSuccess("success",$sql);    
         }    

         function GetMemberInfo() {
           global $mysql;    
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
                                     _tbl_members.DeactivatedOn AS DeactivatedOn,
                                     _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                     _tbl_franchisees.FranchiseName AS FranchiseName,
                                     _tbl_franchisees.FranchiseeID AS FranchiseeID,
                                     _tbl_members.CreatedBy AS CreatedBy,
                                     _tbl_members.CreatedOn AS CreatedOn,
                                     _tbl_franchisees.IsActive AS FIsActive,
                                     _tbl_members.IsActive AS IsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.MemberCode='".$_POST['Code']."'");
        
		$Documents = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."'");               
		$IDProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."' and DocumentType='Id Proof' order by `DocID` DESC ");               
        $AddressProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$Members[0]['MemberID']."' and DocumentType='Address Proof' order by `DocID` DESC ");               
		$CurrentPlan = $mysql->select("select * from `_tbl_profile_credits` where MemberCode='".$_POST['Code']."' order by `ProfileCreditID` DESC ");               
        $Plan =  $mysql->select("SELECT *
                                FROM _tbl_member_plan
                                LEFT  JOIN _tbl_profile_credits  
                                ON _tbl_member_plan.PlanCode=_tbl_profile_credits.MemberPlanCode where _tbl_profile_credits.MemberCode='".$_POST['Code']."'");    
        $BoardMessage = $mysql->select("select * from `_tbl_board` where ToMemberCode='".$_POST['Code']."' and BoardID='".$_POST['BoardID']."'");
        $IndividualSMS = $mysql->select("select * from `_tbl_send_individual_message` where MessageToMemberCode='".$_POST['Code']."' and ManualSendID='".$_POST['ManualSendID']."' and IsSms='1'");
        $IndividualEmail = $mysql->select("select * from `_tbl_send_individual_message` where MessageToMemberCode='".$_POST['Code']."' and ManualSendID='".$_POST['ManualSendID']."' and IsEmail='1'");
        return Response::returnSuccess("success"."select * from `_tbl_member_documents` where MemberID='".$_POST['Code']."'",array("MemberInfo"    => $Members[0],
                                                       "Countires"     =>CodeMaster::getData('RegisterAllowedCountries'),
                                                       "Gender"        =>CodeMaster::getData('SEX'),
													   "IDProof"       => $IDProofs,
                                                       "AddressProof"  => $AddressProofs,
                                                       "BoardMessage"  => $BoardMessage[0],
                                                       "IndividualSMS"  => $IndividualSMS[0],
                                                       "IndividualEmail"  => $IndividualEmail[0],
                                                       "Plan" => $Plan[0]));
    }
    
  function GetFranchiseeInfoInFranchiseeWise() {        
           global $mysql;    
        $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeCode='".$_POST['Code']."'");
        $Members = $mysql->select("select * from _tbl_members where ReferedBy='".$Franchisees[0]['FranchiseeID']."'");
        return Response::returnSuccess("success",array("FranchiseeInfo"    => $Franchisees[0],
                                                       "Member"    => $Members));
    }
    function ViewMemberEditScreen(){
              global $mysql,$loginInfo;    
               $rand = md5(time().$_POST['MemberCode']."@#!-&*+");  
               
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                    $id = $mysql->insert("_tbl_member_edit",array("MemberCode"           => $_POST['MemberCode'],
                                                                  "TransactionPassword"  => $_POST['txnPassword'],
                                                                  "Session"              => $rand,
                                                                  "AdminID"              => $loginInfo[0]['AdminID'],
                                                                  "ViewEditOn"           => date("Y-m-d H:i:s"))); 
                     echo "<script>location.href='".AppPath."Members/EditMember/".$_POST['MemberCode'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         } 
    function ViewMemberScreen(){
              global $mysql,$loginInfo;    
               $rand = md5(time().$_POST['MemberCode']."@#!-&*+");    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                    $id = $mysql->insert("_tbl_member_edit",array("MemberCode"            => $_POST['MemberCode'],
                                                                  "TransactionPassword"  => $_POST['txnPassword'],
                                                                  "Session"              => $rand,
                                                                  "AdminID"              => $loginInfo[0]['AdminID'],
                                                                  "ViewEditOn"              => date("Y-m-d H:i:s"))); 
                     echo "<script>location.href='".AppPath."Members/ViewMember/".$_POST['MemberCode'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
    function EditMemberInfo(){
              global $mysql,$loginInfo;

       $data = $mysql->select("select * from  `_tbl_members` where `EmailID`='".trim($_POST['EmailID'])."' and `MemberCode` <>'".$_POST['MemberCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Email ID Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_members` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and `MemberCode` <>'".$_POST['MemberCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Already Exists");
        } 
		if (strlen(trim($_POST['WhatsappNumber']))>0) {
			$allowDuplicateWhatsapp = $mysql->select("select * from `_tbl_master_codemaster` where  `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateWhatsapp'");
             if ($allowDuplicateWhatsapp[0]['ParamA']==0) {
                $data = $mysql->select("select * from  _tbl_members where WhatsappNumber='".trim($_POST['WhatsappNumber'])."' and MemberCode <>'".$_POST['MemberCode']."' ");
                    if (sizeof($data)>0) {
                        return Response::returnError("WhatsappNumber Already Exists");
                    }
             }
			}
        $MemberInfo =  $mysql->select("select * from  `_tbl_members` where `MemberCode` ='".$_POST['MemberCode']."'");
        if($MemberInfo[0]['MobileNumber'] <> $_POST['MobileNumber']){
              $mysql->execute("update _tbl_members set IsMobileVerified='0' where MemberCode='".$_POST['MemberCode']."'");
        } 
        if($MemberInfo[0]['EmailID'] <> $_POST['EmailID']){
              $mysql->execute("update _tbl_members set IsEmailVerified='0' where MemberCode='".$_POST['MemberCode']."'");
        }
			$dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
			$Sex = CodeMaster::getData("SEX",$_POST['Sex']);	
        $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
												 SexCode='".$_POST['Sex']."',
                                                 Sex='".$Sex[0]['CodeValue']."',
                                                 EmailID='".$_POST['EmailID']."',
                                                 CountryCode='".$_POST['CountryCode']."',
												 MobileNumber='".$_POST['MobileNumber']."',
												 WhatsappCountryCode='".$_POST['WhatsappCountryCode']."',
												 WhatsappNumber='".$_POST['WhatsappNumber']."' where  MemberCode='".$_POST['MemberCode']."'");

         return Response::returnSuccess("success",array());

    }
	function MemberChnPswd() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
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
												"MemberCode" 	 => $Member[0]['MemberCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPswd']."");   
				 
				 return Response::returnSuccess("Success",array());  
            }
        
    }
    function GetEmailLogs() {    

             global $mysql,$loginInfo;  
             
             /*SELECT * FROM _tbl_logs_email
INNER JOIN _tbl_members
ON _tbl_members.MemberID = _tbl_logs_email.MemberID
INNER JOIN _tbl_franchisees
ON _tbl_franchisees.FranchiseeID = _tbl_franchisees.FranchiseeID*/


             $sql = "SELECT EmailRequestedOn,EmailTo,MemberID,EmailSubject,EmaildFor,FranchiseeID,AdminID, 
                            CASE
                                WHEN   ((IsSuccess=1) AND (IsFailure=0)) THEN 'Success'
                                WHEN   ((IsSuccess=0) AND (IsFailure=1)) THEN 'Failure'
                            END AS Status
                     FROM _tbl_logs_email ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }
                                                                                                                                
             if (isset($_POST['Request']) && $_POST['Request']=="Member") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE FranchiseeID ='0' and AdminID ='0'"));    
             }
             
             if (isset($_POST['Request']) && $_POST['Request']=="Franchisee") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE MemberID ='0' and AdminID ='0'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsSuccess`='1'"));    
             }                                                                                                

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsSuccess`='0'"));    
             }
         }
    function GetLoginLogs() {    

             global $mysql,$loginInfo;    

             $sql = "select * from _tbl_logs_logins ";
             /*$sql = SELECT * FROM _tbl_logs_logins
                                    INNER JOIN _tbl_members
                                    ON _tbl_members.MemberID = _tbl_logs_logins.MemberID
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_franchisees.FranchiseeID = _tbl_logs_logins.FranchiseeID"; */

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Member") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `FranchiseeID` ='0' and `FranchiseeStaffID` ='0' and `AdminID` ='0' and `AdminStaffID`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Franchisee") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `MemberID` ='0' and `FranchiseeStaffID` ='0' and `AdminID` ='0' and `AdminStaffID`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `LoginStatus`= '1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `LoginStatus`= '0'"));    
             }

         } 
         function GetActivityHistory() {    

             global $mysql,$loginInfo;    

             $sql = "SELECT *
                        FROM _tbl_logs_activity
                        LEFT  JOIN _tbl_members  
                        ON _tbl_logs_activity.MemberID=_tbl_members.MemberID ";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql." ORDER BY `ActivityID` DESC"));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Member") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `FranchiseeID` ='0' ORDER BY `ActivityID` DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Franchisee") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `MemberID` ='0' ORDER BY `ActivityID` DESC"));    
             }
         }
         
         function GetManageMemberPlan() {    

             global $mysql,$loginInfo;    

             $sql = "SELECT * FROM _tbl_member_plan
					LEFT JOIN
					(SELECT MemberPlanID, COUNT(*) AS cnt FROM _tbl_profile_credits WHERE MemberPlanID>0  GROUP BY MemberPlanID) tbl2
					ON
					_tbl_member_plan.PlanID=tbl2.MemberPlanID";
			 
			
			 if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE _tbl_member_plan.IsActive ='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE _tbl_member_plan.IsActive ='0'"));    
             }
         }
         
         function GetMemberPlanCode() {
            return Response::returnSuccess("success",array("PlanCode" => SeqMaster::GetNextPlanCode()));
         }
         
    function CreateMemberPlan() {

        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
		if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
			return Response::returnError("Invalid transaction password");   
		}
      
        $data = $mysql->select("select * from  _tbl_member_plan where PlanCode='".trim($_POST['PlanCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_member_plan where PlanName='".trim($_POST['PlanName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        }
        
        if($_POST['IsDefault']=="on"){
                $IsDefault='1';
                $mysql->execute("Update _tbl_member_plan set IsDefault='0'");
            }   else {
                $IsDefault='0';
            }
        
         $id =  $mysql->insert("_tbl_member_plan",array("PlanCode"                           => $_POST['PlanCode'],
                                                           "PlanName"                           => $_POST['PlanName'],
                                                           "Decreation"                         => $_POST['Decreation'],
                                                           "Amount"                             => $_POST['Amount'],
                                                           "Photos"                             => $_POST['Photos'],
                                                           "Videos"                             => $_POST['Videos'],
                                                           "Freeprofiles"                       => $_POST['Freeprofiles'],
                                                           "ShortDescription"                   => $_POST['ShortDescription'],
                                                           "DetailDescription"                  => $_POST['DetailDescription'],
                                                           "Remarks"                            => $_POST['Remarks'],
                                                           "IsDefault"                           => $IsDefault,
                                                           "CreatedOn"                          => date("Y-m-d H:i:s"))); 

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Failure");   
            }
    }
    
    function EditMemberPlan(){
              global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        
        $data = $mysql->select("select * from  _tbl_member_plan where PlanName='".trim($_POST['PlanName'])."' and PlanCode <>'".$_POST['PlanCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        }   /* Videos='".$_POST['Videos']."',*/
		if(!($_POST['IsDefault']=="on")){
             $data = $mysql->select("select * from  _tbl_member_plan where IsDefault='1' PlanCode<>'".$_POST['PlanCode']."'");
             if(sizeof($data)==0){
                return Response::returnError("Please select one default plan");
             }
        }
		$Subscribed = $mysql->select("SELECT * FROM _tbl_member_plan
											LEFT JOIN
											(SELECT MemberPlanID, COUNT(*) AS cnt FROM _tbl_profile_credits WHERE MemberPlanID>0  GROUP BY MemberPlanID) tbl2
											ON
											_tbl_member_plan.PlanID=tbl2.MemberPlanID where _tbl_member_plan.PlanCode='".$_POST['PlanCode']."'");
		
        if($_POST['IsDefault']=="on"){
                $IsDefault='1';
                $mysql->execute("Update _tbl_member_plan set IsDefault='0'");
            }   else {
                $IsDefault='0';
            }
        
		if($Subscribed[0]['cnt']>0) { 
			$mysql->execute("update _tbl_member_plan set ShortDescription='".$_POST['ShortDescription']."',
														 DetailDescription='".$_POST['DetailDescription']."',
														 Remarks='".$_POST['Remarks']."',
                                                         IsDefault='".$IsDefault."'
														 where  PlanCode='".$_POST['PlanCode']."'");
			return Response::returnSuccess("success",array());
		}else {
		
        $mysql->execute("update _tbl_member_plan set PlanName='".$_POST['PlanName']."',
                                                 Decreation='".$_POST['Decreation']."',
                                                 Amount='".$_POST['Amount']."',
                                                 Photos='".$_POST['Photos']."',
												 FreeProfiles='".$_POST['Freeprofiles']."',
                                                 ShortDescription='".$_POST['ShortDescription']."',
                                                 DetailDescription='".$_POST['DetailDescription']."',
                                                 Remarks='".$_POST['Remarks']."',
                                                 IsDefault='".$IsDefault."'
                                                 where  PlanCode='".$_POST['PlanCode']."'");

         return Response::returnSuccess("success".$Subscribed['cnt'],array());
		}

    }
    
     function GetMemberPlanInfo() {
        global $mysql;    
            $Plans = $mysql->select("select * from _tbl_member_plan where PlanCode='".$_POST['Code']."'");
            $Subscribed = $mysql->select("SELECT * FROM _tbl_member_plan
											LEFT JOIN
											(SELECT MemberPlanID, COUNT(*) AS cnt FROM _tbl_profile_credits WHERE MemberPlanID>0  GROUP BY MemberPlanID) tbl2
											ON
											_tbl_member_plan.PlanID=tbl2.MemberPlanID where _tbl_member_plan.PlanCode='".$_POST['Code']."'");
		    
        	return Response::returnSuccess("success",array("Plans" => $Plans[0],
														   "SubscribedPlan" => $Subscribed[0],
                                                           "Currency"  => Configuration::CURRENCY_VALUE));
    }
         
         function GetRequestforDocumentVerification() {    

             global $mysql,$loginInfo;    

             $sql = "SELECT * FROM `_tbl_member_documents`";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql." ORDER BY `DocID` DESC"));    
             }
         } 
         function GetDashBoardItems(){
             global $mysql;
             
             $Plan= $mysql->select("select * from _tbl_member_plan where IsDefault='1'");
             $memberCount = $mysql->select("SELECT COUNT(MemberID) AS cnt FROM _tbl_members");
             $member =  $mysql->select("SELECT * FROM `_tbl_members` ORDER BY `MemberID` DESC LIMIT 3");
             $profilecount =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM _tbl_profiles");
             $profile =  $mysql->select("SELECT * FROM `_tbl_draft_profiles` ORDER BY `ProfileID` DESC LIMIT 3");
             $MaleProfileCount =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM `_tbl_draft_profiles` where SexCode='SX001' ORDER BY `ProfileID` DESC LIMIT 3");
             $FemaleProfileCount =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM `_tbl_draft_profiles` where SexCode='SX002' ORDER BY `ProfileID` DESC LIMIT 3");
             $profileverification =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM _tbl_draft_profiles where RequestToVerify='1' and IsApproved='0'");
             $documentverification =  $mysql->select("SELECT COUNT(DocID) AS cnt FROM _tbl_member_documents");
             $ordercount =  $mysql->select("SELECT COUNT(OrderID) AS cnt FROM _tbl_orders");
             $invoicecount =  $mysql->select("SELECT COUNT(InvoiceID) AS cnt FROM _tbl_invoices");
             $paypalcount =  $mysql->select("SELECT COUNT(PaypalID) AS cnt FROM _tbl_settings_paypal");
             $OnlineMembercount =  $mysql->select("SELECT COUNT(LoginID) AS cnt FROM _tbl_logs_logins where FranchiseeID='0' and FranchiseeStaffID='0' and AdminID='0' and AdminStaffID='0' and date(LoginOn)=date('".date("Y-m-d")."')");
             
             $MemberWalletRequestCount =  $mysql->select("SELECT COUNT(ReqID) AS cnt FROM _tbl_wallet_bankrequests where IsMember='1'"); 
             $FranchiseeWalletRequestCount =  $mysql->select("SELECT COUNT(ReqID) AS cnt FROM _tbl_wallet_bankrequests where IsMember='0'"); 
             $FreeMemberCount =  $mysql->select("SELECT COUNT(ProfileCreditID) AS cnt FROM _tbl_profile_credits where MemberPlanCode='".$Plan[0]['PlanCode']."'"); 
             $PaidMemberCount =  $mysql->select("SELECT COUNT(ProfileCreditID) AS cnt FROM _tbl_profile_credits where MemberPlanCode!='".$Plan[0]['PlanCode']."'"); 
             $LandingPageProfileCount =  $mysql->select("SELECT COUNT(ProfileLandingID) AS cnt FROM _tbl_landingpage_profiles where Date(_tbl_landingpage_profiles.`DateTo`)>=Date('".date("Y-m-d")."') AND `IsShow`='1'"); 
             $FranchiseeCount =  $mysql->select("SELECT COUNT(FranchiseeID) AS cnt FROM _tbl_franchisees"); 
                
                return Response::returnSuccess("success",array("MemberCount"                  => $memberCount,
                                                               "Member"                       => $member,               
                                                               "ProfileCount"                 => $profilecount,
                                                               "Profile"                      => $profile,
                                                               "MaleProfileCount"             => $MaleProfileCount,
                                                               "FemaleProfileCount"           => $FemaleProfileCount,
                                                               "OrderCount"                   => $ordercount,
                                                               "InvoiceCount"                 => $invoicecount,
                                                               "PaypalCount"                  => $paypalcount,
                                                               "Document"                     => $documentverification,
                                                               "ProfileVerification"          => $profileverification,
                                                               "MemberWalletRequestCount"     => $MemberWalletRequestCount,
                                                               "OnlineMemberCount"             => $OnlineMembercount,
                                                               "FreeMemberCount"             => $FreeMemberCount,
                                                               "PaidMemberCount"             => $PaidMemberCount,
                                                               "LandingPageProfileCount"             => $LandingPageProfileCount,
                                                               "FranchiseeCount"             => $FranchiseeCount,
                                                               "FranchiseeWalletRequestCount" => $FranchiseeWalletRequestCount));
        }
     function ViewMemberKYCDoc() {
           global $mysql;    
              $sql = "SELECT *
                                    FROM _tbl_member_documents
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_member_documents.MemberID=_tbl_members.MemberID";
                                    
             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                       
             if (isset($_POST['Request']) && $_POST['Request']=="Requested") {
                return Response::returnSuccess("success",$mysql->select($sql." where `IsVerified`='0' and`IsRejected`='0'"));    
             }                       
             if (isset($_POST['Request']) && $_POST['Request']=="Verified") {
                return Response::returnSuccess("success",$mysql->select($sql." where `IsVerified`='1' and `IsRejected`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Rejected") {
                return Response::returnSuccess("success",$mysql->select($sql." where `IsVerified`='0' and `IsRejected`='1'"));    
             }  
                return Response::returnSuccess("success",$KYCs);
                

    }
    function GetViewMemberKYCDoc() {
             global $mysql,$loginInfo;        
          
             $Documents = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$_POST['MemberID']."'");               
             $IDProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$_POST['MemberID']."' and DocumentType='Id Proof' order by `DocID` DESC ");               
             $AddressProofs = $mysql->select("select * from `_tbl_member_documents` where MemberID='".$_POST['MemberID']."' and DocumentType='Address Proof' order by `DocID` DESC ");               
             
             $Members = $mysql->select("select * from `_tbl_members` where `MemberID`='".$Documents[0]['MemberID']."'");               

             
             return Response::returnSuccess("success",array("IDProof"            => $IDProofs,
                                                            "AddressProof"            => $AddressProofs,
                                                            "Member"     => $Members[0]));
      
       
         }
         function AproveMemberIDProof() {

            global $mysql,$mail,$loginInfo; 
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['IDPtxnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
            }
			
			$data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   
			
			if($data[0]['IsVerified']==1) {
				return Response::returnError("Document already approved");
			}
			
			$member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   

            $mContent = $mysql->select("select * from `mailcontent` where `Category`='IDProofApproved'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "IDProofApproved",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your ID Proof Approved"); 

            $mysql->execute("update _tbl_member_documents set IsVerified='1',
															  IsRejected='0',
															  ApproveRemarks='".$_POST['IDApproveReaseon']."',
															  VerifiedOn='".date("Y-m-d H:i:s")."',
                                                              VerifyByID='".$txnPwd[0]['AdminID']."', 
                                                              VerifyByCode='".$txnPwd[0]['AdminCode']."', 
                                                              VerifyByName='".$txnPwd[0]['AdminName']."' 
															  where  DocID='".$data[0]['DocID']."'");
            $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                            "ActivityType"   => 'ApprovedIDProof.',
                                                            "ActivityString" => 'Approved ID Proof.',
                                                            "SqlQuery"       => base64_encode($sqlQry),
                                                            //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
			return Response::returnSuccess("successfully Approved",array());
			

    }
    function AproveMemberAddressProof() {

            global $mysql,$mail,$loginInfo;      
       
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['ADPtxnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
            }                                                                                        
			
			$data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   
			
			if($data[0]['IsVerified']==1) {
				return Response::returnError("Document already approved");
			}
                $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddressProofApproved'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AddressProofApproved",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your Address Proof Approved"); 

           $mysql->execute("update _tbl_member_documents set IsVerified='1',
                                                             IsRejected='0',
                                                             ApproveRemarks='".$_POST['AddressApproveReaseon']."',
                                                             VerifiedOn='".date("Y-m-d H:i:s")."',
                                                             VerifyByID='".$txnPwd[0]['AdminID']."', 
                                                             VerifyByCode='".$txnPwd[0]['AdminCode']."', 
                                                             VerifyByName='".$txnPwd[0]['AdminName']."'
                                                             where  DocID='".$data[0]['DocID']."'");
           
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                            "ActivityType"   => 'ApprovedAddressProof.',
                                                            "ActivityString" => 'Approved Address Proof.',
                                                            "SqlQuery"       => base64_encode($sqlQry),
                                                            //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

         return Response::returnSuccess("successfully Approved",array());

    }
    function RejectMemberIDProof() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['IDPtxnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   
			
			if($data[0]['IsRejected']==1) {
				return Response::returnError("Document already rejected");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
                
                if (!(strlen(trim($_POST['IDRejectReaseon']))>0)) {
                return Response::returnError("Please enter Rejected Remarks");
                }

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='IdProofRejected'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "IdProofRejected",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your ID Proof Rejected"); 
             
           $mysql->execute("update _tbl_member_documents set IsRejected='1',
                                                             RejectedOn='".date("Y-m-d H:i:s")."',
                                                             RejectedRemarks='".$_POST['IDRejectReaseon']."',
                                                             IsVerified='1',
                                                             VerifiedOn='".date("Y-m-d H:i:s")."',
                                                             VerifyByID='".$txnPwd[0]['AdminID']."', 
                                                             VerifyByCode='".$txnPwd[0]['AdminCode']."', 
                                                             VerifyByName='".$txnPwd[0]['AdminName']."'
                                                             where  DocID='".$data[0]['DocID']."'");
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                            "ActivityType"   => 'RejectIDProofKyc.',
                                                            "ActivityString" => 'Reject ID Proof.',
                                                            "SqlQuery"       => base64_encode($sqlQry),
                                                            //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

        return Response::returnSuccess("successfully Rejected",array());

    }
    function RejectMemberAddressProof() {

            global $mysql,$mail,$loginInfo;      
       
                $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['ADPtxnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   
			
			if($data[0]['IsRejected']==1) {
				return Response::returnError("Document already rejected");
			}                                                                                                           

                $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
                                                                                                                                               
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddressProofRejected'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AddressProofRejected",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your Address Proof Rejected"); 

           $mysql->execute("update _tbl_member_documents set IsRejected='1',
                                                             RejectedRemarks='".$_POST['AddressRejectReaseon']."',
                                                             RejectedOn='".date("Y-m-d H:i:s")."',
                                                             IsVerified='1',
                                                             VerifiedOn='".date("Y-m-d H:i:s")."',
                                                             VerifyByID='".$txnPwd[0]['AdminID']."', 
                                                             VerifyByCode='".$txnPwd[0]['AdminCode']."', 
                                                             VerifyByName='".$txnPwd[0]['AdminName']."'
                                                             where  DocID='".$data[0]['DocID']."'");
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                            "ActivityType"   => 'RejectAddressProof.',
                                                            "ActivityString" => 'Reject Adress Proof.',
                                                            "SqlQuery"       => base64_encode($sqlQry),
                                                            //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));

         return Response::returnSuccess("successfully Rejected",array());

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
    function GetPublishedProfiles() {
           global $mysql;    
             $sql = "SELECT *
                                    FROM _tbl_profiles
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_profiles.MemberID=_tbl_members.MemberID";
             if (isset($_POST['Request']) && $_POST['Request']=="Publish") {  
             
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="PublishGroom") {
                return Response::returnSuccess("success",$mysql->select($sql."  WHERE _tbl_profiles.IsApproved='1' and  _tbl_profiles.SexCode='SX001' and _tbl_profiles.IsPublish='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="PublishBride") {
                return Response::returnSuccess("success",$mysql->select($sql."  WHERE _tbl_profiles.IsApproved='1' and  _tbl_profiles.SexCode='SX002' and _tbl_profiles.IsPublish='1'"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="UnPublish") {
                return Response::returnSuccess("success",$mysql->select($sql."  WHERE _tbl_profiles.IsApproved='1' and _tbl_profiles.IsPublish='0'"));    
             }
         }
    function GetProfilesDetatils() {
         global $mysql; 
         if (isset($_POST['Request']) && $_POST['Request']=="Draft") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='0'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="DraftBride") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='0' and `SexCode`='SX002'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="DraftGroom") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='0' and `SexCode`='SX001'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="Request") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='1'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="RequestBride") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='1' and `SexCode`='SX002'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="RequestGroom") {  
                $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where IsApproved='0' and RequestToVerify='1' and `SexCode`='SX001'");
                if (sizeof($DraftProfiles)>0) {
                    foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);
                        $result['mode']="Draft"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
         if (isset($_POST['Request']) && $_POST['Request']=="Publish") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1'");   
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="PublishBride") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1' and `SexCode`='SX002'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="PublishGroom") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1' and `SexCode`='SX001'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="UnPublish") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1' and IsPublish='0'");   
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="UnPublishBride") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1' and `SexCode`='SX002' and IsPublish='0'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
             if (isset($_POST['Request']) && $_POST['Request']=="UnPublishGroom") {  
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where IsApproved='1' and RequestToVerify='1' and `SexCode`='SX001' and IsPublish='0'");
                if (sizeof($PublishedProfiles)>0) {
                    foreach($PublishedProfiles as $PublishedProfile) {
                        $result = Profiles::getProfileInfo($PublishedProfile['ProfileCode'],2);
                        $result['mode']="Published"; 
                        $Profiles[]=$result;                                                                     
                     }                                                                          
                }
                return Response::returnSuccess("success",$Profiles);
             }
        
    }
    function GetPublishProfileInfo() {
               
                global $mysql,$loginInfo; 
                $result = array();     
             $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['ProfileCode']."'");               
               $result =  Profiles::getProfileInformationforAdmin($Profiles[0]['ProfileCode']);
               $result['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($Profiles[0]['ProfileCode']));
               $result['MyFavoritedCount']= sizeof($this->GetWhoMyFavoritedProfile($Profiles[0]['ProfileCode']));
               $result['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($Profiles[0]['ProfileCode']));
               $result['MyRecentlyViewedCount']= sizeof($this->GetMyRecentlyViewedProfile($Profiles[0]['ProfileCode']));
               $result['MutualCount']= sizeof($this->GetMutualProfilesCount($Profiles[0]['ProfileCode']));
               $result['WhoShortListedcount']= Shortlist::WhoShortlisted($Profiles[0]['ProfileCode']);
               $result['MyShortListedcount']= Shortlist::MyShortlisted($Profiles[0]['ProfileCode']);
               $result['MyDownloadCount']= sizeof($this->GetMyDownloadCount($Profiles[0]['ProfileCode']));
               $result['WhoDownloadMyProfileCount']= sizeof($this->GetWhoDownloadMyProfileCount($Profiles[0]['ProfileCode']));
               
               if ($_POST['request']=="RecentlyWhoViewed") {
                    $reqProfiles = $this->GetWhoRecentlyViewedMyProfile($Profiles[0]['ProfileCode']);
               }
               if ($_POST['request']=="WhoFavorited") {
                    $reqProfiles = $this->GetWhoFavoritedMyProfile($Profiles[0]['ProfileCode']);
               }
                     foreach($reqProfiles as $reqProfile) {
                        $result['results'][]=Profiles::getProfileInfo($reqProfile['VisterProfileCode'],1,1);        
                     }
               return Response::returnSuccess("success",$result);
           }                                                            
           
    function GetSMSLogs() {    

             global $mysql,$loginInfo;  
             
              $sql = "SELECT RequestedOn,MobileNumber,MemberID,FranchiseeID,TextMessage,APIID,AdminID, 
                            CASE
                                WHEN   (ApiResponse>0) THEN 'Success'
                                WHEN   (ApiResponse<0) THEN 'Failure'
                            END AS Status
                     FROM _tbl_logs_mobilesms "; 

          /*   $sql = "SELECT RequestedOn,MobileNumber,MemberID,FranchiseeID,TextMessage,APIID,AdminID FROM _tbl_logs_mobilesms ";*/

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }
                                                                                                                                
             if (isset($_POST['Request']) && $_POST['Request']=="Member") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE FranchiseeID ='0' and AdminID ='0'"));    
             }
             
             if (isset($_POST['Request']) && $_POST['Request']=="Franchisee") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE MemberID ='0' and AdminID ='0'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsSuccess`='1'"));    
             }                                                                                                

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsSuccess`='0'"));    
             }
         }
    function SearchMemberDetails() {
            global $mysql,$loginInfo;                                                                      
            $sql="SELECT tb1_1.MemberID AS MemberID,
                         tb1_1.MemberName AS MemberName,
                         tb1_1.MemberCode AS MemberCode,
                         tb1_1.CountryCode AS CountryCode,
                         tb1_1.MobileNumber AS MobileNumber,
                         _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                         _tbl_franchisees.FranchiseName AS FranchiseeName,
                         tb1_1.IsDeleted AS IsDeleted,
                         tb1_1.CreatedBy AS CreatedBy,
                         tb1_1.CreatedOn AS CreatedOn,
                         tb1_1.IsActive AS IsActive
                   FROM 
                        (select * from _tbl_members where  MemberCode like '%".$_POST['MemberDetails']."%' or MemberName like '%".$_POST['MemberDetails']."%' or MobileNumber like '%".$_POST['MemberDetails']."%' or EmailID like '%".$_POST['MemberDetails']."%') AS tb1_1
                   INNER JOIN 
                        _tbl_franchisees 
                   ON 
                        tb1_1.ReferedBy=_tbl_franchisees.FranchiseeID";
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
        function SearchMemberProfileDetails() {
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
                        tb1_1.ReferedBy=_tbl_franchisees.FranchiseeID";
            $Members=$mysql->select($sql);   
            $index = 0;
            foreach($Members as $Member) {
               $v = $mysql->select("select * from `_tbl_profiles` where `MemberID` = '".$Member['MemberID']."'");    
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
     function AddToLandingPage() {

        global $mysql;  
        
        $data = $mysql->select("select * from _tbl_profiles where ProfileCode='".$_POST['ProfileCode']."'");
        $fromdate=$_POST['year']."-".$_POST['month']."-".$_POST['date'];
        $todate=$_POST['toyear']."-".$_POST['tomonth']."-".$_POST['todate'];
        
       $id =  $mysql->insert("_tbl_landingpage_profiles",array("ProfileID"                 => $data[0]['ProfileID'],
                                                               "ProfileCode"               => $data[0]['ProfileCode'],
                                                               "DateFrom"                  => $fromdate,
                                                               "DateTo"                    => $todate,
                                                               "IsShow"                    => $_POST['IsShow'],
                                                               "ShowCommunicationDetails"  => $_POST['ShowCommunicationDetails'],
                                                               "ShowHoroscopeDetails"      => $_POST['ShowHoroscopeDetails'],
                                                               "AddOn"                     => date("Y-m-d H:i:s")));

        if (sizeof($id)>0) {
                return  '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/icon_success_verification.png" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your profile publish request has been submitted.</h5>
                            <h5 style="text-align:center;"><a href="'.AppPath.'ViewMemberProfile/'.$data[0]['ProfileCode'].'.htm"  >Yes</a> <h5>
                       </div>';
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
	function GetWhoRecentlyViewedMyProfile($ProfileCode) {
             
            global $mysql;
                                    
            $result = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `ProfileCode` = '".$ProfileCode."' AND VisterMemberID>0 AND VisterProfileID>0  group by `VisterProfileCode`"); 
            return $result;
    }
    function GetMyRecentlyViewedProfile($ProfileCode) {
			 
			global $mysql;
                                    
			$result = $mysql->select("select ProfileCode from `_tbl_profiles_lastseen` where `VisterProfileCode` = '".$ProfileCode."' AND MemberID>0 AND ProfileID>0  group by `ProfileCode`"); 
			return $result;
	}
	function GetWhoFavoritedMyProfile($ProfileCode) {
             
            global $mysql;
            $result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `ProfileCode`='".$ProfileCode."'");       
            return $result;
    }                                
    function GetWhoMyFavoritedProfile($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsVisible`='1' and `IsFavorite` ='1' and `VisterProfileCode`='".$ProfileCode."'");       
			return $result;
	}
	function GetMutualProfilesCount($ProfileCode) {
             
            global $mysql;
            $result = $mysql->select("select * from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1' and `ProfileCode` in (select `VisterProfileCode` from `_tbl_profiles_favourites` where `IsFavorite` ='1' and `IsVisible`='1'  and `ProfileCode` = '".$ProfileCode."')");       
            return $result;
    }
    function GetMyDownloadCount($ProfileCode) {
             
            global $mysql;
            $result = $mysql->select("select * from `_tbl_profile_download` where `ProfileCode` = '".$ProfileCode."'");       
            return $result;
    }
    function GetWhoDownloadMyProfileCount($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profile_download` where `PartnerProfileCode` = '".$ProfileCode."'");       
			return $result;
	}
	function GetWhoShortListedMyProfile($ProfileCode) {
			 
			global $mysql;
			$result = $mysql->select("select * from `_tbl_profiles_shortlists` where `IsVisible`='1' and `IsShortList` ='1' and  `ProfileCode`='".$ProfileCode."'");       
			return $result;
	}
	 function GetFeatuerdGrooms() {
             
             global $mysql,$loginInfo;
			 
			 $Profiles = array();
             
             if (isset($_POST['Request']) && $_POST['Request']=="All") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX001'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
            }
			 if (isset($_POST['Request']) && $_POST['Request']=="Active") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX001' AND Date(_tbl_landingpage_profiles.`DateTo`)>=Date('".date("Y-m-d")."') AND `IsShow`='1'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="UnPublish") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX001' AND _tbl_landingpage_profiles.`IsShow`='0'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Expired") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX001' AND Date(_tbl_landingpage_profiles.`DateTo`)<=Date('".date("Y-m-d")."') AND `IsShow`='1'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 
            
         }
	function GetFeatuerdBrides() {
             
            global $mysql,$loginInfo;
			 
			 $Profiles = array();
             
             if (isset($_POST['Request']) && $_POST['Request']=="All") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX002'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Active") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX002' AND Date(_tbl_landingpage_profiles.`DateTo`)>=Date('".date("Y-m-d")."') AND _tbl_landingpage_profiles.`IsShow`='1'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="UnPublish") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX002' AND _tbl_landingpage_profiles.`IsShow`='0'");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Expired") {
				 
				$landingpageProfiles = $mysql->select("SELECT * FROM _tbl_landingpage_profiles
													   LEFT  JOIN _tbl_profiles  
													   ON _tbl_landingpage_profiles.ProfileCode=_tbl_profiles.ProfileCode WHERE _tbl_profiles.SexCode='SX002' AND Date(_tbl_landingpage_profiles.`DateTo`)<=Date('".date("Y-m-d")."')");  
				foreach($landingpageProfiles as $profile) {
					 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
					 $tmp['IsShow']=$profile['IsShow'];
					 $tmp['DateTo']=$profile['DateTo'];
					 $tmp['DateFrom']=$profile['DateFrom'];
					 $tmp['RecentlyWhoViwedCount']= sizeof($this->GetWhoRecentlyViewedMyProfile($profile['ProfileCode']));
					 $tmp['WhoFavoritedCount']= sizeof($this->GetWhoFavoritedMyProfile($profile['ProfileCode']));
					 $tmp['MutualCount']= sizeof($this->GetMutualProfilesCount($profile['ProfileCode']));
					 $tmp['WhoShortListedcount']= sizeof($this->GetWhoShortListedMyProfile($profile['ProfileCode']));
					 $Profiles[] =$tmp;
             }
             return Response::returnSuccess("success",$Profiles);   
             }
            
         }
    function GetLandingPageProfiles() {                  
             
             global $mysql;
             $Profiles = array();
             $landingpageProfiles = $mysql->select("select * from `_tbl_landingpage_profiles` where `IsShow`='1'"); 
               foreach($landingpageProfiles as $profile) {
                 $tmp = Profiles::getProfileInfo($profile['ProfileCode'],2);
                 $tmp['DateTo']=$profile['DateTo'];
                 $tmp['DateFrom']=$profile['DateFrom'];
                 $Profiles[] =$tmp;
             }
             
                 return Response::returnSuccess("success",$Profiles);                                               
                 }
  
    function RequestToModify() {

             global $mysql,$loginInfo; 
                                                          
             
             $draft = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_GET['ProfileCode']."'");
             
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$draft[0]['MemberID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RequestToModify'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$draft[0]['ProfileCode'],$content);
             $content  = str_replace("#PersonName#",$draft[0]['PersonName'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RequestToModify",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber']," Dear ".$member[0]['MemberName'].",Your Profile (".$draft[0]['PersonName'].") Does not have all details so could not approved your profile. Your Profile ID is ".$draft[0]['ProfileCode']);  
             
             $updateSql = "update `_tbl_draft_profiles` set `RequestToVerify` = '0' where `ProfileCode`='".$_GET['ProfileCode']."'";
                                                            
             $mysql->execute($updateSql);     
             
          $id =  $mysql->insert("_tbl_member_profile_modify_notification",array("MemberID" => $member[0]['MemberID'],
                                                                                   "Message"   => "your profile does not have all details",
                                                                                   "UpdatedOn"   => date("Y-m-d H:i:s"),
                                                                                   "ViewedOn"      => date("Y-m-d H:i:s")));   
                            
             return '<div style="background:white;width:100%;padding:20px;height:100%;">
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Profile Verification</h4>  <br><br>
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/exclamationmark.jpg" width="10%"><p>
                            <h5 style="text-align:center;"><a href="'.AppPath.'Profiles/Requested" class="btn btn-primary" style="cursor:pointer">Continue</a> <h5>
                       </div>';                                             
                 }
                 
    function UpdateAppConfiguration() {
        
        global $mysql,$loginInfo;
        foreach($_POST as $param => $value ) {
            if (trim(substr($param,0,4))=="app_") {
                
                switch(str_replace("app_","",$param)) {
                    
                    case "TIMEZONE_VALUE":  $tz = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$value."'");
                                            $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$tz[0]['CodeValue']."', ParamD='".$value."'  where `HardCode`='APPSETTINGS' and `CodeValue`='".str_replace("app_","",$param)."'");        
                                            $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$value."'  where `HardCode`='APPSETTINGS' and `CodeValue`='TIMEZONE_CODE'");        
                                            break;
                                            
                    case "CURRENCY_VALUE": $cy = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$value."'");
                                           $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$cy[0]['CodeValue']."', ParamD='".$value."'  where `HardCode`='APPSETTINGS' and `CodeValue`='".str_replace("app_","",$param)."'"); 
                                           $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$value."'  where `HardCode`='APPSETTINGS' and `CodeValue`='CURRENCY_CODE'");         
                                           break;
                                           
                    default:                $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$value."' where `HardCode`='APPSETTINGS' and `CodeValue`='".str_replace("app_","",$param)."'");           
                                            break;
                }
            }
        }
        
        $myfile = fopen("classes/class.Config.php", "w") or die("Unable to open file!");
        $txt = "<?php
        \n\tclass Configuration {";
        $data = $mysql->select("select * from _tbl_master_codemaster where `HardCode`='APPSETTINGS'");
        foreach($data as $d) {
            if(strlen(trim($d['CodeValue']))>0) {
                $txt.= "\n\t\t const ".$d['CodeValue']." = ";
                if ($d['ParamB']=="string") {
                    $txt .= "'".$d['ParamA']."';";
                } else {
                    $txt .= (strlen(trim($d['ParamA']))>0 ? $d['ParamA'] : 0) .";";
                }
            }
        }
        $txt .= "\n\t}\n?>";
        fwrite($myfile,$txt);
        fclose($myfile);
        return Response::returnSuccess("Success");
    }
    function GetMastersSettingsCode() {
           global $mysql;                                                              
           $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='XXX'");
            return Response::returnSuccess("success",array("AppSettingsCode"   => SeqMaster::GetNextCode('APPSETTINGS'),
                                                           "CodeMasterDatas"   => $data,
                                                           "WebSettingsCode"   => SeqMaster::GetNextCode('WEBSETTINGS')));    
    }                                                                          

  function AddConfigurationSettings() {
       global $mysql,$loginInfo; 
       $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='APPSETTINGS' and CodeValue='".$_POST['String']."'");
            if (sizeof($data)>0) {
                return Response::returnError("String Already Exists");
            }
            
       foreach($_POST as $param => $value ) {
            if (trim(substr($param,0,4))=="app_") {
                
                switch(str_replace("app_","",$param)) {
                    
                    case "ParamA":  $tz = $mysql->select("select * from _tbl_master_codemaster where HardCode='".$value."'");
                                          $mysql->insert("_tbl_master_codemaster",array("HardCode"        => "APPSETTINGS",
                                                                                        "SoftCode"        => $_POST['AppSettingsCode'],
                                                                                        "CodeValue"       => $_POST['String'],
                                                                                        "CodeDescription" => $_POST['CodeDescription'],
                                                                                        "ParamB"          => $_POST['DataType'],
                                                                                        "ParamA"          => $tz[0]['CodeValue'],
                                                                                        "ParamC"          => $value,
                                                                                        "ParamD"          => $tz[0]['SoftCode'],
                                                                                        "ParamE"          => $_POST['ParamE']));        
                                            break;
                   
                    default:               $mysql->insert("_tbl_master_codemaster",array("HardCode"        => "APPSETTINGS",
                                                                                         "SoftCode"        => $_POST['AppSettingsCode'],
                                                                                         "CodeValue"       => $_POST['String'],
                                                                                         "CodeDescription" => $_POST['CodeDescription'],
                                                                                         "ParamB"          => $_POST['DataType'],
                                                                                         "ParamA"          => $_POST['ParamA'],
                                                                                         "ParamE"          => $_POST['ParamE']));
                                            break;
                }
            }
        }
         return Response::returnSuccess("Success");                                                      
    }
    function AddWebsiteSettings() {
       global $mysql,$loginInfo; 
       $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEBSETTINGS' and CodeValue='".$_POST['String']."'");
            if (sizeof($data)>0) {
                return Response::returnError("String Already Exists");
            }
         $id = $mysql->insert("_tbl_master_codemaster",array("HardCode"       => "WEBSETTINGS",
                                                             "SoftCode"      => $_POST['WebSettingsCode'],
                                                             "CodeValue"      => $_POST['String'],
                                                             "ParamB"          => $_POST['DataType'],
                                                             "ParamA"          => $_POST['ParamA'],
                                                             "ParamC"          => $_POST['ParamC'],
                                                             "ParamD"          => $_POST['ParamD'],
                                                             "ParamE"          => $_POST['ParamE']));
         return Response::returnSuccess("Success");
    }
    function UpdateWebConfiguration() {
        
        global $mysql,$loginInfo;
        foreach($_POST as $param => $value ) {
            if (trim(substr($param,0,4))=="app_") {
                
                  $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$value."' where `HardCode`='WEBSETTINGS' and `CodeValue`='".str_replace("app_","",$param)."'");           
               
            }
        }
        
        $myfile = fopen("../Dashboard/includes/class.WebConfig.php", "w") or die("Unable to open file!");
        $txt = "<?php
        \n\tclass WebConfig {";
        $data = $mysql->select("select * from _tbl_master_codemaster where `HardCode`='WEBSETTINGS'");
        foreach($data as $d) {
            if(strlen(trim($d['CodeValue']))>0) {
                $txt.= "\n\t\t const ".$d['CodeValue']." = ";
                if ($d['ParamB']=="string") {
                    $txt .= "'".$d['ParamA']."';";
                } else {
                    $txt .= (strlen(trim($d['ParamA']))>0 ? $d['ParamA'] : 0) .";";
                }
            }
        }
        $txt .= "\n\t}\n?>";
        fwrite($myfile,$txt);
        fclose($myfile);
        return Response::returnSuccess("Success");
    }

function UpdateBusinessConfiguration() {
        
         global $mysql,$loginInfo;
        foreach($_POST as $param => $value ) {
            if (trim(substr($param,0,4))=="app_") {
                
                  $mysql->execute("update `_tbl_master_codemaster` set `ParamA`='".$value."' where `HardCode`='BUSINESSSETTINGS' and `CodeValue`='".str_replace("app_","",$param)."'");           
               
            }
        }
        
        $myfile = fopen("../Dashboard/includes/class.BusinessConfig.php", "w") or die("Unable to open file!");
        $txt = "<?php
        \n\tclass BusinessConfig {";
        $data = $mysql->select("select * from _tbl_master_codemaster where `HardCode`='BUSINESSSETTINGS'");
        foreach($data as $d) {
            if(strlen(trim($d['CodeValue']))>0) {
                $txt.= "\n\t\t const ".$d['CodeValue']." = ";
                if ($d['ParamB']=="string" || $d['ParamB']=="file") {
                    $txt .= "'".$d['ParamA']."';";
                } else {
                    $txt .= (strlen(trim($d['ParamA']))>0 ? $d['ParamA'] : 0) .";";
                }
            }
        }
        $txt .= "\n\t}\n?>";
        fwrite($myfile,$txt);
        fclose($myfile);
        
        $Smyfile = fopen("../Webservice/classes/class.BusinessConfig.php", "w") or die("Unable to open file!");
        $txt = "<?php
        \n\tclass BusinessConfig {";
        $data = $mysql->select("select * from _tbl_master_codemaster where `HardCode`='BUSINESSSETTINGS'");
        foreach($data as $d) {
            if(strlen(trim($d['CodeValue']))>0) {
                $txt.= "\n\t\t const ".$d['CodeValue']." = ";
                if ($d['ParamB']=="string" || $d['ParamB']=="file") {
                    $txt .= "'".$d['ParamA']."';";
                } else {
                    $txt .= (strlen(trim($d['ParamA']))>0 ? $d['ParamA'] : 0) .";";
                }
            }
        }
        $txt .= "\n\t}\n?>";
        fwrite($Smyfile,$txt);
        fclose($Smyfile);
        return Response::returnSuccess("Success");
    }
    function GetAllowDuplicateDetails(){
        global $mysql,$loginInfo;
        
        $Mobile=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateMobile'"); 
        $Email=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateEmail'"); 
        $Whatsapp=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='IsAllowDuplicateWhatsapp'"); 
        $PasswordCaseSensitive=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='AllowToPasswordCaseSensitive'"); 
        $ChangePasswordNotification=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='ChangePasswordNotificationSendToMember'"); 
        $MaximumAllowSizeProfileImages=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='MaximumAllowSizeProfileImages'"); 
        $InvalidLoginNotification=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='InvalidLoginNotification'"); 
        $DisplayLastLogin=$mysql->select("select * from `_tbl_master_codemaster` where `HardCode`='APPSETTINGS' and `CodeValue`='DisplayLastLoginInDashboard'"); 
        
        return Response::returnSuccess("success",array("Mobile"   => $Mobile[0],
                                                       "Email"    => $Email[0],
                                                       "Whatsapp" => $Whatsapp[0],
                                                       "PasswordCaseSensitive" => $PasswordCaseSensitive[0],
                                                       "ChangePasswordNotification" => $ChangePasswordNotification[0],
                                                       "DisplayLastLogin" => $DisplayLastLogin[0],
                                                       "MaximumSizeProfileImage" => $MaximumAllowSizeProfileImages[0],
                                                       "InvalidLoginNotification" => $InvalidLoginNotification[0]
                                                       ));
    }
    function GetGeneralSettingsDetails(){
        global $mysql,$loginInfo;
        
        $FirstTimeProfileView=$mysql->select("select * from `_tbl_general_settings` where `Settings`='FirstTimeProfileView'"); 
        $FirstTimeProfileFavorite=$mysql->select("select * from `_tbl_general_settings` where `Settings`='FirstTimeProfileFavorite'"); 
        $FirstTimeProfileUnFavorite=$mysql->select("select * from `_tbl_general_settings` where `Settings`='FirstTimeProfileUnFavorite'"); 
        $EveryTimeProfileView=$mysql->select("select * from `_tbl_general_settings` where `Settings`='EveryTimeProfileView'"); 
        $EveryTimeProfileFavorite=$mysql->select("select * from `_tbl_general_settings` where `Settings`='EveryTimeProfileFavorite'"); 
        $EveryTimeProfileUnfavorite=$mysql->select("select * from `_tbl_general_settings` where `Settings`='EveryTimeProfileUnFavorite'"); 
        $ChangePasswordNotification=$mysql->select("select * from `_tbl_general_settings` where `Settings`='ChangePasswordNotification'"); 
        $EmailVerificationStatus=$mysql->select("select * from `_tbl_general_settings` where `Settings`='EmailVerificationStatus'"); 
        $MobileVerificationStatus=$mysql->select("select * from `_tbl_general_settings` where `Settings`='MobileVerificationStatus'"); 
        $InvalidLoginNotification=$mysql->select("select * from `_tbl_general_settings` where `Settings`='InvalidLoginNotification'"); 
        $ApproveKYC=$mysql->select("select * from `_tbl_general_settings` where `Settings`='ApproveKYC'"); 
        $RejectKYC=$mysql->select("select * from `_tbl_general_settings` where `Settings`='RejectKYC'"); 
        $ApproveProfile=$mysql->select("select * from `_tbl_general_settings` where `Settings`='ApproveProfile'"); 
        $RejectProfile=$mysql->select("select * from `_tbl_general_settings` where `Settings`='RejectProfile'"); 
        $RemodificationRequest=$mysql->select("select * from `_tbl_general_settings` where `Settings`='RemodificationRequest'"); 
        
        return Response::returnSuccess("success",array("FirstTimeProfileView"   => $FirstTimeProfileView[0],
                                                       "FirstTimeProfileFavorite"   => $FirstTimeProfileFavorite[0],
                                                       "FirstTimeProfileUnFavorite"   => $FirstTimeProfileUnFavorite[0],
                                                       "EveryTimeProfileView"   => $EveryTimeProfileView[0],
                                                       "EveryTimeProfileFavorite"   => $EveryTimeProfileFavorite[0],
                                                       "EveryTimeProfileUnFavorite"   => $EveryTimeProfileUnfavorite[0],
                                                       "ChangePasswordNotification"   => $ChangePasswordNotification[0],
                                                       "EmailVerificationStatus"   => $EmailVerificationStatus[0],
                                                       "InvalidLoginNotification"   => $InvalidLoginNotification[0],
                                                       "MobileVerificationStatus"   => $MobileVerificationStatus[0],
                                                       "ApproveKYC"   => $ApproveKYC[0],
                                                       "RejectKYC"   => $RejectKYC[0],
                                                       "ApproveProfile"   => $ApproveProfile[0],
                                                       "RejectProfile"   => $RejectProfile[0],
                                                       "RemodificationRequest"   => $RemodificationRequest[0]));  
    }
   function UpdateGeneralSettings() {
        
        global $mysql,$loginInfo;
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['FirstTimeProfileViewSMS']) ? '1' : '0')."' where `Settings`='FirstTimeProfileView'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['FirstTimeProfileViewEmail']) ? '1' : '0')."' where `Settings`='FirstTimeProfileView'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['FirstTimeProfileFavoriteSMS']) ? '1' : '0')."' where `Settings`='FirstTimeProfileFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['FirstTimeProfileFavoriteEmail']) ? '1' : '0')."' where `Settings`='FirstTimeProfileFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['FirstTimeProfileUnFavoriteSMS']) ? '1' : '0')."' where `Settings`='FirstTimeProfileUnFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['FirstTimeProfileUnFavoriteEmail']) ? '1' : '0')."' where `Settings`='FirstTimeProfileUnFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['EveryTimeProfileViewSMS']) ? '1' : '0')."' where `Settings`='EveryTimeProfileView'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['EveryTimeProfileViewEmail']) ? '1' : '0')."' where `Settings`='EveryTimeProfileView'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['EveryTimeProfileFavoriteSMS']) ? '1' : '0')."' where `Settings`='EveryTimeProfileFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['EveryTimeProfileFavoriteEmail']) ? '1' : '0')."' where `Settings`='EveryTimeProfileFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['EveryTimeProfileUnFavoriteSMS']) ? '1' : '0')."' where `Settings`='EveryTimeProfileUnFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['EveryTimeProfileUnFavoriteEmail']) ? '1' : '0')."' where `Settings`='EveryTimeProfileUnFavorite'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['ChangePasswordNotificationSMS']) ? '1' : '0')."' where `Settings`='ChangePasswordNotification'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['ChangePasswordNotificationEmail']) ? '1' : '0')."' where `Settings`='ChangePasswordNotification'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['EmailVerificationStatusSMS']) ? '1' : '0')."' where `Settings`='EmailVerificationStatus'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['EmailVerificationStatusEmail']) ? '1' : '0')."' where `Settings`='EmailVerificationStatus'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['MobileVerificationStatusSMS']) ? '1' : '0')."' where `Settings`='MobileVerificationStatus'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['MobileVerificationStatusEmail']) ? '1' : '0')."' where `Settings`='MobileVerificationStatus'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['InvalidLoginNotificationSMS']) ? '1' : '0')."' where `Settings`='InvalidLoginNotification'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['InvalidLoginNotificationEmail']) ? '1' : '0')."' where `Settings`='InvalidLoginNotification'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['ApproveKYCSMS']) ? '1' : '0')."' where `Settings`='ApproveKYC'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['ApproveKYCEmail']) ? '1' : '0')."' where `Settings`='ApproveKYC'");    
         $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['RejectKYCSMS']) ? '1' : '0')."' where `Settings`='RejectKYC'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['RejectKYCEmail']) ? '1' : '0')."' where `Settings`='RejectKYC'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['ApproveProfileSMS']) ? '1' : '0')."' where `Settings`='ApproveProfile'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['ApproveProfileEmail']) ? '1' : '0')."' where `Settings`='ApproveProfile'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['RejectProfileSMS']) ? '1' : '0')."' where `Settings`='RejectProfile'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['RejectProfileEmail']) ? '1' : '0')."' where `Settings`='RejectProfile'");    
        $mysql->execute("update `_tbl_general_settings` set `SMS`='".(isset($_POST['RemodificationRequestSMS']) ? '1' : '0')."' where `Settings`='RemodificationRequest'");    
        $mysql->execute("update `_tbl_general_settings` set `Email`='".(isset($_POST['RemodificationRequestEmail']) ? '1' : '0')."' where `Settings`='RemodificationRequest'");    
       
        return Response::returnSuccess("Success");
         
    } 
    function GetMemberViewBankRequests() {
             global $mysql,$loginInfo;
             $Bank = $mysql->select("SELECT *
                        FROM _tbl_wallet_bankrequests
                        LEFT  JOIN _tbl_members  
                        ON _tbl_wallet_bankrequests.MemberID=_tbl_members.MemberID where _tbl_wallet_bankrequests.ReqID='".$_POST['Code']."'");                        
             return Response::returnSuccess("success",$Bank[0]);
         }
    function GetFranchiseeViewBankRequests() {
             global $mysql,$loginInfo;
             $Bank = $mysql->select("SELECT *
                        FROM _tbl_wallet_bankrequests
                        LEFT  JOIN _tbl_franchisees_staffs  
                        ON _tbl_wallet_bankrequests.FranchiseeID=_tbl_franchisees_staffs.PersonID where _tbl_wallet_bankrequests.ReqID='".$_POST['Code']."'");                        
             return Response::returnSuccess("success",$Bank[0]);
         }
         function getAvailableBalance($memberid) {
             global $mysql,$loginInfo;
             $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where MemberID='".$memberid."'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
         }
     function AproveMemberBankReq() {

             global $mysql,$loginInfo;
             
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
            
             $Requests = $mysql->select("select * from  `_tbl_wallet_bankrequests` where ReqID='".$_POST['ReqID']."'");
             $member = $mysql->select("select * from  `_tbl_members` where MemberID='".$Requests[0]['MemberID']."'");
             
           /* $member = $mysql->select("select * from  `_tbl_members` where MemberID='".$Requests[0]['MemberID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ApproveWalletRequest'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ApproveWalletRequest",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear '".$member[0]['MemberName']."' your wallet request has been approved");*/ 
            
               $id=$mysql->insert("_tbl_wallet_transactions",array("MemberID"         =>$Requests[0]['MemberID'],
                                                                   "Particulars"      =>'Add To Wallet',                    
                                                                   "Credits"          =>$Requests[0]['RefillAmount'],                    
                                                                   "Debits"           =>"0", 
                                                                   "AvailableBalance" =>$this->getAvailableBalance($Requests[0]['MemberID'])+$Requests[0]['RefillAmount'],                   
                                                                   "RequestID"        =>$Requests[0]['RequestID'],                    
                                                                   "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                   "IsMember"          =>"1")); 
              $updateSql = "update `_tbl_wallet_bankrequests` set `IsApproved` = '1',
                                                                  `ApprovedOn` ='".date("Y-m-d H:i:s")."', 
                                                                  `ApprovedRemarks` = '".$_POST['ApproveReason']."',
                                                                  `IsRejected` = '0',
                                                                  `RejectedOn` ='".date("Y-m-d H:i:s")."' 
                                                                   where `ReqID`='".$_POST['ReqID']."'";
              $mysql->execute($updateSql);  
             if (sizeof($id)>0) {
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='ApprovedMemberBankWalletRequest'");
                    $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

                    MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                                "Category" => "ApprovedMemberBankWalletRequest",
                                                "MemberID" => $member[0]['MemberID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                    MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your bank wallet request has been approved"); 
                      
                   $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                                  "ActivityType"   => 'ApproveMemberBankWalletRequest.',
                                                                  "ActivityString" => 'Approve Member Bank Wallet Request.',
                                                                  "SqlQuery"       => base64_encode($sqlQry),
                                                                  "ActivityDoneBy" => 'A',
                                                                  "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                                  "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                                  "ActivityOn"     => date("Y-m-d H:i:s")));
            
                    return Response::returnSuccess("successfully Approved",array());
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function RejectMemberBankReq() {

             global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
            
             $Requests = $mysql->select("select * from  `_tbl_wallet_bankrequests` where ReqID='".$_POST['ReqID']."'");
             $member = $mysql->select("select * from  `_tbl_members` where MemberID='".$Requests[0]['MemberID']."'"); 
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RejectWalletRequest'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RejectWalletRequest",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Dear '".$member[0]['MemberName']."' your wallet request has been rejected");
            
              $updateSql = "update `_tbl_wallet_bankrequests` set `IsApproved` = '0',
                                                                  `ApprovedOn` ='".date("Y-m-d H:i:s")."', 
                                                                  `IsRejected` = '1',
                                                                  `RejectedRemarks` = '".$_POST['RejectReason']."',
                                                                  `RejectedOn` ='".date("Y-m-d H:i:s")."' 
                                                                   where `ReqID`='".$_POST['ReqID']."'";
              $mysql->execute($updateSql);  
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
           
         }
         function ApproveFranchiseeBankWalletRequest() {

             global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
             $Requests = $mysql->select("select * from  `_tbl_wallet_bankrequests` where ReqID='".$_POST['ReqID']."'"); 
             
             $franchisee = $mysql->select("select * from  `_tbl_franchisees` where FranchiseeID='".$Requests[0]['FranchiseeID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ApproveFranchiseeWalletRequest'");
             $content  = str_replace("#FranchiseeName#",$franchisee[0]['FranchiseName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $franchisee[0]['ContactEmail'],
                                        "Category" => "ApproveFranchiseeWalletRequest",
                                        "FranchiseeID" => $franchisee[0]['FranchiseeID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($franchisee[0]['ContactNumber'],"Dear '".$franchisee[0]['FranchiseeName']."' your wallet request has been approved");
            
               $id=$mysql->insert("_tbl_wallet_transactions",array("FranchiseeID"     =>$Requests[0]['FranchiseeID'],
                                                                   "Particulars"      =>'Add To Wallet',                    
                                                                   "Credits"          =>$Requests[0]['RefillAmount'],                    
                                                                   "Debits"           =>"0", 
                                                                   "AvailableBalance" =>getAvailableBalance($Requests[0]['FranchiseeID'])+$Requests[0]['RefillAmount'],                   
                                                                   "RequestID"        =>$Requests[0]['RequestID'],                    
                                                                   "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                   "IsMember"         =>"0")); 
              $updateSql = "update `_tbl_wallet_bankrequests` set `IsApproved` = '1',
                                                                   `ApprovedRemarks` = '".$_POST['ApproveReason']."', 
                                                                  `ApprovedOn` ='".date("Y-m-d H:i:s")."', 
                                                                  `IsRejected` = '0',
                                                                  `RejectedOn` ='".date("Y-m-d H:i:s")."' 
                                                                   where `ReqID`='".$_POST['ReqID']."'";
              $mysql->execute($updateSql);  
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function RejectFranchiseeBankWalletRequest() {

             global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
             $Requests = $mysql->select("select * from  `_tbl_wallet_bankrequests` where ReqID='".$_POST['ReqID']."'"); 
             
              $franchisee = $mysql->select("select * from  `_tbl_franchisees` where FranchiseeID='".$Requests[0]['FranchiseeID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='RejectFranchiseeWalletRequest'");
             $content  = str_replace("#FranchiseeName#",$franchisee[0]['FranchiseName'],$mContent[0]['Content']);
             $content  = str_replace("#otp#",$otp,$content);

             MailController::Send(array("MailTo"   => $franchisee[0]['ContactEmail'],
                                        "Category" => "RejectFranchiseeWalletRequest",
                                        "FranchiseeID" => $franchisee[0]['FranchiseeID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($franchisee[0]['ContactNumber'],"Dear '".$franchisee[0]['FranchiseeName']."' your wallet request has been rejected");
            
              $updateSql = "update `_tbl_wallet_bankrequests` set `IsApproved` = '0',
                                                                  `ApprovedOn` ='".date("Y-m-d H:i:s")."', 
                                                                  `IsRejected` = '1',
                                                                  `RejectedRemarks` = '".$_POST['RejectReason']."',
                                                                  `RejectedOn` ='".date("Y-m-d H:i:s")."' 
                                                                   where `ReqID`='".$_POST['ReqID']."'";
              $mysql->execute($updateSql);  
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
           
         }
         function FranchiseeDetailsforRefillWallet(){
           global $mysql,$loginInfo;    
              
              $Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeCode='".$_POST['Code']."'");
              $sql="select * from _tbl_franchisees where FranchiseeCode='".$_POST['Code']."'";
                return Response::returnSuccess("success".$sql,$Franchisee);
                                                            
         }
         function getFranchiseeAvailableBalance($franchiseeid) {
             global $mysql,$loginInfo;
             $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where FranchiseeID='".$franchiseeid."'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
         }
         function getAdminAvailableBalance() {
             global $mysql,$loginInfo;
             $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where FranchiseeID='0' and MemberID='0'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
         }
         function AdminTransferAmountToFranchiseeWallet() {

             global $mysql,$loginInfo;
             
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
             
             $Franchisee = $mysql->select("select * from `_tbl_franchisees` where `FranchiseeCode`='".$_POST['FranchiseeCode']."'");         
             
             $Admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminTransferAmountToFranchisee'");
             $content  = str_replace("#AdminName#",$Admin[0]['AdminName'],$mContent[0]['Content']);
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['FranchiseName'],$mContent[0]['Content']);
             $content  = str_replace("#Amount#",$_POST['AmountToTransfer'],$content);

             MailController::Send(array("MailTo"   => $Admin[0]['EmailID'],
                                        "Category" => "AdminTransferAmountToFranchisee",
                                        "AdminID" => $Admin[0]['AdminID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($Admin[0]['MobileNumber'],"Dear ".$Admin[0]['AdminName']." your transfer amount to ".$Franchisee[0]['FranchiseName']."  has been transfered successfully");
                
               $id=$mysql->insert("_tbl_wallet_transactions",array("Particulars"      =>'Transfer to  '.$Franchisee[0]['FranchiseeCode'],                    
                                                                   "Credits"          => "0",                    
                                                                   "Debits"           => $_POST['AmountToTransfer'], 
                                                                 //  "AvailableBalance" => $this->getAdminAvailableBalance()+$_POST['AmountToTransfer'],                   
                                                                   "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                   "IsMember"         =>"0"));  
                                                                   
             $Admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeAmountReceivedFromAdmin'");
             $content  = str_replace("#AdminName#",$Admin[0]['AdminName'],$mContent[0]['Content']);
             $content  = str_replace("#FranchiseeName#",$Franchisee[0]['FranchiseName'],$content);
             $content  = str_replace("#Amount#",$_POST['AmountToTransfer'],$content);

             MailController::Send(array("MailTo"   => $Franchisee[0]['ContactEmail'],
                                        "Category" => "FranchiseeAmountReceivedFromAdmin",
                                        "FranchiseeID" => $Franchisee[0]['FranchiseeID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($Franchisee[0]['ContactNumber'],"Dear ".$Franchisee[0]['FranchiseeName']." your received ".$_POST['AmountToTransfer']." from ".$Admin[0]['AdminName']."");
             
                $mysql->insert("_tbl_wallet_transactions",array("FranchiseeID"     =>$Franchisee[0]['FranchiseeID'],
                                                                "MEMFRANCode"      =>$Franchisee[0]['FranchiseeCode'],                    
                                                                "Particulars"      =>'Transfer from Admin',                    
                                                                "Credits"          => $_POST['AmountToTransfer'],                    
                                                                "Debits"           => "0", 
                                                                "AvailableBalance" => $this->getFranchiseeAvailableBalance($_POST['Code'])+$_POST['AmountToTransfer'],                   
                                                                "TxnDate"          =>date("Y-m-d H:i:s"),
                                                                "IsMember"         =>"0"));
            
          
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
          function GetMyTransactions() {

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
                                                                                                
                 $DraftProfiles     = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and  `RequestToVerify`='0' and IsApproved='0'");
                 $PostProfiles      = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and  RequestToVerify='1'");
                 
                 if (sizeof($DraftProfiles)>0) {
                     
                     foreach($DraftProfiles as $DraftProfile) {
                        $result = Profiles::getDraftProfileInformation($DraftProfile['ProfileCode'],2);    
                        $result['mode']="Draft";
                        $Profiles[]= $result;
                     }
                     
                 } else if (sizeof($PostProfiles)>0) {
                     
                     if ($PostProfiles[0]['IsApproved']>0) {
                         
                         $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where DraftProfileID='".$PostProfiles[0]['ProfileID']."' and  `MemberCode` = '".$_POST['Code']."'");
                         foreach($PublishedProfiles as $PublishedProfile) {
                            $result = Profiles::getProfileInformation($PublishedProfile['ProfileCode']);
                            $result['mode']="Published";
                            $Profiles[]=$result;     
                         }
                         
                     } else {
                        foreach($PostProfiles as $PostProfile) {
                            $result = Profiles::getDraftProfileInformation($PostProfile['ProfileCode'],1);
                            $result['mode']="Posted";
                            $Profiles[]=$result;     
                        }
                     }
                     
                 }  
                  return Response::returnSuccess("success",$Profiles);
             }
             

             if (isset($_POST['ProfileFrom']) && $_POST['ProfileFrom']=="Draft") {  /* Profile => Drafted */
                 
                 $DraftProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and RequestToVerify='0'");
                 
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
                  $PostProfiles = $mysql->select("select * from `_tbl_draft_profiles` where `MemberCode`='".$_POST['Code']."' and RequestToVerify='1' and IsApproved='0'");

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
             
                $PublishedProfiles = $mysql->select("select * from `_tbl_profiles` where `MemberCode`='".$_POST['Code']."' and IsApproved='1' and RequestToVerify='1'");
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
         function GetMemberWalletBalance($memberid) {
             
             global $mysql,$loginInfo;
             
             $Balance = $mysql->select("select  (sum(Credits)-sum(Debits)) as bal from `_tbl_wallet_transactions` where `MemberID`='".$memberid."' and IsMember='1'");
             return isset($d[0]['bal']) ? $d[0]['bal'] : 0;
         }
         function GetMemberWalletAndProfileDetails() {
             
             global $mysql,$loginInfo;
             
             $Mem = $mysql->select("select * from _tbl_members where MemberCode='".$_POST['Code']."'");
          
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
         function GetOrderInvoiceReceiptDetails() {                  
             
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
         function GetSequenceMasterDetails() {      
             
             global $mysql,$loginInfo;
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_sequence`"));    
         }
         function AddSequenceMaster() {
             global $mysql,$loginInfo;
               $data = $mysql->select("select * from  _tbl_sequence where SequenceFor='".trim($_POST['SequenceFor'])."'");
                    if (sizeof($data)>0) {
                        return Response::returnError("Sequence For Already Exists");
               }
               $data = $mysql->select("select * from  _tbl_sequence where Prefix='".trim($_POST['Prefix'])."'");
                    if (sizeof($data)>0) {
                        return Response::returnError("Prefix Already Exists");
               }   
                            $id=$mysql->insert("_tbl_sequence",array("SequenceFor"      =>$_POST['SequenceForName'],
                                                                     "Prefix"           =>$_POST['Prefix'],                    
                                                                     "StringLength"     =>$_POST['SLength'],                    
                                                                     "LastNumber"       =>$_POST['LastNumber'])); 
              
             if (sizeof($id)>0) {
                 return Response::returnSuccess("success",array("sql"=>$mysql->qry));
             } else{
                 return Response::returnError("Access denied. Please contact support");   
             }
         }
         function GetSequenceMasterDetailsForView() {      
             
             global $mysql,$loginInfo;
                return Response::returnSuccess("success",$mysql->select("SELECT * From `_tbl_sequence` where SequenceID='".$_POST['Code']."'"));    
         }
         
         function EditSequenceMaster() {
             global $mysql,$loginInfo;
             
              $updateSql = "update `_tbl_sequence` set `SequenceFor`  = '".$_POST['SequenceForName']."',
                                                       `Prefix`       ='".$_POST['Prefix']."', 
                                                       `StringLength` = '1',
                                                       `LastNumber`   ='".$_POST['LastNumber']."' 
                                                                   where `SequenceID`='".$_POST['Code']."'";
              $mysql->execute($updateSql);  
             return Response::returnSuccess("success",array("sql"=>$mysql->qry));
         } 
          function GetOnlineMembers() {      
             global $mysql,$loginInfo;
             $loginmembers = $mysql->select("SELECT * FROM `_tbl_logs_logins` WHERE LoginStatus='1' AND AdminID='0' AND AdminStaffID='0' AND FranchiseeID='0' AND FranchiseeStaffID='0' AND LoginOn='".date("Y-m-d H:i:s")."'"); 
             $Members = $mysql->select("Sellect * from _tbl_members where MemberID='".$loginmembers[0]['MemberID']."'");
                return Response::returnSuccess("success",$Members);    
         }
         function ViewOrderInvoiceReceiptDetails() {
             
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
		 function VerifyProfileDetails(){  

              global $mysql,$loginInfo;     
			$photoapprovals = explode(",",$_POST['ApproveProfilePhoto']);
			$size = sizeof($photoapprovals);
			$i=1;
			foreach($photoapprovals as $p) {                                                       
				$pval = explode("#",$p);
                $member = $mysql->select("Select * from _tbl_members where MemberID='".$pval[3]."'"); 
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				if ($pval[4]==1) {
				$mysql->execute("update `_tbl_draft_profiles_photos` set `IsPublished`='1', 
																	     `IsApproved` ='".$pval[4]."',
																		 `PublishedOn`='".date("Y-m-d H:i:s")."', 
																		 `IsApprovedOn`='".date("Y-m-d H:i:s")."' 
																		where `ProfilePhotoID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'");
				$mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Approved Profile Photo by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
				$mysql->execute("update `_tbl_draft_profiles_photos` set `IsApproved`='".$pval[4]."',
																	     `ReasonForReject`='".$_POST['ReasonForRejectProfilePhoto_'.$i]."',
																		 `IsPublished`='0',
																	     `RejectedOn`='".date("Y-m-d H:i:s")."' 
																          where  `ProfilePhotoID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'");
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Rejected Profile Photo by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" ));
				}
				$i++;
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyEducationDetails(){  

              global $mysql,$loginInfo;     
			$educationapprovals = explode(",",$_POST['ApproveEducation']);
			$size = sizeof($educationapprovals);
			$i=1;
			foreach($educationapprovals as $E) {
				$pval = explode("#",$E);
				if ($pval[4]==1) {
                $member = $mysql->select("Select * from _tbl_members where MemberID='".$pval[3]."'"); 
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                
				$mysql->execute("update `_tbl_draft_profiles_education_details` set `IsVerified`='1', 
																					`IsVerifiedOn`='".date("Y-m-d H:i:s")."' 
																				    where `AttachmentID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'");
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Approved Education Details by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" ));
				}
				if ($pval[4]==2) {
				$mysql->execute("update `_tbl_draft_profiles_education_details` set `IsVerified`='".$pval[2]."',
																					`ReasonForReject`='".$_POST['ReasonForRejectEducation_'.$i]."',
																					`RejectedOn`='".date("Y-m-d H:i:s")."' 
																					where  `AttachmentID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'");
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Rejected Education Details by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" ));
				}
				$i++;
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyDocumentDetails(){  

              global $mysql,$loginInfo;     
			$documentapprovals = explode(",",$_POST['ApproveDocument']);
			$size = sizeof($documentapprovals);
			$i=1;
			foreach($documentapprovals as $DA) {   
				$pval = explode("#",$DA);
                $member = $mysql->select("Select * from _tbl_members where MemberID='".$pval[3]."'"); 
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				if ($pval[4]==1) {
				$mysql->execute("update `_tbl_draft_profiles_verificationdocs` set `IsVerified`='1', 
																					`IsVerifiedOn`='".date("Y-m-d H:i:s")."' 
																				    where `AttachmentID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'"); 
                 $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Approved Documents Details by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" )); 
				}
				if ($pval[4]==2) {
				$mysql->execute("update `_tbl_draft_profiles_verificationdocs` set `IsVerified`='".$pval[2]."',
																					`ReasonForReject`='".$_POST['ReasonForRejectDocuments_'.$i]."',
																					`RejectedOn`='".date("Y-m-d H:i:s")."' 
																					where  `AttachmentID`='".$pval[1]."' and `ProfileCode`='".$pval[0]."'"); 
                $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[3],
                                                              "MemberCode"            => $member[0]['MemberCode'],
                                                              "DraftProfileID"        => $pval[2],
                                                              "DraftProfileCode"      => $pval[0],
                                                              "Activity"              => "Rejected Documents Details by DAT",
                                                              "ActivityOn"            => date("Y-m-d H:i:s"),
                                                              "ActivityDoneBy"        => "Admin",
                                                              "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                              "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                              "Remarks"               => "" )); 
				}
				$i++;
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyAboutMeDetails(){  
            global $mysql,$loginInfo;     
			$aboutmeapprovals = explode(",",$_POST['ApproveAboutMeInfo']);
			$size = sizeof($aboutmeapprovals);
			$i=1;
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			//foreach($aboutmeapprovals as $AM) {
				$pval = explode("#",$aboutmeapprovals[0]);                           
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Gi_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Gi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
                            
                            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve About information by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $txnPwd[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                
				}
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Gi_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectAboutMeInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Gi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					       $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected About information by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $txnPwd[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			//}
              return Response::returnSuccess("success",array());        
		}
		function VerifyOccupationAdditionalInfo(){  
            global $mysql,$loginInfo;     
			$ApproveOccupationDESCapprovals = explode(",",$_POST['ApproveOccupationDESC']);
			$size = sizeof($ApproveOccupationDESCapprovals);
			$i=1;
			foreach($ApproveOccupationDESCapprovals as $OD) {
                 $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$OD);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Oc_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Oc_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Occupation Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Oc_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectOccupationAdditionalInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Oc_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					        $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Occupation Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyFamilyAdditionalInfo(){  
            global $mysql,$loginInfo;     
			$familyadditionalinfoapprovals = explode(",",$_POST['ApproveFamilyInfoAdditionalInfo']);
			$size = sizeof($familyadditionalinfoapprovals);
			$i=1;
			foreach($familyadditionalinfoapprovals as $FI) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$FI);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Fi_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
                            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Family Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Fi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				}
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Fi_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectFamilyInfoAdditionalInformation'])); 
                            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Family Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Fi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyPhysicallAdditionalInfo(){  
            global $mysql,$loginInfo;     
			$physicaladditionalinfoapprovals = explode(",",$_POST['ApprovePhysicalInfoAdditionalInfo']);
			$size = sizeof($physicaladditionalinfoapprovals);
			$i=1;
			foreach($physicaladditionalinfoapprovals as $PI) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$PI);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Pi_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Pi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Physicall Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Pi_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectPhysicalInfoAdditionalInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Pi_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					         $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Physicall Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyHoroscopeDOB() {  
            global $mysql,$loginInfo;     
			$horoscopedobapprovals = explode(",",$_POST['ApproveHoroscopeDob']);
			$size = sizeof($horoscopedobapprovals);
			$i=1;
			foreach($horoscopedobapprovals as $HDOB) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$HDOB);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Hd_Dob",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Hd_Dob`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Date of Birth by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Hd_Dob",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectHoroscopeDobInfo'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Hd_Dob`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					        $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Date of Birth by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyHoroscopeAdditionInfo() {  
            global $mysql,$loginInfo;     
			$horoscopeadditionalinfoapprovals = explode(",",$_POST['ApproveHoroscopeAdditionalInfo']);
			$size = sizeof($horoscopeadditionalinfoapprovals);
			$i=1;
			foreach($horoscopeadditionalinfoapprovals as $HD) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$HD);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Hd_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Hd_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Horoscope Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Hd_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectHoroscopeAdditionalInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Hd_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					        $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Horoscope Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyPartnersexpectationAdditionInfo() {  
            global $mysql,$loginInfo;     
			$partnersexpectadditionalinfoapprovals = explode(",",$_POST['ApprovePartnerExpectationAdditionalInfo']);
			$size = sizeof($partnersexpectadditionalinfoapprovals);
			$i=1;
			foreach($partnersexpectadditionalinfoapprovals as $PE) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$PE);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Pe_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Pe_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Partners Expectations Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Pe_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectPartnerExpectationAdditionalInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Pe_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					       $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Partners Expectations Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
		function VerifyCommunicationAdditionalInfo() {  
            global $mysql,$loginInfo;     
			$communicationadditionalinfoapprovals = explode(",",$_POST['ApproveCommunicationAdditionalInfo']);
			$size = sizeof($communicationadditionalinfoapprovals);
			$i=1;
			foreach($communicationadditionalinfoapprovals as $CD) {
                $admin = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
				$pval = explode("#",$CD);
				if ($pval[4]==1) {
						
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"     =>$pval[0],
																			 "MemberID"      =>$pval[1],                    
																			 "FieldName"     =>"Verify_Cd_Desc",                    
																			 "IsVerified"    =>"1",                    
																			 "IsVerifiedOn"  =>date("Y-m-d H:i:s"))); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Cd_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
				            $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Approve Communications Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
                }
				if ($pval[4]==2) {
					
						$id=$mysql->insert("_tbl_profile_verification",array("ProfileID"       =>$pval[0],
																			 "MemberID"        =>$pval[1],                    
																			 "FieldName"       =>"Verify_Cd_Desc",                    
																			 "IsVerified"      =>"2",                    
																			 "RejectedOn"      =>date("Y-m-d H:i:s"),
																			 "ReasonForReject" => $_POST['ReasonForRejectCommunicationAdditionalInformation'])); 
				
							$mysql->execute("update `_tbl_draft_profiles` set `Verify_Cd_Desc`='".$id."' where `ProfileID`='".$pval[0]."' and `MemberID`='".$pval[1]."'");
					        $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $pval[1],
                                                                          "MemberCode"            => $pval[2],
                                                                          "DraftProfileID"        => $pval[0],
                                                                          "DraftProfileCode"      => $pval[3],
                                                                          "Activity"              => "Rejected Communications Details by DAT",
                                                                          "ActivityOn"            => date("Y-m-d H:i:s"),
                                                                          "ActivityDoneBy"        => "Admin",
                                                                          "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                                          "ActivityDoneByCode"    => $admin[0]['AdminCode'],
                                                                          "Remarks"               => "" ));
				
				}
				$i++; 
			}
              return Response::returnSuccess("success",array());
		}
        function GetManageStaffs() {
           global $mysql;    
              $Staffs = $mysql->select("select * from _tbl_admin where IsDeleted='0' and `IsAdmin`='0'");
                return Response::returnSuccess("success",$Staffs);
        }
        function GetManageSupportDeskUsers() {
           global $mysql;    
              $Users = $mysql->select("select * from _tbl_support_desk_user where IsDeleted='0'");
                return Response::returnSuccess("success",$Users);
        }
        function CreateAdminStaff() {
            
            global $mysql,$loginInfo;
			
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
            
            if (!(strlen(trim($_POST['StaffCode']))>0)) {
                return Response::returnError("Please enter admin code");                                          
            }
            
            if (!(strlen(trim($_POST['StaffName']))>0)) {
                return Response::returnError("Please enter admin name");
            }
            if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter mobile number");
            }       
            
            if (!(strlen(trim($_POST['EmailID']))>0)) {
                return Response::returnError("Please enter email id");
            }                        
            if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
                return Response::returnError("Please select gender");
            }
            
            if (!(strlen(trim($_POST['LoginName']))>0)) {
                return Response::returnError("Please enter login name");
            }
            
            if (!(strlen(trim($_POST['LoginPassword']))>0)) {
                return Response::returnError("Please enter login password");
            }
            
            $data = $mysql->select("select * from  _tbl_admin where AdminCode='".trim($_POST['StaffCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Staff Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_admin where MobileNumber='".trim($_POST['MobileNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Mobile Number Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_admin where EmailID='".trim($_POST['EmailID'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Email ID Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_admin where AdminLogin='".trim($_POST['LoginName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Login Name Already Exists");
            }
            
            $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
            
                  $id = $mysql->insert("_tbl_admin",array("AdminCode"       => $_POST['StaffCode'],   
                                                                 "AdminName"       => $_POST['StaffName'], 
                                                                 "DateofBirth"     => $dob,
                                                                 "Sex"             => $_POST['Sex'],
                                                                 "CountryCode"    => $_POST['CountryCode'],
																 "MobileNumber"    => $_POST['MobileNumber'],
                                                                 "EmailID"         => $_POST['EmailID'],
                                                                 "AdminLogin"       => $_POST['LoginName'],
                                                                 "AdminPassword"   => $_POST['LoginPassword'],
                                                                 "StaffRoll"   => $_POST['UserRole'],
                                                                 "IsActive"        => "1",
																 "CreatedOn"       => date("Y-m-d H:i:s"), 
																 "ChangePasswordFstLogin"   => (($_POST['PasswordFstLogin']=="on") ? '1' : '0')));
                                                                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='AdminStaffs'");
              
            if (sizeof($id)>0) {
                $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminStaffCreate'");
					 $content  = str_replace("#StaffName#",$_POST['StaffName'],$mContent[0]['Content']);
					 $content  = str_replace("#AdminName#",$txnPwd[0]['AdminName'],$content);
					 $content  = str_replace("#LoginName#",$_POST['LoginName'],$content);
					 $content  = str_replace("#LoginPassword#",$_POST['LoginPassword'],$content);

					 MailController::Send(array("MailTo"   => $_POST['EmailID'],
												"Category" => "AdminStaffCreate",
												"MemberID" => $id,
												"Subject"  => $mContent[0]['Title'],
												"Message"  => $content),$mailError);
					MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['staffName'].",You have added as a staff in ".$txnPwd[0]['AdminName']." <br> Your StaffID ID is ".$_POST['StaffCode']." ,Login Name is ".$_POST['LoginName']." and Login Password is ".$_POST['LoginPassword']." " );
                return Response::returnSuccess("success",array("StaffCode" => $_POST['StaffCode']));
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    
    function GetAdminStaffInfo(){

        global $mysql;
        $Staffs = $mysql->select("select * from _tbl_admin where AdminCode='".$_POST['Code']."'");
        $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `AdminID`='".$Staffs[0]['AdminID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
        return Response::returnSuccess("success",array("Staffs"             => $Staffs,
                                                       "AdminStaffCode"     => SeqMaster::GetNextAdminStaffNumber(),
                                                       "Gender"             => CodeMaster::getData('SEX'),
                                                       "LastLogin"          => $LoginHistory,
                                                       "CountryName"        => CodeMaster::getData('RegisterAllowedCountries')));

    }
    function GetSupportDeskUserInfo(){
        global $mysql;
        $Users = $mysql->select("select * from _tbl_support_desk_user where UserCode='".$_POST['Code']."'");
        $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `SupportDeskUserID`='".$Users[0]['UserID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
        return Response::returnSuccess("success",array("SupportDeskUserCode" => SeqMaster::GetNextSupportDeskUserCode(),
                                                       "Gender"              => CodeMaster::getData('SEX'),
                                                       "CountryName"         => CodeMaster::getData('RegisterAllowedCountries'),
                                                       "LastLogin"           => $LoginHistory,
                                                       "Users"               => $Users));

    }
    function CreateSupportDeskUser() {
            
            global $mysql,$loginInfo;
            
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            if (!(strlen(trim($_POST['UserCode']))>0)) {
                return Response::returnError("Please enter user code");                                          
            }
            
            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter user name");
            }
            if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter mobile number");
            }       
            
            if (!(strlen(trim($_POST['EmailID']))>0)) {
                return Response::returnError("Please enter email id");
            }                        
            if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
                return Response::returnError("Please select gender");
            }
            
            if (!(strlen(trim($_POST['LoginName']))>0)) {
                return Response::returnError("Please enter login name");
            }
            
            if (!(strlen(trim($_POST['LoginPassword']))>0)) {
                return Response::returnError("Please enter login password");
            }
            
            $data = $mysql->select("select * from  _tbl_support_desk_user where UserCode='".trim($_POST['UserCode'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("User Code Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_support_desk_user where MobileNumber='".trim($_POST['MobileNumber'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Mobile Number Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_support_desk_user where EmailID='".trim($_POST['EmailID'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Email ID Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_support_desk_user where UserLogin='".trim($_POST['LoginName'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Login Name Already Exists");
            }
            
            $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
            
                  $id = $mysql->insert("_tbl_support_desk_user",array("UserCode"       => $_POST['UserCode'],   
                                                                 "UserName"       => $_POST['UserName'], 
                                                                 "DateofBirth"     => $dob,
                                                                 "Sex"             => $_POST['Sex'],
                                                                 "CountryCode"    => $_POST['CountryCode'],
                                                                 "MobileNumber"    => $_POST['MobileNumber'],
                                                                 "EmailID"         => $_POST['EmailID'],
                                                                 "UserLogin"       => $_POST['LoginName'],
                                                                 "UserPassword"   => $_POST['LoginPassword'],
                                                                 "IsActive"        => "1",
                                                                 "CreatedOn"       => date("Y-m-d H:i:s"), 
                                                                 "ChangePasswordFstLogin"   => (($_POST['PasswordFstLogin']=="on") ? '1' : '0')));
                                                                 $mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='SupportDeskUsers'");
              
            if (sizeof($id)>0) {
                $mContent = $mysql->select("select * from `mailcontent` where `Category`='SupportDeskUserCreate'");
                     $content  = str_replace("#UserName#",$_POST['UserName'],$mContent[0]['Content']);
                     $content  = str_replace("#UserLogin#",$_POST['LoginName'],$content);
                     $content  = str_replace("#UserPassword#",$_POST['LoginPassword'],$content);

                     MailController::Send(array("MailTo"   => $_POST['EmailID'],
                                                "Category" => "SupportDeskUserCreate",
                                                "SDUserID" => $id,
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                    MobileSMSController::sendSMS($_POST['MobileNumber']," Dear ".$_POST['UserName'].",You have added as a user in support desk  <br> Your User ID is ".$_POST['UserCode']." ,Login Name is ".$_POST['LoginName']." and Login Password is ".$_POST['LoginPassword']." " );
                return Response::returnSuccess("success",array("UserCode" => $_POST['UserCode']));
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
	function GetMyStaffInfo(){

        global $mysql,$loginInfo;
        $Staffs = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");

        return Response::returnSuccess("success",$Staffs);

    }
        
    function EditAdminStaff(){
              global $mysql,$loginInfo;
        
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }            
            if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter mobile number");
            }       
            
            if (!(strlen(trim($_POST['EmailID']))>0)) {
                return Response::returnError("Please enter email id");
            }                        
            if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
                return Response::returnError("Please select gender");
            }
            
        $data = $mysql->select("select * from  _tbl_admin where MobileNumber='".trim($_POST['MobileNumber'])."' and AdminCode<>'".$_POST['StaffCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_admin where EmailID='".trim($_POST['EmailID'])."' and AdminCode<>'".$_POST['StaffCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        
        $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date']; 
    
             $mysql->execute("update _tbl_admin set AdminName='".$_POST['StaffName']."', 
                                                           DateofBirth='".$dob."',
                                                           Sex='".$_POST['Sex']."',
                                                           CountryCode                 ='".$_POST['CountryCode']."',
                                                           MobileNumber='".$_POST['MobileNumber']."',
                                                           EmailID='".$_POST['EmailID']."',
                                                           StaffRoll='".$_POST['UserRole']."'
                                                           where  AdminCode='".$_POST['StaffCode']."'");

              
                return Response::returnSuccess("success",array("AdminCode"=>$_POST['StaffCode']));

    }
    function EditSupportDeskUser(){
              global $mysql,$loginInfo;
        
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }            
            if (!(strlen(trim($_POST['MobileNumber']))>0)) {
                return Response::returnError("Please enter mobile number");
            }       
            
            if (!(strlen(trim($_POST['EmailID']))>0)) {
                return Response::returnError("Please enter email id");
            }                        
            if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
                return Response::returnError("Please select gender");
            }
            
        $data = $mysql->select("select * from  _tbl_support_desk_user where MobileNumber='".trim($_POST['MobileNumber'])."' and UserCode<>'".$_POST['UserCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_support_desk_user where EmailID='".trim($_POST['EmailID'])."' and UserCode<>'".$_POST['UserCode']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        
        $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date']; 
    
             $mysql->execute("update _tbl_support_desk_user set UserName='".$_POST['UserName']."', 
                                                           DateofBirth='".$dob."',
                                                           Sex='".$_POST['Sex']."',
                                                           CountryCode                 ='".$_POST['CountryCode']."',
                                                           MobileNumber='".$_POST['MobileNumber']."',
                                                           EmailID='".$_POST['EmailID']."'
                                                           where  UserCode='".$_POST['UserCode']."'");

              
                return Response::returnSuccess("success",array("UserCode"=>$_POST['UserCode']));

    }
	function ViewPlanForCreateFranchisee() { 
		global $mysql,$loginInfo;
		$Plans = Plans::GetFranchiseePlans();
		
			$result = "";
			foreach ($Plans as $Pan) {
				$result .='<tr>
							<td><div class="custom-control custom-radio">
								  <input type="radio" class="custom-control-input" id="'.$Pan['PlanID'].'" name="defaultExampleRadios">
								  <label class="custom-control-label" for="'.$Pan['PlanID'].'"></label>
								</div></td>
							<td>'.$Pan['PlanName'].'</td>
							<td>'.$Pan['Duration'].'</td>
							<td>'.$Pan['Amount'].'</td>
						</tr>';
		 }  
		
		$res ='<div class="modal-header">
					<h4 class="modal-title">Plan</h4>
				</div>
				<div class="modal-body" style="text-align:center">
					<div id="content" style="height: 160px;overflow: scroll;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td></td>
								<td>Plan Name</td>
								<td>Duration</td>
								<td>Amount</td>
							</tr>
						</thead>
						<tbody>
							'.$result.'
						</tbody>
					</table>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-primary" name="Select" id="Select" style="color:white">Select</a>&nbsp;&nbsp;
					<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">Cancel</a>
				</div>';
		return $res;
	}
	function ViewFranchiseePlanDetails() { 
		global $mysql,$loginInfo;
		$Plan = $mysql->select("select * from  _tbl_franchisees_plans where IsActive='1' and PlanName='".$_POST['PlanName']."'");
			
		$res ='<div class="modal-header">
					<h4 class="modal-title">Plan</h4>
				</div>
				<div class="modal-body" style="text-align:center">
					<div id="content" style="height: 160px;overflow: scroll;">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td></td>
								<td>Plan Name</td>
								<td>Duration</td>
								<td>Amount</td>
							</tr>
						</thead>
						<tbody>
							<tr>
							<td><div class="custom-control custom-radio">
								  <input type="radio" class="custom-control-input" id="'.$Pan[0]['PlanID'].'" name="defaultExampleRadios">
								  <label class="custom-control-label" for="'.$Pan[0]['PlanID'].'"></label>
								</div></td>
							<td>'.$Plan[0]['PlanName'].'</td>
							<td>'.$Plan[0]['Duration'].'</td>
							<td>'.$Plan[0]['Amount'].'</td>
						</tr>
						</tbody>
					</table>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-primary" name="Change" id="Change" style="color:white">Change</a>&nbsp;&nbsp;
					<a data-dismiss="modal" style="color:#1d8fb9;cursor:pointer">Cancel</a>
				</div>';
		return $res;
	}
    
    
    function ManageFranchiseeStaffs() {

             global $mysql,$loginInfo;

             $sql = "SELECT * From `_tbl_franchisees_staffs` where `FrCode`='".$_POST['Code']."' and `IsDeleted`='0'";

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
		 
         function GetFranchiseeStaffs(){
           global $mysql,$loginInfo;    
              
              $Staffs = $mysql->select("select * from _tbl_franchisees_staffs where StaffCode='".$_POST['Code']."'");
              $Sex =   $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$Staffs[0]['Sex']."'");
              $LoginHistory = $mysql->select("select * from `_tbl_logs_logins` where `FranchiseeID`='".$Staffs [0]['FranchiseeID']."' and `FranchiseeStaffID`='".$Staffs[0]['PersonID']."' ORDER BY `LoginID` DESC LIMIT 0,10");
                return Response::returnSuccess("success",array("Staffs" => $Staffs,
                                                                "Gender"     =>$Sex,
                                                                "LastLogin"     =>$LoginHistory));
           }
           function GetFranchiseeStaffCodeCode(){                                
            return Response::returnSuccess("success",array("staffCode" => SeqMaster::GetNextFranchiseeStaffNumber(),
												           "Gender"     => CodeMaster::getData('SEX'),
                                                           "Country"     => CodeMaster::getData('RegisterAllowedCountries')));
			}
		
		function CreateFranchiseeStaff() {
                                                                            
        global $mysql,$loginInfo;  
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
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
        $Franchisee = $mysql->select("select * from _tbl_franchisees where FranchiseeCode='".$_POST['FranchiseeCode']."'"); 
        $dob = $_POST['year']."-".$_POST['month']."-".$_POST['date'];
		$StaffCode =SeqMaster::GetNextFranchiseeStaffNumber();
		$country = CodeMaster::getData("CONTNAMES",$_POST['CountryName']);
		$Sex = CodeMaster::getData("SEX",$_POST['Sex']);
          $id =  $mysql->insert("_tbl_franchisees_staffs",array("FrCode"          => $Franchisee[0]['FranchiseeCode'],
                                                                "FranchiseeID"    => $Franchisee[0]['FranchiseeID'],
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
                return Response::returnSuccess("success",array("StaffCode" => $StaffCode,"FranchiseeCode" => $Franchisee[0]['FranchiseeCode']));
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
		
        function EditFranchiseeStaff(){
              global $mysql,$loginInfo;    
              
              $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
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
                     
                     $mysql->execute("update _tbl_franchisees_staffs set IsMobileVerified='0' where  StaffCode='".$_POST['StaffCode']."' and FranchiseeID='".$Staffs[0]['FranchiseeID']."'");
                    
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
                                                                    "EmailID"             => $Staffs[0]['EmailID'],
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
                return Response::returnSuccess("success",array("FranchiseeCode"=>$Staffs[0]['FrCode']));
                                                                                               
    } 
    function DeactiveFranchiseeStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
            return Response::returnError("Staff already deactivated"); 
        }
        $mysql->execute("update _tbl_franchisees_staffs set IsActive='0' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
					
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
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==1){
            return Response::returnError("Staff already Activated"); 
        }
        $mysql->execute("update _tbl_franchisees_staffs set IsActive='1' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
        return Response::returnSuccess("Activated Successfully",array());
    }
    function FranchiseeStaffChnPswd() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        if (isset($_POST['NewPswd'])) {
                if (strlen(trim($_POST['NewPswd']))<6) {
                   return Response::returnError("Please enter password more than 6 character "); 
                }
                if (strlen(trim($_POST['NewPswd']))!= strlen(trim($_POST['ConfirmNewPswd']))) {
                   return Response::returnError("Password do not match"); 
                }
               
               $mysql->execute("update _tbl_franchisees_staffs set LoginPassword='".$_POST['NewPswd']."' ,ChangePasswordFstLogin='".(($_POST['ChnPswdFstLogin']=="on") ? '1' : '0')."' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
                 return Response::returnSuccess("Success",array());  
            }
        
    }
    function ResetTxnPswdFranchiseeStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        /*if(strlen($staff[0]['TransactionPassword']==0)){
            return Response::returnError("Transaction password already reseted"); 
        }*/
        if($staff[0]['IsActive']==0){
            return Response::returnError("Account is deactivated so Could not process"); 
        }
        $mysql->execute("update _tbl_franchisees_staffs set TransactionPassword='' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
       
		$mContent = $mysql->select("select * from `mailcontent` where `Category`='FranchiseeStaffResetTxnPassword'");
					$content  = str_replace("#FranchiseeName#",$staff[0]['PersonName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
												"Category"       => "FranchiseeStaffResetTxnPassword",
												"FranchiseeCode" => $staff[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['PersonName'].",Your Transaction Password has been rested successfully.");  
		
	   return Response::returnSuccess("success",array());
    }
    function DeleteFranchiseeStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
            if($staff[0]['Deleted']==1){
            return Response::returnError("Account is already deleted"); 
        }
        $mysql->execute("update _tbl_franchisees_staffs set IsDeleted='1' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
        return Response::returnSuccess("success",array("FranchiseeCode"=>$staff[0]['FrCode']));
    }
    function FranchiseeStaffMobverification(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_franchisees_staffs set IsMobileVerified='1',MobileVerifiedOn='".date("Y-m-d H:i:s")."' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
        return Response::returnSuccess("Success",array());
    }
    function FranchiseeStaffEmailverification(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_franchisees_staffs set IsEmailVerified='1',EmailVerifiedOn='".date("Y-m-d H:i:s")."' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
        return Response::returnSuccess("Success",array());
    }
    function FranchiseeStaffChnPswdFstLogin() {
        global $mysql,$loginInfo;
        $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_franchisees_staffs` where StaffCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_franchisees_staffs set ChangePasswordFstLogin='0' where `FranchiseeID`='".$staff[0]['FranchiseeID']."' and StaffCode='".$_POST['StaffCode']."'");
        return Response::returnSuccess("Success",array());
    }
    
    function DeactiveAdminStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_admin` where AdminCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
            return Response::returnError("Staff already deactivated"); 
        }
        $mysql->execute("update _tbl_admin set IsActive='0' where `AdminID`='".$staff[0]['AdminID']."' and AdminCode='".$_POST['StaffCode']."'");
        
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='DeactivateAdminStaff'");
			$content  = str_replace("#AdminName#",$staff[0]['AdminName'],$mContent[0]['Content']);
			
			 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
										"Category"       => "DeactivateAdminStaff",
										"AdminCode" => $staff[0]['AdminCode'],
										"Subject"        => $mContent[0]['Title'],
										"Message"        => $content),$mailError);
			 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['AdminName'].",Your staff account has been deactivated.");  
		
		return Response::returnSuccess("Deactivated Successfully",array());
    }
    function ActiveAdminStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_admin` where AdminCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==1){
            return Response::returnError("Staff already Activated"); 
        }
        $mysql->execute("update _tbl_admin set IsActive='1' where `AdminID`='".$staff[0]['AdminID']."' and AdminCode='".$_POST['StaffCode']."'");
        
		$mContent = $mysql->select("select * from `mailcontent` where `Category`='ActivateAdminStaff'");
			$content  = str_replace("#AdminName#",$staff[0]['AdminName'],$mContent[0]['Content']);
			
			 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
										"Category"       => "ActivateAdminStaff",
										"AdminCode" => $staff[0]['AdminCode'],
										"Subject"        => $mContent[0]['Title'],
										"Message"        => $content),$mailError);
			 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['AdminName'].",Your staff account has been activated.");  
		
		return Response::returnSuccess("Activated Successfully",array());
    }
    function AdminStaffChnPswd() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_admin` where AdminCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($staff[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        if (isset($_POST['NewPswd'])) {
                if (strlen(trim($_POST['NewPswd']))<6) {
                   return Response::returnError("Please enter password more than 6 character "); 
                }
                if (strlen(trim($_POST['NewPswd']))!= strlen(trim($_POST['ConfirmNewPswd']))) {
                   return Response::returnError("Password do not match"); 
                }
               
               $mysql->execute("update _tbl_admin set AdminPassword='".$_POST['NewPswd']."' where `AdminID`='".$staff[0]['AdminID']."' and AdminCode='".$_POST['StaffCode']."'");
               
			   $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminStaffChangePassword'");
					$content  = str_replace("#AdminName#",$staff[0]['AdminName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
												"Category"       => "AdminStaffChangePassword",
												"AdminCode" 	 => $staff[0]['AdminCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['AdminName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPswd']."");  
				
			   return Response::returnSuccess("Success",array());  
            }
        
    }
    function ResetTxnPswdAdminStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_admin` where AdminCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        /*if(strlen($staff[0]['TransactionPassword']==0)){
            return Response::returnError("Transaction password already reseted"); 
        }*/
        if($staff[0]['IsActive']==0){
            return Response::returnError("Account is deactivated so Could not process"); 
        }
        $mysql->execute("update _tbl_admin set TransactionPassword='' where `AdminID`='".$staff[0]['AdminID']."' and AdminCode='".$_POST['StaffCode']."'");
			$mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminStaffResetTxnPassword'");
			$content  = str_replace("#AdminName#",$staff[0]['AdminName'],$mContent[0]['Content']);
			
			 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
										"Category"       => "AdminStaffResetTxnPassword",
										"FranchiseeCode" => $staff[0]['FrCode'],
										"Subject"        => $mContent[0]['Title'],
										"Message"        => $content),$mailError);
			 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['AdminName'].",Your Transaction Password has been reset successfully.");  
		
		return Response::returnSuccess("success",array());
    }
    function DeleteAdminStaff(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $staff = $mysql->select("select * from `_tbl_admin` where AdminCode='".$_POST['StaffCode']."'");
            if(!(sizeof($staff)==1)){
                return Response::returnError("Invalid staff information"); 
            }
            if($staff[0]['Deleted']==1){
            return Response::returnError("Account is already deleted"); 
        }
        $mysql->execute("update _tbl_admin set IsDeleted='1' where `AdminID`='".$staff[0]['AdminID']."' and AdminCode='".$_POST['StaffCode']."'");
        
		$mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteAdminStaffAccount'");
			$content  = str_replace("#AdminName#",$staff[0]['AdminName'],$mContent[0]['Content']);
			
			 MailController::Send(array("MailTo"         => $staff[0]['EmailID'],
										"Category"       => "DeleteAdminStaffAccount",
										"FranchiseeCode" => $staff[0]['FrCode'],
										"Subject"        => $mContent[0]['Title'],
										"Message"        => $content),$mailError);
			 MobileSMSController::sendSMS($staff[0]['MobileNumber']," Dear ".$staff[0]['AdminName'].",Your account has been deleted successfully.");  
		
		return Response::returnSuccess("success",array("AdminCode"=>$_POST['StaffCode']));
    }
	function AdminStaffChnPswdFstLogin() {
		global $mysql,$loginInfo;
		 $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
		$staff = $mysql->select("select * from `_tbl_admin` where `AdminCode`='".$_POST['StaffCode']."'");
			if(!(sizeof($staff)==1)){
				return Response::returnError("Invalid staff information"); 
			}
		if($staff[0]['IsActive']==0){
				return Response::returnError("Account is deactivated so Could not process"); 
			}
		$mysql->execute("update _tbl_admin set ChangePasswordFstLogin='0' where AdminCode='".$_POST['StaffCode']."'");
		return Response::returnSuccess("Success",array());
	}

	function CheckVerification() {
            
            global $mysql,$loginInfo;
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
			
			if ($admindata[0]['ChangePasswordFstLogin']==1) {
               return $this->ChangePasswordScreen("",$loginInfo[0]['AdminID'],"","");
            }
			if (strlen(trim($admindata[0]['TransactionPassword']))<6) {
               return $this->TransactionPasswordScreen("",$loginInfo[0]['AdminID'],"","");
            }
			if ($admindata[0]['IsMobileVerified']==0) {
               return $this->ChangeMobileNumberFromVerificationScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
            
            if ($admindata[0]['IsEmailVerified']==0) {
               return $this->ChangeEmailFromVerificationScreen("",$loginInfo[0]['FranchiseeID'],"","");
            }
	}
	function ChangePasswordScreen($error="",$loginid="",$npswd="",$cnpswd="",$reqID="") {
           
		   global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            if ($admindata[0]['ChangePasswordFstLogin']==0) {
				return '<div class="modal-body" style="text-align:center"><br><br>
							<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
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
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
			if (isset($_POST['NewPassword'])) {
				if (strlen(trim($_POST['NewPassword']))<6) {
                   return $this->ChangePasswordScreen("Invalid new password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['ConfirmNewPassword'],$_POST['reqId']);
                }
				if (strlen(trim($_POST['NewPassword']))!= strlen(trim($_POST['ConfirmNewPassword']))) {
                   return $this->ChangePasswordScreen("Do not match password.",$_POST['loginId'],$_POST['NewPassword'],$_POST['ConfirmNewPassword'],$_POST['reqId']);
                }
               
                $update = "update _tbl_admin set AdminPassword='".$_POST['NewPassword']."' ,ChangePasswordFstLogin='0' where AdminID='".$loginInfo[0]['AdminID']."'";
                $mysql->execute($update);
				
					$mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminStaffChangePassword'");
					$content  = str_replace("#AdminName#",$admindata[0]['AdminName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $admindata[0]['EmailID'],
												"Category"       => "AdminStaffChangePassword",
												"AdminCode" 	 => $admindata[0]['AdminCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($admindata[0]['MobileNumber']," Dear ".$admindata[0]['AdminName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['NewPassword']."");  
                
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
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
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            if (strlen(trim($franchiseedata[0]['TransactionPassword']))>8) {
				return '<div class="modal-body" style="text-align:center"><br><br>
							<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
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
				$admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
                $update = "update _tbl_admin set TransactionPassword='".$_POST['TransactionPassword']."' where AdminID='".$loginInfo[0]['AdminID']."'";
                $mysql->execute($update);
				
				$mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminStaffChangeTxnPassword'");
					$content  = str_replace("#AdminName#",$admindata[0]['AdminName'],$mContent[0]['Content']);
					
					 MailController::Send(array("MailTo"         => $admindata[0]['EmailID'],
												"Category"       => "AdminStaffChangeTxnPassword",
												"FranchiseeCode" => $admindata[0]['FrCode'],
												"Subject"        => $mContent[0]['Title'],
												"Message"        => $content),$mailError);
					 MobileSMSController::sendSMS($admindata[0]['MobileNumber']," Dear ".$admindata[0]['AdminName'].",Your Transaction Password has been changed successfully. Your New Transaction Password is ".$_POST['TransactionPassword']."");  
                
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your transaction password has been<br> successfully updated.</h4>    <br>
                            <a href="javascript:void(0)" onclick="location.href=location.href" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';   
            }
                                                                                                                                    
           
        }

	function ChangeMobileNumberFromVerificationScreen($error="",$loginid="",$scode="",$reqID="") {
            global $mysql,$loginInfo;
            
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            
            if ($admindata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_mobile_verification.png"></p>
                                <h4 style="text-align:center;color:#ada9a9">In order to protect your account, we will send a verification code for verification that you will need to enter the next screen.</h4>
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">+'.$admindata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($admindata[0]['MobileNumber']).'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeMobileNumber()">Change</h4>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:void(0)" onclick="MobileNumberVerificationForm()" class="btn btn-primary">Continue to verify</a>&nbsp;&nbsp;
                            </div>
                        </div>'; 
                }
        }
		function ChangeMobileNumber($error="",$loginid="",$scode="",$reqID="") {
           
            global $mysql,$loginInfo;
           
            if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            }   
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            
            if ($admindata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
									<p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_mobile_verification.png"></p>                                 
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
										<a href="javascript:void(0)" onclick="CheckVerification()">back</a>
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
                
                $duplicate = $mysql->select("select * from _tbl_admin where MobileNumber='".$_POST['new_mobile_number']."' and AdminID <>'".$loginInfo[0]['AdminID']."'");
                
				if (sizeof($duplicate)>0) {
                   return $this->ChangeMobileNumber("Mobile Number already in use.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
				
				$duplicates = $mysql->select("select * from _tbl_admin where MobileNumber='".$_POST['new_mobile_number']."' and AdminID ='".$loginInfo[0]['AdminID']."'");
                
				if (sizeof($duplicates)>0) {
                   return $this->ChangeMobileNumber("you enter your old mobile number.",$_POST['loginId'],$_POST['new_mobile_number'],$_POST['reqId']);
                }
                
                $update = "update _tbl_admin set MobileNumber='".$_POST['new_mobile_number']."' , CountryCode='".$_POST['CountryCode']."' where AdminID='".$loginInfo[0]['AdminID']."'";
                $mysql->execute($update);
                $id = $mysql->insert("_tbl_logs_activity",array("AdminID"       => $loginInfo[0]['AdminID'],
                                                                "RequestSentOn" =>date("Y-m-d H:i:s"),    
                                                             "ActivityType"   => 'MobileNumberChanged.',
                                                             "ActivityString" => 'Mobile Number Changed.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                $updatemsg = "<div class='successmessage'>Your new mobile number has been updated.</div>";
            }
                                                                                                                                    
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            
            if ($admindata[0]['IsMobileVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                          
                if ($error=="") {
                    $otp=rand(1111,9999);
                    MobileSMSController::sendSMS($admindata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    $securitycode = $mysql->insert("_tbl_verification_code",array("AdminID" =>$admindata[0]['AdminID'],
                                                                                 "SMSTo" =>$admindata[0]['MobileNumber'],
                                                                                 "SecurityCode" =>$otp,
                                                                                 "Type" =>"Admin Mobile Verification",
                                                                                 "Messagedon"=>date("Y-m-d h:i:s"))) ; 
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
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_mobile_verification.png"></p>                                 
                                <h4 style="text-align:center;color:#ada9a9">Please enter the verification code which you have received on your mobile number ending with  <br>+ '.$admindata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($admindata[0]['MobileNumber']).'</h4>
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
             global $mysql,$loginInfo;
              if (sizeof($loginInfo)==0) {
                return "Invalid request. Please login again.";
            } 
             
             $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
             
             if ($admindata[0]['IsMobileVerified']==1) {
                 return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
             } else {
                 if ($error=="") {                                          
                    $otp=rand(1111,9999);
                    MobileSMSController::sendSMS($admindata[0]['MobileNumber'],"Mobile Verification Security Code is ".$otp);
                    $securitycode = $mysql->insert("_tbl_verification_code",array("AdminID" =>$admindata[0]['AdminID'],
                                                                                  "RequestSentOn" =>date("Y-m-d H:i:s"),
																				  "SMSTo" =>$admindata[0]['MobileNumber'],
                                                                                  "SecurityCode" =>$otp,
                                                                                  "Type" =>"Admin Mobile Verification",
                                                                                  "Messagedon"=>date("Y-m-d h:i:s"))) ; 
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
                                <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_mobile_verification.png"></p>                                 
                                <h4 style="text-align:center;color:#ada9a9">Please enter the verification code which you have received on your mobile number ending with  +'.$admindata[0]['CountryCode'].'-'.J2JApplication::hideMobileNumberWithCharacters($admindata[0]['MobileNumber']).'</h4>
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
                
                $sql = "update _tbl_admin set IsMobileVerified='1', MobileVerifiedOn='".date("Y-m-d H:i:s")."' where AdminID='".$otpInfo[0]['AdminID']."'";
                $mysql->execute($sql);
                $id = $mysql->insert("_tbl_logs_activity",array("AdminID"       => $otpInfo[0]['AdminID'],
                                                             "ActivityType"   => 'MobileNumberVerified.',
                                                             "ActivityString" => 'Mobile Number Verified.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your number has been<br> successfully verified.</h4>    <br>
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
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            
             if ($admindata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
                                <h5 style="text-align:center;color:#ada9a9"><h4 style="text-align:center;color:#ada9a9">'.$admindata[0]['EmailID'].'&nbsp;&#65372;&nbsp;<a href="javascript:void(0)" onclick="ChangeEmailID()">Change</h4>
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
            
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
            
            if ($admindata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
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
										<a href="javascript:void(0)" onclick="CheckVerification()">back</a>
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
                $duplicate = $mysql->select("select * from _tbl_admin where EmailID='".$_POST['new_email']."' and AdminID <>'".$loginInfo[0]['AdminID']."'");
                
                if (sizeof($duplicate)>0) {
                   return $this->ChangeEmailID("Email already in use.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']); 
                }
				
				$duplicates = $mysql->select("select * from _tbl_admin where EmailID='".$_POST['new_email']."' and AdminID ='".$loginInfo[0]['AdminID']."'");
                
				if (sizeof($duplicates)>0) {
                   return $this->ChangeEmailID("you entered your old email id.",$_POST['loginId'],$_POST['new_email'],$_POST['reqId']);
                }
                
                $sql ="update _tbl_admin set EmailID='".$_POST['new_email']."' where AdminID='".$loginInfo[0]['AdminID']."'";
                $mysql->execute($sql);
                $id = $mysql->insert("_tbl_logs_activity",array("AdminID"       => $loginInfo[0]['AdminID'],
                                                             "ActivityType"   => 'EmailIDChanged.',
                                                             "ActivityString" => 'Email ID Changed.',
                                                             "SqlQuery"       => base64_encode($sql),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
            }
            $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
           
            if ($admindata[0]['IsEmailVerified']==1) {
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
            } else {
                if ($error=="") {
                     $otp=rand(1111,9999);
                     
                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminEmailVerification'");
                     $content  = str_replace("#AdminName#",$admindata[0]['AdminName'],$mContent[0]['Content']);
                     $content  = str_replace("#otp#",$otp,$content);
                     
                     MailController::Send(array("MailTo"   => $admindata[0]['EmailID'],
                                                "Category" => "AdminEmailVerification",
                                                "AdminID" => $admindata[0]['AdminID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                                                
                     if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("AdminID"  => $admindata[0]['AdminID'],
                                                                                      "EmailTo"      => $admindata[0]['EmailID'],
                                                                                      "SecurityCode" => $otp,
                                                                                      "Type"         => "Admin Email Verification",
                                                                                      "Messagedon"   => date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000); 
                
                        
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
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$admindata[0]['EmailID'].'</h4>
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
             $admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
             if ($admindata[0]['IsEmailVerified']==1) {
                 return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="javascript:void(0)" onclick="CheckVerification()" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';    
             } else {

                 if ($error=="") {
                      $otp=rand(1111,9999);
                     
                     $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminEmailVerification'");
                     $content  = str_replace("#AdminName#",$admindata[0]['AdminName'],$mContent[0]['Content']);
                     $content  = str_replace("#otp#",$otp,$content);
                     
                     MailController::Send(array("MailTo"   => $admindata[0]['EmailID'],
                                                "Category" => "AdminEmailVerification",
                                                "FranchiseeID" => $admindata[0]['FranchiseeID'],
                                                "Subject"  => $mContent[0]['Title'],
                                                "Message"  => $content),$mailError);
                                                
                     if($mailError){
                        return "Mailer Error: " . $mail->ErrorInfo.
                        "Error. unable to process your request.";
                     } else {
                        $securitycode = $mysql->insert("_tbl_verification_code",array("AdminID"  	 => $admindata[0]['AdminID'],
                                                                                      "EmailTo"      => $admindata[0]['EmailID'],
                                                                                      "SecurityCode" => $otp,
                                                                                      "Type"         => "Admin Email Verification",
                                                                                      "Messagedon"   => date("Y-m-d h:i:s"))) ;
                        $formid = "frmMobileNoVerification_".rand(30,3000); 
                
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
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit verification code to<br><h4 style="text-align:center;color:#ada9a9">'.$admindata[0]['EmailID'].'</h4>
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
					$admindata = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");
                    
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
                                                <h4 style="text-align:center;color:#ada9a9">We have sent a 4 digit PIN to<br><h4 style="text-align:center;color:#ada9a9">'.$admindata[0]['EmailID'].'</h4>
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
                $sql = "update _tbl_admin set IsEmailVerified='1', EmailVerifiedOn='".date("Y-m-d H:i:s")."' where AdminID='".$otpInfo[0]['AdminID']."'";
                $mysql->execute($sql); 
                $id = $mysql->insert("_tbl_logs_activity",array("AdminID"       => $otpInfo[0]['AdminID'],
                                                             "ActivityType"   => 'EmailIDVerified.',
                                                             "ActivityString" => 'Email ID Verified.',
                                                             "SqlQuery"       => base64_encode($sql),                               
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
                return '<div class="modal-body" style="text-align:center"><br><br>
                            <p style="text-align:center;padding: 20px;"><img src="'.AppPath.'assets/images/icon_success_verification.png"></p>
                            <h5 style="text-align:center;color:#ada9a9">Greate! Your email has been<br> successfully verified.</h4>    <br>
                            <a href="'.AppPath.'" class="btn btn-primary" style="cursor:pointer;color:white">Continue</a>
                         </div>';
                                    } else {
                                        return $this->EmailVerificationForm("<span style='color:red'>You entered, invalid verification code.</span>",$_POST['loginId'],$_POST['email_otp'],$_POST['reqId']);
                                    }  
        }
		function GetManageTemplates() {

             global $mysql,$loginInfo;
              if(url_encrypt){
				$sql = "SELECT *,Category as AccessCode From `mailcontent`";
			  }else { 
				$sql = "SELECT *,md5(concat(ContentID,'".$loginInfo[0]['LoginOn']."')) as AccessCode From `mailcontent`";
			  }
             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }
		}
		function GetTemplateInfo(){
			global $mysql;
			
			 if(url_encrypt){
				$Templates = $mysql->select("select *,Category as AccessCode from mailcontent where Category='".$_POST['Code']."'");
			  }else { 
				$Templates = $mysql->select("select *,md5(concat(ContentID,'".$loginInfo[0]['LoginOn']."')) as AccessCode from mailcontent where md5(ContentID,'".$loginInfo[0]['LoginOn']."')='".$_POST['Code']."'");
			  }
				
				
				return Response::returnSuccess("success",array("Template"=> $Templates[0]));
		}
		function EditTemplate(){
              global $mysql,$loginInfo;    
              
              $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
                if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                    return Response::returnError("Invalid transaction password");   
                }
				$template = $mysql->select("select * from `mailcontent` where `Category`='".$_POST['Category']."' and Category<>'".$_POST['TCode']."'");
				if (sizeof($template)>0) {
					return Response::returnError("Category Already Exists");
				}
              
                    $mysql->execute("update mailcontent set Category='".$_POST['Category']."', 
                                                           CategoryDescription='".$_POST['CategoryDescription']."', 
                                                           MobileSMSContent='".$_POST['MobileSMSContent']."', 
														   IsActiveMobileSms='".(($_POST['IsActiveMobileSms']=="on") ? '1' : '0')."',
														   IsActiveEmail='".(($_POST['IsActiveEmail']=="on") ? '1' : '0')."',
														   Title='".$_POST['EmailSubject']."', 
                                                           Content='".$_POST['EmailContent']."' where Category='".$_POST['TCode']."'");
                return Response::returnSuccess("success");
		} 
		function TemplateCreate() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            } 
			if (!(strlen(trim($_POST['Category']))>0)) {
                return Response::returnError("Please enter category ");
            }
			$template = $mysql->select("select * from `mailcontent` where `Category`='".$_POST['Category']."'");
			if (sizeof($template)>0) {
				return Response::returnError("Category Already Exists");
			}
			
			$mysql->insert("mailcontent",array("Category"        => $_POST['Category'],
											   "CategoryDescription"  =>$_POST['CategoryDescription']));   
			   
			   return Response::returnSuccess("Success",array());  
            }
	function DeleteMemberDraftProfile() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			
			if($data[0]['IsDelete']==1) {
				return Response::returnError("Profile Already Deleted");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$data[0]['MemberCode']."'");   
                
                if (!(strlen(trim($_POST['DeleteProfileRemarks']))>0)) {
                return Response::returnError("Please enter Deleted Remarks");
                }

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberDeletedraftProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$_POST['ProfileCode'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "MemberDeletedraftProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your draft profile (".$_POST['ProfileCode'].") has been deleted"); 
             
           $mysql->execute("update `_tbl_draft_profiles` set  `IsDelete`      = '1',
																`DeletedOn`      = '".date("Y-m-d H:i:s")."',
																`DeletedRemarks` = '".$_POST['DeleteProfileRemarks']."'
																 where  `MemberID`='".$member[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");

        return Response::returnSuccess("successfully Deleted",array());

    }
	function UnpublishMemberPublishProfile() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			
			if($data[0]['IsPublish']==0) {
				return Response::returnError("Profile Already Unpublished");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$data[0]['MemberCode']."'");   
                
                if (!(strlen(trim($_POST['UnpublishProfileRemarks']))>0)) {
                return Response::returnError("Please enter Unpublish Remarks");
                }

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='UnpublishMemberProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$_POST['ProfileCode'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "UnpublishMemberProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your profile (".$_POST['ProfileCode'].") has been unpublished"); 
             
           $mysql->execute("update `_tbl_profiles` set  `IsPublish`      = '0',
														`IsUnPublishOn`      = '".date("Y-m-d H:i:s")."',
														`UnPublishRemarks` = '".$_POST['UnpublishProfileRemarks']."'
														where  `MemberID`='".$member[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");

        return Response::returnSuccess("successfully Unpublished",array());

    }
	function PublishMemberPublishProfile() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			
			if($data[0]['IsPublish']==1) {
				return Response::returnError("Profile Already Published");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$data[0]['MemberCode']."'");   
            
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='PublishMemberProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$_POST['ProfileCode'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "PublishMemberProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your profile (".$_POST['ProfileCode'].") has been published"); 
             
           $mysql->execute("update `_tbl_profiles` set  `IsPublish`      = '1' where `MemberID`='".$member[0]['MemberID']."' and `ProfileCode`='".$_POST['ProfileCode']."'");

        return Response::returnSuccess("successfully Published",array());

    }
	function UnpublishMemberLandingProfile() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_landingpage_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			$Profile = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			if($data[0]['IsShow']==0) {
				return Response::returnError("Profile Already Unpublished");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$Profile[0]['MemberCode']."'");   
                
                if (!(strlen(trim($_POST['UnpublishProfileRemarks']))>0)) {
                return Response::returnError("Please enter Unpublish Remarks");
                }

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='UnpublishLandingProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$_POST['ProfileCode'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "UnpublishLandingProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your profile (".$_POST['ProfileCode'].") has been unpublished form landing page"); 
             
           $mysql->execute("update `_tbl_landingpage_profiles` set  `IsShow`      		= '0',
															        `IsUnPublishOn`     = '".date("Y-m-d H:i:s")."',
																    `UnPublishRemarks`  = '".$_POST['UnpublishProfileRemarks']."'
																	where `ProfileCode`='".$_POST['ProfileCode']."'");

        return Response::returnSuccess("successfully Unpublished",array());

    }
	function PublishMemberLandingProfile() {

            global $mysql,$mail,$loginInfo;      
				
			$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}
			
			$data = $mysql->select("Select * from `_tbl_landingpage_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			$Profile = $mysql->select("Select * from `_tbl_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");   
			if($data[0]['IsShow']==1) {
				return Response::returnError("Profile Already Published");
			}
       
                 $member= $mysql->select("Select * from `_tbl_members` where `MemberCode`='".$Profile[0]['MemberCode']."'");   
                
               
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='PublishLandingProfile'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileCode#",$_POST['ProfileCode'],$content);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "PublishLandingProfile",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your profile (".$_POST['ProfileCode'].") has been published form landing page"); 
             
           $mysql->execute("update `_tbl_landingpage_profiles` set `IsShow`= '1' where `ProfileCode`='".$_POST['ProfileCode']."'");

        return Response::returnSuccess("successfully Unpublished",array());

    }
    function CreateOrderHeaderFooter(){
              global $mysql,$loginInfo;
              
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
              
            if (!(strlen(trim($_POST['OrderHeader']))>0)) {
                return Response::returnError("Please enter order header");
            }       
            
            if (!(strlen(trim($_POST['OrderFooter']))>0)) {
                return Response::returnError("Please enter order footer");
            }    
             $id =  $mysql->insert("_tbl_appmaster",array("FormType"            => "OrderForm",                    
                                                          "HeaderContent"       => $_POST['OrderHeader'], 
                                                          "FooterContent"       => $_POST['OrderFooter'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s"),
                                                          "CreatedByAdminID"    => $loginInfo[0]['AdminID']));

            if (sizeof($id)>0) {
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreateInvoiceHeaderFooter(){
              global $mysql,$loginInfo;
              
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
              
            if (!(strlen(trim($_POST['InvoiceHeader']))>0)) {
                return Response::returnError("Please enter invoice header");
            }       
            
            if (!(strlen(trim($_POST['InvoiceFooter']))>0)) {
                return Response::returnError("Please enter invoice footer");
            }    
             $id =  $mysql->insert("_tbl_appmaster",array("FormType"            => "InvoiceForm",                    
                                                          "HeaderContent"       => $_POST['InvoiceHeader'], 
                                                          "FooterContent"       => $_POST['InvoiceFooter'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s"),
                                                          "CreatedByAdminID"    => $loginInfo[0]['AdminID']));

            if (sizeof($id)>0) {
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreateReceiptHeaderFooter(){
              global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }  
            if (!(strlen(trim($_POST['ReceiptHeader']))>0)) {
                return Response::returnError("Please enter receipt header");
            }       
            
            if (!(strlen(trim($_POST['ReceiptFooter']))>0)) {
                return Response::returnError("Please enter receipt footer");
            }    
             $id =  $mysql->insert("_tbl_appmaster",array("FormType"            => "ReceiptForm",                    
                                                          "HeaderContent"       => $_POST['ReceiptHeader'], 
                                                          "FooterContent"       => $_POST['ReceiptFooter'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s"),
                                                          "CreatedByAdminID"    => $loginInfo[0]['AdminID']));

            if (sizeof($id)>0) {
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreateEmailHeaderFooter(){
              global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }  
            if (!(strlen(trim($_POST['EmailHeader']))>0)) {
                return Response::returnError("Please enter email header");
            }       
            
            if (!(strlen(trim($_POST['EmailFooter']))>0)) {
                return Response::returnError("Please enter email footer");
            }    
             $id =  $mysql->insert("_tbl_appmaster",array("FormType"            => "EmailForm",                    
                                                          "HeaderContent"       => $_POST['EmailHeader'], 
                                                          "FooterContent"       => $_POST['EmailFooter'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s"),
                                                          "CreatedByAdminID"    => $loginInfo[0]['AdminID']));

            if (sizeof($id)>0) {
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreateProfileDownloadHeaderFooter(){
              global $mysql,$loginInfo;
             $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }  
            if (!(strlen(trim($_POST['ProfileDownloadHeader']))>0)) {
                return Response::returnError("Please enter profile download header");
            }       
            
            if (!(strlen(trim($_POST['ProfileDownloadFooters']))>0)) {
                return Response::returnError("Please enter profile download footer");
            }    
             $id =  $mysql->insert("_tbl_appmaster",array("FormType"            => "ProfileDownloadForm",                    
                                                          "HeaderContent"       => $_POST['ProfileDownloadFooters'], 
                                                          "FooterContent"       => $_POST['ProfileDownloadFooters'],
                                                          "CreatedOn"           => date("Y-m-d H:i:s"),
                                                          "CreatedByAdminID"    => $loginInfo[0]['AdminID']));

            if (sizeof($id)>0) {
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreatePayu(){
        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			}  
		$data = $mysql->select("select * from  _tbl_pg_vendors where MarchantID='".trim($_POST['MarchantID'])."' and VendorTypeCode='VT0001'");
			if (sizeof($data)>0) {
				return Response::returnError("Marchant ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Secretky='".trim($_POST['PayuKey'])."' and VendorTypeCode='VT0001'");
			if (sizeof($data)>0) {
				return Response::returnError("Key Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where SaltID='".trim($_POST['SaltID'])."' and VendorTypeCode='VT0001'");
			if (sizeof($data)>0) {
				return Response::returnError("Salt ID Already Exists");
			}
				
			$PaymentGatewayVendorCode = SeqMaster::GetNextPaymentGatewayVendorCode();
               
             $id =  $mysql->insert("_tbl_pg_vendors",array("PaymentGatewayVendorCode"   => $PaymentGatewayVendorCode,                    
                                                           "VendorTypeCode"   			=> $_POST['PayuSoftCode'],                    
                                                           "VendorType"       			=> $_POST['PayuCodeValue'], 
                                                           "VenderName"       			=> $_POST['PayBi2Name'],
                                                           "VendorLogo"       			=> $_POST['File'],
                                                           "MarchantID"       			=> $_POST['MarchantID'],
                                                           "Secretky"         			=> $_POST['PayuKey'],
                                                           "SaltID"       	  			=> $_POST['SaltID'],
                                                           "VendorMode"       			=> $_POST['Mode'],
                                                           "VendorStatus"     			=> $_POST['Status'],
                                                           "SuccessUrl"       			=> $_POST['SuccessUrl'],
                                                           "FailureUrl"       			=> $_POST['FailureUrl'],
                                                           "Remarks"          			=> $_POST['PayuRemarks'],
                                                           "CreatedOn"        			=> date("Y-m-d H:i:s")));
			
            if (sizeof($id)>0) {
					$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='PaymentGatewayVendorCode'");  
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
    function CreatePaytm(){
        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			} 
		$data = $mysql->select("select * from  _tbl_pg_vendors where VenderName='".trim($_POST['Name'])."' and VendorTypeCode='VT0004'");
			if (sizeof($data)>0) {
				return Response::returnError("Name Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where MarchantID='".trim($_POST['MarchantID'])."' and VendorTypeCode='VT0004'");
			if (sizeof($data)>0) {
				return Response::returnError("Marchant ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Secretky='".trim($_POST['SecretKey'])."' and VendorTypeCode='VT0004'");
			if (sizeof($data)>0) {
				return Response::returnError("Secret Key Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Identity='".trim($_POST['Identity'])."' and VendorTypeCode='VT0004'");
			if (sizeof($data)>0) {
				return Response::returnError("Identity Already Exists");
			}		
			$PaymentGatewayVendorCode = SeqMaster::GetNextPaymentGatewayVendorCode();
               
             $id =  $mysql->insert("_tbl_pg_vendors",array("PaymentGatewayVendorCode"   => $PaymentGatewayVendorCode,                    
                                                           "VendorTypeCode"   			=> $_POST['PaytmSoftCode'],                    
                                                           "VendorType"       			=> $_POST['PaytmCodeValue'], 
                                                           "VenderName"       			=> $_POST['Name'],
                                                           "VendorLogo"       			=> $_POST['PaytmLogo'],
                                                           "MarchantID"       			=> $_POST['MarchantID'],
                                                           "WebsiteName"       			=> $_POST['Website'],
                                                           "Identity"       			=> $_POST['Identity'],
                                                           "Channel"       			    => $_POST['Channel'],
                                                           "Secretky"         			=> $_POST['SecretKey'],
                                                           "VendorMode"       			=> $_POST['Mode'],
                                                           "VendorStatus"     			=> $_POST['Status'],
                                                           "SuccessUrl"       			=> $_POST['SuccessUrl'],
                                                           "FailureUrl"       			=> $_POST['FailureUrl'],
                                                           "Remarks"          			=> $_POST['PaytmRemarks'],
                                                           "CreatedOn"        			=> date("Y-m-d H:i:s")));
			
            if (sizeof($id)>0) {
					$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='PaymentGatewayVendorCode'");  
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
	function CreateCcavenue(){
        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			} 
		$data = $mysql->select("select * from  _tbl_pg_vendors where VenderName='".trim($_POST['Name'])."' and VendorTypeCode='VT0003'");
			if (sizeof($data)>0) {
				return Response::returnError("Name Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where MarchantID='".trim($_POST['MarchantID'])."' and VendorTypeCode='VT0003'");
			if (sizeof($data)>0) {
				return Response::returnError("Marchant ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Secretky='".trim($_POST['SecretKey'])."' and VendorTypeCode='VT0003'");
			if (sizeof($data)>0) {
				return Response::returnError("Secret Key Already Exists");
			}
		$PaymentGatewayVendorCode = SeqMaster::GetNextPaymentGatewayVendorCode();
               
             $id =  $mysql->insert("_tbl_pg_vendors",array("PaymentGatewayVendorCode"   => $PaymentGatewayVendorCode,                    
                                                           "VendorTypeCode"   			=> $_POST['CcavenueSoftCode'],                    
                                                           "VendorType"       			=> $_POST['CcavenueCodeValue'], 
                                                           "VenderName"       			=> $_POST['Name'],
                                                           "VendorLogo"       			=> $_POST['CCavenueLogo'],
                                                           "MarchantID"       			=> $_POST['MarchantID'],
                                                           "Secretky"         			=> $_POST['SecretKey'],
                                                           "VendorMode"       			=> $_POST['Mode'],
                                                           "VendorStatus"     			=> $_POST['Status'],
                                                           "SuccessUrl"       			=> $_POST['SuccessUrl'],
                                                           "FailureUrl"       			=> $_POST['FailureUrl'],
                                                           "Remarks"          			=> $_POST['CCAvenueRemarks'],
                                                           "CreatedOn"        			=> date("Y-m-d H:i:s")));
			
            if (sizeof($id)>0) {
					$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='PaymentGatewayVendorCode'");  
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }
	function CreateInstamajo(){
        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			} 
		$data = $mysql->select("select * from  _tbl_pg_vendors where VenderName='".trim($_POST['InstamajoName'])."' and VendorTypeCode='VT0002'");
			if (sizeof($data)>0) {
				return Response::returnError("Name Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where ClientID='".trim($_POST['ClientID'])."' and VendorTypeCode='VT0002'");
			if (sizeof($data)>0) {
				return Response::returnError("Client ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Secretky='".trim($_POST['SecretKey'])."' and VendorTypeCode='VT0002'");
			if (sizeof($data)>0) {
				return Response::returnError("Secret Key Already Exists");
			}
		$PaymentGatewayVendorCode = SeqMaster::GetNextPaymentGatewayVendorCode();
               
             $id =  $mysql->insert("_tbl_pg_vendors",array("PaymentGatewayVendorCode"   => $PaymentGatewayVendorCode,                    
                                                           "VendorTypeCode"   			=> $_POST['InstamajoSoftCode'],                    
                                                           "VendorType"       			=> $_POST['InstamajoCodeValue'], 
                                                           "VenderName"       			=> $_POST['InstamajoName'],
                                                           "VendorLogo"       			=> $_POST['InstamajoLogo'],
                                                           "ActionUrl"       			=> $_POST['ActionUrl'],
                                                           "ClientID"         			=> $_POST['ClientID'],
                                                           "Secretky"         			=> $_POST['SecretKey'],
                                                           "VendorMode"       			=> $_POST['Mode'],
                                                           "VendorStatus"     			=> $_POST['Status'],
                                                           "SuccessUrl"       			=> $_POST['SuccessUrl'],
                                                           "FailureUrl"       			=> $_POST['FailureUrl'],
                                                           "Remarks"          			=> $_POST['InstaRemarks'],
                                                           "CreatedOn"        			=> date("Y-m-d H:i:s")));
			
            if (sizeof($id)>0) {
					$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='PaymentGatewayVendorCode'");  
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }	
	function GetPaymentGatewayDatas(){
	global $mysql;
		return Response::returnSuccess("success",array("Currency"  => CodeMaster::getData('PAYPALCURRENCY')));
	}
	function CreatePaypal(){
        global $mysql,$loginInfo;
		
		$txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
			if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
				return Response::returnError("Invalid transaction password");   
			} 
		$data = $mysql->select("select * from  _tbl_pg_vendors where VenderName='".trim($_POST['PaypalName'])."' and VendorTypeCode='VT0005'");
			if (sizeof($data)>0) {
				return Response::returnError("Name Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where EmailID='".trim($_POST['PaypalEmailID'])."' and VendorTypeCode='VT0005'");
			if (sizeof($data)>0) {
				return Response::returnError("Email ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where MarchantID='".trim($_POST['MarchantID'])."' and VendorTypeCode='VT0005'");
			if (sizeof($data)>0) {
				return Response::returnError("Marchant ID Already Exists");
			}
		$data = $mysql->select("select * from  _tbl_pg_vendors where Secretky='".trim($_POST['SecretKey'])."' and VendorTypeCode='VT0005'");
			if (sizeof($data)>0) {
				return Response::returnError("Secret Key Already Exists");
			}
		$PaymentGatewayVendorCode = SeqMaster::GetNextPaymentGatewayVendorCode();
            $Currency = CodeMaster::getData("PAYPALCURRENCY",$_POST['Currency']);  
             $id =  $mysql->insert("_tbl_pg_vendors",array("PaymentGatewayVendorCode"   => $PaymentGatewayVendorCode,                    
                                                           "VendorTypeCode"   			=> $_POST['PaypalSoftCode'],                    
                                                           "VendorType"       			=> $_POST['PaypalCodeValue'], 
                                                           "VenderName"       			=> $_POST['PaypalName'],
                                                           "EmailID"         	        => $_POST['PaypalEmailID'],
                                                           "MarchantID"         	    => $_POST['MarchantID'],
                                                           "Secretky"         			=> $_POST['SecretKey'],
                                                           "PaypalCurrencyCode"     	=> $Currency[0]['SoftCode'],
                                                           "PaypalCurrency"     	    => $Currency[0]['CodeValue'],
                                                           "VendorStatus"     			=> $_POST['Status'],
                                                           "SuccessUrl"       			=> $_POST['SuccessUrl'],
                                                           "FailureUrl"       			=> $_POST['FailureUrl'],
                                                           "Remarks"          			=> $_POST['Remarks'],
                                                           "CreatedOn"        			=> date("Y-m-d H:i:s")));
			
            if (sizeof($id)>0) {
					$mysql->execute("update _tbl_sequence set LastNumber=LastNumber+1 where SequenceFor='PaymentGatewayVendorCode'");  
                 return Response::returnSuccess("success");
                } else{
                    return Response::returnError("Access denied. Please contact support");   
                }
    }	
	function GetHeaderandFooterInfo() {
           global $mysql;    
             $sql = "select * from  _tbl_appmaster";
			 
             if (isset($_POST['Request']) && $_POST['Request']=="Order") {
                return Response::returnSuccess("success",$mysql->select($sql." where FormType='OrderForm' Order by FormTemplateID DESC"));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Invoice") {
                return Response::returnSuccess("success",$mysql->select($sql." where FormType='InvoiceForm' Order by FormTemplateID DESC"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Receipt") {
                return Response::returnSuccess("success",$mysql->select($sql." where FormType='ReceiptForm' Order by FormTemplateID DESC"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Email") {
                return Response::returnSuccess("success",$mysql->select($sql." where FormType='EmailForm' Order by FormTemplateID DESC"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="ProfileDownload") {
                return Response::returnSuccess("success",$mysql->select($sql." where FormType='ProfileDownloadForm' Order by FormTemplateID DESC"));    
             }
         }
	function GetPaymentGatewayMenu() {
        return Response::returnSuccess("success",array("VendorType" => CodeMaster::getData('VENDORTYPE')));
    }
	function GetManagePaymentGateway() {
           global $mysql;    
             $sql = "select * from  _tbl_pg_vendors";
             if (isset($_POST['Request']) && $_POST['Request']=="Payu") {
                return Response::returnSuccess("success",$mysql->select($sql." where VendorType='Payu'"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Instamajo") {
                return Response::returnSuccess("success",$mysql->select($sql." where VendorType='instamajo'"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="CCavenue") {
                return Response::returnSuccess("success",$mysql->select($sql." where VendorType='ccavenue'"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Paytm") {
                return Response::returnSuccess("success",$mysql->select($sql." where VendorType='paytm'"));    
             }
			 if (isset($_POST['Request']) && $_POST['Request']=="Paypal") {
                return Response::returnSuccess("success",$mysql->select($sql." where VendorType='Paypal'"));    
             }                                                                                                                                                                            
             
         }
    function DeactiveMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid staff information"); 
            }
        if($Member[0]['IsActive']==0){
            return Response::returnError("Member already deactivated"); 
        }
        $mysql->execute("update _tbl_members set IsActive='0',DeactivatedOn='".date("Y-m-d H:i:s")."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$_POST['MemberCode']."'");
                    
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeactivateMember'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "DeactivateMember",
                                                "MemberCode"     => $Member[0]['MemberCode'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your member account has been deactivated.");  
       return Response::returnSuccess("Deactivated Successfully",array());
    } 
    function ActiveMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsActive']==1){
            return Response::returnError("Member already activated"); 
        }
        $mysql->execute("update _tbl_members set IsActive='1' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$_POST['MemberCode']."'");
                    
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='ActivateMember'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "ActivateMember",
                                                "MemberCode"     => $Member[0]['MemberCode'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your member account has been activated.");  
       return Response::returnSuccess("Activated Successfully",array());
    }
    function DeleteMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsDeleted']==1){
            return Response::returnError("Member already deleted"); 
        }
        $mysql->execute("update _tbl_members set IsDeleted='1',DeletedOn='".date("Y-m-d H:i:s")."',DeletedRemarks='".$_POST['DeletedRemarks']."' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$_POST['MemberCode']."'");
                    
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteMember'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "DeleteMember",
                                                "MemberCode"     => $Member[0]['MemberCode'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your member account has been deleted.");  
       return Response::returnSuccess("Deleted Successfully",array());
    }
    function RestoreMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsDeleted']==0){
            return Response::returnError("Member already restore"); 
        }
        $mysql->execute("update _tbl_members set IsDeleted='0',DeletedRemarks='' where `MemberID`='".$Member[0]['MemberID']."' and MemberCode='".$_POST['MemberCode']."'");
                    
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='RestoreMember'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "RestoreMember",
                                                "MemberCode"     => $Member[0]['MemberCode'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your member account has been restored.");  
       return Response::returnSuccess("Restored Successfully",array());
    }
    function ResetMemberPassword(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        /*if($Member[0]['IsDeleted']==0){
            return Response::returnError("Member already restore"); 
        }     */
        $ResetPasswordlink = md5(time().$Member[0]['MemberCode'].$Member[0]['MobileNumber'].$Member[0]['EmailID']);
        $Link = DomainPath."ResetPassword?link=".$ResetPasswordlink;
        $date = date_create(date("Y-m-d"));                    
                $e = "3 days";                
                date_add($date,date_interval_create_from_date_string($e));
                $endingdate= date("Y-m-d",strtotime(date_format($date,"Y-m-d")));
                $endingdate= date_format($date,"Y-m-d");
         $mysql->insert("_tbl_member_reset_password",array("MemberID"       => $Member[0]['MemberID'],
                                                           "MemberCode"     => $Member[0]['MemberCode'], 
                                                           "ResetBy"        => "Admin", 
                                                           "ResetByID"      => $loginInfo[0]['AdminID'], 
                                                           "ResetByName"    => $txnPwd[0]['AdminName'], 
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
                  //   MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Use below link for reset your password."); 
       return Response::returnSuccess("Reset Password Successfully",array());
    }
    function SendIndividualSmsToMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsDeleted']==1){
            return Response::returnError("Member already deleted"); 
        }
        
       $txnID = MobileSMSController::sendSMS($Member[0]['MobileNumber']," ".$_POST['SmsMessage']."");
      
        $mysql->insert("_tbl_send_individual_message",array("MessageFrom"          => "Admin",
                                                            "MessageFromID"        => $loginInfo[0]['AdminID'],
                                                            "MessageFromCode"      => $txnPwd[0]['AdminCode'],
                                                            "MessageToMemberID"    => $Member[0]['MemberID'],
                                                            "MessageToMemberCode"  => $Member[0]['MemberCode'],
                                                            "SMSMessage"           => $_POST['SmsMessage'],
                                                            "IsSms"                => "1",
                                                            "TxnID"                => $txnID,
                                                            "SentOn"               => date("Y-m-d H:i:s")));  
          
       return Response::returnSuccess("Message Sent",array());
    }
    function SendIndividualEmailToMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsDeleted']==1){
            return Response::returnError("Member already deleted"); 
        }
        
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "SendIndividualEmailToMember",
                                                "MemberID"     => $Member[0]['MemberID'],
                                                "Subject"        =>  $_POST['EmailSubjectMessage'],
                                                "Message"        =>  $_POST['EmailContentMessage']),$txnID);  
                    $mysql->insert("_tbl_send_individual_message",array("MessageFrom"          => "Admin",
                                                                        "MessageFromID"        => $loginInfo[0]['AdminID'],
                                                                        "MessageFromCode"      => $txnPwd[0]['AdminCode'],
                                                                        "MessageToMemberID"    => $Member[0]['MemberID'],
                                                                        "MessageToMemberCode"  => $Member[0]['MemberCode'],
                                                                        "EmailSubject"           => $_POST['EmailSubjectMessage'],
                                                                        "EmailContent"           => $_POST['EmailContentMessage'],
                                                                        "IsEmail"                => "1",
                                                                        "TxnID"                => $txnID,
                                                                        "SentOn"               => date("Y-m-d H:i:s"))); 
       return Response::returnSuccess("Email Sent",array());
    }
    function SetIndividualPopupToMember(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $Member = $mysql->select("select * from `_tbl_members` where MemberCode='".$_POST['MemberCode']."'");
            if(!(sizeof($Member)==1)){
                return Response::returnError("Invalid member information"); 
            }
        if($Member[0]['IsDeleted']==1){
            return Response::returnError("Member already deleted"); 
        }
          $mysql->insert("_tbl_board",array("BoardFrom"       => "Admin",
                                            "FromID"          => $loginInfo[0]['AdminID'],
                                            "FromCode"        => $txnPwd[0]['AdminCode'],
                                            "ToMemberID"      => $Member[0]['MemberID'],
                                            "ToMemberCode"    => $Member[0]['MemberCode'],
                                            "MessageSubject"  => $_POST['PopupSubjectMessage'],
                                            "MessageContent"  => $_POST['PopupContentMessage'],
                                            "CreatedOn"       => date("Y-m-d H:i:s")));
       return Response::returnSuccess("Success",array());
    }
    function ChangeMemberMobileNumber(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
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
                                                               "ResetBy"        => "Admin", 
                                                               "ResetByID"      => $loginInfo[0]['AdminID'], 
                                                               "ResetByName"    => $txnPwd[0]['AdminName'], 
                                                               "SmsTo"          => $Member[0]['MobileNumber'], 
                                                               "EmailTo"        => $Member[0]['EmailID'], 
                                                               "ResetLink"      => $ResetMobileNumberlink, 
                                                               "CreatedOn"      => date("Y-m-d H:i:s"),  
                                                               "ExpiredOn"      => $endingdate));  
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangeMobileNumberFromAdmin'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#Link#",$Link,$content);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberChangeMobileNumber",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
        
       return Response::returnSuccess("Change Mobile Number Successfully",array());
    }
    function ChangeMemberEmailID(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
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
                                                               "ResetBy"        => "Admin", 
                                                               "ResetByID"      => $loginInfo[0]['AdminID'], 
                                                               "ResetByName"    => $txnPwd[0]['AdminName'], 
                                                               "SmsTo"          => $Member[0]['MobileNumber'], 
                                                               "EmailTo"        => $Member[0]['EmailID'], 
                                                               "ResetLink"      => $ResetEmailIDlink, 
                                                               "CreatedOn"      => date("Y-m-d H:i:s"),  
                                                               "ExpiredOn"      => $endingdate));  
                    $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberChangeEmailIDFromAdmin'");
                    $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
                    $content  = str_replace("#Link#",$Link,$content);
                    
                     MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                                "Category"       => "MemberChangeEmailIDFromAdmin",
                                                "MemberID"      => $Member[0]['MemberID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                                                                                                                     
       return Response::returnSuccess("Change EmailID Successfully",array());
    }
    function DATOnObservationModefrSumbitedProfile(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
         
         $data = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['Code']."'");
        
        $mysql->execute("update `_tbl_draft_profiles` set  `IsObservation`      = '1',
                                                         `ObservationOn`      = '".date("Y-m-d H:i:s")."'
                                                         where `ProfileCode`='".$_POST['Code']."'"); 
        $mysql->insert("_tbl_profiles_activity",array("MemberID"              => $_POST['MemberID'],
                                                      "MemberCode"            => $_POST['MemberCode'],
                                                      "DraftProfileID"        => $data[0]['ProfileID'],
                                                      "DraftProfileCode"      => $data[0]['ProfileCode'],
                                                      "Activity"              => "Active Observation Mode by DAT",
                                                      "ActivityOn"            => date("Y-m-d H:i:s"),
                                                      "ActivityDoneBy"        => "Admin",
                                                      "ActivityDoneByID"      => $loginInfo[0]['AdminID'],
                                                      "ActivityDoneByCode"    => $txnPwd[0]['AdminCode'],
                                                      "Remarks"               => "" ));
                    
       return Response::returnSuccess("Success",array());
    }
    
    function GetConfigurationSettingsList() {
        global $mysql,$loginInfo;
        
        $Config = $mysql->select("select * from  _tbl_master_codemaster where HardCode='APPSETTINGS' and ParamE='1' ");
        $result = array();
        foreach($Config as $c) {
            
            if(strlen(trim($c['ParamC']))>0) {
                  $mstr_data = $mysql->select("select * from _tbl_master_codemaster where HardCode='".$c['ParamC']."' order by CodeValue");
                  $c['ParamC']=$mstr_data;
            }
            
            $result[]=$c;
        }                                 
        
        return Response::returnSuccess("Success",$result);
    }
    function GetWebConfigurationSettingsList() {
        global $mysql,$loginInfo;
        
        $Config = $mysql->select("select * from  _tbl_master_codemaster where HardCode='WEBSETTINGS' and ParamE='1' ");
        $result = array();
        foreach($Config as $c) {
            
            if(strlen(trim($c['ParamC']))>0) {
                  $mstr_data = $mysql->select("select * from _tbl_master_codemaster where HardCode='".$c['ParamC']."' order by CodeValue");
                  $c['ParamC']=$mstr_data;
            }
            
            $result[]=$c;
        }                                 
        
        return Response::returnSuccess("Success",$result);
    }
    function GetBusinessSettingsList() {
        global $mysql,$loginInfo;
        
        $Config = $mysql->select("select * from  _tbl_master_codemaster where HardCode='BUSINESSSETTINGS' and ParamE='1' ");
        $result = array();
        foreach($Config as $c) {
            
            if(strlen(trim($c['ParamC']))>0) {
                  $mstr_data = $mysql->select("select * from _tbl_master_codemaster where HardCode='".$c['ParamC']."' order by CodeValue");
                  $c['ParamC']=$mstr_data;
            }
            
            $result[]=$c;
        }                                 
        
        return Response::returnSuccess("Success",$result);
    }
    function GetManageSequenceMaster() {
           global $mysql;    
             $sql = "SELECT * FROM _tbl_sequence";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                return Response::returnSuccess("success",$mysql->select($sql." where IsActive='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                return Response::returnSuccess("success",$mysql->select($sql."  where IsActive='0'"));    
             }
         }  
    function GetSequenceMasterViewInfo() {
        global $mysql;
        $Sequence = $mysql->select("Select * from _tbl_sequence where SequenceID='".$_POST['Code']."'");
        return Response::returnSuccess("Success",array("Sequence" => $Sequence[0]));
    }
    function CreateSequence() {
            global $mysql,$loginInfo;
           
            if (!(strlen(trim($_POST['SequenceFor']))>0)) {
                return Response::returnError("Please enter sequence for");
            }
            if (!(strlen(trim($_POST['Prefix']))>0)) {
                return Response::returnError("Please enter prefix");
            }
            if (!(strlen(trim($_POST['StringLength']))>0)) {
                return Response::returnError("Please enter string length");
            }
            if (!(strlen(trim($_POST['LastNumber']))>0)) {
                return Response::returnError("Please enter last number");
            }
            
            $data = $mysql->select("select * from  _tbl_sequence where SequenceFor='".trim($_POST['SequenceFor'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Sequence for Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_sequence where Prefix='".trim($_POST['Prefix'])."'");
            if (sizeof($data)>0) {
                return Response::returnError("Prefix for Already Exists");
            }
            
            $mysql->insert("_tbl_sequence",array("SequenceFor"  => $_POST['SequenceFor'],
                                                 "Prefix"       => $_POST['Prefix'],
                                                 "StringLength" => $_POST['StringLength'],
                                                 "LastNumber"   => $_POST['LastNumber']));
                                                 
            return Response::returnSuccess("success");
        }
        function EditSequence() {
            global $mysql,$loginInfo;
           
            if (!(strlen(trim($_POST['SequenceFor']))>0)) {
                return Response::returnError("Please enter sequence for");
            }
            if (!(strlen(trim($_POST['Prefix']))>0)) {
                return Response::returnError("Please enter prefix");
            }
            if (!(strlen(trim($_POST['StringLength']))>0)) {
                return Response::returnError("Please enter string length");
            }
            if (!(strlen(trim($_POST['LastNumber']))>0)) {
                return Response::returnError("Please enter last number");
            }
            
            $data = $mysql->select("select * from  _tbl_sequence where SequenceFor='".trim($_POST['SequenceFor'])."' and SequenceID<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Sequence for Already Exists");
            }
            $data = $mysql->select("select * from  _tbl_sequence where Prefix='".trim($_POST['Prefix'])."' and SequenceID<>'".$_POST['Code']."'");
            if (sizeof($data)>0) {
                return Response::returnError("Prefix for Already Exists");
            }
            
            $mysql->execute("update `_tbl_sequence` set  `SequenceFor`      = '".$_POST['SequenceFor']."',
                                                         `Prefix`           = '".$_POST['Prefix']."',
                                                         `StringLength`     = '".$_POST['StringLength']."',
                                                         `LastNumber`       = '".$_POST['LastNumber']."'
                                                         where `SequenceID` ='".$_POST['Code']."'"); 
            return Response::returnSuccess("success");
        }
        function GetIndividualMessagesList() {
           global $mysql;    
             $sql = "select * from _tbl_send_individual_message where MessageToMemberCode='".$_POST['Code']."'";
             if (isset($_POST['Request']) && $_POST['Request']=="SMS") {
                return Response::returnSuccess("success",$mysql->select($sql." and IsSMS='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Email") {
                return Response::returnSuccess("success",$mysql->select($sql." and IsEmail='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Messages") {
                return Response::returnSuccess("success",$mysql->select("select * From `_tbl_board` where ToMemberCode='".$_POST['Code']."'"));    
             }                                                                                                                                                                             
         }
         function GetManageRequests() {
           
             global $mysql,$loginInfo;
             
              $sql = "select * from _tbl_service_requests";

              if (isset($_POST['Request']) && $_POST['Request']=="Open") {
                 return Response::returnSuccess("success",$mysql->select($sql." where Status='1'"));    
             }
              if (isset($_POST['Request']) && $_POST['Request']=="InProccess") {
                 return Response::returnSuccess("success",$mysql->select($sql." where Status='2'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Closed") {
                 return Response::returnSuccess("success",$mysql->select($sql." where Status='3'"));    
             }
             
         }
         function GetManageRequestsFromMember() {
           
             global $mysql,$loginInfo;
             
              $sql = "select * from _tbl_service_requests where RequestBy='Member'";

              if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." and IsDeactive='2'"));    
             }
              if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." and IsDeactive='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Delete") {
                 return Response::returnSuccess("success",$mysql->select($sql." and IsDelete='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Restore") {
                 return Response::returnSuccess("success",$mysql->select($sql." and IsDelete='2'"));    
             }
         }
         function ViewMemberRequest(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberRequest/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         function ViewDeactiveMemberRequestFrMember(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberDeactiveRequestFrMember/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         function ViewActiveMemberRequest(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberActiveRequest/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         function ViewActiveMemberRequestFrMember(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberActiveRequestFrMember/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         function ViewRestoreMemberRequest(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberRestoreRequest/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         function ViewRestoreMemberRequestFrMember(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberRestoreRequestFrMember/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
         
         function MemberRequestFromFranchiseeInfo() {        
           global $mysql;    
            $Request = $mysql->select("select * from _tbl_service_requests where ReqCode='".$_POST['Code']."'");
            $Members = $mysql->select("select * from _tbl_members where MemberCode='".$Request[0]['MemberCode']."'");
            $Franchisees = $mysql->select("select * from _tbl_franchisees_staffs where FranchiseeID='".$Request[0]['RequestByID']."'");
            return Response::returnSuccess("success",array("Request"    => $Request[0],
                                                            "Member"    => $Members[0],
                                                            "Franchisee"    => $Franchisees[0]));
    }
    function MemberRequestAddToInProccessMode(){
        global $mysql,$loginInfo;
        $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
        /*    if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }     */
         
         $data = $mysql->select("select * from `_tbl_service_requests` where `ReqCode`='".$_POST['Code']."'");
         $Member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");
        
        $mysql->execute("update `_tbl_service_requests` set  `Status`           = '2',
                                                            `ProccessedOn`      = '".date("Y-m-d H:i:s")."',
                                                            `ProccessedByID`    ='".$loginInfo[0]['AdminID']."',
                                                            `ProcessedByCode`  ='".$txnPwd[0]['AdminCode']."'
                                                            where `ReqCode`='".$_POST['Code']."'"); 
       
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberRequestAddInProccess'");
        $content  = str_replace("#MemberName#",$Member[0]['MemberName'],$mContent[0]['Content']);
        $content  = str_replace("#ServiceRequestCode#",$_POST['Code'],$content);

         MailController::Send(array("MailTo"         => $Member[0]['EmailID'],
                                    "Category"       => "MemberRequestAddInProccess",       
                                    "MemberID"       => $Member[0]['MemberID'],
                                    "Subject"        => $mContent[0]['Title'],
                                    "Message"        => $content),$mailError);
         //MobileSMSController::sendSMS($Member[0]['MobileNumber']," Dear ".$Member[0]['MemberName'].",Your request (".$ReqCode.") active in proccess mode.");  
                                                               
        $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $Member[0]['MemberID'],
                                                         "ActivityType"   => 'MemberRequestAddInProccess.',
                                                         "ActivityString" => 'Member Request Add InProccess.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));            
       return Response::returnSuccess("Success",array());
    }
    function AproveMemberDeactiveReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already approved");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsActive='0',DeactiveRequest='0',DeactivatedOn='".date("Y-m-d H:i:s")."' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='1',
                                                                 Remarks='".$_POST['ApproveReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeactivateMember'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "DeactivateMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account has been deactivated"); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account deactive request has been approved",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
           
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'ApproveMemberDeactiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Approve Member Deactive Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
    
            return Response::returnSuccess("successfully Approved",array());
            

    }
    function RejectMemberDeactiveReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already Proccesed");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsActive='1',DeactiveRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='2',
                                                                 Remarks='".$_POST['RejectReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminRejectedMemberDeactiveRequestFromFranchisee'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#FrCode#",$data[0]['RequestByCode'],$content);
            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AdminRejectedMemberDeactiveRequestFromFranchisee",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account deactivate request from franchisee(".$data[0]['RequestByCode'].") has been rejected."); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account deactive request has been rejected",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
                $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'RejectMemberDeactiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Reject Member Deactive Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
           
            return Response::returnSuccess("successfully Rejected",array());
    }
    function AproveMemberActiveReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already approved");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsActive='1',DeactiveRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='1',
                                                                 Remarks='".$_POST['ApproveReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='ActivateMember'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ActivateMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account has been activated"); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account active request has been approved",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
           
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'ApproveMemberActiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Approve Member Active Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
    
            return Response::returnSuccess("successfully Approved",array());
            

    }
    
    function RejectMemberActiveReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already Proccesed");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set DeactiveRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='2',
                                                                 Remarks='".$_POST['RejectReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminRejectedMemberActiveRequestFromFranchisee'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#FrCode#",$data[0]['RequestByCode'],$content);
            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AdminRejectedMemberActiveRequestFromFranchisee",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account active request from franchisee(".$data[0]['RequestByCode'].") has been rejected."); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account active request has been rejected",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
                $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'RejectMemberActiveRequestFromFranchisee.',
                                                         "ActivityString" => 'Reject Member Active Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
           
            return Response::returnSuccess("successfully Rejected",array());
    }
    function ViewDeleteMemberRequest(){
              global $mysql,$loginInfo;    
               $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
               if(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword']))  {
                     echo "<script>location.href='".AppPath."Members/ViewMemberDeleteRequest/".$_POST['ReqID'].".html'</script>";
                
                } else {
                    return Response::returnError("Invalid transaction password");
                }
         }
    function AproveMemberDeleteReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already approved");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsDeleted='1',DeletedOn='".date("Y-m-d H:i:s")."',DeletedRemarks='".$_POST['ApproveReason']."',DeleteRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='1',
                                                                 Remarks='".$_POST['ApproveReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteMember'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "DeleteMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account has been deleted"); 
            
            $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account delete request has been approved",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
           
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'ApproveMemberDeleteRequestFromFranchisee.',
                                                         "ActivityString" => 'Approve Member Delete Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
            
            return Response::returnSuccess("successfully Approved",array());
    }
    function RejectMemberDeleteReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already Proccesed");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsDeleted='0',DeleteRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='2',
                                                                 Remarks='".$_POST['RejectReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminRejectedMemberDeleteRequestFromFranchisee'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#FrCode#",$data[0]['RequestByCode'],$content);
            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AdminRejectedMemberDeleteRequestFromFranchisee",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account delete request from franchisee(".$data[0]['RequestByCode'].") has been rejected."); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account delete request has been rejected",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
                $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'RejectMemberDeleteRequestFromFranchisee.',
                                                         "ActivityString" => 'Reject Member Delete Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
           
            return Response::returnSuccess("successfully Rejected",array());
    }
    function AproveMemberRestoreReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already approved");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsDeleted='0',DeleteRequest='0' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='1',
                                                                 Remarks='".$_POST['ApproveReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='RestoreMember'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "RestoreMember",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account has been restore"); 
            
            $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account restore request has been approved",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
           
           $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'ApproveMemberRestoreRequestFromFranchisee.',
                                                         "ActivityString" => 'Approve Member Restore Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
            
            return Response::returnSuccess("successfully Approved",array());
    }
    function RejectMemberRestoreReq() {

            global $mysql,$mail,$loginInfo; 
                
            $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
            
            $data = $mysql->select("Select * from `_tbl_service_requests` where `ReqID`='".$_POST['ReqID']."'");   
            
            if($data[0]['IsVerified']==1) {
                return Response::returnError("Request already Proccesed");
            }
            
            $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
            
            $mysql->execute("update _tbl_members set IsDeleted='1',DeleteRequest='0',DeletedOn='".date("Y-m-d H:i:s")."',DeletedRemarks='".$_POST['RejectReason']."' where MemberCode='".$member[0]['MemberCode']."'");
            
            $mysql->execute("update _tbl_service_requests set IsVerified='2',
                                                                 Remarks='".$_POST['RejectReason']."',
                                                                 VerifiedOn='".date("Y-m-d H:i:s")."',
                                                                 IsVerifiedByID='".$txnPwd[0]['AdminID']."', 
                                                                 IsVerifiedByCode='".$txnPwd[0]['AdminCode']."' 
                                                                 where  ReqID='".$data[0]['ReqID']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='AdminRejectedMemberRestoreRequestFromFranchisee'");
            $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
            $content  = str_replace("#FrCode#",$data[0]['RequestByCode'],$content);
            MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AdminRejectedMemberRestoreRequestFromFranchisee",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
            MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your account restore request from franchisee(".$data[0]['RequestByCode'].") has been rejected."); 
            
                $mysql->insert("_tbl_franchisee_req_verification",array("ToFranchiseeID"    => $data[0]['RequestByID'],
                                                                        "ToFranchiseeCode"  => $data[0]['RequestByCode'],
                                                                        "Message"           => "Member (".$member[0]['MemberCode'].") account restore request has been rejected",
                                                                        "VerifiedOn"        => date("Y-m-d H:i:s"),
                                                                        "VerifiedByID"      => $txnPwd[0]['AdminID'],
                                                                        "VerifiedByCode"    => $txnPwd[0]['AdminCode']));
                $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $member[0]['MemberID'],
                                                         "ActivityType"   => 'RejectMemberRestoreRequestFromFranchisee.',
                                                         "ActivityString" => 'Reject Member Restore Request From Franchisee.',
                                                         "SqlQuery"       => base64_encode($sqlQry),
                                                         "ActivityDoneBy" => 'A',
                                                         "ActivityDoneByCode" =>$txnPwd[0]['AdminCode'],
                                                         "ActivityDoneByName" =>$txnPwd[0]['AdminName'],
                                                         "ActivityOn"     => date("Y-m-d H:i:s")));
           
            return Response::returnSuccess("successfully Rejected",array());
    }
    function DeactiveSupportDeskUser(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==0){
            return Response::returnError("User already deactivated"); 
        }
        $mysql->execute("update _tbl_support_desk_user set IsActive='0' where `UserID`='".$User[0]['UserID']."' and UserCode='".$_POST['UserCode']."'");
        
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeactivateSupportDeskUser'");
            $content  = str_replace("#UserName#",$User[0]['UserName'],$mContent[0]['Content']);
            
             MailController::Send(array("MailTo"         => $User[0]['EmailID'],
                                        "Category"       => "DeactivateSupportDeskUser",
                                        "SDUserID"       => $User[0]['UserID'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($User[0]['MobileNumber']," Dear ".$User[0]['Username'].",Your user account has been deactivated.");  
        
        return Response::returnSuccess("Deactivated Successfully",array());
    }
    function ActiveSupportDeskUser(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==1){
            return Response::returnError("User already activated"); 
        }
        $mysql->execute("update _tbl_support_desk_user set IsActive='1' where `UserID`='".$User[0]['UserID']."' and UserCode='".$_POST['UserCode']."'");
        
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='ActivateSupportDeskUser'");
            $content  = str_replace("#UserName#",$User[0]['UserName'],$mContent[0]['Content']);
            
             MailController::Send(array("MailTo"         => $User[0]['EmailID'],
                                        "Category"       => "ActivateSupportDeskUser",
                                        "SDUserID"       => $User[0]['UserID'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($User[0]['MobileNumber']," Dear ".$User[0]['Username'].",Your user account has been activated.");  
        
        return Response::returnSuccess("Activated Successfully",array());
    }
   function SupportDeskChnPswd() {
        global $mysql,$loginInfo;
          $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        if (isset($_POST['NewPswd'])) {
                if (strlen(trim($_POST['NewPswd']))<6) {
                   return Response::returnError("Please enter password more than 6 character "); 
                }
                if (strlen(trim($_POST['NewPswd']))!= strlen(trim($_POST['ConfirmNewPswd']))) {
                   return Response::returnError("Password do not match"); 
                }
               
               $mysql->execute("update _tbl_support_desk_user set UserPassword='".$_POST['NewPswd']."' where `UserID`='".$User[0]['UserID']."' and UserCode='".$_POST['UserCode']."'");
               
               $mContent = $mysql->select("select * from `mailcontent` where `Category`='SupportDeskUserChangePassword'");
                    $content  = str_replace("#UserName#",$User[0]['UserName'],$mContent[0]['Content']);
                    
                     MailController::Send(array("MailTo"         => $User[0]['EmailID'],
                                                "Category"       => "SupportDeskUserChangePassword",
                                                "SDUserID"       => $User[0]['UserID'],
                                                "Subject"        => $mContent[0]['Title'],
                                                "Message"        => $content),$mailError);
                     MobileSMSController::sendSMS($User[0]['MobileNumber']," Dear ".$User[0]['UserName'].",Your Login Password has been changed successfully. Your New Login Password is ".$_POST['ConfirmNewPswd']."");  
                
               return Response::returnSuccess("Success",array());  
            }
    }
    function ResetTxnPswdSupportDeskuser(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_support_desk_user set TransactionPassword='' where `UserID`='".$User[0]['UserID']."' and UserCode='".$_POST['UserCode']."'");
            $mContent = $mysql->select("select * from `mailcontent` where `Category`='SupportDeskUserResetTxnPassword'");
            $content  = str_replace("#UserName#",$User[0]['UserName'],$mContent[0]['Content']);
            
             MailController::Send(array("MailTo"         => $User[0]['EmailID'],
                                        "Category"       => "SupportDeskUserResetTxnPassword",
                                        "SDUserID"       => $User[0]['UserID'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($User[0]['MobileNumber']," Dear ".$User[0]['UserName'].",Your Transaction Password has been reset successfully.");  
        
        return Response::returnSuccess("success",array());
    }
    function DeleteSupportDeskUser(){
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_support_desk_user set IsDeleted='1' where `UserID`='".$User[0]['UserID']."' and UserCode='".$_POST['UserCode']."'");
        
        $mContent = $mysql->select("select * from `mailcontent` where `Category`='DeleteSupportDeskUser'");
            $content  = str_replace("#UserName#",$User[0]['Username'],$mContent[0]['Content']);
            
             MailController::Send(array("MailTo"         => $User[0]['EmailID'],
                                        "Category"       => "DeleteSupportDeskUser",
                                        "SDUserID"       => $User[0]['UserID'],
                                        "Subject"        => $mContent[0]['Title'],
                                        "Message"        => $content),$mailError);
             MobileSMSController::sendSMS($User[0]['MobileNumber']," Dear ".$User[0]['UserName'].",Your account has been deleted successfully.");  
        
        return Response::returnSuccess("success",array("UserCode"=>$_POST['UserCode']));
    }
    function SupportDeskUserChnPswdFstLogin() {
        global $mysql,$loginInfo;
         $txnPwd = $mysql->select("select * from `_tbl_admin` where `AdminID`='".$loginInfo[0]['AdminID']."'");
            if (!(isset($txnPwd) && trim($txnPwd[0]['TransactionPassword'])==($_POST['txnPassword'])))  {
                return Response::returnError("Invalid transaction password");   
            }
        $User = $mysql->select("select * from `_tbl_support_desk_user` where UserCode='".$_POST['UserCode']."'");
            if(!(sizeof($User)==1)){
                return Response::returnError("Invalid user information"); 
            }
        if($User[0]['IsActive']==0){
                return Response::returnError("Account is deactivated so Could not process"); 
            }
        $mysql->execute("update _tbl_support_desk_user set ChangePasswordFstLogin='0' where UserCode='".$_POST['UserCode']."'");
        return Response::returnSuccess("Success",array());
    }
    function GetRecentMembersForDashboard() {    

             global $mysql,$loginInfo;

             $sql = $mysql->select("select * from `_tbl_members`  ORDER BY `MemberID` DESC LIMIT 0,3");
             return Response::returnSuccess("success",$sql);    
            
         }
    public function GetRecentDraftProfiles() {
          global $mysql,$loginInfo; 
             $Profiles = array();
             $sql = "";
           /*  if (isset($_POST['requestfrom'])) {
                 $sql = " limit ".$_POST['requestfrom'].",". $_POST['requestto'];
             } else {
                $_POST['requestfrom']=0; 
                $_POST['requestto']=5; 
             }*/

             $RecentProfiles = $mysql->select("select ProfileCode from `_tbl_draft_profiles` order by ProfileID DESC LIMIT 0,3");
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
                        $Profiles[]=Profiles::getDraftProfileInformation($profileCode,1,1);     
                    }
                 } 
             }
                  
             return Response::returnSuccess("success",$Profiles);
         } 
         function GetAbusedProfilesDetails() {
           global $mysql;    
           $Profiles = array();
             $Position = "";                      
            $AbusedProfiles     = $mysql->select("select ProfileCode from `_tbl_abuse_reports` GROUP BY ProfileCode");
            $abuseddetails = $mysql->select("select * from _tbl_abuse_reports where ProfileCode='".$AbusedProfiles[0]['ProfileCode']."'");
            $abuseCount = $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM `_tbl_abuse_reports` ORDER BY `ReportID` DESC");
            if (sizeof($AbusedProfiles)>0) {
                     
                     foreach($AbusedProfiles as $AbusedProfile) {
                        $result = Profiles::getProfileInformation($AbusedProfile['ProfileCode'],2);    
                        $result['mode']="Published";
                        $result['AbuseCount']= $abuseCount[0]['cnt'];
                        $result['AbuseProfile']= $abuseddetails[0];
                        $Profiles[]= $result;
                     }
                                                            
                 }
            return Response::returnSuccess("success",$Profiles);
    }
    function GetViewAbusedProfilesDetails() {
           global $mysql;    
           $Profiles = array();
             $Position = "";
           // $AbusedProfiles     = $mysql->select("select * from `_tbl_abuse_reports` where `ReportID`='".$_POST['Code']."'");
            $AbusedProfiles = $mysql->select("select ProfileCode from _tbl_abuse_reports where ProfileCode='".$_POST['Code']."' GROUP BY ProfileCode");
            $AbusedDetails = $mysql->select("select * from _tbl_abuse_reports where ProfileCode='".$AbusedProfiles[0]['ProfileCode']."'");
            $abuseCount = $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM `_tbl_abuse_reports` ORDER BY `ReportID` DESC");
            if (sizeof($AbusedProfiles)>0) {
                     
                     foreach($AbusedProfiles as $AbusedProfile) {  
                         $result=array();
                        $result = Profiles::getProfileInformation($AbusedProfile['ProfileCode'],2);    
                        $result['mode']="Published";
                        $result['AbuseCount']= $abuseCount[0]['cnt'];
                        $result['AbusedDetails']= $AbusedDetails;
                        $Profiles[]= $result;
                     }
                                                            
                 }
            return Response::returnSuccess("success",$Profiles);
    }

}

//2801
?> 