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
        Schema::create('delivery_challans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->string('dc_no');
            $table->date('dc_date');
            $table->string('quantity')->nullable();
            $table->timestamps();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order_details')->onDelete('cascade');
            $table->foreign('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_challans');
    }
};
