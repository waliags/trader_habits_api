<?php

namespace App\Http\Controllers;

use App\Models\TradeReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradeReviewController extends Controller
{
    public function index()
    {
        return TradeReview::where('user_id', auth()->id())->get();
    }

   public function store(Request $request)
    {
        $request->validate([
            'symbol' => 'required|string|max:10',
            'side' => 'required|in:long,short',
            'entry_price' => 'required|numeric',
            'exit_price' => 'required|numeric',
            'quantity' => 'required|integer',
            'pnl' => 'required|numeric',
            'emotional_state' => 'nullable|string',
            'setup' => 'nullable|string',
            'tags' => 'nullable|string',
            'mistakes' => 'nullable|string',
            'lessons' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'date' => 'required|date',
        ]);

        $review = TradeReview::create([
            'user_id' => Auth::id(), // Or manually assign a user ID for now
            'symbol' => $request->symbol,
            'side' => $request->side,
            'entry_price' => $request->entry_price,
            'exit_price' => $request->exit_price,
            'quantity' => $request->quantity,
            'pnl' => $request->pnl,
            'emotional_state' => $request->emotional_state,
            'setup' => $request->setup,
            'tags' => $request->tags,
            'mistakes' => $request->mistakes,
            'lessons' => $request->lessons,
            'rating' => $request->rating,
            'date' => $request->date,
        ]);

        return response()->json(['message' => 'Trade review saved successfully', 'data' => $review], 201);
    }
}
