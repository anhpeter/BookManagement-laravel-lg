<?php

namespace App\Models;

use App\Common\Config\MyConfig;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel
{
    use HasFactory;

    function __construct()
    {
        parent::__construct('user');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'group_id',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // RELATIONS
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    // MANIPULATE
    public function insert($item)
    {
        $modelItem = new $this();
        $modelItem->username = $item['username'];
        $modelItem->email = $item['email'];
        $modelItem->group_id = $item['group_id'];
        $modelItem->status = $item['status'];
        $modelItem->password = $item['password'];
        $result = $modelItem->save();
        return $result;
    }
}
