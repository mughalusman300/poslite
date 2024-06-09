<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createdocumenttable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'doc_id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'doc_name' => [
                               'type'           => 'VARCHAR',
                                'constraint'     => 350,
                                
                        ],
                         'doc_type' => [
                               'type'           => 'VARCHAR',
                                'constraint'     => 150,
                                
                        ],
                         'doc_description' => [
                               'type'           => 'text',
                                
                        ],
                        'doc_path' => [
                               'type'           => 'text',
                                
                        ],
                        'emp_id' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                
                        ],
                        'created_by' => [
                                'type'           => 'INT',
                                'constraint'     => 11,   
                        ],
                        'created_at' => [
                                    'type'      => 'timestamp',
                                    'ON UPDATE CURRENT_TIMESTAMP' => false,
      
                        ],
                
                ]);
                $this->forge->addKey('doc_id', true);
                $this->forge->createTable('saimtech_document');
	}

	public function down()
	{
		$this->forge->dropTable('saimtech_document');
	}
}
