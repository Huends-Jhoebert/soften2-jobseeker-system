<?php

session_start();

include_once "db-connection2.php";
include_once "timeAgo.php";

if (isset($_POST['searchJobBtn'])) {
	if ($_POST['find_job_location'] != "" && $_POST['find_title'] == "") {
		$getAllJobSql = "SELECT * FROM job WHERE job_place LIKE '%$_POST[find_job_location]%' ORDER BY job_date_posted DESC";
		$getAllJobSqlresult = mysqli_query($conn2, $getAllJobSql);
		$jobs = mysqli_fetch_all($getAllJobSqlresult, MYSQLI_ASSOC);
	} else if ($_POST['find_job_location'] == "" && $_POST['find_title'] != "") {
		$getAllJobSql = "SELECT * FROM job WHERE job_title LIKE '%$_POST[find_title]%' ORDER BY job_date_posted DESC";
		$getAllJobSqlresult = mysqli_query($conn2, $getAllJobSql);
		$jobs = mysqli_fetch_all($getAllJobSqlresult, MYSQLI_ASSOC);
	} else if ($_POST['find_job_location'] != "" && $_POST['find_title'] != "") {
		$getAllJobSql = "SELECT * FROM job WHERE job_title LIKE '%$_POST[find_title]%' AND job_place LIKE '%$_POST[find_job_location]%' ORDER BY job_date_posted DESC";
		$getAllJobSqlresult = mysqli_query($conn2, $getAllJobSql);
		$jobs = mysqli_fetch_all($getAllJobSqlresult, MYSQLI_ASSOC);
	}
} else {
	$getAllJobSql = "SELECT * FROM job ORDER BY job_date_posted DESC";
	$getAllJobSqlresult = mysqli_query($conn2, $getAllJobSql);
	$jobs = mysqli_fetch_all($getAllJobSqlresult, MYSQLI_ASSOC);
}

$getlastChat = "SELECT incoming_msg_id FROM messages WHERE outgoing_msg_id = '$_SESSION[unique_id]' ORDER BY msg_id DESC LIMIT 1";

$getlastChatResult = $conn2->query($getlastChat);
$lastChat = $getlastChatResult->fetch_assoc();

$getlastChat1 = "SELECT outgoing_msg_id FROM messages WHERE incoming_msg_id = '$_SESSION[unique_id]' ORDER BY msg_id DESC LIMIT 1";
$getlastChatResult1 = $conn2->query($getlastChat1);
$lastChat1 = $getlastChatResult1->fetch_assoc();

if ($lastChat == NULL && $lastChat1 == NULL) {
	$chatUserId = "522287705";
} else if ($lastChat != NULL) {
	$chatUserId = $lastChat['incoming_msg_id'];
} else if ($lastChat1 != NULL) {
	$chatUserId = $lastChat1['outgoing_msg_id'];
}

?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Jobseeker - Jobs</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/cropperjs/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/style.css">
	<link rel="stylesheet" href="../../template-files/sweetalert/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">
	<link rel="stylesheet" href="chat-files/css/style.css">

	<style>
		.checked {
			color: #deb217;
		}
	</style>

</head>

<body class="header-white sidebar-dark">
	<div class="header" style="width: 100%;">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			<div class="brand-logo">
				<a href="#">
					<img src="../../template-files/vendors/images/logo1-removebg.png" alt="">
				</a>
			</div>
		</div>
		<div class="header-right">
			<div class="mr-5 d-flex align-items-center" style="font-size: 25px;">
				<a href="userProfile.php" class="mr-4"><i class="icon-copy fa fa-user text-secondary" aria-hidden=" true"></i></a>
				<a href="chat-files/chat.php?user_id=<?= $chatUserId; ?>" class="mr-4"><i class="icon-copy fa fa-comment text-secondary" aria-hidden=" true"></i></a>
				<a href="jobsPosted.php" class="mr-4"><i class="icon-copy fa fa-briefcase text-primary" aria-hidden="true"></i></a>
				<a href="userFeedback.php" class="mr-4"><i class="icon-copy fa fa-commenting text-secondary" aria-hidden="true"></i></a>
				<a href="#"><i class="icon-copy fa fa-calendar-check-o text-secondary" aria-hidden="true"></i></a>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" style="padding: 0px !important;">
						<span class="user-icon">
							<img src="../<?php echo $_SESSION['p_p']; ?>" alt="">
						</span>
						<span class="user-name"><?php echo $_SESSION['name']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<!-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a> -->
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
			<div class="github-link">
				<a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg" alt=""></a>
			</div>
		</div>
	</div>
	<!-- 
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="#">
				Home
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll mCustomScrollbar _mCS_3">
			<div id="mCSB_3" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
				<div id="mCSB_3_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
					<div class="sidebar-menu icon-style-1 icon-list-style-1">
						<ul id="accordion-menu">
							<li class="dropdown">
								<a href="userProfile.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-user-1"></span><span class="mtext">Profile</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="chat-files/chat.php?user_id=<?= $chatUserId; ?>" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-message"></span><span class="mtext">Chat</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="jobsPosted.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-briefcase"></span><span class="mtext">Jobs</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="userFeedback.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-chat"></span><span class="mtext">Feedback</span>
								</a>
							</li>
							<li>
								<a href="#" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-calendar1"></span><span class="mtext">Update</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div> -->

	<div class="mobile-menu-overlay"></div>

	<div class="main-container" style="padding-left: 0px !important;">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="container pd-0">
					<!-- <div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#">Home</a></li>
										<li class="breadcrumb-item active" aria-current="page">Jobs</li>
									</ol>
								</nav>
							</div>
						</div>
					</div> -->
					<div class="page-header rounded-0">
						<form action="" method="POST">
							<div class="row justify-content-center">
								<div class="col-lg-4 col-md-4 col-sm-4 search-div">
									<input class="form-control d-block" placeholder="&#xF002; Job title" type="search" style="font-family:Arial, FontAwesome" name="find_title">
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 search-div">
									<input class="form-control d-block" type="search" placeholder="&#xf041; Job location" style="font-family:Arial, FontAwesome" name="find_job_location">
								</div>
								<div class="col-lg-2 col-md-2 col-sm-4 search-div   ">
									<button type="submit" name="searchJobBtn" class="btn btn-primary d-block">SEARCH</button>
								</div>
							</div>
						</form>
					</div>
					<div class="contact-directory-list">
						<ul class="row justify-content-center">
							<?php if (count($jobs) > 0) : ?>
								<?php foreach ($jobs as $job) : ?>
									<?php
									$sql = "SELECT * from users WHERE user_id = '$job[job_employer_id]'";
									$result = $conn2->query($sql);
									$row = $result->fetch_assoc();

									$numberOfApplicantsSql = "SELECT COUNT(job_applicant_jobseeker_id) AS NumberOfApplicants FROM job_applicant WHERE job_id = '$job[job_id]'";
									$numberOfApplicantsSqlResult = $conn2->query($numberOfApplicantsSql);
									$applicants = $numberOfApplicantsSqlResult->fetch_assoc();

									?>
									<li class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
										<div class="contact-directory-box">
											<div class="contact-dire-info text-center">
												<div class="contact-avatar">
													<span>
														<img src="../<?php echo $row['p_p']; ?>" alt="" class="h-100">
													</span>
												</div>
												<div class="contact-name">
													<h4><?php echo $job['job_title']; ?>
													</h4>
													<p><?php echo $row['name']; ?><span class="badge badge-pill badge-primary ml-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Number of applicants">+ <?php echo $applicants['NumberOfApplicants']; ?></span></p>
													<div class="work text-success"><span class="icon-copy ti-location-pin"></span> <?php echo $job['job_place']; ?></div>
												</div>
												<div>
													<!-- <p><?= $job['rate']; ?></p> -->
													<?php if ($job['rate'] == 0) : ?>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
													<?php endif; ?>
													<?php if ($job['rate'] == 1) : ?>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
													<?php endif; ?>
													<?php if ($job['rate'] == 2) : ?>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
													<?php endif; ?>
													<?php if ($job['rate'] == 3) : ?>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star"></span>
														<span class="fa fa-star"></span>
													<?php endif; ?>
													<?php if ($job['rate'] == 4) : ?>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star"></span>
													<?php endif; ?>
													<?php if ($job['rate'] == 5) : ?>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
														<span class="fa fa-star checked"></span>
													<?php endif; ?>
												</div>
												<div class="contact-skill">
													<?php $jobSkills = (explode(",", $job['job_skills'])); ?>
													<?php foreach ($jobSkills as $jobSkill) : ?>
														<span class="badge badge-pill" style="text-transform: capitalize;"><?php echo $jobSkill; ?></span>
													<?php endforeach; ?>
												</div>
												<div class="profile-sort-desc">
													<?php echo time_posted($job['job_date_posted']); ?>
												</div>
												<div class="view-contact mt-3">
													<a href="jobMoreDetails.php?jobId=<?php echo $job['job_id']; ?>">Read More</a>
												</div>
											</div>
									</li>
								<?php endforeach; ?>
							<?php endif; ?>
							<?php if (count($jobs) < 1) : ?>
								<div class="page-header">
									<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="title">
												<h1 class="h1">Nothing Found..</h1>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- js -->
	<script src="../../template-files/vendors/scripts/core.js"></script>
	<script src="../../template-files/vendors/scripts/script.min.js"></script>
	<script src="../../template-files/vendors/scripts/process.js"></script>
	<script src="../../template-files/vendors/scripts/layout-settings.js"></script>
	<script src="../../template-files/src/plugins/cropperjs/dist/cropper.js"></script>
	<script src="../../template-files/sweetalert/sweetalert2.min.js"></script>
	<script src="../../template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function() {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function() {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function() {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function() {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>

	<?php if (isset($_GET['resumeSent'])) : ?>
		<script>
			Swal.fire(
				'Resume',
				'Is successfully submitted',
				'success'
			)
		</script>
	<?php endif ?>



</body>
<script>
	$(document).ready(function() {

		/** 
		auto update last seen 
		for logged in user
		**/
		let lastSeenUpdate = function() {
			$.get("chat-files/app/ajax/update_last_seen.php");
		}
		lastSeenUpdate();
		/** 
		auto update last seen 
		every 10 sec
		**/
		setInterval(lastSeenUpdate, 5000);


	});
</script>


</html>