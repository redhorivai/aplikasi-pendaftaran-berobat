<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aplikasi Pendaftaran Pasien Berobat</title>

	<!-- google font -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/css/fonts-googleapis.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/fontawesome-free/css/all.min.css">
	<!-- tempusdominus boostrap 4 -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/css/adminlte.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/css/jquery-ui.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/daterangepicker/daterangepicker.css">
	<!-- Datatables -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</head>

<body>
	<!-- Preloader -->
	<!-- <div class="preloader flex-column justify-content-center align-items-center">
		<img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
	</div> -->
	<!-- SIDEBAR MENU -->
	<?= $this->include('admin/layout/menu') ?>
	<!-- HEADER -->
	<?= $this->include('admin/layout/header') ?>
	<!-- CONTENT -->
	<?= $this->renderSection('content') ?>
	<!-- FOOTER -->
	<?= $this->include('admin/layout/footer') ?>
	<!-- LIBRARIES JS -->
	<?= $this->include('admin/layout/script') ?>

</body>

</html>
