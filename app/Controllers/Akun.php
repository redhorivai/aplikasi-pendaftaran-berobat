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
		// print_r(json_encode($data));
		return view('admin/akun/password', $data);
	}

	public function update_password()
	{
		if ($this->request->isAJAX()) {
			$password = $this->request->getVar('password');
			$id_user = session()->get('id'); // atau sesuai sistem Anda

			$data = [
				'password' => sha1(md5($password)),
				'updated_dttm' => date('Y-m-d H:i:s'),
				'updated_user' => session()->get('id'),
			];

			$res = $this->m_akun->updatePassword($id_user, $data);

			if ($res) {
				echo json_encode(['sukses' => true]);
			} else {
				echo json_encode(['gagal' => true]);
			}
		}
	}
}
