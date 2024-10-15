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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_title',50);
            $table->string('product_description');
            $table->string('product_price');
            $table->string('product_quantity');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            // ->onDelete('set null'); //(not working because of maria DB version)
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')->references('subcategory_id')->on('subcategory')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
