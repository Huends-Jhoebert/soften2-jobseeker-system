<?php

include_once "db-connection.php";
include_once "randomString.php";

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['employerSignUpBtn'])) {
	$_SESSION['full_name'] = $_POST['full_name'];
	$_SESSION['unique_id'] = $ran_id = rand(time(), 100000000);
	$_SESSION['contact_person'] = $_POST['contact_person'];
	$_SESSION['contact_number']  = $_POST['contact_number'];
	$_SESSION['email_address']  = $_POST['email_address'];
	$_SESSION['password']  = $_POST['password'];
	$_SESSION['address_more_info'] = $_POST['address_more_info'];
	$_SESSION['barangay'] = $_POST['barangay'];
	$_SESSION['city'] = $_POST['city'];
	$_SESSION['postal_code'] = $_POST['postal_code'];
	$_SESSION['province'] = $_POST['province'];
	$_SESSION['region'] = $_POST['region'];
	$_SESSION['address'] =  $_POST['address_more_info'] . " " . $_POST['barangay'] . ", " . $_POST['city'] .  " " .	$_POST['postal_code'] . " " . $_POST['province'] . " " . $_POST['region'];
	$date = date("y-m-d");

	$searchEmail = "SELECT * FROM users WHERE email_account LIKE '%$_SESSION[email_address]%'";
	$searchEmailQuery  = $conn->query($searchEmail);

	if ($searchEmailQuery->num_rows > 0) {
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "../dist/user-images/" . randomString(8) . "/" . $filename;

		mkdir(dirname($folder));

		if (move_uploaded_file($tempname, $folder)) {
			$_SESSION["p_p"] = $folder;
		}
		header("Location:../employerSignup.php?emailHasBeenUsed=1");
	} else {
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

			$filename = $_FILES["image"]["name"];
			$tempname = $_FILES["image"]["tmp_name"];
			$folder = "../dist/user-images/" . randomString(8) . "/" . $filename;

			mkdir(dirname($folder));

			if (move_uploaded_file($tempname, $folder)) {
				$_SESSION["p_p"] = $folder;
			}

			$sql = "INSERT INTO users (unique_id, name, password, contact_number, email_account, address, type, contact_person, p_p, verification_code, verification_status)
        VALUES ('$_SESSION[unique_id]','$_SESSION[full_name]', '$_SESSION[password]', '$_SESSION[contact_number]', '	$_SESSION[email_address]', '$_SESSION[address]', 'Employer', '$_SESSION[contact_person]','$_SESSION[p_p]', $verification_code, 'unverified')";

			if ($conn->query($sql) === TRUE) {
				$_SESSION['user_id'] = $conn->insert_id;
				header("Location: employerSendOtp.php");
				$conn->close();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} catch (Exception $e) { // handle error.
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
}
