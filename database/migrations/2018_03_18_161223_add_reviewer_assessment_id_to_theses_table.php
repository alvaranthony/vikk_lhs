<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReviewerAssessmentIdToThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('theses', function($table) {
            $table->integer('reviewer_assessment_id')->unsigned()->nullable();
            $table->foreign('reviewer_assessment_id')->references('id')->on('reviewer_assessments');
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
            $table->dropColumn('reviewer_assessment_id');
        });
    }
}
