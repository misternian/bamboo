<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSpu;
use App\Models\ProductPropertyContent;
use App\Models\InventoryType;
use EloquentFilter\Filterable;

class ProductSku extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function spu()
    {
        return $this->belongsTo(ProductSpu::class, 'spu_id');
    }

    public function property_contents()
    {
        return $this->belongsToMany(ProductPropertyContent::class, 'product_skus_and_product_property_contents', 'sku_id', 'property_content_id');
    }

    public function inventories()
    {
        return $this->belongsToMany(InventoryType::class, 'inventories', 'sku_id', 'type_id')->withPivot('number', 'updated_at')->withTimestamps();
    }
}
