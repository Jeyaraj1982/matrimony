<?php
    session_start();
    define("SiteUrl","http://nahami.online/sl/Dashboard/");
    define("ImageUrl","http://nahami.online/sl/Dashboard/assets/images/");
    define("SITE_TITLE","Matrimony") ;
    
    if (isset($_GET['action']) && $_GET['action']=="logout") {
         unset($_SESSION);
         session_destroy();
         sleep(3);
         header("Location:".$_GET['redirect']);
    }
    
    function printDateTime($dateTime) {
        return date("M d, Y H",strtotime($dateTime));
    }
    
    function printDate($date) {
        return date("M d, Y ",strtotime($date));
    }
    
    
    
    class Franchisee  {
        
        function GetDetails($FranchiseeCode) {
            global $mysql;
           $data =  $mysql->select("select * from _tbl_franchisees Where FranchiseeCode='".$FranchiseeCode."'"); 
           return json_encode($data[0]);
         }
        
        function GetNextStaffNumber() {
            
            global $mysql,$_Franchisee;
        
            $prefix = "FS";
            $Rows = $mysql->select("select * from _tbl_franchisees_staffs Where ReferedBy='".$_Franchisee['FranchiseeID']."'");
        
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
    
   
    
    class Paypal  {
        
        function GetNextPaypalNumber() {
            
            global $mysql;
        
            $prefix = "PAL";
            $Rows = $mysql->select("select * from _tbl_settings_paypal");
        
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
    
    class MobileSMS{
        
        function GetNextMobileSMSNumber() {
            
            global $mysql;
        
            $prefix = "SMS";
            $Rows = $mysql->select("select * from _tbl_settings_mobilesms");
        
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
    
    class Admin{
        
        function GetNextAdminStaffNumber() {
            
            global $mysql;
        
            $prefix = "AS";
            $Rows = $mysql->select("select * from _tbl_admin_staffs");
        
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
    class MemberPlan{
        
        function GetNextMemberPlanNumber() {
            
            global $mysql;
        
            $prefix = "PLN";
            $Rows = $mysql->select("select * from _tbl_member_plan");
        
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
  
    class MemberNews{
        
        function GetNextMemberNewsNumber() {
            
            global $mysql;
        
            $prefix = "NE";
            $Rows = $mysql->select("select * from _tbl_franchisees_news");
        
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
     
    
    function GetUrl($Param) {
       return SiteUrl.$Param;
       return SiteUrl.UserRole."/".$Param;
    }
   
    function putDateTime($dateTime) {
        return date("M d, Y H:i",strtotime($dateTime));
        
    }
    function putDate($date) {
        return date("M d, Y",strtotime($date));
        
    }
    if (isset($_SESSION['UserDetails']) && ($_SESSION['UserDetails']['FranchiseeID']>0)) {
        $_Franchisee = $_SESSION['UserDetails'];
        $_FranchiseeInfo = $_SESSION['FranchiseeDetails'];
    }  
    
    if (isset($_SESSION['AdminDetails']) && ($_SESSION['AdminDetails']['AdminID']>0)) {
        $_Admin = $_SESSION['AdminDetails'];
    }
    
    if (isset($_SESSION['MemberDetails']) && ($_SESSION['MemberDetails']['MemberID']>0)) {
        $_Member = $_SESSION['MemberDetails'];
    }
   
   if ($_Admin['AdminID']>0) {
        define("UserRole","Admin");
        
    } 
    if ($_Franchisee['FranchiseeID']>0) {
        define("UserRole","Franchisee");     
    }
    if ($_Member['MemberID']>0) {
        define("UserRole","Member");     
    }
    
    
    $loginID = "";
    
    if (isset($_Franchisee['LoginID'])) {
        $loginID = $_Franchisee['LoginID'];
    }  else if (isset($_Member['LoginID'])) {
        $loginID = $_Member['LoginID'];
    }  else {
        $loginID = $_Admin['LoginID'];
    }
    
    class Webservice {
        
        var $serverURL="http://nahami.online/sl/Webservice/webservice.php?rand=2&";
        
        function Webservice() {
            global $loginID;
            $this->serverURL .= "LoginID=".$loginID."&"; 
        }
        
        function Login($param) {
              return json_decode($this->_callUrl("Login",$param),true);
        }
        
        function FLogin($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=Login",$param),true);
        }
         function FranchiseeInfo($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMyProfile",$param),true);
        }
        function CreateMember($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=CreateMember",$param),true);
        }
        function GetMemberCode($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMemberCode",$param),true);
        }
        function GetMyMembers($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMyMembers",$param),true);
        }
        function GetMyActiveMembers($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMyActiveMembers",$param),true);
        }
        function GetMyDeactiveMembers($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMyDeactiveMembers",$param),true);
        }
        function GetMemberDetails($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetMemberDetails",$param),true);
        }
        function EditMember($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=EditMember",$param),true);
        }
        function SearchMemberDetails($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=SearchMemberDetails",$param),true);
        }
        function RefillWallet($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=RefillWallet",$param),true);
        }
        function ResetPassword($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=ResetPassword",$param),true);
        }
        function GetManageStaffs($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetManageStaffs",$param),true);
        }
        function CreateFranchiseeStaff($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=CreateFranchiseeStaff",$param),true);
        }
        function GetFranchiseeStaffCodeCode($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetFranchiseeStaffCodeCode",$param),true);
        }
        function EditFranchiseeStaff($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=EditFranchiseeStaff",$param),true);
        }
        function GetStaffs($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=GetStaffs",$param),true);
        }
        function ChangePassword($param) {
              return json_decode($this->_callUrl("m=Franchisee&a=ChangePassword",$param),true);
        }
        function GetMyDraftProfiles($param) {
              return json_decode($this->_callUrl("m=Member&a=GetMyDraftProfiles",$param),true);
        }
        function GetMemberInfo($param) {
              return json_decode($this->_callUrl("m=Member&a=GetMemberInfo",$param),true);
        }
        function WelcomeMessage($param) {
              return json_decode($this->_callUrl("m=Member&a=WelcomeMessage",$param),true);
        }
        function GetCodeMasterDatas($param) {
              return json_decode($this->_callUrl("m=Member&a=GetCodeMasterDatas",$param),true);
        }
        function CreateProfile($param) {
              return json_decode($this->_callUrl("m=Member&a=CreateProfile",$param),true);
        }
        function EditProfile($param) {
              return json_decode($this->_callUrl("m=Member&a=EditProfile",$param),true);
        }
        function editprofileviewinfo($param) {
              return json_decode($this->_callUrl("m=Member&a=editprofileviewinfo",$param),true);
        }
        function GetMyEmails($param) {
              return json_decode($this->_callUrl("m=Member&a=GetMyEmails",$param),true);
        }
        function MemberChangePassword($param) {
              return json_decode($this->_callUrl("m=Member&a=MemberChangePassword",$param),true);
        }
        function GetAdvancedSearchElements($param) {
              return json_decode($this->_callUrl("m=Member&a=GetAdvancedSearchElements",$param),true);
        }
        function GetBasicSearchElements($param) {
              return json_decode($this->_callUrl("m=Member&a=GetBasicSearchElements",$param),true);
        }
        function EditMemberInfo($param) {
              return json_decode($this->_callUrl("m=Member&a=EditMemberInfo",$param),true);
        }
        function SaveBasicSearch($param) {
              return json_decode($this->_callUrl("m=Member&a=SaveBasicSearch",$param),true);
        }
        function updateProfilePhoto($param) {
              return json_decode($this->_callUrl("m=Member&a=updateProfilePhoto",$param),true);
        }
        function AdminLogin($param) {
              return json_decode($this->_callUrl("m=Admin&a=AdminLogin",$param),true);
        }
        function AdminChangePassword($param) {
              return json_decode($this->_callUrl("m=Admin&a=AdminChangePassword",$param),true);
        }
        function CreateFranchisee($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateFranchisee",$param),true);
        }
        function GetFranchiseeCode($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseeCode",$param),true);
        }
        function GetManageFranchisee($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageFranchisee",$param),true);
        }
        function GetManageActiveFranchisee($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveFranchisee",$param),true);
        }
        function GetManageDeactiveFranchisee($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveFranchisee",$param),true);
        }
        function GetFranchiseeInfo($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseeInfo",$param),true);
        }
        function GetFranchiseePrimaryAccountDetails($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseePrimaryAccountDetails",$param),true);
        }
        function GetFranchiseeStaffProfileInfo($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseeStaffProfileInfo",$param),true);
        }
        function EditFranchisee($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditFranchisee",$param),true);
        }
        function GetManagePlans($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManagePlans",$param),true);
        }
        function GetManageActivePlans($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActivePlans",$param),true);
        }
        function GetManageDeactivePlans($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactivePlans",$param),true);
        }
        function GetNextFranchiseePlanNumber($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetNextFranchiseePlanNumber",$param),true);
        }
        function CreateFranchiseePlan($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateFranchiseePlan",$param),true);
        }
        function EditFranchiseePlan($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditFranchiseePlan",$param),true);
        }
        function GetFranchiseePlanInfo($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseePlanInfo",$param),true);
        }
        function GetFranchiseeRefillWalletManage($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseeRefillWalletManage",$param),true);
        }
        function GetFranchiseeManageNewsandEvents($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetFranchiseeManageNewsandEvents",$param),true);
        }
        function GetMastersManageDetails($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetMastersManageDetails",$param),true);
        }
        function GetManageActiveReligionNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveReligionNames",$param),true);
        }
        function GetManageDeactiveReligionNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveReligionNames",$param),true);
        }
        function CreateReligionName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateReligionName",$param),true);
        }
        function EditReligionName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditReligionName",$param),true);
        }
        function GetMasterAllViewInfo($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetMasterAllViewInfo",$param),true);
        }
        function GetManageActiveCasteNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveCasteNames",$param),true);
        }
        function GetManageDeactiveCasteNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveCasteNames",$param),true);
        }
        function CreateCasteName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateCasteName",$param),true);
        }
        function EditCasteName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditCasteName",$param),true);
        }
        function GetManageActiveStarNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveStarNames",$param),true);
        }
        function GetManageDeactiveStarNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveStarNames",$param),true);
        }
        function CreateStarName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateStarName",$param),true);
        }
        function EditStarName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditStarName",$param),true);
        }
        function GetManageActiveNationalityNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveNationalityNames",$param),true);
        }
        function GetManageDeactiveNationalityNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveNationalityNames",$param),true);
        }
        function CreateNationalityName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateNationalityName",$param),true);
        }
        function EditNationalityName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditNationalityName",$param),true);
        }
        function GetManageActiveIncomeRanges($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveIncomeRanges",$param),true);
        }
        function GetManageDeactiveIncomeRanges($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveIncomeRanges",$param),true);
        }
        function CreateIncomeRange($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateIncomeRange",$param),true);
        }
        function EditIncomeRange($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditIncomeRange",$param),true);
        }
        function GetManageActiveCountryNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveCountryNames",$param),true);
        }
        function GetManageDeactiveCountryNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveCountryNames",$param),true);
        }
        function CreateCountryName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateCountryName",$param),true);
        }
        function EditCountryName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditCountryName",$param),true);
        }
        function GetManageActiveDistrictNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveDistrictNames",$param),true);
        }
        function GetManageDeactiveDistrictNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveDistrictNames",$param),true);
        }
        function CreateDistrictName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateDistrictName",$param),true);
        }
        function EditDistrictName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditDistrictName",$param),true);
        }
        function GetManageActiveStateNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveStateNames",$param),true);
        }
        function GetManageDeactiveStateNames($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveStateNames",$param),true);
        }
        function CreateStateName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateStateName",$param),true);
        }
        function EditStateName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditStateName",$param),true);
        }
        function GetManageActiveProfileSignInFors($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveProfileSignInFors",$param),true);
        }
        function GetManageDeactiveProfileSignInFors($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveProfileSignInFors",$param),true);
        }
        function CreateProfileSignInFor($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateProfileSignInFor",$param),true);
        }
        function EditProfileSignInFor($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditProfileSignInFor",$param),true);
        }
        function CreateLanguageName($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateLanguageName",$param),true);
        }
        function EditLanguageName($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditLanguageName",$param),true);
        }
        function CreateEmailApi($param) {
              return json_decode($this->_callUrl("m=Admin&a=CreateEmailApi",$param),true);
        }
        function GetEmailApiCode($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetEmailApiCode",$param),true);
        }
        function GetManageEmailApi($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageEmailApi",$param),true);
        }
        function GetManageActiveEmailApi($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageActiveEmailApi",$param),true);
        }
        function GetManageDeactiveEmailApi($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetManageDeactiveEmailApi",$param),true);
        }
        function GetEmailApiInfo($param) {
              return json_decode($this->_callUrl("m=Admin&a=GetEmailApiInfo",$param),true);
        }
        function EditEmailApi($param) {
              return json_decode($this->_callUrl("m=Admin&a=EditEmailApi",$param),true);
        }
        
         
        
        
   function _callUrl($method,$param) {
        
            
            $postvars = '';
            foreach($param as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            foreach($_GET as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->serverURL.$method."&User=".$_SESSION['UserData']['MemberID']);
            
            curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 200);
            $response = curl_exec($ch);
            curl_close ($ch);
            return $response;
        }
    }
    
    $webservice = new Webservice($loginID);
?>
