<?php

session_start();

include_once "timeAgo.php";

include_once "randomString.php";

include_once "db-connection2.php";

$getJobDetails = "SELECT * FROM job WHERE job_id = '$_GET[jobId]'";
$getJobDetailsresult = $conn2->query($getJobDetails);
$job = $getJobDetailsresult->fetch_assoc();

$getEmployerDetails = "SELECT * FROM users WHERE user_id = '$job[job_employer_id]'";
$getEmployerDetailsresult = $conn2->query($getEmployerDetails);
$employer = $getEmployerDetailsresult->fetch_assoc();

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

$checkIfExist = "SELECT * FROM job_applicant WHERE job_id = '$job[job_id]' AND job_applicant_jobseeker_id = '$_SESSION[user_id]'";
$getEmployerDetailsresult = $conn2->query($checkIfExist);

?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Jobseeker - Job Details</title>

	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">

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
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">
	<link rel="stylesheet" href="chat-files/css/style.css">
	<style>
		* {
			margin: 0;
			padding: 0;
		}

		.rate {
			/* float: left; */
			height: 46px;
			padding: 0 10px;
			width: 40%;
		}

		.rate:not(:checked)>input {
			position: absolute;
			top: -9999px;
		}

		.rate:not(:checked)>label {
			float: right;
			width: 1em;
			overflow: hidden;
			white-space: nowrap;
			cursor: pointer;
			font-size: 30px;
			color: #ccc;
		}

		.rate:not(:checked)>label:before {
			content: '★ ';
		}

		.rate>input:checked~label {
			color: #ffc700;
		}

		.rate:not(:checked)>label:hover,
		.rate:not(:checked)>label:hover~label {
			color: #deb217;
		}

		.rate>input:checked+label:hover,
		.rate>input:checked+label:hover~label,
		.rate>input:checked~label:hover,
		.rate>input:checked~label:hover~label,
		.rate>label:hover~input:checked~label {
			color: #c59b08;
		}

		/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
	</style>


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
				<a href="jobsPosted.php" class="mr-4"><i class="icon-copy fa fa-briefcase text-primary" aria-hidden="true"></i></a>
				<a href="userFeedback.php" class="mr-4"><i class="icon-copy fa fa-commenting text-secondary" aria-hidden="true"></i></a>
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
				<!-- <div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item" aria-current="page"><a href="jobsPosted.php">Jobs</a></li>
									<li class="breadcrumb-item active" aria-current="page">Job information</li>
								</ol>
							</nav>
						</div>
					</div>
				</div> -->
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-50-p">
							<div class="profile-photo">
								<img src="../<?php echo $employer['p_p']; ?>" alt="" class="avatar-photo">
							</div>
							<h5 class="text-center h5 mb-0"><?php echo $employer['name']; ?></h5>
							<p class="text-center text-muted font-14 d-hide"><?php echo $employer['type']; ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $employer['email_account']; ?>
									</li>
									<li>
										<span>Contact Person:</span>
										<?php echo $employer['contact_person']; ?>
									</li>
									<li>
										<span>Contact Number:</span>
										<?php echo $employer['contact_number']; ?>
									</li>
									<li>
										<span>Address:</span>
										<?php echo $employer['address']; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<!-- <li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#timeline" role="tab" aria-selected="true">Timeline</a>
										</li> -->
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab" aria-selected="false">JOB INFORMATION</a>
										</li>
									</ul>
									<div class="tab-content p-3">
										<!-- Setting Tab start -->
										<div class="tab-pane fade active show height-25-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<div class="mt-2">
													<img src="../<?php echo $job['job_image']; ?>" class="d-block" alt="" width="100%" style="height: 250px;">
												</div>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<h5 class="text-dark mt-3 h3"><?php echo $job['job_title']; ?></h5>
											<?php if ($getEmployerDetailsresult->num_rows > 0) : ?>
												<a href="#" class="text-primary mr-3" data-toggle="modal" data-target="#rateModal">Rate</a>
											<?php endif; ?>
											<?php if ($getEmployerDetailsresult->num_rows < 1) : ?>
												<a href="#" class="text-primary" data-toggle="modal" data-target="#modal">Send resume</a>
											<?php endif; ?>
											<div class="modal fade" id="rateModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<form action="" method="POST" enctype="multipart/form-data">
															<div class="modal-body pd-5 p-2">
																<h5 class="mb-3">Rate</h5>
																<div class="form-group mb-0">
																	<div class="rate">
																		<input type="radio" id="star5" name="rate" value="5" />
																		<label for="star5" title="text">5 stars</label>
																		<input type="radio" id="star4" name="rate" value="4" />
																		<label for="star4" title="text">4 stars</label>
																		<input type="radio" id="star3" name="rate" value="3" />
																		<label for="star3" title="text">3 stars</label>
																		<input type="radio" id="star2" name="rate" value="2" />
																		<label for="star2" title="text">2 stars</label>
																		<input type="radio" id="star1" name="rate" value="1" />
																		<label for="star1" title="text">1 star</label>
																	</div>
																</div>
																<input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-primary" name="submitRateBtn">Submit</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
												<div class="modal-dialog modal-dialog-centered" role="document">
													<div class="modal-content">
														<form action="" method="POST" enctype="multipart/form-data">
															<div class="modal-body pd-5 p-2">
																<h5 class="mb-3">Insert Resume or CV</h5>
																<div class="form-group">
																	<input type="file" class="form-control-file form-control height-auto" name="my_file" required>
																</div>
																<input type="hidden" name="job_id" value="<?php echo $job['job_id']; ?>">
																<input type="hidden" name="job_employer_id" value="<?php echo $employer['user_id']; ?>">
																<input type="hidden" name="job_applicant_jobseeker_id" value="<?php echo $_SESSION['user_id']; ?>">
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-primary" name="submitResumeBtn">Submit</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
										<div class="mb-2">
											<p class="h6 m-0"><?php echo $job['job_place']; ?></p>
											<p class="m-0">Salary <?php echo $job['job_salary_range']; ?></p>
											<p class="text-muted" style="font-size: 13px;">Posted <?php echo time_posted($job['job_date_posted']); ?></p>
										</div>
										<div class="mt-5">
											<h5 class="h5">
												Job Requirements
											</h5>
											<?php
											$requirements = explode(',', $job['job_requirements']);
											?>
											<ul style="margin-left: 20px;">
												<?php foreach ($requirements  as $requirement) : ?>
													<li style="list-style: disc;" class="text-capitalize"><?= $requirement; ?></li>
												<?php endforeach; ?>
											</ul>
										</div>
										<div class="mt-3">
											<h5 class="h5">
												Job description
											</h5>
											<p class="text-justify">
												<?php
												echo $job['job_description'];
												?>
											</p>
										</div>
										<div class="mt-3">
											<h5 class="h5">
												Career Growth
											</h5>
											<p class="text-justify">
												<?php
												echo $job['career_growth'];
												?>
											</p>
										</div>
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
	</div>
	</div>
	<!-- js -->
	<script src="../../template-files/vendors/scripts/core.js"></script>
	<script src="../../template-files/vendors/scripts/script.min.js"></script>
	<script src="../../template-files/vendors/scripts/process.js"></script>
	<script src="../../template-files/vendors/scripts/layout-settings.js"></script>
	<script src="../../template-files/src/plugins/cropperjs/dist/cropper.js"></script>
	<script src="../../template-files/sweetalert/sweetalert2.min.js"></script>
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

	<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->

	<?php if (isset($_POST['submitResumeBtn'])) {

		$checkIfExist = "SELECT * FROM job_applicant WHERE job_id = '$job[job_id]' AND job_applicant_jobseeker_id = '$_SESSION[user_id]'";
		$getEmployerDetailsresult = $conn2->query($checkIfExist);
		if ($getEmployerDetailsresult->num_rows > 0) {
			echo "<script>";
			echo "Swal.fire(";
			echo	"'Your Resume',";
			echo "'Is already submitted',";
			echo "'error'";
			echo ")";
			echo "</script>";
		} else {
			$jobId = $_POST['job_id'];
			$jobEmployerId = $_POST['job_employer_id'];
			$jobResumeSenderId = $_POST['job_applicant_jobseeker_id'];
			$resumeFile = "";
			$filename = $_FILES["my_file"]["name"];
			$tempname = $_FILES["my_file"]["tmp_name"];
			$folder = "../../dist/jobseeker-files/" . randomString(8) . "/" . $filename;

			mkdir(dirname($folder));
			if (move_uploaded_file($tempname, $folder)) {
				$resumeFile = $folder;
			}
			$sql = "INSERT INTO job_applicant (job_id, job_applicant_employer_id, job_applicant_jobseeker_id, job_applicant_file) VALUES ('$jobId', '$jobEmployerId', '$jobResumeSenderId', '$resumeFile')";

			if ($conn2->query($sql) === TRUE) {
				echo "<script>";
				echo "Swal.fire(";
				echo "'Resume',";
				echo "'Is successfully submitted',";
				echo "'success'";
				echo ")";
				echo "</script>";
				$conn2->close();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	}
	?>

	<?php

	if (isset($_POST['submitRateBtn'])) {

		$getRate = "SELECT rate, number_of_raters, total_rate FROM job WHERE job_id = '$_POST[job_id]'";
		$getRateResult = $conn2->query($getRate);
		$getRateResultDatas = $getRateResult->fetch_assoc();

		$currentRate = $getRateResultDatas['rate'];
		$currentNumberOfRaters = $getRateResultDatas['number_of_raters'];
		$currentTotalRate = $getRateResultDatas['total_rate'];

		$updateRate = intval($currentRate) + intval($_POST['rate']);
		$newNumberOfRaters = $currentNumberOfRaters + 1;
		$newTotalRate = intval($currentTotalRate) + intval($_POST['rate']);

		$newRate = intval($newTotalRate) / intval($newNumberOfRaters);

		$updateRate = "UPDATE job SET rate = '$newRate',
		number_of_raters = '$newNumberOfRaters',
		total_rate = '$newTotalRate'
		WHERE job_id = '$_POST[job_id]'";

		if ($conn2->query($updateRate) === TRUE) {
			echo "<script>";
			echo "Swal.fire(";
			echo "'Rate',";
			echo "'Is successfully submitted',";
			echo "'success'";
			echo ")";
			echo "</script>";
			$conn2->close();
		} else {
			echo "Error: " . $updateRate . "<br>" . $conn2->error;
		}
	}

	?>

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