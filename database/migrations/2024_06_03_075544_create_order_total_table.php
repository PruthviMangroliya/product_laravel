<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_total', function (Blueprint $table) {
            $table->id('order_total_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->bigInteger('order_amount');
            $table->bigInteger('discount_amount')->default('0');
            $table->bigInteger('discounted_amount')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_total');
    }
};
