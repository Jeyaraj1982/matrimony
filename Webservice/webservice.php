<?php  
    include_once("config_client.php");
    
    $cdata=json_decode(json_encode(array('TimeZone'        => "Asia/Kolkata",
                                         'DateFormat'      => "",
                                         'Language'        => "la-en",
                                         'DateTimeFormat'  => "")));
              
    date_default_timezone_set($cdata->TimeZone);
       
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__.'/lib/mail/src/Exception.php';
    require __DIR__.'/lib/mail/src/PHPMailer.php';
    require __DIR__.'/lib/mail/src/SMTP.php';
     
    $mail    = new PHPMailer;
  function reInitMail() {
global $mail;
 $mail    = new PHPMailer;
  }	  
    include_once($cdata->Language.".php");
    
    class J2JApplication {
        
        function get_client_ip_server() {
            $ipaddress = '';
            if ($_SERVER['HTTP_CLIENT_IP'])
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            else if($_SERVER['HTTP_X_FORWARDED_FOR'])
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            else if($_SERVER['HTTP_X_FORWARDED'])
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            else if($_SERVER['HTTP_FORWARDED_FOR'])
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            else if($_SERVER['HTTP_FORWARDED'])
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            else if($_SERVER['REMOTE_ADDR'])
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            else
                $ipaddress = '0.0.0.0';
            return $ipaddress;
        }
        
        function GetIPDetails($qry) {
            
            $qry = json_decode(base64_decode($qry),true);
            
            $response = json_decode($this->_callUrl("http://ip-api.com/json/".$qry['IPAddress'],array()),true);
            $useragent=$qry['UserAgent'];
            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) { 
                $response['Device']="Mobile";
            }else{
                $response['Device']="Desktop";
            }
            $response['UserAgent']=$useragent;
            return $response;
            /* 
            reference 
            http://ip-api.com/docs/api:serialized_php
            http://ip-api.com/php/24.48.0.1
            {"query": "24.48.0.1","status": "success","country": "Canada","countryCode": "CA","region": "QC","regionName": "Quebec","city": "Saint-Leonard","zip": "H1R","lat": 45.58330154418945,"lon": -73.5999984741211,"timezone": "America/Toronto","isp": "Le Groupe Videotron Ltee","org": "Videotron Ltee","as": "AS5769 Videotron Telecom Ltee"}
            */
        }
    
        function _callUrl($url,$param) {
            
            $postvars = '';
            foreach($param as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST, 1);                 
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 200);
            $response = curl_exec($ch);
            curl_close ($ch);
            return $response;
        }
        
        function hideMobileNumberWithCharacters($mobileNumber,$char="*") {
            
            $times=strlen(trim(substr($mobileNumber,6,4)));
            $star='';
            for ($i=0; $i <6 ; $i++) { 
            $star.=$char;
            }
            $result=str_replace(substr($mobileNumber,2,6), $star, $mobileNumber);
            return $result;  
        }
    }
    
   /* $global = json_decode(json_encode(array("default_female_profile"            =>"assets/images/noprofile_female.png",
                                            "SMSFirstTimeProfileShortList"      =>"1",
                                            "EmailFirstTimeProfileShortList"    =>"1",
                                            "SMSEveryTimeProfileShortList"      =>"1",
                                            "EmailEveryTimeProfileShortList"    =>"1",
    
    ))); */
    
    class AppConfig {
        
        const FIRST_TIME_ADD_SHORTLIST_SMS_TO_PARTNER = 1;
        const FIRST_TIME_ADD_SHORTLIST_EMAIL_TO_PARTNER = 1;
        const EVERY_TIME_ADD_SHORTLIST_SMS_TO_PARTNER = 1;
        const EVERY_TIME_ADD_SHORTLIST_EMAIL_TO_PARTNER = 1;
        
        const THUMB_DEFAULT_PROFILE_FEMALE =1;
        const THUMB_DEFAULT_PROFILE_MALE =1;
    }
    
    $j2japplication = new J2JApplication() ;
    
    include_once("controller/MailController.php");  
    include_once("controller/MobileSMSController.php");  
    include_once("controller/DatabaseController.php");
    include_once("controller/MasterController.php");
    include_once("controller/SequenceController.php");
    include_once("controller/ResponseController.php");
    include_once("classes/class.Profiles.php");
    
    include_once("modules/class.Shortlist.php");               
    include_once("modules/class.MailContent.php");               
     
    if ($_GET['m']=="Admin") {
        include_once("classes/class.Master.php");    
        include_once("classes/class.Admin.php");    
    }
    if ($_GET['m']=="Franchisee") {
        include_once("classes/class.Franchisee.php");    
    }
    if ($_GET['m']=="Member") {
        include_once("classes/class.Member.php");    
    }
    
    if ($_GET['m']=="Matches") {
        include_once("classes/class.Matches.php");    
    }
    
    $mysql   = new MySqlDb($db[0],$db[1],$db[2],$db[3]);
    
    $loginid = isset($_GET['LoginID']) ? $_GET['LoginID'] : "";  
    if ($loginid!="") {
        $loginInfo = $mysql->select("Select * from _tbl_logs_logins where LoginID='".$loginid."'"); 
        $mysql->execute("update _tbl_logs_logins set LastAccessOn='".date("Y-m-d H:i:s")."' where LoginID='".$loginid."'"); 
    }
    
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        echo json_encode($action()); 
    } else {
        if(isset($_GET['m'])){
            if (class_exists($_GET['m'])) {
                $class = $_GET['m'];
                $method = trim($_GET['a']);
                $obj = new $class();
                echo $obj->$method(); 
            } else {
                echo "Please Contact Administrator";
            }
        }else{   
            echo "Please Contact Administrator.";
        }
    }    
    
   function getStateNames() {
         global $mysql;     
         $StateNames =  $mysql->select("select SoftCode as stcode,CodeValue as stname from `_tbl_master_codemaster` Where `HardCode`='STATNAMES' and `ParamA`='".$_GET['CountryCode']."' and `IsActive`='1' order by CodeValue");
         return $StateNames;
    }  
    
     function getDistrictNames() {
         global $mysql;     
         $StateNames =  $mysql->select("select SoftCode as dtcode,CodeValue as dtname from `_tbl_master_codemaster` Where `HardCode`='DISTNAMES' and `ParamA`='".$_GET['StateCode']."' and `IsActive`='1' order by CodeValue");
         return $StateNames;
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
    function getAvailableBalance($memberID) {
    global $mysql;
    $d = $mysql->select("select (sum(Credits)-sum(Debits)) as bal from  _tbl_wallet_transactions where MemberID='".$memberID."'");
    return isset($d[0]['bal']) ? $d[0]['bal'] : 0;      
}
?>