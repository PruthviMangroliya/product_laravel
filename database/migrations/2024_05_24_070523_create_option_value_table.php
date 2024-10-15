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
        Schema::create('option_value', function (Blueprint $table) {
            $table->id('option_value_id');
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('option_id')->on('options')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('option_value');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_value');
    }
};
