<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Solution Model
 * Represents ERP, TMS, WMS, MRP, IoT solution pages.
 *
 * @property int    $id
 * @property string $name
 * @property string $slug
 * @property string $short_description
 * @property string $description
 * @property array  $benefits   (JSONB)
 * @property array  $features   (JSONB)
 * @property array  $use_cases  (JSONB)
 * @property array  $faq_items  (JSONB)
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $og_image
 * @property string $status  (published|draft|archived)
 */
class Solution extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'benefits'  => 'array',
        'features'  => 'array',
        'use_cases' => 'array',
        'faq_items' => 'array',
    ];

    /**
     * Scope to only return published solutions.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
