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
        Schema::create('employee_banking_infos', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->text('address')->nullable();
            $table->string('account_number')->nullable();
            $table->unsignedBigInteger('payment_mode_id')->default(1);
            $table->string('account_type')->nullable();
            $table->string('bank_ref_no')->nullable();
            $table->string('range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_banking_infos');
    }
};
