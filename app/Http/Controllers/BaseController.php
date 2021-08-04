<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class BaseController extends Controller
{
    protected $controller;

    function __construct($controller)
    {
        $this->controller = $controller;
    }

    protected function getTableName()
    {
        return $this->controller . 's';
    }
}
