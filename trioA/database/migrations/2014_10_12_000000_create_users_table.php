<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('verification_code')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('national_id')->nullable();
            $table->string('address')->nullable();
            $table->integer('organization_accomodation')->nullable(); 
            $table->integer('organization_work')->nullable();
            $table->string('job')->nullable();
            $table->string('gender')->nullable();
            $table->string('qualification')->nullable();
            $table->string('avatar')->default('noimage.jpg')->nullable();
            $table->string('national_id_image')->default('noimage.jpg')->nullable();
            $table->decimal('points',7,0)->default('0')->nullable();
            $table->string('account')->default('normal')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
