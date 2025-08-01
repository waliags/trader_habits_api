<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    public function index()
    {
         
        return Habit::where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        $habit = Habit::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return response()->json($habit, 201);
    }

    public function show($id)
    {
        $habit = Habit::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json($habit);
    }

    public function update(Request $request, $id)
    {
        $habit = Habit::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'category' => 'nullable|string',
            'icon' => 'nullable|string',
        ]);

        $habit->update($validated);

        return response()->json($habit);
    }

    public function destroy($id)
    {
        $habit = Habit::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $habit->delete();

        return response()->json(null, 204);
    }
}
