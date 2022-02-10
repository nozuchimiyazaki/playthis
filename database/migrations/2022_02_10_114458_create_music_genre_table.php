<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMusicGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_genre', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('genre_id');
            $table->timestamps();

            // 外部キー制約
            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');

            // music_idとgenre_idの重複を許さない
            $table->unique(['music_id', 'genre_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music_genre');
    }
}
