<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSpuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'spu_id'  => $this->spu_id,
            'title'  => $this->title,
            'note'  => $this->note,
            'spu_code'  => $this->spu_code,
            'image_1'  => $this->image_1,
            'image_2'  => $this->image_2,
            'image_3'  => $this->image_3,
            'image_4'  => $this->image_4,
            'image_5'  => $this->image_5,
            'image_transparency'  => $this->image_transparency,
            // 'price'  => $this->price,
            // 'sell_price'  => $this->sell_price,
            'mode'  => $this->mode,
            // 'inventory'  => $this->inventory,
            'length'  => $this->length,
            'width'  => $this->width,
            'height'  => $this->height,
            'weight'  => $this->weight,
            'volume'  => $this->volume,
            'stock_code'  => $this->stock_code,
            'stock_name'  => $this->stock_name,
            'introduction'  => $this->introduction->content,
            // 'expired_at'  => $this->expired_at,
            // 'delivery_time'  => $this->delivery_time,
            'bar_code'  => $this->bar_code,
            // 'status'  => $this->status,
            // 'home_page'  => $this->home_page,
            'is_hidden'  => $this->is_hidden,
            'remark'  => $this->remark,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'type_id' => $this->type_id,
            'type_name' => $this->type->name,
            'category_id' => $this->category_id,
            'category_name' => $this->category->name,
            // 'category_two_name' => $this->category_two->name,
            // 'category_three_name' => $this->category_three->name,
            // 'skus' => SkuResource::collection($this->skus),
            'service' => $this->service->content,
            // 'properties' => $this->properties,
            // 'property_contents' => $this->property_contents,
            'user_name' => $this->user->name,
            'user_id' => $this->user_id,
        ];
    }
}
