<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberJobInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_job_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique();

            $table->boolean('employee')->default(0);
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('post')->nullable();
            $table->date('join_date')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('member_job_infos');
    }
}
