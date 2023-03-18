<?php

namespace App\Controllers;

use App\Contracts\Controller as ContractsController;

abstract class Controller implements ContractsController
{
    public function __construct()
    {
        //
    }
}
