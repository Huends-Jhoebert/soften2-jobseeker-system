<?php

session_start();
define('TIMEZONE', 'Asia/Manila');
date_default_timezone_set(TIMEZONE);

# check if the user is logged in
if (isset($_SESSION['username'])) {

	# database connection file
	include '../db.conn.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['user_id'];

	$sql = "UPDATE users
	        SET last_seen = now()
	        WHERE user_id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);
} else {
	header("Location: ../../index.php");
	exit;
}
