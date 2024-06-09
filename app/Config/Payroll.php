<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Payroll extends BaseConfig
{
    public $employeeattendance = array(
    'present' => 1,
    'half_day' => 4,
    'late' => 2,
    'absent' => 3,
    'holiday' => 5
     );
    public $payroll_status = array(
    'generated' => 'Generated',
    'paid' => 'Paid',
    'unpaid' => 'Unpaid',
    'not_generate' => 'Not Generated',
     );
    public $payment_mode = array(
    'cash' => 'Cash',
    'cheque' => 'Cheque',
    'online' => 'Transfer to Bank Account',
     );
}




