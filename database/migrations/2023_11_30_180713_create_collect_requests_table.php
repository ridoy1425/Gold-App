<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collect_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('profit_id')->nullable()->constrained('order_profits')->onDelete('cascade');
            $table->enum('collect_type', ['investment', 'profit']);
            $table->enum('payment_type', ['balance', 'gold']);
            $table->decimal('amount')->nullable();
            $table->integer('gold')->nullable();
            $table->enum('payment_method', ['bank', 'wallet', 'delivery']);
            $table->enum('status', ['active', 'in-process', 'completed', 'rejected', 'pending'])->default('pending');
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
        Schema::dropIfExists('collect_requests');
    }
}
