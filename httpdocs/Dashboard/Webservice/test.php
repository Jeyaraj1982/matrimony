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

  
                    
                    
                $otp=rand(1111,9999);
                $cart = '<div style="width:650px;margin:0px auto">
                                <table style="width:100%">
                                    <tr>
                                        <td colspan="2">Dear '.$memberdata[0]['MemberName'].', <Br><Br>Email Verification Security Code is '.$otp.'</td>
                                    </tr>
                                </table>
                                </div>';
                          $mail = new PHPMailer;
                  $mail->isSMTP(); 
                  $mail->SMTPDebug = 0;
                  $mail->Host = "mail.nahami.online";
                  $mail->Port = 465;
                  $mail->SMTPSecure = 'ssl';
                  $mail->SMTPAuth = true;
                  $mail->Username = "support@nahami.online";
                  $mail->Password = "welcome@@82";
                  $mail->setFrom("support@nahami.online", "Support nahami");
                  $mail->addAddress("jeyaraj_123@yahoo.com","Welcome");
                  $mail->Subject = 'support support';
                  $mail->Body='support support' ;
                  $mail->msgHTML('support support');
                  $mail->AltBody = 'support support';
                          
                          
                          
                          if(!$mail->send()){
                            echo  "Mailer Error: " . $mail->ErrorInfo.
                             "Error. unable to process your request.";
                          } else {
                               echo "done";
      
    }
    ?>