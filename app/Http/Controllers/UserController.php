<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Models\Group;
use App\Models\Profile;
use App\Models\User as MainModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    function __construct()
    {
        parent::__construct('user', new MainModel());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->setPageParams($request);
        $items = $this->mainModel->listAll($this->pageParams);
        $countFilters = $this->mainModel->countFilters($this->pageParams);
        return view(
            'pages/' . $this->controller . '/index',
            ['items' => $items, 'controller' => $this->controller, 'pageParams' => $this->pageParams, 'countFilters' => $countFilters]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new User();
        return view(
            'pages/' . $this->controller . '/form',
            array_merge(
                $this->getFormViewParams(),
                ['formType' => 'add', 'item' => $item]
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->runValidate($request)->validate();
        $item = $this->getItemFromRequest($request);
        $savedItem = $this->mainModel->insert($item);
        return $this->handleSaveResult($savedItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->mainModel->find($id);
        return view(
            'pages/' . $this->controller . '/form',
            array_merge(
                $this->getFormViewParams(),
                [
                    'formType' => 'edit',
                    'item' => $item,
                ]
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->runValidate($request, $id);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->with(['formFor' => 'user'])
                ->withErrors($validator)
                ->withInput();
        }
        $item = $this->getItemFromRequest($request);
        $affected = $this->mainModel->where('id', $id)->update($item);
        return $this->handleSaveResult($affected);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        if ($profile != null) {
            if ($profile->avatar) {
                $path = '/img/profile/avatar/' . $profile->avatar;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        Profile::where('user_id', $id)->delete();
        $this->mainModel->where('id', $id)->delete();
        return redirect()->back()->with(['message' => 'Item deleted successfully!']);
    }

    // GET FORM VIEW PARAMS
    public function getFormViewParams()
    {
        return [
            'statusSelectData' => MyConfig::getSelectDataForController($this->controller, 'status'),
            'groupSelectData' => $this->getGroupSelectData(),
        ];
    }

    // GET ITEM
    public function getItemFromRequest(Request $request)
    {
        $item = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'group_id' => $request->input('group_id'),
            'status' => $request->input('status'),
        ];
        if ($request->input('password')) $item['password'] = $request->input('password');
        return $item;
    }

    // VALIDATES
    public function runValidate(Request $request, $id = null)
    {
        // unique
        $uniqueUsername = sprintf('|unique:%s,%s', $this->getTableName(), 'username');
        $uniqueEmail = sprintf('|unique:%s,%s', $this->getTableName(), 'email');
        if ($id != null) {
            $uniqueUsername = $uniqueUsername . ',' . $id;
            $uniqueEmail = $uniqueEmail . ',' . $id;
        }

        // rules
        $rules = [
            'username' => 'bail|required|between:4,16|regex:/^[a-zA-Z0-9]{4,16}$/' . $uniqueUsername,
            'email' => 'bail|required|email' . $uniqueEmail,
            'status' => 'required',
            'group_id' => 'required',
        ];

        // password
        $password = $request->input('password');
        if ($password || $id == null)
            $rules['password'] = 'bail|required|between:4,16|regex:/^[a-zA-Z0-9]{4,16}$/';
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    // SELECT DATA
    private function getGroupSelectData()
    {
        $model = new Group();
        return $model->listKeyValue('id', 'name');
    }

    // SET PAGE PARAMS
    protected function setPageParams(Request $request)
    {
        $this->pageParams = [
            'pagination' => [
                'itemsPerPage' => 5,
                'pageRange' => 3,
            ],
            'sort' => [
                'field' => trim($request->query('sort_field', 'created_at')),
                'value' => trim($request->query('sort_value', 'desc')),
            ],
            'filters' => [
                'status' => trim($request->query('status_filter', 'all')),
                'group_id' => trim($request->query('group_id_filter', 'all')),
            ],
            'filterData' => [
                'status' => MyConfig::getSelectDataForController($this->controller, 'status'),
                'group_id' => $this->getGroupSelectData(),
            ],
            'search' => [
                'field' => trim($request->query('search_field', 'all')),
                'value' => trim($request->query('search_value', '')),
            ],
            'searchData' => MyConfig::getItemTemplateForController($this->controller, 'search'),
            'currentQuery' => $request->query(),
        ];
    }
}
