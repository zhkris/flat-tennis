<?php

namespace App\Models;

use App\Models\Championship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'player_one_id' => 'integer',
        'player_two_id' => 'integer',
    ];

    public function playerOne(): BelongsTo
    {
        return $this->belongsTo(
            related: Player::class,
            foreignKey: 'player_one_id'
        );
    }

    public function playerTwo(): BelongsTo
    {
        return $this->belongsTo(
            related: Player::class,
            foreignKey: 'player_two_id'
        );
    }

    public function championship(): BelongsTo
    {
        return $this->belongsTo(
            related: Championship::class,
            foreignKey: 'championship_id'
        );
    }

    public function duel(): BelongsTo
    {
        return $this->belongsTo(
            related: Duel::class,
            foreignKey: 'duel_id'
        );
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(
            related: Player::class,
            foreignKey: 'winner_id'
        );
    }
}
