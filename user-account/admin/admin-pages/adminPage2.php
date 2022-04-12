<?php

session_start();
include_once "../queries/db-connection.php";
include_once "timeAgo.php";

$countNumberOfFeedbacks = "SELECT COUNT(feedback_id) as numberOfFeedbacks from feedback";
$countNumberOfFeedbacksResult = $conn->query($countNumberOfFeedbacks);
$numberOfFeedbacks = $countNumberOfFeedbacksResult->fetch_assoc();

$countNumberOfGoodReview = "SELECT COUNT(feedback_id) as numberOfGoodReviews from feedback WHERE type = 'good'";
$countNumberOfGoodReviewResult = $conn->query($countNumberOfGoodReview);
$numberOfGoodReviews = $countNumberOfGoodReviewResult->fetch_assoc();

$countNumberOfBadReview = "SELECT COUNT(feedback_id) as numberOfBadReviews from feedback WHERE type = 'bad'";
$countNumberOfBadReviewResult = $conn->query($countNumberOfBadReview);
$NumberOfBadReviews = $countNumberOfBadReviewResult->fetch_assoc();

// $countNumberOfEmployers = "SELECT COUNT(user_id) as numberOfEmployers from users WHERE type = 'Employer'";
// $countNumberOfEmployersResult = $conn->query($countNumberOfEmployers);
// $numberOfEmployers = $countNumberOfEmployersResult->fetch_assoc();


$getAllFeedbackData = "SELECT * FROM feedback";
$getAllFeedbackDataSql = $conn->query($getAllFeedbackData);
$getAllFeedbackDatas = $getAllFeedbackDataSql->fetch_all(MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Admin - Feedbacks</title>

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
						<i class="icon-copy fa fa-pencil text-secondary" style="font-size: 4.5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $numberOfFeedbacks['numberOfFeedbacks']; ?></div>
							<div class="weight-600 font-14 text-uppercase">Total Feedbacks</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 mb-30 text-center">
				<div class="card-box height-100-p widget-style1">
					<div class="d-flex flex-wrap align-items-center">
						<i class="icon-copy fa fa-thumbs-up text-info" style="font-size: 5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $numberOfGoodReviews['numberOfGoodReviews']; ?></div>
							<div class="weight-600 font-14 text-uppercase">Total Good REVIEWS</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 mb-30 text-center">
				<div class="card-box height-100-p widget-style1">
					<div class="d-flex flex-wrap align-items-center">
						<i class="icon-copy fa fa-thumbs-down text-danger" style="font-size: 5rem;" aria-hidden="true"></i>
						<div class="widget-data">
							<div class="h4 mb-0"><?php echo $NumberOfBadReviews['numberOfBadReviews']; ?></div>
							<div class="weight-600 font-14 text-uppercase">Total Bad REVIEWS</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container px-0">
			<div class="row">
				<?php foreach ($getAllFeedbackDatas as $key => $feedbackData) : ?>
					<?php if ($feedbackData['type'] == "good") : ?>
						<div class="col-md-4 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">
								<div class="pricing-icon">
									<img src="vendors/images/icon-Cash.png" alt="">
								</div>
								<div class="price-title">
									Good Review
								</div>
								<div class="text">
									<?= $feedbackData['feedback_message']; ?>
								</div>
								<div class="cta">
									<a href="../queries/removeFeedback.php?feedBackId=<?= $feedbackData['feedback_id']; ?>" class="btn btn-primary btn-rounded btn-lg">Readed</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if ($feedbackData['type'] == "bad") : ?>
						<div class="col-md-4 mb-30">
							<div class="card-box pricing-card mt-30 mb-30">
								<div class="pricing-icon">
									<img src="vendors/images/icon-Cash.png" alt="">
								</div>
								<div class="price-title text-danger">
									Bad Review
								</div>
								<div class="text">
									<?= $feedbackData['feedback_message']; ?>
								</div>
								<div class="cta">
									<a href="../queries/removeFeedback.php?feedBackId=<?= $feedbackData['feedback_id']; ?>" class="btn btn-primary btn-rounded btn-lg">Readed</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
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

<?php if (isset($_GET['feedbackRemoved'])) : ?>
	<script>
		Swal.fire(
			'Feedback',
			'Is successfully removed',
			'success'
		)
	</script>
<?php endif; ?>

</html>