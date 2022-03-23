<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

include_once "randomString.php";

session_start();


if (isset($_POST['submitBtn'])) {

	if (count(explode(",", $_POST['skills'])) > 3) {
		$_SESSION['added_job_core_skills'] = $_POST['skills'];
		$_SESSION['added_job_title'] = $_POST['title'];
		$_SESSION['added_job_place'] = $_POST['place'];
		$_SESSION['added_job_salary_range'] = $_POST['salary_range'];
		$_SESSION['added_job_description'] = $_POST['description'];
		header("Location: ../user-account/employer-account/userJob.php?moreSkills=1");
	} else {

		$_SESSION['added_job_core_skills'] = $_POST['skills'];
		$_SESSION['added_job_title'] = $_POST['title'];
		$_SESSION['added_job_place'] = $_POST['place'];
		$_SESSION['added_job_salary_range'] = $_POST['salary_range'];
		// $_SESSION['added_job_description'] = $_POST['description'];
		$_SESSION['added_job_image'] = "";
		$filename = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$folder = "../dist/job-images/" . randomString(8) . "/" . $filename;

		mkdir(dirname($folder));

		if (move_uploaded_file($tempname, $folder)) {
			$_SESSION['added_job_image'] = $folder;
		}

		$_SESSION['added_job_description'] = $conn->real_escape_string($_POST['description']);

		$sql = "INSERT INTO job (job_employer_id, job_title, job_image, job_place, job_skills, job_salary_range, job_description) VALUES ('$_SESSION[user_id]', '$_SESSION[added_job_title]', '$_SESSION[added_job_image]', '$_SESSION[added_job_place]', '$_SESSION[added_job_core_skills]', '$_SESSION[added_job_salary_range]', '$_SESSION[added_job_description]')";

		if ($conn->query($sql) === TRUE) {
			header("Location: ../user-account/employer-account/userJob.php?jobAdded=1");
			unset($_SESSION['added_job_core_skills']);
			unset($_SESSION['added_job_title']);
			unset($_SESSION['added_job_image']);
			unset($_SESSION['added_job_place']);
			unset($_SESSION['added_job_salary_range']);
			unset($_SESSION['added_job_description']);
			$conn->close();
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
