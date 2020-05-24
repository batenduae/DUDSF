<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique();

            $table->boolean('dudsf_dudaa')->default(1);
            $table->string('email');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('first_name');
            $table->string('last_name')->default('');
            $table->string('full_name');
            $table->string('sur_name')->nullable();
            $table->boolean('inform')->default(1);
            $table->boolean('donate')->default(0);
            $table->boolean('prefer')->default(1);     //Dhaka--Dhamrai
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
        Schema::dropIfExists('member_profiles');
    }
}
