<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

define('TIMEZONE', 'Asia/Manila');
date_default_timezone_set(TIMEZONE);

$feedbackMessage = $conn->real_escape_string($_POST['feedbackMessage']);
$userId = $_POST['userId'];
$type = $_POST['type'];
$date = date('Y-m-d h:i:s');

$sql1 = "INSERT INTO feedback (user_id, type, feedback_message, date_created) VALUES ('$userId', '$type','$feedbackMessage', '$date')";
$conn->query($sql1);

$sql2 = "INSERT INTO feedback_report (user_id, type, date_created) VALUES ('$userId', '$type', '$date')";
$conn->query($sql2);
$conn->close();
