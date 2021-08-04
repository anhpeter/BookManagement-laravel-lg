<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        if (session('status') === 'success') {
            return redirect(route('profiles.show', ['profile' => $userId]));
        }
        $item = new Profile();
        return view('pages/' . $this->controller . '/form', ['formType' => 'add', 'item' => $item, 'userId' => $userId]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = [
            'user_id' => $request->input('userId'),
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ];
        $affected = DB::table(parent::getTableName())->insert($item);
        if ($affected == 1) return Redirect()->back()->with(['status' => 'success']);
        else return redirect()->back()->with(['status' => 'fail'])
            ->withErrors(['save', 'Failed to save'])
            ->withInput();
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
        if (session('status') === 'success') {
            return redirect(route('profiles.show', ['profile' => $id]));
        }
        $item = DB::table(parent::getTableName())->where('user_id', '=', $id)->first();
        $user = DB::table('users')->find($id);
        return view('pages/' . $this->controller . '/combine-form', ['formType' => 'edit', 'item' => $item, 'user' => $user]);
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
        $item = [
            'fullname' => $request->input('fullname'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
        ];
        $affected = DB::table(parent::getTableName())->where('user_id', $id)->update($item);
        if ($affected == 1) return Redirect()->back()->with(['status' => 'success']);
        else return redirect()->back()->with(['status' => 'fail'])
            ->withErrors(['save', 'Failed to save'])
            ->withInput();
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
}
