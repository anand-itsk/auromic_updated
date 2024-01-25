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
        Schema::create('authorised_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('faorhus_name');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->date('dob')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('percent');
            $table->string('photo');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorised_people');
    }
};
