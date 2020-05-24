<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberEducationalBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_educational_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique();

            $table->string('primary_school')->nullable();
            $table->year('primary_year')->nullable();
            $table->decimal('primary_gpa',4,2)->nullable();

            $table->boolean('jsc')->nullable();
            $table->string('jsc_school')->nullable();
            $table->string('jsc_board')->nullable();
            $table->string('jsc_year')->nullable();
            $table->string('jsc_gpa')->nullable();
            $table->string('jsc_version')->nullable();

            $table->boolean('ssc_oLevel')->nullable();
            $table->string('ssc_school')->nullable();
            $table->string('ssc_board')->nullable();
            $table->string('ssc_group')->nullable();
            $table->string('ssc_version')->nullable();
            $table->year('ssc_year')->nullable();
            $table->string('ssc_reg')->nullable();
            $table->string('ssc_roll')->nullable();
            $table->decimal('ssc_gpa',4,2)->nullable();

            $table->boolean('hsc_aLevel')->nullable();
            $table->string('hsc_college')->nullable();
            $table->string('hsc_board')->nullable();
            $table->string('hsc_group')->nullable();
            $table->string('hsc_version')->nullable();
            $table->year('hsc_year')->nullable();
            $table->string('hsc_reg')->nullable();
            $table->string('hsc_roll')->nullable();
            $table->decimal('hsc_gpa',4,2)->nullable();

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
        Schema::dropIfExists('member_educational_backgrounds');
    }
}
