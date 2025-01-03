<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Itemmodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Item extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Itemmodel = new Itemmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Item List';
        $data['items_active'] = 'active';
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $items = $this->Commonmodel->getAllRecords('saimtech_items');
        $data['items'] = $items;
        $categories = $this->Commonmodel->getAllRecords('saimtech_category');
        $data['categories'] = $categories;

        $data['main_content'] = 'item/item';
        return view('layouts/page',$data);
    }

    public function itemList(){
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');

        $totalData = $this->Itemmodel->all_items_count();

        $totalFiltered = $totalData;

        if (empty($this->request->getVar('search')['value'])) {

            $items = $this->Itemmodel->all_items($limit,$start);

        } else {

            $search = trim($this->request->getVar('search')['value']); 
            $items =  $this->Itemmodel->items_search($limit,$start,$search);
            $totalFiltered = $this->Itemmodel->items_search_count($search);

        }
        // echo '<pre>'; print_r($items); die;
        $data = array();
        if (!empty($items)) {

            $i = 1;
            foreach ($items as $row) {
                $action = '';
                if (in_array('alter_item', $_SESSION['permissions'])) {
                    $action = '<button class="btn btn-outline-theme edit-item"
                        data-itemsId="'.$row->itemsId.'"
                        data-itemName="'.$row->itemName.'"
                        data-itemCategory="'.$row->itemCategory.'"
                        data-category_id="'.$row->category_id.'"
                        data-purchasePrice="'.$row->purchasePrice.'"
                        data-salePrice="'.$row->salePrice.'"
                        data-discount="'.$row->discount.'"
                        data-itemTags="'.$row->itemTags.'"
                        >Edit</button>
                    ';
                }
                $detail_url = URL. '/inventory/item_inv_detail/'. $row->itemsId;
                if (in_array('view_inventory', $_SESSION['permissions'])) {
                    $action.= '<a  href="'. $detail_url .'" target="_blank" class="btn btn-outline-theme">Inventory</a>';
                }
                $action.= '<button type="button" class="btn btn-outline-theme ms-1 print-barcode" 
                    data-item_id="'.$row->itemsId.'"  
                    data-barcode="'.$row->barcode.'"  
                    style="">Barcode <i class="fa fa-barcode" aria-hidden="true"></i>
                </button>';

                $nestedData['sr'] = $i;
                $nestedData['itemName'] = $row->itemName;
                $nestedData['itemCategory'] = $row->itemCategory;
                $nestedData['qty'] = $row->qty - $row->sale_qty;
                $nestedData['purchasePrice'] = $row->purchasePrice;
                $nestedData['salePrice'] = $row->salePrice;
                $nestedData['discount'] = $row->discount;
                $nestedData['itemTags'] = $row->itemTags;

                $status = ($row->itemActive) ? 'Active' : 'Deactive';
                $checked = ($row->itemActive) ? 'checked' : '';
                $disabled = (in_array('alter_item', $_SESSION['permissions'])) ? '' : 'disabled';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" '.$disabled.' data-itemsId="'.$row->itemsId.'" class="form-check-input" id="itemActive" '. $checked .'>
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
        $itemName = $this->request->getVar('itemName');
        $category_id = $this->request->getVar('category_id');
        $purchasePrice = $this->request->getVar('purchasePrice');
        $salePrice = $this->request->getVar('salePrice');
        $discount = $this->request->getVar('discount');

        $category = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('category_id' => $category_id)), 'saimtech_category');

        $data = array(
            'itemName' => $itemName,
            'itemCategory' => $category->title,
            'category_id' => $category_id,
            'purchasePrice' => $purchasePrice,
            'salePrice' => $salePrice,
            'discount' => $discount,
        );

        if ($type == 'add') {
            $item_exist = $this->Commonmodel->Duplicate_check(array('itemName' => $itemName), 'saimtech_items');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$item_exist) {
                $insert_id = $this->Commonmodel->insert_record($data, 'saimtech_items');
                $this->Commonmodel->generateItemAutoBarcode($insert_id);
                $result = array('success' =>  true);
            } else {
                $msg = 'This Item '. $itemName . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        } else {
            $itemsId = $this->request->getVar('itemsId');
            $item_exist = $this->Commonmodel->Duplicate_check(array('itemName' => $itemName), 'saimtech_items', array('itemsId' => $itemsId));
            // dd($this->Commonmodel->db->getLastQuery()->getQuery());

            if (!$item_exist) {
                $itemsId = $this->request->getVar('itemsId');
                $this->Commonmodel->update_record($data,array('itemsId' => $itemsId), 'saimtech_items');
                $result = array('success' =>  true);
            } else {
                $msg = 'This Item '. $itemName . ' already exist. Please try diffrent name';
                $result = array('success' =>  false, 'msg' => $msg);
            }
        }

        // echo json_encode($result);
        // $this->output->set_content_type('application/json')->set_output(json_encode($result));
        return $this->response->setJSON($result);
    }

    public function statusUpdate(){
        $itemsId = $this->request->getVar('itemsId');
        $itemActive = $this->request->getVar('itemActive');

        $data = array('itemActive' => $itemActive);
        $this->Commonmodel->update_record($data, array('itemsId' => $itemsId), 'saimtech_items');
        // dd($this->Commonmodel->db->getLastQuery()->getQuery());
        $msg = ($itemActive) ? 'Item activated successfully!' : 'Item deactivated successfully!'; 
        $result = array('success' =>  true, 'msg' => $msg);

        return $this->response->setJSON($result);
    }

    public function getItemBarcodeData(){
        $result = array('success' =>  false);
        $item_id = $this->request->getVar('item_id');
        $barcode = $this->request->getVar('barcode');

        $data['item'] = $item = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('itemsId' => $item_id)), 'saimtech_items');
        if ($item) {
            $html = view('item/item_barcode_data', $data);
            $result = array('success' =>  true, 'html' => $html);
        }
        return $this->response->setJSON($result);
    }

    public function generate_items_auto_barcode() {
        ini_set('memory_limit', '2048M');

        set_time_limit(0);

        $items = $this->Itemmodel->all_items(-1,0);
        foreach ($items as $row) {
            if ($row->barcode == '') {
                $barcode = $this->Commonmodel->generateItemAutoBarcode($row->itemsId);
                $this->Commonmodel->generateProductBarcode($barcode, 'code128', true);
            }
        }

        echo 'All Barcodes added!';
    }

    public function update_barcode(){
        $item_id = $this->request->getVar('item_id');
        $old_barcode = trim($this->request->getVar('old_barcode'));
        $new_barcode = trim($this->request->getVar('new_barcode'));

        $not_in_cols = array('itemsId' => $item_id);
        $duplicate_check = $this->Commonmodel->Duplicate_check(array('barcode' => $new_barcode),'saimtech_items', $not_in_cols);
        // echo $duplicate_check; die;
        if ($duplicate_check) {
            $result = array('success' =>  false, 'msg' => 'Barcode already exist. Please try with different barcode!');
            return $this->response->setJSON($result);
            exit();
        }
        if (strlen($new_barcode) < 3) {
            $result = array('success' =>  false, 'msg' => 'Barcode should be at least three characters!');
            return $this->response->setJSON($result);
            exit();
        }
        $this->Commonmodel->update_record(array('barcode' => $new_barcode),array('itemsId' => $item_id), 'saimtech_items');
        $this->Commonmodel->generateProductBarcode($new_barcode, 'code128', false);
        
        $result = array('success' =>  true);
        return $this->response->setJSON($result);
    }
}