<?php

namespace Database\Seeders;

use App\Models\Door;
use App\Models\Locker;
use App\Models\Size;
use Illuminate\Database\Seeder;

class LockerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locker::factory(10)
        ->has(
            Size::factory()->count(3)
            ->state(function (array $attributes, Locker $locker) {
                return ['locker_id' => $locker->id];
            })->has(
                Door::factory()
                ->count(3)
                ->state( function(array $attributes, Size $size)
            {
                return [
                    'locker_id' => $size->locker_id,
                    'size_id' => $size->id,
                ];
            })
          )
        )
        ->create();
    }
}
