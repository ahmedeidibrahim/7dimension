<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job')->default('trainer')->nullable();
            $table->integer('rate')->default('90')->nullable();
            $table->boolean('online_registration')->default('0')->nullable();
            $table->boolean('check_in')->default('0')->nullable();
            $table->boolean('accepted')->default('0')->nullable();
            $table->text('notes')->nullable();
            $table->integer('user_id');
            $table->integer('activity_id');
            $table->integer('organization_particepated_id');
            $table->integer('user_verified_by_id')->nullable();
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
        Schema::dropIfExists('participants');
    }
}
