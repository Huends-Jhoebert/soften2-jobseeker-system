<?php

include_once "db-connection.php";

if (isset($_POST["logInBtn"])) { //isset is used to check if a variable is present; in this case signInBtn is the name of the button in the login page;

	$email = $_POST["email"];
	$password = $_POST["password"];
	$type = $_POST["options"];

	$sql = "SELECT * FROM users WHERE email_account LIKE '%$email%' AND password = '$password' AND type ='$type'";
	$result = $conn->query($sql);
	// echo $result->num_rows;

	if ($type == "Employer") {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			session_start();
			if ($row['verification_status'] == "unverified") {
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['email_address'] = $row['email_account'];
				$_SESSION['full_name'] = $row['name'];
				header("Location: ../index.php?unverified=1");
			} else {
				//if employer is verified 
				//code here
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['email_address'] = $row['email_account'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['contact_number'] = $row['contact_number'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['contact_person'] = $row['contact_person'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['p_p'] = $row['p_p'];

				header("Location: ../user-account/employer-account/userProfile.php");
			}
		} else
			header("location:../index.php?invalid=1");
	} else {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			session_start();
			if ($row['verification_status'] == "unverified") {
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['email_address'] = $row['email_account'];
				$_SESSION['full_name'] = $row['name'];
				header("Location: ../index.php?unverified=1");
			} else {
				//if Jobseeker is verified 
				//code here
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['email_address'] = $row['email_account'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['contact_number'] = $row['contact_number'];
				$_SESSION['address'] = $row['address'];
				$_SESSION['school'] = $row['school'];
				$_SESSION['degree'] = $row['degree'];
				$_SESSION['study_field'] = $row['study_field'];
				$_SESSION['study_years'] = $row['study_years'];
				$_SESSION['skills'] = $row['skills'];
				$_SESSION['coe'] = $row['coe'];
				$_SESSION['type'] = $row['type'];
				$_SESSION['p_p'] = $row['p_p'];
				header("Location: ../user-account/jobseeker-account/userProfile.php");
			}
		} else
			header("location:../index.php?invalid=1");
	}
}
