<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends BaseModel
{
    use HasFactory;

    function __construct()
    {
        parent::__construct('book');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'price',
        'discount',
        'author_id',
        'category_id',
        'status',
        'picture',
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

    // MANIPULATE
    public function insert($item)
    {
        $modelItem = new $this();
        $modelItem->title = $item['title'];
        $modelItem->slug = $item['slug'];
        $modelItem->price = $item['price'];
        $modelItem->discount = $item['discount'];
        $modelItem->author_id = $item['author_id'];
        $modelItem->category_id = $item['category_id'];
        $modelItem->status = $item['status'];
        $modelItem->picture = $item['picture'];
        $modelItem->short_description = $item['short_description'];
        $modelItem->long_description = $item['long_description'];
        $result = $modelItem->save();
        return $result;
    }
}