<?php

session_start();
include_once "db-connection.php";
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
	<title>Employer - Profile</title>

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
								<a href="#" class="dropdown-toggle no-arrow" data-option="off">
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
										<span>Contact Person:</span>
										<?php echo $_SESSION['contact_person']; ?>
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
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab" aria-selected="false">Settings</a>
										</li>
									</ul>
									<div class="tab-content">

										<!-- Setting Tab start -->
										<div class="tab-pane fade active show height-25-p" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form id="profileEdit" method="POST">
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Company Informations</h4>
															<div class="form-group">
																<label>Comapany Name:</label>
																<input class="form-control form-control-lg" name="name" type="text">
															</div>
															<div class="form-group">
																<label>Contact Person</label>
																<input class="form-control form-control-lg" name="contact_person" type="text">
															</div>
															<div class="form-group">
																<label>Contact Number</label>
																<input class="form-control form-control-lg" name="contact_number" type="text">
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
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20" style="visibility: hidden;">Edit Social Media links</h4>
															<div class="form-group">
																<label>Company Email:</label>
																<input class="form-control form-control-lg" name="email_address" type="text">
															</div>
															<div class="form-group">
																<label>Company Password:</label>
																<input class="form-control form-control-lg" name="password" type="text">
															</div>
														</li>
													</ul>
												</form>
												<!-- <form id="addressEdit" method="POST">
													<ul class="profile-edit-list row pt-0">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Address Information</h4>
															<div class="form-group">
																<label>Region</label>
																<input class="form-control form-control-lg" name="region" type="text">
															</div>
															<div class="form-group">
																<label>City/Municipality</label>
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
																<label>Province/District:</label>
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
												</form> -->
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

	<script>
		//CODE FOR AJAX INSERT
		$("#profileEdit").submit(function(e) {
			e.preventDefault(); // avoid to execute the actual submit of the form.
			var form = $(this);
			$.ajax({
				type: "POST",
				url: "../../queries/updateEmployerInfo.php",
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