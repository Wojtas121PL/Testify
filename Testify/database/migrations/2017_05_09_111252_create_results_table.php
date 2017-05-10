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
        /*
        Schema::create('Testing1', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('TestId');
            $table->unsignedInteger('UserId');
        });
        Schema::create('Testing2', function (Blueprint $table) {
            $table->increments('Id');
            $table->string('Name');
            $table->string('SureName');
        });
        Schema::table('Testing1',function (Blueprint $table){
            $table->index('TestId');
            $table->foreign('TestId')->references('Id')->on('Testing2');
        });*/
            Schema::create('results', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('TestId');
                $table->unsignedInteger('UserId');
                $table->unsignedInteger('QuestionId');
                $table->unsignedInteger('Answer');
                $table->unsignedInteger('CorrectAnswer');
                $table->timestamps();
            });
            Schema::table('results',function (Blueprint $table){
                $table->index('TestId');
                $table->foreign('TestId')->references('Id')->on('tests_names');
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
