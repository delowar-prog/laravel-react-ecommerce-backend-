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
            $table->string('cus_name')->nullable();
            $table->string('cus_country')->nullable();
            $table->foreignId('cus_division')->constrained('divisions')->onDelete('cascade');
            $table->foreignId('cus_district')->constrained('districts')->onDelete('cascade');
            $table->foreignId('cus_upazila')->constrained('upazilas')->onDelete('cascade');
            $table->foreignId('cus_union')->constrained('unions')->onDelete('cascade');
            $table->string('cus_address');
            $table->string('cus_phone');
            $table->string('cus_email')->unique();
            $table->string('ship_name')->nullable();
            $table->string('ship_address')->nullable();
            $table->string('ship_country')->nullable();
            $table->foreignId('ship_division')->nullable()->constrained('divisions')->onDelete('cascade');
            $table->foreignId('ship_district')->nullable()->constrained('districts')->onDelete('cascade');
            $table->foreignId('ship_upazila')->nullable()->constrained('upazilas')->onDelete('cascade');
            $table->foreignId('ship_union')->nullable()->constrained('unions')->onDelete('cascade');
            $table->string('ship_phone')->nullable();
            $table->boolean('same_as_billing')->default(0);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
