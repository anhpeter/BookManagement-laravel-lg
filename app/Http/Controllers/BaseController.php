<?php

namespace App\Http\Controllers;


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

    protected function getViewParams()
    {
        return ['controller' => $this->controller];
    }

    protected function handleSaveResult($affected)
    {
        if ($affected >0) return Redirect()->back()->with(['message' => 'Save successfully!', 'status' => 'success']);
        else return redirect()->back()->with(['message' => 'No thing to change!'])->withInput();
    }

    protected function isSaveSuccess()
    {
        return session('status') === 'success';
    }
}
