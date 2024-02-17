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
        Schema::create('esi_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->boolean('esi_applicable')->default(0);
            $table->date('esi_joining_date')->nullable();
            $table->string('esi_no')->nullable();
            $table->date('esi_last_date')->nullable();
            $table->unsignedBigInteger('local_office_id')->default(1);
            $table->unsignedBigInteger('esi_dispensary_id')->default(1);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('local_office_id')->references('id')->on('local_offices')->onDelete('cascade');
            $table->foreign('esi_dispensary_id')->references('id')->on('esi_dispensaries')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esi_infos');
    }
};
