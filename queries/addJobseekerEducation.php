<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

session_start();


$_SESSION['school'] = $_SESSION['school'] . "," . $_POST['school'];
$_SESSION['degree'] = $_SESSION['degree'] . "," . $_POST['degree'];
$_SESSION['study_field'] = $_SESSION['study_field'] . "," . $_POST['field_of_study'];
$_SESSION['study_years'] = $_SESSION['study_years'] . "," . $_POST['start_date'] . " - " . $_POST['end_date'];


$updateEducation = "UPDATE users SET 
	school = '$_SESSION[school]',
	degree = '$_SESSION[degree]',
	study_field = '$_SESSION[study_field]',
	study_years = '$_SESSION[study_years]'
	WHERE user_id = '$_SESSION[user_id]'
";
$conn->query($updateEducation);
