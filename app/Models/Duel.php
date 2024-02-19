<?php

namespace App\Models;

use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Duel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'player_one_id' => 'integer',
        'player_two_id' => 'integer',
    ];

    public function championship(): BelongsTo
    {
        return $this->belongsTo(
            related: Championship::class,
            foreignKey: 'championship_id'
        );
    }

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

    public function winner(): BelongsTo
    {
        return $this->belongsTo(
            related: Player::class,
            foreignKey: 'winner_id'
        );
    }

    public function games(): HasMany
    {
        return $this->hasMany(
            related: Game::class,
            foreignKey: 'duel_id'
        );
    }
}
