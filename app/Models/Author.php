<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends BaseModel
{
    use HasFactory;

    function __construct()
    {
        parent::__construct('author');
    }
}
