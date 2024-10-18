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
        Schema::create('product_option_value', function (Blueprint $table) {

            $table->id('product_option_value_id');

            $table->unsignedBigInteger('product_option_id');
            $table->foreign('product_option_id')->references('product_option_id')->on('product_option')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('option_value_id');
            $table->foreign('option_value_id')->references('option_value_id')->on('option_value')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('option_value_status');
            $table->string('option_value_price');
            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_value');
    }
};
