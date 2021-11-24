<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('judul_movie', 255);
            $table->string('rilis', 255);
            $table->unsignedBigInteger('id_sutradara');
            $table->string('durasi', 255);
            $table->string('asal', 255);
            $table->string('produksi', 255);
            $table->string('pemain', 255);
            $table->unsignedBigInteger('id_genre');
            $table->text('deskripsi', 255);
            $table->timestamps();

            $table->foreign('id_sutradara')->references('id')->on('sutradara')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_genre')->references('id')->on('genre')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
