<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Club;
use App\Models\Jugador;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un club con 10 futbolistas
        Club::factory()->has(Jugador::factory()->count(10), 'jugadores')->create();

        // Crear tres clubes con 25 futbolistas
        Club::factory()->count(3)->has(Jugador::factory()->count(25), 'jugadores')->create();

        // Crear un club con 30 futbolistas
        Club::factory()->has(Jugador::factory()->count(30), 'jugadores')->create();

        // Crear dos clubes con 15 futbolistas
        Club::factory()->count(2)->has(Jugador::factory()->count(15), 'jugadores')->create();
    }
}
