<?php

session_start();

if (!isset($_GET['moreSkills'])) {
	$_SESSION['added_job_core_skills'] = "";
	$_SESSION['added_job_title'] = "";
	$_SESSION['added_job_place'] =
		"";
	$_SESSION['added_job_salary_range'] =
		"";
	$_SESSION['added_job_description'] =
		"";
}

# database connection file
include 'chat-files/app/db.conn.php';
include_once "db-connection2.php";
include 'chat-files/app/helpers/user.php';
include 'chat-files/app/helpers/conversations.php';
include 'chat-files/app/helpers/timeAgo.php';
include 'chat-files/app/helpers/last_chat.php';
$unreadMessageQuery = "SELECT COUNT(opened) as unreadMessages FROM chats WHERE to_id = '$_SESSION[user_id]' AND opened = '0'";

$unreadMessageQueryResult = mysqli_query($conn2, $unreadMessageQuery);
$numberOfUnread = mysqli_fetch_all($unreadMessageQueryResult, MYSQLI_ASSOC);
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
						<?php if ($numberOfUnread[0]['unreadMessages'] > 1) : ?>
							<i class="fa fa-comment __notification" aria-hidden="true"></i><span class="__badge bg-danger"><?= $numberOfUnread[0]['unreadMessages'];  ?></span>
						<?php endif; ?>
						<?php if ($numberOfUnread[0]['unreadMessages'] < 1) : ?>
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
				Search a jobseeker
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
															<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
																<div title="online">
																	<div class="online"></div>
																</div>
															<?php } ?>
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
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="userProfile.php">Home</a></li>
									<li class="breadcrumb-item" aria-current="page"><a href="userJobOffers.php">Jobs</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add job</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">JOB FORM</h4>
							<p class="mb-30">ENTER JOB INFORMATIONS</p>
						</div>
					</div>
					<form action="../../queries/addEmployerJob.php" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Job Title</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Enter Job Title" value="<?php echo $_SESSION['added_job_title']; ?>" name="title" required>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-sm-12 col-md-2 col-form-label"><span>Job Image</span> <span class="d-block text-muted">Hd image is recommended</span></label>
							<div class="col-sm-12 col-md-10">
								<input type="file" class="form-control-file form-control height-auto" name="image" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Job Place</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="Enter Job Place" name="place" value="<?php echo $_SESSION['added_job_place'];  ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Salary Range</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" type="text" placeholder="ex: 15000 - 25000" name="salary_range" value="<?php echo $_SESSION['added_job_salary_range']; ?>" required>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-sm-12 col-md-2 col-form-label">Core Skills <span class="d-block text-muted">Enter 3 Core Skills</span></label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" data-role="tagsinput" type="text" name="skills" value="<?php echo $_SESSION['added_job_core_skills']; ?>" required>
							</div>
						</div>
						<div class=" form-group">
							<label>Job Description</label>
							<textarea class="form-control" name="description" required><?php echo $_SESSION['added_job_description']; ?></textarea>
						</div>
						<div>
							<button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
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

	<?php if (isset($_GET['jobAdded'])) : ?>
		<script>
			Swal.fire(
				'Address Information',
				'Is successfully updated',
				'success'
			)
		</script>
	<?php endif; ?>

	<?php if (isset($_GET['moreSkills'])) : ?>
		<script>
			Swal.fire(
				'Core Skills',
				'Must not exceed more than 3 skills',
				'error'
			)
		</script>
	<?php endif; ?>

	<!-- <script>
		var textArea = document.getElementsByTagName("textarea");
		textArea.value = "asdasdasd";
	</script> -->

</body>

</html>