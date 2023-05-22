<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('text');
            $table->longText('from')->nullable();
            $table->string('to')->nullable();
            $table->string('sender')->nullable();
            $table->bigInteger('receiver_id')->nullable();
            $table->bigInteger('sender_id')->nullable();
            $table->integer('status')->default(0);
            $table->string('voice_note')->nullable();
            $table->string('voice_blob')->nullable();
            $table->string('file_type')->nullable();
            $table->string('file_name')->nullable();
            $table->unsignedbigInteger('post_id')->nullable();
            $table->longText('post_description')->nullable();
            $table->longText('share_description')->nullable();
            $table->string('post_for')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('message_id')->nullable();
            $table->longText('main_message')->nullable();
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
        Schema::dropIfExists('messages');
    }
}
