<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Dashboardmodel;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Dashboardmodel = new Dashboardmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Dashboard';    
        $data['dashboard_active'] = 'active';    
        $data['error'] = '';    
    	$data['main_content'] = 'dashboard';

        $data['account'] = $this->Dashboardmodel->account();
        // ddd($data['account']);

        $data['items'] = $this->Commonmodel->getRows(array('returnType' => 'count', 'conditions' => array('itemsId >' => 0 )), 'saimtech_items');

        $data['sale'] = $this->Dashboardmodel->get_sale();
        $data['sale_comaprision'] = $this->Dashboardmodel->sale_comaprision();
        $data['best_sell_items'] = $this->Dashboardmodel->best_sell_items();
        $data['payment_modes_trans'] = $this->Dashboardmodel->get_payment_modes_trans();
        // ddd($data['payment_modes_trans']);

        return view('layouts/page',$data);
    }

    public function get_weekly_sales() {

        // Fetch sales data from the model
        $sales_data = $this->Dashboardmodel->get_weekly_sales();
        
        // Return the data as JSON
        echo json_encode($sales_data);
    }

    public function search() {
        $search = $this->request->getVar('search');
        if ($search) {
            if (stripos($search, 'item') !== false || stripos($search, 'items') !== false) {
                return redirect()->to('/item');
            } else if(stripos($search, 'dashboard') !== false) {
                return redirect()->to('/dashboard');
            } else if(stripos($search, 'dashboard') !== false) {
                return redirect()->to('/dashboard');
            }
        }
    }

    // public function suggestions() {
    //         $query = $this->request->getGet('q'); // Get the search query
    //         // ddd($query);
    //         $results = []; // Fetch data from your database or source

    //         // Example: Query your database (adjust as needed)
    //         if ($query) {
    //             $db = \Config\Database::connect();
    //             $builder = $db->table('menu_links');
    //             $builder->like('name', $query);
    //             $queryResult = $builder->get();

    //             foreach ($queryResult->getResult() as $row) {
    //                 $results[] = ['name' => $row->name, 'url' => URL.$row->url ]; // Adjust the structure as needed
    //             }
    //         }

    //         return $this->response->setJSON($results);
    // }

    public function suggestions() {
        $query = $this->request->getGet('q'); // Get the search query
        $results = []; // Initialize results array

        $db = \Config\Database::connect();
        $builder = $db->table('menu_links');

        // Check if the query exists, otherwise fetch all records
        if ($query) {
            $builder->like('name', $query);
        }

        $queryResult = $builder->get();

        foreach ($queryResult->getResult() as $row) {
            $results[] = ['name' => $row->name, 'url' => URL . $row->url]; // Adjust the structure as needed
        }

        return $this->response->setJSON($results);
    }

}