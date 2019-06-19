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
    
    function GetNextNumber($SoftCode) {
        
        global $mysql;
        
        $Table = $mysql->select("select * from _tbl_master_codemaster Where SoftCode='".$SoftCode."'");
        $no = $Table[0]['ParamA'];
        
        $Rows = $mysql->select("select * from _tbl_master_codemaster Where HardCode='".$SoftCode."'");
        $nextNumber = sizeof($Rows)+1;
         
        if ($Table[0]['ParamB']==1) {
            $no .= $nextNumber+1; 
        }
        
        if ($Table[0]['ParamB']==2) {
            
            if (strlen($nextNumber)==1) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= $nextNumber; 
            }
        }
        
        if ($Table[0]['ParamB']==3) {
            
            if (strlen($nextNumber)==1) {
               $no .= "00".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==3) {
               $no .= $nextNumber; 
            }
        }
        
        if ($Table[0]['ParamB']==4) {
            
            if (strlen($nextNumber)==1) {
               $no .= "000".$nextNumber; 
            }
            if (strlen($nextNumber)==2) {
               $no .= "00".$nextNumber; 
            }
            if (strlen($nextNumber)==3) {
               $no .= "0".$nextNumber; 
            }
            if (strlen($nextNumber)==4) {
               $no .= $nextNumber; 
            }
        }
        return $no;
    
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
    
    class FranchiseeCode  {
        
        function GetNextFranchiseeNumber() {
            
            global $mysql,$_Franchisee;
        
            $prefix = "FR";
            $Rows = $mysql->select("select * from _tbl_franchisees");
        
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
    
    class Plan{
        
        function GetNextPlanNumber() {
            
            global $mysql;
        
            $prefix = "PLN";
            $Rows = $mysql->select("select * from _tbl_franchisees_plans");
        
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
    
    class EmailApi{
        
        function GetNextEmailApiNumber() {
            
            global $mysql;
        
            $prefix = "API";
            $Rows = $mysql->select("select * from _tbl_settings_emailapi");
        
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
    
    
    $loginID = isset($_Franchisee['LoginID']) ? $_Franchisee['LoginID'] : 0;
    
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
             function GetProfiles($param) {
              return json_decode($this->_callUrl("GetProfiles",$param),true);
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
