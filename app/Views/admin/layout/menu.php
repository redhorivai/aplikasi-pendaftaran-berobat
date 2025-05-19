<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
	<!-- Brand Logo -->
	<a href="javascript:void(0)" class="brand-link">
		<img src="<?= base_url(); ?>/assets-admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminPanel</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<?php
				if ((session()->get('jenis_kelamin')) == 'L') {
					$avatar = "<img src='" . base_url() . "/assets-admin/img/male.png' class='rounded-circle'>";
				} else {
					$avatar = "<img src='" . base_url() . "/assets-admin/img/female.png' class='rounded-circle'>";
				}
				?>
				<?= $avatar; ?>
			</div>
			<div class="info">
				<a href="javascript:void(0)" class="d-block"> <?= session()->get('username') ?>
				</a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?php if ($active == "dashboard") {
																						echo "active";
																					} ?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-header">DATA MASTER</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/pengguna') ?>" class="nav-link <?php if ($active == "pengguna") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-user"></i>
						<p>
							Data pengguna
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/provinsi') ?>" class="nav-link <?php if ($active == "provinsi") {
																					echo "active";
																				} ?>">
						<i class="nav-icon fas fa-plus"></i>
						<p>
							Data Provinsi
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/kota') ?>" class="nav-link <?php if ($active == "kota") {
																				echo "active";
																			} ?>">
						<i class="nav-icon fas fa-info"></i>
						<p>
							Data Kota
						</p>
					</a>
				</li>
				<li class="nav-header">PASIEN</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/biodata') ?>" class="nav-link <?php if ($active == "biodata") {
																				echo "active";
																			} ?>">
						<i class="nav-icon fas fa-hospital-user"></i>
						<p>
							Biodata
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/kunjungan') ?>" class="nav-link <?php if ($active == "kunjungan") {
																				echo "active";
																			} ?>">
						<i class="nav-icon fas fa-notes-medical"></i>
						<p>
							Kunjungan
						</p>
					</a>
				</li>
				<li class="nav-header">LAPORAN</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/laporan') ?>" class="nav-link <?php if ($active == "laporan") {
																						echo "active";
																					} ?>">
						<i class="nav-icon fas fa-sticky-note"></i>
						<p>
							Rekapitulasi
						</p>
					</a>
				</li>
				<li class="nav-header">LAINNYA</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/password')?>" class="nav-link <?php if ($active == "password") {
																				echo "active";
																			} ?>">
						<i class="nav-icon fas fa-key"></i>
						<p>
							Ubah Kata Sandi
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('login/logout'); ?>" class="nav-link">
						<i class="nav-icon fas fa-power-off"></i>
						<p>
							Keluar
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('admin/informasi') ?>" class="nav-link <?php if ($active == "informasi") {
																						echo "active";
																					} ?>">
						<i class="nav-icon fas fa-info"></i>
						<p>
							Informasi
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
