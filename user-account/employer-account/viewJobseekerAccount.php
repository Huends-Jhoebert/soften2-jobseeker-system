<?php

session_start();
include_once "db-connection.php";
include_once "timeAgo.php";

$selectQueryUser = "SELECT * FROM users WHERE user_id = '$_GET[userId]'";
$selectQueryUserResult = $conn->query($selectQueryUser);
$userInformation = $selectQueryUserResult->fetch_assoc();

$getJobQuery = "SELECT * FROM job WHERE job_id = '$_GET[jobId]'";
$getJobQueryResult = $conn->query($getJobQuery);
$job = $getJobQueryResult->fetch_assoc();

$skills = (explode(",", $userInformation['skills']));
$certs = (explode(",", $userInformation['coe']));

$schools = (explode(",", $userInformation['school']));
$degrees = (explode(",", $userInformation['degree']));
$studyField = (explode(",", $userInformation['study_field']));
$studyYears = (explode(",", $userInformation['study_years']));
?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Jobseeker - Profile</title>

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
						<i class="fa fa-comment __notification" aria-hidden="true"></i><span class="__badge bg-danger">4</span>
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
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll mCustomScrollbar _mCS_2 mCS_no_scrollbar">
			<div id="mCSB_2" class="mCustomScrollBox mCS-dark-2 mCSB_vertical mCSB_inside" tabindex="0" style="max-height: none;">
				<div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
					<div class="right-sidebar-body-content">
						<h4 class="weight-600 font-18 pb-10">Header Background</h4>
						<div class="sidebar-btn-group pb-30 mb-10">
							<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
							<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
						</div>

						<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
						<div class="sidebar-btn-group pb-30 mb-10">
							<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
							<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
						</div>

						<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
						<div class="sidebar-radio-group pb-10 mb-10">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
								<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
								<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
								<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
							</div>
						</div>

						<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
						<div class="sidebar-radio-group pb-30 mb-10">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
								<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
								<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
								<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
								<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
								<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
								<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
							</div>
						</div>

						<div class="reset-options pt-30 text-center">
							<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
						</div>
					</div>
				</div>
				<div id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-dark-2 mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: none;">
					<div class="mCSB_draggerContainer">
						<div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 0px; max-height: 461px; top: 0px;">
							<div class="mCSB_dragger_bar" style="line-height: 30px;"></div>
						</div>
						<div class="mCSB_draggerRail"></div>
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
											<p class="text-muted" style="font-size: 13px;">Posted <?php echo last_seen($job['job_date_posted']); ?></p>
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

</html>