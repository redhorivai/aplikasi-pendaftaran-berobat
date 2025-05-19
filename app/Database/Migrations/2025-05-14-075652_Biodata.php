<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Biodata extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 8,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'id_provinsi' 			 => [
				'type'       => 'CHAR',
				'constraint' => '10',
			],
			'id_kota' 			 => [
				'type'       => 'CHAR',
				'constraint' => '10',
			],
			'no_rm' 			 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'nik' 			 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'nama_lengkap'	 => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'gelar_depan'	 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'gelar_belakang'	 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'tgl_lahir' 	 => [
				'type'       => 'DATE',
				'null'		 => false,
			],
			'jenis_kelamin' 		 => [
				'type'       => 'ENUM',
				'constraint' => ['L', 'P'],
			],
			'telepon' 		 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'pekerjaan' 		 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'status' 		 => [
				'type'       => 'ENUM',
				'constraint' => ['menikah','belum_menikah','duda','janda'],
			],
			'alamat' 		 => [
				'type'       => 'TEXT',
				'null'		 => true
			],
			'keterangan' 	 => [
				'type'       => 'TEXT',
				'null'		 => true
			],
			'status_cd' 	 => [
				'type'       => 'ENUM',
				'constraint' => ['normal', 'nullified'],
				'default'	 => 'normal',
			],
			'created_user'	 => [
				'type'       => 'INT',
				'constraint' => 8,
				'null'		 => true,
			],
			'created_dttm' 	 => [
				'type'       => 'DATETIME',
				'null'		 => true,
			],
			'updated_user'	 => [
				'type'       => 'INT',
				'constraint' => 8,
				'null'		 => true,
			],
			'updated_dttm' 	 => [
				'type'       => 'DATETIME',
				'null'		 => true,
			],
			'nullified_user' => [
				'type'       => 'INT',
				'constraint' => 8,
				'null'		 => true,
			],
			'nullified_dttm'	 => [
				'type'       => 'DATETIME',
				'null'		 => true,
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('biodata');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('biodata');
	}
}
