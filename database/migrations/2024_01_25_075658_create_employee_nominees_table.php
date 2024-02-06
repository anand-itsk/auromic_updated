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
        Schema::create('employee_nominees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_member_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('gratuity_sharing')->nullable();
            $table->string('marital_status')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->string('faorhus_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('guardian_relation_with_emp')->nullable();
            $table->foreign('religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->foreign('family_member_id')->references('id')->on('employee_family_member_details')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_nominees');
    }
};
