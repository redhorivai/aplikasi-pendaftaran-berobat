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
									<span><a onclick="_tambahData()"><button type="button" class="btn bg-gradient-primary"><i class="nav-icon fas fa-plus"></i> Pasien Baru</button></a></span>
								</div>
							</div>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
			<div class="card card-info d-none" id="formData" >
				<div class=""></div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->

</div>
<?= $this->endSection() ?>
