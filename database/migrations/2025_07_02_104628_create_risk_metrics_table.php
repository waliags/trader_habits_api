<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('risk_metrics', function (Blueprint $table) {
            $table->id();
            $table->decimal('account_size', 12, 2);
            $table->decimal('risk_per_trade', 5, 2); // percentage
            $table->decimal('daily_loss_limit', 10, 2);
            $table->decimal('max_drawdown', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_metrics');
    }
};
