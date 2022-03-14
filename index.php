<?php include_once "header.php"; ?>
<link rel="stylesheet" href="template-files/sweetalert/sweetalert2.min.css">
<title>JobSeeker - Log in</title>
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
					<li><a href="#">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="template-files/vendors/images/login-page-img.png" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<?php if (isset($_GET['unverified'])) : ?>
							<div class="alert alert-danger text-center" role="alert">
								Your account is not yet verified.
								<a href="verify-user/sendOtpCode.php" class="text-primary d-block">Verify my account</a>
							</div>
						<?php endif; ?>
						<div class="login-title">
							<h2 class="text-center text-primary">JobSeeker</h2>
						</div>
						<form action="auth/auth.php" method="POST">
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn">
										<input type="radio" value="Employer" name="options" id="admin" required>
										<div class="icon"><img src="template-files/vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employer
									</label>
									<label class="btn">
										<input type="radio" value="Jobseeker" name="options" id="user" require_once>
										<div class="icon"><img src="template-files/vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Jobseeker
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg" placeholder="**********">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-lock" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<button type="submit" name="logInBtn" class="btn btn-primary btn-lg btn-block">Sign In</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-info btn-lg btn-block" href="employerSignup.php">Register as employer</a>
										<a class="btn btn-outline-primary btn-lg btn-block" href="jobseekerSignup.php">Register as jobseeker</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="template-files/sweetalert/sweetalert2.min.js"></script>

	<?php if (isset($_GET['verifiedEmail'])) : ?>
		<script>
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				title: 'Your account is verified!',
				showConfirmButton: false,
				timer: 1500
			})
		</script>
	<?php endif; ?>

	<?php if (isset($_GET['invalid'])) : ?>
		<script>
			Swal.fire({
				title: 'Error!',
				text: 'Wrong Username or Password',
				icon: 'error',
				confirmButtonText: 'Confirm'
			})
		</script>
	<?php endif; ?>


	<?php include_once "footer.php"; ?>