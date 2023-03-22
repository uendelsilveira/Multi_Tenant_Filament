<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profileDataArray = [
            [ 'id' => Profile::ADMIN_ID, 'level' => 'admin' ],
            [ 'id' => Profile::MASTER_ID, 'level' => 'master' ],
            [ 'id' => Profile::OPERATOR_ID, 'level' => 'operator' ],
        ];

        foreach ($profileDataArray as $profileData) {
            Profile::updateOrCreate($profileData);
        }
    }
}
