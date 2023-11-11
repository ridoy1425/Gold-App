<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->nullable()->constrained('employee_infos')->onDelete('cascade');
            $table->integer('salary_grade')->nullable();
            $table->integer('basic_salary')->nullable();
            $table->integer('conveyance')->nullable();
            $table->integer('arban_allowance')->nullable();
            $table->integer('pay_step')->nullable();
            $table->integer('house_rent')->nullable();
            $table->integer('medical_allowance')->nullable();
            $table->string('note')->nullable();
            $table->integer('contractual_salary')->nullable();
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
        Schema::dropIfExists('salary_infos');
    }
}
