<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'  => $this->id,
            'inventory_type_name' => $this->inventory_type->name,
            'sku_id' => $this->sku->sku_id,
            'sku_code' => $this->sku->sku_code,
            'user_name' => $this->user->name,
            'number'  => $this->number,
            'created_at'  => $this->created_at,
            'order_id' => $this->order_id,
            'sku_spu_title' => $this->sku->spu->title,
            'sku_name' => $this->sku->name,
            'sku_image' => $this->sku->image_1,
        ];
    }
}
