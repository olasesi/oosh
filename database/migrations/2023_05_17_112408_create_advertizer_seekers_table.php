<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertizerSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertizer_seekers', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('total_advert')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('religion')->nullable();
            $table->longText('advert_text')->nullable();
            $table->string('advert_img')->nullable();
            $table->string('advert_video')->nullable();
            $table->integer('file_type')->nullable();
            $table->string('platform')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('reference')->nullable();
            $table->string('purpose')->nullable();
            $table->string('profile_link')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('advertizer_seekers');
    }
}
