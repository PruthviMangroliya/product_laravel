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
        Schema::create('subcategory', function (Blueprint $table) {
            $table->id('subcategory_id');
            $table->string('subcategory_name', 50);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('category')
            ->onUpdate('cascade')
            ->onDelete('cascade');//delete from connected table
            // ->onDelete('set null'); // set null on connected table (not working because of maria DB version)
            $table->string('subcategory_image');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory');
    }
};
