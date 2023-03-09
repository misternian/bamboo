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
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sku_id')->unique(); //系统自动生成的唯一ID
            $table->foreignId('spu_id')->constrained('product_spus');
            $table->string('name')->nullable();  //规格名称
            $table->string('remark')->nullable(); //简易备注
            $table->string('sku_code')->index(); //编码
            $table->string('image_1');
            $table->unsignedInteger('price')->default(1000);
            $table->unsignedInteger('sell_price')->default(1000);
            $table->unsignedMediumInteger('inventory')->default(0); //可售库存
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('stock_code')->nullable(); //仓库代码
            $table->string('stock_name')->nullable(); //仓库简称
            $table->boolean('is_hidden')->default(0); //是否隐藏
            $table->boolean('expired')->default(0); //是否过期，同spu的失效时间是不同概念
            $table->date('expired_at')->default('2099-12-31'); //保质期，同spu的失效时间是不同概念
            $table->string('bar_code')->nullable(); //条形码
            $table->unsignedTinyInteger('sort')->default(1); //排序
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skus');
    }
};
