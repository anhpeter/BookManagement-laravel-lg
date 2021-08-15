<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends BaseModel
{
    use HasFactory;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes, 'user');
    }

    protected $fillable = [
        'username',
        'name',
        'email',
        'email_verified_at',
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
        //$modelItem = new $this();
        //$modelItem->username = $item['username'];
        //$modelItem->email = $item['email'];
        //$modelItem->group_id = $item['group_id'];
        //$modelItem->status = $item['status'];
        //$modelItem->password = $item['password'];
        //$result = $modelItem->save();
        $this->create($item);
        return 1;
    }
}
