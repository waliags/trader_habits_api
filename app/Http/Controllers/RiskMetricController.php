<?php

namespace App\Http\Controllers;

use App\Models\RiskMetric;
use Illuminate\Http\Request;

class RiskMetricController extends Controller
{
    public function index()
    {
        return RiskMetric::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_size' => 'required|numeric',
            'risk_per_trade' => 'required|numeric',
            'daily_loss_limit' => 'required|numeric',
            'max_drawdown' => 'required|numeric',
        ]);

        $metric = RiskMetric::create($validated);

        return response()->json($metric, 201);
    }
}
