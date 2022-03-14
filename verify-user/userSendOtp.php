<?php

session_start();

?>

<!DOCTYPE html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Jobseeker OTP</title>

	<!-- Site favicon -->
	<link rel="icon" type="image/png" sizes="32x32" href="../template-files/vendors/images/logo1-removebg.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../template-files/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../template-files/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../template-files/vendors/styles/style.css">
	<link rel="stylesheet" href="../template-files/sweetalert/sweetalert2.min.css">
</head>

<body>
	<div>
		<div class="min-height-200px">
			<div class="row justify-content-center mt-5">
				<div class="col-sm-12 col-md-4 mb-30">
					<div class="card card-box text-center p-2">
						<form action="accountVerify.php" method="POST">
							<div class="card-body">
								<h5 class="card-title">OTP verification</h5>
								<div class="alert alert-primary" role="alert">
									<p class="card-text">We sent a verification code to your email - <?php echo $_SESSION['email_address']; ?></p>
								</div>
								<div class="w-100">
									<input class="form-control d-block w-100" type="text" placeholder="Enter Verification Code" name="verification_code">
								</div>
								<button type="submit" class="btn btn-block btn-primary mt-3">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<script src="../template-files/vendors/scripts/core.js"></script>
<script src="../template-files/vendors/scripts/script.min.js"></script>
<script src="../template-files/vendors/scripts/process.js"></script>
<script src="../template-files/vendors/scripts/layout-settings.js"></script>
<script src="../template-files/sweetalert/sweetalert2.min.js"></script>

<?php if (isset($_GET['wrongOTP'])) : ?>
	<script>
		Swal.fire({
			title: 'Error!',
			text: 'Opps! Wrong OTP code',
			icon: 'error',
			confirmButtonText: 'Confirm'
		})
	</script>
<?php endif; ?>

</html>