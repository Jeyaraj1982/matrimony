<?php 
    
class Admin {
    
	function AdminLogin() {
            
            global $mysql;  
        
            if (!(strlen(trim($_POST['UserName']))>0)) {
                return Response::returnError("Please enter username ");
            }
            
            if (!(strlen(trim($_POST['Password']))>0)) {
                return Response::returnError("Please enter password ");
            }
        
            $data=$mysql->select("select * from _tbl_admin where AdminLogin='".$_POST['UserName']."' and AdminPassword='".$_POST['Password']."'") ;
            
            if (sizeof($data)>0) {
                
                $loginid = $mysql->insert("_tbl_admin_login",array("LoginOn"      => date("Y-m-d H:i:s"),
                                                                   "AdminID" => $data[0]['AdminID']));
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
                                                           "CountryName"    => CodeMaster::GetCountryName(),
                                                           "StateName"      => CodeMaster::GetStateName(),
                                                           "DistrictName"   => CodeMaster::GetDistrictName(),
                                                           "BankName"       => CodeMaster::GetAvailableBankName(),
                                                           "AccountType"    => CodeMaster::GetAccountType(),
                                                           "Gender"         => CodeMaster::GetGender()));
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
        if ($_POST['CountryName']=="0") {
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
                                                       "CountryNames"        => CodeMaster::GetCountryName(),
                                                       "StateName"          => CodeMaster::GetStateName(),
                                                       "DistrictName"       => CodeMaster::GetDistrictName(),
                                                       "BankNames"          => CodeMaster::GetAvailableBankName(),
                                                       "AccountType"        => CodeMaster::GetAccountType(),
                                                       "PrimaryBankAccount" => $PrimaryBankAccount[0],
                                                       "Gender"             => CodeMaster::GetGender()));
                                                            
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
                                                           "ReligionNames"       => CodeMaster::GetReligion(),
                                                           "CasteCode"           => SeqMaster::GetNextCode('CASTNAMES'),
                                                           "CasteNames"          => CodeMaster::GetCaste(),
                                                           "StarCode"            => SeqMaster::GetNextCode('STARNAMES'),
                                                           "StarNames"           => CodeMaster::GetStarName(),
                                                           "NationalityNameCode" => SeqMaster::GetNextCode('NATIONALNAMES'),
                                                           "NationalityNames"    => CodeMaster::GetNationality(),
                                                           "IncomeRangeCode"     => SeqMaster::GetNextCode('INCOMERANGE'),
                                                           "IncomeRange"         => CodeMaster::GetIncomeRange(),
                                                           "CountryCode"         => SeqMaster::GetNextCode('CONTNAMES'),
                                                           "CountryName"         => CodeMaster::GetCountryName(),
                                                           "DistrictCode"        => SeqMaster::GetNextCode('DISTNAMES'),
                                                           "DistrictName"        => CodeMaster::GetDistrictName(),
                                                           "StateCode"           => SeqMaster::GetNextCode('STATNAMES'),
                                                           "StateName"           => CodeMaster::GetStateName(),
                                                           "ProfileSignInForCode"=> SeqMaster::GetNextCode('PROFILESIGNIN'),
                                                           "ProfileSignInFor"    => CodeMaster::GetProfileFor(),
                                                           "LanguageNameCode"    => SeqMaster::GetNextCode('LANGUAGENAMES'),
                                                           "LanguageName"        => CodeMaster::GetLanguage()));    
    }                                                                          
    function GetManageActiveReligionNames() {
           global $mysql;    
              $ReligionNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and IsActive='1'");
                return Response::returnSuccess("success",$ReligionNames);
    }
    function GetManageDeactiveReligionNames() {
           global $mysql;    
              $ReligionNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='RELINAMES' and IsActive='0'");
                return Response::returnSuccess("success",$ReligionNames);
    }
    function CreateReligionName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='RELINAMES' and SoftCode='".trim($_POST['ReligionCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Religion Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='RELINAMES' and CodeValue='".trim($_POST['ReligionName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Religion Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"  => "RELINAMES",
                                                            "SoftCode"  => trim($_POST['ReligionCode']),
                                                            "CodeValue" => trim($_POST['ReligionName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function GetMasterAllViewInfo(){
        
        global $mysql;
        
        $ViewInfo = $mysql->select("select * from _tbl_master_codemaster where SoftCode='".$_POST['Code']."'");
        return Response::returnSuccess("success",array("ViewInfo" => $ViewInfo[0]));
                                                            
    }
    function EditReligionName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ReligionName']."' and  HardCode='RELINAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Religion Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['ReligionName']."',IsActive='".$_POST['IsActive']."' where HardCode='RELINAMES' and SoftCode='".$_POST['Code']."'");
    
              
                return Response::returnSuccess("success",array());
                                                            
    }
    function GetManageActiveCasteNames() {
           global $mysql;    
              $CasteNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$CasteNames);
    }
    function GetManageDeactiveCasteNames() {
           global $mysql;    
              $CasteNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CASTNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$CasteNames);
    }
    function CreateCasteName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and SoftCode='".trim($_POST['CasteCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Caste Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CASTNAMES' and CodeValue='".trim($_POST['CasteName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Caste Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "CASTNAMES",
                                                            "SoftCode"   => trim($_POST['CasteCode']),
                                                            "CodeValue"  => trim($_POST['CasteName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditCasteName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['CasteName']."' and  HardCode='CASTNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Caste Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['CasteName']."',IsActive='".$_POST['IsActive']."' where HardCode='CASTNAMES' and  SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveStarNames() {
           global $mysql;    
              $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$StarNames);
    }
    function GetManageDeactiveStarNames() {
           global $mysql;    
              $StarNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STARNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$StarNames);
    }
    function CreateStarName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and SoftCode='".trim($_POST['StarCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Star Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STARNAMES' and CodeValue='".trim($_POST['StarName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Star Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "STARNAMES",
                                                            "SoftCode"   => trim($_POST['StarCode']),
                                                            "CodeValue"  => trim($_POST['StarName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditStarName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['StarName']."' and  HardCode='STARNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Star Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['StarName']."',IsActive='".$_POST['IsActive']."' where HardCode='STARNAMES' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveNationalityNames() {
           global $mysql;    
              $NationalityNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$NationalityNames);
    }
    function GetManageDeactiveNationalityNames() {
           global $mysql;    
              $NationalityNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='NATIONALNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$NationalityNames);
    }
    function CreateNationalityName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='NATIONALNAMES' and SoftCode='".trim($_POST['NationalityCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Nationality Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='NATIONALNAMES' and CodeValue='".trim($_POST['NationalityName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Nationality Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"     => "NATIONALNAMES",
                                                            "SoftCode"     => trim($_POST['NationalityCode']),
                                                            "CodeValue"    => trim($_POST['NationalityName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditNationalityName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['NationalityName']."' and  HardCode='NATIONALNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Nationality Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['NationalityName']."',IsActive='".$_POST['IsActive']."' where HardCode='NATIONALNAMES' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveIncomeRanges() {
           global $mysql;    
              $IncomeRanges = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and IsActive='1'");
                return Response::returnSuccess("success",$IncomeRanges);
    }
    function GetManageDeactiveIncomeRanges() {
           global $mysql;    
              $IncomeRanges = $mysql->select("select * from _tbl_master_codemaster Where HardCode='INCOMERANGE' and IsActive='0'");
                return Response::returnSuccess("success",$IncomeRanges);
    }
    function CreateIncomeRange() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and SoftCode='".trim($_POST['IncomeRangeCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Income Range Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='INCOMERANGE' and CodeValue='".trim($_POST['IncomeRange'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Income Range Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "INCOMERANGE",
                                                            "SoftCode"   => trim($_POST['IncomeRangeCode']),
                                                            "CodeValue"  => trim($_POST['IncomeRange'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditIncomeRange(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['IncomeRange']."' and  HardCode='INCOMERANGE' and  SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("IncomeRange Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['IncomeRange']."',IsActive='".$_POST['IsActive']."' where HardCode='INCOMERANGE' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveCountryNames() {
           global $mysql;    
              $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$CountryNames);
    }
    function GetManageDeactiveCountryNames() {
           global $mysql;    
              $CountryNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='CONTNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$CountryNames);
    }
    function CreateCountryName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and SoftCode='".trim($_POST['CountryCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Country Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and CodeValue='".trim($_POST['CountryName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Country Name Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".trim($_POST['STDCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Country STD Code Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "CONTNAMES",
                                                            "SoftCode"   => trim($_POST['CountryCode']),
                                                            "CodeValue"  => trim($_POST['CountryName']),
                                                            "ParamA"     => trim($_POST['STDCode']),
                                                            "ParamB"     => trim($_POST['CurrencyString']),
                                                            "ParamC"     => trim($_POST['CurrencySubString']),
                                                            "ParamD"     => trim($_POST['CurrencyShortString'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    } 
    function EditCountryName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['CountryName']."' and  HardCode='CONTNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Country Name Already Exists");    
              }
              $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='CONTNAMES' and ParamA='".$_POST['STDCode']."' and  HardCode='CONTNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Country STD Code Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['CountryName']."',
                                                                 IsActive='".$_POST['IsActive']."',
                                                                 ParamA='".$_POST['STDCode']."',
                                                                 ParamB='".$_POST['CurrencyString']."',
                                                                 ParamC='".$_POST['CurrencySubString']."',
                                                                 ParamD='".$_POST['CurrencyShortString']."' where HardCode='CONTNAMES' and SoftCode='".$_POST['Code']."'");
            $sql="update _tbl_master_codemaster set CodeValue='".$_POST['CountryName']."',
                                                                 IsActive='".$_POST['IsActive']."',
                                                                 ParamA='".$_POST['STDCode']."',
                                                                 ParamB='".$_POST['CurrencyString']."',
                                                                 ParamC='".$_POST['CurrencySubString']."',
                                                                 ParamD='".$_POST['CurrencyShortString']."' where HardCode='CONTNAMES' and SoftCode='".$_POST['Code']."'";
              return Response::returnSuccess("success".$sql,array());
    }
    function GetManageActiveDistrictNames() {
           global $mysql;    
              $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$DistrictNames);
    }
    function GetManageDeactiveDistrictNames() {
           global $mysql;    
              $DistrictNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='DISTNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$DistrictNames);
    }
    function CreateDistrictName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and SoftCode='".trim($_POST['DistrictCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("District Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='DISTNAMES' and CodeValue='".trim($_POST['DistrictName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("District Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"    => "DISTNAMES",
                                                            "SoftCode"    => trim($_POST['DistrictCode']),
                                                            "CodeValue"   => trim($_POST['DistrictName']),
                                                            "ParamA"      => trim($_POST['StateName']),
                                                            "ParamB"      => trim($_POST['CountryName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditDistrictName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['DistrictName']."' and  HardCode='DISTNAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("District Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['DistrictName']."',ParamA='".$_POST['StateName']."',ParamB='".$_POST['CountryName']."',IsActive='".$_POST['IsActive']."' where HardCode='DISTNAMES' and  SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveStateNames() {
           global $mysql;    
              $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and IsActive='1'");
                return Response::returnSuccess("success",$StateNames);
    }
    function GetManageDeactiveStateNames() {
           global $mysql;    
              $StateNames = $mysql->select("select * from _tbl_master_codemaster Where HardCode='STATNAMES' and IsActive='0'");
                return Response::returnSuccess("success",$StateNames);
    }
    function CreateStateName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and SoftCode='".trim($_POST['StateCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("State Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='STATNAMES' and CodeValue='".trim($_POST['StateName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("State Name Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"     => "STATNAMES",
                                                            "SoftCode"     => trim($_POST['StateCode']),
                                                            "CodeValue"    => trim($_POST['StateName']),
                                                            "ParamA"       => trim($_POST['CountryName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditStateName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['StateName']."' and  HardCode='STATNAMES' and  SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("State Name Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['StateName']."',IsActive='".$_POST['IsActive']."' where HardCode='STATNAMES' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function GetManageActiveProfileSignInFors() {
           global $mysql;    
              $ProfileSignInFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN' and IsActive='1'");
                return Response::returnSuccess("success",$ProfileSignInFors);
    }
    function GetManageDeactiveProfileSignInFors() {
           global $mysql;    
              $ProfileSignInFors = $mysql->select("select * from _tbl_master_codemaster Where HardCode='PROFILESIGNIN' and IsActive='0'");
                return Response::returnSuccess("success",$ProfileSignInFors);
    }
    function CreateProfileSignInFor() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='PROFILESIGNIN' and SoftCode='".trim($_POST['ProfileSigninForCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("ProfileSigninFor Code Already Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='PROFILESIGNIN' and CodeValue='".trim($_POST['ProfileSigninFor'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("ProfileSigninFor Already Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "PROFILESIGNIN",
                                                            "SoftCode"   => trim($_POST['ProfileSigninForCode']),
                                                            "CodeValue"  => trim($_POST['ProfileSigninFor'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }
    function EditProfileSignInFor(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['ProfileSigninFor']."' and  HardCode='PROFILESIGNIN' and   SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("ProfileSigninFor Already Exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['ProfileSigninFor']."',IsActive='".$_POST['IsActive']."' where HardCode='PROFILESIGNIN' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
    function CreateLanguageName() {
                                                                            
        global $mysql;  
       
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and SoftCode='".trim($_POST['LanguageNameCode'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Language Name Code Alreay Exists");
        }
        $data = $mysql->select("select * from  _tbl_master_codemaster where HardCode='LANGUAGENAMES' and CodeValue='".trim($_POST['LanguageName'])."'");
        if (sizeof($data)>0) {
            return Response::returnError("Language Name Alreay Exists");
        }
       $id =  $mysql->insert("_tbl_master_codemaster",array("HardCode"   => "LANGUAGENAMES",
                                                            "SoftCode"   => trim($_POST['LanguageNameCode']),
                                                            "CodeValue"  => trim($_POST['LanguageName'])));
          
        if (sizeof($id)>0) {
                return Response::returnSuccess("success",array());
            } else{
                return Response::returnError("Access denied. Please contact support");   
            }
    }  
    function EditLanguageName(){  
        
              global $mysql;     
              
              $data = $mysql->select("select * from _tbl_master_codemaster where  CodeValue='".$_POST['LanguageName']."' and  HardCode='LANGUAGENAMES' and SoftCode<>'".$_POST['Code']."'");
              if (sizeof($data)>0) {
                    return Response::returnError("Language Name already exists");    
              }
              $mysql->execute("update _tbl_master_codemaster set CodeValue='".$_POST['LanguageName']."',IsActive='".$_POST['IsActive']."' where HardCode='LANGUAGENAMES' and SoftCode='".$_POST['Code']."'");
              return Response::returnSuccess("success",array());
    }
}                        
?>