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
	<form action="#" id='formPassword' class="form-data">
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
						<input type="text" class="form-control" id="jenis_kelamin" name="jenis_kelamin" value="<?= $jk; ?>"
							disabled>
					</div>
					<div class="form-group">
						<label>Telepon: <span class='text-danger'>*</span></label>
						<input type="number" class="form-control" id="telepon" name="telepon" value="<?= $key->telepon; ?>"
							disabled>
					</div>
					<div class="form-group">
						<label>Email: <span class='text-danger'>*</span></label>
						<input type="email" class="form-control" id="email" name="email" value="<?= $key->email; ?>"
							disabled>
					</div>
					<div class="form-group">
						<label>Alamat: <span class='text-danger'>*</span></label>
						<textarea rows="3" id="alamat" name="alamat" class="form-control"
							disabled><?= $key->alamat; ?></textarea>
					</div>
					<div class="form-group">
						<label>Password Baru</label>
						<input type="password" id="password" name="password" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Konfirmasi Password</label>
						<input type="password" id="password_confirm" name="password_confirm" class="form-control" required>
					</div>
				</div>
			</div>
		<?php endforeach ?>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Ubah Password</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$('#formPassword').submit(function(e) {
		e.preventDefault();

		const password = $('#password').val();
		const confirm = $('#password_confirm').val();

		if (password !== confirm) {
			toastr.error('Password dan konfirmasi tidak cocok.');
			return;
		}

		$.ajax({
			url: "<?= site_url('Akun/update_password') ?>",
			type: "POST",
			data: $(this).serialize(),
			dataType: "JSON",
			success: function(response) {
				if (response.sukses) {
					toastr.success('Password berhasil diperbarui');
					$('#formPassword')[0].reset();
				} else {
					toastr.error('Gagal memperbarui password');
				}
			},
			error: function(xhr) {
				alert(xhr.responseText);
			}
		});
	});
</script>
<?= $this->endSection() ?>
