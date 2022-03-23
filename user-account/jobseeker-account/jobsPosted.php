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

$sql = "SELECT COUNT(opened) as unreadMessages FROM chats WHERE to_id = '$_SESSION[user_id]' AND opened = '0'";

$result = mysqli_query($conn2, $sql);
$numberOfUnread = mysqli_fetch_all($result, MYSQLI_ASSOC);

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

		@media screen and (max-width: 480px) {
			.search-div {
				margin-top: 1rem;
			}
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
				Search employer
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
				<!-- <div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-dark-2 mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: none;">
					<div class="mCSB_draggerContainer">
						<div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 0px; max-height: 461px; top: 0px;">
							<div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
						</div>
						<div class="mCSB_draggerRail"></div>
					</div>
				</div> -->
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
								<a href="jobsPosted.php" class="dropdown-toggle no-arrow" data-option="off">
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
				<div class="container pd-0">
					<div class="page-header">
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
					</div>
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
			$.post('chat-files/app/ajax/search.php', {
					key: searchText
				},
				function(data, status) {
					$("#chatList").html(data);
				});
		});

	});
</script>

</html>