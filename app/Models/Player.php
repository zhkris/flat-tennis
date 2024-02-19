<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'tournament_wins' => 'integer',
        'tournament_loses' => 'integer',
        'duel_wins' => 'integer',
        'duel_loses' => 'integer',
        'game_wins' => 'integer',
        'game_loses' => 'integer',
        'earned_points' => 'integer',
        'lost_points' => 'integer',
    ];
}
