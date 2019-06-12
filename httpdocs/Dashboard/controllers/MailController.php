<?php
   class MailController {
        
        var $mailHost     = "mail.nahami.online";
        var $mailFrom     = "support@nahami.online";
        var $mailPassword = "welcome@82";
        var $mailPort     = "465";
        
        var $mailTo       = ""; 
        var $mailTitle    = "";
        var $mailContent  = "";
                   
        function FranchiseeForgetPassword($param) {
            
            global $mysql;
            
            $this->mailTo      = $param['mailTo'];
            $this->mailTitle   = "Reset Password.";
            $this->mailContent = "<div>
                                    Dear (".$param['PersonName']."),<br><br>
                                     
                                     Your forget password security code is : ".$param['code']."
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
            $res=$this->SendMail();  
             
            $res .= $mysql->insert("_tbl_log_email",array("MailedOn"     => date("Y-m-d H:i:s"),
                                                         "IsFranchisee" => "1",
                                                         "IsMember"     => "0",
                                                         "UserCode"     => "0",
                                                         "MailSubject"  => $this->mailTitle,
                                                         "Content"      => base64_encode($this->mailContent),
                                                         "SentTo"       => $this->mailTo,
                                                         "ApiResponse"  => $res,
                                                         "Category"     => "CreateFranchisee"));       
                                                                                                     
            return $res;
        }
        function MemberForgetPassword($param) {
            
            global $mysql;
            
            $this->mailTo      = $param['mailTo'];
            $this->mailTitle   = "Reset Password.";
            $this->mailContent = "<div>
                                    Dear (".$param['MemberName']."),<br><br>
                                     
                                     Your forget password security code is : ".$param['code']."
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
            $res=$this->SendMail();  
             
            $res .= $mysql->insert("_tbl_log_email",array("MailedOn"     => date("Y-m-d H:i:s"),
                                                         "IsFranchisee" => "1",
                                                         "IsMember"     => "0",
                                                         "UserCode"     => "0",
                                                         "MailSubject"  => $this->mailTitle,
                                                         "Content"      => base64_encode($this->mailContent),
                                                         "SentTo"       => $this->mailTo,
                                                         "ApiResponse"  => $res,
                                                         "Category"     => "CreateFranchisee"));       
                                                                                                     
            return $res;
        } 
         function NewFranchisee($param) {
            
            global $mysql;
            
            $this->mailTo      = $param['mailTo'];
            $this->mailTitle   = "Franchisee Account Created.";
            $this->mailContent = "<div>
                                    Dear Franchisee (".$param['FranchiseeName']."),<br><br>
                                    <table style='border:1px solid #ccc'>
                                        <tr>
                                            <td>Login Name</td>
                                            <td>".$param['LoginName']."</td>
                                        </tr>
                                        <tr>
                                            <td>Login Password</td>
                                            <td>".$param['LoginPassword']."</td>
                                        </tr>
                                    </table>
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
            $res=$this->SendMail();  
             
            $res .= $mysql->insert("_tbl_log_email",array("MailedOn"     => date("Y-m-d H:i:s"),
                                                         "IsFranchisee" => "1",
                                                         "IsMember"     => "0",
                                                         "UserCode"     => $param['FranchiseeCode'],
                                                         "MailSubject"  => $this->mailTitle,
                                                         "Content"      => base64_encode($this->mailContent),
                                                         "SentTo"       => $this->mailTo,
                                                          "ApiResponse"  => $res,
                                                          "Category"     => "CreateFranchisee"));       
                                                                                                     
            return $res;
        }
        
        
        function NewFranchiseeStaff($param) {
            
            global $mysql;
            
            $this->mailTo      = $param['mailTo'];
            $this->mailTitle   = "[Staff Account]Account Created.";
            $this->mailContent = "<div>
                                    Dear Franchisee (".$param['StaffName']."),<br><br>
                                    You have added as a staff in ".$param['FranchiseeName']."<Br><bR>
                                    
                                    <table style='border:1px solid #ccc'>
                                        <tr>
                                            <td>Login Name</td>
                                            <td>".$param['LoginName']."</td>
                                        </tr>
                                        <tr>
                                            <td>Login Password</td>
                                            <td>".$param['LoginPassword']."</td>
                                        </tr>
                                    </table>
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
            $res=$this->SendMail();  
             
            $res .= $mysql->insert("_tbl_log_email",array("MailedOn"     => date("Y-m-d H:i:s"),
                                                         "IsFranchisee" => "1",
                                                         "IsMember"     => "0",
                                                         "UserCode"     => $param['StaffCode'],
                                                         "MailSubject"  => $this->mailTitle,
                                                         "Content"      => base64_encode($this->mailContent),
                                                         "SentTo"       => $this->mailTo,
                                                         "ApiResponse"  => $res,
                                                         "Category"     => "CreateFranchiseeStaff"));       
                                                                                                     
            return $res;
        }
        
        function NewMember($param) {
            
            $this->mailTo=$param['mailTo'];
            $this->mailTitle="Member Account Created.";
            $this->mailContent="<div>
                                    Dear Member (".$param['MemberName']."),<br><br>
                                    <table style='border:1px solid #ccc'>
                                        <tr>
                                            <td>Login Name</td>
                                            <td>".$param['LoginName']."</td>
                                        </tr>
                                        <tr>
                                            <td>Login Password</td>
                                            <td>".$param['LoginPassword']."</td>
                                        </tr>
                                    </table>
                                    <br><br>
                                    Thanks<br>
                                    Support Team<br>
                                 </div>";
            return $this->SendMail();
        }
        
        function SendMail() {
            
            global $mail;
            
            $mail->isSMTP(); 
            $mail->SMTPDebug = 0;
            $mail->Host = $this->mailHost;
            $mail->Port = $this->mailPort;
            $mail->SMTPSecure = 'ssl';
            $mail->SMTPAuth = true;
            $mail->Username = $this->mailFrom;
            $mail->Password = $this->mailPassword;
            $mail->setFrom($this->mailFrom, "Support nahami");
            $mail->addAddress($this->mailTo,"Support nahami");
            $mail->Subject = $this->mailTitle;
            $mail->msgHTML($this->mailContent);
            $mail->AltBody = 'HTML messaging not supported';
            // $mail->addAttachment($fname); //Attach an image file
            if(!$mail->send()){
                return "Mailer Error: " . $mail->ErrorInfo;
            } else {
               return "Message sent!";
            }
            
            
        }
    }
?>