<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

session_start();


// $searcPassword = "SELECT * FROM users WHERE password LIKE '%$_POST[email_address]%'";


if ($_POST['passwordRetype'] == $_SESSION['password']) {
	if ($_POST['email_address'] == "") {
		$_SESSION['name'] = ($_POST['name'] == "") ? $_SESSION['name'] : $_POST['name'];
		$_SESSION['password'] = ($_POST['password'] == "") ? $_SESSION['password'] : $_POST['password'];

		$_SESSION['contact_number'] = ($_POST['number'] == "") ? $_SESSION['contact_number'] : $_POST['number'];

		$_SESSION['password'] = ($_POST['password'] == "") ? $_SESSION['password'] : $_POST['password'];

		$updateUserInfo =
			"UPDATE users SET 
		   name = '$_SESSION[name]',
		   password = '$_SESSION[password]',
		   contact_number = '$_SESSION[contact_number]'
	  WHERE user_id='$_SESSION[user_id]'";

		$conn->query($updateUserInfo);
	} else {
		$searchEmail = "SELECT * FROM users WHERE email_account LIKE '%$_POST[email_address]%'";
		$searchEmailQuery  = $conn->query($searchEmail);

		if ($searchEmailQuery->num_rows > 0) {
			//if email has been use throw this error
			http_response_code(500);
		} else {
			//if email has not been used execute this line of code
			$_SESSION['name'] = ($_POST['name'] == "") ? $_SESSION['name'] : $_POST['name'];

			$_SESSION['email_address'] = ($_POST['email_address'] == "") ? $_SESSION['email_address'] : $_POST['email_address'];

			$_SESSION['contact_number'] = ($_POST['contact_number'] == "") ? $_SESSION['contact_number'] : $_POST['contact_number'];

			$_SESSION['password'] = ($_POST['password'] == "") ? $_SESSION['password'] : $_POST['password'];

			$updateUserInfo =
				"UPDATE users SET 
	       email_account = '$_SESSION[email_address]',
		   name = '$_SESSION[name]',
		   password = '$_SESSION[password]',
		   contact_number = '$_SESSION[contact_number]'
	  WHERE user_id='$_SESSION[user_id]'";

			$conn->query($updateUserInfo);
		}
	}
} else {
	http_response_code(400);
}
