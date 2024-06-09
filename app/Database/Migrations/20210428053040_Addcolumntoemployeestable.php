<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addcolumntoemployeestable extends Migration
{
	public function up()
	{
		$fields = [
        'emp_dol'           => [
        	          'type' => 'date', 
        	          'null'           => true,
        	          'after' => 'flag_reason',
        	      ],
        'emp_l_reason'      => [
                       'type'           => 'VARCHAR',
                       'constraint'     => 250,
                       'null'           => true,
                       'after' => 'emp_dol',
                       
                   ],
        'emp_status'        => [
        	           'type'           => 'VARCHAR',
                       'constraint'     => 50,
                       'default'        =>'active', 
                        'after' => 'emp_l_reason', 
        	           
        	       ],
        'is_enable'        => [
        	           'type' => 'INT',
        	           'null'           => true,
        	           'after' => 'emp_status', 
        	           
        	       ],
         ];
         $this->forge->addColumn('saimtech_employees', $fields);


	}

	public function down()
	{
		$this->forge->dropColumn('saimtech_employees', 'emp_dol,emp_l_reason,emp_status,is_enable');
	}
}
