<?php
namespace App\Models;
use CodeIgniter\Model;
class Reportmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function getSalesReportByDate($start_date, $end_date) {
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';
        $builder = $this->db->table('saimtech_sales');
        $builder->select('invoice_date, sum(invoice_discount) as invoice_discount, sum(invoice_net) as invoice_net, sum(invoice_total) as invoice_total');
        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);
        $builder->groupBy('DATE(invoice_date)');
        $query = $builder->get(); 
        return $query->getResult();  
    }

    public function getSalesReportByDateDetail($date) {
        $builder = $this->db->table('saimtech_sales');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->join('saimtech_items', 'saimtech_items.itemsId = saimtech_saletrans.item_id', 'inner');
        $builder->where('DATE(invoice_date)', $date);
        $query = $builder->get();
        // ddd($this->db->getLastQuery()->getQuery()); 
        return $query->getResult();
    }
    public function all_Items_count(){  
        $builder = $this->db->table('saimtech_items');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_Items($limit,$start){  
        $builder = $this->db->table('saimtech_items'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function items_search_count($search){
        $builder = $this->db->table('saimtech_items');
        $builder->like('itemName', $search);
        $builder->orLike('itemCategory', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function items_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_items');
        $builder->like('itemName', $search);
        $builder->orLike('itemCategory', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_Items(){  
        $builder = $this->db->table('saimtech_items'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }


}