<?php
require 'class.phpmailer.php';
require 'class.smtp.php';

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.mail.yahoo.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "karci26";
$mail->Password = "neverforyou";
$mail->SetFrom("karci26@yahoo.com");
$mail->Subject = "Your Gmail SMTP Mail";
//$mail->Mailer='sendmail';
$mail->Body = "<b>Hi, your first SMTP mail via gmail server has been received. Great Job!.. <br/><br/>by <a href='http://www.asif18.com/7/php/send-mails-using-smtp-in-php-by-gmail-server-or-own-domain-server/'>Asif18</a></b>";
$mail->AddAddress("karci26@gmail.com");
 if(!$mail->Send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}
else{
	echo "Message has been sent";
}