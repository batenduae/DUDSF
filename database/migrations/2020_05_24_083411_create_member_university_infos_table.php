<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberUniversityInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_university_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique()->index();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('hons_unit')->nullable();
            $table->boolean('hons_dept_inst')->default(1);
            $table->string('hons_faculty_inst')->nullable();
            $table->string('hons_dept');
            $table->string('hons_session')->nullable();
            $table->string('hons_regId')->nullable();
            $table->year('hons_pass_year')->nullable();
            $table->decimal('hons_cgpa',4,2)->nullable();;
            $table->boolean('done_masters')->default(0);
            $table->boolean('masters_dept_inst')->default(1);
            $table->string('masters_faculty')->nullable();
            $table->string('masters_dept')->nullable();
            $table->string('masters_session')->nullable();
            $table->year('masters_pass_year')->nullable();
            $table->decimal('masters_cgpa',4,2)->nullable();;
            $table->string('hall');
            $table->boolean('resident')->nullable();
            $table->string('building')->nullable();
            $table->string('room')->nullable();
            $table->boolean('live-here')->default(0);

            $table->boolean('display')->default(0);
            $table->boolean('share')->default(1);
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
        Schema::dropIfExists('member_university_infos');
    }
}
