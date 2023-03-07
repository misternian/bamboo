<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'article_category_id' => $this->article_category_id,
            'article_category' => $this->category->name,
            'showed' => $this->showed,
            'user_id' => $this->user_id,
            'author' => $this->user->name,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at, 
        ];
    }
}
