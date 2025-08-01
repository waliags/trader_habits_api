<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GoalTracking extends Model
{
    protected $table = 'goal_tracking';

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'target_value',
        'current_value',
        'unit',
        'deadline',
    ];

    /**
     * Get the user that owns this goal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
