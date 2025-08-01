<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('emotional_check_ins', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->enum('mood', ['excellent', 'good', 'neutral', 'stressed', 'angry']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emotional_check_ins');
    }
};
