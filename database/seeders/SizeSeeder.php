<?php

namespace Database\Seeders;

use App\Models\Locker;
use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lockersIds = Locker::all()->pluck('id');

        foreach ($lockersIds as $lockerId) {
            Size::factory(2)->create(["locker_id" => $lockerId]);
        }
    }
}
