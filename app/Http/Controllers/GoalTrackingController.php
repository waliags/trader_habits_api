<?php

namespace App\Http\Controllers;

use App\Models\GoalTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoalTrackingController extends Controller
{
    public function index()
    {
        // Return only the goals of the logged-in user
        return GoalTracking::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'target_value' => 'required|numeric',
            'current_value' => 'numeric',
            'unit' => 'required|string',
            'deadline' => 'required|date',
        ]);

        // Add user_id to the validated data
        $validated['user_id'] = Auth::id();

        $goal = GoalTracking::create($validated);

        return response()->json($goal, 201);
    }
}
