<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNomineeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominee_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->foreignId('relation_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->foreignId('kyc_type_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->bigInteger('card_number')->nullable();
            $table->string('front_image')->nullable();
            $table->string('back_image')->nullable();
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
        Schema::dropIfExists('nominee_infos');
    }
}
