<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

abstract class BaseController extends Controller
{
    protected $controller;
    protected $mainModel;

    function __construct($controller, $mainModel)
    {
        $this->controller = $controller;
        $this->mainModel = $mainModel;
        view()->share('controller', $this->controller);
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
        if ($affected > 0 || $affected == true) return Redirect()->back()->with(['message' => 'Save successfully!', 'status' => 'success']);
        else return redirect()->back()->with(['message' => 'No thing to change!'])->withInput();
    }

    protected function isSaveSuccess()
    {
        return session('status') === 'success';
    }

    public function updateStatus(Request $request, $id, $value)
    {
        $field = 'status';
        $this->mainModel->updateFieldById($id, $field, $value);
        return redirect()->back();
    }
}
