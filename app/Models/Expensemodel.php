<?php
namespace App\Models;
use CodeIgniter\Model;
class Expensemodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_expense_count(){  
        $builder = $this->db->table('saimtech_expense');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_expense($limit,$start){  
        $builder = $this->db->table('saimtech_expense'); 
        $builder->select('saimtech_expense.*');
        $builder->select('saimtech_users.created_by, saimtech_users.name');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_expense.created_by');
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function expense_search_count($search){
        $builder = $this->db->table('saimtech_expense');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_expense.created_by');
        $builder->like('name', $search);
        $builder->orLike('month_year', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function expense_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_expense');
        $builder->select('saimtech_expense.*');
        $builder->select('saimtech_users.created_by, saimtech_users.name');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_expense.created_by');
        $builder->like('name', $search);
        $builder->orLike('month_year', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function all_header_count(){  
        $builder = $this->db->table('saimtech_expense_header');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_header($limit,$start){  
        $builder = $this->db->table('saimtech_expense_header'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function header_search_count($search){
        $builder = $this->db->table('saimtech_expense_header');
        $builder->like('name', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function header_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_expense_header');
        $builder->like('name', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function all_mode_count(){  
        $builder = $this->db->table('saimtech_payment_mode');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_mode($limit,$start){  
        $builder = $this->db->table('saimtech_payment_mode'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function mode_search_count($search){
        $builder = $this->db->table('saimtech_payment_mode');
        $builder->like('name', $search);
        $builder->orLike('payment_type', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function mode_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_payment_mode');
        $builder->like('name', $search);
        $builder->orLike('payment_type', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function all_party_count(){  
        $builder = $this->db->table('saimtech_party');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_party($limit,$start){  
        $builder = $this->db->table('saimtech_party'); 
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        // $this->db->order_by('category_id',"asc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function party_search_count($search){
        $builder = $this->db->table('saimtech_party');
        $builder->like('name', $search);
        $builder->orLike('contact', $search);
        $builder->orLike('party_type', $search);

       $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function party_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_party');
        $builder->orLike('contact', $search);
        $builder->orLike('party_type', $search);

        $builder->limit($limit,$start);
        // $builder->order_by('category_id',"asc")
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_expense_by_id($expense_id) {
        $builder = $this->db->table('saimtech_expense'); 
        $builder->select('saimtech_expense.month_year,saimtech_expense.total, saimtech_expense.desc'); 
        $builder->select('saimtech_expense_detail.*'); 
        $builder->select('saimtech_users.name as approved_by_user');
        $builder->join('saimtech_expense_detail', 'saimtech_expense_detail.expense_id = saimtech_expense.id');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_expense_detail.approved_by', 'left');
        $builder->where('expense_id', $expense_id);
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }
    public function get_pending_expense($expense_id) {
        $builder = $this->db->table('saimtech_expense_detail');
        $builder->where('expense_id', $expense_id); 
        $builder->where('is_approved', 'p'); 
        $query = $builder->get();  
        return $query->getNumRows(); 
    }
    public function get_total_expense($expense_id) {
        $builder = $this->db->table('saimtech_expense_detail');
        $builder->where('expense_id', $expense_id); 
        $query = $builder->get();  
        return $query->getNumRows(); 
    }


}