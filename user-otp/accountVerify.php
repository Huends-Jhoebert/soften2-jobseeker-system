<?php

include_once "db-connection.php";

session_start();

$searchUser = "SELECT * FROM users WHERE user_id LIKE '%$_SESSION[user_id]%' AND verification_code LIKE '%$_POST[verification_code]%'";

$searchUserQuery  = $conn->query($searchUser);

// if user submit verification code is same execute this
if ($searchUserQuery->num_rows > 0) {

	$sql = "UPDATE users SET 
       verification_status = 'verified' 
  WHERE user_id='$_SESSION[user_id]'";

	if ($conn->query($sql) === TRUE) {
		session_unset();
		session_destroy();
		header("Location: ../index.php?verifiedEmail=1");
		$conn->close();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
} else {
	//if not
	header("Location: jobseekerSendOtp.php?wrongOTP=1");
}
