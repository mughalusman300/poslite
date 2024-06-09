<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createdepartmenttable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'depid'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'department_name'   => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'created_at' => [
                                    'type'      => 'timestamp',
      
                        ],
                
                ]);
                $this->forge->addKey('depid', true);
                $this->forge->createTable('saimtech_departments');
       

	}

	public function down()
	{
		$this->forge->dropTable('saimtech_departments');
	}
}
