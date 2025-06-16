<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
          'Peluqueria', 
          'Electricista', 
          'Carpintería', 
          'Limpieza', 
          'Mudanza', 
          'Plomería', 
          'Refacción', 
          'Pintura', 
          'Técnico'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
