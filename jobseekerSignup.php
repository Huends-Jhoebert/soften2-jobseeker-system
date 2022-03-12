<?php

if (isset($_POST['doneBtn'])) {
	echo $_POST['skills'];
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
					<img src="template-files/vendors/images/undraw_Interview_re_e5jn-removebg-preview.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard" action="user-otp/jobseekerOtp.php" method="POST">
								<h5>Personal Information</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Profile Image*</label>
											<div class="col-sm-8">
												<input type="file" name="image" class="form-control-file form-control height-auto" accept="image/*">
											</div>

										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Full Name*</label>
											<div class="col-sm-8">
												<input type="text" name="full_name" class="form-control">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Gender*</label>
											<div class="col-sm-8">
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" value="Male" id="male" name="gender" class="custom-control-input">
													<label class="custom-control-label" for="male">Male</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline pb-0">
													<input type="radio" id="female" name="gender" class="custom-control-input" value="Female">
													<label class="custom-control-label" for="female">Female</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Contact Number*</label>
											<div class="col-sm-8">
												<input type="text" name="contact_number" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Email Address*</label>
											<div class="col-sm-8">
												<input type="email" name="email_address" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Password*</label>
											<div class="col-sm-8">
												<input type="password" name="password" class="form-control">
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
												<input type="text" name="region" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Province*</label>
											<div class="col-sm-8">
												<input type="text" name="province" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">City*</label>
											<div class="col-sm-8">
												<input type="text" name="city" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Barangay*</label>
											<div class="col-sm-8">
												<input type="text" name="barangay" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Postal Code*</label>
											<div class="col-sm-8">
												<input type="text" name="postal_code" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Street Name, Building, House No.*</label>
											<div class="col-sm-8">
												<input type="text" name="address_more_info" class="form-control">
											</div>
										</div>
									</div>
								</section>
								<!-- Step 3 -->
								<h5>Educational Attaintment</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">School*</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" placeholder="ex. The Lewis College">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Degree</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" placeholder="ex. Bachelor's">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Field of study</label>
											<div class="col-sm-8">
												<input type="text" class="form-control" placeholder="ex. Business">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Start Year</label>
											<div class="col-sm-8">
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="form-group row align-items-center">
											<label class="col-sm-4 col-form-label">Year Ended</label>
											<div class="col-sm-8">
												<input type="text" class="form-control">
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
													<input type="text" data-role="tagsinput" style="display: none; height:500px;" class="w-100" name="skills">
												</div>
											</li>
											<li>
												<div class="mb-30">
													<h5 class="h5">Certificate(s) of employment</h5>
													<input type="text" data-role="tagsinput" style="display: none;" class="w-100" name="coe">
												</div>
											</li>
										</ul>
										<!-- success Popup html Start -->
										<button type="button" id="success-modal-btn" hidden data-toggle="modal" data-target="#success-modal" data-backdrop="static">Launch modal</button>
										<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
												<div class="modal-content">
													<div class="modal-body text-center font-18">
														<h3 class="mb-20">Account details are set</h3>
														<div class="mb-30 text-center"><img src="template-files/vendors/images/success.png"></div>
														Verify Your account.
													</div>
													<div class="modal-footer justify-content-center">
														<button type="submit" class="btn btn-primary" name="doneBtn">Veify my account</button>
													</div>
												</div>
											</div>
										</div>
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
</body>

<script>


</script>

</html>