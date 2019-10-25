<?php
	class MobileSMSController {
        
        function _sendSMS($mobileNumber,$text) {
            $url = "http://j2jsoftwaresolutions.com/sms.php?Key=GOODGW&Text=".base64_encode($text)."&MobileNumber=".$mobileNumber;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
        }
        
        static public function sendSMS($mobileNumber,$text) {
            
            global $mysql;
            
            $active = $mysql->select("select * from `_tbl_settings_mobilesms` where `IsActive`='1'");
            
            $id = $mysql->insert("_tbl_logs_mobilesms",array("RequestedOn"       => date("Y-m-d H:i:s"),
                                                             "MemberID"          => "0",
                                                             "FranchiseeID"      => "0",
                                                             "FranchiseeStaffID" => "0",
                                                             "AdminStaffID"      => "0",
                                                             "MobileNumber"      => $mobileNumber,
                                                             "TextMessage"       => $text,
                                                             "APIID"             => $active[0]['ApiID'] 
              ));
              if (sizeof($active)==1) {
                
                $postvars = '';
                $param = array(
                    $active[0]['MobileNumber'] => $mobileNumber,
                    $active[0]['MessageText']   =>  $active[0]['Method']=="POST" ?  base64_encode($text) : urlencode($text));
                
                foreach($param as $key=>$value) {
                    $postvars .= $key . "=" . $value . "&";
                }
            $ch = curl_init();
            $apiurl = $active[0]['ApiUrl'];
             if ($active[0]['Method']=="GET") {
                 $apiurl.="&".$postvars;
             }
             
            curl_setopt($ch,CURLOPT_URL,$apiurl);
            if ($active[0]['Method']=="POST") {
                curl_setopt($ch,CURLOPT_POST, 1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);  
            }
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_TIMEOUT, 200);
            $response = curl_exec($ch);
           //$response = "";
            $mysql->execute("update _tbl_logs_mobilesms set ApiResponse ='".$response."' where ReqID='".$id."' ");
            curl_close ($ch);
              }
        }
    }
    
?>