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
        Schema::create('company_registration_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('pf_type')->nullable();
            $table->string('pf_code')->nullable();
            $table->date('pf_date')->nullable();
            $table->string('esi_code')->nullable();
            $table->date('esi_date')->nullable();
            $table->string('factory_act_no')->nullable();
            $table->string('tin_no')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('ssi_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('tan_no')->nullable();
            $table->string('license_no')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_registration_details');
    }
};
