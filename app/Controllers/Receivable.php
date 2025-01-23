<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Receivablemodel;
use App\Models\Accountsmodel;
use App\Models\Expensemodel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;

class Receivable extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->Receivablemodel = new Receivablemodel();
        $this->Accountsmodel = new Accountsmodel();
        $this->Expensemodel = new Expensemodel();
        $this->db = \Config\Database::connect(); 
        $session = \Config\Services::session();
        helper('custom_helper');
    }
    public function index(){
        $data['title'] = 'Receivable';
        $data['receivable_active'] = 'active';
        $data['status'] = 'Pending';

        $data['accounts'] = $this->Accountsmodel->all_account(-1, 0, 'Receivable');
        $data['main_content'] = 'receivable/receivable';
        return view('layouts/page',$data);
    }

    public function completed(){
        $data['title'] = 'Completed';
        $data['status'] = 'Completed';
        $data['receivable_active'] = 'active';

        $data['main_content'] = 'receivable/receivable';
        return view('layouts/page',$data);
    }

    public function receivableList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        $status = $this->request->getVar('status');
        // dd($search);
        $totalData = $this->Receivablemodel->all_receivable_count($status);
        $totalFiltered = $totalData;

        $limit = 10; $start = 0;

        if (empty($search)) {
            $accounts = $this->Receivablemodel->all_receivable($limit, $start, $status);
        } else {
            $accounts =  $this->Receivablemodel->receivable_search($limit,$start,$search, $status);
            $totalFiltered = $this->Receivablemodel->receivable_search_count($search, $status);

        }
        // echo '<pre>'; print_r($accounts); die;
        $data = array();
        if (!empty($accounts)) {

            foreach ($accounts as $row) {

                $action = '';
                $paid = $this->Receivablemodel->get_paid($row->receivable_id);

                if (in_array('alter_receivable', $_SESSION['permissions'])) {
                    if(!$paid) {
                        $action = '<button class="btn btn-sm btn-outline-theme edit-receivable"
                            data-receivable_id="'.$row->receivable_id.'"
                            data-account_id="'.$row->account_id.'"
                            data-amount="'.$row->amount.'" 
                            data-receivable_desc="'.$row->receivable_desc.'"
                            ><i class="fas fa-edit"></i> Edit</button>
                        ';
                    }
                }

                $pay_url = URL. '/receivable/pay/'. $row->receivable_id. '/view';  
                $action .= '<a  href="'. $pay_url .'" class="btn btn-sm me-2 btn-outline-theme" style=""> <i class="fas fa-eye"></i> View</a>';  

                if (in_array('view_receivable_pay', $_SESSION['permissions'])) {
                    $pay_url = URL. '/receivable/pay/'. $row->receivable_id;  
                    $action .= '<a  href="'. $pay_url .'" class="btn btn-sm btn-outline-theme" style=""><i class="fas fa-money-bill-alt"></i> Pay</a>';   
                } 

                if ($paid) {
                    if (in_array('view_receivable_lock', $_SESSION['permissions'])) {
                        $lock_url = URL. '/receivable/lock/'. $row->receivable_id;  
                        $action .= '<a  href="'. $lock_url .'" class="ms-1 btn btn-sm btn-outline-theme" style=""><i class="fas fa-lock"></i> Lock</a>';  
                    }
                } else {
                    if (in_array('alter_receivable', $_SESSION['permissions'])) {
                        $action .= '<button class="btn ms-2 btn-sm btn-outline-danger delete"
                            data-receivable_id="'.$row->receivable_id.'"
                            ><i class="fas fa-trash-alt"></i> Delete</button>
                        ';
                    }

                }


                if ($row->status == 'Completed') {
                    $pay_url = URL. '/receivable/pay/'. $row->receivable_id. '/view';  
                    $action = '<a  href="'. $pay_url .'" class="btn btn-sm btn-outline-theme" style=""> <i class="fas fa-eye"></i> View</a>';  
                }
                // $action = '<button class="btn btn-outline-theme edit-receivable"
                //     data-receivable_id="'.$row->receivable_id.'"
                //     data-account_name="'.$row->account_name.'"
                //     data-amount="'.$row->amount.'" 
                //     data-receivable_desc="'.$row->receivable_desc.'" 
                //     >Edit</button>
                // ';

          
                $nestedData['account_name'] = $row->account_name;

                $nestedData['amount'] = number_format($row->amount, 2);  
                $paid_amount = 0;
                $pending_amount = $row->amount;
                $paid = $this->Receivablemodel->get_paid($row->receivable_id);
                if($paid) {
                    $total_paid = 0;
                    foreach ($paid as $line) {
                        if($line->is_lock) {
                            $total_paid += $line->receivable_detail_amount;
                        }
                    }
                    $paid_amount = $total_paid;
                    $pending_amount = $row->amount - $paid_amount;
                }
                $nestedData['paid_amount'] = number_format($paid_amount, 2);  
                $nestedData['pending_amount'] = number_format($pending_amount, 2);  
                $nestedData['receivable_desc'] = ($row->receivable_desc) ? $row->receivable_desc : 'N/A';
                $nestedData['added_by'] = $row->added_by. '<br>'. date('d-m-Y', strtotime($row->created_at));  

                // $status = 'Pending';
                // if ($paid && $pending_amount) {
                //     $status = 'Partial Completed';
                // } else if($paid && $pending_amount == 0) {
                //     $status = 'Completed';
                // }

                $nestedData['status'] = $row->status;

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
        $account_id = $this->request->getVar('account_id');
        $amount = $this->request->getVar('amount');
        $receivable_desc = $this->request->getVar('receivable_desc');

        $data = array(
            'account_id' => $account_id,
            'amount' => $amount,
            'receivable_desc' => $receivable_desc,
            'created_by' => $_SESSION['user_id'],
        );

        if ($type == 'add') {
            $this->Commonmodel->insert_record($data, 'saimtech_receivable');
            $result = array('success' =>  true);
        } else {
            $receivable_id = $this->request->getVar('receivable_id');

            $receivable_id = $this->request->getVar('receivable_id');
            $this->Commonmodel->update_record($data,array('receivable_id' => $receivable_id), 'saimtech_receivable');
            $result = array('success' =>  true);
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function pay($receivable_id, $type = 'pay'){
        if (isset($_POST) && !empty($_POST)) {
            $amount = $this->request->getVar('amount');
            $receivable_detail_amount = $this->request->getVar('receivable_detail_amount');
            foreach ($receivable_detail_amount as $key => $value) {
                $data = array(
                    'receivable_id' => $receivable_id,
                    'trans_month' => date('m', strtotime($this->request->getVar('payment_date')[$key])),
                    'trans_year' => date('Y', strtotime($this->request->getVar('payment_date')[$key])),
                    'payment_date' => date('Y-m-d', strtotime($this->request->getVar('payment_date')[$key])),
                    'payment_mode_id' => $this->request->getVar('payment_mode_id')[$key],
                    'receivable_detail_amount' => $this->request->getVar('receivable_detail_amount')[$key],
                    'receivable_detail_desc' => $this->request->getVar('receivable_detail_desc')[$key],
                    'added_date' => date('Y-m-d'),
                    'created_by' => $_SESSION['user_id'],
                );

                $this->Commonmodel->insert_record($data, 'saimtech_receivable_detail');
            }

            session()->setFlashdata('message', 'Payment added successfully.');
            return redirect()->to('/receivable/pay/'.$receivable_id); 
        } else {
            $data['title'] = ($type == 'pay') ? 'Add Payment' : 'Receivable';
            $data['receivable_active'] = 'active';

            $data['type'] = $type;
            $data['receivable'] = $receivable = $this->Receivablemodel->get_receivable_by_id($receivable_id);
            $data['modes'] = $this->Expensemodel->all_mode(-1,0);
            $data['receivable_id'] = $receivable_id;
            $data['pending_amount'] = $receivable->amount;

            $data['paid'] = $paid = $this->Receivablemodel->get_paid($receivable_id);
            if($paid) {
                $total_paid = 0;
                foreach ($paid as $row) {
                    if(!$row->is_rejected) {
                        $total_paid += $row->receivable_detail_amount;
                    }
                }
                $data['pending_amount'] = $receivable->amount - $total_paid;
            }

            $data['main_content'] = 'receivable/pay';
            return view('layouts/page',$data); 
        } 
    }

    public function lock($receivable_id){
        $data['title'] = 'Lock Transaction';
        $data['receivable_active'] = 'active';

        $data['receivable_id'] = $receivable_id;
        $data['receivable'] = $receivable = $this->Receivablemodel->get_receivable_by_id($receivable_id);
        $data['modes'] = $this->Expensemodel->all_mode(-1,0);

        $data['paid'] = $this->Receivablemodel->get_paid($receivable_id);

        $data['main_content'] = 'receivable/lock';
        return view('layouts/page',$data); 
    }

    public function update_satus() {
        $receivable_detail_id = $this->request->getVar('receivable_detail_id');
        $type = $this->request->getVar('type');

        $name = $this->db->table('saimtech_users')->select('name')->where('id', $_SESSION['user_id'])->get()->getRow()->name;

        $html = '<span class="fw-bold">Locked ('.$name.')';
        if($type == 'reject') {
           $html = '<span class="fw-bold">Rejected ('.$name.') '; 
        }
        $html .= '<br><i class="fas fa-undo revert" style="color: #1f6bff; cursor: pointer;"  data-receivable_detail_id="'.$receivable_detail_id.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Undo last action"></i>';

        if ($type == 'revert') {
            $html = '<button type="button" data-receivable_detail_id="'.$receivable_detail_id. '" data-type="lock" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-lock"></i> Lock</button>
            <button type="button" data-receivable_detail_id="'.$receivable_detail_id. '" data-type="reject" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-times"></i> Reject</button>';
        }

        $update_item['lock_reject_by'] = $_SESSION['user_id'];

        if ($type == 'lock') {
            $update_item['is_lock'] = 1;
            $update_item['is_rejected'] = 0;
        } else if($type == 'reject') {
            $update_item['is_rejected'] = 1;
            $update_item['is_lock'] = 0;
        } elseif($type == 'revert') {
            $update_item['is_lock'] = 0;
            $update_item['is_rejected'] = 0;
            $update_item['lock_reject_by'] = 0;
        }
        $this->Commonmodel->update_record($update_item,array('receivable_detail_id' => $receivable_detail_id), 'saimtech_receivable_detail');

        $result = array('success' =>  true, 'html' => $html);
        return $this->response->setJSON($result);

    }

    public function update_payment() {
        $data = $this->request->getVar();
        $receivable_detail_id = $this->request->getVar('receivable_detail_id');
        $detail = $this->db->table('saimtech_receivable_detail')->where('receivable_detail_id', $receivable_detail_id)->get()->getRow();
        if(!$detail->is_lock && !$detail->is_rejected) {
            unset($data['receivable_detail_id']);
            $data['payment_date'] = date('Y-m-d', strtotime($data['payment_date']));

            $this->Commonmodel->update_record($data,array('receivable_detail_id' => $receivable_detail_id), 'saimtech_receivable_detail');

            $receivable = $this->Receivablemodel->get_receivable_by_id($detail->receivable_id);
            $data['paid'] = $paid = $this->Receivablemodel->get_paid($detail->receivable_id);
            if ($paid) {
                $total_paid = 0;
                foreach ($paid as $row) {
                    if(!$row->is_rejected) {
                        $total_paid += $row->receivable_detail_amount;
                    }
                }
                $pending_amount = $receivable->amount - $total_paid;
            }

            $result = array('success' =>  true, 'pending_amount' => $pending_amount); 
        } else {
            $result = array('success' =>  false, 'html' => 'something went false'); 
        }


        return $this->response->setJSON($result);
    }

    public function complete() {
        $receivable_id = $this->request->getVar('receivable_id');

        $update_item['status'] = 'Completed';
        $update_item['completed_at'] = date('Y-m-d H:i:s');
        $update_item['completed_by'] = $_SESSION['user_id'];

        $this->Commonmodel->update_record($update_item,array('receivable_id' => $receivable_id), 'saimtech_receivable');

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }
    public function delete() {
        $receivable_id = $this->request->getVar('receivable_id');

        $this->Commonmodel->Delete_record('saimtech_receivable', 'receivable_id', $receivable_id);
        $this->Commonmodel->Delete_record('saimtech_receivable_detail', 'receivable_id', $receivable_id);

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

    public function delete_line() {
        $receivable_detail_id = $this->request->getVar('receivable_detail_id');
        $this->Commonmodel->Delete_record('saimtech_receivable_detail', 'receivable_detail_id', $receivable_detail_id);

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

}