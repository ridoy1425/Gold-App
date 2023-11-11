<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_entries', function (Blueprint $table) {
            $table->id();
            $table->date('entry_date')->nullable();
            $table->foreignId('employee_id')->nullable()->constrained('employee_infos')->onDelete('cascade');
            $table->foreignId('leave_type_id')->nullable()->constrained('leave_types')->onDelete('cascade');
            $table->date('leave_from')->nullable();
            $table->date('leave_to')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('reason')->nullable();
            $table->date('accept_from')->nullable();
            $table->date('accept_to')->nullable();
            $table->integer('accepted_no_of_days')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->string('leave_address')->nullable();
            $table->foreignId('substitute_id')->nullable()->constrained('employee_infos')->onDelete('cascade');
            $table->tinyInteger('status_id');
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
        Schema::dropIfExists('leave_entries');
    }
}
