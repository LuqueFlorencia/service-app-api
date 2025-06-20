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
                'name' => 'Corte clasico de cabello',
                'description' => 'Un corte de cabello clasico para hombres, con estilo y precision.',
                'price' => 3000,
            ],
            [
                'email' => 'luis@example.com',
                'subcategory' => 'Instalaciones',
                'name' => 'Instalacion electrica completa',
                'description' => 'Instalacion electrica para viviendas, incluyendo cableado y conexiones.',
                'price' => 45000,
            ],
            [
                'email' => 'natalia@example.com',
                'subcategory' => 'Iluminacion',
                'name' => 'Colocacion de luminarias LED',
                'description' => 'Instalacion de luminarias LED en el hogar, con eficiencia energetica.',
                'price' => 18000,
            ],
            [
                'email' => 'ricardo@example.com',
                'subcategory' => 'Electricista general',
                'name' => 'Revision general del sistema electrico',
                'description' => 'Revision completa del sistema electrico de la vivienda para garantizar su seguridad.',
                'price' => 22000,
            ],
            [
                'email' => 'marcos@example.com',
                'subcategory' => 'Aberturas de madera',
                'name' => 'Puerta de cedro a medida',
                'description' => 'Fabricacion e instalacion de puerta de madera de cedro, personalizada segun las medidas del cliente.',
                'price' => 55000,
            ],
            [
                'email' => 'andrea@example.com',
                'subcategory' => 'Muebles',
                'name' => 'Diseño y fabricacion de estantes',
                'description' => 'Diseño y fabricacion de estantes personalizados para el hogar, adaptados a tus necesidades.',
                'price' => 38000,
            ],
            [
                'email' => 'soledad@example.com',
                'subcategory' => 'Sanitarios',
                'name' => 'Reparacion de inodoro',
                'description' => 'Reparacion de inodoro con problemas de fuga o atascos, garantizando su correcto funcionamiento.',
                'price' => 15000,
            ],
            [
                'email' => 'daniel@example.com',
                'subcategory' => 'Alfombras',
                'name' => 'Limpieza profunda de alfombras',
                'description' => 'Servicio de limpieza profunda de alfombras, eliminando manchas y suciedad acumulada.',
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
                    'description' => $service['description'],
                    'price' => $service['price'],
                ]);
            }
        }
    }
}
