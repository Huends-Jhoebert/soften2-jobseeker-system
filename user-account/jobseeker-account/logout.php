<?php

session_start();
include_once "db-connection.php";
$updateActiveState = "UPDATE users
SET status = 'Offline now'
WHERE user_id = '$_SESSION[user_id]'";
$conn->query($updateActiveState);
session_unset();
session_destroy();
header("Location: ../../index.php");
