<?php
namespace App\Models;
use CodeIgniter\Model;
class Inventorymodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_inv_count(){  
        $builder = $this->db->table('saimtech_inventory');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_inv($limit, $start){  
        $builder = $this->db->table('saimtech_inventory'); 
        $builder->select('saimtech_inventory.*');

        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function inv_search_count($search){
        $builder = $this->db->table('saimtech_inventory'); 
        $builder->select('saimtech_inventory.*');


        $builder->groupStart();
            $builder->like('inventory_code', $search);
            $builder->orLike('inventory_date', $search);
        $builder->groupEnd();

        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function inv_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }
        $builder = $this->db->table('saimtech_inventory'); 
        $builder->select('saimtech_inventory.*');


        $builder->groupStart();
            $builder->like('inventory_code', $search);
            $builder->orLike('inventory_date', $search);
        $builder->groupEnd();

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function all_inv_detail_count($item_id){  
        $builder = $this->db->table('saimtech_inventory_detail');
        $builder->where('item_id', $item_id);
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_inv_detail($item_id, $limit, $start){  
        $builder = $this->db->table('saimtech_inventory_detail'); 
        $builder->select('saimtech_inventory_detail.*');
        $builder->select('saimtech_inventory.inventory_code');

        $builder->join('saimtech_inventory', 'saimtech_inventory_detail.inventory_id = saimtech_inventory.inventory_id', 'inner');
        $builder->where('item_id', $item_id);

        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function inv_detail_search_count($item_id, $search){
        $builder = $this->db->table('saimtech_inventory_detail'); 

        $builder->select('saimtech_inventory_detail.*');
        $builder->select('saimtech_inventory.inventory_code');

        $builder->join('saimtech_inventory', 'saimtech_inventory_detail.inventory_id = saimtech_inventory.inventory_id', 'inner');

        $builder->where('item_id', $item_id);

        $builder->groupStart();
            $builder->like('inventory_code', $search);
            $builder->like('purchase_price', $search);
            $builder->orLike('sale_price', $search);
        $builder->groupEnd();

        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function inv_detail_search($item_id, $limit,$start,$search) {
        if ($limit == -1) {
            $limit = 12546464646464646;
        }
        $builder = $this->db->table('saimtech_inventory_detail');
        $builder->select('saimtech_inventory.inventory_code');

        $builder->join('saimtech_inventory', 'saimtech_inventory_detail.inventory_id = saimtech_inventory.inventory_id', 'inner');
        
        $builder->select('saimtech_inventory_detail.*');
        $builder->where('item_id', $item_id);

        $builder->groupStart();
            $builder->like('inventory_code', $search);
            $builder->like('purchase_price', $search);
            $builder->orLike('sale_price', $search);
        $builder->groupEnd();

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
        $query = $builder->get();
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function getProductVariants($product_id) {
        $response = array('v1' => '', 'v2' => '', 'v3' => '');
        $builder = $this->db->table('saimtech_product'); 
        $builder->where('product_id', $product_id);

        $query = $builder->get();
        $row = ($query->getNumRows() > 0) ? $query->getRow() : FALSE;
        if ($row) {
            $response['v1'] = $row->v1;
            $response['v2'] = $row->v2;
            $response['v3'] = $row->v3;
        }

        return $response;

    }

    public function get_inv_detail($inventory_id){
        $builder = $this->db->table('saimtech_inventory_detail'); 
        $builder->join('saimtech_items', 'saimtech_items.itemsId = saimtech_inventory_detail.item_id');
        $builder->Where('inventory_id', $inventory_id);

        $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }


}