<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'login' => 'Admin',
            'password' => Hash::make('1234'),
            'first_name' => 'Sergey',
            'last_name' => 'Lototsky',
            'date_birthday' => now(),
        ]);
    }
}
