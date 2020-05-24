<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->string('registrationId');
            $table->string('loginId');
            $table->boolean('membership')->default(1);
            $table->boolean('display')->default(1);
            $table->boolean('banned')->default(0);
            $table->boolean('active')->default(1);
            $table->boolean('inform')->default(1);
            $table->boolean('edit')->default(1);
            $table->string('image')->nullable();
            $table->boolean('imageShow')->default(1);
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
        Schema::dropIfExists('members');
    }
}
