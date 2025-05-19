<?= $this->extend('admin/layout/main_layout'); ?>
<!-- MAIN CONTENT -->
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('panel/dashboard'); ?>">Dashboard</a></li>
						<li class="breadcrumb-item active"><?= $title; ?></li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<form action="#" id='form' class="form-data">
		<?php foreach ($akun as $key): ?>
			<?php
			if ($key->jenis_kelamin == 'L') {
				$jk	= "Laki-laki";
			} else {
				$jk	= "Perempuan";
			}
			?>
			<input type="hidden" name="id" value="<?= $key->id; ?>">
			<div class="modal-body">
				<div class="card-body">
					<div class="form-group">
						<label>Nama: <span class='text-danger'>*</span></label>
						<input type="text" class="form-control" id="nama" name="nama" value="<?= $key->nama; ?>" disabled>
					</div>
					<div class="form-group">
						<label>Jenis kelamin: <span class='text-danger'>*</span></label>
						<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $jk; ?>" disabled>
					</div>
					<div class="form-group">
						<label>Telepon: <span class='text-danger'>*</span></label>
						<input type="number" class="form-control" id="telepon" name="telepon" value="<?= $key->telepon; ?>" disabled>
					</div>
					<div class="form-group">
						<label>Email: <span class='text-danger'>*</span></label>
						<input type="email" class="form-control" id="email" name="email" value="<?= $key->email; ?>" disabled>
					</div>
					<div class="form-group">
						<label>Alamat: <span class='text-danger'>*</span></label>
						<textarea rows="3" id="alamat" name="alamat" class="form-control" disabled><?= $key->alamat; ?></textarea>
					</div>
					<div class="form-group">
						<label>Password: <span class='text-danger'>*</span></label>
						<input type="password" class="form-control" id="password" name="password" placeholder="masukan kata sandi baru">
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<div class="modal-footer">
			<button type="button" class="btn btn-danger" onclick="_resetData()">Reset</button>
			<button type="button" class="btn btn-primary" onclick="_simpanData()">Simpan</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	function _resetData(){
		document.getElementById("form").reset();
	}
	function _simpanData() {
		var password = $("#password").val();
		if (password == "") {
			$("#password").focus();
			$('#password').addClass('is-invalid');
		} else {
			$('#password').removeClass('is-invalid');
		}
		if (confirm(`Yakin data akan disimpan?`)) {
			$.ajax({
				url: "<?= site_url('Akun/update_password') ?>",
				type: "POST",
				data: new FormData($('#form')[0]),
				dataType: 'JSON',
				contentType: false,
				processData: false,
				success: function(data) {
					if (data.status) {
						toastr.success(`data berhasil disimpan`);
						setTimeout(function() { // wait for 5 secs(2)
							location.reload(); // then reload the page.(3)
						}, 1000);
					}
				},
			});
		}
	}
</script>
<?= $this->endSection() ?>
