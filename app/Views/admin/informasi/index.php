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

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= form_open() ?>
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="width:20px;">No</th>
										<th colspan="2" style="text-align: center;">DATA INFORMASI</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td style="width: 400px;">Nama Sistem</td>
										<td>Aplikasi Pendaftaran Pasien Berobat</td>
									</tr>
									<tr>
										<td>2</td>
										<td style="width: 400px;">Deskripsi Sistem</td>
										<td>Sistem ini digunakan untuk manajemen kunjungan berobat pasien secara digital</td>
									</tr>
									<tr>
										<td>3</td>
										<td style="width: 400px;">Tujuan Pengembangan</td>
										<td>Memperbaiki pendataan rekam medis pasien secara digital dan dalam bentuk pelaporan</td>
									</tr>
									<tr>
										<td>4</td>
										<td style="width: 400px;">Hak Akses Pengguna</td>
										<td>
											<ul class="mb-0">
												<li><strong>Admin:</strong> Manajemen pengguna, kontrol penuh sistem</li>
												<li><strong>User:</strong> pengelolaan laporan kunjungan pasien</li>
											</ul>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td style="width: 400px;">Teknologi & Tools yang Digunakan</td>
										<td>
											<ul class="mb-0">
												<li><strong>Framework Backend:</strong> CodeIgniter 4 (PHP 7.4+)</li>
												<li><strong>Database:</strong> MySQL / MariaDB</li>
												<li><strong>Frontend:</strong> Bootstrap 4, jQuery, DataTables</li>
												<li><strong>Server:</strong> Apache / Nginx</li>
												<li><strong>Version Control:</strong> Git (GitHub / GitLab)</li>
												<li><strong>Tools Pengembangan:</strong> VS Code, XAMPP</li>
												<li><strong>Template:</strong> AdminLTE 3</li>
											</ul>
										</td>
									</tr>
									<tr>
										<td>6</td>
										<td style="width: 400px;">Kontak Pengembang</td>
										<td>
											<ul class="mb-0">
												<li><strong>Email:</strong> sriwijayabersamateknologi@gmail.com</li>
												<!-- <li><strong>Website:</strong> sribertech.shop</li> -->
												<li><strong>Github:</strong> https://github.com/redhorivai</li>
											</ul>
										</td>
									</tr>
								</tbody>
							</table>
							<?= form_close() ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<?= $this->endSection() ?>
