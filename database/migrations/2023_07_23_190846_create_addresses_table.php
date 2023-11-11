<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employee_infos')->onDelete('cascade');
            $table->string('present_house')->nullable();
            $table->string('present_house_bn')->nullable();
            $table->string('present_road_no')->nullable();
            $table->string('present_road_no_bn')->nullable();
            $table->string('present_post_off')->nullable();
            $table->string('present_post_off_bn')->nullable();
            $table->string('present_district')->nullable();
            $table->string('present_district_bn')->nullable();
            $table->string('permanent_village')->nullable();
            $table->string('permanent_village_bn')->nullable();
            $table->string('permanent_police_station')->nullable();
            $table->string('permanent_police_station_bn')->nullable();
            $table->string('permanent_post_off')->nullable();
            $table->string('permanent_post_off_bn')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_district_bn')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('addresses');
    }
}
