<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageLikesTable extends Migration
{
    public function up()
    {
        Schema::create('message_likes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('message_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('message_likes');
    }
}
