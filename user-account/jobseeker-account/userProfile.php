<?php

session_start();

$skills = (explode(",", $_SESSION['skills']));
$certs = (explode(",", $_SESSION['coe']));

$schools = (explode(",", $_SESSION['school']));
$degrees = (explode(",", $_SESSION['degree']));
$studyField = (explode(",", $_SESSION['study_field']));
$studyYears = (explode(",", $_SESSION['study_years']));
?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employer - Profile</title>

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
			<div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
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
								<a href="#" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-user-1"></span><span class="mtext">Profile</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle no-arrow" data-option="off">
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
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-50-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="../<?php echo $_SESSION['p_p']; ?>" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<form action="../../queries/updateImage.php" method="POST" enctype="multipart/form-data">
												<div class="modal-body pd-5 p-2">
													<h5 class="mb-3">Insert New Logo</h5>
													<div class="form-group">
														<input type="file" class="form-control-file form-control height-auto" name="image">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary" name="employerNewImageBtn">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<h5 class="text-center h5 mb-0"><?php echo $_SESSION['name']; ?></h5>
							<p class="text-center text-muted font-14 d-hide"><?php echo $_SESSION['type']; ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $_SESSION['email_address']; ?>
									</li>
									<li>
										<span>Contact Number:</span>
										<?php echo $_SESSION['contact_number']; ?>
									</li>
									<li>
										<span>Address:</span>
										<?php echo $_SESSION['address']; ?>
									</li>
								</ul>
							</div>
							<div class="profile-info">
								<div class="d-flex justify-content-between">
									<h5 class="mb-20 h5 text-blue" style="margin-bottom: 10px!important;">Education</h5>
									<a href="modal" data-toggle="modal" data-target="#addEducation" class="edit-avatar"><i class="icon-copy fa fa-plus" aria-hidden="true"></i></a>
									<div class="modal fade" id="addEducation" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<form method="POST" id="addJobseekerEducation">
													<div class="modal-body pd-5 p-2">
														<h5 class="mb-3">Education</h5>
														<div class="form-group">
															<label class="col-sm-4 col-form-label">School*</label>
															<div class="col-sm-8">
																<input type="text" name="school" class="form-control" placeholder="ex. The Lewis College" value="" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 col-form-label">Degree*</label>
															<div class="col-sm-8">
																<input type="text" name="degree" class="form-control" placeholder="ex. Bachelor's" value="" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 col-form-label">Field of Study*</label>
															<div class="col-sm-8">
																<input type="text" name="field_of_study" class="form-control" placeholder="ex. Business" value="" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 col-form-label">Start Date*</label>
															<div class="col-sm-8">
																<input type="text" name="start_date" class="form-control" value="" required>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-4 col-form-label">End Date*</label>
															<div class="col-sm-8">
																<input type="text" name="end_date" class="form-control" value="" required>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-primary" name="employerNewImageBtn">Add</button>
													</div>
												</form>
											</div>
										</div>
									</div>
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
									<a href="modal" data-toggle="modal" data-target="#addSkills" class="edit-avatar"><i class="icon-copy fa fa-plus" aria-hidden="true"></i></a>
									<div class="modal fade" id="addSkills" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<form method="POST" id="updateSkills">
													<div class="modal-body pd-5 p-4">
														<h5 class="mb-3">Skills</h5>
														<div class="mb-0">
															<input type="text" data-role="tagsinput" value="<?php foreach ($skills as $skill) : ?>
																	<?php echo $skill . ","; ?>
																<?php endforeach; ?>" style="display: none;" name="skills">
														</div>
													</div>
													<div class="modal-footer">
														<button type="submit" class="btn btn-info" name="updateSkills">Update</button>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="bootstrap-tagsinput text-left" style="border: none !important;">
									<?php foreach ($skills as $skill) : ?>
										<span class="tag label label-info bg-info"><?php echo $skill; ?></span>
									<?php endforeach; ?>
									<input type="text" placeholder="" style="border: none !important;">
								</div>
							</div>
							<div class="profile-skills">
								<div class="d-flex justify-content-between">
									<h5 class="mb-20 h5 text-blue" style="margin-bottom: 10px!important;">Honors & awards</h5>
									<a href="modal" data-toggle="modal" data-target="#addHonorsAndAward" class="edit-avatar"><i class="icon-copy fa fa-plus" aria-hidden="true"></i></a>
								</div>
								<div class="modal fade" id="addHonorsAndAward" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<form method="POST" id="updateCeo">
												<div class="modal-body pd-5 p-4">
													<h5 class="mb-3">Honors & awards</h5>
													<div class="mb-0">
														<input type="text" data-role="tagsinput" value="<?php foreach ($certs as $cert) : ?>
																	<?php echo $cert . ","; ?>
																<?php endforeach; ?>" style="display: none;" name="coe">
													</div>
												</div>
												<div class="modal-footer">
													<button type="submit" class="btn btn-info" name="updateCeo">Update</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="bootstrap-tagsinput text-left" style="border: none !important;">
									<?php foreach ($certs as $cert) : ?>
										<span class="tag label label-info bg-success"><?php echo $cert; ?></span>
									<?php endforeach; ?>
									<input type="text" placeholder="" style="border: none !important;">
								</div>
							</div>
							<!-- <div class="profile-social">
								<h5 class="mb-20 h5 text-blue">Social Links</h5>
								<ul class="clearfix">
									<li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(59, 89, 152);"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(29, 161, 242);"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 123, 181);"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(244, 111, 48);"><i class="fa fa-instagram"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(195, 35, 97);"><i class="fa fa-dribbble"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(61, 70, 77);"><i class="fa fa-dropbox"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(219, 68, 55);"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(189, 8, 28);"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 175, 240);"><i class="fa fa-skype"></i></a></li>
									<li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff" style="color: rgb(255, 255, 255); background-color: rgb(0, 180, 137);"><i class="fa fa-vine"></i></a></li>
								</ul>
							</div> -->
							<!-- <div class="profile-skills">
								<h5 class="mb-20 h5 text-blue">Key Skills</h5>
								<h6 class="mb-5 font-14">HTML</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5 font-14">Css</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 70%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5 font-14">jQuery</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<h6 class="mb-5 font-14">Bootstrap</h6>
								<div class="progress mb-20" style="height: 6px;">
									<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div> -->
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-50-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<!-- <li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab" aria-selected="true">Timeline</a>
										</li> -->
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab" aria-selected="false">Settings</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Timeline Tab start -->
										<!-- <div class="tab-pane fade active show" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="profile-timeline">
													<div class="timeline-month">
														<h5>August, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 Aug</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 Aug</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
													<div class="timeline-month">
														<h5>July, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 July</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 July</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
													<div class="timeline-month">
														<h5>June, 2020</h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															<li>
																<div class="date">12 June</div>
																<div class="task-name"><i class="ion-android-alarm-clock"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 June</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i> Task Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
															<li>
																<div class="date">10 June</div>
																<div class="task-name"><i class="ion-ios-clock"></i> Event Added</div>
																<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
																<div class="task-time">09:30 am</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div> -->
										<!-- Timeline Tab End -->

										<!-- Setting Tab start -->
										<div class="tab-pane fade active show height-25-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form id="profileEdit" method="POST">
													<ul class="profile-edit-list row pb-0">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Personal Informations</h4>
															<div class="form-group">
																<label>Full Name</label>
																<input class="form-control form-control-lg" name="name" type="text">
															</div>
															<div class="form-group">
																<label>Contact Number</label>
																<input class="form-control form-control-lg" name="number" type="text">
															</div>
															<div class="form-group mb-0">
																<a href="#" class="btn btn-primary" data-backdrop="static" data-toggle="modal" data-target="#Medium-modal" type="button">
																	Update Information
																</a>
																<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-centered">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h4 class="modal-title" id="myLargeModalLabel">Input Old Password</h4>
																				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																			</div>
																			<div class="modal-body">
																				<div class="input-group custom">
																					<input type="password" class="form-control form-control-lg" placeholder="**********" name="passwordRetype">
																					<div class="input-group-append custom">
																						<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
																					</div>
																				</div>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose">Close</button>
																				<button type="submit" class="btn btn-primary" name="submitBtn">Update</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!-- <button name="updateInfoBtn" class="btn btn-primary">Update Information</button> -->
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20" style="visibility: hidden;">Edit Social Media links</h4>
															<div class="form-group">
																<label>Email Account:</label>
																<input class="form-control form-control-lg" name="email_address" type="email">
															</div>
															<div class="form-group">
																<label>Password:</label>
																<input class="form-control form-control-lg" name="password" type="password">
															</div>
														</li>
													</ul>
												</form>
												<form id="addressEdit" method="POST">
													<ul class="profile-edit-list row pt-0">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Address Information</h4>
															<div class="form-group">
																<label>Region</label>
																<input class="form-control form-control-lg" name="region" type="text">
															</div>
															<div class="form-group">
																<label>City:</label>
																<input class="form-control form-control-lg" name="city" type="text">
															</div>
															<div class="form-group">
																<label>Postal Code:</label>
																<input class="form-control form-control-lg" name="postal_code" type="text">
															</div>
															<div class="form-group mb-0">
																<button type="submit" name="updateInfoBtn" class="btn btn-primary">Update Address</button>
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20" style="visibility: hidden;">Edit Social Media links</h4>
															<div class="form-group">
																<label>Province:</label>
																<input class="form-control form-control-lg" name="province" type="text">
															</div>
															<div class="form-group">
																<label>Barangay:</label>
																<input class="form-control form-control-lg" name="barangay" type="text">
															</div>
															<div class="form-group">
																<label>Street Name, Building, House No.*:</label>
																<input class="form-control form-control-lg" name="address_more_info" type="text">
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
									</div>
									<!-- Setting Tab End -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="footer-wrap pd-20 mb-20 card-box">
			DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
		</div> -->
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


	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script>
		//CODE FOR AJAX INSERT
		$("#profileEdit").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/updateJobseekerInfo.php",
				data: form.serialize(),
				success: function(data) {
					var closeModalBtn = document.getElementById("btnClose");
					closeModalBtn.click();
					Swal.fire(
						'Personal Informations',
						'Are successfully updated',
						'success'
					).then((result) => {
						if (result) {
							location.reload();
						}
					})
				},
				error: function(request, status, error) {
					var closeModalBtn = document.getElementById("btnClose");
					closeModalBtn.click();
					if (error == "Bad Request") {
						Swal.fire(
							'Password',
							'Is incorrect',
							'error'
						)
					} else if (error == "Internal Server Error") {
						Swal.fire(
							'Email Account',
							'Has been used by other',
							'error'
						)
					}
				}
			});
		});
		//END CODE FOR AJAX INSERT

		$("#addressEdit").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/updateAddress.php",
				data: form.serialize(),
				success: function(data) {
					// var closeModalBtn = document.getElementById("closeNewImageBtn");
					// closeModalBtn.click();
					Swal.fire(
						'Address Information',
						'Is successfully updated',
						'success'
					).then((result) => {
						if (result) {
							location.reload();
						}
					})
				}
			});
		});
		//END CODE FOR AJAX INSERT


		$("#addJobseekerEducation").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/addJobseekerEducation.php",
				data: form.serialize(),
				success: function(data) {
					// var closeModalBtn = document.getElementById("closeNewImageBtn");
					// closeModalBtn.click();
					Swal.fire(
						'Education',
						'Is successfully updated',
						'success'
					).then((result) => {
						if (result) {
							location.reload();
						}
					})
				}
			});
		});

		$("#updateSkills").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/updateJobseekerSkills.php",
				data: form.serialize(),
				success: function(data) {
					// var closeModalBtn = document.getElementById("closeNewImageBtn");
					// closeModalBtn.click();
					Swal.fire(
						'Skills',
						'Is successfully updated',
						'success'
					).then((result) => {
						if (result) {
							location.reload();
						}
					})
				}
			});
		});

		$("#updateCeo").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/updateJobseekerCeo.php",
				data: form.serialize(),
				success: function(data) {
					// var closeModalBtn = document.getElementById("closeNewImageBtn");
					// closeModalBtn.click();
					Swal.fire(
						'Honors & awards',
						'Are successfully updated',
						'success'
					).then((result) => {
						if (result) {
							location.reload();
						}
					})
				}
			});
		});
	</script>
	<?php if (isset($_GET['newImage'])) : ?>
		<script>
			Swal.fire(
				'New logo',
				'Is successfully added',
				'success'
			)
		</script>
	<?php endif ?>
	<!--
	<?php if (isset($_GET['newInfo'])) : ?>
		<script>
			Swal.fire(
				'Personal Informations',
				'Are successfully updated',
				'success'
			)
		</script>
	<?php endif ?> -->

</body>

</html>