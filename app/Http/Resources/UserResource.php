<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            // 'email_verified_at' => $this->email_verified_at,
            'avatar_url' => $this->avatar_url,
            'real_name' => $this->real_name,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'login_count' => $this->login_count,
            'previous_login_at' => $this->previous_login_at,
            'last_login_at' => $this->last_login_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
