<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangaEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_episodes', function (Blueprint $table) {
              $table->increments('id');
              $table->integer('post_episodemangas_id')->unsigned();
              $table->integer('page');
              $table->string('image');
              $table->foreign('post_episodemangas_id')->references('id')->on('post_episodemangas')->onDelete('CASCADE')->onUpdate('CASCADE');
              $table->timestamps();
              $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manga_episodes');
    }
}
