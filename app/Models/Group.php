<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends BaseModel
{
    use HasFactory;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes, 'group');
    }

    protected $fillable = [
        'name',
        'description',
        'status',
    ];


    // RELATIONS
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // MANIPULATE
    public function insert($item)
    {
        $modelItem = new $this();
        $modelItem->name = $item['name'];
        $modelItem->status = $item['status'];
        $result = $modelItem->save();
        return $result;
    }
}
