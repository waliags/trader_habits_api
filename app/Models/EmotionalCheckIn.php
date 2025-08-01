<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmotionalCheckIn extends Model
{
    protected $fillable = [
        'date',
        'mood',
        'user_id',
    ];

    /**
     * Get the user that owns the emotional check-in.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
