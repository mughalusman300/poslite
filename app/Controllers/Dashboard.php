<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
	    $this->Commonmodel = new Commonmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
        $data['title'] = 'Dashboard';    
        $data['error'] = '';    
    	$data['main_content'] = 'dashboard';	
        return view('layouts/page',$data);
    }
}