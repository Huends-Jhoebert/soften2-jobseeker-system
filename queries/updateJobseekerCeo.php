<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

session_start();

$_SESSION['coe'] = $_POST['coe'];
$updateAddress =
	"UPDATE users SET 
       coe = '$_SESSION[coe]'
  WHERE user_id='$_SESSION[user_id]'";

$conn->query($updateAddress);
