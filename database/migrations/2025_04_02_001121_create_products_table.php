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
            $table->uuid('id')->unique(); // Auto-incrementing ID
            $table->string('nama'); // Product name
            $table->text('deskripsi')->nullable(); // Product description
            $table->decimal('harga', 10, 2); // Product price
            $table->integer('stok')->default(0); // Stock quantity
            $table->string('sku')->unique(); // Stock Keeping Unit, unique identifier
            $table->string('preciew')->nullable(); // URL or path to product image
            $table->enum('status', ['active', 'inactive'])->default('active'); // Product status
            $table->timestamps(); // Created at and updated at timestamps
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
