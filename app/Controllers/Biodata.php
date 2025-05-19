<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BiodataModel;
use App\Models\ProvinsiModel;


class Biodata extends BaseController
{
	protected $m_biodata;
	protected $m_provinsi;
	protected $session;

	public function __construct()
	{
		$this->m_biodata = new BiodataModel();
		$this->m_provinsi = new ProvinsiModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/'));
		}
		$data = ['title' => 'data biodata', 'active' => 'biodata'];
		return view('admin/biodata/index', $data);
	}
	public function getData()
	{
		if ($this->request->isAJAX()) {

			$katakunci		= $this->request->getPost('katakunci');
			$res 			= $this->m_biodata->cari($katakunci);
			$resProvinsi	= $this->m_provinsi->getProvinsi();
			$ret = "";
			if (!empty($res)) {
				foreach ($res as $key) {
					$ret = "<div class='card-header'><h3 class='card-title'><h6 class='text-uppercase text-bold text-14 mg-b-0'>Form Data Pasien</h6><h7>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</h7></h3></div>";
					$ret .= "<form class='form-data' id='form'>"; // mulai form
					$ret .= csrf_field(); // sisipkan CSRF token setelah buka form
					$ret .= "<input type='hidden' name='id' value='" . htmlspecialchars($key->id) . "'>";
					$ret .= "<div class='card-body'>";
					$ret .= "<div class='row'>
								<div class='col-3'>
									<label>Gelar Depan: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='gelar_depan' name='gelar_depan' value='" . htmlspecialchars($key->gelar_depan) . "'>
								</div>
								<div class='col-4'>
									<label>Nama Lengkap: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap' value='" . htmlspecialchars($key->nama_lengkap) . "'>
								</div>
								<div class='col-3'>
									<label>Gelar Belakang: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='gelar_belakang' name='gelar_belakang' value='" . htmlspecialchars($key->gelar_belakang) . "'>
								</div>
							</div>";
					$ret .= "<div class='row'>
								<div class='col-3'>
									<label>No Medrek: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='no_rm' name='no_rm' value='" . htmlspecialchars($key->no_rm) . "' disabled>
								</div>
								<div class='col-4'>
									<label>NIK: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='nik' name='nik' value='" . htmlspecialchars($key->nik) . "'>
								</div>
								<div class='col-3'>
									<label>Tanggal/Tahun Lahir: <span class='text-danger'>*</span></label>
									<input type='date' class='form-control' id='tgl_lahir' name='tgl_lahir' value='" . htmlspecialchars($key->tgl_lahir) . "'>
								</div>
							</div>";
					$ret .= "<div class='row'>
								<div class='col-3'>
									<label>Jenis Kelamin: <span class='text-danger'>*</span></label>
									<select class='form-control select2 select2-danger' data-dropdown-css-class='select2-danger' id='jenis_kelamin' name='jenis_kelamin' data-allow-clear='true' style='width:100%'>
										<option disabled selected>-- Pilih Jenis Kelamin --</option>
										<option value='L' " . ($key->jenis_kelamin == "L" ? "selected='selected'" : "") . ">Laki-laki</option>
										<option value='P' " . ($key->jenis_kelamin == "P" ? "selected='selected'" : "") . ">Perempuan</option>
									</select>
								</div>
								<div class='col-4'>
									<label>Telepon: <span class='text-danger'>*</span></label>
									<input type='text' class='form-control' id='telepon' name='telepon' value='" . htmlspecialchars($key->telepon) . "'>
								</div>
								<div class='col-3'>
									<label>Status: <span class='text-danger'>*</span></label>
									<select class='form-control select2 select2-danger' data-dropdown-css-class='select2-danger' id='status' name='status' data-allow-clear='true' style='width:100%'>
										<option disabled selected>-- Pilih Status --</option>
										<option value='menikah' " . ($key->status == "menikah" ? "selected='selected'" : "") . ">Menikah</option>
										<option value='belum_menikah' " . ($key->status == "belum_menikah" ? "selected='selected'" : "") . ">Belum Menikah</option>
										<option value='duda' " . ($key->status == "duda" ? "selected='selected'" : "") . ">Duda</option>
										<option value='janda' " . ($key->status == "janda" ? "selected='selected'" : "") . ">Janda</option>
									</select>
								</div>
							</div>";
					$ret .= "<div class='row'>";
					$ret .= "<div class='col-4'>
							<label>Pekerjaan: <span class='text-danger'>*</span></label>
							<input type='text' class='form-control' id='pekerjaan' name='pekerjaan' value='" . htmlspecialchars($key->pekerjaan) . "'>
							</div>";
					$ret .= "<div class='col-3'>";
					$ret .= "<label>Provinsi: <span class='text-danger'>*</span></label>";
					$ret .= "<select class='form-control select2 select2-danger'
							data-dropdown-css-class='select2-danger'
							id='id_provinsi_" . $key->id . "'
							name='id_provinsi'
							data-allow-clear='true'
							style='width:100%'
							onchange='loadKota(this.value, \"id_kota_" . $key->id . "\")'>";
					$ret .= "<option disabled " . (empty($key->id_provinsi) ? "selected" : "") . ">-- Pilih Provinsi --</option>";
					foreach ($resProvinsi as $prov) {
						$selected = $prov->id_provinsi == $key->id_provinsi ? "selected" : "";
						$ret .= "<option value='" . htmlspecialchars($prov->id_provinsi) . "' $selected>" . htmlspecialchars($prov->nama_provinsi) . "</option>";
					}
					$ret .= "</select>";
					$ret .= "</div>";
					$ret .= "<div class='col-3'>
							<label>Kota: <span class='text-danger'>*</span></label>
							<select class='form-control select2 select2-danger'
								data-dropdown-css-class='select2-danger'
								id='id_kota_" . $key->id . "'
								name='id_kota'
								style='width:100%'
							>
								<option value='" . htmlspecialchars($key->id_kota) . "' selected>" . htmlspecialchars($key->nama_kota) . "</option>
							</select>
							</div>";
					$ret .= "</div>";
					$ret .= "<div class='row'>
							<div class='col-10'>
								<label>Alamat: <span class='text-danger'>*</span></label>
								<textarea rows='5' id='alamat' name='alamat' class='form-control'>" . htmlspecialchars($key->alamat) . "</textarea>
							</div>
							</div>";
					$ret .= "<div class='row'>
							<div class='col-10'>
								<label>keterangan: <span class='text-danger'>*</span></label>
								<textarea rows='5' id='keterangan' name='keterangan' class='form-control'>" . htmlspecialchars($key->keterangan) . "</textarea>
							</div>
							</div>";
					$ret .= "<hr>
							<div class='text-center'>
								<a type='a' class='btn btn-light' id='btnCancelForm'>Cancel</a>
								<button type='button' class='btn btn-primary' onclick='_updateData(\"$key->id\",\"$key->nik\")'>Simpan</button>
								<button type=\"button\" class=\"btn btn-danger\" onclick=\"_hapusData('{$key->id}', '" . addslashes($key->nama_lengkap) . "')\">Hapus</button>
							</div>";
					$ret .= "</div>"; // Tutup card-body
					$ret .= "</form>"; // Tutup form
					// Script JS
					$ret .= "<script>
					$('#btnCancelForm').click(function() {
                            _cariData();
							$('#formData').addClass('d-none');;
                          });
					setTimeout(function() {
						$('.select2').select2();
					}, 100);

					window.loadKota = function(id_provinsi, targetId) {
						$.ajax({
						url: '" . site_url('Kota/getByProv') . "',
						method: 'POST',
						data: { id_provinsi: id_provinsi },
						success: function(response) {
							let options = '<option disabled selected>-- Pilih Kota --</option>';
							response.forEach(function(kota) {
							options += '<option value=\"' + kota.id_kota + '\">' + kota.nama_kota + '</option>';
							});
							$('#' + targetId).html(options).trigger('change');
						},
						error: function() {
							alert('Gagal memuat kota');
						}
						});
					};

					function _hapusData(id, nama_lengkap) {
						if (confirm('Hapus Data ' + nama_lengkap + '?')) {
						$.ajax({
							url: '" . site_url('/Biodata/del_data') . "',
							type: 'POST',
							data: { id: id },
							dataType: 'JSON',
							success: function(response) {
							if (response.sukses) {
								toastr.error('Data berhasil dihapus <b>' + nama_lengkap + '</b>');
								_cariData();
								 $('#formData').addClass('d-none');
							}
							},
							error: function(xhr, ajaxOptions, thrownError) {
							alert(xhr.status + '\\n' + xhr.responseText + '\\n' + thrownError);
							}
						});
						}
					}
					</script>";
				}
			} else {
				$ret = "<div class='card-header text-center' style='background-color:#fff;'><h3 class='card-title'>
				<h6 class='text-bold text-14 mg-b-0 text-red'>
						<i class='nav-icon fas fa-bell'></i><i>
				Data pasien tidak ditemukan</i></h6></h6></h3></div>";
			}
			return $ret;
		} else {
			exit('Request Error');
		}
	}

	public function form_data()
	{
		if ($this->request->isAJAX()) {
			$id		= $this->request->getPost('id');
			$dataProv   = $this->m_provinsi->getProvinsi();;
			if ($id == "") {
				$no_rm = $this->m_biodata->generateNoRm();
				$ret = "<div class='card-header'><h3 class='card-title'><h6 class='text-uppercase text-bold text-14 mg-b-0'>Form Data Pasien</h6><h7>Semua kolom yang bertanda (<b class='text-danger'>*</b>) harus diisi.</h7></h3></div>";
				$ret .= "<form class='form-data' id='form'>"; // mulai form
				$ret .= csrf_field(); // sisipkan CSRF token setelah buka form
				$ret .= "<div class='card-body'>"; // mulai card body
				$ret .= "<div class='row'>
							<div class='col-3'>
								<label>Gelar Depan: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='gelar_depan' name='gelar_depan'>
							</div>
							<div class='col-4'>
								<label>Nama Lengkap: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='nama_lengkap' name='nama_lengkap'>
							</div>
							<div class='col-3'>
								<label>Gelar Belakang: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='gelar_belakang' name='gelar_belakang'>
							</div>
						</div>
						<div class='row'>
							<div class='col-3'>
								<label>No Medrek: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='no_rm' name='no_rm' value='".$no_rm."' readonly>
							</div>
							<div class='col-4'>
								<label>NIK: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='nik' name='nik'>
							</div>
							<div class='col-3'>
								<label>Tanggal/Tahun Lahir: <span class='text-danger'>*</span></label>
								<input type='date' class='form-control' id='tgl_lahir' name='tgl_lahir'>
							</div>
						</div>
						<div class='row'>
							<div class='col-3'>
								<label>Jenis Kelamin: <span class='text-danger'>*</span></label>
								<select class='form-control select2 select2-danger' data-dropdown-css-class='select2-danger' id='jenis_kelamin' name='jenis_kelamin' data-allow-clear='true' style='width:100%'>
									<option>-- Pilih Jenis Kelamin --</option>
									<option value='L'>Laki-laki</option>
									<option value='P'>Perempuan</option>
								</select>
							</div>
							<div class='col-4'>
								<label>Telepon: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='telepon' name='telepon'>
							</div>
							<div class='col-3'>
								<label>Status: <span class='text-danger'>*</span></label>
								<select class='form-control select2 select2-danger' data-dropdown-css-class='select2-danger' id='status' name='status' data-allow-clear='true' style='width:100%'>
									<option>-- Pilih Status --</option>
									<option value='menikah'>Menikah</option>
									<option value='belum_menikah'>Belum Menikah</option>
									<option value='duda'>Duda</option>
									<option value='janda'>Janda</option>
								</select>
							</div>
						</div>";
				$ret .= "<div class='row'>
							<div class='col-4'>
								<label>Pekerjaan: <span class='text-danger'>*</span></label>
								<input type='text' class='form-control' id='pekerjaan' name='pekerjaan'>
							</div>";
				$ret .= "<div class='col-3'>";
				$ret .= "<label>Provinsi: <span class='text-danger'>*</span></label>";
				$ret .= "<select class='form-control select2 select2-danger'
							data-dropdown-css-class='select2-danger'
							id='id_provinsi'
							name='id_provinsi'
							data-allow-clear='true'
							style='width:100%'
							onchange='loadKota(this.value, \"id_kota\")'>";
				$ret .= "<option>-- Pilih Provinsi --</option>";
				foreach ($dataProv as $prov) {
					$ret .= "<option value='$prov->id_provinsi'>" . htmlspecialchars($prov->nama_provinsi) . "</option>";
				}
				$ret .= "</select>";
				$ret .= "</div>";
				$ret .= "<div class='col-3'>
							<label>Kota: <span class='text-danger'>*</span></label>
							<select class='form-control select2 select2-danger'
								data-dropdown-css-class='select2-danger'
								id='id_kota'
								name='id_kota'
								style='width:100%'>
								<option value=''></option>
							</select>
							</div>";
				$ret .= "</div>";
				$ret .=	"<div class='row'>
							<div class='col-10'>
								<label>Alamat: <span class='text-danger'>*</span></label>
								<textarea rows='5' id='alamat' name='alamat' class='form-control'></textarea>
							</div>
						</div>
						<div class='row'>
							<div class='col-10'>
								<label>keterangan: <span class='text-danger'>*</span></label>
								<textarea rows='5' id='keterangan' name='keterangan' class='form-control'></textarea>
							</div>
						</div>
						<hr>
						<div class='text-center'>
							<a type='a' class='btn btn-light' id='btnCancelForm'>Cancel</a>
							<button type='button' class='btn btn-primary' onclick='_simpanData()'>Simpan</button>
						</div>";
				$ret .= "</div>"; // akhir card body
				$ret .= "</form>"; // akhir form
				$ret .= "<script>
					setTimeout(function(){ $('.select2').select2(); }, 100);

					$('#btnCancelForm').on('click', function(){
					$('#formData').addClass('d-none');
					});
					window.loadKota = function(id_provinsi, targetId) {
						$.ajax({
						url: '" . site_url('Kota/getByProv') . "',
						method: 'POST',
						data: { id_provinsi: id_provinsi },
						success: function(response) {
							let options = '<option disabled selected>-- Pilih Kota --</option>';
							response.forEach(function(kota) {
							options += '<option value=\"' + kota.id_kota + '\">' + kota.nama_kota + '</option>';
							});
							$('#' + targetId).html(options).trigger('change');
						},
						error: function() {
							alert('Gagal memuat kota');
						}
						});
					};
					</script>";
			}
			return $ret;
		}
	}

	public function simpan_data()
	{
		if ($this->request->isAJAX()) {

			$gelar_depan			= strtoupper($this->request->getVar('gelar_depan'));
			$nama_lengkap			= strtoupper($this->request->getVar('nama_lengkap'));
			$gelar_belakang			= strtoupper($this->request->getVar('gelar_belakang'));
			$no_rm 					= $this->m_biodata->generateNoRm();
			$nik					= $this->request->getVar('nik');
			$tgl_lahir				= $this->request->getVar('tgl_lahir');
			$jenis_kelamin			= $this->request->getVar('jenis_kelamin');
			$telepon				= $this->request->getVar('telepon');
			$status					= $this->request->getVar('status');
			$pekerjaan				= strtoupper($this->request->getVar('pekerjaan'));
			$id_provinsi			= $this->request->getVar('id_provinsi');
			$id_kota				= $this->request->getVar('id_kota');
			$alamat					= strtoupper($this->request->getVar('alamat'));
			$keterangan				= strtoupper($this->request->getVar('keterangan'));

			$data = [
				'gelar_depan'	=> $gelar_depan,
				'nama_lengkap'	=> $nama_lengkap,
				'gelar_belakang' => $gelar_belakang,
				'no_rm' 		=> $no_rm,
				'nik'			=> $nik,
				'tgl_lahir'		=> $tgl_lahir,
				'jenis_kelamin'	=> $jenis_kelamin,
				'telepon'		=> $telepon,
				'status'		=> $status,
				'pekerjaan'		=> $pekerjaan,
				'id_provinsi'	=> $id_provinsi,
				'id_kota'		=> $id_kota,
				'alamat'		=> $alamat,
				'keterangan'	=> $keterangan,
				'created_user'	=> session()->get('id'),
				'created_dttm'	=> date('Y-m-d H:i:s'),
			];
			$insert = $this->m_biodata->insertData($data);
			if ($insert == TRUE) {
				echo json_encode(['sukses' => 'Pasien baru dengan No.RM '.$no_rm.' berhasil disimpan']);
			}
			else {
				echo json_encode(['gagal'	=> "NIK: <b class='text-danger'>$nik</b> sudah ada, silahkan coba yang lain."]);
			}
		}
		else {
			exit('Request Error');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id						= $this->request->getVar('id');
			$gelar_depan			= strtoupper($this->request->getVar('gelar_depan'));
			$nama_lengkap			= strtoupper($this->request->getVar('nama_lengkap'));
			$gelar_belakang			= strtoupper($this->request->getVar('gelar_belakang'));
			$nik					= $this->request->getVar('nik');
			$tgl_lahir				= $this->request->getVar('tgl_lahir');
			$jenis_kelamin			= $this->request->getVar('jenis_kelamin');
			$telepon				= $this->request->getVar('telepon');
			$status					= $this->request->getVar('status');
			$pekerjaan				= strtoupper($this->request->getVar('pekerjaan'));
			$id_provinsi			= $this->request->getVar('id_provinsi');
			$id_kota				= $this->request->getVar('id_kota');
			$alamat					= strtoupper($this->request->getVar('alamat'));
			$keterangan				= strtoupper($this->request->getVar('keterangan'));

			$data = [
				'gelar_depan'	=> $gelar_depan,
				'nama_lengkap'	=> $nama_lengkap,
				'gelar_belakang' => $gelar_belakang,
				'nik'			=> $nik,
				'tgl_lahir'		=> $tgl_lahir,
				'jenis_kelamin'	=> $jenis_kelamin,
				'telepon'		=> $telepon,
				'status'		=> $status,
				'pekerjaan'		=> $pekerjaan,
				'id_provinsi'	=> $id_provinsi,
				'id_kota'		=> $id_kota,
				'alamat'		=> $alamat,
				'keterangan'	=> $keterangan,
				'updated_user'	=> session()->get('id'),
				'updated_dttm'	=> date('Y-m-d H:i:s'),
			];

			$update = $this->m_biodata->updateData($id, $data);

			if ($update) {
				return $this->response->setJSON(['sukses' => true]);
			} else {
				return $this->response->setJSON(['error' => 'Gagal menyimpan data.']);
			}
		} else {
			exit('Request Error');
		}
	}

	public function del_data()
	{
		if ($this->request->isAJAX()) {
			$id		= $this->request->getPost('id');
			$data	= [
				'status_cd'		 => 'nullified',
				'nullified_user' => session()->get('id'),
				'nullified_dttm' => date('Y-m-d H:i:s'),
			];
			$this->m_biodata->deleteSoft($id, $data);
			$msg = ['sukses' => 'Data user telah dihapus.'];
			echo json_encode($msg);
		} else {
			exit('Request Error');
		}
	}
}
