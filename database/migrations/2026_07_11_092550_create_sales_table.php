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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id'); // Kinokonekta ang benta sa products table
            $table->integer('quantity');
            $table->decimal('selling_price', 10, 2);
            $table->date('sales_date');
            $table->timestamps(); // Gagawa ng created_at at updated_at automatic
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
