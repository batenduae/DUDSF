<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->unique();
            //Permanent Address
            $table->string('p_country')->nullable();
            $table->string('p_division')->nullable();
            $table->string('p_district')->nullable();
            $table->boolean('p_city')->nullable();
            $table->string('p_upazilla_city')->nullable();
            $table->string('p_police')->nullable();
            $table->string('p_post')->nullable();
            $table->boolean('p_union')->nullable();
            $table->string('p_union_municipality')->nullable();
            $table->string('p_ward')->nullable();
            $table->string('p_village')->nullable();
            $table->string('p_sector')->nullable();
            $table->string('p_road')->nullable();
            $table->string('p_house')->nullable();
            $table->string('p_location')->nullable();
            $table->string('p_extra')->nullable();
            $table->boolean('p_display')->default(0);
            $table->boolean('p_share')->default(1);
            //Present Address
            $table->boolean('same')->default(0);

            $table->string('country')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->boolean('city')->nullable();
            $table->string('upazilla_city')->nullable();
            $table->string('police')->nullable();
            $table->string('post')->nullable();
            $table->boolean('union')->nullable();
            $table->string('union_municipality')->nullable();
            $table->string('ward')->nullable();
            $table->string('village')->nullable();
            $table->string('sector')->nullable();
            $table->string('road')->nullable();
            $table->string('house')->nullable();
            $table->string('location')->nullable();
            $table->string('extra')->nullable();
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
        Schema::dropIfExists('member_addresses');
    }
}
