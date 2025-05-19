<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
	protected $table      = 'users';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'nama', 'jenis_kelamin', 'telepon', 'email', 'username', 'password', 'level', 'status_user', 'alamat', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getPengguna()
	{
		$query = $this->db->table('users');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$query->orderBy('id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function updateData($id, $data)
	{
		$cek = $this->cekUsername($data['username']);
		if (count($cek) > 1) {
			$ret = false;
		} else {
			$query = $this->db->table('users');
			$query->where('id', $id);
			$query->set($data);
			$ret = $query->update();
		}
		return $ret;
	}

	public function deleteSoft($id, $data)
	{
		$query = $this->db->table('users');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}

	public function cekUsername($username)
	{
		$query = $this->db->table('users');
		$query->select('*');
		$query->where('username', $username);
		$query->where('status_cd', 'normal');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekUsername($data['username']);
		if (count($cek) > 0) {
			$ret =  false;
		} else {
			$query = $this->db->table('users');
			$ret =  $query->insert($data);
		}
		return $ret;
	}

	public function get_id($id)
	{
		$query = $this->db->table('users');
		$query->select('*');
		$query->where('id', $id);
		$query->where('status_cd', 'normal');
		return $query->get();
	}
}
