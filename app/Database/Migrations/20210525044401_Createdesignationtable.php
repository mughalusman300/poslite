<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createdesignationtable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'desid'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'designation_name'   => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                        ],
                        'created_at' => [
                                    'type'      => 'timestamp',
      
                        ],
                
                ]);
                $this->forge->addKey('desid', true);
                $this->forge->createTable('saimtech_designations');
       

	}

	public function down()
	{
		$this->forge->dropTable('saimtech_designations');
	}
}
