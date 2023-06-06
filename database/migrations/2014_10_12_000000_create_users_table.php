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
            $table->id();
            $table->string('active')->default('0');
            $table->string('email')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('role')->default('user');
            $table->string('profile_picture')->default('storage/profile/placeholder.png');
            $table->string('remember_token')->nullable();
            $table->string('username')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('bio')->nullable();
            $table->string('peerID')->nullable();
            $table->string('cover_photo')->nullable();
            $table->integer('profile_verify')->default(0);
            $table->integer('page_verify')->default(0);
            $table->string('voicepeerID')->nullable();
            $table->string('verification_code')->nullable();
            $table->string('forget_password')->nullable();
            $table->string('occupation')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('hobby')->nullable();
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
