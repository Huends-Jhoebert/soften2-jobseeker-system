<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

include_once "randomString.php";

session_start();


if (isset($_POST['submitBtn'])) {

	$jobTitle = $_POST['title'];
	$jobPlace = $_POST['place'];
	$jobSalaryRange = $_POST['salary_range'];
	$jobDescription = $_POST['description'];
	$jobImage = "";

	$filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
	$folder = "../dist/job-images/" . randomString(8) . "/" . $filename;

	mkdir(dirname($folder));

	if (move_uploaded_file($tempname, $folder)) {
		$jobImage = $folder;
	}

	$sql = "INSERT INTO job (job_employer_id, job_title, job_image, job_place, job_salary_range, job_description) VALUES ('$_SESSION[user_id]', '$jobTitle', '$jobImage', '$jobPlace', '$jobSalaryRange', '$jobDescription')";

	if ($conn->query($sql) === TRUE) {
		header("Location: ../user-account/employer-account/userJob.php?jobAdded=1");
		$conn->close();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
