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
        Schema::create('product_property_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('product_properties');
            $table->foreignId('spu_id')->constrained('product_spus');
            $table->string('value');
            $table->tinyInteger('sort')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_property_contents');
    }
};
