<?php

session_start();

# database connection file
include 'chat-files/app/db.conn.php';
include_once "db-connection2.php";

include 'chat-files/app/helpers/user.php';
include 'chat-files/app/helpers/chat.php';
include 'chat-files/app/helpers/opened.php';
include 'chat-files/app/helpers/conversations.php';
include 'chat-files/app/helpers/last_chat.php';

include 'chat-files/app/helpers/timeAgo.php';

if (!isset($_GET['user'])) {
	header("Location: home.php");
	exit;
}

$selecUser = "SELECT * FROM users WHERE user_id = '$_GET[user]'";
$selecUserQuery = $conn2->query($selecUser);
$userChatDetails = $selecUserQuery->fetch_assoc();

# Getting User data data
$user = getUser($_SESSION['username'], $conn);

# Getting User conversations
$conversations = getConversation($user['user_id'], $conn);

# Getting User data data
$chatWith = getUser($userChatDetails['name'], $conn);

if (empty($chatWith)) {
	header("Location: home.php");
	exit;
}

$chats = getChats($_SESSION['user_id'], $chatWith['user_id'], $conn);

opened($chatWith['user_id'], $conn, $chats);
?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employer - Chat</title>

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

		@media screen and (max-width: 480px) {
			#message {
				width: 88% !important;
			}

			#sendBtn {
				width: 12% !important;
			}
		}


		ul.gfg {
			margin: 5px;
			padding: 5px;
			height: 215px;
			overflow: auto;
		}
	</style>


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
									<li class="breadcrumb-item"><a href="#">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chat</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30 bg-light p-2">
						<h5 class="h5 mt-2 pl-3">Contacts</h5>
						<div class="pd-20  height-50-p mt-3 p-0 bg-light">
							<div class="d-flex p-3">
								<a href="chat.php?user=<?php echo $_GET['user']; ?>" class="fs-4 link-dark back-arrow pt-2 mr-2" style="display: none;">&#8592;</a>
								<div class="input-group">
									<input type="text" placeholder="Search..." id="searchText" class="form-control border-radius-0">
									<button class="btn btn-primary border-radius-0" id="serachBtn">
										<i class="fa fa-search"></i>
									</button>
								</div>
							</div>
							<ul id="chatList" class="list-group mvh-50 overflow-auto gfg p-3">
								<?php if (!empty($conversations)) { ?>
									<?php
									foreach ($conversations as $conversation) { ?>
										<li class="list-group-item">
											<a href="chat.php?user=<?= $conversation['user_id'] ?>" class="d-flex
	    				          justify-content-between
	    				          align-items-center p-2">
												<div class="d-flex
	    					            align-items-center">
													<img src="../<?= $conversation['p_p'] ?>" class="w-15 rounded-circle">
													<h3 class="fs-xs m-2">
														<?= $conversation['name'] ?><br>
														<small>
															<?php
															echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn);
															?>
														</small>
													</h3>
													<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
														<div class="online ml-auto"></div>
													<?php } ?>
												</div>
											</a>
										</li>
									<?php } ?>
								<?php } else { ?>
									<!-- <div class="alert alert-info 
    				            text-center">
										<i class="fa fa-comments d-block fs-big"></i>
										No messages yet, Start the conversation
									</div> -->
								<?php } ?>
							</ul>
						</div>

					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30 border-radius-0">
						<div class="card-box height-100-p overflow-hidden" style="border-radius: 0px !important">
							<div class="profile-tab height-100-p border-radius-0">
								<div class="height-50-p">
									<div class="d-flex p-3 align-items-center bg-light-gray">
										<img src="../<?= $chatWith['p_p'] ?>" class="w-10 rounded-circle">
										<h3 class="display-4 fs-sm m-2">
											<?= $chatWith['name'] ?> <br>
											<div class="d-flex
               	              align-items-center" title="online">
												<?php
												if (last_seen($chatWith['last_seen']) == "Active") {
												?>
													<div class="online"></div>
													<small class="d-block p-1">Online</small>
												<?php } else { ?>
													<small>
														<?php
														echo last_seen($chatWith['last_seen']);
														?>
													</small>
												<?php } ?>
											</div>
										</h3>
									</div>
									<div class="shadow p-4
    	               d-flex flex-column
    	               mt-2 chat-box" id="chatBox" style="height: 620px !important;">
										<?php
										if (!empty($chats)) {
											foreach ($chats as $chat) {
												if ($chat['from_id'] == $_SESSION['user_id']) { ?>
													<p class="rtext align-self-end
						        border rounded p-2 mb-1">
														<?= $chat['message'] ?>

													</p>
												<?php } else { ?>
													<div class="d-flex align-items-center">
														<img src="../<?= $chatWith['p_p'] ?>" class="chat-img mr-3 rounded-circle">
														<p class="ltext border align-self-start 
					         rounded p-2 mb-1">
															<?= $chat['message'] ?>
															<?php $_SESSION["sender_image"] = $chatWith['p_p']; ?>

														</p>
													</div>
											<?php }
											}
										} else { ?>
											<div class="alert alert-info 
    				            text-center">
												<i class="fa fa-comments d-block fs-big"></i>
												No messages yet, Start the conversation
											</div>
										<?php } ?>
									</div>
									<div class="input-group d-flex p-1 mb-0">
										<textarea cols="3" id="message" class="border-radius-0  bg-light-gray border-0" style="width:93%;"></textarea>
										<button class="btn btn-primary border-radius-0" id="sendBtn" style="width:7%;">
											<i class="fa fa-paper-plane"></i>
										</button>
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

	<script>
		// var scrollDown = function() {
		// 	let chatBox = document.getElementById('chatBox');
		// 	chatBox.scrollTop = chatBox.scrollHeight;
		// }

		// scrollDown();

		$(document).ready(function() {

			$("#sendBtn").on('click', function() {
				message = $("#message").val();
				if (message == "") return;

				$.post("chat-files/app/ajax/insert.php", {
						message: message,
						to_id: <?= $chatWith['user_id'] ?>
					},
					function(data, status) {
						$("#message").val("");
						$("#chatBox").append(data);
						scrollDown();
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
			setInterval(lastSeenUpdate, 5000);



			// auto refresh / reload
			let fechData = function() {
				$.post("chat-files/app/ajax/getMessage.php", {
						id_2: <?= $chatWith['user_id'] ?>
					},
					function(data, status) {
						$("#chatBox").append(data);
						if (data != "") scrollDown();
					});
			}

			fechData();
			/** 
			auto update last seen 
			every 0.5 sec
			**/
			setInterval(fechData, 500);

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


	<script>
		var backArrow = document.querySelector(".back-arrow");
		var searchText = document.querySelector("#searchText");

		searchText.addEventListener("keyup", event => {
			backArrow.style.display = "block";
		});
	</script>
</body>

</html>