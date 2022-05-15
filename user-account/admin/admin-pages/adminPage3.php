<?php

session_start();
include_once "../queries/db-connection.php";
include_once "timeAgo.php";

if (isset($_POST['searchJobBtn'])) {

	$startDate = date("Y-m-d", strtotime($_POST['startDate']));
	$endDate = date("Y-m-d", strtotime($_POST['endDate']));

	$countNumberOfJobseekers = "SELECT COUNT(user_id) as numberOfJobseekers from users WHERE type = 'Jobseeker' and signup_date between '$startDate' and '$endDate'";
	$countNumberOfJobseekersResult = $conn->query($countNumberOfJobseekers);
	$numberOfJobseekers = $countNumberOfJobseekersResult->fetch_assoc();

	$countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer' and signup_date between '$startDate' and '$endDate'";
	$countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
	$numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();

	$countNumberOfGoodReviews = "SELECT COUNT(feedback_report_id) as goodReviews from feedback_report WHERE type = 'good' and date_created between '$startDate' and '$endDate'";
	$countNumberOfGoodReviewsResult = $conn->query($countNumberOfGoodReviews);
	$numberOfGoodReviews = $countNumberOfGoodReviewsResult->fetch_assoc();

	$countNumberOfBadReviews = "SELECT COUNT(feedback_report_id) as badReviews from feedback_report WHERE type = 'bad' and date_created between '$startDate' and '$endDate'";
	$countNumberOfBadReviewsResult = $conn->query($countNumberOfBadReviews);
	$numberOfBadReviews = $countNumberOfBadReviewsResult->fetch_assoc();
} else {
	$countNumberOfJobseekers = "SELECT COUNT(user_id) as numberOfJobseekers from users WHERE type = 'Jobseeker'";
	$countNumberOfJobseekersResult = $conn->query($countNumberOfJobseekers);
	$numberOfJobseekers = $countNumberOfJobseekersResult->fetch_assoc();

	$countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer'";
	$countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
	$numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();

	$countNumberOfGoodReviews = "SELECT COUNT(feedback_report_id) as goodReviews from feedback_report WHERE type = 'good'";
	$countNumberOfGoodReviewsResult = $conn->query($countNumberOfGoodReviews);
	$numberOfGoodReviews = $countNumberOfGoodReviewsResult->fetch_assoc();

	$countNumberOfBadReviews = "SELECT COUNT(feedback_report_id) as badReviews from feedback_report WHERE type = 'bad'";
	$countNumberOfBadReviewsResult = $conn->query($countNumberOfBadReviews);
	$numberOfBadReviews = $countNumberOfBadReviewsResult->fetch_assoc();
}

// $countNumberOfUsers = "SELECT COUNT(user_id) as numberOfUsers from users";
// $countNumberOfUsersResult = $conn->query($countNumberOfUsers);
// $numberOfUsers = $countNumberOfUsersResult->fetch_assoc();

// $countNumberOfJobseekers = "SELECT COUNT(user_id) as numberOfJobseekers from users WHERE type = 'Jobseeker'";
// $countNumberOfJobseekersResult = $conn->query($countNumberOfJobseekers);
// $numberOfJobseekers = $countNumberOfJobseekersResult->fetch_assoc();

// $countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer'";
// $countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
// $numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();


// $getAllUsersData = "SELECT * FROM users WHERE type <> 'user'";
// $getAllUsersDataSql = $conn->query($getAllUsersData);
// $allUsersData = $getAllUsersDataSql->fetch_all(MYSQLI_ASSOC);


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

	<style>
		@media print {
			.headeroff {
				display: none;
			}
		}
	</style>

</head>

<body class="header-white sidebar-dark">
	<div class="header headeroff">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="<?php echo $_SESSION['p_p']; ?>" alt="">
							<img src="../../../" alt="">
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
		<div class="page-header headeroff rounded-0">
			<form action="" method="post">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-4 col-md-4 col-sm-4 search-div">
						<div class="form-group row align-items-center">
							<label class="col-sm-12 col-md-2 col-form-label">From</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control date-picker" name="startDate" placeholder="Select Date" type="text">
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 search-div">
						<div class="form-group row align-items-center">
							<label class="col-sm-12 col-md-2 col-form-label">To</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control date-picker" name="endDate" placeholder="Select Date" type="text">
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-4 search-div">
						<button type="submit" name="searchJobBtn" class="btn btn-primary d-block">SEARCH</button>
					</div>
				</div>
			</form>
		</div>

		<div class="row justify-content-center" id="print">
			<div class="col-12">
				<div class="row justify-content-left">
					<div class="col-3">
						<input type="button" class="btn btn-primary mb-3 headeroff" style="margin-left: 90px;" value="Print Report" onclick="printpart()" />
					</div>
					<div class="col-3">
						<a href="#" class="btn btn-success" data-toggle="modal" data-target="#Medium-modal" type="button">Create a report
						</a>
						<form method="post">
							<div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myLargeModalLabel">Create Update</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<div class="form-group row">
												<label class="col-sm-6 col-md-2 col-form-label">Update Title</label>
												<div class="col-sm-6 col-md-10">
													<input class="form-control" name="updateTitle" type="text" placeholder="Enter Update Title">
												</div>
											</div>
											<div class="form-group">
												<label>Update Information</label>
												<textarea class="form-control" name="updateInformation"></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" name="reportBtn" class="btn btn-primary">Post</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-10">
				<div class="card">
					<div class="row">
						<div class="col-12 p-4">
							<?php if (!isset($_POST['searchJobBtn'])) : ?>
								<p>Number of users as of <?= date('Y-m-d'); ?></p>
							<?php endif; ?>
							<?php if (isset($_POST['searchJobBtn'])) : ?>
								<p>Number of users from <?= $_POST['startDate']; ?> to <?= $_POST['endDate']; ?></p>
							<?php endif; ?>
							<canvas id="myChart" width="200" height="75"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="col-10 mt-4">
				<div class="card">
					<div class="row">
						<div class="col-12 p-4">
							<?php if (!isset($_POST['searchJobBtn'])) : ?>
								<p>Number of Feedbacks as of <?= date('Y-m-d'); ?></p>
							<?php endif; ?>
							<?php if (isset($_POST['searchJobBtn'])) : ?>
								<p>Number of Feedbacks from <?= $_POST['startDate']; ?> to <?= $_POST['endDate']; ?></p>
							<?php endif; ?>
							<canvas id="myChart1" width="200" height="75"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>

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

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jspdf@1.5.3/dist/jspdf.min.js"></script>

	<?php

	echo "<script>
		const ctx = document.getElementById('myChart');
		const myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Employers', 'Jobseekers'],
				datasets: [{
					label: 'Employer',
					data: [" . $numberOfEmployers['numberOfEmployers'] . "," . $numberOfJobseekers['numberOfJobseekers'] . "],
					backgroundColor: [
						'rgba(21, 2, 189, 0.2)',
						'rgba(255, 160, 160, 0.2)'
					],
					borderColor: [
						'rgba(21, 2, 189, 1)',
						'rgba(255, 160, 160, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>";

	echo "<script>
		const ctx1 = document.getElementById('myChart1');
		const myChart1 = new Chart(ctx1, {
			type: 'doughnut',
			data: {
				labels: ['Good Review', 'Bad Reviews'],
				datasets: [{
					label: '# of Feedbacks',
					data: [" . $numberOfGoodReviews['goodReviews'] . "," . $numberOfBadReviews['badReviews'] . "],
					backgroundColor: [
						'rgba(21, 2, 189, 0.2)',
						'rgba(255, 160, 160, 0.2)'
					],
					borderColor: [
						'rgba(21, 2, 189, 1)',
						'rgba(255, 160, 160, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>";
	?>

	<script>
		function printpart() {
			window.print();
		}
	</script>


	<?php


	if (isset($_POST['reportBtn'])) {

		$updateTitle = $_POST['updateTitle'];
		$updateInformation = $conn->real_escape_string($_POST['updateInformation']);
		$date = date('Y-m-d');

		$sql = "INSERT INTO system_update (update_title, update_information, date)
VALUES ('$updateTitle', '$updateInformation', '$date')";

		$conn->query($sql);
	}

	?>

</body>


</html>