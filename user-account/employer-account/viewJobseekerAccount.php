<?php

session_start();
include_once "db-connection2.php";
include_once "timeAgo.php";

$selectQueryUser = "SELECT * FROM users WHERE user_id = '$_GET[userId]'";
$selectQueryUserResult = $conn2->query($selectQueryUser);
$userInformation = $selectQueryUserResult->fetch_assoc();

$getJobQuery = "SELECT * FROM job WHERE job_id = '$_GET[jobId]'";
$getJobQueryResult = $conn2->query($getJobQuery);
$job = $getJobQueryResult->fetch_assoc();

$skills = (explode(",", $userInformation['skills']));
$certs = (explode(",", $userInformation['coe']));

$schools = (explode(",", $userInformation['school']));
$degrees = (explode(",", $userInformation['degree']));
$studyField = (explode(",", $userInformation['study_field']));
$studyYears = (explode(",", $userInformation['study_years']));


# database connection file
include 'chat-files/app/db.conn.php';

include 'chat-files/app/helpers/user.php';
include 'chat-files/app/helpers/conversations.php';
include 'chat-files/app/helpers/timeAgo.php';
include 'chat-files/app/helpers/last_chat.php';

# Getting User data data
$user = getUser($_SESSION['name'], $conn);

# Getting User conversations
$conversations = getConversation($user['user_id'], $conn);

$unreadMessageQuery = "SELECT COUNT(opened) as unreadMessages FROM chats WHERE to_id = '$_SESSION[user_id]' AND opened = '0'";

$unreadMessageQueryResult = mysqli_query($conn2, $unreadMessageQuery);
$numberOfUnread = mysqli_fetch_all($unreadMessageQueryResult, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employer - Jobseeker Profile</title>

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
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">
	<link rel="stylesheet" href="chat-files/css/style.css">
	<style>
		.__notification {
			position: relative;
			display: inline-block;
			font-size: 1.1rem;
		}

		.__badge {
			position: absolute;
			padding: 3px 7px;
			top: 3px;
			right: 0px;
			border-radius: 50%;
			color: white;
			font-size: .6rem;
		}
	</style>


</head>

<body class="header-white sidebar-dark">
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>
		<div class="header-right">
			<div class="dashboard-setting user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
						<?php if (intval($numberOfUnread[0]['unreadMessages']) > 0) : ?>
							<i class="fa fa-comment __notification" aria-hidden="true"></i><span class="__badge bg-danger"><?= $numberOfUnread[0]['unreadMessages'];  ?></span>
						<?php endif; ?>
						<?php if (intval($numberOfUnread[0]['unreadMessages']) < 1) : ?>
							<i class="fa fa-comment __notification" aria-hidden="true"></i>
						<?php endif; ?>
					</a>
				</div>
			</div>
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
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

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue text-uppercase">
				Search jobseeker
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll mCustomScrollbar _mCS_2 mCS_no_scrollbar">
			<div id="mCSB_2" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
				<div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
					<div class="right-sidebar-body-content p-0">
						<div class="p-2">
							<div class="">
								<div class="d-flex align-items-center">
									<!-- <a href="home.php" class="fs-4 link-dark me-3 back-arrow" style="display: none;">&#8592;</a> -->
									<div class="input-group mb-3">
										<input type="text" placeholder="Search..." id="searchText" class="form-control">
										<button class="btn btn-primary" id="serachBtn">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								<ul id="chatList" class="list-group mvh-50 overflow-auto">
									<?php if (!empty($conversations)) { ?>
										<?php
										foreach ($conversations as $conversation) { ?>
											<li class="list-group-item">
												<a href="chat.php?user=<?= $conversation['user_id'] ?>" class="d-flex
	    				          justify-content-between
	    				          align-items-center p-2">
													<div class="d-flex
	    					            align-items-center">
														<img src="../<?= $conversation['p_p'] ?>" class="w-10 rounded-circle">
														<h3 class="fs-xs m-2">
															<?= $conversation['name'] ?><br>
															<small>
																<?php
																echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn);
																?>
															</small>
														</h3>
													</div>
													<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
														<div title="online">
															<div class="online"></div>
														</div>
													<?php } ?>
												</a>
											</li>
										<?php } ?>
									<?php } else { ?>
										<div class="alert alert-info 
    				            text-center">
											<i class="fa fa-comments d-block fs-big"></i>
											No messages yet, Start the conversation
										</div>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
								<a href="userJobOffers.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-briefcase"></span><span class="mtext">Jobs</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle no-arrow" data-option="off">
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
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="userProfile.php">Home</a></li>
									<li class="breadcrumb-item" aria-current="page"><a href="#">Jobs</a></li>
									<li class="breadcrumb-item" aria-current="page"><a href="#">Job Information</a></li>
									<li class="breadcrumb-item active" aria-current="page">Jobseeker Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-50-p">
							<div class="profile-photo">
								<img src="../<?php echo $userInformation['p_p']; ?>" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-0"><?php echo $userInformation['name']; ?></h5>
							<p class="text-center text-muted font-14 d-hide"><?php echo $userInformation['type']; ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $userInformation['email_account']; ?>
									</li>
									<li>
										<span>Contact Number:</span>
										<?php echo $userInformation['contact_number']; ?>
									</li>
									<li>
										<span>Address:</span>
										<?php echo $userInformation['address']; ?>
									</li>
								</ul>
							</div>
							<div class="profile-info">
								<div class="d-flex justify-content-between">
									<h5 class="mb-20 h5 text-blue" style="margin-bottom: 10px!important;">Education</h5>
								</div>
								<ul>
									<?php for ($start = 0; $start < count($schools); $start++) : ?>
										<li>
											<span class="text-dark m-0 p-0" style="font-weight: bolder!important;"><?php echo $schools[$start]; ?></span>
											<span class="m-0 p-0 text-dark">
												<?php echo $degrees[$start] . " - " . $studyField[$start]; ?>
											</span>
											<span class="text-muted"><?php echo $studyYears[$start] ?></span>
										</li>
									<?php endfor; ?>
								</ul>
							</div>
							<div class="profile-skills">
								<div class="d-flex justify-content-between">
									<h5 class="mb-20 h5 text-blue" style="margin-bottom: 10px!important;">Key Skills</h5>
								</div>
								<div class="bootstrap-tagsinput text-left" style="border: none !important;">
									<?php foreach ($skills as $skill) : ?>
										<span class="tag label label-info bg-info text-uppercase"><?php echo $skill; ?></span>
									<?php endforeach; ?>
									<input type="text" placeholder="" style="border: none !important;">
								</div>
							</div>
							<div class="profile-skills">
								<div class="d-flex justify-content-between">
									<h5 class="mb-20 h5 text-blue" style="margin-bottom: 10px!important;">Honors & awards</h5>
								</div>
								<div class="bootstrap-tagsinput text-left" style="border: none !important;">
									<?php foreach ($certs as $cert) : ?>
										<span class="tag label label-info bg-success text-uppercase"><?php echo $cert; ?></span>
									<?php endforeach; ?>
									<input type="text" placeholder="" style="border: none !important;">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-50-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab" aria-selected="false">JOB INFORMATION</a>
										</li>
									</ul>
									<div class="tab-content p-3">

										<div class="tab-pane fade active show height-25-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<div class="mt-2">
													<img src="../<?php echo $job['job_image']; ?>" class="d-block" alt="" width="100%" style="height: 250px;">
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<h5 class="text-dark mt-3 h3"><?php echo $job['job_title']; ?></h5>
										</div>
										<div>
											<p class="h6 m-0"><?php echo $job['job_place']; ?></p>
											<p class="m-0">Salary <?php echo $job['job_salary_range']; ?></p>
											<p class="text-muted" style="font-size: 13px;">Posted <?php echo time_past($job['job_date_posted']); ?></p>
										</div>
										<div class="mt-5">
											<h5 class="h5">
												Job description
											</h5>
											<p class="text-justify">
												<?php
												echo $job['job_description'];
												?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
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

</body>

<script>
	$(document).ready(function() {

		// Search
		$("#searchText").on("input", function() {
			var searchText = $(this).val();
			if (searchText == "") return;
			$.post('chat-files/app/ajax/search.php', {
					key: searchText
				},
				function(data, status) {
					$("#chatList").html(data);
				});
		});

		// Search using the button
		$("#serachBtn").on("click", function() {
			var searchText = $("#searchText").val();
			if (searchText == "") return;
			$.post('app/ajax/search.php', {
					key: searchText
				},
				function(data, status) {
					$("#chatList").html(data);
				});
		});


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
		// setInterval(lastSeenUpdate, 5000);

	});
</script>

</html>