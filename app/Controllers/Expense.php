<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Expensemodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Expense extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Expensemodel = new Expensemodel();
	    $session = \Config\Services::session();
        helper('custom_helper');
    }
    public function index(){
        $data['title'] = 'Expense';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['main_content'] = 'expense/expense';
        return view('layouts/page',$data);
    }

    public function expense_list(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Expensemodel->all_expense_count();
        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $expenses = $this->Expensemodel->all_expense($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $expenses =  $this->Expensemodel->expense_search($limit,$start,$search);
            $totalFiltered = $this->Expensemodel->expense_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($expenses)) {

            $i = 1;
            foreach ($expenses as $row) {
                $action = '<button class="btn btn-outline-theme view-expense">View</button>';

                $nestedData['sr'] = $i;
                $nestedData['month_year'] = $row->year;
                $nestedData['total'] = $row->total;

                $status = ($row->is_approved) ? 'Approved' : 'Not Approved';
                $checked = ($row->is_approved) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" style="opacity:1" disabled data-id="'.$row->id.'" class="form-check-input" id="is_approved" '. $checked .'>
                            <label class="form-check-label" style="opacity:1" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['created_by'] = $row->name;
                $nestedData['created_date'] = date('d-m-Y',strtotime($row->created_at));
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

    public function add_expense(){
        $data['title'] = 'Add Expense';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['headers'] = $this->Expensemodel->all_header(-1,0);
        $data['parties'] = $this->Expensemodel->all_party(-1,0);
        $data['modes'] = $this->Expensemodel->all_mode(-1,0);
        $data['main_content'] = 'expense/add_expense';
        return view('layouts/page',$data);
    }

    //Expense Header functions
    public function expense_header(){
        $data['title'] = 'Expense Header';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['main_content'] = 'expense/expense_header';
        return view('layouts/page',$data);
    }

    public function expense_header_list(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Expensemodel->all_header_count();
        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $headers = $this->Expensemodel->all_header($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $headers =  $this->Expensemodel->headers_search($limit,$start,$search);
            $totalFiltered = $this->Expensemodel->headers_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($headers)) {

            $i = 1;
            foreach ($headers as $row) {
                $action = '<button class="btn btn-outline-theme edit-header"
                    data-id="'.$row->id.'"
                    data-name="'.$row->name.'"
                    data-header_desc="'.$row->header_desc.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['name'] = $row->name;
                $nestedData['header_desc'] = $row->header_desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-id="'.$row->id.'" class="form-check-input" id="is_active" '. $checked .'>
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

    public function add_header(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $name = $this->request->getVar('name');
        $header_desc = $this->request->getVar('header_desc');


        $data = array(
            'name' => $name,
            'header_desc' => $header_desc,
        );

        if ($type == 'add') {
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_expense_header');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$item_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_expense_header');
                $result = array('success' =>  true);
            } else {
                $msg = 'This expense header '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $id = $this->request->getVar('id');
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_expense_header', array('id' => $id));
            // dd($this->Commonmodel->db->getLastQuery()->getQuery());

            if (!$item_exist) {
                $id = $this->request->getVar('id');
                $this->Commonmodel->update_record($data,array('id' => $id), 'saimtech_expense_header');
                $result = array('success' =>  true);
            } else {
                $msg = 'This expense header '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function expense_header_status_update(){
        $id = $this->request->getVar('id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('id' => $id), 'saimtech_expense_header');
        // dd($this->Commonmodel->db->getLastQuery()->getQuery());
        $msg = ($is_active) ? 'Header activated successfully!' : 'header deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }

    //Payment Mode functions
    public function payment_mode(){
        $data['title'] = 'Payment Mode';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['main_content'] = 'expense/payment_mode';
        return view('layouts/page',$data);
    }

    public function payment_mode_list(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Expensemodel->all_mode_count();
        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $modes = $this->Expensemodel->all_mode($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $modes =  $this->Expensemodel->mode_search($limit,$start,$search);
            $totalFiltered = $this->Expensemodel->mode_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($modes)) {

            $i = 1;
            foreach ($modes as $row) {
                $action = '<button class="btn btn-outline-theme edit-mode"
                    data-id="'.$row->id.'"
                    data-payment_type="'.$row->payment_type.'"
                    data-name="'.$row->name.'"
                    data-payment_mode_desc="'.$row->payment_mode_desc.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['name'] = $row->name;
                $nestedData['payment_type'] = $row->payment_type;
                $nestedData['payment_mode_desc'] = $row->payment_mode_desc;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-id="'.$row->id.'" class="form-check-input" id="is_active" '. $checked .'>
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

    public function add_mode(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $payment_type = $this->request->getVar('payment_type');
        $name = $this->request->getVar('name');
        $payment_mode_desc = $this->request->getVar('payment_mode_desc');


        $data = array(
            'payment_type' => $payment_type,
            'name' => $name,
            'payment_mode_desc' => $payment_mode_desc,
        );

        if ($type == 'add') {
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_payment_mode');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$item_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_payment_mode');
                $result = array('success' =>  true);
            } else {
                $msg = 'This name '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $id = $this->request->getVar('id');
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_payment_mode', array('id' => $id));
            // dd($this->Commonmodel->db->getLastQuery()->getQuery());

            if (!$item_exist) {
                $id = $this->request->getVar('id');
                $this->Commonmodel->update_record($data,array('id' => $id), 'saimtech_payment_mode');
                $result = array('success' =>  true);
            } else {
                $msg = 'This name '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function mode_status_update(){
        $id = $this->request->getVar('id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('id' => $id), 'saimtech_payment_mode');
        // dd($this->Commonmodel->db->getLastQuery()->getQuery());
        $msg = ($is_active) ? 'Payment mode successfully!' : 'Payment mode deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }

    //Party functions 
    public function party(){
        $data['title'] = 'Payment Mode';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $data['main_content'] = 'expense/party';
        return view('layouts/page',$data);
    }

    public function party_list(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Expensemodel->all_party_count();
        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $parties = $this->Expensemodel->all_party($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $parties =  $this->Expensemodel->party_search($limit,$start,$search);
            $totalFiltered = $this->Expensemodel->party_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($parties)) {

            $i = 1;
            foreach ($parties as $row) {
                $action = '<button class="btn btn-outline-theme edit-party"
                    data-id="'.$row->id.'"
                    data-party_type="'.$row->party_type.'"
                    data-name="'.$row->name.'"
                    data-detail="'.$row->detail.'"
                    data-contact="'.$row->contact.'"
                    data-note="'.$row->note.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['party_type'] = $row->party_type;
                $nestedData['name'] = $row->name;
                $nestedData['contact'] = $row->contact;
                $nestedData['detail'] = $row->detail;
                $nestedData['note'] = $row->note;

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-id="'.$row->id.'" class="form-check-input" id="is_active" '. $checked .'>
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

    public function add_party(){
        $result = array('success' =>  false);

        $type = $this->request->getVar('type');
        $party_type = $this->request->getVar('party_type');
        $name = $this->request->getVar('name');
        $contact = $this->request->getVar('contact');
        $detail = $this->request->getVar('detail');
        $note = $this->request->getVar('note');


        $data = array(
            'party_type' => $party_type,
            'name' => $name,
            'contact' => $contact,
            'detail' => $detail,
            'note' => $note,
        );

        if ($type == 'add') {
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_party');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$item_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_party');
                $result = array('success' =>  true);
            } else {
                $msg = 'This name '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $id = $this->request->getVar('id');
            $item_exist = $this->Commonmodel->Duplicate_check(array('name' => $name), 'saimtech_party', array('id' => $id));
            // dd($this->Commonmodel->db->getLastQuery()->getQuery());

            if (!$item_exist) {
                $id = $this->request->getVar('id');
                $this->Commonmodel->update_record($data,array('id' => $id), 'saimtech_party');
                $result = array('success' =>  true);
            } else {
                $msg = 'This name '. $name . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function party_status_update(){
        $id = $this->request->getVar('id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('id' => $id), 'saimtech_party');
        // dd($this->Commonmodel->db->getLastQuery()->getQuery());
        $msg = ($is_active) ? 'Party  activated successfully!' : 'Party  deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }
}