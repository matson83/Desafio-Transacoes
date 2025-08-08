<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Matson Junior',
                'email' => 'matson@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Lettiery',
                'email' => 'lettiery@example.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Bruno Martins',
                'email' => 'Bruno@example.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
