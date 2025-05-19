<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KotaModel;


class Kota extends BaseController
{
	protected $m_kota;
	protected $session;

	public function __construct()
	{
		$this->m_kota = new KotaModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
			session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
			return redirect()->to(base_url('/'));
		}
		$data = ['title' => 'data kota', 'active' => 'kota'];
		return view('admin/kota/index', $data);
	}

	public function getData()
	{
		$res 	= $this->m_kota->getKota();
		$nomor	= 1;
		if (count($res) > 0) {
			foreach ($res as $data) {
				$output[] = array(
					'no'		=> $nomor++,
					'col1'		=> "$data->id_provinsi",
					'col2'		=> "$data->nama_kota",
				);
				$ret = array('data' => $output);
			}
		} else {
			$ret = array('data' => []);
		}
		return $this->response->setJSON($ret);
	}

	public function getByProv()
	{
		if ($this->request->isAJAX()) {
			$id_provinsi = $this->request->getPost('id_provinsi');
			$data = $this->m_kota->getByProvinsi($id_provinsi);
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Hanya bisa via AJAX');
		}
	}
}
