<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SiteSetting Model
 * Stores global website configuration — singleton pattern (one row).
 *
 * @property int    $id
 * @property string $company_name
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $logo
 * @property string|null $favicon
 * @property array|null  $social_links  (JSONB)
 * @property string|null $footer_text
 * @property string|null $default_seo_title
 * @property string|null $default_seo_description
 */
class SiteSetting extends Model
{
    use HasFactory;

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
