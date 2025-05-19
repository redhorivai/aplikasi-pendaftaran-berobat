<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
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
			'nama' 			 => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'jenis_kelamin'	 => [
				'type'       => 'ENUM',
				'constraint' => ['L', 'P'],
			],
			'telepon' 		 => [
				'type'       => 'CHAR',
				'constraint' => '20',
			],
			'email' 		 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'username' 		 => [
				'type'       => 'CHAR',
				'constraint' => '50',
			],
			'password' => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'level' => [
				'type'       => 'ENUM',
				'constraint' => ['user', 'admin'],
			],
			'status_user'	 => [
				'type'       => 'ENUM',
				'constraint' => ['active', 'deactive'],
				'default'	 => 'active',
			],
			'alamat' 		 => [
				'type' 		 => 'TEXT',
				'null' 		 => false,
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
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
