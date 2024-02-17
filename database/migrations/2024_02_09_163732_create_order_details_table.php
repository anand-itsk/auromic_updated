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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->date('order_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_size_id');
            $table->unsignedBigInteger('product_model_id');
            $table->unsignedBigInteger('product_color_id');
            $table->string('quantity')->nullable();
            $table->date('delivery_date')->nullable();
            $table->unsignedBigInteger('order_status_id');
            $table->string('total_raw_material')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            $table->foreign('product_model_id')->references('id')->on('product_models')->onDelete('cascade');
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
