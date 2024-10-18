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
        Schema::table('products',function (Blueprint $table)
        {
            // $table->string('product_sku'); //to add new column
            // $table->renameColumn('product_title','product_name'); //to rename column
            // $table->dropColumn('product_sku'); //to delete column
            // $table->string('product_sku',20)->default('jdsfh')->change(); //to set default value to column

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
