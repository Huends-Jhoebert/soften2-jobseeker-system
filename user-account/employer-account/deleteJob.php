<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

$selectJobseekerFile = "SELECT job_applicant_file FROM job_applicant WHERE job_id = '$_GET[jobIdToDelete]'";
$files = $conn->query($selectJobseekerFile);
$filesToDelete = mysqli_fetch_all($files, MYSQLI_ASSOC);

$selectJobImage = "SELECT job_image FROM job WHERE job_id = '$_GET[jobIdToDelete]'";
$selectJobImageQuery = $conn->query($selectJobImage);
$image = $selectJobImageQuery->fetch_assoc();

$jobOfferQuery = "DELETE FROM job WHERE job_id = '$_GET[jobIdToDelete]'";
$jobOfferQueryResult = $conn->query($jobOfferQuery);

$jobApplicantQuery = "DELETE FROM job_applicant WHERE job_id = '$_GET[jobIdToDelete]'";
$jobApplicantQueryResult = $conn->query($jobApplicantQuery);

foreach ($filesToDelete as $fileToDelete) {
	unlink($fileToDelete['job_applicant_file']);
}

unlink("../" . $image['job_image']);

header("Location: userJobOffers.php?successfullyDeleted=1");
