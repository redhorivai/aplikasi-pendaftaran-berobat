<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Date\DateFunction;
use App\Models\BiodataModel;
use App\Models\KunjunganModel;


class Laporan extends BaseController
{
	protected $session;
	protected $date;
	protected $m_biodata;
	protected $m_kunjungan;

	public function __construct()
	{
		$this->m_biodata = new BiodataModel();
		$this->m_kunjungan = new KunjunganModel();
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
		$data = ['title' => 'data laporan', 'active' => 'laporan'];
		return view('admin/laporan/index', $data);
	}

	public function getData()
	{
		$res 	= $this->m_kunjungan->getDataPasien();
		$nomor	= 1;
		if (count($res) > 0) {
			foreach ($res as $data) {
				$tgl_kunjungan	= $this->date->panjang($data->created_dttm);
				$output[] = array(
					'col1'				=> $nomor++,
					'col2'				=> "$data->gelar_depan $data->nama_lengkap. $data->gelar_belakang",
					'col3'				=> "$data->no_rm",
					'col4'				=> "$data->nama_dokter",
					'col5'				=> "$data->catatan_kondisi",
					'col6'				=> "$data->catatan_obat",
					'col7'				=> "$data->status_kondisi",
					'col8'				=> "$tgl_kunjungan",
				);
				$ret = array('data' => $output);
			}
		} else {
			$ret = array('data' => []);
		}
		return $this->response->setJSON($ret);
	}

}
