<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (name LIKE '%{$searchTerm}%' AND unique_id <> '523287705') AND (type <> '$_SESSION[type]' AND type <> 'user')";
$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    include_once "data1.php";
} else {
    $output .= 'No user found related to your search term';
}
echo $output;
