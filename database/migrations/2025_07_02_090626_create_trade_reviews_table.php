<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('trade_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('symbol');
            $table->enum('side', ['long', 'short']);
            $table->decimal('entry_price', 10, 2);
            $table->decimal('exit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('pnl', 10, 2);
            $table->string('emotional_state')->nullable();
            $table->string('setup')->nullable();
            $table->text('tags')->nullable();        // Comma-separated
            $table->text('mistakes')->nullable();    // Comma-separated
            $table->text('lessons')->nullable();
            $table->integer('rating');
            $table->date('date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trade_reviews');
    }
};
