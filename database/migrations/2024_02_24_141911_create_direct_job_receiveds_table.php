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
            $table->unsignedBigInteger('finishing_product_models_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->enum('incentive_applicable', ['Yes', 'No'])->default(NULL)->nullable();
            $table->date('receving_date');
            $table->boolean('is_cutting')->default(0);
            $table->string('balance_meter')->nullable();
            $table->string('quantity')->nullable();
            $table->string('wages_for_product')->nullable();
            $table->string('usage')->nullable();
            $table->string('shortage')->nullable();
            $table->string('wastage')->nullable();
            $table->string('before_days')->nullable();
            $table->string('after_days')->nullable();
            $table->string('conveyance_fee')->nullable();
            $table->string('deducation_fee')->nullable();
            $table->string('incentive_fee')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->timestamps();
            $table->foreign('direct_job_giving_id')->references('id')->on('direct_job_givings')->onDelete('cascade');
            $table->foreign('finishing_product_models_id')->references('id')->on('finishing_product_models')->onDelete('cascade');
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
