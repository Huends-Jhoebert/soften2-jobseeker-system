<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../../template-files/vendors/styles/style.css">

	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../../template-files/vendors/images/logo1-removebg.png">
	<link rel="stylesheet" href="../../template-files/sweetalert/sweetalert2.min.css">
	<title>Admin - Log in</title>
</head>

<body class="login-page">

	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="#">
					<img src="../../template-files/vendors/images/logo1-removebg.png" alt="">
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
					<img src="../../template-files/vendors/images/admin.png" alt="" style="mix-blend-mode: darken;">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">SYSTEM ADMIN</h2>
						</div>
						<form action="queries/auth.php" method="POST">
							<div class="input-group custom">
								<input type="text" name="username" class="form-control form-control-lg" placeholder="Username">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-user" aria-hidden="true"></i></span>
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
										<button type="submit" name="logInBtn" class="btn btn-primary btn-lg btn-block">Sign In</button>
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">OR</div>
									<div class="input-group mb-0">
										<a class="btn btn-outline-primary btn-lg btn-block" href="adminRegister.php">Register</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../template-files/sweetalert/sweetalert2.min.js"></script>
</body>
<!-- js -->
<script src="../../template-files/vendors/scripts/core.js"></script>
<script src="../../template-files/vendors/scripts/script.min.js"></script>
<script src="../../template-files/vendors/scripts/process.js"></script>
<script src="../../template-files/vendors/scripts/layout-settings.js"></script>

<?php if (isset($_GET['successfull'])) : ?>
	<script>
		Swal.fire({
			position: 'top-end',
			icon: 'success',
			title: 'Your account is successfully added',
			showConfirmButton: false,
			timer: 1500
		})
	</script>
<?php endif; ?>

<?php if (isset($_GET['successfull'])) : ?>
	<script>
		Swal.fire({
			title: 'Error!',
			text: 'Wrong Username or Password',
			icon: 'error',
			confirmButtonText: 'Confirm'
		})
	</script>
<?php endif; ?>

</html>