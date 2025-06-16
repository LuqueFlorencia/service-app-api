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
            'Peluqueria' => ['Cortes de pelo', 'Barbería', 'Peinados', 'Coloración'],
            'Electricista' => ['Instalaciones', 'Iluminación', 'Electricista general'],
            'Carpintería' => ['Aberturas de madera', 'Muebles', 'Machimbre', 'Carpintería general'],
            'Limpieza' => ['Alfombras', 'Limpieza del hogar', 'Limpieza en altura', 'Limpieza general'],
            'Mudanza' => ['Fletes', 'Mudanza nacionales', 'Mudanza internacional', 'Mudanza en general'],
            'Plomería' => ['Cañerías', 'Filtraciones', 'Sanitarios', 'Pozos sépticos', 'Plomería general'],
            'Refacción' => ['Refacción de baños', 'Refacción de cocinas', 'Refacción integrales', 'Refacción general'],
            'Pintura' => ['Pintura', 'Revestimientos', 'Humedad', 'Otros trabajos'],
            'Técnico' => ['Computadoras', 'Tablet y celulares', 'Impresoras', 'Electrodomésticos', 'Tecnología general'],
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
