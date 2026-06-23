<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PageView extends Model
{
    use HasFactory;

    // Disabling Laravel standard updated_at since it's an append-only log table
    const UPDATED_AT = null;

    protected $fillable = [
        'page_url',
        'page_type',
        'referrable_id',
        'referrable_type',
        'visitor_ip',
        'user_agent',
        'referer',
        'country',
        'city',
        'session_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function referrable(): MorphTo
    {
        return $this->morphTo();
    }
}
