<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_style', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('style_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');

            // music_idとstyle_idの重複を許さない
            $table->unique(['music_id', 'style_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_style');
    }
}
