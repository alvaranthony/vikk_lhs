<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewerGradeIdToThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function($table) {
            $table->integer('reviewer_grade_id')->unsigned()->nullable();
            $table->foreign('reviewer_grade_id')->references('id')->on('reviewer_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theses', function($table) {
            $table->dropColumn('reviewer_grade_id');
        });
    }
}
