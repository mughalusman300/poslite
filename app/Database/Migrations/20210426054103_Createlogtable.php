<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createlogtable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'log_id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'log_event' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 350,
                                
                        ],
                         'log_narration' => [
                                'type'           => 'Text',
                                
                        ],
                          'employee_id' => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'null'           => true,
                        ],
                        'created_by' => [
                                'type'           => 'INT',
                                'constraint'     => 11,   
                        ],
                        'created_at' => [
                                    'type'      => 'timestamp',
      
                        ],
                
                ]);
                $this->forge->addKey('log_id', true);
                $this->forge->createTable('saimtech_log');
	}

	public function down()
	{
		$this->forge->dropTable('saimtech_log');
	}
}
