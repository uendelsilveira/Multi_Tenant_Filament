<?php

namespace Database\Factories;

use App\Models\Door;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Door>
 */
class DoorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number'        => $this->faker->numerify('##'),
            'status'        => $this->faker->randomElement(Door::statusArray()),
            'locker_id'     => Locker::factory(),
            'size_id'       => Size::factory(),
        ];
    }
}
