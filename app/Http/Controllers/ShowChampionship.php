<?php

namespace App\Http\Controllers;

use App\Models\Championship;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ShowChampionship extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Championship $championship, Request $request)
    {
        $championship->load('duels.playerOne', 'duels.playerTwo', 'duels.winner');

        return Inertia::render('ChampionshipDuels', [
            'championship' => $championship
        ]);
    }
}
