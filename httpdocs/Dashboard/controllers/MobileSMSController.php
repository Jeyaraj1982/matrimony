<?php
	class MobileSMSController {
        
        function sendSMS($mobileNumber,$text) {
            $url = "http://onlinej2j.com/sms.php?Key=GOODGW&Text=".base64_encode($text)."&MobileNumber=".$mobileNumber;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
        }
    }
    
?>