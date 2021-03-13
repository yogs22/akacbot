<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('name');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->text('address');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->string('phone_number');
            $table->string('religion');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('class_id');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('parents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
