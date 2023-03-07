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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sn')->index();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('order_type_id')->constrained('order_types');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedMediumInteger('sku_num')->nullable(); //销售sku总数量
            $table->unsignedInteger('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
