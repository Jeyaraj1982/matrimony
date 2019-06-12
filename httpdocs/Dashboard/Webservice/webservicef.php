<?php
    // include_once("config.php");
    include_once("DatabaseController.php");
    $mysql = new MySql("localhost","nahami_user","nahami_user","nahami_masterdb");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../lib/mail/src/Exception.php';
    require '../lib/mail/src/PHPMailer.php';
    require '../lib/mail/src/SMTP.php';
    $mail = new PHPMailer;

    include_once("Dashboard/controllers/la-en.php");
    include_once("MailController.php");  
    include_once("MobileSMSController.php");  

    if (isset($_GET['action'])) {
       echo json_encode($_GET['action']()); 
    } else {
       $obj = new $_GET['m']();
       echo $obj->$_GET['a']();
    }     

    function returnError($message) {
        return array("status"=>"failed","message"=>$message);
    }
    
    function returnSuccess($message,$data) {
        return array("status"=>"success","message"=>$message,"data"=>$data);
    }
        
    function FranchiseeLogin() {
        
        global $mysql;
        
        if (!(strlen(trim($_POST['UserName']))>0)) {
        return returnError("Please enter username ");
        }
        if (!(strlen(trim($_POST['Password']))>0)) {
        return returnError("Please enter password ");
        }
        
        $data=$mysql->select("select * from _tbl_franchisees_staffs where LoginName='".$_POST['UserName']."' and LoginPassword='".$_POST['Password']."'") ;
        if (sizeof($data)>0) {
            
            $loginid = $mysql->insert("_tbl_franchisee_login",array("LoginOn"   => date("Y-m-d H:i:s"),
                                                                "FranchiseeID"  => $data[0]['FranchiseeID']));
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