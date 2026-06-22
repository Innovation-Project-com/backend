<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SolutionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'benefits'          => $this->benefits,
            'features'          => $this->features,
            'use_cases'         => $this->use_cases,
            'faq_items'         => $this->faq_items,
            'og_image'          => $this->og_image,
            'seo'               => [
                'title'       => $this->seo_title,
                'description' => $this->seo_description,
                'og_image'    => $this->og_image,
            ],
        ];
    }
}
