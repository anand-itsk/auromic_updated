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
        Schema::create('job_allocation_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_giving_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('receving_date');
            $table->timestamps();
            $table->foreign('job_giving_id')->references('id')->on('job_givings')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_allocation_histories');
    }
};
