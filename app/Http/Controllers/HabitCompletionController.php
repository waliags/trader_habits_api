<?php

namespace App\Http\Controllers;

use App\Models\HabitCompletion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitCompletionController extends Controller
{
    public function today()
    {
        $today = now()->toDateString();
        $userId = Auth::id();

        return HabitCompletion::where('user_id', $userId)
            ->whereDate('date', $today)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'date' => 'required|date',
        ]);

        $completion = HabitCompletion::create([
            'habit_id' => $request->habit_id,
            'date' => $request->date,
            'user_id' => Auth::id(),
        ]);

        return response()->json($completion, 201);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'habit_id' => 'required|integer',
            'date' => 'required|date',
        ]);

        $deleted = HabitCompletion::where('habit_id', $request->habit_id)
            ->where('user_id', Auth::id())
            ->whereDate('date', $request->date)
            ->delete();

        return response()->json(['deleted' => $deleted > 0]);
    }

    public function getStreak()
    {
        $userId = Auth::id();
        $habitDates = HabitCompletion::where('user_id', $userId)
            ->pluck('date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
            ->toArray();

        $streak = $this->calculateStreak($habitDates);
        return response()->json(['streak' => $streak]);
    }

    private function calculateStreak(array $dates)
    {
        $dates = array_unique($dates);
        rsort($dates); // sort descending

        $streak = 0;
        $expectedDate = now()->toDateString();

        foreach ($dates as $date) {
            if ($date === $expectedDate) {
                $streak++;
                $expectedDate = now()->subDays($streak)->toDateString();
            } else {
                break;
            }
        }

        return $streak;
    }
}
