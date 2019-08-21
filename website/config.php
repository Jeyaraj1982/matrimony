<?php
    session_start();
    define("SiteUrl","http://nahami.online/demo/matrimony/");
    define("SITE_TITLE","Matrimony") ;
    $__Global = $_SERVER;
    
    class Webservice {
        
        var $serverURL="http://nahami.online/demo/matrimony/Webservice/webservice.php?";
        
        function Login($param) {
            return json_decode($this->_callUrl("m=Member&a=Login",$param),true);
        }
        function Register($param) {
            return json_decode($this->_callUrl("m=Member&a=Register",$param),true);
        }
        function forgotPassword($param) {
            return json_decode($this->_callUrl("m=Member&a=forgotPassword",$param),true);
        }
        function forgotPasswordOTPvalidation($param) {
            return json_decode($this->_callUrl("m=Member&a=forgotPasswordOTPvalidation",$param),true);
        }
        function forgotPasswordchangePassword($param) {
            return json_decode($this->_callUrl("m=Member&a=forgotPasswordchangePassword",$param),true);
        }
        
         function GetLandingPageProfiles($param) {
            return json_decode($this->_callUrl("m=Member&a=GetLandingPageProfiles",$param),true);
        }
        function GetFullProfileInformation($param) {
            return json_decode($this->_callUrl("m=Member&a=GetFullProfileInformation",$param),true);
        }
        function _callUrl($method,$param) {
            global $__Global;
            $postvars = '';
            foreach($param as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            $postvars .= "qry=".base64_encode(json_encode(array("UserAgent"=>$__Global['HTTP_USER_AGENT'],"IPAddress"=>$__Global['REMOTE_ADDR'])));
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$this->serverURL.$method);
            curl_setopt($ch,CURLOPT_POST, 1);  
            curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
            curl_setopt($ch,CURLOPT_TIMEOUT, 200);
            $response = curl_exec($ch);
            curl_close ($ch);
            return $response;
        }
    }
    
    $webservice = new Webservice();
?>
