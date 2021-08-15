<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends BaseModel
{
    use HasFactory;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes, 'book');
    }

    protected $fillable = [
        'title',
        'slug',
        'price',
        'discount',
        'author_id',
        'category_id',
        'status',
        'picture',
        'inventory_qty',
        'short_description',
        'long_description',
    ];


    // RELATIONS
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
