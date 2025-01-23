<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Inventorymodel;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\FpdfLib;
use Zend\Barcode\Barcode;

class Inventory extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
        parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
        $this->Inventorymodel = new Inventorymodel();
        $session = \Config\Services::session();
        helper('custom_helper');
    }
    public function index(){
        $data['title'] = 'Inventory List';
        $data['inventory_active'] = 'active';
        $data['main_content'] = 'inventory/inventory';
        return view('layouts/page',$data);
    }

    public function invntoryList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        // dd($search);
        $totalData = $this->Inventorymodel->all_inv_count();
        $totalFiltered = $totalData;

        if (empty($search)) {
            $items = $this->Inventorymodel->all_inv($limit, $start);
        } else {
            $items =  $this->Inventorymodel->inv_search($limit,$start,$search);
            $totalFiltered = $this->Inventorymodel->inv_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($items)) {

            $sr = 1;
            foreach ($items as $row) {

                $detail_url = URL. '/inventory/detail/'. $row->inventory_id;  

                $action = '<a  href="'. $detail_url .'" class="btn btn-outline-theme" style="width:140px">View Detail <i class="fa fa-eye" aria-hidden="true"></i></a>
                ';                  
                $nestedData['sr'] = $sr;
                $nestedData['inventory_code'] = $row->inventory_code;

                $nestedData['inventory_date'] = $row->inventory_date;  
                $nestedData['inventory_desc'] = ($row->inventory_desc) ? $row->inventory_desc : 'N/A';                              
                $nestedData['Action'] = $action;

                $data[] = $nestedData;

                $sr++;
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

    public function add_inventory(){
        if (isset($_POST) && !empty($_POST)) {
            // ddd($_POST);
            $data['inventory_code'] = $this->request->getVar('inventory_code');
            $data['inventory_date'] = date('Y-m-d');
            $data['inventory_desc'] = $this->request->getVar('inventory_desc');
            $data['supplier_id'] = 1;
            $data['created_by'] = $_SESSION['user_id'];

            $inventory_id = $this->Commonmodel->insert_record($data, 'saimtech_inventory');

            if($inventory_id) {
                $total = 0;
                foreach ($_POST['item_id'] as $key => $value) {
                    $detail_data = array();
                    $item_id = $this->request->getVar("item_id")[$key];
                    $detail_data['item_id'] = $this->request->getVar("item_id")[$key];
                    $detail_data['purchase_price'] = $this->request->getVar("purchase_price")[$key];
                    $detail_data['sale_price'] = $this->request->getVar("sale_price")[$key];
                    $detail_data['inventory_qty'] = $this->request->getVar("inventory_qty")[$key];

                    $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId ' => $item_id)), 'saimtech_items');

                    $detail_data['prev_purchase_price'] = $this->request->getVar("prev_purchase_price")[$key];
                    $detail_data['prev_sale_price'] = $this->request->getVar("prev_sale_price")[$key];
                    // $detail_data['prev_inventory_qty'] = $this->request->getVar("prev_inventory_qty")[$key];
                    $detail_data['prev_inventory_qty'] = $item->qty;
                    $detail_data['inventory_id'] = $inventory_id;
                    $detail_data['supplier_id'] = 1;
                    $detail_data['created_by'] = $_SESSION['user_id'];

                    $this->Commonmodel->insert_record($detail_data, 'saimtech_inventory_detail');

                    $item_data = array();
                    $item_data['purchasePrice'] = $detail_data['purchase_price'];
                    $item_data['salePrice'] = $detail_data['sale_price'];
                    $item_data['qty'] = $item->qty +  $detail_data['inventory_qty'];
                    $this->Commonmodel->update_record($item_data,array('itemsId' => $item_id), 'saimtech_items');
                }

                

                session()->setFlashdata('message', 'Inventory added successfully.');
                return redirect()->to('/inventory/detail/'.$inventory_id.'/');
            }

        } else {
            // ddd(inventory_code());
            $data['title'] = 'Add Inventory';
            $data['inventory_active'] = 'active';
            // $data['inventory'] ="nav-expanded nav-active";
            // $data['category'] ="nav-active";

            $data['items'] = $items = $this->Commonmodel->getRows(array('conditions' => array('itemActive' => 1)), 'saimtech_items');

            $data['main_content'] = 'inventory/add_inventory';
            return view('layouts/page',$data);  
        }
    }


    public function detail($inventory_id){
        $data['title'] = 'Inventory Detail';
        $data['main_content'] = 'inventory/detail';
        $data['inventory_id'] = $inventory_id;

        //Inventory in parent line
        $row = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('inventory_id' => $inventory_id)), 'saimtech_inventory');
        if($row) {
            $details = $this->Inventorymodel->get_inv_detail($inventory_id);
            if($details) {
                $data['items'] = $items = $this->Commonmodel->getRows(array('conditions' => array('itemActive' => 1)), 'saimtech_items');
                $data['inventory_code'] = $row->inventory_code;
                $data['inventory_desc'] = $row->inventory_desc;
                $data['inventory_date'] = date('d-m-Y',strtotime($row->inventory_date));
                $data['details'] = $details;
            } else {
                session()->setFlashdata('message', 'Not Found!');
                session()->setFlashdata('message_type', 'error');
                return redirect()->to('/inventory');
            }

        } else {
            session()->setFlashdata('message', 'Not Found!');
            session()->setFlashdata('message_type', 'error');
            return redirect()->to('/inventory');
        }

        return view('layouts/page',$data);
    
    }

    public function delete_detail_row() {
        $inventory_detail_id = $this->request->getVar('inventory_detail_id');

        $detail = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('inventory_detail_id' => $inventory_detail_id)), 'saimtech_inventory_detail');

        $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $detail->item_id)), 'saimtech_items');

        $update_item['qty'] = $item->qty - $detail->inventory_qty;
        $this->Commonmodel->update_record($update_item,array('itemsId' => $item->itemsId), 'saimtech_items');

        $this->Commonmodel->Delete_record('saimtech_inventory_detail', 'inventory_detail_id', $inventory_detail_id);

        $result = array('success' =>  true);
        return $this->response->setJSON($result);

    }

    public function item_inv_detail($item_id){
        $data['title'] = 'Item Inventory Detail';
        $data['main_content'] = 'inventory/item_inv_detail';
        $data['item_id'] = $item_id;

        //Inventory in parent line
        $row = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $item_id)), 'saimtech_items');
        if($row) {
            $data['img'] = IMGURL.$row->img;
            $data['item_name'] = $row->itemName;
            $data['item'] = $row;

            $data['barcode'] = $row->barcode;

            $link = LIVE_URL.'pdf/' . $row->barcode . '.png';


            $headers = @get_headers($link);
            if ($headers && strpos($headers[0], '200') !== false) {
                
            } else {
                $this->Commonmodel->generateProductBarcode($row->barcode);
            }
            // ddd($row);

        } else {
            session()->setFlashdata('message', 'Not Found!');
            session()->setFlashdata('message_type', 'error');
            return redirect()->to('/inventory');
        }

        return view('layouts/page',$data);
    
    }
    public function itemInvDetailList(){
        // dd($_POST);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $search = $this->request->getVar('search');
        $item_id = $this->request->getVar('item_id');
        // dd($search);
        $totalData = $this->Inventorymodel->all_inv_detail_count($item_id);
        $totalFiltered = $totalData;

        if (empty($search)) {
            $items = $this->Inventorymodel->all_inv_detail($item_id, $limit, $start);
            // ddd($items);
        } else {
            $items =  $this->Inventorymodel->inv_detail_search($item_id, $limit, $start, $search);
            $totalFiltered = $this->Inventorymodel->inv_detail_search_count($item_id, $search);

        }
        $data = array();
        if (!empty($items)) {

            $i = 1;
            foreach ($items as $row) {   
                $action = 'N/A';
                if (in_array('alter_inventory', $_SESSION['permissions'])) {
                    $action = '<button type="button" class="btn btn-outline-theme me-2 delete" 
                                        data-inventory_detail_id="'. $row->inventory_detail_id.'"
                                        style="width: 80px;">Delete</i>
                                    </button>';
                }

                $nestedData['sr'] = $i;
                $nestedData['inventory_code'] = $row->inventory_code;                
                $nestedData['inventory_qty'] = $row->inventory_qty;                
                $nestedData['purchase_price'] = $row->purchase_price;                
                $nestedData['sale_price'] =  $row->sale_price;  

                $nestedData['date'] =  date('d-m-Y h:i A',strtotime($row->created_at));  

                $nestedData['action'] =  $action;  


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

    public function getBarcodeData(){
        $result = array('success' =>  false);
        $item_id = $this->request->getVar('item_id');
        $barcode = $this->request->getVar('barcode');
        $data['qty'] = $this->request->getVar('inventory_qty');

        $data['item'] = $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $item_id)), 'saimtech_items');
        if ($item) {
            $html = view('inventory/inv_barcode_data', $data);
            $result = array('success' =>  true, 'html' => $html);
        }
        return $this->response->setJSON($result);
    }

    public function item_barcode($barcode, $qty = 1){

        if ($qty > 0 && $qty < 1000 ) {
            $length = strlen($barcode);
            $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('barcode' => $barcode)), 'saimtech_items');
            if ($item) {

                $data['item'] = $item;
                $data['barcode'] = $barcode;
                $data['qty'] = $qty;
                return view('item/print_barcode', $data);
            } else {
                echo 'Product Barcode Not Found';
            }
        } else{
            echo 'Something went wrong Please try later!';
        }
    }
}