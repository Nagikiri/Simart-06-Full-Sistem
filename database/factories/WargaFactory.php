<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->numerify('################'),
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => fake()->phoneNumber(),
            'password' => Hash::make('password'),
            'role' => 'warga',
        ];
    }

    /**
     * Indicate that the warga is an RT.
     */
    public function rt(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'rt',
        ]);
    }
}
