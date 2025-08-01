<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiskMetric extends Model
{
    protected $fillable = [
        'account_size',
        'risk_per_trade',
        'daily_loss_limit',
        'max_drawdown',
    ];
}
