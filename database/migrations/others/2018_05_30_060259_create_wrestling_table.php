<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWrestlingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wrestling', function (Blueprint $table) {
            $table->increments('id');
              $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('title',2000);
                $table->text('poster_url_value', 1000);
   $table->integer('total_download')->default(0);
$table->integer('total_view')->default(0);
  $table->text('download_link',10000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wrestling');
    }
}
