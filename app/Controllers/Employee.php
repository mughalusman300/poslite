<?php

namespace App\Controllers;
use App\Models\Employeemodel;
use App\Models\Commonmodel;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Employee extends BaseController
{
 use ResponseTrait;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        date_default_timezone_set('Asia/Karachi');
        $this->Employeemodel = new Employeemodel();
        $this->Commonmodel = new Commonmodel();
         helper(['form', 'url']);
         $session = \Config\Services::session();
    }
	public function index()
	{
		 
		$data['employess'] = $this->Employeemodel->find();
		return view('employees/index',$data);
	}
	public function add()
	{
		return view('employees/create');
	}
	public function create()
	{	    
		$rules = [
			'newfile' =>['rules' => 'uploaded[newfile]|max_size[newfile,2048]|is_image[newfile]', 'label' => 'Image'],
			'fname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'First Name'],
			'lname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Last Name'],
			'father_name' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Father Name'],
			'cnic' => ['rules' => 'required|min_length[13]|max_length[13]|is_unique[saimtech_employees.cnic]', 'label' => 'CNIC'],
			'email' => 'required|valid_email|is_unique[saimtech_employees.email],',
			'official_email' => ['rules' => 'valid_email|permit_empty|is_unique[saimtech_employees.official_email]', 'label' => 'Officail Email'],
			'contact_no' => ['rules' => 'required|min_length[11]|max_length[11]', 'label' => 'Contact No'],
			'gender' => ['rules' => 'required', 'label' => 'Gender'],
			'marital_status' => ['rules' => 'required', 'label' => 'Marital Status'],
			'dob' => ['rules' => 'required', 'label' => 'DOB'],
			'family_members' => ['rules' => 'required', 'label' => 'Family Members'],
			'emergency_contact_no' => ['rules' => 'required', 'label' => 'Emergency Contact No'],
			'emergency_contact_relation' => ['rules' => 'required', 'label' => 'Emergency Contact Relation'],
			'city' => ['rules' => 'required', 'label' => 'City'],
			'province' => ['rules' => 'required', 'label' => 'Province'],
			'address' => ['rules' => 'required', 'label' => 'Address'],
			'designation_id' => ['rules' => 'required', 'label' => 'designation_id'],
			'department_id' => ['rules' => 'required', 'label' => 'department_id'],
			'category' => ['rules' => 'required', 'label' => 'category'],
			'division_id' => ['rules' => 'required', 'label' => 'division_id'],
			'company_id' => ['rules' => 'required', 'label' => 'company_id'],
			'doj' => ['rules' => 'required', 'label' => 'doj'],
			'reporting_area' => ['rules' => 'required', 'label' => 'reporting_area'],
			'reporting_region' => ['rules' => 'required', 'label' => 'reporting_region'],
			'machine_id' => 'is_unique[saimtech_employees.machine_id,machine_id]|permit_empty',
			'account_no' => 'is_unique[saimtech_employees.account_no,account_no]|permit_empty',
			'account_iban' => 'is_unique[saimtech_employees.account_iban,account_iban]|permit_empty',
			'ntn' => 'is_unique[saimtech_employees.ntn]|permit_empty',
			'shift' => ['rules' => 'required', 'label' => 'shift'],
			'education_type' => ['rules' => 'required', 'label' => 'education_type'],
			'education' => ['rules' => 'required', 'label' => 'education'],		
		];

		 if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
			 return $this->fail($errors);
		}
		else{
		$img = $this->request->getFile('newfile');
		    if($img!=""){
		         $extension = $img->getClientExtension();
		         $newName = $img->getRandomName();
		         $path = "public/img/";
		         $full_db_path = $path."".$newName;
		         $img->move($path, $newName);
	        }	
	        $emp_card_id = null;
			$category =  $this->request->getVar('category');
	        $result = $this->Employeemodel->getEmpCardID($category);
	        $restult_card_id = $result[0]['card_id'];
	        if($restult_card_id!=""){
	        	$emp_card_id = $restult_card_id + 1;
	        }
	        else{ 
	        	if($category=="Permanant"){ $emp_card_id= 1001; }
		        elseif($category=="Contract"){ $emp_card_id= 7001; }
		        elseif($category=="Franchisee"){ $emp_card_id= 8001; }
		        else{ $emp_card_id= null; }
	        }
        $data = [
        	'emp_card_id' => $emp_card_id,
        	'fname'    => $this->request->getVar('fname'),
		    'lname' => $this->request->getVar('lname'),
		    'father_name'    => $this->request->getVar('father_name'),
		    'cnic'    => $this->request->getVar('cnic'),
		    'email'    => $this->request->getVar('email'),
		    'official_email'    => $this->request->getVar('official_email'),
		    'contact_no'    => $this->request->getVar('contact_no'),
		    'gender'    => $this->request->getVar('gender'),
		    'marital_status'    => $this->request->getVar('marital_status'),
		    'blood_group'    => $this->request->getVar('blood_group'),
		    'dob'    => $this->request->getVar('dob'),
		    'family_members'    => $this->request->getVar('family_members'),
		    'emergency_contact_no'    => $this->request->getVar('emergency_contact_no'),
		    'emergency_contact_relation'    => $this->request->getVar('emergency_contact_relation'),
		    'image' => $full_db_path,
		    'city'    => $this->request->getVar('city'),
		    'province'    => $this->request->getVar('province'),
		    'address'    => $this->request->getVar('address'),
		    'designation_id'    => $this->request->getVar('designation_id'),
		    'designation_id'    => $this->request->getVar('designation_id'),
		    'department_id'    => $this->request->getVar('department_id'),
		    'category'    => $this->request->getVar('category'),
		    'division_id'    => $this->request->getVar('division_id'),
		    'company_id'    => $this->request->getVar('company_id'),
		    'doj'    => $this->request->getVar('doj'),
		    'reporting_area'    => $this->request->getVar('reporting_area'),
		    'reporting_region'    => $this->request->getVar('reporting_region'),
		    'machine_id'    => $this->request->getVar('machine_id'),
		    'shift'    => $this->request->getVar('shift'),
		    'rank'    => $this->request->getVar('rank'),
		    'education_type'    => $this->request->getVar('education_type'),
		    'education'    => $this->request->getVar('education'),
		    'previous_comp'    => $this->request->getVar('previous_comp'),
		    'previous_comp_designation'    => $this->request->getVar('previous_comp_designation'),
		    'experience'    => $this->request->getVar('experience'),
		    'bank_name'    => $this->request->getVar('bank_name'),
		    'account_title'    => $this->request->getVar('account_title'),
		    'account_no'    => $this->request->getVar('account_no'),
		    'account_iban'    => $this->request->getVar('account_iban'),
		    'ntn'    => $this->request->getVar('ntn'),
		    'is_taxable'    => $this->request->getVar('is_taxable')    
		];
		$emp_id  = $this->Employeemodel->insert($data);
		$leave_types = $this->Commonmodel->Get_all_record('leave_types');
		}
		// $onepath ='';
		//     if($this->request->getVar('imgValue')=='Yes'){
        //       $onefile        = $_FILES['onefile']["name"];
        //     $temp_name = $onefile->getRandomName();
		//     if($onefile!=""){
		//      $onepath = "public/img/";
		//      $onepath = $onepath ."".basename($_FILES["onefile"]["name"]);
		//      if(move_uploaded_file($_FILES["onefile"]["tmp_name"], $onepath)) {
		//       // echo "The file ". basename( $_FILES["onefile"]["name"]). " has been uploaded.";
		//      }
		//     }
		//     }

	}
	public function addEmployee()
	{
		return view('employees/createsimple');
	}
	public function createEmployee()
	{
		
		    
		$rules = [
			'fname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'First Name'],
			'lname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Last Name'],
			'father_name' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Father Name'],
			'cnic' => ['rules' => 'required|min_length[13]|max_length[13]|is_unique[saimtech_employees.cnic]', 'label' => 'CNIC'],
			'email' => 'required|valid_email|is_unique[saimtech_employees.email],',
			'contact_no' => ['rules' => 'required|min_length[11]|max_length[11]', 'label' => 'Contact No'],
			'gender' => ['rules' => 'required', 'label' => 'Gender'],
            'designation_id' => ['rules' => 'required', 'label' => 'designation_id'],
			'department_id' => ['rules' => 'required', 'label' => 'department_id'],
			'category' => ['rules' => 'required', 'label' => 'Category'],
			'city' => ['rules' => 'required', 'label' => 'City'],
			'address' => ['rules' => 'required', 'label' => 'Address'],
		];

		 if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
			 return $this->fail($errors);
		}	
		else{
			$emp_card_id = null;
			$category =  $this->request->getVar('category');
	        $result = $this->Employeemodel->getEmpCardID($category);
	        $restult_card_id = $result[0]['card_id'];
	        if($restult_card_id!=""){
	        	$emp_card_id = $restult_card_id + 1;
	        }
	        else{ 
	        	if($category=="Permanant"){ $emp_card_id= 1001; }
		        elseif($category=="Contract"){ $emp_card_id= 7001; }
		        elseif($category=="Franchisee"){ $emp_card_id= 8001; }
		        else{ $emp_card_id= null; }
	        }
	        	
        $data = [
        	'emp_card_id' => $emp_card_id,
        	'fname'    => $this->request->getVar('fname'),
		    'lname' => $this->request->getVar('lname'),
		    'father_name'    => $this->request->getVar('father_name'),
		    'cnic'    => $this->request->getVar('cnic'),
		    'email'    => $this->request->getVar('email'),
		    'contact_no'    => $this->request->getVar('contact_no'),
		    'gender'    => $this->request->getVar('gender'),
		    'designation_id'    => $this->request->getVar('designation_id'),
		    'department_id'    => $this->request->getVar('department_id'),
		    'category'    => $this->request->getVar('category'),
		    'city'    => $this->request->getVar('city'),
		    'address'    => $this->request->getVar('address'), 
		];
		$this->Employeemodel->insert($data);
		}
	}
	public function detail($id)
	{
		 
		 //$data['rows'] = $this->Employeemodel->find($id);
		 $data1['rows'] = $this->Employeemodel->detailByID($id);
         $data1['rows']=$data1['rows'][0];
		 return view('employees/detail',$data1);
	}
	public function updateview($id)
	{
		$data['id'] = $id;
		return view('employees/edit',$data);
	}
	public function getEmployee($id)
	{
      $employees = $this->Employeemodel->find($id);
		return $this->response->setJSON($employees);
	}
	public function updateEmployee()
	{

		$emp_id = $this->request->getVar('emp_id');
		$ntn = $this->request->getVar('ntn');
		$rules = [
			'fname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'First Name'],
			'lname' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Last Name'],
			'father_name' => ['rules' => 'required|min_length[3]|max_length[20]', 'label' => 'Father Name'],
			'cnic' => ['rules' => 'required|min_length[13]|max_length[13]|is_unique[saimtech_employees.cnic,emp_id,{emp_id}]', 'label' => 'CNIC'],
			'email' => 'required|valid_email|is_unique[saimtech_employees.email,emp_id,{emp_id}],',
			'official_email' => ['rules' => 'permit_empty|permit_empty|is_unique[saimtech_employees.official_email,emp_id,{emp_id}]', 'label' => 'Officail Email'],
			'contact_no' => ['rules' => 'required|min_length[11]|max_length[11]', 'label' => 'Contact No'],
			'gender' => ['rules' => 'required', 'label' => 'Gender'],
			'marital_status' => ['rules' => 'required', 'label' => 'Marital Status'],
			'dob' => ['rules' => 'required', 'label' => 'DOB'],
			'family_members' => ['rules' => 'required', 'label' => 'Family Members'],
			'emergency_contact_no' => ['rules' => 'required', 'label' => 'Emergency Contact No'],
			'emergency_contact_relation' => ['rules' => 'required', 'label' => 'Emergency Contact Relation'],
			'city' => ['rules' => 'required', 'label' => 'City'],
			'province' => ['rules' => 'required', 'label' => 'Province'],
			'address' => ['rules' => 'required', 'label' => 'Address'],
			'designation_id' => ['rules' => 'required', 'label' => 'designation_id'],
			'department_id' => ['rules' => 'required', 'label' => 'department_id'],
			'category' => ['rules' => 'required', 'label' => 'category'],
			'division_id' => ['rules' => 'required', 'label' => 'division_id'],
			'company_id' => ['rules' => 'required', 'label' => 'company_id'],
			'doj' => ['rules' => 'required', 'label' => 'doj'],
			'reporting_area' => ['rules' => 'required', 'label' => 'reporting_area'],
			'reporting_region' => ['rules' => 'required', 'label' => 'reporting_region'],

			'machine_id' => 'is_unique[saimtech_employees.machine_id,emp_id,{emp_id}]|permit_empty',
			'account_no' => 'is_unique[saimtech_employees.account_no,emp_id,{emp_id}]|permit_empty',
			'account_iban' => 'is_unique[saimtech_employees.account_iban,emp_id,{emp_id}]|permit_empty',
			'ntn' => 'is_unique[saimtech_employees.ntn,emp_id,{emp_id}]|permit_empty',
			'shift' => ['rules' => 'required', 'label' => 'shift'],
			'education_type' => ['rules' => 'required', 'label' => 'education_type'],
			'education' => ['rules' => 'required', 'label' => 'education'],		
		];

		 if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
			return $this->fail($errors);
		}
		else{
        	$emp_id = $this->request->getVar('emp_id');
		;
        $data = [
        	'fname'    => $this->request->getVar('fname'),
		    'lname' => $this->request->getVar('lname'),
		    'father_name'    => $this->request->getVar('father_name'),
		    'cnic'    => $this->request->getVar('cnic'),
		    'email'    => $this->request->getVar('email'),
		    'official_email'    => $this->request->getVar('official_email'),
		    'contact_no'    => $this->request->getVar('contact_no'),
		    'gender'    => $this->request->getVar('gender'),
		    'marital_status'    => $this->request->getVar('marital_status'),
		    'blood_group'    => $this->request->getVar('blood_group'),
		    'dob'    => $this->request->getVar('dob'),
		    'family_members'    => $this->request->getVar('family_members'),
		    'emergency_contact_no'    => $this->request->getVar('emergency_contact_no'),
		    'emergency_contact_relation'    => $this->request->getVar('emergency_contact_relation'),
		    'city'    => $this->request->getVar('city'),
		    'province'    => $this->request->getVar('province'),
		    'address'    => $this->request->getVar('address'),
		    'designation_id'    => $this->request->getVar('designation_id'),
		    'department_id'    => $this->request->getVar('department_id'),
		    'category'    => $this->request->getVar('category'),
		    'division_id'    => $this->request->getVar('division_id'),
		    'company_id'    => $this->request->getVar('company_id'),
		    'doj'    => $this->request->getVar('doj'),
		    'reporting_area'    => $this->request->getVar('reporting_area'),
		    'reporting_region'    => $this->request->getVar('reporting_region'),
		    'machine_id'    => $this->request->getVar('machine_id'),
		    'shift'    => $this->request->getVar('shift'),
		    'rank'    => $this->request->getVar('rank'),
		    'education_type'    => $this->request->getVar('education_type'),
		    'education'    => $this->request->getVar('education'),
		    'previous_comp'    => $this->request->getVar('previous_comp'),
		    'previous_comp_designation'    => $this->request->getVar('previous_comp_designation'),
		    'experience'    => $this->request->getVar('experience'),
		    'bank_name'    => $this->request->getVar('bank_name'),
		    'account_title'    => $this->request->getVar('account_title'),
		    'account_no'    => $this->request->getVar('account_no'),
		    'account_iban'    => $this->request->getVar('account_iban'),
		    'ntn'    => $this->request->getVar('ntn'),
		    'is_taxable'    => $this->request->getVar('is_taxable')    
		];
		 $result = $this->Commonmodel->Update_record('saimtech_employees','emp_id',$emp_id, $data);
		}
	}
	public function updateEmployeeStatus($id)
	{
      $user_id = $_SESSION['user_id'];
		$rules = [
			'emp_dol' => ['rules' => 'required', 'label' => 'Date of Leaving'],
			'emp_leave_type' => ['rules' => 'required', 'label' => 'Leave Type'],
			'emp_l_reason' => ['rules' => 'required', 'label' => 'Leaving Reason'],		
		];

		 if (!$this->validate($rules)) {
             $errors = $this->validator->getErrors();
			return $this->fail($errors);
		}
		else{
        	$emp_dol = $this->request->getVar('emp_dol');
		;
        $data = [
        	'emp_dol'    => $this->request->getVar('emp_dol'),
        	'emp_leave_type'    => $this->request->getVar('emp_leave_type'),
		    'emp_l_reason' => $this->request->getVar('emp_l_reason'),   
		    'emp_status' =>'deactive',   
		];
		 $affectedRows = $this->Commonmodel->Update_record('saimtech_employees','emp_id',$id, $data);
		}
        ///LOG Start//////////
		if($affectedRows== 1){
        $date    = date('h:i:sa d-m-y');
        $user_id    = $_SESSION['user_id'];
		$user_name  = $_SESSION['user_name'];

        $log_event   = 'Employee Marked As Deactive';
        $log_narration  = 'Emoloyee of id:'.$id.' has been Deactivated by: '.$user_name.' of User ID:'.$user_id.' at '.$date ;
        $data = [
              'log_event'     => $log_event,
              'log_narration' => $log_narration,
              'employee_id'   => $id,
              'created_by'    => $user_id,
        ];	
        $this->Commonmodel->Insert_record('saimtech_log',$data);
		}///LOG End//////////

	}
	public function getAllEmployees()
	{
		$employees = $this->Employeemodel->allEmployees();
		return $this->response->setJSON($employees);
	}
	public function search()
	{
		$searchkeyword = $this->request->getVar('s');
		$search = $this->Employeemodel->getSearchData($searchkeyword);
		return $this->response->setJSON($search);
	}
}
