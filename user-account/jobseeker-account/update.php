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
				<a href="userFeedback.php" class="mr-4"><i class="icon-copy fa fa-commenting text-secondary" aria-hidden="true"></i></a>
				<a href="update.php"><i class="icon-copy fa fa-calendar-check-o text-primary" aria-hidden="true"></i></a>
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

	<div class="mobile-menu-overlay"></div>

	<div class="main-container" style="padding-left: 0px !important;">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="userJobOffers.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Updates</a></li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Default Basic Forms Start -->
				<?php

				$sql = "SELECT * FROM system_update";
				$result = $conn->query($sql);
				$results = $result->fetch_all(MYSQLI_ASSOC);

				?>
				<div class="container pd-0">
					<div class="timeline mb-30 p-4">
						<ul>
							<?php foreach ($results as $key => $row) : ?>
								<li>
									<div class="timeline-date">
										<?= $row['date']; ?>
									</div>
									<div class="timeline-desc card-box">
										<div class="pd-20">
											<h4 class="mb-10 h4"><?= $row['update_title']; ?></h4>
											<p><?= $row['update_information']; ?></p>
										</div>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
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