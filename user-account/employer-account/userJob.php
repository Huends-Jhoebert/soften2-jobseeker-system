<?php

session_start();

include_once "db-connection.php";

if (!isset($_GET['moreSkills'])) {
	$_SESSION['added_job_core_skills'] = "";
	$_SESSION['added_job_title'] = "";
	$_SESSION['added_job_place'] =
		"";
	$_SESSION['added_job_salary_range'] =
		"";
	$_SESSION['added_job_description'] =
		"";
	$_SESSION['job_requirements'] = "";
	$_SESSION['career_growth'] = "";
}

$getlastChat = "SELECT incoming_msg_id FROM messages WHERE outgoing_msg_id = '$_SESSION[unique_id]' ORDER BY msg_id DESC LIMIT 1";

$getlastChatResult = $conn->query($getlastChat);
$lastChat = $getlastChatResult->fetch_assoc();

$getlastChat1 = "SELECT outgoing_msg_id FROM messages WHERE incoming_msg_id = '$_SESSION[unique_id]' ORDER BY msg_id DESC LIMIT 1";
$getlastChatResult1 = $conn->query($getlastChat1);
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
	<title>Employer - Adding Job</title>

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
</head>

<body class="header-white sidebar-dark">
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>
		<div class="header-right">
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
								<a href="chat-files/chat.php?user_id=<?= $chatUserId; ?>" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-message"></span><span class="mtext">Chat</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="userJobOffers.php" class="dropdown-toggle no-arrow" data-option="off">
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
								<input type="file" class="form-control-file form-control height-auto" name="image" accept="image/*" required>
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
							<label class="col-sm-12 col-md-2 col-form-label">Job Requirements</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" data-role="tagsinput" type="text" name="job_requirements" value="<?php echo $_SESSION['job_requirements']; ?>" required>
							</div>
						</div>
						<div class="form-group row align-items-center">
							<label class="col-sm-12 col-md-2 col-form-label">Core Skills <span class="d-block text-muted">Enter 3 Core Skills</span></label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control" data-role="tagsinput" type="text" name="skills" value="<?php echo $_SESSION['added_job_core_skills']; ?>" required>
							</div>
						</div>
						<div class="form-group">
							<label>Job Description</label>
							<textarea class="form-control" name="description" maxlength="10000" required><?php echo $_SESSION['added_job_description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Career Growth</label>
							<textarea class="form-control" name="career_growth" maxlength="10000" required><?php echo $_SESSION['career_growth']; ?></textarea>
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
				'Job',
				'Is successfully posted',
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
			// setInterval(lastSeenUpdate, 5000);

		});
	</script>


</body>

</html>