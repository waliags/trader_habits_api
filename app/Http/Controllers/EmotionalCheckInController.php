<?php

namespace App\Http\Controllers;

use App\Models\EmotionalCheckIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmotionalCheckInController extends Controller
{
    public function index()
    {
        // Return only the logged-in user's check-ins
        return EmotionalCheckIn::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|unique:emotional_check_ins,date,NULL,id,user_id,' . Auth::id(),
            'mood' => 'required|in:excellent,good,neutral,stressed,angry',
        ]);

        $validated['user_id'] = Auth::id();

        $checkIn = EmotionalCheckIn::create($validated);

        return response()->json($checkIn, 201);
    }
}
