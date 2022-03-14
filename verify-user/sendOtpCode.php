<?php

include_once "db-connection.php";
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);
try {
	$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
	$mail->isSMTP(); // using SMTP protocol                                     
	$mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
	$mail->SMTPAuth = true;  // enable smtp authentication                             
	$mail->Username = 'jobseekersystem2022@gmail.com';  // sender gmail host              
	$mail->SMTPDebug = 2;
	$mail->Password = 'jobseeker12345';
	// sender gmail host password                          
	$mail->SMTPSecure = 'TLS';  // for encrypted connection                           
	$mail->Port = 587;   // port for SMTP     
	$mail->setFrom('jobseekersystem2022@gmail.com', "JobSeeker"); // sender's email and name
	$mail->addAddress($_SESSION['email_address'], $_SESSION['full_name']);  // receiver's email and name
	$mail->isHTML(true);
	$mail->Subject = 'Jobseeker verification code';
	$mail->Body    =  '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';
	$mail->send();

	$sql = "UPDATE users SET 
       verification_code = '$verification_code' 
  WHERE user_id='$_SESSION[user_id]'";

	if ($conn->query($sql) === TRUE) {
		header("Location: userSendOtp.php");
		$conn->close();
	}
} catch (Exception $e) { // handle error.
	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
