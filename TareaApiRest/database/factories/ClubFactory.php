<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Club>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefijos = ['FC', 'CF', 'Real', 'Sporting', 'Deportivo', 'Atlético'];
        $divisiones = ['1ª División', '2ª División', '1ª RFEF', '2ª RFEF', '3ª RFEF'];

        return [
            'nombre' => $this->faker->randomElement($prefijos) . ' ' . $this->faker->city(),
            'direccion_estadio' => $this->faker->streetAddress(),
            'presidente' => $this->faker->name(),
            'color_equipacion' => $this->faker->safeColorName(),
            'ciudad' => $this->faker->city(),
            'pais' => $this->faker->country(),
            'division' => $this->faker->randomElement($divisiones),
            'fecha_creacion' => $this->faker->date(),
        ];
    }
}
