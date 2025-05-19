<!-- jQuery -->
<script src="<?= base_url(); ?>/assets-admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>/assets-admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/assets-admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>/assets-admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>/assets-admin/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/assets-admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>/assets-admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/assets-admin/js/adminlte.js"></script>
<!-- Datatables -->
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toast -->
<script src="<?= base_url(); ?>/assets-admin/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>/assets-admin/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url(); ?>/assets-admin/js/jquery-ui.min.js"></script>



<?php

if ($active == 'pengguna') {
	echo view('admin/pengguna/js');
} elseif ($active == 'provinsi') {
	echo view('admin/provinsi/js');
} elseif ($active == 'kota') {
	echo view('admin/kota/js');
} elseif ($active == 'akun') {
	echo view('admin/akun/js');
} elseif ($active == 'laporan') {
	echo view('admin/laporan/js');
} elseif ($active == 'biodata') {
	echo view('admin/biodata/js');
} elseif ($active == 'kunjungan') {
	echo view('admin/kunjungan/js');
}

?>
