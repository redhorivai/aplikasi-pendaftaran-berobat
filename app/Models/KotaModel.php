<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaModel extends Model
{
	protected $table      = 'kota';
	protected $primaryKey = 'id_kota';
	protected $allowedFields = ['id_kota', 'id_provinsi', 'nama_kota', 'tipe', 'latlng', 'radius'];

	public function getKota()
	{
		$query = $this->db->table('kota');
		$query->select('*');
		$return = $query->get();
		return $return->getResult();
	}

	public function get_by_prov($idProv)
	{
		$query = $this->db->table('kota');
		$query->select('*');
		$query->where('id_provinsi', $idProv);
		$return = $query->get();
		return $return->getResult();
	}
	public function getByProvinsi($id_provinsi)
	{
		return $this->where('id_provinsi', $id_provinsi)->findAll();
	}
}
