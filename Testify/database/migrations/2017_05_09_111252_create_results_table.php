<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('results', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('TestId')->unsigned();
                $table->foreign('TestId')->references('id')->on('exams')->onDelete('cascade');
                $table->integer('UserId')->unsigned();
                $table->foreign('UserId')->references('id')->on('users')->onDelete('cascade');
                $table->unsignedInteger('QuestionId');
                $table->unsignedInteger('Answer');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
