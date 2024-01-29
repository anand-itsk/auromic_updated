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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('state_id')->default(1);
            $table->unsignedBigInteger('country_id')->default(1);
            $table->unsignedBigInteger('district_id')->default(1);
            $table->string('pincode')->nullable();
            $table->string('village_area')->nullable();
            $table->unsignedBigInteger('address_type_id')->default(1);
            $table->morphs('addressable');
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('address_type_id')->references('id')->on('address_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
