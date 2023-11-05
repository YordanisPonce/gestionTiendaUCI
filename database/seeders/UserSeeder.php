<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = collect([
            [
                'name' => 'Super Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('adminadmin'),
                'role' => 'super-admin',
                'area_id'=> 1,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@dashcode.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'admin',
                'area_id'=> 1,
            ],
            [
                'name' => 'User',
                'email' => 'user@dashcode.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'user',
                'area_id'=> 1,
            ],
        ]);

        $users->map(function ($user) {
            $user = collect($user);
            $newUser = User::create($user->except('role')->toArray());
            $newUser->assignRole($user['role']);
        });
    }
}