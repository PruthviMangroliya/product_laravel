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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id('coupon_id');
            $table->string('coupon_name');
            $table->string('coupon_code');
            $table->string('discount_type');
            $table->string('discount_amount');
            $table->integer('coupon_status')->comment('0=expired 1=Valid')->default('1');
            $table->date('expires_at')->default(NULL);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
