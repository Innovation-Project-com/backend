<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Lead Model
 * Represents contact form submissions.
 *
 * Statuses: new | contacted | qualified | proposal_sent | closed | archived
 *
 * @property int    $id
 * @property string $name
 * @property string|null $company
 * @property string $email
 * @property string|null $phone
 * @property string|null $interested_solution
 * @property string $message
 * @property string|null $source_page
 * @property string $status
 * @property string|null $follow_up_notes
 */
class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'interested_solution',
        'message',
        'source_page',
        'status',
        'follow_up_notes',
    ];

    protected $casts = [];

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'status' => 'new',
    ];
}
