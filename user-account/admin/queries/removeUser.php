<?php

session_start();
include_once "db-connection.php";

$userId = $_GET["userId"];
$selectUserToDelete = "SELECT * FROM users WHERE user_id = '$userId'";
$result = $conn->query($selectUserToDelete);
$row = $result->fetch_assoc();

if ($row['type'] == "Jobseeker") {
	unlink("../../" . $row['p_p']);

	$deleteUser = "DELETE FROM users WHERE user_id = '$userId'";
	$conn->query($deleteUser);

	$deleteMessages = "DELETE FROM messages WHERE incoming_msg_id = '$userId' OR outgoing_msg_id = '$userId'";
	$conn->query($deleteMessages);

	$selectUserFiles =  "SELECT job_applicant_file FROM job_applicant WHERE job_applicant_jobseeker_id = '$userId'";
	$files = $conn->query($selectUserFiles);
	$filesToDelete = mysqli_fetch_all($files, MYSQLI_ASSOC);

	foreach ($filesToDelete as $fileToDelete) {
		unlink("../" . $fileToDelete['job_applicant_file']);
	}

	$deleteUserFiles = "DELETE FROM job_applicant WHERE job_applicant_jobseeker_id = '$userId'";
	$conn->query($deleteUserFiles);

	header("Location: ../admin-pages/adminPage1.php?successfullyDeleted=1");
} else {

	unlink("../../" . $row['p_p']);
	$deleteUser = "DELETE FROM users WHERE user_id = '$userId'";
	$conn->query($deleteUser);

	$selectJobseekerFile = "SELECT job_applicant_file FROM job_applicant WHERE job_applicant_employer_id = '$userId'";
	$files = $conn->query($selectJobseekerFile);
	$filesToDelete = mysqli_fetch_all($files, MYSQLI_ASSOC);

	$selectJobImage = "SELECT job_image FROM job WHERE job_employer_id = '$userId'";
	$selectJobImageQuery = $conn->query($selectJobImage);
	$image = $selectJobImageQuery->fetch_assoc();

	$jobOfferQuery = "DELETE FROM job WHERE job_employer_id = '$userId'";
	$jobOfferQueryResult = $conn->query($jobOfferQuery);

	$jobApplicantQuery = "DELETE FROM job_applicant WHERE job_applicant_employer_id = '$userId'";
	$jobApplicantQueryResult = $conn->query($jobApplicantQuery);

	$deleteChatsQuery = "DELETE FROM chats WHERE from_id = '$userId' OR to_id = '$userId'";
	$conn->query($deleteChatsQuery);

	$deleteMessagesQuery = "DELETE FROM conversations WHERE user_1 = '$userId' OR user_2 = '$userId'";

	foreach ($filesToDelete as $fileToDelete) {
		unlink("../" . $fileToDelete['job_applicant_file']);
	}
	unlink("../../" . $image['job_image']);

	header("Location: ../admin-pages/adminPage1.php?successfullyDeleted=1");
}
?>

<!-- <img src="../../../" alt=""> -->