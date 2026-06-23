<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiteSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'company_name'            => $this->company_name,
            'address'                 => $this->address,
            'phone'                   => $this->phone,
            'email'                   => $this->email,
            'logo'                    => $this->getFirstMediaUrl('logo') ?: $this->logo,
            'favicon'                 => $this->getFirstMediaUrl('favicon') ?: $this->favicon,
            'social_links'            => $this->social_links,
            'footer_text'             => $this->footer_text,
            'default_seo_title'       => $this->default_seo_title,
            'default_seo_description' => $this->default_seo_description,
        ];
    }
}
