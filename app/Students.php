<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students'; //$table menyimpan informasi nama tabel customers
    public $timestamps = true;

    protected $fillable = ['student_name', 'date_of_birth', 'gender', 'address', 'class_id'];
}
