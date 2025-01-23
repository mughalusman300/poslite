<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        $session->set('redirect_url', current_url());
        
        if (!isset($_SESSION['user_id'])){
        	return redirect()->to('/Login');
        }
        if (isset($_SESSION['permissions']) && !empty($_SESSION['permissions'])) {
            $permissions = $_SESSION['permissions'];
            $router = service('router');
                       
            // Get the current controller and method
            $controllerFullName = $router->controllerName();

            $controller = strtolower(substr(strrchr($controllerFullName, "\\"), 1));
            if ($controller == 'item' || $controller == 'dashboard' || $controller == 'sales' || $controller == 'expense' || $controller == 'category' || $controller == 'accounts' || $controller == 'payable' || $controller == 'receivable' || $controller == 'pnl') {
                if(!in_array('view_'.$controller, $permissions)) {
                    // print_r($permissions);die;
                    return redirect()->to('/unauthorized');
                }
            } else if($controller == 'report') {
                if(!in_array('view_sale_report', $permissions)) {
                    // print_r($permissions);die;
                    return redirect()->to('/unauthorized');
                }
            } else if($controller == 'users') {
                if(!in_array('view_system_administration', $permissions)) {
                    // print_r($permissions);die;
                    return redirect()->to('/unauthorized');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}