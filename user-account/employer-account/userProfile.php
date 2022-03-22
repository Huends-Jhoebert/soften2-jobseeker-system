<?php

session_start();

include_once "db-connection2.php";

$sql = "SELECT COUNT(opened) as unreadMessages FROM chats WHERE to_id = '$_SESSION[user_id]' AND opened = '0'";

$result = mysqli_query($conn2, $sql);
$numberOfUnread = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo "<pre>";
// var_dump($numberOfUnread);
// echo "</pre>";

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
							<i class="fa fa-comment __notification" aria-hidden="true"></i><span class="__badge bg-danger"><?php echo $numberOfUnread[0]['unreadMessages']; ?></span>
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
															<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
																<div title="online">
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
								<a href="#" class="dropdown-toggle no-arrow" data-option="off">
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
												<form id="addressEdit" method="POST">
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

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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
</body>

</html>