<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_infos', function (Blueprint $table) {
            $table->id();
            $table->string('employee_gid');
            $table->string('full_name');
            $table->string('full_name_bn')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->string('mother_name')->nullable();
            $table->string('mother_name_bn')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_name_bn')->nullable();
            $table->foreignId('present_des_label_id')->nullable()->constrained('designation_labels')->onDelete('cascade');
            $table->foreignId('present_designation_id')->nullable()->constrained('designations')->onDelete('cascade');
            $table->foreignId('joining_des_label_id')->nullable()->constrained('designation_labels')->onDelete('cascade');
            $table->foreignId('joining_designation_id')->nullable()->constrained('designations')->onDelete('cascade');
            $table->string('nationality')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('joining_age')->nullable();
            $table->string('present_joining_date')->nullable();
            $table->string('present_joining_age')->nullable();
            $table->foreignId('appraisal_category_id')->nullable()->constrained('appraisal_categories')->onDelete('cascade');
            $table->foreignId('gender_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->foreignId('religion_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->string('dob')->nullable();
            $table->string('today_age')->nullable();
            $table->foreignId('marital_status_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->string('spouse_name')->nullable();
            $table->string('spouse_name_bn')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('telephone_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('alt_mobile_no')->nullable();
            $table->string('national_id')->nullable();
            $table->string('passport_no')->nullable();
            $table->foreignId('blood_group_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->string('tin_no')->nullable();
            $table->foreignId('type_id')->nullable()->constrained('payloads')->onDelete('cascade');
            $table->foreignId('status_id')->default(38)->constrained('payloads')->onDelete('cascade');
            $table->timestamp('status_date')->default(now());
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
        Schema::dropIfExists('employee_infos');
    }
}
