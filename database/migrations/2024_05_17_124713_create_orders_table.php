<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->integer('order_products');
            $table->bigInteger('order_total');
            $table->string('order_status')->default('Payment pending');
            $table->string('transaction_id');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('created_at')->default(date(now()));
            // $table->timestamps();
            $table->softDeletes();

            // $table->timestamp('created_at')->useCurrent();
            // $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
