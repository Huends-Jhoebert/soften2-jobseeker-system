<?php

include_once "db-connection.php";
include_once "randomString.php";

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['jobSeekerSubmitBtn'])) {
	$_SESSION['full_name'] = $_POST['full_name'];
	$_SESSION['unique_id'] = $ran_id = rand(time(), 100000000);
	$_SESSION['contact_number']  = $_POST['contact_number'];
	$_SESSION['email_address']  = $_POST['email_address'];
	$_SESSION['password']  = $_POST['password'];
	$_SESSION['address_more_info'] = $_POST['address_more_info'];
	$_SESSION['barangay'] = $_POST['barangay'];
	$_SESSION['city'] = $_POST['city'];
	$_SESSION['postal_code'] = $_POST['postal_code'];
	$_SESSION['province'] = $_POST['province'];
	$_SESSION['region'] = $_POST['region'];
	$_SESSION['address'] =  $_POST['address_more_info'] . " " . $_POST['barangay'] . ", " . $_POST['city'] . " " .	$_POST['postal_code'] . " " . $_POST['province'] . " " . $_POST['region'];
	// education College
	$_SESSION['school'] = $_POST['school'];
	$_SESSION['degree'] = $_POST['degree'];
	// $_SESSION['level'] = $_POST['level'];
	$_SESSION['start_year'] = $_POST['start_year'];
	$_SESSION['year_ended'] = $_POST['year_ended'];
	$_SESSION['year'] = $_POST['start_year'] . "  - " . $_POST['year_ended'];

	// education Masters
	$_SESSION['school1'] = $_POST['school1'];
	$_SESSION['mastersSchool'] = $_SESSION['school'] . ',' . $_SESSION['school1'];
	$_SESSION['degree1'] = $_POST['degree1'];
	$_SESSION['mastersDegree']  = $conn->real_escape_string($_SESSION['degree'] . ',' . $_SESSION['degree1']);
	// $_SESSION['level1'] = $_POST['level1'];
	$_SESSION['start_year1'] = $_POST['start_year1'];
	$_SESSION['year_ended1'] = $_POST['year_ended1'];
	$_SESSION['year1'] = $_POST['start_year1'] . "  - " . $_POST['year_ended1'];
	$_SESSION['mastersYears'] =	$_SESSION['year'] . ',' . $_SESSION['year1'];

	// education Doctoral
	$_SESSION['school2'] = $_POST['school2'];
	$_SESSION['phdSchool'] = $_SESSION['mastersSchool'] . ',' . $_SESSION['school2'];
	$_SESSION['degree2'] = $_POST['degree2'];
	$_SESSION['phdDegree'] = $_SESSION['mastersDegree'] . ',' . $_SESSION['degree2'];
	// $_SESSION['level2'] = $_POST['level2'];
	$_SESSION['start_year2'] = $_POST['start_year2'];
	$_SESSION['year_ended2'] = $_POST['year_ended2'];
	$_SESSION['year2'] = $_POST['start_year2'] . "  - " . $_POST['year_ended2'];
	$_SESSION['phdYears'] = $_SESSION['mastersYears'] . ',' . $_SESSION['year2'];

	// education
	$_SESSION['skills'] = $_POST['skills'];
	$_SESSION['coe'] = $_POST['coe'];
	$date = date("Y-m-d");

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
		header("Location:../jobseekerSignup.php?emailHasBeenUsed=1");
	} else {
		$mail = new PHPMailer(true);
		try {
			$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
			$mail->isSMTP(); // using SMTP protocol                                     
			$mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
			$mail->SMTPAuth = true;  // enable smtp authentication                             
			$mail->Username = 'huendshuends2021@gmail.com';  // sender gmail host              
			$mail->SMTPDebug = 2;
			$mail->Password = 'helloworld06061998';
			// sender gmail host password                          
			$mail->SMTPSecure = 'TLS';  // for encrypted connection                           
			$mail->Port = 587;   // port for SMTP     
			$mail->setFrom('huendshuends2021@gmail.com', "JobSeeker"); // sender's email and name
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

			if ($_POST['school1'] == "" && $_POST['school2'] = "") {
				$sql = "INSERT INTO users (unique_id, name, password, contact_number, email_account, address, school, degree, study_field, study_years, type, p_p, skills, coe, verification_code, verification_status, signup_date)
        VALUES ('$_SESSION[unique_id]','$_SESSION[full_name]', '$_SESSION[password]', '$_SESSION[contact_number]', '$_SESSION[email_address]', '$_SESSION[address]', '$_SESSION[school]', '$_SESSION[degree]', 'College', '$_SESSION[year]', 'Jobseeker','$_SESSION[p_p]', '$_SESSION[skills]', '$_SESSION[coe]', $verification_code, 'unverified', '$date')";
			} else if ($_POST['school1'] != "" && $_POST['school2'] == "") {
				$sql = "INSERT INTO users (unique_id, name, password, contact_number, email_account, address, school, degree, study_field, study_years, type, p_p, skills, coe, verification_code, verification_status, signup_date)
        VALUES ('$_SESSION[unique_id]','$_SESSION[full_name]', '$_SESSION[password]', '$_SESSION[contact_number]', '$_SESSION[email_address]', '$_SESSION[address]', '$_SESSION[mastersSchool]', '$_SESSION[mastersDegree]', 'College,Masters', '$_SESSION[mastersYears]', 'Jobseeker','$_SESSION[p_p]', '$_SESSION[skills]', '$_SESSION[coe]', $verification_code, 'unverified', '$date')";
			} else if ($_POST['school1'] != "" && $_POST['school2'] != "") {
				$sql = "INSERT INTO users (unique_id, name, password, contact_number, email_account, address, school, degree, study_field, study_years, type, p_p, skills, coe, verification_code, verification_status, signup_date)
        VALUES ('$_SESSION[unique_id]','$_SESSION[full_name]', '$_SESSION[password]', '$_SESSION[contact_number]', '$_SESSION[email_address]', '$_SESSION[address]', '$_SESSION[phdSchool]', '$_SESSION[phdDegree]', 'College,Masters,PhD', '$_SESSION[phdYears]', 'Jobseeker','$_SESSION[p_p]', '$_SESSION[skills]', '$_SESSION[coe]', $verification_code, 'unverified', '$date')";
			}

			if ($conn->query($sql) === TRUE) {
				$_SESSION['user_id'] = $conn->insert_id;
				header("Location: jobseekerSendOtp.php");
				$conn->close();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		} catch (Exception $e) { // handle error.
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
}
