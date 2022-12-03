<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Locker>
 */
class LockerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'locker ' . $this->faker->word(),
            'serial' => $this->faker->numerify('##########'),
            'last_request_time' => $this->faker->date(),
            'description' => "Descrição do armário",
        ];
    }
}
