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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('championship_wins')->default(0);
            $table->unsignedBigInteger('championship_loses')->default(0);
            $table->unsignedBigInteger('duel_wins')->default(0);
            $table->unsignedBigInteger('duel_loses')->default(0);
            $table->unsignedBigInteger('game_wins')->default(0);
            $table->unsignedBigInteger('game_loses')->default(0);
            $table->unsignedBigInteger('earned_points')->default(0);
            $table->unsignedBigInteger('lost_points')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
