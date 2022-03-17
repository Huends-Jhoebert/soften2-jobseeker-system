<?php

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

$jobOfferQuery = "DELETE FROM job WHERE job_id = '$_GET[jobIdToDelete]'";

$jobOfferQueryResult = $conn->query($jobOfferQuery);


header("Location: userJobOffers.php?successfullyDeleted=1");
