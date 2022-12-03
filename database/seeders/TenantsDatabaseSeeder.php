<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TenantsDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfileSeeder::class);
        $this->call(UserSeeder::class);
        // if (app()->environment() != 'production') {
        //     $this->call(TechnicianAccessSeeder::class);
        //     $this->call(LockerSeeder::class);
        //     $this->call(LockerOauthClientSeeder::class);
        // }
    }
}
