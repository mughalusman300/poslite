<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * ------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index',['filter' => 'noauth']);
$routes->get('my',  'Api::myview');
$routes->get('d2m', 'Api::server_to_mob');
$routes->get('m2d', 'Api::mob_to_server');
$routes->get('m2u', 'Api::update');

////////////Users Routes////////////////////////
$routes->get('users', 'User::index',['filter' => 'Permission']);
$routes->post('create', 'User::store');
$routes->post('User/update/(:id)', 'User::update/$1');
$routes->post('create', 'User::store');
$routes->get('searchUser', 'User::search');

////////////Allowances Routes////////////////////////
$routes->post('createAllowance', 'Allowances::store');
$routes->post('updateAllowance/(:num)', 'Allowances::update/$1');
$routes->get('searchAllow', 'Allowances::search');

////////////Payroll Routes////////////////////////
$routes->get('payrolldetail/(:num)', 'Payroll::detail/$1');
$routes->get('getPayrollByEmpID/(:num)', 'Payroll::getPayrollByEmpID/$1');
$routes->post('createPayroll/(:num)', 'Payroll::store/$1');
////////////Payroll Allowances and Deductions Methods Routes////////////////////////
$routes->get('salaryallowances/(:num)', 'Payroll::getSalaryAllowances/$1');
$routes->get('salarydeductions/(:num)', 'Payroll::getSalaryDeductions/$1');
$routes->post('createsalaryallowance', 'Payroll::createSalaryAllowance');
$routes->delete('deletesalaryallowance/(:num)', 'Payroll::deleteSalaryAllowance/$1');

$routes->get('addemployee', 'Employee::add');
$routes->get('detail/(:num)', 'Employee::detail/$1');
$routes->get('update/(:num)', 'Employee::updateview/$1');
$routes->get('getAllEmployees', 'Employee::getAllEmployees');

$routes->get('getEmployee/(:num)', 'Employee::getEmployee/$1');
$routes->post('updateEmployee', 'Employee::updateEmployee');
$routes->get('search', 'Employee::search');
$routes->get('employee', 'Employee::index');
$routes->post('updateStatus/(:num)', 'Employee::updateEmployeeStatus/$1');

////////////////Document Routes///////////////////////
$routes->get('doc', 'Document::index');
$routes->delete('deletedocument/(:num)', 'Document::deleteDocument/$1');
$routes->get('searchDeocument', 'Document::search');

////////////////Departments Routes///////////////////////
$routes->get('dep', 'Department::index');
$routes->get('dep/getAllDepartments', 'Department::getAllDepartments');
$routes->post('createDepartment', 'Department::store');
$routes->get('searchDepartment', 'Department::search');

////////////////Designation Routes///////////////////////
$routes->get('des', 'Designation::index');
$routes->get('des/getAllDesignations', 'Designation::getAllDesignations');
$routes->post('createDesignation', 'Designation::store');
$routes->get('searchDesignation', 'Designation::search');

////////////////Noauthorized Routes///////////////////////
$routes->get('/unauthorized', 'User::unauthorized');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
