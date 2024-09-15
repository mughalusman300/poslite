<?php
namespace App\Models;
use CodeIgniter\Model;
class Salesmodel extends Model {

    public function __construct() { 
        parent::__construct(); 
        $this->db = \Config\Database::connect();  
    }
    public function salesCountByDate($start_date, $end_date){  
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';
        $builder = $this->db->table('saimtech_sales');
        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);
        $query = $builder->get(); 
        // ddd($this->db->getLastQuery()->getQuery());
        return $query->getNumRows();  
    }

    public function getSalesByDate($start_date, $end_date, $limit,$start) {
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';
        if ($limit == -1){
            $limit = 12546464646464646;
        }

        // ddd($end_date);
        $builder = $this->db->table('saimtech_sales');
        $builder->select('saimtech_sales.sale_id,invoice_code, invoice_date, sum(discount) as invoice_discount, sum(net_price) as invoice_net, sum(net_price+discount) as invoice_total, payment_mode, is_return_all');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);

        $builder->limit($limit,$start);

        $builder->groupBy('invoice_code');
        $query = $builder->get(); 

        // ddd($this->db->getLastQuery()->getQuery());
        return $query->getResult();  
    }

    public function getSalesByDate_search($start_date, $end_date, $limit,$start,$search){
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';

        if ($limit == -1){
            $limit = 12546464646464646;
        }

        $builder = $this->db->table('saimtech_sales');
        $builder->select('saimtech_sales.sale_id,invoice_code, invoice_date, sum(discount) as invoice_discount, sum(net_price) as invoice_net, sum(net_price+discount) as invoice_total, payment_mode, is_return_all');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);

        $builder->groupStart();
            $builder->like('invoice_code', $search);
            $builder->orLike('invoice_date', $search);
        $builder->groupEnd();   

        $builder->limit($limit,$start);

        $builder->groupBy('invoice_code');
        $query = $builder->get(); 
    
        return $query->getResult();
    }
    public function getSalesByDate_search_count($start_date, $end_date, $search){
        $start_date = $start_date .' 00:00:00';
        $end_date = $end_date .' 23:59:59';

        $builder = $this->db->table('saimtech_sales');
        $builder->select('saimtech_sales.sale_id,invoice_code, invoice_date, sum(discount) as invoice_discount, sum(net_price) as invoice_net, sum(net_price+discount) as invoice_total, payment_mode, is_return_all');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->where('invoice_date >=', $start_date);
        $builder->where('invoice_date <=', $end_date);

        $builder->groupStart();
            $builder->like('invoice_code', $search);
            $builder->orLike('invoice_date', $search);
        $builder->groupEnd();   

        $builder->groupBy('invoice_code');
        $query = $builder->get(); 
    
        return $query->getNumRows();
    }

    public function getInvoiceDetail($invoice_code) {

        $builder = $this->db->table('saimtech_sales');
        $builder->select('saimtech_sales.invoice_date, saimtech_sales.payment_mode, invoice_code, invoice_date, sale_trans_id, item_id, item_name, price, sum(quantity) as quantity, sum(discount) as discount, sum(net_price) as net_price');

        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->where('invoice_code', $invoice_code);

        $builder->groupBy('item_name');
        $builder->groupBy('price');
        $query = $builder->get();

        return $query->getResult();   

    }
}