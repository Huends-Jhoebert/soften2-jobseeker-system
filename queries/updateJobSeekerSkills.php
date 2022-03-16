<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

session_start();

$_SESSION['skills'] = $_POST['skills'];
$updateAddress =
	"UPDATE users SET 
       skills = '$_SESSION[skills]'
  WHERE user_id='$_SESSION[user_id]'";

$conn->query($updateAddress);
