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
        Schema::create('direct_job_receiveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direct_job_giving_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('product_model_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->enum('incentive_applicable', ['Yes', 'No'])->default(NULL)->nullable();
            $table->date('receving_date');
            $table->timestamps();
            $table->foreign('direct_job_giving_id')->references('id')->on('direct_job_givings')->onDelete('cascade');
            $table->foreign('product_model_id')->references('id')->on('product_models')->onDelete('cascade');
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');
             $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direct_job_receiveds');
    }
};
