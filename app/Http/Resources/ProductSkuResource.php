<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductPropertyContentResource;

class ProductSkuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'sku_id'  => $this->sku_id,
            'name'  => $this->name,
            'sku_code'  => $this->sku_code,
            'image_1'  => $this->image_1,
            // 'price'  => $this->price,
            // 'sell_price'  => $this->sell_price,
            // 'inventory'  => $this->inventory,
            'length'  => $this->length,
            'width'  => $this->width,
            'height'  => $this->height,
            'weight'  => $this->weight,
            'volume'  => $this->volume,
            'stock_code'  => $this->stock_code,
            'stock_name'  => $this->stock_name,
            // 'expired'  => $this->expired,
            // 'expired_at'  => $this->expired_at,
            'bar_code'  => $this->bar_code,
            // 'hidden'  => $this->hidden,
            'remark'  => $this->remark,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'spu_id' => $this->spu->spu_id,
            'spu_mode' => $this->spu->mode,
            'spu_title' => $this->spu->title,
            'property_contents' => ProductPropertyContentResource::collection($this->property_contents),
            'total_inventory' => $this->inventory,    
        ];
    }
}
