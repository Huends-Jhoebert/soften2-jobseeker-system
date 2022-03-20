<?php
include_once "timeAgo.php";
session_start();

$server = "localhost";
$uname = "root";
$pword = "";
$dbname = "jobseeker-system-db";
$conn = new mysqli($server, $uname, $pword, $dbname);

$jobOfferQuery = "SELECT * FROM job WHERE job_id = '$_GET[jobId]'";

$jobOfferQueryResult = $conn->query($jobOfferQuery);

// Associative array
$jobOfferQueryResultArray = $jobOfferQueryResult->fetch_assoc();

// echo "<pre>";
// var_dump($jobOfferQueryResultArray);
// echo "</pre>";

$number = 0;

$applicantsQuery = "SELECT * FROM job_applicant WHERE job_id = '$_GET[jobId]' ORDER BY job_applicant_submitted_time DESC";

$applicantsQueryResult = $conn->query($applicantsQuery);

// Associative array
$applicants = mysqli_fetch_all($applicantsQueryResult, MYSQLI_ASSOC);


?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Employer - Jobs</title>


	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../../template-files/sweetalert/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/style.css">

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

<body>
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
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
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
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
									<li class="breadcrumb-item active" aria-current="page">Job information</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20 d-flex justify-content-between align-items-center">
						<h4 class="text-blue h3">JOB INFORMATION</h4>
						<a href="#" class="text-danger h6" data-toggle="modal" data-target="#confirmation-modal" type="button">
							DELETE
						</a>
						<div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-body text-center font-18">
										<h4 class="padding-top-30 mb-30 weight-500">Are you sure you want to continue?</h4>
										<div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
											<div class="col-6">
												<button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal"><i class="fa fa-times"></i></button>
												NO
											</div>
											<div class="col-6">
												<a href="deleteJob.php?jobIdToDelete=<?php echo $jobOfferQueryResultArray['job_id']; ?>" type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i class="fa fa-check"></i></a>
												YES
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="pb-20">
						<div class="pd-20 pt-0">
							<div class="row mb-20">
								<div class="col-12">
									<img src="../<?php echo $jobOfferQueryResultArray['job_image']; ?>" alt="" class="d-block w-100">
								</div>
							</div>
							<p class="text-info h3"><?php echo $jobOfferQueryResultArray['job_title']; ?></p>
							<p><span class="text-dark h6">Salary Range:</span>
								<span class="text-info h5"><?php echo $jobOfferQueryResultArray['job_salary_range']; ?></span>
							</p>
							<p><span class="text-dark h6">Place:</span>
								<span class="text-info h5"><?php echo $jobOfferQueryResultArray['job_place']; ?></span>
							</p>
						</div>
					</div>
				</div>
				<!-- Simple Datatable End -->
			</div>
		</div>
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">JOB APPLICANT</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Time Submitted</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($applicants as $key => $applicant) : ?>
									<?php

									$userQuery = "SELECT * FROM users WHERE user_id = '$applicant[job_applicant_jobseeker_id]'";

									$userQueryResult = $conn->query($userQuery);

									// Associative array
									$jobseeker = $userQueryResult->fetch_assoc();

									?>
									<tr>
										<td><?php echo $key + 1; ?></td>
										<td><a href="viewJobseekerAccount.php?userId=<?php echo $jobseeker['user_id'] ?>&jobId=<?php echo $jobOfferQueryResultArray['job_id']; ?>"><?php echo $jobseeker['name']; ?></a></td>
										<td><?php echo last_seen($applicant['job_applicant_submitted_time']); ?></td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="<?php echo $applicant['job_applicant_file']; ?>" target="_blank"><i class="dw dw-download"></i> Resume</a>
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
		</div>
	</div>

	<!-- js -->
	<script src="../../template-files/sweetalert/sweetalert2.all.min.js"></script>
	<script src="../../template-files/vendors/scripts/core.js"></script>
	<script src="../../template-files/vendors/scripts/script.min.js"></script>
	<script src="../../template-files/vendors/scripts/process.js"></script>
	<script src="../../template-files/vendors/scripts/layout-settings.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script src=" ../../template-files/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="../../template-files/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="../../template-files/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="../../template-files/vendors/scripts/datatable-setting.js"></script>

</body>

</html>