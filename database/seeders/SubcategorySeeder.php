<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    public function run()
    {
        $subcategories = [
            'Peluqueria' => ['Cortes de pelo', 'Barberia', 'Peinados', 'Coloracion'],
            'Electricista' => ['Instalaciones', 'Iluminacion', 'Electricista general'],
            'Carpinteria' => ['Aberturas de madera', 'Muebles', 'Machimbre', 'Carpinteria general'],
            'Limpieza' => ['Alfombras', 'Limpieza del hogar', 'Limpieza en altura', 'Limpieza general'],
            'Mudanza' => ['Fletes', 'Mudanza nacionales', 'Mudanza internacional', 'Mudanza en general'],
            'Plomeria' => ['Cañerias', 'Filtraciones', 'Sanitarios', 'Pozos septicos', 'Plomeria general'],
            'Refaccion' => ['Refaccion de baños', 'Refaccion de cocinas', 'Refaccion integrales', 'Refaccion general'],
            'Pintura' => ['Pintura', 'Revestimientos', 'Humedad', 'Otros trabajos'],
            'Tecnico' => ['Computadoras', 'Tablet y celulares', 'Impresoras', 'Electrodomesticos', 'Tecnologia general'],
        ];

        foreach ($subcategories as $catName => $subs) {
            $category = Category::where('name', $catName)->first();
            foreach ($subs as $sub) {
                Subcategory::create([
                    'category_id' => $category->id,
                    'name' => $sub
                ]);
            }
        }
    }
}
