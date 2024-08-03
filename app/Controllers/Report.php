<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use App\Models\Reportmodel;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class Report extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
        $this->Commonmodel = new Commonmodel();
	    $this->Reportmodel = new Reportmodel();
	    $session = \Config\Services::session();
        helper('custom_helper');
    }

    public function sale_report_by_date(){
        $data['title'] = 'Sale Report By date';
        $start_date = $end_date = $report_data =  '';
        if (isset($_POST) && !empty($_POST)) {
            $start_date = $this->request->getVar('start_date');
            $end_date = $this->request->getVar('end_date');
            $report_data = $this->Reportmodel->getSalesReportByDate($start_date, $end_date);
            // ddd($report_data);
            $data['report_data'] = $report_data;
        }
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['main_content'] = 'report/sale_report_by_date';
        return view('layouts/page',$data);
    }

    public function sale_report_by_date_detail($date){
        $data['title'] = 'Sale Report By date detail';
        $report_data = $this->Reportmodel->getSalesReportByDateDetail($date);
        $data['report_data'] = $report_data;
        $data['main_content'] = 'report/sale_report_by_date_detail';
        return view('layouts/page',$data);
    }

    public function sale_report_by_category(){
        $data['title'] = 'Sale Report By Category';
        $start_date = $end_date = $report_data =  '';
        if (isset($_POST) && !empty($_POST)) {
            $start_date = $this->request->getVar('start_date');
            $end_date = $this->request->getVar('end_date');
            $report_data = $this->Reportmodel->getSalesReportByDate($start_date, $end_date);
            // ddd($report_data);
            $data['report_data'] = $report_data;
        }
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['main_content'] = 'report/sale_report_by_category';
        return view('layouts/page',$data);
    }
    public function sale_report_by_payment(){
        $data['title'] = 'Sale Report By Payment';
        $start_date = $end_date = $report_data =  '';
        if (isset($_POST) && !empty($_POST)) {
            $start_date = $this->request->getVar('start_date');
            $end_date = $this->request->getVar('end_date');
            $report_data = $this->Reportmodel->getSalesReportByDate($start_date, $end_date);
            // ddd($report_data);
            $data['report_data'] = $report_data;
        }
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['main_content'] = 'report/sale_report_by_payment';
        return view('layouts/page',$data);
    }

    public function test() {
        $detail = $this->Reportmodel->getSalesReportByCategory('2024-06-01');
        ddd($detail);
    }
}