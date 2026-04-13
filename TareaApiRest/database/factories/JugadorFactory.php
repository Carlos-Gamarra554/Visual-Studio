<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jugador>
 */
class JugadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $posiciones = ['PT', 'LD', 'LI', 'DF', 'MC', 'MD', 'MI', 'ED', 'EI', 'DC'];

        return [
            'nombre' => $this->faker->name(),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'ciudad_nacimiento' => $this->faker->city(),
            'pais_nacimiento' => $this->faker->country(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'posicion' => $this->faker->randomElement($posiciones),
        ];
    }
}
