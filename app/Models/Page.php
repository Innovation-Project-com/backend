<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Page Model
 * Represents CMS-driven pages (About, Contact, etc.)
 *
 * @property int    $id
 * @property string $title
 * @property string $slug
 * @property string $page_type
 * @property string|null $hero_title
 * @property string|null $hero_subtitle
 * @property array|null  $content_blocks  (JSONB)
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $og_image
 * @property string $status  (published|draft|archived)
 * @property \Carbon\Carbon|null $published_at
 */
class Page extends Model
{
    use HasFactory;

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
