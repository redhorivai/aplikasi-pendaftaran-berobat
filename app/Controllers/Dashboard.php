<?php

namespace App\Controllers;

use App\Controllers\BaseController;
class Dashboard extends BaseController
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
			session()->setFlashdata('error', '.');
			return redirect()->to(base_url('/'));
		}
		$data = ['title' => 'dashboard', 'active' => 'dashboard',];
		return view('admin/dashboard/index', $data);
	}
}
