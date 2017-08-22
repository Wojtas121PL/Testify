<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('time')->default(0);
            $table->boolean('Random')->default(0);
            $table->unsignedInteger('xOFy')->default(0);
            $table->boolean('progressive')->default(0);
            $table->boolean('rules_page')->default(0);
            $table->longText('rules_page_text')->nullable();
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
        Schema::dropIfExists('exams');
    }
}
