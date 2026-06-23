<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'email',
        'logo',
        'favicon',
        'social_links',
        'footer_text',
        'default_seo_title',
        'default_seo_description',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    /**
     * Get the single site setting record.
     */
    public static function getSetting(): ?self
    {
        return self::first();
    }
}
