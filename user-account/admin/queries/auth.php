<?php

include_once "db-connection.php";

if (isset($_POST["logInBtn"])) { //isset is used to check if a variable is present; in this case signInBtn is the name of the button in the login page;

	$username = $_POST["username"];
	$password = $_POST["password"];

	$sql = "SELECT * FROM admin WHERE username ='$username' AND password = '$password'";
	$result = $conn->query($sql);
	// echo $result->num_rows;
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		session_start();
		$_SESSION["user_id"] = $row["user_id"];
		$_SESSION["name"] = $row["name"];
		$_SESSION["username"] = $row["username"];
		$_SESSION["password"] = $row["password"];
		$_SESSION["p_p"] = $row["p_p"];
		header("Location: ../admin-pages/adminPage1.php");
	} else {
		header("Location: ../adminLogin.php?wrong=1");
	}
}
