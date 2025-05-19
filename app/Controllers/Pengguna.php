<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;


class Pengguna extends BaseController
{
	protected $m_pengguna;
	protected $session;

	public function __construct()
	{
		$this->m_pengguna = new PenggunaModel();
		$this->session = \Config\Services::session();
		$this->session->start();
	}
	public function index()
	{
		if (session()->get('username') == '') {
            session()->setFlashdata('error', 'Anda belum login! Silahkan login terlebih dahulu');
            return redirect()->to(base_url('/'));
        }
		$data = ['title' => 'data pengguna', 'active' => 'pengguna'];
		return view('admin/pengguna/index', $data);
	}

	public function getData()
	{
		$res 	= $this->m_pengguna->getPengguna();
		$nomor	= 1;
		if (count($res) > 0) {
			foreach ($res as $data) {
				if ($data->status_user == "active") {
					$user_status =	"<i style='color:#28a745;'>status: aktif</i>";
				} else {
					$user_status =	"<i style='color:#dc3545;'>status: tidak aktif</i>";
				}
				$output[] = array(
					'no'				=> $nomor++,
					'name'				=> "$data->nama ($user_status)",
					'user'				=> "$data->username",
					'level'				=> "$data->level",
					'status_user'		=> "$data->status_user",
					'action'	=> "<span><a onclick='_btnEdit(\"$data->id\",\"$data->username\",\"$data->nama\")'><button type='button' class='btn bg-gradient-info'><i class='nav-icon fas fa-pen'></i> Ubah</button></a></span><span><a  onclick='_btnDelete(\"$data->id\",\"$data->username\",\"$data->nama\")'><button type='button' class='btn bg-gradient-danger'><i class='nav-icon fas fa-trash'></i> Hapus</button></a></span>",
				);
				$ret = array('data' => $output);
			}
		} else {
			$ret = array('data' => []);
		}
		return $this->response->setJSON($ret);
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
			$this->m_pengguna->deleteSoft($id, $data);
			$msg = ['sukses' => 'Data user telah dihapus.'];
			echo json_encode($msg);
		} else {
			exit('Request Error');
		}
	}

	public function insert_data()
	{
		if ($this->request->isAJAX()) {
			$nama					= strtoupper($this->request->getVar('nama'));
			$jenis_kelamin			= $this->request->getVar('jenis_kelamin');
			$telepon				= $this->request->getVar('telepon');
			$email					= $this->request->getVar('email');
			$username				= strtolower($this->request->getVar('username'));
			$level					= $this->request->getVar('level');
			$alamat					= $this->request->getVar('alamat');
			$data = [
				'nama'					=> $nama,
				'jenis_kelamin'			=> $jenis_kelamin,
				'telepon'				=> $telepon,
				'email'					=> $email,
				'username'				=> $username,
				'level'					=> $level,
				'alamat'				=> $alamat,
				'password'				=> sha1(md5('123456')),
				'created_user'			=> session()->get('id'),
				'created_dttm'			=> date('Y-m-d H:i:s'),
			];
			$insert	= $this->m_pengguna->insertData($data);
			if ($insert == TRUE) {
				echo json_encode(['status'	=> TRUE]);
			} else {
				echo json_encode(['username'	=> "Username: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain."]);
			}
		} else {
			exit('Request Error');
		}
	}

	public function get_edit()
	{
		if ($this->request->isAJAX()) {
			$id		= $this->request->getVar('id');
			$data	= $this->m_pengguna->get_id($id)->getRowArray();
			// print_r(json_encode($data));
			echo json_encode($data);
		} else {
			exit('Request Error');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$id						= $this->request->getVar('id');
			$nama					= strtoupper($this->request->getVar('nama'));
			$jenis_kelamin			= $this->request->getVar('jenis_kelamin');
			$telepon				= $this->request->getVar('telepon');
			$email					= $this->request->getVar('email');
			$username				= strtolower($this->request->getVar('username'));
			$level					= $this->request->getVar('level');
			$status_user			= $this->request->getVar('status_user');
			$alamat					= $this->request->getVar('alamat');
			$data = [
				'nama'					=> $nama,
				'jenis_kelamin'			=> $jenis_kelamin,
				'telepon'				=> $telepon,
				'email'					=> $email,
				'username'				=> $username,
				'level'					=> $level,
				'status_user'			=> $status_user,
				'alamat'				=> $alamat,
				'updated_user'			=> session()->get('id'),
				'updated_dttm'			=> date('Y-m-d H:i:s'),
			];
			$insert	= $this->m_pengguna->updateData($id,$data);
			if ($insert == TRUE) {
				echo json_encode(['status'	=> TRUE]);
			} else {
				echo json_encode(['username'	=> "Username: <b class='text-danger'>$username</b> sudah ada, silahkan coba yang lain."]);
			}
		} else {
			exit('Request Error');
		}
	}
}
