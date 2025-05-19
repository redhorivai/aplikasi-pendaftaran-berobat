<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Aplikasi Pendaftaran Pasien Berobat</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/css/adminlte.min.css">
	<!-- Toast -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.css">

</head>

<body class="hold-transition login-page" style="background-color: #00bc8c;">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="javascript:void(0)" class="h1"><b>Aplikasi </b> klinik</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Silakan Masuk</p>

				<form id="login_form" method="post">
					<?= csrf_field(); ?>
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="username" name="username" placeholder="Username" style="text-transform:lowercase;">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember">
								<label for="remember">
									Remember Me
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">masuk</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->
	<?php
	if (!empty(session()->getFlashdata('sukses'))) {
		echo '<div class="flash_msg" data-successful="' . session()->getFlashdata('sukses') . '"></div>';
	}  else if (!empty(session()->getFlashdata('gagal'))) {
		echo '<div class="flash_msg" data-failed="' . session()->getFlashdata('gagal') . '"></div>';
	} else if (!empty(session()->getFlashdata('error'))) {
		echo '<div class="flash_msg" data-goofy="' . session()->getFlashdata('error') . '"></div>';
	}
	?>

	<!-- jQuery -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>/assets-admin/js/adminlte.min.js"></script>
	<!-- Toast -->
	<script src="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.js"></script>
	<!-- validate -->
	<script src="<?= base_url(); ?>/assets-admin/js/validasi-login.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#login_form').submit(function(e) {
				e.preventDefault();
				if ($('#username').val() == "") {
					toastr.warning(`Silakan masukan username anda`);
					$("#username").focus();
				} else if ($('#password').val() == "") {
					toastr.warning(`Silakan masukan kata sandi anda`);
					$("#password").focus();
				} else {
					$.ajax({
						type: "POST",
						url: "<?= base_url('login/get_login'); ?>",
						data: $(this).serialize(),
						dataType: "JSON",
						success: function(response) {
							toastr.options = {
								"closeButton": false,
								"debug": false,
								"newestOnTop": false,
								"progressBar": true,
								"positionClass": "toast-top-center",
								"preventDuplicates": false,
								"onclick": null,
								"showDuration": "300",
								"hideDuration": "1000",
								"timeOut": "2000",
								"extendedTimeOut": "1000",
								"showEasing": "swing",
								"hideEasing": "linear",
								"showMethod": "fadeIn",
								"hideMethod": "fadeOut"
							}
							if (response.sukses) {
								toastr.success(response.sukses);
								window.setTimeout(function() {
									window.location.replace("<?= base_url('/admin/dashboard'); ?>");
								}, 2000);
							}
							else if (response.gagal){
								toastr.info(response.gagal);
							}
							else {
								toastr.warning(response.status);
							}
						}
					});
					return false;
				}
			});
		});
	</script>
</body>

</html>
