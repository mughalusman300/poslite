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
        // $data['inventory'] ="nav-expanded nav-active";
        // $data['category'] ="nav-active";

        $items = $this->Commonmodel->getAllRecords('saimtech_items');
        $data['items'] = $items;
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
                $action = '<button class="btn btn-outline-theme edit-item"
                    data-itemsId="'.$row->itemsId.'"
                    data-itemName="'.$row->itemName.'"
                    data-itemCategory="'.$row->itemCategory.'"
                    data-purchasePrice="'.$row->purchasePrice.'"
                    data-salePrice="'.$row->salePrice.'"
                    data-discount="'.$row->discount.'"
                    data-itemTags="'.$row->itemTags.'"
                    >Edit</button>
                ';

                $nestedData['sr'] = $i;
                $nestedData['itemName'] = $row->itemName;
                $nestedData['itemCategory'] = $row->itemCategory;
                $nestedData['purchasePrice'] = $row->purchasePrice;
                $nestedData['salePrice'] = $row->salePrice;
                $nestedData['discount'] = $row->discount;
                $nestedData['itemTags'] = $row->itemTags;

                $status = ($row->itemActive) ? 'Active' : 'Deactive';
                $checked = ($row->itemActive) ? 'checked' : '';
                $status = '<div class="form-check form-switch">
                            <input type="checkbox" data-itemsId="'.$row->itemsId.'" class="form-check-input" id="itemActive" '. $checked .'>
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
        $itemCategory = $this->request->getVar('itemCategory');
        $purchasePrice = $this->request->getVar('purchasePrice');
        $salePrice = $this->request->getVar('salePrice');
        $discount = $this->request->getVar('discount');

        $data = array(
            'itemName' => $itemName,
            'itemCategory' => $itemCategory,
            'purchasePrice' => $purchasePrice,
            'salePrice' => $salePrice,
            'discount' => $discount,
        );

        if ($type == 'add') {
            $item_exist = $this->Commonmodel->Duplicate_check(array('itemName' => $itemName), 'saimtech_items');
            $data['created_by'] = $_SESSION['user_id'];
            if (!$item_exist) {
                $this->Commonmodel->insert_record($data, 'saimtech_items');
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
}