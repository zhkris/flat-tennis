<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class UpdateGame extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Game $game, Request $request)
    {
        $attr = $request->validate([
            'player_one_point' => ['required', 'boolean'],
            'player_two_point' => ['required', 'boolean'],
            'player_one_win_game' => ['required', 'boolean'],
            'player_two_win_game' => ['required', 'boolean'],
            'player_one_win_duel' => ['required', 'boolean'],
            'player_two_win_duel' => ['required', 'boolean'],
            'rollback_last_point' => ['required', 'boolean'],
        ]);

        // TODO: rollback_last_point
        // TODO: player_one_remove_point
        // TODO: player_two_remove_point

        if ($attr['player_one_point']) {
            $game->increment('player_one_points');
        }
        if ($attr['player_two_point']) {
            $game->increment('player_two_points');
        }

        if ($attr['player_one_win_game']) {
            $game->duel->increment('player_one_wins');
            $game->update([
                'winner_id' => $game->player_one_id
            ]);
            if ($game->duel->player_one_wins < 3) {
                $game->duel->games()->create([
                    'player_one_id' => $game->player_one_id,
                    'player_two_id' => $game->player_two_id,
                    'championship_id' => $game->championship_id
                ]);
            }
        }
        if ($attr['player_two_win_game']) {
            $game->duel->increment('player_two_wins');
            $game->update([
                'winner_id' => $game->player_two_id
            ]);
            if ($game->duel->player_two_wins < 3) {
                $game->duel->games()->create([
                    'player_one_id' => $game->player_one_id,
                    'player_two_id' => $game->player_two_id,
                    'championship_id' => $game->championship_id
                ]);
            }
        }

        if ($attr['player_one_win_duel']) {
            $game->duel()->update([
                'winner_id' => $game->player_one_id
            ]);
        }
        if ($attr['player_two_win_duel']) {
            $game->duel()->update([
                'winner_id' => $game->player_two_id
            ]);
        }

        $game->save();

        return $game->fresh()->duel->load('playerOne', 'playerTwo', 'winner', 'championship', 'games');
    }
}
