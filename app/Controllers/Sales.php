<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Salesmodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Sales extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Salesmodel = new Salesmodel();
	    $session = \Config\Services::session();
        helper('custom_helper');
    }

    public function index(){
        $data['title'] = 'Sales';
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['main_content'] = 'sales/sales';
        return view('layouts/page',$data);
    }

    public function saleList(){
        $start_date = $this->request->getVar('start_date');
        $end_date = $this->request->getVar('end_date');

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Salesmodel->salesCountByDate($start_date, $end_date);
        // ddd($totalData);
        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {
            $sales = $this->Salesmodel->getSalesByDate($start_date, $end_date, $limit, $start);
        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $sales =  $this->Salesmodel->getSalesByDate_search($start_date, $end_date, $limit,$start,$search);
            $totalFiltered = $this->Salesmodel->getSalesByDate_search_count($start_date, $end_date, $search);

        }
        $data = array();
        if (!empty($sales)) {

            $i = 1;
            foreach ($sales as $row) {

                if ($row->is_return_all) {
                    $action = 'Returned';
                } else {
                    $action = '
                    <a href="'.URL.'/sales/get_invoice_print/'.$row->invoice_code.'" target="_blank" class="btn btn-outline-theme print" data-invoice_code="'.$row->invoice_code.'">Print</a>
                    <button class="btn btn-outline-theme return-item" data-invoice_code="'. $row->invoice_code. '">Return</button>';
                }
                
                $nestedData['sr'] = $i;
                $nestedData['invoice_code'] = $row->invoice_code;
                $nestedData['invoice_date'] = date('Y-m-d', strtotime($row->invoice_date));
                $nestedData['invoice_discount'] = $row->invoice_discount + 0;
                $nestedData['invoice_total'] = $row->invoice_total;
                $nestedData['invoice_net'] = $row->invoice_net;

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


    public function get_invoice_detail() {
        $invoice_code = $this->request->getVar('invoice_code');
        $data['invoice_detail'] = $this->Salesmodel->getInvoiceDetail($invoice_code);

        $html = view('sales/invoice_datail', $data);
        $result = array('success' =>  true, 'html' => $html);
        return $this->response->setJSON($result);
    }
    public function get_invoice_print($invoice_code) {
        // $invoice_code = $this->request->getVar('invoice_code');
        $invoice_detail = $this->Salesmodel->getInvoiceDetail($invoice_code);
        if($invoice_detail) {
            $data['invoice_date'] = date('m/d/Y h:i:s A', strtotime($invoice_detail[0]->invoice_date));
            $data['payment_mode']  = $invoice_detail[0]->payment_mode;
            $data['invoice_detail'] = $invoice_detail;
            return view('sales/invoice_print', $data);

        } else {
            echo 'Invoice Not Found';
        }
        // $result = array('success' =>  true, 'html' => $html);
        // return $this->response->setJSON($result);
    }

    public function return() {
        // ddd($_POST);
        $invoice_code = $this->request->getPost('invoice_code');
        foreach ($_POST['return_qty'] as $key => $value) {

            $sale_trans_id = $this->request->getPost("sale_trans_id")[$key];
            $sale_trans = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('sale_trans_id' => $sale_trans_id)), 'saimtech_saletrans');
            $return_qty =  $this->request->getPost("return_qty")[$key];

            if ($return_qty != '') {
                $sale_tran_data['item_id'] =  $sale_trans->item_id;
                $sale_tran_data['item_name'] =  $sale_trans->item_name;
                $sale_tran_data['price'] =  $sale_trans->price;
                $sale_tran_data['purch_price'] =  $sale_trans->purch_price;
                $sale_tran_data['quantity'] =  '-'. $return_qty;
                $discount = ($sale_trans->discount / $sale_trans->quantity) *  $return_qty;
                $sale_tran_data['discount'] =  '-'. $discount;
                $net_price =  ($sale_trans->net_price / $sale_trans->quantity) *  $return_qty;
                $sale_tran_data['net_price'] =  '-'. $net_price;
                $sale_tran_data['sale_id'] =  $sale_trans->sale_id;
                $sale_tran_data['created_by'] =  $_SESSION['user_id'];
                $sale_tran_data['is_return'] =  1;

                $this->Commonmodel->insert_record($sale_tran_data, 'saimtech_saletrans');

                $sale = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('invoice_code' => $invoice_code)), 'saimtech_sales');

                $sales_data['invoice_discount'] = $sale->invoice_discount - $discount;
                $sales_data['invoice_net'] = $sale->invoice_net - $net_price;
                $sales_data['invoice_total'] = $sale->invoice_total - ($sale_trans->price * $return_qty);

                $this->Commonmodel->update_record($sales_data,array('sale_id' => $sale->sale_id), 'saimtech_sales');
            }
        }

        $return_all = false;
        $sale = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('invoice_code' => $invoice_code)), 'saimtech_sales');
        if ($sale->invoice_total <= 0) {
            $data['is_return_all'] = 1;
            $this->Commonmodel->update_record($data,array('sale_id' => $sale->sale_id), 'saimtech_sales');
            $return_all = true;
        }

        $result = array(
            'success' =>  true, 
            'invoice_discount' => $sales_data['invoice_discount'],
            'invoice_net' => $sales_data['invoice_net'],
            'invoice_total' => $sales_data['invoice_total'],
            'msg' => 'Return has been added!', 
            'return_all' => $return_all
        );
        return $this->response->setJSON($result);

        ddd($invoice_code);
    }

    public function test() {
        // $detail = $this->Salesmodel->getSalesReportByCategory('2024-06-01');
        // ddd($detail);
    }
}