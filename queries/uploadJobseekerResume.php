<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

include_once "randomString.php";

if (isset($_POST['submitResumeBtn'])) {
	$jobId = $_POST['job_id'];
	$jobEmployerId = $_POST['job_employer_id'];
	$jobResumeSenderId = $_POST['job_applicant_jobseeker_id'];
	$resumeFile = "";
	$filename = $_FILES["my_file"]["name"];
	$tempname = $_FILES["my_file"]["tmp_name"];
	$folder = "../dist/jobseeker-files/" . randomString(8) . "/" . $filename;

	mkdir(dirname($folder));
	if (move_uploaded_file($tempname, $folder)) {
		$resumeFile = $folder;
	}
	$sql = "INSERT INTO job_applicant (job_id, job_applicant_employer_id, job_applicant_jobseeker_id, job_applicant_file) VALUES ('$jobId', '$jobEmployerId', '$jobResumeSenderId', '$resumeFile')";

	if ($conn->query($sql) === TRUE) {
		header("Location: ../user-account/jobseeker-account/jobsPosted.php?resumeSent=1");
		$conn->close();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
