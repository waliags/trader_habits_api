<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Habit;
use App\Models\HabitCompletion;
use App\Models\GoalTracking;
use App\Models\TradeReview;
use App\Models\JournalEntry;
use App\Models\EmotionalCheckIn;




class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function emotionalCheckIns()
    {
        return $this->hasMany(EmotionalCheckIn::class);
    }

    public function tradeReviews()
    {
        return $this->hasMany(TradeReview::class);
    }

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function habitCompletions()
    {
        return $this->hasMany(HabitCompletion::class);
    }

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }

    public function goalTrackings()
    {
        return $this->hasMany(GoalTracking::class);
    }

}
