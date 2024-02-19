<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Championship;
use Illuminate\Http\Request;

class ShowChampionships extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Championships', [
            'championships' => Championship::all()
        ]);
    }
}
