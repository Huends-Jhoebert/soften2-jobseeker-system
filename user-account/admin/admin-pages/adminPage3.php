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
} else {
	$countNumberOfJobseekers = "SELECT COUNT(user_id) as numberOfJobseekers from users WHERE type = 'Jobseeker'";
	$countNumberOfJobseekersResult = $conn->query($countNumberOfJobseekers);
	$numberOfJobseekers = $countNumberOfJobseekersResult->fetch_assoc();

	$countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer'";
	$countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
	$numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();
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

	<div class="main-container mt-4">
		<div class="page-header rounded-0">
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

		<div class="row">
			<!-- <h1><?= $numberOfJobseekers['numberOfJobseekers']; ?></h1> -->
			<div class="col-6">
				<div class="card">
					<div class="row">
						<div class="col-12 p-4">
							<canvas id="myChart" width="200" height="200"></canvas>
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

	<?php

	echo "<script>
		const ctx = document.getElementById('myChart');
		const myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Employer', 'Jobseeker'],
				datasets: [{
					label: '# of Users',
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
	?>

</body>


</html>