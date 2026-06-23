<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'logo'       => $this->getFirstMediaUrl('logo') ?: $this->logo,
            'url'        => $this->url,
            'sort_order' => $this->sort_order,
            'is_active'  => (bool) $this->is_active,
        ];
    }
}
