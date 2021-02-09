<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('lesson_id');
            $table->integer('value');
            $table->integer('semester');
            $table->unsignedBigInteger('score_category_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade');
            $table->foreign('lesson_id')->references('id')->on('lessons')->onUpdate('cascade');
            $table->foreign('score_category_id')->references('id')->on('score_categories')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
