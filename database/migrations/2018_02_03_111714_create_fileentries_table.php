<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileentries', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('thesis_id')->unsigned()->nullable();
            $table->foreign('thesis_id')->references('id')->on('theses')->onDelete('cascade');
			$table->string('filename',2083);
			$table->string('mime');
			$table->string('original_filename',2083);
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fileentries', function (Blueprint $table) {
            Schema::drop('fileentries');
        });
    }
}
