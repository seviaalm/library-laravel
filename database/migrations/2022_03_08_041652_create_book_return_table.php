<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_return', function (Blueprint $table) {
            $table->bigIncrements('book_return_id');
            $table->unsignedBigInteger('book_borrow_id');
            $table->date('date_of_returning');
            $table->integer('fine');
            $table->timestamps();

            $table->foreign('book_borrow_id')->references('book_borrow_id')->on('book_borrow');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_return');
    }
}
