<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Common\Helper\Message;
use App\Models\Author;
use App\Models\Group;
use App\Models\Profile;
use App\Models\Book as MainModel;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends BaseController
{
    function __construct()
    {
        $this->middleware('role:admin,editor')->except(['index']);
        parent::__construct('book', new MainModel());
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
        $item = new Book();
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
        $this->mainModel->insert($item);
        return $this->handleSaveResult();
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
        $item = $this->find($id);
        if ($item != null) {
            if ($item->picture) {
                $path = '/img/' . $this->controller . '/picture/' . $item->picture;
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
        $item->delete();
        return redirect()->back()->with(['message' => Message::$deleted]);
    }

    // GET FORM VIEW PARAMS
    public function getFormViewParams()
    {
        return [
            'statusSelectData' => MyConfig::getSelectData('status', $this->controller),
            'categorySelectData' => $this->getCategorySelectData(),
            'authorSelectData' => $this->getAuthorSelectData(),
        ];
    }

    // GET ITEM
    public function getItemFromRequest(Request $request)
    {
        $item = [
            'title' => $request->input('title'),
            'slug' => $request->input('slug'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'author_id' => $request->input('author_id'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status'),
            'picture' => $request->input('picture'),
            'short_description' => $request->input('short_description'),
            'long_description' => $request->input('long_description'),
        ];
        if ($request->input('password')) $item['password'] = $request->input('password');
        return $item;
    }

    // VALIDATES
    public function runValidate(Request $request, $id = null)
    {
        // unique
        $uniqueTitle = sprintf('|unique:%s,%s', $this->getTableName(), 'title');
        $uniqueSlug = sprintf('|unique:%s,%s', $this->getTableName(), 'slug');
        if ($id != null) {
            $uniqueTitle .= ',' . $id;
            $uniqueSlug .= ',' . $id;
        }

        $rules = [
            'title' => 'bail|required' . $uniqueTitle,
            'slug' => 'bail|required' . $uniqueSlug,
            'price' => 'bail|required',
            'discount' => 'bail|required',
            'author_id' => 'bail|required',
            'category_id' => 'bail|required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }

    // SELECT DATA
    private function getCategorySelectData()
    {
        $model = new Category();
        return $model->listKeyValue('id', 'name');
    }

    private function getAuthorSelectData()
    {
        $model = new Author();
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
                'author_id' => trim($request->query('author_id_filter', 'all')),
                'category_id' => trim($request->query('category_id_filter', 'all')),
            ],
            'filterData' => [
                'status' => MyConfig::getSelectData('status', $this->controller),
                'author_id' => $this->getAuthorSelectData(),
                'category_id' => $this->getCategorySelectData(),
            ],
            'search' => [
                'field' => trim($request->query('search_field', 'all')),
                'value' => trim($request->query('search_value', '')),
            ],
            'searchData' => MyConfig::getItemTemplateForController($this->controller, 'search'),
        ];
    }
}
