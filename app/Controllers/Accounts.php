<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Accountsmodel;
use App\Models\Expensemodel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;

class Accounts extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->Accountsmodel = new Accountsmodel();
        $this->Expensemodel = new Expensemodel();
        $session = \Config\Services::session();
        helper('custom_helper');
    }
    public function index(){
        $data['title'] = 'Accounts List';
        $data['accounts_active'] = 'active';
        $data['main_content'] = 'accounts/accounts';

        $data['parties'] = $this->Expensemodel->all_party(-1,0);

        return view('layouts/page',$data);
    }

    public function accountList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        // dd($search);
        $totalData = $this->Accountsmodel->all_account_count();
        $totalFiltered = $totalData;

        if (empty($search)) {
            $accounts = $this->Accountsmodel->all_account($limit, $start);
        } else {
            $accounts =  $this->Accountsmodel->account_search($limit,$start,$search);
            $totalFiltered = $this->Accountsmodel->account_search_count($search);

        }
        // echo '<pre>'; print_r($accounts); die;
        $data = array();
        if (!empty($accounts)) {

            foreach ($accounts as $row) {

                if (in_array('alter_accounts', $_SESSION['permissions'])) {
                    $action = '<button class="btn btn-outline-theme edit-account"
                        data-account_id="'.$row->account_id.'"
                        data-account_name="'.$row->account_name.'"
                        data-party_id="'.$row->party_id.'" 
                        data-type="'.$row->type.'"
                        data-account_desc="'.$row->account_desc.'" 
                        >Edit</button>
                    ';
                } else {
                    $action = 'N/A';
                }
          
                $nestedData['account_name'] = $row->account_name;

                $nestedData['type'] = $row->type;  
                $nestedData['party_name'] = $row->party_name;  
                $nestedData['account_desc'] = ($row->account_desc) ? $row->account_desc : 'N/A';

                $status = ($row->is_active) ? 'Active' : 'Deactive';
                $checked = ($row->is_active) ? 'checked' : '';
                $disabled = (in_array('alter_accounts', $_SESSION['permissions'])) ? '' : 'disabled';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" '.$disabled.' data-account_id="'.$row->account_id.'" class="form-check-input" id="is_active" '. $checked .'>
                            <label class="form-check-label" for="customSwitch2">'. $status. '</label>
                        </div>'  ;                          
                $nestedData['status'] = $status;
                $nestedData['created_at'] = date('d-m-Y', strtotime($row->created_at));

                $nestedData['action'] = $action;

                $data[] = $nestedData;
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
        $account_name = $this->request->getVar('account_name');
        $party_id = $this->request->getVar('party_id');
        $account_type = $this->request->getVar('account_type');
        $account_desc = $this->request->getVar('account_desc');

        $data = array(
            'account_name' => $account_name,
            'party_id' => $party_id,
            'type' => $account_type,
            'account_desc' => $account_desc,
        );

        if ($type == 'add') {
            $account_exist = $this->Commonmodel->Duplicate_check(array('account_name' => $account_name), 'saimtech_accounts');

            if (!$account_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_accounts');
                $result = array('success' =>  true);
            } else {
                $msg = 'This account with name '. $account_name . ' already exist. Please with try diffrent one';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $account_id = $this->request->getVar('account_id');
            $account_exist = $this->Commonmodel->Duplicate_check(array('account_name' => $account_name), 'saimtech_accounts', array('account_id' => $account_id));

            if (!$account_exist) {
                $account_id = $this->request->getVar('account_id');
                $this->Commonmodel->update_record($data,array('account_id' => $account_id), 'saimtech_accounts');
                $result = array('success' =>  true);
            } else {
                $msg = 'This account with name '. $account_name . ' already exist. Please with try diffrent one';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $account_id = $this->request->getVar('account_id');
        $is_active = $this->request->getVar('is_active');

        $data = array('is_active' => $is_active);
        $this->Commonmodel->update_record($data, array('account_id' => $account_id), 'saimtech_accounts');
        $msg = ($is_active) ? 'Account activated successfully!' : 'Account deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }

    public function pnl(){
        $data['title'] = 'PNL';
        $data['pnl_active'] = 'active';
        $data['main_content'] = 'accounts/pnl';

        $start_date = $end_date = $pnl_data  = $data['items_data'] =  '';
        if (isset($_POST) && !empty($_POST)) {
            $start_date = date('Y-m-d',strtotime($this->request->getVar('start_date')));
            $end_date = date('Y-m-d',strtotime($this->request->getVar('end_date')));
            $expense_data = $this->Accountsmodel->getExpenseByDate($start_date, $end_date);
            $data['expense_data'] = $expense_data;
            $items_data = $this->Accountsmodel->getItemSaleByDate($start_date, $end_date);
            $data['items_data'] = $items_data;

            $start_date = date('d-m-Y',strtotime($start_date));
            $end_date = date('d-m-Y',strtotime($end_date));

        }
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        return view('layouts/page',$data);
    }
}