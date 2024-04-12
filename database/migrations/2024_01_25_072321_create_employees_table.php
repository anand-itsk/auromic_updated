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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->default(1);
            $table->string('employee_code');
            $table->string('employee_name');
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('faorhus_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('std_code')->nullable();
            $table->string('phone')->nullable();
            $table->enum('status', ['working', 'relieving', 'relieved', 'rejoining'])->nullable()->default('working');
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('caste_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('prob_period')->nullable();
            $table->date('confirm_date')->nullable();
            $table->date('resigning_date')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedBigInteger('resigning_reason_id')->default(1);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('caste_id')->references('id')->on('castes')->onDelete('cascade');
            $table->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->foreign('resigning_reason_id')->references('id')->on('resigning_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
