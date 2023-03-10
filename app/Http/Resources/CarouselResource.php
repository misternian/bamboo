<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarouselResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'refer_url' => $this->refer_url,
            'is_active' => $this->is_active,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
