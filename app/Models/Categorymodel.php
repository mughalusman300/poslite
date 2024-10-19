<?php
namespace App\Models;
use CodeIgniter\Model;
class Categorymodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_categories_count(){  
        $builder = $this->db->table('saimtech_category');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_categories($limit,$start){  
        $builder = $this->db->table('saimtech_category'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function categories_search_count($search){
        $builder = $this->db->table('saimtech_category');
        $builder->like('title', $search);
        $builder->orLike('code', $search);
        $builder->orLike('desc', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function categories_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_category');
        $builder->like('title', $search);
        $builder->orLike('code', $search);
        $builder->orLike('desc', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_categories(){  
        $builder = $this->db->table('saimtech_category'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }


}