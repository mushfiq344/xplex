
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTvShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_show', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            
            $table->text('title',1000);
            $table->date('released');
            $table->text('year',1000);

            $table->text('country', 10000);
            $table->text('language', 10000);
            
            $table->text('genre', 2000);
            $table->text('actors', 3000);
            $table->text('plot', 10000);
            
            $table->text('imdb_id',1000);
            $table->decimal('imdbrating', 4, 2);

            
            $table->text('trailer_value', 1000);
            $table->text('poster_url_value', 1000);
            $table->text('cover_url_value', 1000);
            $table->integer('total_view')->default(0);
            $table->text('base_url',2000);
            $table->text('type',2000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_show');
    }
}
