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
        Schema::create('job_receiveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_giving_id');
            $table->enum('incentive_applicable', ['Yes', 'No'])->default('Yes');
            $table->string('before_days')->nullable();
            $table->string('after_days')->nullable();
            $table->string('current_weight')->nullable();
            $table->string('conveyance_fee')->nullable();
            $table->string('deducation_fee')->nullable();
            $table->string('incentive_fee')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('net_amount')->nullable();
            $table->enum('status', ['Pending', 'Incomplete', 'Complete'])->default('Pending');
            $table->date('receving_date');
            $table->string('complete_quantity')->nullable();
            $table->timestamps();
            $table->foreign('job_giving_id')->references('id')->on('job_givings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_receiveds');
    }
};
