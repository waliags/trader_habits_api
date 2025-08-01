<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalEntryController extends Controller
{
    public function index()
    {
        return JournalEntry::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'content' => 'required|string',
        ]);

        $entry = JournalEntry::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return response()->json($entry, 201);
    }

    public function show($id)
    {
        $entry = JournalEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json($entry);
    }

    public function update(Request $request, $id)
    {
        $entry = JournalEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $validated = $request->validate([
            'date' => 'sometimes|date',
            'content' => 'sometimes|string',
        ]);

        $entry->update($validated);

        return response()->json($entry);
    }

    public function destroy($id)
    {
        $entry = JournalEntry::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $entry->delete();

        return response()->json(null, 204);
    }
}
