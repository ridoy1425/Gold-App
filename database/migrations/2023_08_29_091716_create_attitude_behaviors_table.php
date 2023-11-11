<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttitudeBehaviorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attitude_behaviors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_category_id')->nullable()->constrained('branch_categories')->onDelete('cascade');
            $table->string('attitude_behavior')->nullable();
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
        Schema::dropIfExists('attitude_behaviors');
    }
}
