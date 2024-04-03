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
        Schema::create('pf_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->boolean('pf_applicable')->default(0);
            $table->date('pf_joining_date')->nullable();
            $table->string('pf_no')->nullable();
            $table->date('pf_last_date')->nullable();
            $table->date('pension_joining_date')->nullable();
             $table->string('uan_number')->nullable();
            $table->boolean('pension_applicable')->default(0);
            $table->longtext('remark')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pf_infos');
    }
};
