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
        Schema::create('job_givings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_model_id');
            $table->unsignedBigInteger('dc_id')->nullable();
            $table->enum('status',['Pending','Incomplete','Complete','Cancelled'])->default('Pending');
            $table->string('quantity')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('order_details')->onDelete('cascade');
             $table->foreign('product_model_id')->references('id')->on('product_models')->onDelete('cascade');
            $table->foreign('dc_id')->references('id')->on('delivery_challans')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_givings');
    }
};
