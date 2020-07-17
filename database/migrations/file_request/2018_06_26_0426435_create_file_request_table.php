<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_request', function (Blueprint $table) {
            $table->increments('id');
            $table->text('file_name',1000);
            $table->text('type',3000); 
            $table->text('download_from',3000);
            $table->text('username',1000);
            $table->integer('status')->default(0); 
            $table->integer('total_follow')->default(0);
            $table->text('download_link',1000);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_request');
    }
}
