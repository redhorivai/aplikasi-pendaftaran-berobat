<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;


class Login extends BaseController
{
	protected $m_login;
	protected $session;
	public function __construct()
	{
		$this->m_login	= new LoginModel();
		$this->session	= \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		return view('admin/login');
	}

	public function get_login()
	{
		if ($this->request->isAJAX()) {
			$username		= $this->request->getVar('username');
			$password		= sha1(md5($this->request->getVar('password')));
			$cek_user		= $this->m_login->cek_user($username);
			if ($cek_user['status_user'] == 'deactive') {
				$msg = ['status' => "Login Gagal.. Akun Anda tidak aktif."];
			} else if ($cek_user['username'] != $username) {
				$msg = ['status' => "Login Gagal.. Username tidak ditemukan."];
			} else {
				$cek		= $this->m_login->login_check($username, $password);
				if ($cek['username'] == $username && $cek['password'] == $password) {
					session()->set('id', $cek['id']);
					session()->set('nama', $cek['nama']);
					session()->set('jenis_kelamin', $cek['jenis_kelamin']);
					session()->set('telepon', $cek['telepon']);
					session()->set('username', $cek['username']);
					session()->set('level', $cek['level']);
					session()->set('status_user', $cek['status_user']);
					session()->set('alamat', $cek['alamat']);
					$msg 	= ['sukses'	=> 'Selamat Datang ..' . session()->get('nama') . '',];
				} else
					$msg 	= ['gagal'	=> 'Login Gagal.. Username Atau Kata Sandi yang anda masukkan salah.'];
			}
			echo json_encode($msg);
		} else {
			exit('Request Error');
		}
	}

	public function logout()
	{
		session()->setTempdata('id');
		session()->setTempdata('nama');
		session()->setTempdata('jenis_kelamin');
		session()->setTempdata('telepon');
		session()->setTempdata('username');
		session()->setTempdata('level');
		session()->setTempdata('status_user');
		session()->setTempdata('alamat');
		session()->setFlashdata('sukses', 'anda berhasil keluar ...');
		return redirect()->to(base_url('/'));
	}
}
