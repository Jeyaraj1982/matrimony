<?php
	class MobileSMSController {
        
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
                                                             "APIID"             => $active[0]['ApiID']));
            if (sizeof($active)==0) {
                $mysql->execute("update _tbl_logs_mobilesms set ApiResponse ='Api not configured' where ReqID='".$id."' ");
            }
            
            $apiurl   = $active[0]['ApiUrl'];    
            $postvars = '';
            $param[$active[0]['MobileNumber']] = $mobileNumber;
            $param[$active[0]['MessageText']]  = $active[0]['Method']=="POST" ?  $text : urlencode($text);
            $param["uid"] = $id;
            
            foreach($param as $key=>$value) {
                $postvars .= $key . "=" . $value . "&";
            }
            
            if ($active[0]['Method']=="GET") {
                $apiurl.="&".$postvars;
            }                            
            
            $timeout = isset($active[0]['TimedOut']) && $active[0]['TimedOut']>0 ? $active[0]['TimedOut'] : 200;
         
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$apiurl);
            if ($active[0]['Method']=="POST") {
                curl_setopt($ch,CURLOPT_POST, 1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);  
            }
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch,CURLOPT_TIMEOUT, $timeout);
            $response = curl_exec($ch);
            $mysql->execute("update _tbl_logs_mobilesms set ApiResponse ='".$response."' where ReqID='".$id."' ");
            curl_close ($ch);
            return $id;  
        }
    }
    
?>