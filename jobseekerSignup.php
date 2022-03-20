<?php

session_start();

if (!isset($_GET['emailHasBeenUsed'])) {
	$_SESSION['full_name'] = "";
	$_SESSION['contact_number']  = "";
	$_SESSION['email_address']  = "";
	$_SESSION['password']  = "";
	$_SESSION['address_more_info'] = "";
	$_SESSION['barangay'] = "";
	$_SESSION['city'] = "";
	$_SESSION['postal_code'] = "";
	$_SESSION['province'] = "";
	$_SESSION['region'] = "";
	$_SESSION['school'] = "";
	$_SESSION['degree'] = "";
	$_SESSION['field_study'] = "";
	$_SESSION['start_year'] = "";
	$_SESSION['year_ended'] = "";
	$_SESSION['skills'] = "";
	$_SESSION['coe'] = "";
}

?>

<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Jobseeker Sign Up</title>

	<!-- Site favicon -->
	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="template-files/vendors/images/logo1-removebg.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="template-files/src/plugins/jquery-steps/jquery.steps.css">
	<link rel="stylesheet" type="text/css" href="template-files/vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<!-- <link rel="stylesheet" type="text/css" href="template-files/src/plugins/sweetalert2/sweetalert2.css"> -->
	<link rel="stylesheet" href="template-files/sweetalert/sweetalert2.min.css">

</head>

<body class="login-page">

	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="template-files/vendors/images/logo1-removebg.png" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="index.php">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="template-files/vendors/images/employer (2).png" alt="" style="  mix-blend-mode: darken;">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard" action="user-otp/jobseekerOtp.php" method="POST" enctype="multipart/form-data">
								<h5>Personal Information</h5>
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
												<input type="text" name="full_name" class="form-control" value="<?php echo $_SESSION['full_name']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Contact Number*</label>
											<div class="col-sm-8">
												<input type="text" name="contact_number" class="form-control" value="<?php echo $_SESSION['contact_number']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Email Address*</label>
											<div class="col-sm-8">
												<input type="email" name="email_address" class="form-control" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Password*</label>
											<div class="col-sm-8">
												<input type="password" name="password" class="form-control" value="<?php echo $_SESSION['password']; ?>" required>
											</div>
										</div>
									</div>
								</section>
								<!-- Step 2 -->
								<h5>Address Information</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Region*</label>
											<div class="col-sm-8">
												<input type="text" name="region" class="form-control" value="<?php echo $_SESSION['region']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Province*</label>
											<div class="col-sm-8">
												<input type="text" name="province" class="form-control" value="<?php echo $_SESSION['province']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">City/Municipality *</label>
											<div class="col-sm-8">
												<input type="text" name="city" class="form-control" value="<?php echo $_SESSION['city']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Barangay*</label>
											<div class="col-sm-8">
												<input type="text" name="barangay" class="form-control" value="<?php echo $_SESSION['barangay']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Postal Code*</label>
											<div class="col-sm-8">
												<input type="text" name="postal_code" class="form-control" value="<?php echo $_SESSION['postal_code']; ?>" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Street Name, Building, House No.*</label>
											<div class="col-sm-8">
												<input type="text" name="address_more_info" class="form-control" value="<?php echo $_SESSION['address_more_info']; ?>" required>
											</div>
										</div>
									</div>
								</section>
								<!-- Step 3 -->
								<h5>Educational Attaintment</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">School</label>
											<div class="col-sm-8">
												<input type="text" name="school" class="form-control" placeholder="ex. The Lewis College" value="<?php echo $_SESSION['school']; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Degree</label>
											<div class="col-sm-8">
												<input type="text" name="degree" class="form-control" placeholder="ex. Bachelor's" value="<?php echo $_SESSION['degree']; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Field of study</label>
											<div class="col-sm-8">
												<input type="text" name="field_study" class="form-control" placeholder="ex. Business" value="<?php echo $_SESSION['field_study']; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Start Year</label>
											<div class="col-sm-8">
												<input type="text" name="start_year" class="form-control" value="<?php echo $_SESSION['start_year']; ?>">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Year Ended</label>
											<div class="col-sm-8">
												<input type="text" name="year_ended" class="form-control" value="<?php echo $_SESSION['year_ended']; ?>">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 4 -->
								<h5>Other Information</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<ul class="register-info">
											<li>
												<div class="mb-30">
													<h5 class="h5">Skills</h5>
													<input type="text" data-role="tagsinput" style="display: none; height:500px;" class="w-100" name="skills" value="<?php echo $_SESSION['skills']; ?>">
												</div>
											</li>
											<li>
												<div class="mb-30">
													<h5 class="h5">Honors & Rewards</h5>
													<input type="text" data-role="tagsinput" style="display: none;" class="w-100" name="coe" value="<?php echo $_SESSION['coe']; ?>">
												</div>
											</li>
										</ul>
										<!-- success Popup html Start -->
										<button type="submit" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static" name="jobSeekerSubmitBtn">Launch modal</button>
										<!-- <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
												<div class="modal-content">
													<div class="modal-body text-center font-18">
														<h3 class="mb-20">Account details are set</h3>
														<div class="mb-30 text-center"><img src="template-files/vendors/images/success.png"></div>
														Verify Your account.
													</div>
													<div class="modal-footer justify-content-center">
														<button class="btn btn-primary" name="doneBtn">Veify my account</button>
													</div>
												</div>
											</div>
										</div> -->
										<!-- success Popup html End -->
									</div>
								</section>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="template-files/vendors/scripts/core.js"></script>
	<script src="template-files/vendors/scripts/script.min.js"></script>
	<script src="template-files/vendors/scripts/process.js"></script>
	<script src="template-files/vendors/scripts/layout-settings.js"></script>
	<script src="template-files/src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="template-files/vendors/scripts/steps-setting.js"></script>
	<script src="template-files/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script src="template-files/sweetalert/sweetalert2.min.js"></script>

</body>

<?php if (isset($_GET['emailHasBeenUsed'])) : ?>
	<script>
		var email = "<?php echo $_SESSION['email_address']; ?>";
		Swal.fire({
			title: 'Error!',
			text: 'Email has been used by other',
			icon: 'error',
			confirmButtonText: 'Change email'
		})
	</script>
<?php endif; ?>


</html>