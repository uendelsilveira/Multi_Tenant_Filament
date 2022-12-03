<?php

namespace Database\Seeders;

use App\Models\Locker;
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
        Locker::factory(10)->create();
    }
}
