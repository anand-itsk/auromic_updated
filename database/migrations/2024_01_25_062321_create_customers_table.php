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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_code');
            $table->string('customer_name');
            $table->string('std_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('pan_date')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('gst_date')->nullable();
            $table->string('license_no')->nullable();
            $table->string('website')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
