<?php

session_start();
include_once "../queries/db-connection.php";
include_once "timeAgo.php";

$countNumberOfUsers = "SELECT COUNT(user_id) as numberOfUsers from users";
$countNumberOfUsersResult = $conn->query($countNumberOfUsers);
$numberOfUsers = $countNumberOfUsersResult->fetch_assoc();

$countNumberOfJobseekers = "SELECT COUNT(user_id) as numberOfJobseekers from users WHERE type = 'Jobseeker'";
$countNumberOfJobseekersResult = $conn->query($countNumberOfJobseekers);
$numberOfJobseekers = $countNumberOfJobseekersResult->fetch_assoc();

$countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer'";
$countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
$numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();


$getAllUsersData = "SELECT * FROM users WHERE type <> 'user'";
$getAllUsersDataSql = $conn->query($getAllUsersData);
$allUsersData = $getAllUsersDataSql->fetch_all(MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Admin - Users</title>

	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../../../template-files/vendors/images/logo1-removebg.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../../../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../../template-files/src/plugins/cropperjs/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="../../../template-files/vendors/styles/style.css">
	<link rel="stylesheet" href="../../../template-files/sweetalert/sweetalert2.min.css">
	<link rel="icon" type="image/png" sizes="32x32" href="../../../template-files/vendors/images/logo1-removebg.png">
	<link rel="stylesheet" type="text/css" href="../../../template-files/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../../../template-files/src/plugins/datatables/css/responsive.bootstrap4.min.css">

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
							<img src="<?php echo $_SESSION['p_p']; ?>" alt="">
						</span>
						<span class="user-name"><?php echo $_SESSION['name']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="logout.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="#">
				ADMIN
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
								<a href="adminPage1.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-user-1"></span><span class="mtext">Users</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="adminPage2.php" class="dropdown-toggle no-arrow" data-option="off">
									<span class="micon dw dw-chat"></span><span class="mtext">Feedbacks</span>
								</a>
							</li>
							<li>
								<a href="#" class="dropdown-toggle no-arrow">
									<span class="micon dw dw-calendar1"></span><span class="mtext">Report Generation</span>
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
		<div class="row mt-3">
			<div class="col-xl-3 mb-30 text-center">
				<div class="card-box height-100-p widget-style1">
					<div class="d-flex flex-wrap align-items-center">
						<i class="icon-copy fa fa-users text-primary" style="font-size: 4.5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $numberOfUsers['numberOfUsers']; ?></div>
							<div class="weight-600 font-14">Total Users</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 mb-30 text-center">
				<div class="card-box height-100-p widget-style1">
					<div class="d-flex flex-wrap align-items-center">
						<i class="icon-copy fa fa-briefcase text-info" style="font-size: 5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $numberOfJobseekers['numberOfJobseekers']; ?></div>
							<div class="weight-600 font-14">Total Jobseekers</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 mb-30 text-center">
				<div class="card-box height-100-p widget-style1">
					<div class="d-flex flex-wrap align-items-center">
						<i class="icon-copy fa fa-user text-info" style="font-size: 5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $numberOfEmployers['numberOfEmployers']; ?></div>
							<div class="weight-600 font-14">Total Employers</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Simple Datatable start -->
		<div class="card-box mb-30">
			<div class="pd-20 d-flex justify-content-between align-items-center">
				<h4 class="text-blue h4">Users Data</h4>
			</div>
			<div class="pb-20">
				<table class="data-table table stripe hover nowrap">
					<thead>
						<tr>
							<th>#</th>
							<th>Full Name</th>
							<th>Account Type</th>
							<th>Sign Up Date</th>
							<th>Last Seen</th>
							<th class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allUsersData as $key => $userData) : ?>
							<tr>
								<td><?= $key + 1; ?></td>
								<td><?= $userData['name']; ?></td>
								<td><?= $userData['type']; ?></td>
								<td>
									<?php
									$date = $userData['signup_date'];
									echo date('h:i:s a m/d/Y', strtotime($date));
									?></td>
								<td><?= last_seen($userData['last_seen']); ?></td>
								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item bg-danger text-white" href="../queries/removeUser.php?userId=<?= $userData['user_id']; ?>"><i class="icon-copy fi-trash"></i>Remove</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Simple Datatable End -->
	</div>
	<!-- js -->
	<script src="../../../template-files/vendors/scripts/core.js"></script>
	<script src="../../../template-files/vendors/scripts/script.min.js"></script>
	<script src="../../../template-files/vendors/scripts/process.js"></script>
	<script src="../../../template-files/vendors/scripts/layout-settings.js"></script>
	<script src="../../../template-files/src/plugins/cropperjs/dist/cropper.js"></script>
	<script src="../../../template-files/sweetalert/sweetalert2.min.js"></script>

	<script src="../../../template-files/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src=" ../../../template-files/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="../../../template-files/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../../../template-files/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="../../../template-files/vendors/scripts/datatable-setting.js"></script>


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
	<?php if (isset($_GET['successfullyDeleted'])) : ?>
		<script>
			Swal.fire(
				'User',
				'Is successfully removed',
				'success'
			)
		</script>
	<?php endif; ?>
</body>

</html>