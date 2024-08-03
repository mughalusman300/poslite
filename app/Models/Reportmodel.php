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
        $builder->select('invoice_date, sum(invoice_discount) as invoice_discount, sum(invoice_net) as invoice_net, sum(invoice_total) as invoice_total, payment_mode');
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
        return $query->getResult();
    }

    public function getSalesReportByCategory($date) {
        // return $date;
        $builder = $this->db->table('saimtech_sales');
        $builder->select('itemCategory, sum(price) as price, sum(purch_price) as purch_price, sum(quantity) as quantity, sum(saimtech_saletrans.discount) as sale_discount, sum(net_price) as net_price');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->join('saimtech_items', 'saimtech_items.itemsId = saimtech_saletrans.item_id', 'inner');
        $builder->where('DATE(invoice_date)', $date);
        $builder->groupBy('itemCategory');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getSalesReportByPayment($date) {
        // return $date;
        $builder = $this->db->table('saimtech_sales');
        $builder->select('itemCategory, sum(price) as price, sum(purch_price) as purch_price, sum(quantity) as quantity, sum(saimtech_saletrans.discount) as sale_discount, sum(net_price) as net_price');
        $builder->join('saimtech_saletrans', 'saimtech_saletrans.sale_id = saimtech_sales.sale_id', 'inner');
        $builder->join('saimtech_items', 'saimtech_items.itemsId = saimtech_saletrans.item_id', 'inner');
        $builder->where('DATE(invoice_date)', $date);
        $builder->groupBy('payment_mode');
        $query = $builder->get();
        return $query->getResult();
    }

}