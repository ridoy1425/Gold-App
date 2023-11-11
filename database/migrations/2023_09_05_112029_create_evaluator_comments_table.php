<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluatorCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluator_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appraisal_id')->nullable()->constrained('appraisals')->onDelete('cascade');
            $table->foreignId('appraisal_evaluator_id')->nullable()->constrained('appraisal_evaluators')->onDelete('cascade');
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('evaluator_comments');
    }
}
