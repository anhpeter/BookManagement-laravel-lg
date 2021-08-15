<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    use HasFactory;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes, 'order');
    }

    protected $fillable = [
        'user_id',
        'address',
        'status',
        'note',
        'phone',
        'shipping_method',
        'payment_method',
    ];


    // RELATIONS
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
