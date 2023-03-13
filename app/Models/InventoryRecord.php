<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InventoryType;
use App\Models\User;
use App\Models\ProductSku;

class InventoryRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventory_type()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function sku()
    {
        return $this->belongsTo(ProductSku::class, 'sku_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
