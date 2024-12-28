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
                                    JOIN saimtech_sales ON saimtech_sales.sale_id = saimtech_saletrans.sale_id
                                    WHERE invoice_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");

		$result = ($query->getNumRows() > 0) ? $query->getRow()->total_sale : FALSE;
		return $result;

    }

    public function sale_comaprision(){  
        // Query for the recent 30 days sales
        $query1 = $this->db->query("SELECT SUM(net_price) AS total_sale 
                                    FROM saimtech_saletrans 
                                    JOIN saimtech_sales ON saimtech_sales.sale_id = saimtech_saletrans.sale_id
                                    WHERE invoice_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
        $recent_30_days_sales = ($query1->getNumRows() > 0) ? $query1->getRow()->total_sale : 0;

        // Query for the previous 30 days sales (30-60 days ago)
        $query2 = $this->db->query("SELECT SUM(net_price) AS total_sale 
                                    FROM saimtech_saletrans 
                                    JOIN saimtech_sales ON saimtech_sales.sale_id = saimtech_saletrans.sale_id
                                    WHERE invoice_date >= DATE_SUB(CURDATE(), INTERVAL 60 DAY) 
                                      AND invoice_date < DATE_SUB(CURDATE(), INTERVAL 30 DAY)");
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
            JOIN saimtech_sales ON saimtech_sales.sale_id = saimtech_saletrans.sale_id
			WHERE saimtech_sales.invoice_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
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
					                             AND saimtech_sales.invoice_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
					GROUP BY saimtech_payment_mode.payment_type");

    		$result = ($query->getNumRows() > 0) ? $query->getResult() : FALSE;
    		return $result;

        }

    public function get_weekly_sales() {
        // Get the last 7 days before today
      // ddd($_GET['end_date']);
        $dates = [];
        for ($i = 7; $i >= 1; $i--) { // Start from 7 and go to 1 to exclude the current date
            // $dates[] = date('d M', strtotime("-$i days"));
            $dates[] = date('d M', strtotime($_GET['end_date'] . " -$i days"));
        }

        // Fetch sales data for the last 7 days (excluding today)
        // $last_week = date('Y-m-d', strtotime('-7 days')); // Start date (7 days ago)
        // $yesterday = date('Y-m-d', strtotime('-1 days')); // End date (yesterday)
        $last_week = date('Y-m-d', strtotime($_GET['end_date'] . ' -7 day'));
        $yesterday = date('Y-m-d', strtotime($_GET['end_date'] . ' -1 day'));

        $query = $this->db->table('saimtech_saletrans')
                          ->select("DATE_FORMAT(invoice_date, '%d %b') as date, SUM(net_price) as total_sales")
                          ->join('saimtech_sales', 'saimtech_sales.sale_id = saimtech_saletrans.sale_id', 'inner')
                          ->where('DATE(invoice_date) >=', $last_week) // Start from 7 days ago
                          ->where('DATE(invoice_date) <=', $yesterday) // Exclude today
                          ->groupBy('DATE(invoice_date)')
                          ->orderBy('DATE(invoice_date)', 'ASC')
                          ->get();

        $sales_data = $query->getResultArray();

        // Map the sales data by date
        $sales_by_date = [];
        foreach ($sales_data as $sale) {
            $sales_by_date[$sale['date']] = $sale['total_sales'];
        }

        // Fill in missing dates with 0 sales
        $weekly_sales = [];
        foreach ($dates as $date) {
            $weekly_sales[] = [
                'date' => $date,
                'total_sales' => $sales_by_date[$date] ?? 0 // Use 0 if the date is missing
            ];
        }

        return $weekly_sales;
    }



 }