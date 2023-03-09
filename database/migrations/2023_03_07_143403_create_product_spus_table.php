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
        Schema::create('product_spus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spu_id')->unique(); //系统自动生成的唯一ID
            $table->string('title');
            $table->string('note')->nullable(); //简介
            $table->string('remark')->nullable(); //简易备注
            $table->string('spu_code')->index(); //编码
            $table->string('image_1');
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->string('image_5')->nullable();
            $table->string('image_transparency')->nullable();
            $table->unsignedInteger('price')->default(1000);
            $table->unsignedInteger('sell_price')->default(1000);
            $table->unsignedTinyInteger('mode')->default(1); //类型 1 单SKU商品 2 多SKU商品 3 多维SKU商品
            $table->unsignedMediumInteger('inventory')->default(0); //总可售库存
            $table->string('length')->nullable(); //商品长
            $table->string('width')->nullable(); //商品宽
            $table->string('height')->nullable(); //商品高
            $table->string('weight')->nullable(); //商品重量
            $table->string('volume')->nullable(); //商品体积
            $table->string('stock_code')->nullable(); //仓库代码
            $table->string('stock_name')->nullable(); //仓库简称
            $table->boolean('expired')->default(0); //长期产品
            $table->date('expired_at')->default('2099-12-31'); //失效时间
            $table->unsignedTinyInteger('delivery_time')->default(12); //发货时间
            $table->string('bar_code')->nullable(); //条形码
            $table->boolean('is_hidden')->default(1); //对外公开
            $table->foreignId('category_id')->constrained('product_categories');
            // $table->foreignId('type_id')->constrained('product_types');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('user_id'); //商品负责人
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_spus');
    }
};
