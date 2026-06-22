<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'page_type'      => $this->page_type,
            'hero_title'     => $this->hero_title,
            'hero_subtitle'  => $this->hero_subtitle,
            'content_blocks' => $this->content_blocks,
            'seo'            => [
                'title'       => $this->seo_title,
                'description' => $this->seo_description,
                'og_image'    => $this->og_image,
            ],
            'published_at'   => $this->published_at?->toISOString(),
        ];
    }
}
