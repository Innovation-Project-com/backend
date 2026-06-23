<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'page_type',
        'hero_title',
        'hero_subtitle',
        'content_blocks',
        'seo_title',
        'seo_description',
        'og_image',
        'status',
        'published_at',
    ];

    protected $casts = [
        'content_blocks' => 'array',
        'published_at'   => 'datetime',
    ];

    /**
     * Scope to only return published pages.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
