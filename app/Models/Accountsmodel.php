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

    public function all_account($limit, $start, $type = ''){  
        $builder = $this->db->table('saimtech_accounts'); 
        $builder->select('saimtech_accounts.*');
        $builder->select('saimtech_party.name as party_name');

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.party_id', 'inner');

        if ($type != '') {
            $builder->where('type', $type);
        }
        if ($limit == -1){
            $limit = 12546464646464646;
        }
        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_accounts.account_id',"desc");
        $query = $builder->get();  
        // ddd($this->db->getLastQuery()->getQuery());
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
        
    }

    public function account_search_count($search){
        $builder = $this->db->table('saimtech_accounts'); 
        $builder->select('saimtech_accounts.*');
        $builder->select('saimtech_party.name as party_name');

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.party_id', 'inner');


        $builder->groupStart();
            $builder->like('account_name', $search);
            $builder->orLike('type', $search);
            $builder->orLike('saimtech_party.name', $search);
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

        $builder->join('saimtech_party', 'saimtech_party.id = saimtech_accounts.party_id', 'inner');


        $builder->groupStart();
            $builder->like('account_name', $search);
            $builder->orLike('type', $search);
            $builder->orLike('saimtech_party.name', $search);
        $builder->groupEnd();

        $builder->limit($limit,$start);
        $builder->orderBy('saimtech_accounts.account_id',"desc");
       $query = $builder->get();
    
        $result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
        return $result; 
    }

    public function getExpenseByDate($start_date, $end_date) {

        // $start_date = '2024-01-01';
        // $end_date = '2024-12-31';

        $builder = $this->db->table('saimtech_expense');
        $builder->select('saimtech_expense_detail.*');
        $builder->join('saimtech_expense_detail', 'saimtech_expense_detail.expense_id = saimtech_expense.id', 'inner');


        $builder->where('saimtech_expense_detail.date >=', $start_date);
        $builder->where('saimtech_expense_detail.date <=', $end_date);

        $builder->where('saimtech_expense_detail.is_approved', 'y');
        $query = $builder->get(); 

        // ddd($this->db->getLastQuery()->getQuery());
        return $query->getResult();  
    }

    public function getItemSaleByDate($start_date, $end_date) {
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';

        // $start_date = '2024-01-01 00:00:00';
        // $end_date = '2024-12-31 23:59:59';

        $builder = $this->db->table('saimtech_sales');
        $builder->select('sum(purch_price * quantity) as purch_price, sum(price * quantity) as sale_price, sum(discount) as discount, sum(net_price) as net_price');

        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');

        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);
        // $builder->groupBy('DATE(invoice_date)');
        $query = $builder->get(); 
        return $query->getRow();  
    }
}