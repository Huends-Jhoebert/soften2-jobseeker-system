<?php

include_once "db-connection.php";


$id = $_GET['feedBackId'];

$sql = "DELETE FROM feedback WHERE feedback_id = '$id'";

$conn->query($sql);

header("Location: ../admin-pages/adminPage2.php?feedbackRemoved=1");
