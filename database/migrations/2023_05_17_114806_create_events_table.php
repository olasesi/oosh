<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('event_name')->nullable();
            $table->string('feeling')->nullable();
            $table->string('location')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->longText('description')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_time')->nullable();
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
        Schema::dropIfExists('events');
    }
}
