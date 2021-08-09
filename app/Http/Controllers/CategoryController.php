<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Common\Helper\Message;
use App\Models\Category as MainModel;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    function __construct()
    {
        parent::__construct('category', new MainModel());
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
        $item = new Category();
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
        $this->mainModel->where('id', $id)->delete();
        return redirect()->back()->with(['message' => Message::$deleted]);
    }

    // GET FORM VIEW PARAMS
    public function getFormViewParams()
    {
        return [
            'statusSelectData' => MyConfig::getSelectDataForController($this->controller, 'status'),
        ];
    }

    // GET ITEM
    public function getItemFromRequest(Request $request)
    {
        $item = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'status' => $request->input('status'),
        ];
        return $item;
    }

    // VALIDATES
    public function runValidate(Request $request, $id = null)
    {
        // unique
        $uniqueName = sprintf('|unique:%s,%s', $this->getTableName(), 'name');
        $uniqueSlug = sprintf('|unique:%s,%s', $this->getTableName(), 'slug');
        if ($id != null) {
            $uniqueName .= ',' . $id;
            $uniqueSlug .= ',' . $id;
        }

        // rules
        $rules = [
            'name' => 'bail|required|' . $uniqueName,
            'slug' => 'bail|required|' . $uniqueSlug,
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
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
            ],
            'filterData' => [
                'status' => MyConfig::getSelectDataForController($this->controller, 'status'),
            ],
            'search' => [
                'field' => trim($request->query('search_field', 'all')),
                'value' => trim($request->query('search_value', '')),
            ],
            'searchData' => MyConfig::getItemTemplateForController($this->controller, 'search'),
        ];
    }
}
