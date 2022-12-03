<?php

namespace Database\Factories;

use App\Models\Locker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locker_ids = Locker::all()->pluck("id");

        return [
            'description' => $this->faker->randomElement(array('big','medium','small')),
            'width' => $this->faker->numerify('##'),
            'height'=> $this->faker->numerify('##'),
            'depth' => $this->faker->numerify('##'),
            'locker_id' => $this->faker->randomElement($locker_ids),
        ];
    }
}
