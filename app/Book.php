<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public $timestamps = true;

    protected $fillable = ['book_name', 'author', 'desc'];
}
