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
          'Carpinteria', 
          'Limpieza', 
          'Mudanza', 
          'Plomeria', 
          'Refaccion', 
          'Pintura', 
          'Tecnico'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
