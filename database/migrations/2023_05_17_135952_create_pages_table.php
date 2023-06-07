<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id')->nullable();
            $table->string('page_name')->nullable();
            $table->string('page_category')->nullable();
            $table->longText('page_description')->nullable();
            $table->string('page_whatsapp')->nullable();
            $table->string('page_email')->nullable();
            $table->string('page_contact')->nullable();
            $table->string('page_website')->nullable();
            $table->string('page_location')->nullable();
            $table->string('profile_picture')->default('storage/page/placeholder.jpg');
            $table->string('cover_picture')->default('storage/page/coverphoto.jpg');
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
        Schema::dropIfExists('pages');
    }
}
