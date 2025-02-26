<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Asegúrate de cambiar esto en producción
        ]);

        // Create 10 more users
        User::factory()->count(10)->create();
    }
}
