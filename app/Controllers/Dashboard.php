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
        $data['error'] = '';    
    	$data['main_content'] = 'dashboard';

        $data['items'] = $this->Commonmodel->getRows(array('returnType' => 'count', 'conditions' => array('itemsId >' => 0 )), 'saimtech_items');

        $data['sale'] = $this->Dashboardmodel->get_sale();
        $data['sale_comaprision'] = $this->Dashboardmodel->sale_comaprision();
        $data['best_sell_items'] = $this->Dashboardmodel->best_sell_items();
        $data['payment_modes_trans'] = $this->Dashboardmodel->get_payment_modes_trans();
        // ddd($data['payment_modes_trans']);

        return view('layouts/page',$data);
    }
}