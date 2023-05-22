<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_shares', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('post_id')->nullable();
            $table->unsignedbigInteger('user_id')->nullable();
            $table->longText('post_description')->nullable();
            $table->longText('share_description')->nullable();
            $table->string('visibility')->nullable();
            $table->string('post_for')->nullable();
            $table->unsignedbigInteger('poster_id')->nullable();
            $table->unsignedbigInteger('friend_id')->nullable();
            $table->unsignedbigInteger('group_id')->nullable();
            $table->unsignedbigInteger('page_id')->nullable();
            $table->unsignedbigInteger('user_message_id')->nullable();
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
        Schema::dropIfExists('post_shares');
    }
}
