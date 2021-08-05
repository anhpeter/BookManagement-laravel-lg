<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{

    function __construct()
    {
        parent::__construct('user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = DB::table(parent::getTableName())->get();
        return view('pages/' . $this->controller . '/index', ['items' => $items, 'controller' => $this->controller]);
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
                parent::getViewParams(),
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
        $affected = DB::table(parent::getTableName())->insert($item);
        return parent::handleSaveResult($affected);
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
        $item = DB::table(parent::getTableName())->find($id);
        return view(
            'pages/' . $this->controller . '/form',
            array_merge(
                parent::getViewParams(),
                ['formType' => 'edit', 'item' => $item]
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
        $this->runValidate($request, $id)->validate();
        $item = $this->getItemFromRequest($request);
        $affected = DB::table(parent::getTableName())->where('id', $id)->update($item);
        return parent::handleSaveResult($affected);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('profiles')->where('user_id', $id)->delete();
        DB::table(parent::getTableName())->delete($id);
        return Redirect(route(parent::getTableName() . '.index'))->with(['message' => 'Item deleted successfully!']);
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
        $uniqueUsername = sprintf('|unique:%s,%s', parent::getTableName(), 'username');
        $uniqueEmail = sprintf('|unique:%s,%s', parent::getTableName(), 'email');
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
}
