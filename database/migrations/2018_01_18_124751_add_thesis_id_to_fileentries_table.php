<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThesisIdToFileentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::table('fileentries', function($table) {
            $table->integer('thesis_id')->unsigned()->nullable();
            $table->foreign('thesis_id')->references('id')->on('theses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fileentries', function($table) {
        $table->dropColumn('thesis_id');
        });
    }
}
