<?php
    class MailController {
        
        static public function Send($param,&$mailError) {
            reInitMail();
            global $mail,$mysql;
            reInitMail();
            $reqID = $mysql->insert("_tbl_logs_email",array("EmailTo"          => $param['MailTo'],
                                                            "EmaildFor"        => $param['Category'],
                                                            "MemberID"         => isset($param['MemberID']) ? $param['MemberID'] : 0,
                                                            "EmailSubject"     => $param['Subject'],
                                                            "EmailContent"     => base64_encode($param['Message']),
                                                            "EmailRequestedOn" => date("Y-m-d H:i:s")));
                 
            $emailSettings = $mysql->select("select * from _tbl_settings_emailapi where IsActive='1' order by ApiID Desc");
            
            if (sizeof($emailSettings)==0) {
                $mailError="Email not configured";
                $mysql->execute("update _tbl_logs_email set  IsFailure='1', FailureMessage='Email not configured' where EmailLogID='".$reqID."'");
                return false;  
            }

            $mysql->execute("update _tbl_logs_email set EmailAPIID='".$emailSettings[0]['ApiID']."', APIRequestedOn='".date("Y-m-d H:i:s")."' where EmailLogID='".$reqID."'");

            $mail->isSMTP(); 
            $mail->SMTPDebug = 0;
            $mail->Host = $emailSettings[0]["HostName"];
            $mail->Port = $emailSettings[0]["PortNumber"];
            $mail->SMTPSecure = $emailSettings[0]["Secure"];
            $mail->SMTPAuth   = true;
            $mail->Username   = $emailSettings[0]["SMTPUserName"];
            $mail->Password   = $emailSettings[0]["SMTPPassword"];
            $mail->Subject    = $param['Subject'];
            $mail->setFrom($emailSettings[0]["SendersName"].".".$emailSettings[0]["SMTPUserName"], $emailSettings[0]["SendersName"]);
            $mail->addAddress($param['MailTo'],"");
            $mail->msgHTML($param['Message']);
            $mailError = $mail->ErrorInfo;
             
            if(!$mail->send()){
                $mysql->execute("update _tbl_logs_email set IsFailure='1', FailureMessage='".$mail->ErrorInfo."' where EmailLogID='".$reqID."'");
                $mailError = true;
                return false;
            } else {
                $mailError = false;
                $mysql->execute("update _tbl_logs_email set IsSuccess='1' where EmailLogID='".$reqID."'");
                return true;
            } 
        }
   }
?>