<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('title',1000);
            $table->date('released');
            $table->text('production',5000);
            $table->text('year', 1000);
            $table->text('country', 1000);
            $table->text('language', 1000);
            $table->text('genre', 2000);
            $table->text('director', 2000);
            $table->text('actors', 3000);
            $table->text('plot', 10000);
            $table->decimal('imdbrating', 4, 2);
            $table->integer('rottentomatoesrating');
            $table->integer('metacriticrating');
            $table->text('trailer_value', 1000);
            $table->text('poster_url_value', 1000);
            $table->text('cover_url_value', 1000);   
            $table->text('imdb_id',1000);
            $table->integer('total_download')->default(0);
            $table->integer('total_view')->default(0);
            $table->text('download_link',2000);
            $table->text('print_type',2000);
            $table->text('type', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie');
    }
}
