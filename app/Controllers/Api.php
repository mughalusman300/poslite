<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Api extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->db      = \Config\Database::connect(); 
        $session = \Config\Services::session();
        helper('custom_helper');
       
    }
    public function login() 
    {
        $name       = $this->request->getVar('name');
        $password   = md5(($this->request->getVar('password')));
        $v_success  = 0 ;
        $v_error    = 0 ;
     
        $user = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('email' => $name, 'password' => $password )), 'saimtech_users');

        if ($user) {
            $data       = array('status' => 200, 'user_id' => $user->id, 'power' => $user->power, 'key' => $user->key, 'name' => $user->name, 'date' => date('Y-m-d H:i:s'));
            $v_success  = 1;
        } else {
            $data       = array('status' => 404, 'msg' => 'name or password is incorrect');
            $v_error    = 1; 
        }
        
        //--------------------
        $resquest['name']        = $name;
        $resquest['password']    = $password;
        $dataLog['name']         = "api/login";
        $dataLog['request']      = json_encode($resquest);
        $dataLog['method']       = "POST";
        $dataLog['response']     = json_encode($data); 
        $dataLog['success']      = $v_success; 
        $dataLog['error']        = $v_error; 
        $dataLog['process']      = 1;
        $this->Commonmodel->insert_record($dataLog, 'saimtech_integrationLogs');
        //-------------------
        
        echo json_encode($data); 
    }

    public function get_items()
    {
        $key        = $this->request->getVar('key');
        $user       = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('key' => $key)), 'saimtech_users');
        $v_success  = 0 ;
        $v_error    = 0 ;
        
        if ($user)
        {
            $items = $this->Commonmodel->getRows(array('conditions' => array('itemActive' => 1)), 'saimtech_items');
          
            if ($items)
            {
                $v_itemMain = array();
                $v_itemArray;
                foreach ($items as $rows)
                {
                    $v_itemArray['id'] = $rows->itemsId;
                    $v_itemArray['name'] = $rows->itemName;
                    $v_itemArray['price'] = $rows->salePrice;
                    $v_itemArray['disc'] = $rows->discount;
                    array_push($v_itemMain, $v_itemArray);
                }
            }
            
            $data       = array('status' => 200, 'items' => $v_itemMain);
            $v_success  = 1 ;
        } 
        else
        {
            $data       = array('status' => 401, 'msg' => 'name or password is incorrect');
            $v_error    = 1 ;
        }
        
        //--------------------
        $resquest['key']    = $key;
        $dataLog['name']    = "api/get_items";
        $dataLog['apikey']  = $key;
        $dataLog['method']  = 'POST';
        $dataLog['request'] = json_encode($resquest);
        $dataLog['response']= json_encode($data); 
        $dataLog['success'] = $v_success; 
        $dataLog['error']   = $v_error; 
        $dataLog['process'] = 1;
        $this->Commonmodel->insert_record($dataLog, 'saimtech_integrationLogs');
        //-------------------
        
        echo json_encode($data); 
    }
    
    
    public function save_sale_data()
    {
        $key        = $this->request->getVar('key');
        $plateform  = $this->request->getVar('plateform');
        $data       = json_decode($this->request->getVar('data'));

        // save transactoins data log
        $data_int_log = $this->request->getVar('data');
        //-------------------
        $resquest['key']    = $key;
        $resquest['data']   = $data_int_log;
        $dataLog['name']    = "api/save_sale_data";
        $dataLog['apikey']  = $key;
        $dataLog['method']  = 'POST';
        $dataLog['data']    = $data_int_log;
        $dataLog['request'] = json_encode($resquest);
        $dataLog['response']= ""; 
        $dataLog['success'] = 0; 
        $dataLog['error']   = 1; 
        $dataLog['process'] = 0;
        $integration_logs_id = $this->Commonmodel->insert_record($dataLog, 'saimtech_integrationLogs');
        // save transactoins data log

        $user = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('key' => $key )), 'saimtech_users');

        if (!$user) {
            $response       = array('status' => 401, 'msg' => 'Invalid Key');
            echo json_encode($response); 
            exit;
        }


        $this->db->transStart();

        if (!empty($data)) {
            
            $count_data = count($data);
            
            foreach ($data as $value) {
                
                $sale_header =  array();
                $sale_data = ($count_data > 1) ? $value[0] : $value; 
               
                if ($sale_data->invoice_code!="NA")
                {
                    $sale_header['invoice_code'] = $sale_data->invoice_code;
                    $sale_header['counter_name'] = "1";
                    $sale_header['user_id'] = $sale_data->user_id;
                    $str = strtotime($sale_data->invoice_date);
                    $invoice_date = date('Y-m-d H:i:s', $str);
                    $sale_header['invoice_date'] = $invoice_date;
                    $sale_header['invoice_total'] = $sale_data->invoice_total;
                    $sale_header['invoice_discount'] = $sale_data->invoice_discount;
                    $sale_header['invoice_net'] = $sale_data->invoice_net;
                    $sale_header['payment_mode'] = $sale_data->payment_mode;
                    $sale_header['created_by'] = $user->created_by;
    
                    $sale_id = $this->Commonmodel->insert_record($sale_header, 'saimtech_sales');
    
                    if ($sale_id) {
                        $lines = $sale_data->invoice_lines;
    
                        if(!empty($lines)) {
                            foreach ($lines as $key => $line) {
                                // echo "<pre>"; print_r($line); die;
                                $sale_item =  array();
                                if ($plateform == "OpenPOS")
                                {
                                    $sale_item['item_id'] = 99999;
                                    $line->itemId = 99999;
                                }
                                else
                                {
                                    $sale_item['item_id'] = $line->itemId;
                                }
                                $sale_item['item_name'] = $line->itemName;
                                $sale_item['price'] = $line->price;
                                $sale_item['quantity'] = $line->qty;
                                $sale_item['discount'] = $line->disc;
                                $sale_item['net_price'] = $line->net;
                                $sale_item['sale_id'] = $sale_id;
                                $sale_item['created_by'] = $user->created_by;
    
                                $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $line->itemId)), 'saimtech_items');
                                if(!$item) {
                                    $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemName' => $line->itemName)), 'saimtech_items');
                                    if($item){
                                        $sale_item['item_id'] = $item->itemsId;
                                    }
                                }
                                if ($item) {
                                    $sale_item['purch_price'] = $item->purchasePrice;
                                } else {
                                    if ($plateform == "OpenPOS") {
                                        $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemName' => $line->itemName)), 'saimtech_items_open');
                                        $sale_item['purch_price'] = $line->price;
                                        $open_item =  array();
                                        $open_item['itemName'] = $line->itemName;
                                        $open_item['itemCategory'] = 'Others';
                                        $open_item['purchasePrice'] = $line->price;
                                        $open_item['salePrice'] = $line->price;
                                       
    
                                        if($item) {
                                            $this->Commonmodel->update_record($open_item, array('itemsId' => $line->itemId), 'saimtech_items_open');
                                        } else {
                                            $this->Commonmodel->insert_record($open_item, 'saimtech_items_open');
                                        }
                                    }
    
                                }
    
                                $this->Commonmodel->insert_record($sale_item, 'saimtech_saletrans');
                            }
                        }
                    }
                }
            }
        }


        if($integration_logs_id){ // success logs update
            $dataLog = array();
            $dataLog['success'] = 1; 
            $dataLog['error']   = 0; 
            $this->Commonmodel->update_record($dataLog, array('id' => $integration_logs_id), 'saimtech_integrationLogs');
        }
        $this->db->transComplete();

        $response       = array('status' => 200, 'msg' => 'Data Sync Successfully!');

        echo json_encode($response); 
        //-------------------
    }
}