<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

session_start();

$_SESSION['address'] =  $_POST['address_more_info'] . " " . $_POST['barangay'] . ", " . $_POST['city'] . " " .  $_POST['postal_code'] . " " . $_POST['province'] . " " . $_POST['region'];

$updateAddress =
  "UPDATE users SET 
       address = '$_SESSION[address]'
  WHERE user_id='$_SESSION[user_id]'";

$conn->query($updateAddress);
