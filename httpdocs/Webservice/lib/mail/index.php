<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "mail.goodgrowth.in"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 465; // TLS only 587
$mail->SMTPSecure = 'ssl'; // ssl is depracated tls
$mail->SMTPAuth = true;
$mail->Username = "support@goodgrowth.in";
$mail->Password = "GoodGrowth";
$mail->setFrom("support@goodgrowth.in", "GoodGrowth");
$mail->addAddress("sales@j2jsoftwaresolutions.com", "J2J Sales");
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->addAttachment('logo.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}
?>