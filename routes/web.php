<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShowChampionship;
use App\Http\Controllers\ShowChampionships;
use App\Http\Controllers\ShowDuel;
use App\Models\Championship;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/test', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', ShowChampionships::class)->name('championships');
    Route::get('/championships/{championship}', ShowChampionship::class)->name('championships.show');
    Route::get('/championships/duels/{duel}', ShowDuel::class)->name('duels.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
