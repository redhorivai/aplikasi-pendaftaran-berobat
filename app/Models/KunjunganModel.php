<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
	protected $table      = 'kunjungan';
	protected $primaryKey = 'id';
	protected $allowedFields = ['id', 'no_rm', 'type_kunjungan', 'nama_dokter', 'catatan_kondisi', 'catatan_obat', 'status_kondisi', 'keterangan', 'status_cd', 'created_user', 'created_dttm', 'updated_user', 'updated_dttm', 'nullified_user', 'nullified_dttm'];

	public function getKunjungan($katakunci){
		$query = $this->db->table('kunjungan a');
		$query->select('a.no_rm, a.type_kunjungan, a.nama_dokter, a.catatan_kondisi, a.catatan_obat, a.status_kondisi, a.keterangan, a.status_cd, a.created_dttm,
		b.nik, b.nama_lengkap, b.gelar_depan, b.gelar_belakang, b.tgl_lahir, b.jenis_kelamin,
		');
		$query->join('biodata b', 'b.no_rm = a.no_rm', 'left');
		$query->where('a.no_rm', $katakunci);
		$query->where('a.status_cd', 'normal');
		$query->orderBy('a.id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}

	public function insertData($data)
	{
		$query = $this->db->table('kunjungan');
		$ret =  $query->insert($data);
		return $ret;
	}

	public function getDataPasien()
	{
		$query = $this->db->table('kunjungan a');
		$query->select('a.no_rm, a.type_kunjungan, a.nama_dokter, a.catatan_kondisi, a.catatan_obat, a.status_kondisi, a.keterangan, a.status_cd, a.created_dttm,
		b.nik, b.nama_lengkap, b.gelar_depan, b.gelar_belakang, b.tgl_lahir, b.jenis_kelamin,
		');
		$query->join('biodata b', 'b.no_rm = a.no_rm', 'left');
		$query->where('a.status_cd', 'normal');
		$query->orderBy('a.id', 'DESC');
		$return = $query->get();
		return $return->getResult();
	}
}
