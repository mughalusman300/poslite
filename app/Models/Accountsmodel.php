<?php
namespace App\Models;
use CodeIgniter\Model;
class Accountsmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }

    public function all_account_count(){  
        $builder = $this->db->table('saimtech_accounts');
        $query = $builder->get(); 
        return $query->getNumRows();  
    }

    public function all_account($limit, $start){  
        $builder = $this->db->table('saimtech_accounts'); 
        $builder->select('saimtech_accounts.*');
        $builder->select('saimtech_party.name as party_name');

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.account_id', 'inner');

        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_accounts.account_id',"desc");
        $query = $builder->get();  
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function account_search_count($search){
        $builder = $this->db->table('saimtech_accounts'); 
        $builder->select('saimtech_accounts.*');
        $builder->select('saimtech_party.name as party_name');

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.account_id', 'inner');


        $builder->groupStart();
            $builder->like('account_name', $search);
            $builder->orLike('type', $search);
            $builder->orLike('party.name', $search);
        $builder->groupEnd();

        $query = $builder->get();
    
        return $query->getNumRows();
    }

    public function account_search($limit,$start,$search){
        if ($limit == -1) {
            $limit = 12546464646464646;
        }
        $builder = $this->db->table('saimtech_accounts'); 
        $builder->select('saimtech_accounts.*');
        $builder->select('saimtech_party.name as party_name');

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.account_id', 'inner');


        $builder->groupStart();
            $builder->like('account_name', $search);
            $builder->orLike('type', $search);
            $builder->orLike('party.name', $search);
        $builder->groupEnd();

        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_accounts.account_id',"desc");
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

}