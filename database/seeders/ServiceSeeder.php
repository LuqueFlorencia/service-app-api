<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'email' => 'martin@example.com',
                'subcategory' => 'Cortes de pelo',
                'name' => 'Corte clásico de cabello',
                'price' => 3000,
            ],
            [
                'email' => 'luis@example.com',
                'subcategory' => 'Instalaciones',
                'name' => 'Instalación eléctrica completa',
                'price' => 45000,
            ],
            [
                'email' => 'natalia@example.com',
                'subcategory' => 'Iluminación',
                'name' => 'Colocación de luminarias LED',
                'price' => 18000,
            ],
            [
                'email' => 'ricardo@example.com',
                'subcategory' => 'Electricista general',
                'name' => 'Revisión general del sistema eléctrico',
                'price' => 22000,
            ],
            [
                'email' => 'marcos@example.com',
                'subcategory' => 'Aberturas de madera',
                'name' => 'Puerta de cedro a medida',
                'price' => 55000,
            ],
            [
                'email' => 'andrea@example.com',
                'subcategory' => 'Muebles',
                'name' => 'Diseño y fabricación de estantes',
                'price' => 38000,
            ],
            [
                'email' => 'soledad@example.com',
                'subcategory' => 'Sanitarios',
                'name' => 'Reparación de inodoro',
                'price' => 15000,
            ],
            [
                'email' => 'daniel@example.com',
                'subcategory' => 'Alfombras',
                'name' => 'Limpieza profunda de alfombras',
                'price' => 12000,
            ],
        ];

        foreach ($services as $service) {
            $user = User::where('email', $service['email'])->first();
            $subcategory = Subcategory::where('name', $service['subcategory'])->first();

            if ($user && $subcategory) {
                Service::create([
                    'user_id' => $user->id,
                    'subcategory_id' => $subcategory->id,
                    'name' => $service['name'],
                    'price' => $service['price'],
                ]);
            }
        }
    }
}
