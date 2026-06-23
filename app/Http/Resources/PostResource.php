<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $featuredImageUrl = $this->getFirstMediaUrl('featured_image') ?: $this->featured_image;
        $ogImageUrl = $this->getFirstMediaUrl('og_image') ?: $this->og_image;

        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'excerpt'        => $this->excerpt,
            'body'           => $this->body,
            'featured_image' => $featuredImageUrl,
            'category'       => new CategoryResource($this->whenLoaded('category')),
            'tags'           => TagResource::collection($this->whenLoaded('tags')),
            'author_name'    => $this->author_name,
            'reading_time'   => (int) $this->reading_time,
            'status'         => $this->status,
            'published_at'   => $this->published_at?->toISOString(),
            'is_featured'    => (bool) $this->is_featured,
            'seo'            => [
                'title'       => $this->seo_title,
                'description' => $this->seo_description,
                'og_image'    => $ogImageUrl,
            ],
            'related_posts'  => PostResource::collection($this->when(isset($this->related_posts), fn () => $this->related_posts)),
        ];
    }
}
