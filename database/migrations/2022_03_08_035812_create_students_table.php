<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('student_id');
            $table->string('student_name', 100);
            $table->date('date_of_birth');
            $table->enum('gender', ['L', 'P']);
            $table->text('address');
            $table->unsignedBigInteger('class_id');
            $table->timestamps();

            $table->foreign('class_id')->references('class_id')->on('grade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
