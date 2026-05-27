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
            $table->id()->primary();
            $table->timestamps();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            // sku as stock keeping unit, which is the barcode
            $table->string('SKU')->unique();
            $table->string('name');
            $table->integer('current_stock')->default(0);
            $table->integer('min_required_stock')->default(0);
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
