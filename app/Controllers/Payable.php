<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Payablemodel;
use App\Models\Accountsmodel;
use App\Models\Expensemodel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;

class Payable extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->Payablemodel = new Payablemodel();
        $this->Accountsmodel = new Accountsmodel();
        $this->Expensemodel = new Expensemodel();
        $this->db = \Config\Database::connect(); 
        $session = \Config\Services::session();
        helper('custom_helper');
    }
    public function index(){
        $data['title'] = 'Payable';
        $data['payable_active'] = 'active';
        $data['status'] = 'Pending';

        $data['accounts'] = $this->Accountsmodel->all_account(-1, 0, 'Payable');
        $data['main_content'] = 'payable/payable';
        return view('layouts/page',$data);
    }

    public function completed(){
        $data['title'] = 'Completed';
        $data['status'] = 'Completed';
        $data['payable_active'] = 'active';

        $data['main_content'] = 'payable/payable';
        return view('layouts/page',$data);
    }

    public function payableList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        $status = $this->request->getVar('status');
        // dd($search);
        $totalData = $this->Payablemodel->all_payable_count($status);
        $totalFiltered = $totalData;

        $limit = 10; $start = 0;

        if (empty($search)) {
            $accounts = $this->Payablemodel->all_payable($limit, $start, $status);
        } else {
            $accounts =  $this->Payablemodel->payable_search($limit,$start,$search, $status);
            $totalFiltered = $this->Payablemodel->payable_search_count($search, $status);

        }
        // echo '<pre>'; print_r($accounts); die;
        $data = array();
        if (!empty($accounts)) {

            foreach ($accounts as $row) {

                $action = '';
                $paid = $this->Payablemodel->get_paid($row->payable_id);

                if (in_array('alter_payable', $_SESSION['permissions'])) {
                    if(!$paid) {
                        $action = '<button class="btn btn-sm btn-outline-theme edit-payable"
                            data-payable_id="'.$row->payable_id.'"
                            data-account_id="'.$row->account_id.'"
                            data-amount="'.$row->amount.'" 
                            data-payable_desc="'.$row->payable_desc.'"
                            ><i class="fas fa-edit"></i> Edit</button>
                        ';
                    }
                }


                $pay_url = URL. '/payable/pay/'. $row->payable_id. '/view';  
                $action .= '<a  href="'. $pay_url .'" class="btn btn-sm me-2 btn-outline-theme" style=""> <i class="fas fa-eye"></i> View</a>';  

                if (in_array('view_payable_pay', $_SESSION['permissions'])) {
                    $pay_url = URL. '/payable/pay/'. $row->payable_id;  
                    $action .= '<a  href="'. $pay_url .'" class="btn btn-sm btn-outline-theme" style=""><i class="fas fa-money-bill-alt"></i> Pay</a>'; 
                }   

                if ($paid) {
                    if (in_array('view_payable_lock', $_SESSION['permissions'])) {
                        $lock_url = URL. '/payable/lock/'. $row->payable_id;  
                        $action .= '<a  href="'. $lock_url .'" class="ms-1 btn btn-sm btn-outline-theme" style=""><i class="fas fa-lock"></i> Lock</a>';  
                    }
                } else {
                    if (in_array('alter_payable', $_SESSION['permissions'])) {
                        $action .= '<button class="btn ms-2 btn-sm btn-outline-danger delete"
                            data-payable_id="'.$row->payable_id.'"
                            ><i class="fas fa-trash-alt"></i> Delete</button>
                        ';
                    }
                }


                if ($row->status == 'Completed') {
                    $pay_url = URL. '/payable/pay/'. $row->payable_id. '/view';  
                    $action = '<a  href="'. $pay_url .'" class="btn btn-sm btn-outline-theme" style=""> <i class="fas fa-eye"></i> View</a>';  
                }
                // $action = '<button class="btn btn-outline-theme edit-payable"
                //     data-payable_id="'.$row->payable_id.'"
                //     data-account_name="'.$row->account_name.'"
                //     data-amount="'.$row->amount.'" 
                //     data-payable_desc="'.$row->payable_desc.'" 
                //     >Edit</button>
                // ';
          
                $nestedData['account_name'] = $row->account_name;

                $nestedData['amount'] = number_format($row->amount, 2);  
                $paid_amount = 0;
                $pending_amount = $row->amount;
                $paid = $this->Payablemodel->get_paid($row->payable_id);
                if($paid) {
                    $total_paid = 0;
                    foreach ($paid as $line) {
                        if($line->is_lock) {
                            $total_paid += $line->payable_detail_amount;
                        }
                    }
                    $paid_amount = $total_paid;
                    $pending_amount = $row->amount - $paid_amount;
                }
                $nestedData['paid_amount'] = number_format($paid_amount, 2);  
                $nestedData['pending_amount'] = number_format($pending_amount, 2);  
                $nestedData['payable_desc'] = ($row->payable_desc) ? $row->payable_desc : 'N/A';
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
        $payable_desc = $this->request->getVar('payable_desc');

        $data = array(
            'account_id' => $account_id,
            'amount' => $amount,
            'payable_desc' => $payable_desc,
            'created_by' => $_SESSION['user_id'],
        );

        if ($type == 'add') {
            $this->Commonmodel->insert_record($data, 'saimtech_payable');
            $result = array('success' =>  true);
        } else {
            $payable_id = $this->request->getVar('payable_id');

            $payable_id = $this->request->getVar('payable_id');
            $this->Commonmodel->update_record($data,array('payable_id' => $payable_id), 'saimtech_payable');
            $result = array('success' =>  true);
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function pay($payable_id, $type = 'pay'){
        if (isset($_POST) && !empty($_POST)) {
            $amount = $this->request->getVar('amount');
            $payable_detail_amount = $this->request->getVar('payable_detail_amount');
            foreach ($payable_detail_amount as $key => $value) {
                $data = array(
                    'payable_id' => $payable_id,
                    'trans_month' => date('m', strtotime($this->request->getVar('payment_date')[$key])),
                    'trans_year' => date('Y', strtotime($this->request->getVar('payment_date')[$key])),
                    'payment_date' => date('Y-m-d', strtotime($this->request->getVar('payment_date')[$key])),
                    'payment_mode_id' => $this->request->getVar('payment_mode_id')[$key],
                    'payable_detail_amount' => $this->request->getVar('payable_detail_amount')[$key],
                    'payable_detail_desc' => $this->request->getVar('payable_detail_desc')[$key],
                    'added_date' => date('Y-m-d'),
                    'created_by' => $_SESSION['user_id'],
                );

                $this->Commonmodel->insert_record($data, 'saimtech_payable_detail');
            }

            session()->setFlashdata('message', 'Payment added successfully.');
            return redirect()->to('/payable/pay/'.$payable_id); 
        } else {
            $data['title'] = ($type == 'pay') ? 'Add Payment' : 'Payable';
            $data['payable_active'] = 'active';

            $data['type'] = $type;
            $data['payable'] = $payable = $this->Payablemodel->get_payable_by_id($payable_id);
            $data['modes'] = $this->Expensemodel->all_mode(-1,0);
            $data['payable_id'] = $payable_id;
            $data['pending_amount'] = $payable->amount;

            $data['paid'] = $paid = $this->Payablemodel->get_paid($payable_id);
            if($paid) {
                $total_paid = 0;
                foreach ($paid as $row) {
                    if(!$row->is_rejected) {
                        $total_paid += $row->payable_detail_amount;
                    }
                }
                $data['pending_amount'] = $payable->amount - $total_paid;
            }

            $data['main_content'] = 'payable/pay';
            return view('layouts/page',$data); 
        } 
    }

    public function lock($payable_id){
        $data['title'] = 'Lock Transaction';
        $data['payable_active'] = 'active';

        $data['payable_id'] = $payable_id;
        $data['payable'] = $payable = $this->Payablemodel->get_payable_by_id($payable_id);
        $data['modes'] = $this->Expensemodel->all_mode(-1,0);

        $data['paid'] = $this->Payablemodel->get_paid($payable_id);

        $data['main_content'] = 'payable/lock';
        return view('layouts/page',$data); 
    }

    public function update_satus() {
        $payable_detail_id = $this->request->getVar('payable_detail_id');
        $type = $this->request->getVar('type');

        $name = $this->db->table('saimtech_users')->select('name')->where('id', $_SESSION['user_id'])->get()->getRow()->name;

        $html = '<span class="fw-bold">Locked ('.$name.')';
        if($type == 'reject') {
           $html = '<span class="fw-bold">Rejected ('.$name.') '; 
        }
        $html .= '<br><i class="fas fa-undo revert" style="color: #1f6bff; cursor: pointer;"  data-payable_detail_id="'.$payable_detail_id.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Undo last action"></i>';

        if ($type == 'revert') {
            $html = '<button type="button" data-payable_detail_id="'.$payable_detail_id. '" data-type="lock" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-lock"></i> Lock</button>
            <button type="button" data-payable_detail_id="'.$payable_detail_id. '" data-type="reject" class="btn btn-sm btn-outline-theme me-2 update-status"> <i class="fas fa-times"></i> Reject</button>';
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
        $this->Commonmodel->update_record($update_item,array('payable_detail_id' => $payable_detail_id), 'saimtech_payable_detail');

        $result = array('success' =>  true, 'html' => $html);
        return $this->response->setJSON($result);

    }

    public function update_payment() {
        $data = $this->request->getVar();
        $payable_detail_id = $this->request->getVar('payable_detail_id');
        $detail = $this->db->table('saimtech_payable_detail')->where('payable_detail_id', $payable_detail_id)->get()->getRow();
        if(!$detail->is_lock && !$detail->is_rejected) {
            unset($data['payable_detail_id']);
            $data['payment_date'] = date('Y-m-d', strtotime($data['payment_date']));

            $this->Commonmodel->update_record($data,array('payable_detail_id' => $payable_detail_id), 'saimtech_payable_detail');

            $payable = $this->Payablemodel->get_payable_by_id($detail->payable_id);
            $data['paid'] = $paid = $this->Payablemodel->get_paid($detail->payable_id);
            if ($paid) {
                $total_paid = 0;
                foreach ($paid as $row) {
                    if(!$row->is_rejected) {
                        $total_paid += $row->payable_detail_amount;
                    }
                }
                $pending_amount = $payable->amount - $total_paid;
            }

            $result = array('success' =>  true, 'pending_amount' => $pending_amount); 
        } else {
            $result = array('success' =>  false, 'html' => 'something went false'); 
        }


        return $this->response->setJSON($result);
    }

    public function complete() {
        $payable_id = $this->request->getVar('payable_id');

        $update_item['status'] = 'Completed';
        $update_item['completed_at'] = date('Y-m-d H:i:s');
        $update_item['completed_by'] = $_SESSION['user_id'];

        $this->Commonmodel->update_record($update_item,array('payable_id' => $payable_id), 'saimtech_payable');

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }
    public function delete() {
        $payable_id = $this->request->getVar('payable_id');

        $this->Commonmodel->Delete_record('saimtech_payable', 'payable_id', $payable_id);
        $this->Commonmodel->Delete_record('saimtech_payable_detail', 'payable_id', $payable_id);

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

    public function delete_line() {
        $payable_detail_id = $this->request->getVar('payable_detail_id');
        $this->Commonmodel->Delete_record('saimtech_payable_detail', 'payable_detail_id', $payable_detail_id);

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

}