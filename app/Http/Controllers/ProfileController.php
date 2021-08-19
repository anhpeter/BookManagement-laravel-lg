<?php

namespace App\Http\Controllers;

use App\Common\Config\MyConfig;
use App\Common\Helper\FileUpload;
use App\Common\Helper\MyHelper;
use App\Common\Helper\ViewHelper;
use App\Models\Group;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Array_;

class ProfileController extends BaseController
{

    function __construct()
    {
        parent::__construct('profile', new Profile());
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
        if ($this->isSaveSuccess())  return redirect(route('profiles.show', ['profile' => $userId]));
        $item = new Profile();
        return view(
            'pages/' . $this->controller . '/form',
            $this->getViewParams(),
            ['formType' => 'add', 'item' => $item, 'userId' => $userId]
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
        $item['user_id'] = $request->input('userId');
        $item = $this->handlePicture($item, $request->input('avatar'));
        $affected = DB::table($this->getTableName())->insert($item);
        return $this->handleSaveResult($affected);
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
        $item = DB::table($this->getTableName())->where('user_id', '=', $id)->first();
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
        if ($this->isSaveSuccess())  return redirect(route('profiles.show', ['profile' => $id]));
        $item = DB::table($this->getTableName())->where('user_id', '=', $id)->first();
        $user = DB::table('users')->find($id);
        $formView = Auth::user()->group->name == 'admin' ? 'combine-form' : 'form';
        return view(
            'pages/' . $this->controller . '/' . $formView,
            array_merge(
                $this->getFormViewParams(),
                ['formType' => 'edit', 'item' => $item, 'user' => $user, 'userId' => $user->id]
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
                ->with(['formFor' => 'profile'])
                ->withErrors($validator)
                ->withInput();
        }
        $item = $this->getItemFromRequest($request);

        $fileUpload = new FileUpload();
        $uploadedFilename = $fileUpload->uploadBase64Picture($request->input('avatar'), $this->getUploadedFolder(), $request->input('current_avatar'));
        if ($uploadedFilename != null) $item['avatar'] = $uploadedFilename;
        $affected = DB::table($this->getTableName())->where('user_id', $id)->update($item);
        return $this->handleSaveResult($affected);
    }

    public static function getUploadedFolder()
    {
        return  '/img/profile/avatar';
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

    // GET FORM VIEW PARAMS
    public function getFormViewParams()
    {
        return [
            'statusSelectData' => MyConfig::getSelectData('status', 'user'),
            'groupSelectData' => $this->getGroupSelectData(),
        ];
    }

    private function getGroupSelectData()
    {
        $model = new Group();
        return $model->listKeyValue('id', 'name');
    }

    // GET ITEM
    public function getItemFromRequest(Request $request)
    {
        $item = [
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
        ];
        return $item;
    }

    // VALIDATES
    public function runValidate(Request $request, $id = null)
    {
        // rules
        $rules = [
            'name' => 'bail|required|',
            'phone' => 'nullable|digits:10',
            'address' => '',
            'birthday' => '',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}
