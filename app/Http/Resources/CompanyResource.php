<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'introduction' => $this->introduction,
            'address' => $this->address,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'email' => $this->email,
            'skype' => $this->skype,
            'website' => $this->website,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
