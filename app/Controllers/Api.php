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
        $data       = json_decode($this->request->getVar('data'));

        $v_success  = 0 ;
        $v_error    = 0 ;

        // $log = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('name' => 'api/save_sale_data')), 'saimtech_integrationlogs');
        // $data = json_decode($log->data);

        if (!empty($data)) {
            $count_data = count($data);
            foreach ($data as $value) {
                $sale_header =  array();
                $sale_data = ($count_data > 1) ? $value[0] : $value; 
                $sale_header['invoice_code'] = $sale_data->invoice_code;
                $sale_header['counter_name'] = $sale_data->counter_name;
                $sale_header['user_id'] = $sale_data->user_id;
                $str = strtotime($sale_data->invoice_date);
                $invoice_date = date('Y-m-d H:i:s', $str);
                $sale_header['invoice_date'] = $invoice_date;
                // ddd($str);
                $sale_header['invoice_total'] = $sale_data->invoice_total;
                $sale_header['invoice_discount'] = $sale_data->invoice_discount;
                $sale_header['invoice_net'] = $sale_data->invoice_net;
                $sale_header['payment_mode'] = $sale_data->payment_mode;

                $sale_id = $this->Commonmodel->insert_record($sale_header, 'saimtech_sales');

                if ($sale_id) {
                    $lines = $sale_data->invoice_lines;

                    if(!empty($lines)) {
                        foreach ($lines as $key => $line) {
                            // ddd($line->itemId);
                            $sale_item =  array();
                            $sale_item['item_id'] = $line->itemId;
                            $sale_item['item_name'] = $line->itemName;
                            $sale_item['price'] = $line->price;
                            $sale_item['quantity'] = $line->qty;
                            $sale_item['discount'] = $line->disc;
                            $sale_item['net_price'] = $line->net;

                            $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $line->itemId)), 'saimtech_items');
                            if ($item) {
                                $sale_item['purch_price'] = $item->purchasePrice;
                            }

                            $this->Commonmodel->insert_record($sale_header, 'saimtech_saletrans');
                        }
                    }
                }

            }
        }
        
        //-------------------
        $resquest['key']    = $key;
        $resquest['data']   = $data;
        $dataLog['name']    = "api/save_sale_data";
        $dataLog['apikey']  = $key;
        $dataLog['method']  = 'POST';
        $dataLog['data']    = $data;
        $dataLog['request'] = json_encode($resquest);
        $dataLog['response']= ""; 
        $dataLog['success'] = $v_success; 
        $dataLog['error']   = $v_error; 
        $dataLog['process'] = 0;
        $this->Commonmodel->insert_record($dataLog, 'saimtech_integrationLogs');

        $response       = array('status' => 200, 'msg' => 'Data Sync Successfully!');

        echo json_encode($response); 
        //-------------------
    }
}