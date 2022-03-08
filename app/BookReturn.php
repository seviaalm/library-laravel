<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    protected $table = 'book_return';
    public $timestamps = true;

    protected $fillable = ['book_borrow_id', 'date_of_returning', 'fine'];
}
