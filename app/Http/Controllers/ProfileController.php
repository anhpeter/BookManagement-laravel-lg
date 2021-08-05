<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class ProfileController extends BaseController
{

    function __construct()
    {
        parent::__construct('profile');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        echo $id;
        //$item = new Profile();
        //return view('pages/' . $this->controller . '/form', ['formType' => 'add', 'item' => $item]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createProfile($userId)
    {
        if (parent::isSaveSuccess())  return redirect(route('profiles.show', ['profile' => $userId]));
        $item = new Profile();
        return view(
            'pages/' . $this->controller . '/form',
            array_merge(
                parent::getViewParams(),
                ['formType' => 'add', 'item' => $item, 'userId' => $userId]
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
        print("<pre>" .
            print_r($request->all(), true)
            . "</pre>");
        $item = $this->getItemFromRequest($request);
        $item['user_id'] =$request->input('userId');
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
        $item = DB::table(parent::getTableName())->where('user_id', '=', $id)->first();
        $user = DB::table('users')->find($id);
        return view('pages/' . $this->controller . '/show', ['item' => $item, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (parent::isSaveSuccess())  return redirect(route('profiles.show', ['profile' => $id]));
        $item = DB::table(parent::getTableName())->where('user_id', '=', $id)->first();
        $user = DB::table('users')->find($id);
        return view(
            'pages/' . $this->controller . '/combine-form',
            array_merge(
                parent::getViewParams(),
                ['formType' => 'edit', 'item' => $item, 'user' => $user]
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
        $affected = DB::table(parent::getTableName())->where('user_id', $id)->update($item);
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
        //
    }

    // GET ITEM
    public function getItemFromRequest(Request $request)
    {
        $item = [
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ];
        return $item;
    }

    // VALIDATES
    public function runValidate(Request $request, $id = null)
    {
        // rules
        $rules = [
            'fullname' => 'bail|required|',
            'phone' => 'bail|required|regex:/^\d{10}$/',
            'address' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}
