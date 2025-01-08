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
            $table->string('cus_name');
            $table->string('cus_address');
            $table->string('cus_country');
            $table->string('cus_division');
            $table->string('cus_district');
            $table->string('cus_upazila');
            $table->string('cus_post_code');
            $table->string('cus_phone');
            $table->string('cus_email')->unique();
            $table->string('ship_name');
            
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
