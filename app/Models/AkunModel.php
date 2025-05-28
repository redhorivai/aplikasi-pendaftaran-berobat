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
	public function updatePassword($id_user, $data)
	{
		return $this->db->table('users') // ganti nama tabel jika berbeda
			->where('id', $id_user)
			->update($data);
	}
}
