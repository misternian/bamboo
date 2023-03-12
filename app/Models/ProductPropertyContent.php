<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductProperty;
use App\Models\ProductSku;

class ProductPropertyContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(ProductProperty::class, 'property_id');
    }

    public function skus()
    {
        return $this->belongsToMany(ProductSku::class, 'product_skus_and_product_property_contents', 'property_content_id', 'sku_id');
    }
}
