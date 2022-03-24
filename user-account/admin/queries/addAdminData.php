<?php
include_once "db-connection.php";
include_once "randomString.php";

if (isset($_POST['adminBtn'])) {

	$fullName = $_POST['full_name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$image = "";

	$filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
	$folder = "../../../dist/user-images/" . randomString(8) . "/" . $filename;

	mkdir(dirname($folder));

	if (move_uploaded_file($tempname, $folder)) {
		$image = $folder;
	}
	$sql = "INSERT INTO admin (name, p_p, username, password)
	VALUES('$fullName', '$image', '$username', '$password')";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("Location: ../adminLogin.php?successfull=1");
	} else {
		echo mysqli_error($conn);
	}
}
