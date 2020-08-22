<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('arname');
            $table->timestamp('start_date')->nullable()->default(null);
            $table->timestamp('end_date')->nullable()->default(null);
            $table->text('description')->nullable();
            $table->string('image')->default('noimage.jpg')->nullable();
            $table->string('certification_image')->default('noimage.jpg')->nullable();
            $table->string('coordinates')->nullable();
            $table->string('font')->nullable();
            $table->timestamp('open_date')->nullable()->default(null);
            $table->timestamp('close_date')->nullable()->default(null);
            $table->integer('sub_project_id');
            $table->integer('organization_implementation_id')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
