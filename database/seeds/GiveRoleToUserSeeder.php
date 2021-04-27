<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class GiveRoleToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::where('email', 'admin@test.com')->firstOrFail();
        $admin->assignRole('admin');

        $user = User::where('email', 'user@test.com')->firstOrFail();
        $user->assignRole('user');
    }
}