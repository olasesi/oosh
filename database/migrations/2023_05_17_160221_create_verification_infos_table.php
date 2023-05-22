<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verification_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('account_type')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document')->nullable();
            $table->string('category')->nullable();
            $table->string('country')->nullable();
            $table->string('audience')->nullable();
            $table->string('also_known')->nullable();
            $table->string('profile_link1')->nullable();
            $table->string('profile_link2')->nullable();
            $table->string('profile_link3')->nullable();
            $table->string('profile_link4')->nullable();
            $table->string('profile_link5')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('verification_infos');
    }
}
