<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345')
            ],
            [
                'name' => 'Ara',
                'email' => 'zahraareeqah@gmail.com',
                'password' => Hash::make('sheknow1907')
            ],
            [
                'name' => 'Chichi',
                'email' => 'chichi@gmail.com',
                'password' => Hash::make('chichi123')
            ],
            [
                'name' => 'Who',
                'email' => 'who@gmail.com',
                'password' => Hash::make('who123')
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
