<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrAdministrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_administratives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_category_id')->nullable()->constrained('branch_categories')->onDelete('cascade');
            $table->string('hr_administrative')->nullable();
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
        Schema::dropIfExists('hr_administratives');
    }
}
