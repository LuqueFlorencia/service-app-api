<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        //Clientes
        User::factory()->create([
            'email' => 'mirta@example.com',
            'password' => Hash::make('123456'),
            'role' => 'client',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'lucas@example.com',
            'password' => Hash::make('123456'),
            'role' => 'client',
            'is_premium' => false,
        ]);

        //Profesionales
        User::factory()->create([
            'email' => 'martin@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => true,
        ]);

        User::factory()->create([
            'email' => 'luis@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'natalia@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'ricardo@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'marcos@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'andrea@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'soledad@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);

        User::factory()->create([
            'email' => 'daniel@example.com',
            'password' => Hash::make('123456'),
            'role' => 'professional',
            'is_premium' => false,
        ]);
    }
}
