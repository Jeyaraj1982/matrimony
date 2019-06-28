<?php
    define("ImagePath","http://nahami.online/sl/Dashboard/assets/images/");
    define("AdminFranchise",32);
   
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/mail/src/Exception.php';
    require 'lib/mail/src/PHPMailer.php';
    require 'lib/mail/src/SMTP.php';
    
    $mail    = new PHPMailer;
    
    include_once("la-en.php");
    
    include_once("controller/MailController.php");  
    include_once("controller/MobileSMSController.php");  
    include_once("controller/DatabaseController.php");
    include_once("controller/MasterController.php");
    include_once("controller/SequenceController.php");
    include_once("controller/ResponseController.php");
    
    include_once("classes/class.Franchisee.php");
    include_once("classes/class.Member.php");
    include_once("classes/class.Admin.php");
    
    $mysql   = new MySql("localhost","nahami_user","nahami_user","nahami_masterdb");
    $loginid = isset($_GET['LoginID']) ? $_GET['LoginID'] : "";
      
    if (isset($_GET['m']) && $_GET['m']=="Franchisee") {
       $loginInfo = $mysql->select("Select * from _tbl_franchisee_login where LoginID='".$loginid."'"); 
    }  else if (isset($_GET['m']) && $_GET['m']=="Member") { 
        $loginInfo = $mysql->select("Select * from _tbl_member_login where LoginID='".$loginid."'");    
    } else {
       $loginInfo = $mysql->select("Select * from _tbl_admin_login where LoginID='".$loginid."'");
    }
    
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
     
    class Plans{
        function GetFranchiseePlans(){
            global $mysql;
            $franchiseePlans=$mysql->select("select * from _tbl_franchisees_plans where IsActive='1'");
            
            return $franchiseePlans;
            return Response::returnSuccess("success",$franchiseePlan[0]);
        }
    }
    
    class Validation {
        
        function isEmail($email) {
            if (!preg_match("/^[^@]{1,64}@[^@]{1,255}$/", $email)) {
                return false;
            }
            return true;
        }
    }
?>