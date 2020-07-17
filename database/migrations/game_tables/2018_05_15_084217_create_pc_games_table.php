<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_games', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('title',1000);
            $table->date('released');
            $table->text('publisher',1000);
            $table->text('genre', 2000);
            $table->text('plot', 10000);
            $table->decimal('igdbrating', 4, 2);
         $table->text('other_Ratings',10000);
            $table->text('trailer_value', 1000);
            $table->text('poster_url_value', 1000);
            $table->text('cover_url_value', 1000);   
            $table->text('download_link', 1000);
            $table->integer('total_download')->default(0);
            $table->integer('total_view')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_games');
    }
}
