<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;


class Akun extends BaseController
{
	protected $m_akun;
	protected $session;

	public function __construct()
	{
		$this->m_akun = new AkunModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}

	public function password()
	{
		$id			= session()->get('id');
		$akun		= $this->m_akun->getIdAkun($id);
		$data = ['title' => 'data password', 'active' => 'password', 'akun' => $akun];
		return view('admin/akun/password', $data);
	}

	public function update_password()
	{
		if ($this->request->isAJAX()) {
			$id				 = $this->request->getPost('id');
			$password 		 = $this->request->getPost('password');
			$data = [
				'password'			=> sha1(md5($password)),
				'updated_user'		=> session()->get('id'),
				'updated_dttm'		=> date('Y-m-d H:i:s'),
			];
			$insert = $this->m_akun->insertData($id, $data);
			if ($insert == TRUE) {
				echo json_encode(['status'	=> TRUE]);
			}
		} else {
			exit('Request Error');
		}
	}
}
