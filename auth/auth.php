<?php

include_once "db-connection.php";

if (isset($_POST["logInBtn"])) { //isset is used to check if a variable is present; in this case signInBtn is the name of the button in the login page;

	$email = $_POST["email"];
	$password = $_POST["password"];
	$type = $_POST["options"];


	$sql = "SELECT * FROM users WHERE email_account LIKE '%$email%' AND password = '$password'";
	$result = $conn->query($sql);

	echo $result->num_rows;

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
			}
		} else
			header("location:../index.php?invalid=1");
	}
}
