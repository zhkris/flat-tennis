<?php

namespace App\Models;

use App\Models\Duel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Championship extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::created(function (Championship $championship) {
            $players = Player::pluck('id');

            for ($i = 0; $i < $players->count(); $i++) {
                for ($j = $i + 1; $j < $players->count(); $j++) {
                    $duel = $championship->duels()->create([
                        'player_one_id' => $players[$i],
                        'player_two_id' => $players[$j]
                    ]);

                    $duel->games()->create([
                        'player_one_id' => $players[$i],
                        'player_two_id' => $players[$j],
                        'championship_id' => $championship->id
                    ]);
                }
            }
        });
    }

    public function duels(): HasMany
    {
        return $this->hasMany(
            related: Duel::class,
            foreignKey: 'championship_id'
        )->orderByDesc('winner_id');
    }
}
