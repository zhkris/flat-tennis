<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Championship;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@tennis.com',
        ]);

        $players = collect([
            ['name' => 'Rostislav R.'],
            ['name' => 'Kristiyan Z.'],
            ['name' => 'Valentin V.']
        ])->map(fn ($v) => [...$v, 'created_at' => $now = now(), 'updated_at' => $now])->toArray();

        Player::insert($players);

        Championship::create(['name' => 'Default Championship']);
    }
}
