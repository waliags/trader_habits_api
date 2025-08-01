<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HabitCompletion extends Model
{
    protected $fillable = [
        'habit_id',
        'user_id',
        'date',
    ];

    /**
     * Get the habit associated with this completion.
     */
    public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }

    /**
     * Get the user who completed the habit.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
