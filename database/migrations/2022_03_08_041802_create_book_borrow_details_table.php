<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookBorrowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_borrow_details', function (Blueprint $table) {
            $table->bigIncrements('book_borrow_detail_id');
            $table->unsignedBigInteger('book_borrow_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('qty');
            $table->timestamps();

            $table->foreign('book_borrow_id')->references('book_borrow_id')->on('book_borrow');
            $table->foreign('book_id')->references('book_id')->on('book');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_borrow_details');
    }
}
