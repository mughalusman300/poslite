<?php

namespace App\Libraries;

use App\Libraries\fpdf\Fpdf;

class FpdfLib extends Fpdf
{
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
}