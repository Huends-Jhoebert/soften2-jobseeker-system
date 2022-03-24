<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Admin Sign Up</title>

	<!-- Site favicon -->
	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/jquery-steps/jquery.steps.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<!-- <link rel="stylesheet" type="text/css" href="template-files/src/plugins/sweetalert2/sweetalert2.css"> -->
	<link rel="stylesheet" href="../../template-files/sweetalert/sweetalert2.min.css">

</head>

<body class="login-page">

	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="#">
					<img src="template-files/vendors/images/logo1-removebg.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="adminLogin.php">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="../../template-files/src/images/admin_details.png" alt="" style="mix-blend-mode: darken;">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard" action="queries/addAdminData.php" method="POST" enctype="multipart/form-data">
								<h5>Personal information</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Profile Image*</label>
											<div class="col-sm-8">
												<input type="file" name="image" class="form-control-file form-control height-auto" accept="image/*" required>
											</div>

										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Full Name*</label>
											<div class="col-sm-8">
												<input type="text" name="full_name" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">User Name*</label>
											<div class="col-sm-8">
												<input type="text" name="username" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Password*</label>
											<div class="col-sm-8">
												<input type="password" name="password" class="form-control" required>
											</div>
										</div>
									</div>
								</section>
								<!-- success Popup html Start -->
								<button type="submit" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static" name="adminBtn">Launch modal</button>
							</form>
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
	<script src="../../template-files/src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="../../template-files/vendors/scripts/steps-setting.js"></script>
	<script src="../../template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script src="../../template-files/sweetalert/sweetalert2.min.js"></script>

</body>

</html>