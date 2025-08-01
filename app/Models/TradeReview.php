<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TradeReview extends Model
{
    protected $fillable = [
        'user_id',
        'symbol',
        'side',
        'entry_price',
        'exit_price',
        'quantity',
        'pnl',
        'emotional_state',
        'setup',
        'tags',
        'mistakes',
        'lessons',
        'rating',
        'date'
    ];

    /**
     * Get the user that owns this trade review.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
