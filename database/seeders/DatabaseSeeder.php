<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        ProfileSeeder::class,
        //CategorySeeder::class,
        //SubcategorySeeder::class,
        ServiceSeeder::class,
        AppointmentSeeder::class,
    ]);
    }
}