<?php

namespace App\Http\Controllers;

use App\Models\Duel;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ShowDuel extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Duel $duel, Request $request)
    {
        $duel->load('playerOne', 'playerTwo', 'winner', 'championship', 'games');

        return Inertia::render('Duel', [
            'duel' => $duel
        ]);
    }
}
