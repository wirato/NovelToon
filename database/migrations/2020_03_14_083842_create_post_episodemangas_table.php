<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostEpisodemangasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_episodemangas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manga_id')->unsigned();
            $table->string('manga_title');
            $table->integer('ep');
            $table->string('title')->default('-');
            $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('post_episodemangas');
    }
}
