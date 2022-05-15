<?php

session_start();
include_once "db-connection2.php";
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
	<title>Jobseeker - Feedback</title>

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
	<div class="header bg-light" style="width: 100%;">
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
				<a href="jobsPosted.php" class="mr-4"><i class="icon-copy fa fa-briefcase text-secondary" aria-hidden="true"></i></a>
				<a href="userFeedback.php" class="mr-4"><i class="icon-copy fa fa-commenting text-primary" aria-hidden="true"></i></a>
				<a href="update.php"><i class="icon-copy fa fa-calendar-check-o text-secondary" aria-hidden="true"></i></a>
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


	<!-- <div class="left-side-bar">
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
				<!-- <div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="userProfile.php">Home</a></li>
									<li class="breadcrumb-item" aria-current="page"><a href="userJobOffers.php">Jobs</a></li>
									<li class="breadcrumb-item active" aria-current="page">Feedback</li>
								</ol>
							</nav>
						</div>
					</div>
				</div> -->
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">FEEDBACK</h4>
							<p class="mb-30">Jobseeker Feedback lets you send JobSeeker suggestions about this system. We welcome problem reports, features ideas and general comments.</p>
						</div>
					</div>
					<form id="feedback">
						<div class="select-role mt-3">
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<label class="btn p-0 py-2 border-0 col-2">
									<input type="radio" name="type" value="good" required>
									<div class="text-center">
										<i class="icon-copy ti-face-smile text-primary" style="font-size: 5rem;"></i>
									</div>
								</label>
								<label class="btn p-0 py-2 border-0 col-2">
									<input type="radio" name="type" value="bad" require_once>
									<div class="text-center">
										<i class="icon-copy ti-face-sad text-danger" style="font-size: 5rem;"></i>
									</div>
								</label>
							</div>
						</div>
						<input type="hidden" name="userId" value="<?php echo $_SESSION['user_id']; ?>">
						<div class="form-group mt-5">
							<textarea class="form-control" name="feedbackMessage" placeholder="...." required></textarea>
						</div>
						<div>
							<button type="submit" name="submitBtn" class="btn btn-primary">Submit</button>
						</div>
					</form>
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

	<script>
		$("#feedback").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/addFeedback.php",
				data: form.serialize(),
				success: function(data) {
					// var closeModalBtn = document.getElementById("closeNewImageBtn");
					// closeModalBtn.click();
					Swal.fire(
						'Feedback',
						'Is successfully sent',
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


</body>

</html>