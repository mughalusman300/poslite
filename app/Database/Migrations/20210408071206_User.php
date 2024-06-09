<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'saimtech_comp_id'   => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'saimtech_uname' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                         'saimtech_password' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '350',
                                
                        ],
                          'saimtech_email' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => '350',
                                'unique'         => true,
                        ],
                        'saimtech_power' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                        'saimtech_super_power'   => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'null'           => true,
                        ],
                        'saimtech_created_by' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                
                        ],
                        'saimtech_date' => [
                                    'type'      => 'timestamp',
      
                        ],
                
                ]);
                $this->forge->addKey('id', true);
                $this->forge->createTable('saimtech_users');
       

	}

	public function down()
	{
		$this->forge->dropTable('saimtech_users');
	}
}
