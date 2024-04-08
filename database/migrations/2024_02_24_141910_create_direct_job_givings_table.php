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
        Schema::create('direct_job_givings', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('employee_id');
          $table->unsignedBigInteger('finishing_product_models_id');
           $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->string('meter')->nullable();
            $table->string('useage_meter')->nullable();
             $table->enum('clothes_by_cutting', ['0', '1'])->default('0');
             $table->string('total_cutting_pieces')->nullable();
           $table->timestamps();
           $table->foreign('finishing_product_models_id')->references('id')->on('finishing_product_models')->onDelete('cascade');
           $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
           $table->foreign('product_size_id')->references('id')->on('product_sizes')->onDelete('cascade');
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_job_givings');
    }
};
