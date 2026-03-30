<?php

namespace Database\Factories;

use App\Models\Maladie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\patient>
 */
class MaladieFactory extends Factory
{
    protected $model = Maladie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'rarete' => fake()->randomElement(['faible','moyenne','haute']),
        ];
    }
}
