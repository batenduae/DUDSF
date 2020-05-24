<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_personal_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique();

            $table->boolean('married')->default(0);
            $table->string('marriage_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->unsignedInteger('children')->nullable();
            $table->unsignedInteger('family_member')->nullable();
            $table->string('blood_group');
            $table->boolean('donate')->default(0); // donate blood
            $table->string('religion');
            $table->string('birth_date')->nullable();
            $table->string('hobby')->nullable();
            $table->string('skills')->nullable();
            $table->string('extra_info')->nullable();
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
        Schema::dropIfExists('member_personal_infos');
    }
}
