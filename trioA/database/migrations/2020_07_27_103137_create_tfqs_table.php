<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTFQSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tfqs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->string('solution');
            $table->integer('periority')->default('10')->nullable();
            $table->string('topic')->nullable();
            $table->integer('sub_project_id');
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
        Schema::dropIfExists('tfqs');
    }
}
