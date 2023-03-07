<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSpu;
use App\Models\ProductPropertyContent;

class ProductSku extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function spu()
    {
        return $this->belongsTo(ProductSpu::class, 'spu_id');
    }

    public function property_contents()
    {
        return $this->belongsToMany(ProductPropertyContent::class, 'product_skus_and_product_property_contents', 'sku_id', 'property_content_id');
    }
}
