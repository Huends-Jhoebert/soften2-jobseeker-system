<?php

session_start();

include_once "db-connection2.php";

$getJobOffers = "SELECT * FROM job WHERE job_employer_id = '$_SESSION[user_id]' ORDER BY job_date_posted ASC";

$getJobOffersQuery = mysqli_query($conn2, $getJobOffers);

$jobOffers = mysqli_fetch_all($getJobOffersQuery, MYSQLI_ASSOC);

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
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/style.css">
	<link rel="stylesheet" href="../../template-files/sweetalert/sweetalert2.min.css">
	<link rel="stylesheet" href="chat-files/css/style.css">
</head>

<body>
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
								<a href="update.php" class="dropdown-toggle no-arrow">
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
									<li class="breadcrumb-item active" aria-current="page">Jobs</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20 d-flex justify-content-between align-items-center">
						<h4 class="text-blue h4">MY JOB OFFERS</h4>
						<a href="userJob.php" class="text-success">ADD JOB</a>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th>#</th>
									<th>Title</th>
									<th># Applicants</th>
									<th>Place</th>
									<th>Date Posted</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($jobOffers as $key => $jobOffer) : ?>
									<?php
									$sql = "SELECT COUNT(job_applicant_jobseeker_id) AS NumberOfApplicants FROM job_applicant WHERE job_id = '$jobOffer[job_id]'";
									$result = $conn2->query($sql);
									$row = $result->fetch_assoc();
									?>
									<tr>
										<td class="table-plus"><?php echo $key + 1; ?></td>
										<td><?php echo $jobOffer['job_title']; ?></td>
										<td>
											<?php echo $row['NumberOfApplicants']; ?>
										</td>
										<td><?php echo $jobOffer['job_place']; ?></td>
										<td><?php
											$date = $jobOffer['job_date_posted'];
											echo date('h:i:s a m/d/Y', strtotime($date));
											?></td>
										<td>
											<div class="dropdown">
												<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
													<i class="dw dw-more"></i>
												</a>
												<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
													<a class="dropdown-item" href="viewJob.php?jobId=<?php echo $jobOffer['job_id'] ?>"><i class="dw dw-eye"></i> View</a>
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
	<script src="../../template-files/sweetalert/sweetalert2.all.min.js"></script>
</body>


<?php if (isset($_GET['successfullyDeleted'])) : ?>
	<script>
		Swal.fire(
			'Job',
			'Is successfully deleted',
			'success'
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

</html>