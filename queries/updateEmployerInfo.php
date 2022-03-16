<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);


session_start();




$_SESSION['email_address'] = ($_POST['email_address'] == "") ? $_SESSION['email_address'] : $_POST['email_address'];
$_SESSION['name'] = ($_POST['name'] == "") ? $_SESSION['name'] : $_POST['name'];
$_SESSION['password'] = ($_POST['password'] == "") ? $_SESSION['password'] : $_POST['password'];
$_SESSION['contact_number'] = ($_POST['contact_number'] == "") ? $_SESSION['contact_number'] : $_POST['contact_number'];
$_SESSION['address'] = ($_POST['address'] == "") ? $_SESSION['address'] : $_POST['address'];
$_SESSION['contact_person'] = ($_POST['contact_person'] == "") ? $_SESSION['contact_person'] : $_POST['contact_person'];

$updateUserInfo =
	"UPDATE users SET 
       email_account = '$_SESSION[email_address]',
	   name = '$_SESSION[name]',
	   password = '$_SESSION[password]',
	   contact_number = '$_SESSION[contact_number]',
	    address = '$_SESSION[address]',
		contact_person = '$_SESSION[contact_person]'
  WHERE user_id='$_SESSION[user_id]'";

$conn->query($updateImage);
