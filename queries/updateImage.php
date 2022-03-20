<?php

include_once "randomString.php";
session_start();


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

if (isset($_POST['employerNewImageBtn'])) {

	unlink($_SESSION['p_p']);

	$filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
	$folder = "../dist/user-images/" . randomString(8) . "/" . $filename;


	mkdir(dirname($folder));

	if (move_uploaded_file($tempname, $folder)) {
		$_SESSION['p_p'] = $folder;
	}

	$updateImage =
		"UPDATE users SET 
	       p_p = '$_SESSION[p_p]' 
	  WHERE user_id='$_SESSION[user_id]'";

	$conn->query($updateImage);

	header("Location: ../user-account/employer-account/userProfile.php?newImage=1");
}
