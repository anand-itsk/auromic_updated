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
        Schema::create('direct_without_givens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('finishing_product_models_id');
            $table->unsignedBigInteger('product_color_id');
            $table->date('receving_date');
            $table->string('received_quantity');
            $table->enum('incentive_applicable', ['Yes', 'No'])->default('No');
            $table->string('before_days')->nullable();
            $table->string('after_days')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('conveyance_fee')->nullable();
            $table->string('deducation_fee')->nullable();
            $table->string('incentive_fee')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
            $table->foreign('finishing_product_models_id')->references('id')->on('finishing_product_models')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_without_givens');
    }
};
