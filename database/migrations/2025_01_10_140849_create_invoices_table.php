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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->integer('vat');
            $table->integer('payable');
            $table->unsignedBigInteger('cus_id');
            $table->string('ship_details')->nullable();
            $table->string('transaction_id');
            $table->string('val_id');
            $table->enum('status', ['pending', 'processing', 'completed', 'declined']);
            $table->string('payment_status');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
