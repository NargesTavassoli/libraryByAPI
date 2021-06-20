<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'tavassoli',
            'email' => 'tavassoli@gmail.com',
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
        ]);
    }

}
