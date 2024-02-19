<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('duels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('championship_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_one_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('player_two_id')->constrained('players')->cascadeOnDelete();
            $table->foreignId('winner_id')->nullable()->constrained('players')->cascadeOnDelete();
            $table->unsignedBigInteger('player_one_wins')->default(0);
            $table->unsignedBigInteger('player_two_wins')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duels');
    }
};
