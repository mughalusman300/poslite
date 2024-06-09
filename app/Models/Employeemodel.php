<?php

namespace App\Models;

use CodeIgniter\Model;

class Employeemodel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'saimtech_employees';
	protected $primaryKey           = 'emp_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['emp_card_id','fname', 'lname', 'father_name', 'cnic', 'email','official_email', 'contact_no', 'gender','marital_status', 'blood_group', 'dob', 'family_members', 'emergency_contact_no', 'emergency_contact_relation', 'image', 'city', 'province', 'address', 'designation_id', 'department_id', 'category', 'division_id', 'company_id', 'doj', 'reporting_area', 'reporting_region', 'machine_id', 'shift', 'rank', 'education_type', 'education', 'previous_comp', 'previous_comp_designation', 'experience', 'bank_name', 'account_title', 'account_no', 'account_iban', 'ntn', 'is_taxable', 'is_flag', 'falg_color', 'flag_reason', 'emp_dol','emp_leave_type','emp_l_reason','emp_status','is_enable','created_by'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function db(){
	  return $db      = \Config\Database::connect();  
	}

	public function getSearchData($match)
	{
	 	 $query  =$this->db->table('saimtech_employees')
             ->join('saimtech_designations', 'saimtech_employees.designation_id = saimtech_designations.desid', 'inner')
	         ->join('saimtech_departments', 'saimtech_employees.department_id = saimtech_departments.depid', 'inner')
	         ->like('fname',$match)
	         ->orLike('lname',$match)
	         ->orLike('email',$match)
             ->get()
             ->getResultArray();	
    return $query; 
  // $query1 ="SELECT emp_id, (fname,'',lname) as fullName, fname, lname, designation_name, department_name, emp_status from saimtech_employees where fullName like %".$match; 

	 // $res = $this->db->query($query1);
	 // return $res->getResultArray();
      
	}
	public function allEmployees()
	{
		$query  =$this->db->table('saimtech_employees')
	 ->join('saimtech_designations', 'saimtech_employees.designation_id = saimtech_designations.desid', 'inner')
	  ->join('saimtech_departments', 'saimtech_employees.department_id = saimtech_departments.depid', 'inner')
	         ->orderBy('saimtech_employees.emp_id', 'DESC')
             ->get()
             ->getResultArray();	
    return $query; 
	}
	public function detailByID($id)
	{
		$query  =$this->db->table('saimtech_employees')
	 ->join('saimtech_designations', 'saimtech_employees.designation_id = saimtech_designations.desid', 'inner')
	 ->join('saimtech_departments', 'saimtech_employees.department_id = saimtech_departments.depid', 'inner')
	         ->where('emp_id',$id)
             ->get()
             ->getResultArray();	
    return $query; 
	}
	public function getEmployees($department_id, $emp_status='active')
	{
		$query  =$this->db->table('saimtech_employees')
	 ->join('saimtech_designations', 'saimtech_employees.designation_id = saimtech_designations.desid', 'inner')
	  ->join('saimtech_departments', 'saimtech_employees.department_id = saimtech_departments.depid', 'inner')
	         ->orderBy('saimtech_employees.emp_id', 'DESC')
             ->getWhere(['department_id' => $department_id,'emp_status' => $emp_status])
             ->getResultArray();	
    return $query; 
	}
	public function getEmpCardID($category)
	{
		$query  ="SELECT MAX(emp_card_id) as card_id FROM saimtech_employees WHERE category =".$this->db->escape($category)."";
		$res    = $this->db->query($query);	
        return $res->getResultArray();
	}
}
