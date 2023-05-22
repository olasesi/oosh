<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id')->nullable();
            $table->string('file')->nullable();
            $table->longText('caption')->nullable();
            $table->string('status')->default(0);
            $table->timestamp('expire_at');    //Add the send parameter for the number of digits on precision
            $table->string('story_type')->nullable();
            $table->longText('text')->nullable();
            $table->string('story_bg')->nullable();
            $table->string('font_family')->nullable();
            $table->string('text_color')->nullable();
            $table->string('file_type')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('stories');
    }
}
