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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_des')->nullable();
            $table->integer('price');
            $table->tinyInteger('discount')->default(0)->nullable();
            $table->integer('discount_price')->nullable();
            $table->string('image');
            $table->integer('stock');
            $table->double('star')->default(5)->nullable();
            $table->enum('remarks', ['new', 'sale', 'popular', 'featured', 'limited'])
            ->default('new')->nullable()
            ->comment('Remarks for the product like sale, featured, etc.');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
