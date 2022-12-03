<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\SystemUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class SystemUserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $atributes = [
            'id' => 1,
            'name' => 'master',
            'profile_id' => Profile::MASTER_ID,
            'email' => 'admin@azanonatec.com.br',
            'email_verified_at' => now(),
            'password' => '$2y$10$HJPt1yW3DC9zp5s4v7lluO3oXGCxRgSAZF8d/0aC5fsfCqpL7TafK', // Hash da senha
            'remember_token' => Str::random(10),
        ];

        SystemUser::query()->updateOrCreate($atributes);
    }
}
