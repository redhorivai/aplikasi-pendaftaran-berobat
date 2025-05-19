<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProvinsiModel;


class Provinsi extends BaseController
{
	protected $m_provinsi;
	protected $session;

	public function __construct()
	{
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
		$data = ['title' => 'data provinsi', 'active' => 'provinsi'];
		return view('admin/provinsi/index', $data);
	}

	public function getData()
	{
		$res 	= $this->m_provinsi->getProvinsi();
		$nomor	= 1;
		if (count($res) > 0) {
			foreach ($res as $data) {
				$output[] = array(
					'no'		=> $nomor++,
					'col1'		=> "$data->kodeprovinsi",
					'col2'		=> "$data->nama_provinsi",
				);
				$ret = array('data' => $output);
			}
		} else {
			$ret = array('data' => []);
		}
		return $this->response->setJSON($ret);
	}
}
