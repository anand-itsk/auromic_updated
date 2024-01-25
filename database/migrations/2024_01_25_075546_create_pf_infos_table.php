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
            $table->unsignedBigInteger('company_id');
            $table->boolean('pf_applicable')->default(0);
            $table->date('pf_joining_date');
            $table->string('pf_no');
            $table->date('pf_last_date');
            $table->date('pension_joining_date');
            $table->boolean('pension_applicable')->default(0);
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
