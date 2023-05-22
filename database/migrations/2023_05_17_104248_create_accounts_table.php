<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('location')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('bio')->nullable();
            $table->string('password')->nullable();
            $table->string('profile_pictured')->nullable();
            $table->integer('status')->default(0);
            $table->string('peerID')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->string('role')->default('user');
            $table->string('cover_photo')->nullable();
            $table->string('api_token', 80)->nullable();
            $table->integer('profile_verify')->default(0);
            $table->integer('page_verify')->default(0);
            $table->string('voicepeerID')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
