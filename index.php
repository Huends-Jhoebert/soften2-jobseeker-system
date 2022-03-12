<?php include_once "header.php"; ?>
<link rel="stylesheet" href="template-files/sweetalert/sweetalert2.min.css">
<title>Jobseeker - Log in</title>
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
						<div class="login-title">
							<h2 class="text-center text-primary">JobSeeker</h2>
						</div>
						<form>
							<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="template-files/vendors/images/briefcase.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employer
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="template-files/vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Jobseeker
									</label>
								</div>
							</div>
							<div class="input-group custom">
								<input type="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********">
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
										<a class="btn btn-primary btn-lg btn-block" href="index.html">Sign In</a>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-info btn-lg btn-block" href="signup.php">Register as employer</a>
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


	<?php include_once "footer.php"; ?>