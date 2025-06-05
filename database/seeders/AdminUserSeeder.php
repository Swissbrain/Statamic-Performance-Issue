<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::firstOrCreate(['email' => 'test@test.ch'], [
            'name' => 'Test user',
            'password' => bcrypt('password'),
            'super' => true,
        ]);
    }
}
