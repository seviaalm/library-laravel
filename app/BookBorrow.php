<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookBorrow extends Model
{
    protected $table = 'book_borrow';
    public $timestamps = true;

    protected $fillable = ['student_id', 'date_of_borrowing', 'date_of_returning'];
}
