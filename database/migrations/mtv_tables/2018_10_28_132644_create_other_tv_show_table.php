<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherTvShowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_tv_show', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('title',1000);
            $table->text('genre', 2000);
            $table->text('actors', 3000);
            $table->integer('total_view')->default(0);
            $table->text('download_link',1000);
            $table->text('type', 1000);
            $table->text('bangla_natok_type', 1000);
            $table->text('director', 1000);
            $table->text('thumbnail', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('other_tv_show');
    }
}
