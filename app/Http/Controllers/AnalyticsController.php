<?php

namespace App\Http\Controllers;

use App\Models\GoalTracking;
use App\Models\EmotionalCheckIn;
use App\Models\Habit;
use App\Models\HabitCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $userId = Auth::id();
        $date = $request->input('date');

        // Get total habits (all time)
        $totalHabits = Habit::where('user_id', $userId)->count();

        // Get completed habits on selected date
        $completedHabits = HabitCompletion::where('user_id', $userId)
            ->whereDate('created_at', $date)
            ->count();

        // Get mood summary for the selected date
        $moodSummary = EmotionalCheckIn::where('user_id', $userId)
            ->whereDate('created_at', $date)
            ->select('mood', DB::raw('count(*) as count'))
            ->groupBy('mood')
            ->orderBy('count', 'desc')
            ->get();

        // Get goal progress for selected date
        $goalProgress = GoalTracking::where('user_id', $userId)
    ->whereDate('created_at', $date)
    ->get()
    ->map(function ($goal) {
        $progress = ($goal->target_value > 0)
            ? round(($goal->current_value / $goal->target_value) * 100, 1)
            : 0;

        return [
            'title' => $goal->title,
            'progress' => $progress, // percent
            'unit' => $goal->unit,
            'target_value' => $goal->target_value,
            'current_value' => $goal->current_value,
        ];
    })->sortByDesc('progress')->values();

        return response()->json([
            'total_habits' => $totalHabits,
            'completed_habits' => $completedHabits,
            'mood_summary' => $moodSummary,
            'goal_progress' => $goalProgress,
        ]);
    }
}
