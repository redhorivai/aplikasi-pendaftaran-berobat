<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Informasi extends BaseController
{
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
		$data = ['title' => 'data informasi', 'active' => 'informasi'];
		return view('admin/informasi/index', $data);
	}
}
