<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';

$otp = rand(100000,999999);
$mail = new PHPMailer(true);
try{
$mail->SMTPDebug = 2;                   // Enable verbose debug output
$mail->isSMTP();                        // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
$mail->SMTPAuth   = true;               // Enable SMTP authentication
$mail->Username   = 'lifelinebank1@gmail.com';     // SMTP username
$mail->Password   = 'l!feLineBank1';         // SMTP password
$mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
$mail->Port       = 587;               // TCP port to connect to
$mail->setFrom('lifelinebank1@gmail.com', 'LifeLineBankLogin');           // Set sender of the mail
$mail->addAddress('yoofiappiah62@gmail.com');           // Add a recipient
//$mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional
$mail->isHTML(true);                                  
$mail->Subject = 'OTP';
$mail->Body    = '<div>Hello user,</div> <div>You recently requested to log in Your OTP is<div> <b>'.$otp.'</b>!';
$mail->AltBody = 'Your OTP is <b>'.$otp.'</b>';
$mail->send();
echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
/*
$to_email = "appiahyoofi1@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi,nn This is test email send by PHP Script";
$headers = "From: appiahyoofi@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
echo "Email successfully sent to $to_email...";
} else {
echo "Email sending failed...";
}*/?>