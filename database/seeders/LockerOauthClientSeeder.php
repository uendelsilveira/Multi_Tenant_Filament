<?php

namespace Database\Seeders;

use App\Models\Locker;
use Illuminate\Database\Seeder;
use Laravel\Passport\ClientRepository;

class LockerOauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientRepository = new ClientRepository();
        $lockersIds = Locker::all()->pluck('id');

        foreach ($lockersIds as $lockerId) {
            $clientRepository->create($lockerId,
            'Locker Personal Access Client',
            "", 'lockers', true);
        }
    }
}





