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
        Schema::create('product_option', function (Blueprint $table) {
            
            $table->id('product_option_id');

            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('option_id')->on('options')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('product_id')->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('option_status');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option');
    }
};
