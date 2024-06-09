<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
                        'emp_id'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'auto_increment' => true,
                        ],
                        'fname' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                        'lname' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,
                                
                        ],
                        'father_name' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,     
                        ],
                        'cnic'   => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,  
                        ],
                        'email' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 50,     
                        ],
                        'contact_no' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 15,     
                        ],
                        'gender' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 10,     
                        ],
                        'marital_status' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 10,     
                        ],
                        'blood_group' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 10,     
                                'null'           => true,
                        ],
                        'dob' => [
                                'type'           => 'date',  
                        ],
                        'family_members' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,     
                        ],
                        'emergency_contact_no' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 15,     
                        ],
                        'emergency_contact_relation' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 15,     
                        ],
                        'image' => [
                                'type'           => 'text', 
                                'null'           => true,
                        ],
                        'city' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,     
                        ],
                        'province' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,     
                        ],
                        'address' => [
                                'type'           => 'text',    
                        ],
                        'designation_id' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,     
                        ],
                        'department_id' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,     
                        ],
                        'category' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,    
                        ],
                        'division_id' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,    
                        ],
                         'company_id' => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,      
                        ],
                        'doj' => [
                                'type'           => 'date',
                        ],
                        'reporting_area'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,  
                        ],
                        'reporting_region'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                        ],
                        'machine_id'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                                'null'           => true,
                        ],
                        'shift'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                        ],
                        'rank'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                        ],
                        'education_type'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                        ],
                        'education'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                        ],
                        'previous_comp'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                                'null'           => true,
                        ],
                        'previous_comp_designation'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                                'null'           => true,
                        ],
                        'experience'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,  
                                'null'           => true,
                        ],
                         'bank_name'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                                'null'           => true,
                        ],
                         'account_title'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 30,
                                'null'           => true,
                        ],
                         'account_no'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                                'null'           => true,
                        ],
                        'account_iban'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                                'null'           => true,
                        ],
                        'ntn'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                                'null'           => true,
                        ],
                        'is_taxable'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                        ],
                        'is_flag'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'null'           => true,

                        ],
                        'falg_color'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 20,
                                'null'           => true,
                        ],
                        'flag_reason'          => [
                                'type'           => 'VARCHAR',
                                'constraint'     => 100,
                                'null'           => true,
                        ],
                        'created_by'          => [
                                'type'           => 'INT',
                                'constraint'     => 11,
                                'null'           => true,
                        ],
                        'created_at'          => [
                                'type'           => 'timestamp',
                        ],
                        'updated_at'          => [
                                'type'           => 'datetime',                                
                        ],

      
                ]);
                $this->forge->addKey('emp_id', true);
                $this->forge->createTable('saimtech_employees');
	}

	public function down()
	{
		$this->forge->dropTable('saimtech_employees');
	}
}
