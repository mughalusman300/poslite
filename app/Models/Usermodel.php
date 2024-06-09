<?php
namespace App\Models;
use CodeIgniter\Model;
class Usermodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_users_count(){  
        $builder = $this->db->table('saimtech_users');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_users($limit,$start){  
        $builder = $this->db->table('saimtech_users'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function users_search_count($search){
        $builder = $this->db->table('saimtech_users');
        $builder->like('itemName', $search);
        $builder->orLike('itemCategory', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function users_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_users');
        $builder->like('itemName', $search);
        $builder->orLike('itemCategory', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_active_users(){  
        $builder = $this->db->table('saimtech_users'); 

        // $this->db->order_by('category_id',"asc");
        $builder->where('is_active', 1);
        $query = $builder->get(); 
         
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }


}