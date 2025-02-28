<?php

namespace App\Controllers;
use App\Models\Commonmodel;
use CodeIgniter\API\ResponseTrait;

class Login extends BaseController
{
    use ResponseTrait;    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
	    parent::initController($request, $response, $logger);
	    $this->Commonmodel = new Commonmodel();
	    $session = \Config\Services::session();
    }
    public function index(){
    	$data['error'] = '';	
        return view('users/loginView',$data);
    }

    public function login_process(){
    	$email       =  $this->request->getVar('email');
    	$password       =  $this->request->getVar('password');
    	$data['error'] = '';

    	if ($email != "" && $password != "") {
    		$user = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('name' => $email, 'is_enable' => 1)), 'saimtech_users');

    		if (!$user) {
    			$user = $this->Commonmodel->getRows(array('returnType' => 'single', 'conditions' => array('email' => $email, 'is_enable' => 1)), 'saimtech_users');
    		}

    	    if ($user) {
    			if ($user->password == md5($password)) {
    				$_SESSION['user_id']    = $user->id;
    				$_SESSION['user_name']  = $user->name;
                    $_SESSION['user_power']  = $user->power;
    				$_SESSION['permissions'] = $permissions  = (!empty($user->permissions)) ? (explode(',', $user->permissions)): '';
                    // ddd($_SESSION);
                    if(isset($_SESSION['redirect_url'])) {
                        $redirect_url = $_SESSION['redirect_url'];
                        unset($_SESSION['redirect_url']);
                        return redirect()->to($redirect_url);
                    }
                    if (in_array('view_dashboard', $permissions)) {
        				return redirect()->to('/dashboard'); 
                    } else {
                        return redirect()->to('/item');
                    }
    			} else {
    				$data['error'] ='Invalid password';
    		        return view('users/loginView',$data);
    			}    
    		} else {
    	        $data['error'] ='Invalid Email';
    	        return view('users/loginView',$data);
    		}
    	} else {
    		$data['error'] ='Please enter the Email and Password Correctly';
    	    return view('users/loginView',$data);    
    	}
    }

    public function logout(){
    	$data['error'] ='';	
    	session_destroy();
    	return redirect()->to('/');
    } 
    public function unauthorized(){
        $data['title'] = 'unauthorized';

        $data['main_content'] = 'unauthorized';
        return view('layouts/page',$data);
    }
}