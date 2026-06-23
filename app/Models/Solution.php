<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Solution extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'benefits',
        'features',
        'use_cases',
        'faq_items',
        'seo_title',
        'seo_description',
        'og_image',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'benefits'   => 'array',
        'features'   => 'array',
        'use_cases'  => 'array',
        'faq_items'  => 'array',
        'sort_order' => 'integer',
    ];

    /**
     * Scope to only return published solutions.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
