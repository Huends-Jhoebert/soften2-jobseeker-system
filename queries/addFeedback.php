<?php


$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

$feedbackMessage = $conn->real_escape_string($_POST['feedbackMessage']);
$userId = $_POST['userId'];
$type = $_POST['type'];

$sql1 = "INSERT INTO feedback (user_id, type, feedback_message) VALUES ('$userId', '$type','$feedbackMessage')";
$conn->query($sql1);

$sql2 = "INSERT INTO feedback_report (user_id, type) VALUES ('$userId', '$type')";
$conn->query($sql2);
$conn->close();
