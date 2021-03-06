<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    use HasFactory;

    function __construct(array $attributes = array())
    {
        parent::__construct($attributes, 'category');
    }

    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    // RELATIONS
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
