<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUserAtributes = [
            'id' => 1,
            'name' => 'master',
            'profile_id' => Profile::MASTER_ID,
            'email' => 'admin@azanonatec.com.br',
            'email_verified_at' => now(),
            'password' => bcrypt('q7a4z1x2'), // Hash da senha: password
            'remember_token' => Str::random(10),
        ];
        User::updateOrCreate(['id' => 1,], $testUserAtributes);

        if (app()->environment() != 'production') {
            User::factory(10)->create();
        }
    }
}
