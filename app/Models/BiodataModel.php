<?php

namespace App\Models;

use CodeIgniter\Model;

class BiodataModel extends Model
{
	protected $table      = 'biodata';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'id_provinsi', 'id_kota', 'no_rm', 'nik', 'nama_lengkap', 'gelar_depan', 'gelar_belakang', 'tgl_lahir', 'jenis_kelamin', 'telepon', 'pekerjaan', 'status', 'alamat', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];
	protected $returnType = 'object';

	public function cari($katakunci)
	{
		$query = $this->db->table('biodata a');
		$query->select('a.id,a.id_provinsi,a.id_kota,a.no_rm,a.nik,a.nama_lengkap,a.gelar_depan,a.gelar_belakang,a.tgl_lahir,a.jenis_kelamin,a.telepon,a.pekerjaan,a.status,a.alamat,a.keterangan,a.created_user,
		b.kodeprovinsi,b.nama_provinsi,
		c.nama_kota
		');
		$query->join('provinsi b', 'b.id_provinsi=a.id_provinsi');
		$query->join('kota c', 'c.id_kota=a.id_kota');
		$query->where('a.no_rm', $katakunci);
		$query->where('a.status_cd', 'normal');
		$return = $query->get();
		return $return->getResult();
	}
	// ✅ Tetap dipakai di controller
	public function cekNik($nik, $excludeId = null)
	{
		$builder = $this->db->table($this->table)->where('nik', $nik);
		if ($excludeId !== null) {
			$builder->where('id !=', $excludeId);
		}
		return $builder->get()->getResult();
	}

	// 🧹 Sudah disederhanakan (tanpa cek NIK duplikat)
	public function updateData($id, $data)
	{
		return $this->db->table($this->table)->where('id', $id)->update($data);
	}

	public function deleteSoft($id, $data)
	{
		$query = $this->db->table('biodata');
		$query->where('id', $id);
		$query->set($data);
		return $query->update();
	}

	public function generateNoRm()
	{
		$row = $this->select('MAX(no_rm) AS max_rm')
			->get()
			->getRow();
		$next = $row && $row->max_rm
			? ((int)$row->max_rm + 1)
			: 1;
		return str_pad($next, 6, '0', STR_PAD_LEFT);
	}

	public function cekNikPasien($nik)
	{
		$query = $this->db->table('biodata');
		$query->select('*');
		$query->where('nik', $nik);
		$query->where('status_cd', 'normal');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$cek = $this->cekNikPasien($data['nik']);
		if (count($cek) > 0) {
			$ret =  false;
		} else {
			$query = $this->db->table('biodata');
			$ret =  $query->insert($data);
		}
		return $ret;
	}
}
