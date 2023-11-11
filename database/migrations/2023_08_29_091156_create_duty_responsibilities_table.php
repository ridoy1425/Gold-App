<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyResponsibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duty_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_category_id')->nullable()->constrained('branch_categories')->onDelete('cascade');
            $table->string('duty_responsibility')->nullable();
            $table->integer('order')->nullable();
            $table->integer('marks')->nullable();
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
        Schema::dropIfExists('duty_responsibilities');
    }
}
