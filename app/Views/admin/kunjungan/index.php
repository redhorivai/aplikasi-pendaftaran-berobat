<?= $this->extend('admin/layout/main_layout'); ?>
<!-- MAIN CONTENT -->
<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Main content -->
	<section class="content mt-2" id="viewData">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-2">
									<? form_open() ?>
									<div class="input-group mb-3">
										<input type="text" class="form-control" name="katakunci" id="katakunci" value="" placeholder="no rekam medis">
										<button type="button" class="btn bg-gradient-info" onclick="_cariData()">Cari</button>
									</div>
									<? form_close() ?>
								</div>
								<div class="col-3">
									<span><a id="btnTambah"><button type="button" class="btn bg-gradient-primary"><i class="nav-icon fas fa-plus"></i> Kunjungan Pasien</button></a></span>
								</div>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<?= form_open() ?>
							<table id="viewTable" class="table table-bordered table-striped">
								<thead>
									<tr class="text-center">
										<th>DATA PASIEN</th>
										<th style="width: 150px;">STATUS</th>
									</tr>
								</thead>
							</table>
							<?= form_close() ?>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" id='formKunjungan' class="form-data">
				<input type="hidden" name="id">
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group">
							<label>Nama Pasien: <span class="text-danger">*</span></label>
							<select
								class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
								id="no_rm"
								name="no_rm"
								style="width:100%" data-placeholder='-- Pilih Nama Pasien --'>
								<?php foreach ($biodata as $pas): ?>
									<option value="<?= esc($pas->no_rm) ?>">
										<?= esc($pas->nama_lengkap) ?> | <?= esc($pas->no_rm) ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Tipe Kunjungan: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="type_kunjungan" name="type_kunjungan" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Tipe Kunjungan --</option>
								<option value="Rawat Jalan">Rawat Jalan</option>
								<option value="Rawat Inap">Rawat Inap</option>
							</select>
						</div>
						<div class="form-group">
							<label>Nama Dokter: <span class='text-danger'>*</span></label>
							<input type="text" class="form-control" id="nama_dokter" name="nama_dokter" onchange="remove(id)">
						</div>
						<div class="form-group">
							<label>Catatan Kondisi: <span class='text-danger'>*</span></label>
							<textarea rows="5" id="catatan_kondisi" name="catatan_kondisi" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Catatan Obat: <span class='text-danger'>*</span></label>
							<textarea rows="5" id="catatan_obat" name="catatan_obat" class="form-control"></textarea>
						</div>
						<div class="form-group">
							<label>Status Kondisi: <span class='text-danger'>*</span></label>
							<select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" id="status_kondisi" name="status_kondisi" data-allow-clear="true" style="width:100%">
								<option disabled selected>-- Pilih Tipe Kunjungan --</option>
								<option value="Sembuh Pulang">Sembuh Pulang</option>
								<option value="Belum Sembuh">Belum Sembuh</option>
								<option value="Rujuk">Rujuk</option>
							</select>
						</div>
						<div class="form-group">
							<label>Keterangan: <span class='text-danger'>*</span></label>
							<textarea rows="5" id="keterangan" name="keterangan" class="form-control"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="button" class="btn btn-primary" id="btnSimpan">Simpan Data</button>
					</div>
			</form>
		</div>
	</div>
</div>
<!-- /.modal -->
<?= $this->endSection() ?>
