<?php

namespace App\Http\Controllers;

use App\Common\Helper\Message;
use App\Common\Helper\MyHelper;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $pageParams;
    protected $controller;
    protected $mainModel;

    // ABSTRACT METHODS
    public abstract function runValidate(Request $request, $id = null);
    //

    function __construct($controller, $mainModel)
    {
        $this->controller = $controller;
        $this->mainModel = $mainModel;
        view()->share('controller', $this->controller);
    }

    protected function getTableName()
    {
        return MyHelper::toPlural($this->controller);
    }

    protected function getViewParams()
    {
        return ['controller' => $this->controller];
    }

    protected function handleSaveResult($affected)
    {
        if ($affected > 0 || $affected == true) return Redirect()->back()->with(['message' => Message::$saved, 'status' => 'success']);
        else return redirect()->back()->with(['message' => Message::$noChanges])->withInput();
    }

    protected function isSaveSuccess()
    {
        return session('status') === 'success';
    }

    public function updateStatus($id, $value)
    {
        $field = 'status';
        $this->mainModel->updateFieldById($id, $field, $value);
        return redirect()->back()->with(['message' => sprintf(Message::$fieldUpdated, ucfirst($field))]);
    }
}
