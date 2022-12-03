<?php

namespace Database\Seeders;

use App\Models\Door;
use App\Models\Locker;
use Illuminate\Database\Seeder;

class DoorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lockers = Locker::all();

        foreach ($lockers as $locker) {
            Door::factory(5)->create([
                'locker_id' => $locker->id,
            ]);
        }
    }
}
