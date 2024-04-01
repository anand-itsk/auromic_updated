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
            $table->unsignedBigInteger('order_no_id');
            $table->date('order_date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_model_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->string('quantity')->nullable();
            $table->string('available_quantity')->nullable();
            $table->date('delivery_date')->nullable();
            $table->unsignedBigInteger('order_status_id')->nullable();
            $table->string('total_raw_material')->nullable();
            $table->string('weight_per_item')->nullable();
            $table->string('available_weight')->nullable();
            $table->timestamps();
            $table->foreign('order_no_id')->references('id')->on('order_nos')->onDelete('cascade');
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
