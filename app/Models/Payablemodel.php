<?php
namespace App\Models;
use CodeIgniter\Model;
class Payablemodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_payable_count($status){  
        $builder = $this->db->table('saimtech_payable');
        $builder->where('status', $status);
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_payable($limit, $start, $status){  
        $builder = $this->db->table('saimtech_payable'); 
        $builder->select('saimtech_payable.*');
        $builder->select('saimtech_accounts.account_name');
		$builder->select('saimtech_users.name as added_by');

        $builder->join('saimtech_accounts', 'saimtech_accounts.account_id = saimtech_payable.account_id', 'inner');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_payable.created_by', 'inner');

        $builder->where('status', $status);

        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_payable.payable_id',"desc");
        $query = $builder->get();  
        // ddd($this->db->getLastQuery()->getQuery());
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function payable_search_count($search, $status){
        $builder = $this->db->table('saimtech_payable'); 
        $builder->select('saimtech_payable.*');
        $builder->select('saimtech_accounts.account_name');
		$builder->select('saimtech_users.name as added_by');

        $builder->join('saimtech_accounts', 'saimtech_accounts.account_id = saimtech_payable.account_id', 'inner');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_payable.created_by', 'inner');



        $builder->groupStart();
            $builder->like('saimtech_accounts.account_name', $search);
            $builder->orLike('saimtech_payable.amount', $search);
            $builder->orLike('saimtech_payable.payable_desc', $search);
            $builder->orLike('saimtech_users.name', $search);
        $builder->groupEnd();

        $builder->where('status', $status);

        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function payable_search($limit,$start,$search, $status){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }
        $builder = $this->db->table('saimtech_payable'); 
		$builder->select('saimtech_payable.*');
		$builder->select('saimtech_accounts.account_name');
		$builder->select('saimtech_users.name as added_by');

		$builder->join('saimtech_accounts', 'saimtech_accounts.account_id = saimtech_payable.account_id', 'inner');
		$builder->join('saimtech_users', 'saimtech_users.id = saimtech_payable.created_by', 'inner');



        $builder->groupStart();
            $builder->like('saimtech_accounts.account_name', $search);
            $builder->orLike('saimtech_payable.amount', $search);
            $builder->orLike('saimtech_payable.payable_desc', $search);
            $builder->orLike('saimtech_users.name', $search);
        $builder->groupEnd();

        $builder->where('status', $status);

        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_payable.payable_id',"desc");
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function get_payable_by_id($payable_id) {
        $builder = $this->db->table('saimtech_payable'); 
        $builder->select('saimtech_payable.*');
        $builder->select('saimtech_accounts.account_name');
		$builder->select('saimtech_users.name as added_by');

        $builder->join('saimtech_accounts', 'saimtech_accounts.account_id = saimtech_payable.account_id', 'inner');
        $builder->join('saimtech_users', 'saimtech_users.id = saimtech_payable.created_by', 'inner');

        $builder->where('payable_id', $payable_id);
        $query = $builder->get();
        
        $result = ($query->getNumRows() > 0) ? $query->getRow() : FALSE;
        return $result; 
    }

    public function get_paid($payable_id) {
        $builder = $this->db->table('saimtech_payable_detail'); 


        $builder->where('payable_id', $payable_id);
        $query = $builder->get();
        
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

}