<?php
 namespace App\Models;
 use CodeIgniter\Model;
 class Dashboardmodel extends Model {

     public function __construct() { 
         parent::__construct(); 
         $this->db = \Config\Database::connect();  
     }

     public function all_categories_count(){  
         $builder = $this->db->table('saimtech_category');
         $query = $builder->get(); 
         return $query->getNumRows();  
     }

    public function get_sale(){  
        $query = $this->db->query("SELECT SUM(net_price) AS total_sale 
                                    FROM saimtech_saletrans 
                                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");

		$result = ($query->getNumRows() > 0) ? $query->getRow()->total_sale : FALSE;
		return $result;

    }

    public function sale_comaprision(){  
        // Query for the recent 30 days sales
        $query1 = $this->db->query("SELECT SUM(net_price) AS total_sale 
                                    FROM saimtech_saletrans 
                                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
        $recent_30_days_sales = ($query1->getNumRows() > 0) ? $query1->getRow()->total_sale : 0;

        // Query for the previous 30 days sales (30-60 days ago)
        $query2 = $this->db->query("SELECT SUM(net_price) AS total_sale 
                                    FROM saimtech_saletrans 
                                    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 60 DAY) 
                                      AND created_at < DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
        $previous_30_days_sales = ($query2->getNumRows() > 0) ? $query2->getRow()->total_sale : 0;

        // Calculate the percentage difference
        if ($previous_30_days_sales > 0) {
            $percentage_change = (($recent_30_days_sales - $previous_30_days_sales) / $previous_30_days_sales) * 100;
        } else {
            // If the previous period's sales are zero, we handle it as a 100% increase or 0 depending on your preference.
            $percentage_change = $recent_30_days_sales > 0 ? 100 : 0;
        }

        // Format the result with a plus or minus sign
        $formatted_change = ($percentage_change >= 0 ? '+' : '') . number_format($percentage_change, 2) . '%';

        // Output the result
        return $formatted_change;


    }

    public function best_sell_items(){  
        $query = $this->db->query("SELECT saimtech_items.itemName, img, itemCategory, salePrice,  SUM(saimtech_saletrans.quantity) AS total_quantity_sold
			FROM saimtech_items
			JOIN saimtech_saletrans ON saimtech_saletrans.item_id = saimtech_items.itemsId
			WHERE saimtech_saletrans.created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
			GROUP BY saimtech_items.itemsId
			ORDER BY total_quantity_sold DESC
			LIMIT 5;");

		$result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
		return $result;
    }

        public function get_payment_modes_trans(){  
            $query = $this->db->query("SELECT saimtech_payment_mode.payment_type,
					       COALESCE(SUM(saimtech_saletrans.net_price), 0) AS total_net_price, saimtech_payment_mode.img
					FROM saimtech_payment_mode
					LEFT JOIN saimtech_sales ON saimtech_sales.payment_mode = saimtech_payment_mode.payment_type
					LEFT JOIN saimtech_saletrans ON saimtech_saletrans.sale_id = saimtech_sales.sale_id 
					                             AND saimtech_saletrans.created_at >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
					GROUP BY saimtech_payment_mode.payment_type");

    		$result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
    		return $result;

        }

 }