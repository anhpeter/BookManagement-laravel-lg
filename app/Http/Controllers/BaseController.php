<?php

namespace App\Http\Controllers;

use App\Common\Helper\Message;
use App\Common\Helper\MyHelper;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $pageParams = [
        'pagination' => [
            'itemsPerPage' => 10,
            'pageRange' => 3,
        ],
    ];
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

    protected function handleSaveResult($affected = 1, $successMessage = null)
    {
        if ($affected > 0 || $affected == true)
            return Redirect()->back()->with([
                'type' => 'success',
                'message' => $successMessage ?? Message::$saved, 'status' => 'success',
            ]);
        else
            return redirect()->back()->with([
                'type' => 'dark',
                'message' => Message::$noChanges
            ])->withInput();
    }

    protected function isSaveSuccess()
    {
        return session('status') === 'success';
    }

    public function updateStatus($id, $value)
    {
        $field = 'status';
        $affectedRows = $this->mainModel->updateFieldById($id, $field, $value);
        return $this->handleSaveResult($affectedRows, sprintf(Message::$fieldUpdated, ucfirst($field)));
    }

    public function anyChange($item, $formItem)
    {
        $itemArr = MyHelper::convertStdClassToArray($item);
        $diff = array_diff_assoc($formItem, $itemArr);
        return !empty($diff);
    }
}
