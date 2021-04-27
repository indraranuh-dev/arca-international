<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret_password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@test.com',
                'email_verified_at' => now(),
                'password' => bcrypt('secret_password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        return User::insert($data);
    }
}