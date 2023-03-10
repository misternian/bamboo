<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductPropertyContentResource extends JsonResource
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
            'value'  => $this->value,
            'property_id'  => $this->property_id,
            'property_name'  => $this->property->name,
            'spu_id'  => $this->spu_id,
            'sort'  => $this->sort,
        ];
    }
}
