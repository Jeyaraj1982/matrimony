<?php

class Admin extends Master {

    function AdminLogin() {

            global $mysql,$j2japplication;  

            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter username ");
            }

            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }

            $data=$mysql->select("select * from _tbl_admin where AdminLogin='".$_POST['UserName']."' and AdminPassword='".$_POST['Password']."'") ;

            if (sizeof($data)>0) {

                $clientinfo = $j2japplication->GetIPDetails($_POST['qry']);
             $loginid = $mysql->insert("_tbl_logs_logins",array("LoginOn"       => date("Y-m-d H:i:s"),
                                                                 "LoginFrom"     => "Web",
                                                                 "Device"        => $clientinfo['Device'],
                                                                 "AdminID"      => $data[0]['AdminID'],
                                                                 "LoginName"     => $_POST['UserName'],
                                                                 "BrowserIP"     => $clientinfo['query'],
                                                                 "CountryName"   => $clientinfo['country'],
                                                                 "BrowserName"   => $clientinfo['UserAgent'],
                                                                 "APIResponse"   => json_encode($clientinfo),
                                                                 "LoginPassword" => $_POST['Password']));
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

    function AdminChangePassword(){
         global $mysql,$loginInfo;  
              $getpassword = $mysql->select("select * from _tbl_admin where AdminID='".$loginInfo[0]['AdminID']."'");  
              if ($getpassword[0]['AdminPassword']!=$_POST['CurrentPassword']) {
                return Response::returnError("Incorrect Currentpassword"); } 
              if ($getpassword[0]['AdminPassword']==$_POST['CurrentPassword']) {                                         
                    $mysql->execute("update _tbl_admin set AdminPassword='".$_POST['ConfirmNewPassword']."' where AdminID='".$loginInfo[0]['AdminID']."'");
              return Response::returnSuccess("Password Changed Successfully",array());
              }

    }

    function GetFranchiseeCode(){
            return Response::returnSuccess("success",array("FranchiseeCode" => SeqMaster::GetNextFranchiseeNumber(),
                                                           "Plans"          => Plans::GetFranchiseePlans(),
                                                           "CountryName"    => CodeMaster::getData('CONTNAMES'),
                                                           "StateName"      => CodeMaster::getData('STATNAMES'),
                                                           "DistrictName"   => CodeMaster::getData('DistrictName'),
                                                           "BankName"       => CodeMaster::getData('BANKNAMES'),
                                                           "AccountType"    => CodeMaster::getData('AccountType'),
                                                           "Gender"         => CodeMaster::getData('SEX')));
        }

    function CreateFranchisee() {

        global $mysql,$loginInfo;
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
        if (!(strlen(trim($_POST['DateofBirth']))>0)) {
            return Response::returnError("Please enter Date of Birth");
        }
        if ((strlen(trim($_POST['Sex']))==0 || $_POST['Sex']=="0")) {
            return Response::returnError("Please select Sex");
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
        if (!(strlen(trim($_POST['AadhaarCard']))>0)) {
            return Response::returnError("Please enter AadhaarCard");
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
        if(strlen(trim($_POST['BusinessWhatsappNumber']))>0){
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
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LandlineNumber='".trim($_POST['LandlineNumber'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Landline Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where AadhaarNumber='".trim($_POST['AadhaarCard'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Aadhaar Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Login Name Already Exists");
        }
        $plan = $mysql->select("select * from _tbl_franchisees_plans where PlanID='".$_POST['Plan']."'");
         $id =  $mysql->insert("_tbl_franchisees",array("FranchiseeCode"       => $_POST['FranchiseeCode'],
                                                        "FranchiseName"        => $_POST['FranchiseeName'],
                                                        "ContactEmail"         => $_POST['FranchiseeEmailID'],
                                                        "ContactNumber"        => $_POST['BusinessMobileNumber'],
                                                        "ContactWhatsapp"      => $_POST['BusinessWhatsappNumber'],
                                                        "ContactLandline"      => $_POST['BusinessLandlineNumber'],
                                                        "BusinessAddressLine1" => $_POST['BusinessAddress1'],
                                                        "BusinessAddressLine2" => $_POST['BusinessAddress2'],
                                                        "BusinessAddressLine3" => $_POST['BusinessAddress3'],
                                                        "Landmark"             => $_POST['Landmark'],
                                                        "DistrictName"         => $_POST['DistrictName'],
                                                        "StateName"            => $_POST['StateName'],
                                                        "CountryName"          => $_POST['CountryName'],
                                                        "CityName"             => $_POST['CityName'],
                                                        "PinCode"              => $_POST['PinCode'],
                                                        "ValidUpto"            => $_POST['Validupto'],
                                                        "MondayF"              => $_POST['MonFH']." ". $_POST['MonFM']." ". $_POST['MonFN'],
                                                        "TuesdayF"             => $_POST['TueFH']." ". $_POST['TueFM']." ". $_POST['TueFN'],
                                                        "WednessdayF"          => $_POST['WedFH']." ". $_POST['WedFM']." ". $_POST['WedFN'],
                                                        "ThursdayF"            => $_POST['ThuFH']." ". $_POST['ThuFM']." ". $_POST['ThuFN'],
                                                        "FridayF"              => $_POST['FriFH']." ". $_POST['FriFM']." ". $_POST['FriFN'],
                                                        "SaturdayF"            => $_POST['SatFH']." ". $_POST['SatFM']." ". $_POST['SatFN'],
                                                        "SundayF"              => $_POST['SunFH']." ". $_POST['SunFM']." ". $_POST['SunFN'],
                                                        "MondayT"              => $_POST['MonTH']." ".$_POST['MonTM']." ".$_POST['MonTN'],
                                                        "TuesdayT"             => $_POST['TueTH']." ".$_POST['TueTM']." ".$_POST['TueTN'],
                                                        "WednessdayT"          => $_POST['WedTH']." ".$_POST['WedTM']." ".$_POST['WedTN'],
                                                        "ThursdayT"            => $_POST['ThuTH']." ".$_POST['ThuTM']." ".$_POST['ThuTN'],
                                                        "FridayT"              => $_POST['FriTH']." ".$_POST['FriTM']." ".$_POST['FriTN'],
                                                        "SaturdayT"            => $_POST['SatTH']." ".$_POST['SatTM']." ".$_POST['SatTN'],
                                                        "SundayT"              => $_POST['SunTH']." ".$_POST['SunTM']." ".$_POST['SunTN'],
                                                        "CreatedOn"            => date("Y-m-d H:i:s"),
                                                        "PlanID"               => $plan[0]['PlanID'],
                                                        "Plan"                 => $plan[0]['PlanName'] )); 

            $mysql->insert("_tbl_bank_details",array("BankName"      => $_POST['BankName'],
                                                     "FranchiseeID"  => $id,
                                                     "AccountName"   => $_POST['AccountName'],
                                                     "AccountNumber" => $_POST['AccountNumber'],  
                                                     "IFSCode"       => $_POST['IFSCode'],
                                                     "AccountType"   => $_POST['AccountType']));

            $mysql->insert("_tbl_franchisees_staffs",array("PersonName"     => $_POST['PersonName'],
                                                           "FatherName"     => $_POST['FatherName'],
                                                           "FranchiseeID"   => $id,
                                                           "DateofBirth"    => $_POST['DateofBirth'],
                                                           "Sex"            => $_POST['Sex'],
                                                           "FrCode"         => $_POST['FranchiseeCode'],
                                                           "EmailID"        => $_POST['EmailID'],
                                                           "MobileNumber"   => $_POST['MobileNumber'],
                                                           "WhatsappNumber" => $_POST['WhatsappNumber'],
                                                           "LandlineNumber" => $_POST['LandlineNumber'],
                                                           "AddressLine1"   => $_POST['Address1'],
                                                           "AddressLine2"   => $_POST['Address2'],
                                                           "CreatedOn"      => date("Y-m-d H:i:s"),
                                                           "AddressLine3"   => $_POST['Address3'],
                                                           "AadhaarNumber"  => $_POST['AadhaarCard'],
                                                           "IsActive"       => "1",
                                                           "LoginName"      => $_POST['UserName'],
                                                           "ReferedBy"      => $loginInfo[0]['AdminID'],
                                                           "LoginPassword"  => $_POST['Password']));

           $mail2 = new MailController();

            $mail2->NewFranchisee(array("mailTo"         => $_POST['FranchiseeEmailID'] ,
                                        "FranchiseeName" => $_POST['FranchiseeName'],
                                        "FranchiseeCode" => $_POST['FranchiseeCode'],
                                        "LoginName"      => $_POST['UserName'],
                                        "LoginPassword"  => $_POST['Password']));   
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }

    function EditFranchisee(){
              global $mysql,$loginInfo;

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
        if (!(strlen(trim($_POST['AccountName']))>0)) {
            return Response::returnError("Please enter Account Name");
        }
        if (!(strlen(trim($_POST['AccountNumber']))>0)) {
            return Response::returnError("Please enter Account Number");
        }
        if (!(strlen(trim($_POST['IFSCode']))>0)) {
            return Response::returnError("Please enter IFS Code");
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
        if (!(strlen(trim($_POST['DateofBirth']))>0)) {
            return Response::returnError("Please enter Date of Birth");
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
        if (!(strlen(trim($_POST['AadhaarCard']))>0)) {
            return Response::returnError("Please enter AadhaarCard");
        }
        $data = $mysql->select("select * from  _tbl_franchisees where FranchiseeCode='".trim($_POST['FranchiseeCode'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Franchisee Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees where ContactEmail='".trim($_POST['FranchiseeEmailID'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("EmailID Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees where ContactNumber='".trim($_POST['BusinessMobileNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Business MobileNumber Already Exists");
        }
        if(strlen(trim($_POST['BusinessWhatsappNumber']))>0){
        $data = $mysql->select("select * from  _tbl_franchisees where ContactWhatsapp='".trim($_POST['BusinessWhatsappNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Business WhatsappNumber Already Exists");
        }
        }
        if(strlen(trim($_POST['BusinessLandlineNumber']))>0){
        $data = $mysql->select("select * from  _tbl_franchisees where ContactLandline='".trim($_POST['BusinessLandlineNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Business LandlineNumber Already Exists");
        }
        }
        $data = $mysql->select("select * from  _tbl_bank_details where AccountNumber='".trim($_POST['AccountNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Account Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where EmailID='".trim($_POST['EmailID'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Email ID Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where MobileNumber='".trim($_POST['MobileNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where WhatsappNumber='".trim($_POST['WhatsappNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Whatsapp Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LandlineNumber='".trim($_POST['LandlineNumber'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Landline Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where AadhaarNumber='".trim($_POST['AadhaarCard'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Aadhaar Number Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_staffs where LoginName='".trim($_POST['UserName'])."' and FranchiseeID <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Login Name Already Exists");
        } 
        $dob = strtotime($_POST['DateofBirth']);
               $dob = date("Y",$dob)."-".date("m",$dob)."-".date("d",$dob);

    $mysql->execute("update _tbl_franchisees set FranchiseName='".$_POST['FranchiseeName']."',
                                                 ContactEmail='".$_POST['FranchiseeEmailID']."',
                                                 ContactNumber='".$_POST['BusinessMobileNumber']."',
                                                 ContactWhatsapp='".$_POST['BusinessWhatsappNumber']."',
                                                 ContactLandline='".$_POST['BusinessLandlineNumber']."',
                                                 BusinessAddressLine1='".$_POST['BusinessAddress1']."',
                                                 BusinessAddressLine2='".$_POST['BusinessAddress2']."',
                                                 BusinessAddressLine3='".$_POST['BusinessAddress3']."',
                                                 DistrictName='".$_POST['DistrictName']."',
                                                 StateName='".$_POST['StateName']."',
                                                 CountryName='".$_POST['CountryName']."',
                                                 CityName='".$_POST['CityName']."',
                                                 Landmark='".$_POST['LandMark']."',
                                                 PinCode='".$_POST['PinCode']."',
                                                 MondayF='".$_POST['MonFH']." ".$_POST['MonFM']." ".$_POST['MonFN']."',
                                                 TuesdayF='".$_POST['TueFH']." ".$_POST['TueFM']." ".$_POST['TueFN']."',
                                                 WednessdayF='".$_POST['WedFH']." ".$_POST['WedFM']." ".$_POST['WedFN']."',
                                                 ThursdayF='".$_POST['ThuFH']." ".$_POST['ThuFM']." ".$_POST['ThuFN']."',
                                                 FridayF='".$_POST['FriFH']." ".$_POST['FriFM']." ".$_POST['FriFN']."',
                                                 SaturdayF='".$_POST['SatFH']." ".$_POST['SatFM']." ".$_POST['SatFN']."',
                                                 SundayF='".$_POST['SunFH']." ".$_POST['SunFM']." ".$_POST['SunFN']."',
                                                 MondayT='".$_POST['MonTH']." ".$_POST['MonTM']." ".$_POST['MonTN']."',
                                                 TuesdayT='".$_POST['TueTH']." ".$_POST['TueTM']." ".$_POST['TueTN']."',
                                                 WednessdayT='".$_POST['WedTH']." ".$_POST['WedTM']." ".$_POST['WedTN']."',
                                                 ThursdayT='".$_POST['ThuTH']." ".$_POST['ThuTM']." ".$_POST['ThuTN']."',
                                                 FridayT='".$_POST['FriTH']." ".$_POST['FriTM']." ".$_POST['FriTN']."',
                                                 SaturdayT='".$_POST['SatTH']." ".$_POST['SatTM']." ".$_POST['SatTN']."',
                                                 SundayT='".$_POST['SunTH']." ".$_POST['SunTM']." ".$_POST['SunTN']."'
                                                 where FranchiseeID='".$_POST['Code']."'");

              $mysql->execute("update _tbl_bank_details set BankName='".$_POST['BankName']."',
                                                 AccountName='".$_POST['AccountName']."',
                                                 AccountNumber='".$_POST['AccountNumber']."',
                                                 IFSCode='".$_POST['IFSCode']."',
                                                 AccountType='".$_POST['AccountType']."'
                                                 where FranchiseeID='".$_POST['Code']."'");

              $mysql->execute("update _tbl_franchisees_staffs set PersonName='".$_POST['PersonName']."',
                                                 FatherName='".$_POST['FatherName']."',
                                                 DateofBirth='".$_POST['DateofBirth']."',
                                                 Sex='".$_POST['Sex']."',
                                                 EmailID='".$_POST['EmailID']."',
                                                 MobileNumber='".$_POST['MobileNumber']."',
                                                 WhatsappNumber='".$_POST['WhatsappNumber']."',
                                                 LandlineNumber='".$_POST['LandlineNumber']."',
                                                 AddressLine1='".$_POST['Address1']."',
                                                 AddressLine2='".$_POST['Address2']."',
                                                 AddressLine3='".$_POST['Address3']."',
                                                 AadhaarNumber='".$_POST['AadhaarCard']."'
                                                  where  ReferedBy='1' and FranchiseeID='".$_POST['Code']."'");
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
                                    ON _tbl_draft_profiles.CreatedBy=_tbl_members.MemberID";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Draft") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE _tbl_draft_profiles.RequestToVerify='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Publish") {
                return Response::returnSuccess("success",$mysql->select($sql."  WHERE _tbl_draft_profiles.IsApproved='1'"));    
             }
         }

    function GetProfilesRequestVerify() {
           global $mysql;    
              $Profiles = $mysql->select("SELECT *
                               FROM _tbl_draft_profiles
                               LEFT  JOIN _tbl_members
                               ON _tbl_draft_profiles.CreatedBy=_tbl_members.MemberID WHERE _tbl_draft_profiles.RequestToVerify='1'");

                return Response::returnSuccess("success",$Profiles);

    }
    
     function ViewRequestedProfile() {         
         global $mysql;

         $Profiles = $mysql->select("SELECT * FROM _tbl_draft_profiles
                                    INNER JOIN _tbl_members
                                    ON _tbl_members.MemberID = _tbl_draft_profiles.CreatedBy
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
             
             $draft = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileCode`='".$_POST['ProfileCode']."'");
             
             $member = $mysql->select("select * from `_tbl_members` where `MemberID`='".$draft[0]['CreatedBy']."'");
             
             $mContent = $mysql->select("select * from `mailcontent` where `Category`='ProfilePublished'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#ProfileID#",$draft[0]['ProfileID'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "ProfilePublished",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your Profile ID '".$draft[0]['ProfileID']."' has been published"); 

             $updateSql = "update `_tbl_draft_profiles` set  `IsApproved`      = '1',
                                                             `RequestToVerify` = '0',
                                                             `IsApprovedOn`    = '".date("Y-m-d H:i:s")."'
                                                              where `ProfileID`='".$_POST['Code']."'";
             $mysql->execute($updateSql); 
               
                                                             //approved by   //admin remarks
             $draft = $mysql->select("select * from `_tbl_draft_profiles` where `ProfileID`='".$_POST['Code']."'");
             $ProfileCode   = SeqMaster::GetNextProfileCode();
             $pid =  $mysql->insert("_tbl_profiles",array("ProfileCode"             => $ProfileCode,
                                                  "DraftProfileID"          => $draft[0]['ProfileID'],
                                                  "DraftProfileCode"        => $draft[0]['ProfileCode'],
                                                  "ProfileForCode"          => $draft[0]['ProfileForCode'],
                                                  "ProfileFor"              => $draft[0]['ProfileFor'],
                                                  "ProfileName"             => $draft[0]['ProfileName'],
                                                  "DateofBirth"             => $draft[0]['DateofBirth'],
                                                  "SexCode"                 => $draft[0]['SexCode'],
                                                  "Sex"                     => $draft[0]['Sex'],
                                                  "MaritalStatusCode"       => $draft[0]['MaritalStatusCode'], 
                                                  "MaritalStatus"           => $draft[0]['MaritalStatus'],
                                                  "MotherTongueCode"        => $draft[0]['MotherTongueCode'],
                                                  "MotherTongue"            => $draft[0]['MotherTongue'],
                                                  "ReligionCode"            => $draft[0]['ReligionCode'],
                                                  "Religion"                => $draft[0]['Religion'],
                                                  "CasteCode"               => $draft[0]['CasteCode'],
                                                  "Caste"                   => $draft[0]['Caste'],
                                                  "AboutMe"                 => $draft[0]['AboutMe'],
                                                  "CountryCode"             => $draft[0]['CountryCode'],
                                                  "Country"                 => $draft[0]['Country'],
                                                  "StateCode"               => $draft[0]['StateCode'],
                                                  "State"                   => $draft[0]['State'],
                                                  "City"                    => $draft[0]['City'],
                                                  "Pincode"                    => $draft[0]['Pincode'],
                                                  "OtherLocation"           => $draft[0]['OtherLocation'],
                                                  "CommunityCode"           => $draft[0]['CommunityCode'],
                                                  "Community"               => $draft[0]['Community'],
                                                  "NationalityCode"         => $draft[0]['NationalityCode'],
                                                  "Nationality"             => $draft[0]['Nationality'],
                                                  "AadhaarNo"               => $draft[0]['AadhaarNo'],
                                                  "Ishandicapped"           => $draft[0]['Ishandicapped'],
                                                  "OccupationCode"          => $draft[0]['OccupationCode'],
                                                  "Occupation"              => $draft[0]['Occupation'],
                                                  "WorkedCountryCode"       => $draft[0]['WorkedCountryCode'],
                                                  "WorkedCountry"           => $draft[0]['WorkedCountry'],
                                                  "EducationCode"           => $draft[0]['EducationCode'],
                                                  "Education"               => $draft[0]['Education'],
                                                  "AnnualIncomeCode"        => $draft[0]['AnnualIncomeCode'],
                                                  "AnnualIncome"            => $draft[0]['AnnualIncome'],
                                                  "QualificationCode"       => $draft[0]['QualificationCode'],
                                                  "Qualification"           => $draft[0]['Qualification'],
                                                  "EmployedAsCode"          => $draft[0]['EmployedAsCode'],
                                                  "EmployedAs"              => $draft[0]['EmployedAs'],
                                                  "OccupationTypeCode"      => $draft[0]['OccupationTypeCode'],
                                                  "OccupationType"          => $draft[0]['OccupationType'],
                                                  "TypeofOccupationCode"    => $draft[0]['TypeofOccupationCode'],
                                                  "TypeofOccupation"        => $draft[0]['TypeofOccupation'],
                                                  "PhysicallyImpairedCode"  => $draft[0]['PhysicallyImpairedCode'],
                                                  "PhysicallyImpaired"      => $draft[0]['PhysicallyImpaired'],
                                                  "VisuallyImpairedCode"    => $draft[0]['VisuallyImpairedCode'],
                                                  "VisuallyImpaired"        => $draft[0]['VisuallyImpaired'],
                                                  "VissionImpairedCode"     => $draft[0]['VissionImpairedCode'],
                                                  "VissionImpaired"         => $draft[0]['VissionImpaired'],
                                                  "SpeechImpairedCode"      => $draft[0]['SpeechImpairedCode'],
                                                  "SpeechImpaired"          => $draft[0]['SpeechImpaired'],
                                                  "HeightCode"              => $draft[0]['HeightCode'],
                                                  "Height"                  => $draft[0]['Height'],
                                                  "WeightCode"              => $draft[0]['WeightCode'],
                                                  "Weight"                  => $draft[0]['Weight'],
                                                  "BloodGroupCode"          => $draft[0]['BloodGroupCode'],
                                                  "BloodGroup"              => $draft[0]['BloodGroup'],
                                                  "ComplexationCode"        => $draft[0]['ComplexationCode'],
                                                  "Complexation"            => $draft[0]['Complexation'],
                                                  "BodyTypeCode"            => $draft[0]['BodyTypeCode'],
                                                  "BodyType"                => $draft[0]['BodyType'],
                                                  "DietCode"                => $draft[0]['DietCode'],
                                                  "Diet"                    => $draft[0]['Diet'],
                                                  "SmokingHabitCode"        => $draft[0]['SmokingHabitCode'],
                                                  "SmokingHabit"            => $draft[0]['SmokingHabit'],
                                                  "DrinkingHabitCode"       => $draft[0]['DrinkingHabitCode'],
                                                  "DrinkingHabit"           => $draft[0]['DrinkingHabit'],
                                                  "FathersName"             => $draft[0]['FathersName'],
                                                  "FathersOccupationCode"   => $draft[0]['FathersOccupationCode'],
                                                  "FathersOccupation"       => $draft[0]['FathersOccupation'],
                                                  "MothersName"             => $draft[0]['MothersName'],
                                                  "MothersOccupationCode"   => $draft[0]['MothersOccupationCode'],
                                                  "MothersOccupation"       => $draft[0]['MothersOccupation'],
                                                  "FamilyTypeCode"          => $draft[0]['FamilyTypeCode'],
                                                  "FamilyType"              => $draft[0]['FamilyType'],
                                                  "FamilyValueCode"         => $draft[0]['FamilyValueCode'],
                                                  "FamilyValue"             => $draft[0]['FamilyValue'],
                                                  "FamilyAffluenceCode"     => $draft[0]['FamilyAffluenceCode'],
                                                  "FamilyAffluence"         => $draft[0]['FamilyAffluence'],
                                                  "NumberofBrothersCode"    => $draft[0]['NumberofBrothersCode'],
                                                  "NumberofBrothers"        => $draft[0]['NumberofBrothers'],
                                                  "YoungerCode"             => $draft[0]['YoungerCode'],
                                                  "Younger"                 => $draft[0]['Younger'],
                                                  "ElderCode"               => $draft[0]['ElderCode'],
                                                  "Elder"                   => $draft[0]['Elder'],
                                                  "MarriedCode"             => $draft[0]['MarriedCode'],
                                                  "Married"                 => $draft[0]['Married'],
                                                  "NumberofSistersCode"     => $draft[0]['NumberofSistersCode'],
                                                  "NumberofSisters"         => $draft[0]['NumberofSisters'],
                                                  "YoungerSisterCode"       => $draft[0]['YoungerSisterCode'],
                                                  "YoungerSister"           => $draft[0]['YoungerSister'],
                                                  "ElderSisterCode"         => $draft[0]['ElderSisterCode'],
                                                  "ElderSister"             => $draft[0]['ElderSister'],
                                                  "MarriedSisterCode"       => $draft[0]['MarriedSisterCode'],
                                                  "MarriedSister"           => $draft[0]['MarriedSister'],
                                                  "EmailID"                 => $draft[0]['EmailID'],
                                                  "MobileNumber"            => $draft[0]['MobileNumber'],
                                                  "AddressLine1"            => $draft[0]['AddressLine1'],
                                                  "AddressLine2"            => $draft[0]['AddressLine2'],
                                                  "AddressLine3"            => $draft[0]['AddressLine3'],
                                                  "WhatsappNumber"          => $draft[0]['WhatsappNumber'],
                                                  "StarNameCode"            => $draft[0]['StarNameCode'],
                                                  "StarName"                => $draft[0]['StarName'],
                                                  "RasiNameCode"            => $draft[0]['RasiNameCode'],
                                                  "RasiName"                => $draft[0]['RasiName'],
                                                  "LakanamCode"             => $draft[0]['LakanamCode'],
                                                  "Lakanam"                 => $draft[0]['Lakanam'],
                                                  "R1"                      => $draft[0]['R1'],
                                                  "R2"                      => $draft[0]['R2'],
                                                  "R3"                      => $draft[0]['R3'],
                                                  "R4"                      => $draft[0]['R4'],
                                                  "R5"                      => $draft[0]['R5'],
                                                  "R8"                      => $draft[0]['R8'],
                                                  "R9"                      => $draft[0]['R9'],
                                                  "R12"                     => $draft[0]['R12'],
                                                  "R13"                     => $draft[0]['R13'],
                                                  "R14"                     => $draft[0]['R14'],
                                                  "R15"                     => $draft[0]['R15'],
                                                  "R16"                     => $draft[0]['R16'],
                                                  "A1"                      => $draft[0]['A1'],
                                                  "A2"                      => $draft[0]['A2'],
                                                  "A3"                      => $draft[0]['A3'],
                                                  "A4"                      => $draft[0]['A4'],
                                                  "A5"                      => $draft[0]['A5'],
                                                  "A8"                      => $draft[0]['A8'],
                                                  "A9"                      => $draft[0]['A9'],
                                                  "A12"                     => $draft[0]['A12'],
                                                  "A13"                     => $draft[0]['A13'],
                                                  "A14"                     => $draft[0]['A14'],
                                                  "A15"                     => $draft[0]['A15'],
                                                  "A16"                     => $draft[0]['A16'],
                                                  "CreatedOn"               => $draft[0]['CreatedOn'],
                                                  "LastUpdatedOn"           => $draft[0]['LastUpdatedOn'],
                                                  "MemberID"               => $draft[0]['MemberID'],
                                                  "MemberCode"             => $draft[0]['MemberCode'],
                                                  "ReferBy"                 => $draft[0]['ReferBy'],
                                                  "RequestToVerify"         => $draft[0]['RequestToVerify'],
                                                  "RequestVerifyOn"         => $draft[0]['RequestVerifyOn'],
                                                  "CreatedByMemberID"         => $draft[0]['CreatedByMemberID'],
                                                  "IsApproved"              => "1",                                   
                                                  "IsApprovedOn"            => date("Y-m-d H:i:s")));
                                                  
     $draftEducationDetails = $mysql->select("select * from `_tbl_draft_profiles_education_details` where `ProfileID`='".$_POST['Code']."'");   
       foreach($draftEducationDetails as $ded) {
     $mysql->insert("_tbl_profiles_education_details",array("EducationDetails"  => $ded['EducationDetails'],
                                                                  "EducationDegree"   => $ded['EducationDegree'],
                                                                  "EducationRemarks"  => $ded['EducationRemarks'],
                                                                  "DraftProfileID"    => $ded['ProfileID'],
                                                                  "DraftProfileCode"  => $ded['ProfileCode'],
                                                                  "ProfileID"         => $pid,
                                                                  "ProfileCode"       => $ProfileCode,
                                                                  "MemberID"          => $draft[0]['CreatedBy'],
                                                                  "IsApproved"        => "1",
                                                                  "IsApprovedOn"      => date("Y-m-d H:i:s")));
       }
       
       $draftProfilePhotos = $mysql->select("select * from `_tbl_draft_profiles_photos` where  `ProfileID`='".$_POST['Code']."'");   
       foreach($draftProfilePhotos as $dPp) {
                      $mysql->insert("_tbl_profiles_photos",array("ProfilePhoto"      => $dPp['ProfilePhoto'],
                                                                  "UpdateOn"          => $dPp['UpdateOn'],
                                                                  "PriorityFirst"     => $dPp['PriorityFirst'],
                                                                  "IsPublished"       => $dPp['IsPublished'],
                                                                  "PublishedOn"       => $dPp['PublishedOn'],
                                                                  "DraftProfileID"    => $dPp['ProfileID'],
                                                                  "DraftProfileCode"  => $dPp['ProfileCode'],
                                                                  "IsDelete"          => $dPp['IsDelete'],
                                                                  "ProfileID"         => $pid,
                                                                  "ProfileCode"       => $ProfileCode,
                                                                  "MemberID"          => $draft[0]['CreatedBy'],
                                                                  "IsApproved"        => "1",
                                                                  "IsApprovedOn"      => date("Y-m-d H:i:s")));
       }
       $draftProfilePartnersExpectatipns = $mysql->select("select * from `_tbl_draft_profiles_partnerexpectation` where `ProfileID`='".$_POST['Code']."'");   
       foreach($draftProfilePartnersExpectatipns as $dPE) {
                      $mysql->insert("_tbl_profiles_partnerexpectation",array("AgeFrom"             => $dPE['AgeFrom'],
                                                                              "AgeTo"               => $dPE['AgeTo'],
                                                                              "MaritalStatusCode"   => $dPE['MaritalStatusCode'],
                                                                              "MaritalStatus"       => $dPE['MaritalStatus'],
                                                                              "ReligionCode"        => $dPE['ReligionCode'],
                                                                              "Religion"            => $dPE['Religion'],
                                                                              "CasteCode"           => $dPE['CasteCode'],
                                                                              "Caste"               => $dPE['Caste'],
                                                                              "EducationCode"       => $dPE['EducationCode'],
                                                                              "Education"           => $dPE['Education'],
                                                                              "AnnualIncomeCode"    => $dPE['AnnualIncomeCode'],
                                                                              "AnnualIncome"        => $dPE['AnnualIncome'],
                                                                              "EmployedAsCode"      => $dPE['EmployedAsCode'],
                                                                              "EmployedAs"          => $dPE['EmployedAs'],
                                                                              "Details"             => $dPE['Details'],
                                                                              "DraftProfileID"      => $dPE['DraftProfileID'],
                                                                              "DraftProfileCode"    => $dPE['DraftProfileCode'],
                                                                              "ProfileID"           => $pid,
                                                                              "ProfileCode"         => $ProfileCode,
                                                                              "CreatedBy"           => $draft[0]['CreatedBy'],
                                                                              "IsApproved"          => "1",
                                                                              "IsApprovedOn"        => date("Y-m-d H:i:s")));
       }
       $draftdocuments = $mysql->select("select * from `_tbl_draft_profiles_verificationdocs` where `ProfileID`='".$_POST['Code']."'");   
    
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
                                                                              "ProfileID"           => $pid,
                                                                              "ProfileCode"         => $ProfileCode,
                                                                              "MemberID"            => $draft[0]['CreatedBy'],
                                                                              "IsApproved"          =>  $dPD['IsApproved'],
                                                                              "ApprovedOn"        => date("Y-m-d H:i:s")));
       }
             return Response::returnSuccess('<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">Your profile Approved.</h5>
                            <h5 style="text-align:center;"><a data-dismiss="modal" style="cursor:pointer"  >Yes</a> <h5>
                       </div>',array("ProfileCode"=>$ProfileCode));
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
        $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_POST['Code']."'");
        $FranchiseeStaff = $mysql->select("select * from _tbl_franchisees_staffs where ReferedBy='1' and FranchiseeID='".$_POST['Code']."'");
        $PrimaryBankAccount = $mysql->select("select * from _tbl_bank_details where FranchiseeID='".$_POST['Code']."'");

        return Response::returnSuccess("success",array("Franchisee"         => $Franchisees[0],
                                                       "FranchiseeStaff"    => $FranchiseeStaff[0],
                                                       "CountryNames"        => CodeMaster::getData('CountryName'),
                                                       "StateName"          => CodeMaster::getData('StateName'),
                                                       "DistrictName"       => CodeMaster::getData('DistrictName'),
                                                       "BankNames"          => CodeMaster::getData('BANKNAMES'),
                                                       "AccountType"        => CodeMaster::getData('AccountType'),
                                                       "PrimaryBankAccount" => $PrimaryBankAccount[0],
                                                       "Gender"             => CodeMaster::getData('Gender')));

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
         
    function MemberResetPasswordSendMail() {
        global $mysql,$mail,$loginInfo;
        
        $members = $mysql->select("select * from _tbl_members where MemberID='".$_POST['Code']."'");
         
         $mContent = $mysql->select("select * from `mailcontent` where `Category`='MemberResetPassword'");
         $GUID= md5(time().rand(3000,3000000).time());
         
             $content  = str_replace("#MemberName#",$members[0]['MemberName'],$mContent[0]['Content']);
             $content  = str_replace("#Link#",WebPath."resetPassword.php?uid=".$GUID,$content);
             
             
             MailController::Send(array("MailTo"   => $members[0]['EmailID'],               
                                        "Category" => "MemberResetPassword",
                                        "MemberID" => $members[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
                                        
            $id= $mysql->insert("_tbl_reset_password",array("MemberID"  => $members[0]['MemberID'],
                                                     "MemberEmail"  => $members[0]['EmailID'],
                                                     "ValidUpto"    => date("Y-m-d H:i:s",time() + 24 * 60 * 60),
                                                     "Mailsent"     => "1",  
                                                     "GUID"     => $GUID,  
                                                     "RequestOn"  => date("Y-m-d H:i:s"),
                                                     "RequestFrom"  => "Admin",
                                                     "AdminID"      => $loginInfo[0]['AdminID']));
         
             if($mailError){
                return  Response::returnError("Error: unable to process your request.");
             } else {
                return Response::returnSuccess("Email sent successfully",array("reqID"=>$GUID));
             }
         }
        
         function MemberResetPasswordCheck() {
             
             global $mysql;
             $data = $mysql->select("Select * from `_tbl_reset_password` where `GUID`='".$_POST['GUID']."'");
             
             if (sizeof($data)>0) {
                 if ($data[0]['IsPasswordChanged']==0) {
                     if (strtotime($data[0]['ValidUpto']) > strtotime(date("Y-m-d H:i:s"))) {
                         return Response::returnSuccess("Valid GUID",array("GUID"=>$_POST['GUID'])); 
                     } else {
                        return Response::returnError("Password link has been expired."); 
                     }
                 } else {   
                    return Response::returnError("You already used this link and saved password."); 
                 }
             } else {
                return Response::returnError("Invalid GUID"); 
             }
         }
         
        function MemberResetPasswordSave(){
             global $mysql;
             
             $data = $mysql->select("Select * from `_tbl_reset_password` where `GUID`='".$_POST['GUID']."' ");
             
             if (!(strlen(trim($_POST['NewPassword']))>=6)) {
                return Response::returnError("Please enter valid new password must have 6 characters.");
             } 
             if (!(strlen(trim($_POST['ConfirmNewPassword']))>=6)) {
                return Response::returnError("Please enter valid confirm new password  must have 6 characters"); 
             } 
             if ($_POST['ConfirmNewPassword']!=$_POST['NewPassword']) {
                return Response::returnError("Password do not match"); 
             }
             $sqlQry ="update _tbl_members set `MemberPassword`='".$_POST['NewPassword']."' where `MemberID`='".$data[0]['MemberID']."'";
             $mysql->execute($sqlQry);  
             $data = $mysql->select("select * from `_tbl_members` where  MemberID='".$data[0]['MemberID']."'");
             $id = $mysql->insert("_tbl_logs_activity",array("MemberID"       => $data[0]['MemberID'],
                                                             "ActivityType"   => 'MemberResetpassword.',
                                                             "ActivityString" => 'Member Reset assword.',
                                                             "SqlQuery"       => base64_encode($sqlQry),
                                                             //"oldData"        => base64_encode(json_encode($oldData)),
                                                             "ActivityOn"     => date("Y-m-d H:i:s")));
             $mysql->execute("update _tbl_reset_password set IsPasswordChanged='1',ChangedOn='".date("Y-m-d H:i:s")."' where `GUID`='".$_POST['GUID']."'");                                                
             
             return Response::returnSuccess("New Password saved successfully"."update _tbl_members set `MemberPassword`='".$_POST['NewPassword']."' where `MemberID`='".$data[0]['MemberID']."'",$data[0]);  
        }

    function GetManagePlans() {
           global $mysql;    
              $Plans = $mysql->select("SELECT t1.*,  COUNT(t2.PlanID) AS cnt FROM _tbl_franchisees_plans AS t1 LEFT OUTER JOIN _tbl_franchisees AS t2 ON t1.PlanID = t2.PlanID GROUP BY t1.PlanID");
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
            return Response::returnSuccess("success",array("PlanCode" => SeqMaster::GetNextFranchiseePlanNumber()));
    }

    function CreateFranchiseePlan() {
        global $mysql;

        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanName='".trim($_POST['PlanName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanCode='".trim($_POST['PlanCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Code Already Exists");
        }

        $insArray = array("PlanCode"  => $_POST['PlanCode'],
                          "PlanName"  => $_POST['PlanName'],
                          "Duration"  => $_POST['Duration'],
                          "Amount"    => $_POST['Amount']);

        if ($_POST['ProfileActiveCommissionType'] == "Rs") {
            $insArray["ProfileCommissionWithPercentage"] = '0';
            $insArray["ProfileCommissionWithRupees"] = $_POST['ProfileActiveCommission'];
        }
        if ($_POST['ProfileActiveCommissionType'] == "Percentage") {
            $insArray["ProfileCommissionWithPercentage"] = $_POST['ProfileActiveCommission'];
            $insArray["ProfileCommissionWithRupees"] = '0';
        }
        if ($_POST['ProfileRenewalCommissionType'] == "Rs") {
            $insArray["RenewalCommissionWithPercentage"] ='0' ;
            $insArray["RenewalCommissionWithRupees"] = $_POST['ProfileRenewalCommission'];
        }
        if ($_POST['ProfileRenewalCommissionType'] == "Percentage") {
            $insArray["RenewalCommissionWithPercentage"] =$_POST['ProfileRenewalCommission'];
            $insArray["RenewalCommissionWithRupees"] =  '0';
        }
        if ($_POST['WalletRefillCommissionType'] == "Rs") {
            $insArray["RefillCommissionWithPercentage"] = '0' ;
            $insArray["RefillCommissionWithRupees"] =$_POST['WalletRefillCommission'] ;
        }
        if ($_POST['WalletRefillCommissionType'] == "Percentage") {
            $insArray["RefillCommissionWithPercentage"] = $_POST['WalletRefillCommission'];
            $insArray["RefillCommissionWithRupees"] =  '0';
        }
        if ($_POST['ProfiledownloadCommissionType'] == "Rs") {
            $insArray["ProfileDownloadCommissionWithPercentage"] = '0';
            $insArray["ProfileDownloadCommissionWithRupees"] = $_POST['ProfiledownloadCommission'];
        }
        if ($_POST['ProfiledownloadCommissionType'] == "Percentage") {
            $insArray["ProfileDownloadCommissionWithPercentage"] =$_POST['ProfiledownloadCommission'];
            $insArray["ProfileDownloadCommissionWithRupees"] =  '0';
        }

         $id = $mysql->insert("_tbl_franchisees_plans",$insArray);

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }

    function EditFranchiseePlan(){
              global $mysql;

        $data = $mysql->select("select * from  _tbl_franchisees_plans where PlanName='".trim($_POST['PlanName'])."' and PlanCode <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        } 
        $sql = "update _tbl_franchisees_plans set PlanName='".$_POST['PlanName']."',
                                                  Duration='".$_POST['Duration']."',
                                                  Amount='".$_POST['Amount']."',";

        if ($_POST['ProfileActiveCommissionType'] == "Rs") {
            $sql .= " ProfileCommissionWithPercentage ='0', ProfileCommissionWithRupees='".$_POST['ProfileActiveCommission']."', ";
        } else if ($_POST['ProfileActiveCommissionType'] == "Percentage") {
           $sql .= " ProfileCommissionWithRupees ='0', ProfileCommissionWithPercentage='".$_POST['ProfileActiveCommission']."', ";
        }

        if ($_POST['ProfileRenewalCommissionType'] == "Rs") {
            $sql .= " RenewalCommissionWithPercentage ='0', RenewalCommissionWithRupees='".$_POST['ProfileRenewalCommission']."', ";
        } else if ($_POST['ProfileRenewalCommissionType'] == "Percentage") {
            $sql .= " RenewalCommissionWithRupees ='0', RenewalCommissionWithPercentage='".$_POST['ProfileRenewalCommission']."', ";
        }

        if ($_POST['WalletRefillCommissionType'] == "Rs") {
            $sql .= " RefillCommissionWithPercentage ='0', RefillCommissionWithRupees='".$_POST['WalletRefillCommission']."', ";
        } else if ($_POST['WalletRefillCommissionType'] == "Percentage") {
            $sql .= " RefillCommissionWithRupees ='0', RefillCommissionWithPercentage='".$_POST['WalletRefillCommission']."', ";
        }

        if ($_POST['ProfiledownloadCommissionType'] == "Rs") {
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
                return Response::returnSuccess("success",$Plans[0]);
    }

    function GetFranchiseeRefillWalletManage() {
           global $mysql;    
              $RefillWallet = $mysql->select("select * from _tbl_refillwallet");
                return Response::returnSuccess("success",$RefillWallet);
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
                                                           "DistrictName"        => CodeMaster::getData('DISTNAMES'),
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
                                                           "FamilyAffluence"        => CodeMaster::getData('FAMILYAFFLUENCE')));    
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

     function BankRequests() {

             global $mysql,$loginInfo;

             $sql = "SELECT ReqID,RequestedOn,BankName,RefillAmount,TransferedOn,TransferMode, 
                            CASE
                                WHEN   ((IsApproved=0) AND (IsRejected=0)) THEN 'Pending'
                                WHEN   ((IsApproved=1) AND (IsRejected=0)) THEN 'Success'
                                WHEN   ((IsApproved=0) AND (IsRejected=1)) THEN 'Failure'
                            END AS TxnStatus
                     FROM _tbl_wallet_bankrequests ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql." order by `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Pending") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsApproved='0' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Success") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsApproved='1' AND IsRejected='0' ORDER BY `ReqID` DESC "));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Failure") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE IsApproved='0' AND IsRejected='1' ORDER BY `ReqID` DESC "));
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Report") {

                 $fromDate = $_POST['FromDate'];
                 $toDate   = $_POST['ToDate'];

                 switch ($_POST['filter']) {

                     case 'All'     : $sql .= " where ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))";
                                      break;
                     case 'Pending' : $sql .= "  where `IsApproved`='0' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Success' : $sql .= "  where `IsApproved`='1' and `IsRejected`='0' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
                                      break;
                     case 'Failure' : $sql .= "  where `IsApproved`='0' and `IsRejected`='1' and ( date(`RequestedOn`)>=date('".$fromDate."') and date(`RequestedOn`)<=date('".$toDate."'))   ";
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
    function CreatePaypal() {

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
    }
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
                            _tbl_members.MemberName AS MemberName,
                            _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                            _tbl_franchisees.FranchiseName AS FranchiseeName,
                            _tbl_members.CreatedOn AS CreatedOn,
                            _tbl_members.IsActive AS IsActive
                        FROM _tbl_members
                        INNER JOIN _tbl_franchisees
                        ON _tbl_members.ReferedBy=`_tbl_franchisees`.FranchiseeID ";

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `_tbl_members`.`IsActive`='1'"));    
             }

             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                 return Response::returnSuccess("success",$mysql->select($sql." WHERE `_tbl_members`.`IsActive`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="FranchiseeWise") {
                 return Response::returnSuccess("success",$mysql->select("SELECT t1.*,  COUNT(t2.MemberID) AS MemberCount FROM _tbl_franchisees AS t1
                                                                            LEFT OUTER JOIN _tbl_members AS t2 ON t1.FranchiseeID = t2.ReferedBy GROUP BY t1.FranchiseeID"));    
             }
         }    

         function GetMemberInfo() {
           global $mysql;    
        $Members = $mysql->select("SELECT 
                                     _tbl_members.MemberID AS MemberID,
                                     _tbl_members.MemberCode AS MemberCode,
                                     _tbl_members.MemberName AS MemberName,
                                     _tbl_members.MobileNumber AS MobileNumber,
                                     _tbl_members.EmailID AS EmailID,
                                     _tbl_members.MemberLogin AS MemberLogin,
                                     _tbl_members.MemberPassword AS MemberPassword,
                                     _tbl_members.AadhaarNumber AS AadhaarNumber,
                                     _tbl_franchisees.FranchiseeCode AS FranchiseeCode,
                                     _tbl_franchisees.FranchiseName AS FranchiseName,
                                     _tbl_franchisees.FranchiseeID AS FranchiseeID,
                                     _tbl_members.CreatedOn AS CreatedOn,
                                     _tbl_franchisees.IsActive AS FIsActive,
                                     _tbl_members.IsActive AS IsActive
                                    FROM _tbl_members
                                    INNER JOIN _tbl_franchisees
                                    ON _tbl_members.ReferedBy=_tbl_franchisees.FranchiseeID where _tbl_members.MemberID='".$_POST['Code']."'");
        
        return Response::returnSuccess("success",array("MemberInfo"    => $Members[0],
                                                       "Countires" =>CodeMaster::getData('RegisterAllowedCountries')));
    }
  function GetFranchiseeInfoInFranchiseeWise() {        
           global $mysql;    
        $Franchisees = $mysql->select("select * from _tbl_franchisees where FranchiseeID='".$_POST['Code']."'");
        $Members = $mysql->select("select * from _tbl_members where ReferedBy='".$_POST['Code']."'");
        return Response::returnSuccess("success",array("FranchiseeInfo"    => $Franchisees[0],
                                                       "Member"    => $Members));
    } 
    function EditMemberInfo(){
              global $mysql,$loginInfo;

        $data = $mysql->select("select * from  `_tbl_members` where `MemberName`='".trim($_POST['MemberName'])."' and `MemberID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Member Name Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_members` where `EmailID`='".trim($_POST['EmailID'])."' and `MemberID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Email ID Already Exists");
        }
        $data = $mysql->select("select * from  `_tbl_members` where `MobileNumber`='".trim($_POST['MobileNumber'])."' and `MemberID` <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Mobile Number Already Exists");
        } 
        $mysql->execute("update _tbl_members set MemberName='".$_POST['MemberName']."',
                                                    EmailID='".$_POST['EmailID']."',
                                                    MobileNumber='".$_POST['MobileNumber']."',
                                                    MemberPassword='".$_POST['MemberPassword']."',
                                                    IsActive='".$_POST['Status']."' where  MemberID='".$_POST['Code']."'");

         return Response::returnSuccess("success",array());

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

             $sql = "select * from _tbl_member_plan";
             

             if (isset($_POST['Request']) && $_POST['Request']=="All") {
                return Response::returnSuccess("success",$mysql->select($sql));    
             }                                                                                                                                                                            
             if (isset($_POST['Request']) && $_POST['Request']=="Active") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsActive` ='1'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Deactive") {
                return Response::returnSuccess("success",$mysql->select($sql." WHERE `IsActive` ='0'"));    
             }
         }
         
         function GetMemberPlanCode() {
            return Response::returnSuccess("success",array("PlanCode" => SeqMaster::GetNextPlanCode()));
         }
         
    function CreateMemberPlan() {

        global $mysql,$loginInfo;
      
        $data = $mysql->select("select * from  _tbl_member_plan where PlanCode='".trim($_POST['PlanCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_member_plan where PlanName='".trim($_POST['PlanName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
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
                                                           "CreatedOn"                          => date("Y-m-d H:i:s"))); 

        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Failure");   
            }
    }
    
    function EditMemberPlan(){
              global $mysql,$loginInfo;
        
        $data = $mysql->select("select * from  _tbl_member_plan where PlanName='".trim($_POST['PlanName'])."' and PlanCode <>'".$_POST['Code']."'");
        if (sizeof($data)>0) {
            return Response::returnError("Plan Name Already Exists");
        }
        $mysql->execute("update _tbl_member_plan set PlanName='".$_POST['PlanName']."',
                                                 Decreation='".$_POST['Decreation']."',
                                                 Amount='".$_POST['Amount']."',
                                                 Photos='".$_POST['Photos']."',
                                                 Videos='".$_POST['Videos']."',
                                                 FreeProfiles='".$_POST['Freeprofiles']."',
                                                 ShortDescription='".$_POST['ShortDescription']."',
                                                 DetailDescription='".$_POST['DetailDescription']."',
                                                 Remarks='".$_POST['Remarks']."'
                                                 where  PlanCode='".$_POST['Code']."'");

         return Response::returnSuccess("success",array());

    }
    
     function GetMemberPlanInfo() {
           global $mysql;    
              $Plans = $mysql->select("select * from _tbl_member_plan where PlanCode='".$_POST['Code']."'");
                return Response::returnSuccess("success",$Plans[0]);
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
             $memberCount = $mysql->select("SELECT COUNT(MemberID) AS cnt FROM _tbl_members");
             $member =  $mysql->select("SELECT * FROM `_tbl_members` ORDER BY `MemberID` DESC LIMIT 3");
             $profilecount =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM _tbl_profiles");
             $profile =  $mysql->select("SELECT * FROM `_tbl_draft_profiles` ORDER BY `ProfileID` DESC LIMIT 3");
             $profileverification =  $mysql->select("SELECT COUNT(ProfileID) AS cnt FROM _tbl_profiles where RequestToVerify='1'");
             $documentverification =  $mysql->select("SELECT COUNT(DocID) AS cnt FROM _tbl_member_documents");
             $ordercount =  $mysql->select("SELECT COUNT(OrderID) AS cnt FROM _tbl_orders");
             $invoicecount =  $mysql->select("SELECT COUNT(InvoiceID) AS cnt FROM _tbl_invoices");
             $paypalcount =  $mysql->select("SELECT COUNT(PaypalID) AS cnt FROM _tbl_settings_paypal");
                
                return Response::returnSuccess("success",array("MemberCount"    => $memberCount,
                                                               "Member"         => $member,
                                                               "ProfileCount"   => $profilecount,
                                                               "Profile"        => $profile,
                                                               "OrderCount"     => $ordercount,
                                                               "InvoiceCount"     => $invoicecount,
                                                               "PaypalCount"     => $paypalcount,
                                                               "Document"     => $documentverification,
                                                               "ProfileVerification"     => $profileverification
                                                               ));
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
                return Response::returnSuccess("success",$mysql->select($sql." where `IsVerified`='1' and`IsRejected`='0'"));    
             }
             if (isset($_POST['Request']) && $_POST['Request']=="Rejected") {
                return Response::returnSuccess("success",$mysql->select($sql." where `IsRejected`='1'"));    
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
       
                $data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   

                $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='IDProofApproved'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "IDProofApproved",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your ID Proof Approved"); 

           $mysql->execute("update _tbl_member_documents set IsVerified='1',ApproveRemarks='".$_POST['ApproveRemarks']."',
                                                 VerifiedOn='".date("Y-m-d H:i:s")."' where  DocID='".$data[0]['DocID']."'");

         return $mailError.'<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">successfully Approved. </h5>
                            <p style="text-align:center"><a  href="javascript:void(0)" onclick="location.href=location.href">Continue</a></p>
                       </div>';

    }
    function AproveMemberAddressProof() {

            global $mysql,$mail,$loginInfo;      
       
                $data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   

                $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   

             $mContent = $mysql->select("select * from `mailcontent` where `Category`='AddressProofApproved'");
             $content  = str_replace("#MemberName#",$member[0]['MemberName'],$mContent[0]['Content']);

             MailController::Send(array("MailTo"   => $member[0]['EmailID'],
                                        "Category" => "AddressProofApproved",
                                        "MemberID" => $member[0]['MemberID'],
                                        "Subject"  => $mContent[0]['Title'],
                                        "Message"  => $content),$mailError);
             MobileSMSController::sendSMS($member[0]['MobileNumber'],"Your Address Proof Approved"); 

           $mysql->execute("update _tbl_member_documents set IsVerified='1',ApproveRemarks='".$_POST['AddressProofApproveRemarks']."',
                                                 VerifiedOn='".date("Y-m-d H:i:s")."' where  DocID='".$data[0]['DocID']."'");

         return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">successfully Approved. </h5>
                            <p style="text-align:center"><a  href="javascript:void(0)" onclick="location.href=location.href">Continue</a></p>
                       </div>';

    }
    function RejectMemberIDProof() {

            global $mysql,$mail,$loginInfo;      
       
                $data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   

                $member= $mysql->select("Select * from `_tbl_members` where `MemberID`='".$data[0]['MemberID']."'");   
                
                if (!(strlen(trim($_POST['RejectRemarks']))>0)) {
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
                                                             RejectedOn='".date("Y-m-d H:i:s")."'
                                                             RejectedRemarks='".$_POST['RejectRemarks']."',
                                                             IsVerified='1',
                                                             VerifiedOn='".date("Y-m-d H:i:s")."' where  DocID='".$data[0]['DocID']."'");

         return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">successfully Approved. </h5>
                            <p style="text-align:center"><a  href="javascript:void(0)" onclick="location.href=location.href">Continue</a></p>
                       </div>';

    }
    function RejectMemberAddressProof() {

            global $mysql,$mail,$loginInfo;      
       
                $data = $mysql->select("Select * from `_tbl_member_documents` where `DocID`='".$_POST['DocID']."'");   

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
                                                             RejectedRemarks='".$_POST['AddressProofRejectRemarks']."',
                                                             RejectedOn='".date("Y-m-d H:i:s")."',
                                                             IsVerified='1',
                                                             VerifiedOn='".date("Y-m-d H:i:s")."' where  DocID='".$data[0]['DocID']."'");

         return '<div style="background:white;width:100%;padding:20px;height:100%;">
                            <p style="text-align:center"><img src="'.AppPath.'assets/images/verifiedtickicon.jpg" width="10%"><p>
                            <h5 style="text-align:center;color:#ada9a9">successfully Approved. </h5>
                            <p style="text-align:center"><a  href="javascript:void(0)" onclick="location.href=location.href">Continue</a></p>
                       </div>';

    }
    
    
    function GetDraftProfileInfo() {
               
                global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_draft_profiles` where ProfileCode='".$_POST['ProfileCode']."'");               
            
            
               $result =  Profiles::getDraftProfileInformationforAdmin($Profiles[0]['ProfileCode']);
               return Response::returnSuccess("success",$result);
           }
    function GetPublishedProfiles() {
           global $mysql;    
             $sql = "SELECT *
                                    FROM _tbl_profiles
                                    LEFT  JOIN _tbl_members
                                    ON _tbl_profiles.CreatedBy=_tbl_members.MemberID";

             if (isset($_POST['Request']) && $_POST['Request']=="Publish") {
                return Response::returnSuccess("success",$mysql->select($sql."  WHERE _tbl_profiles.IsApproved='1'"));    
             }
         }
    function GetPublishProfileInfo() {
               
                global $mysql,$loginInfo;      
             $Profiles = $mysql->select("select * from `_tbl_profiles` where ProfileCode='".$_POST['ProfileCode']."'");               
            
            
               $result =  Profiles::getProfileInformationforAdmin($Profiles[0]['ProfileCode']);
               return Response::returnSuccess("success",$result);
           }

    }
?>