<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Import Str class for generating UUID


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [ 
                'id' => Str::uuid(),
                'fullname' => 'Admin',
                'email' => 'integraleducation03@gmail.com',
                'username' => 'admin',
                'password' => bcrypt('integralJaya2024'),
                'role' => 'admin',
                'email_verified_at' => now(),
                'is_completed' => true,
            ]
            // [
            //     'id' => Str::uuid(),
            //     'fullname' => 'Rivaldy Arief',
            //     'email' => 'rivaldyarif32@gmail.com',
            //     'username' => 'rivaldyarif32',
            //     'password' => bcrypt('password'),
            //     'role' => 'student',
            //     'email_verified_at' => now(),
            //     'is_completed' => true,
            // ],
        ];

        // Masukkan data ke dalam tabel
        DB::table('users')->insert($users);
    }
}
