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
        Schema::create('inventory_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sku_id')->constrained('product_skus');
            $table->foreignId('inventory_type_id')->constrained('inventory_types');
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedMediumInteger('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_records');
    }
};
