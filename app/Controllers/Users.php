<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Usermodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Users extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Usermodel = new Usermodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Users List';
        $data['users_active'] ="active";

        // $items = $this->Commonmodel->getAllRecords('saimtech_users');
        // $data['items'] = $items;
        $data['main_content'] = 'users/users';
        return view('layouts/page',$data);
    }

    public function UsersList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Usermodel->all_users_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $users = $this->Usermodel->all_users($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $users =  $this->Usermodel->users_search($limit,$start,$search);
            $totalFiltered = $this->Usermodel->users_search_count($search);

        }
        // echo '<pre>'; print_r($users); die;
        $data = array();
        if (!empty($users)) {

            $i = 1;
            foreach ($users as $row) {
                $action = 'N/A';
                if (in_array('alter_system_administration', $_SESSION['permissions'])) {
                    $action = '<button class="btn btn-outline-theme edit-user"
                        data-id="'.$row->id.'"
                        data-name="'.$row->name.'"
                        data-email="'.$row->email.'"
                        data-power="'.$row->power.'"
                        data-permissions="'.$row->permissions.'"
                        >Edit</button>
                    ';
                }

                $nestedData['sr'] = $i;
                $nestedData['name'] = $row->name;
                $nestedData['email'] = $row->email;
                $nestedData['power'] = $row->power;

                $status = ($row->is_enable) ? 'Active' : 'Deactive';
                $checked = ($row->is_enable) ? 'checked' : '';
                $disabled = (in_array('alter_system_administration', $_SESSION['permissions'])) ? '' : 'disabled';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" '.$disabled.' data-id="'.$row->id.'" class="form-check-input" id="is_enable" '. $checked .'>
                            <label class="form-check-label" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['status'] = $status;
                $nestedData['Action'] = $action;

                $data[] = $nestedData;

                $i++;
            }

        }

        $json_data = array(
            "draw"            => intval($this->request->getVar('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function add(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $power = $this->request->getVar('power');
        $password = md5($this->request->getVar('password'));
        $permissions = $this->request->getVar('permissions');

        $data = array(
            'name' => $name,
            'email' => $email,
            'power' => $power,
            'password' => $password,
            'permissions' => $permissions,
        );

        if ($type == 'add') {
            $user_exist = $this->Commonmodel->Duplicate_check(array('email' => $email), 'saimtech_users');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$user_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_users');
                $result = array('success' =>  true);
            } else {
                $msg = 'This email '. $email . ' already exist. Please try diffrent email';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $id = $this->request->getVar('id');
            $user_exist = $this->Commonmodel->Duplicate_check(array('email' => $email), 'saimtech_users', array('id' => $id));
            // dd($this->Commonmodel->db->getLastQuery()->getQuery());

            if (!$user_exist) {
                $id = $this->request->getVar('id');
                $this->Commonmodel->update_record($data,array('id' => $id), 'saimtech_users');
                $result = array('success' =>  true);
            } else {
                $msg = 'This email '. $email . ' already exist. Please try diffrent email';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $id = $this->request->getVar('id');
        $is_enable = $this->request->getVar('is_enable');

        $data = array('is_enable' => $is_enable);
        $this->Commonmodel->update_record($data, array('id' => $id), 'saimtech_users');
        // dd($this->Commonmodel->db->getLastQuery()->getQuery());
        $msg = ($is_enable) ? 'Item activated successfully!' : 'Item deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}