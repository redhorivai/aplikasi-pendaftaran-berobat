<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KunjunganModel;
use App\Models\BiodataModel;
use App\Libraries\Date\DateFunction;


class Kunjungan extends BaseController
{
	protected $m_kunjungan;
	protected $m_biodata;
	protected $date;
	protected $session;

	public function __construct()
	{
		$this->m_kunjungan = new KunjunganModel();
		$this->m_biodata = new BiodataModel();
		$this->date = new DateFunction();
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/'));
		}
		$biodata	= $this->m_biodata->findAll();
		$data = ['title' => 'data biodata', 'active' => 'kunjungan', 'biodata' => $biodata,];
		return view('admin/kunjungan/index', $data);
	}
	public function getData()
	{
		$katakunci = $this->request->getPost('katakunci');
		$res       = $this->m_kunjungan->getKunjungan($katakunci);

		$output = [];
		foreach ($res as $key) {
			$tgl_kunjungan	= $this->date->panjang($key->created_dttm);
			//biodata pasien
			$biodata = "<div>
			<li class='h6'>
			<b style='margin-right:55px;'>Nama Pasien</b> <b>:</b> $key->gelar_depan $key->nama_lengkap. $key->gelar_belakang
			</li>
			<li class='h6'>
			<b style='margin-right:54px;'>Nama Dokter</b> <b>:</b> $key->nama_dokter
			</li>
			<li class='h6'>
			<b style='margin-right:36px;'>Catatan Kondisi</b> <b>:</b> $key->catatan_kondisi
			</li>
			<li class='h6'>
			<b style='margin-right:55px;'>Catatan Obat</b> <b>:</b> $key->catatan_obat
			</li>
			<li class='h6'>
			<b style='margin-right:13px;'>Tanggal Kunjungan</b> <b>:</b> $tgl_kunjungan
			</li>
			</div>";
			if ($key->status_kondisi == "Sembuh Pulang") {
				$status = "<button type='button' class='btn btn-block btn-outline-success'>Sembuh Pulang</button>";
			} elseif ($key->status_kondisi == "Sembuh Rujuk") {
				$status = "<button type='button' class='btn btn-block btn-outline-warning'>Belum Sembuh</button>";
			} else {
				$status = "<button type='button' class='btn btn-block btn-outline-danger'>Rujuk</button>";
			}
			$output[] = [
				'col1' => $biodata,
				'col2'  => $status,
			];
		}

		return $this->response->setJSON(['data' => $output]);
	}

	public function insert_data()
	{
		if ($this->request->isAJAX()) {
			$no_rm 					= $this->request->getVar('no_rm');
			$type_kunjungan			= $this->request->getVar('type_kunjungan');
			$nama_dokter			= strtoupper($this->request->getVar('nama_dokter'));
			$catatan_kondisi		= strtoupper($this->request->getVar('catatan_kondisi'));
			$catatan_obat			= strtoupper($this->request->getVar('catatan_obat'));
			$status_kondisi			= $this->request->getVar('status_kondisi');
			$keterangan				= $this->request->getVar('keterangan');
			$data = [
				'no_rm'					=> $no_rm,
				'type_kunjungan'		=> $type_kunjungan,
				'nama_dokter'			=> $nama_dokter,
				'catatan_kondisi'		=> $catatan_kondisi,
				'catatan_obat'			=> $catatan_obat,
				'status_kondisi'		=> $status_kondisi,
				'keterangan'			=> $keterangan,
				'created_user'			=> session()->get('id'),
				'created_dttm'			=> date('Y-m-d H:i:s'),
			];
			$insert	= $this->m_kunjungan->insertData($data);
			if ($insert !== false) {
				return $this->response->setJSON(['status' => true]);
			} else {
				return $this->response->setJSON([
					'status' => false,
					'error'  => 'Gagal insert data'
				]);
			}
		} else {
			exit('Request Error');
		}
	}
}
