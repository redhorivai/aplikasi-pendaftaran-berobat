<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
	protected $table      = 'users';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'nama', 'jenis_kelamin', 'telepon', 'email', 'username', 'password', 'level', 'status_user', 'alamat', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getIdAkun($id)
	{
		$query = $this->db->table('users');
		$query->select('*');
		$query->where('id', $id);
		$query->where('status_cd', 'normal');
		$return = $query->get();
		return $return->getResult();
	}
	public function getAkun()
	{
		$query = $this->db->table('users');
		$query->select('*');
		$query->where('status_cd', 'normal');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($id,$data) {
		$query = $this->db->table('users');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
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
