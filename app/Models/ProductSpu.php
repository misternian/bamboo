<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductService;
use App\Models\ProductType;
use App\Models\ProductIntroduction;
use App\Models\ProductCategory;
use App\Models\ProductProperty;
use App\Models\ProductPropertyContent;
use App\Models\ProductSku;
use App\Models\User;
use EloquentFilter\Filterable;

class ProductSpu extends Model
{
    use HasFactory, Filterable;

    protected $guarded = [];

    public function service()
    {
        return $this->hasOne(ProductService::class, 'spu_id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function introduction()
    {
        return $this->hasOne(ProductIntroduction::class, 'spu_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function properties()
    {
        return $this->belongsToMany(ProductProperty::class, 'product_spus_and_product_properties', 'spu_id', 'property_id');
    }

    public function property_contents()
    {
        return $this->hasMany(ProductPropertyContent::class, 'spu_id');
    }

    public function skus()
    {
        return $this->hasMany(ProductSku::class, 'spu_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
