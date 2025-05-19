<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
	protected $table      = 'provinsi';
	protected $primaryKey = 'id_provinsi';
	protected $allowedFields = ['id_provinsi', 'kodeprovinsi', 'nama_provinsi', 'tipe', 'latlng', 'radius'];

	public function getProvinsi()
	{
		$query = $this->db->table('provinsi');
		$query->select('*');
		$return = $query->get();
		return $return->getResult();
	}
}
