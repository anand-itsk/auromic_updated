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
        Schema::create('product_model_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_model_id');
            $table->date('date');
            $table->string('wages_product')->default(0);
            $table->timestamps();
            $table->foreign('product_model_id')->references('id')->on('product_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_model_histories');
    }
};
