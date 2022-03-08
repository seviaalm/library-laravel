<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookBorrowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_borrow', function (Blueprint $table) {
            $table->bigIncrements('book_borrow_id');
            $table->unsignedBigInteger('student_id');
            $table->date('date_of_borrowing');
            $table->date('date_of_returning');
            $table->timestamps();
            
            $table->foreign('student_id')->references('student_id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_borrow');
    }
}
