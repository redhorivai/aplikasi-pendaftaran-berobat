<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kunjungan extends Migration
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
			'id_biodata' 	 => [
				'type'       => 'INT',
				'constraint' => 8,
			],
			'type_kunjungan' => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'nama_dokter'	 => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'catatan_kondisi'	 => [
				'type'       => 'TEXT',
				'null'		 => false
			],
			'catatan_obat'	 => [
				'type'       => 'TEXT',
				'null'		 => false
			],
			'status_kondisi'  => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'keterangan'	 => [
				'type'       => 'TEXT',
				'null'		 => false
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
		$this->forge->createTable('kunjungan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kunjungan');
	}
}
