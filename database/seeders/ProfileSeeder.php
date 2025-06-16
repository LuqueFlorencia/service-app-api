<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        $cliente1 = User::where('email', 'mirta@example.com')->first();
        $cliente2 = User::where('email', 'lucas@example.com')->first();
        $profesional1 = User::where('email', 'martin@example.com')->first();
        $profesional2 = User::where('email', 'luis@example.com')->first();
        $profesional3 = User::where('email', 'natalia@example.com')->first();
        $profesional4 = User::where('email', 'ricardo@example.com')->first();
        $profesional5 = User::where('email', 'marcos@example.com')->first();
        $profesional6 = User::where('email', 'andrea@example.com')->first();
        $profesional7 = User::where('email', 'soledad@example.com')->first();
        $profesional8 = User::where('email', 'daniel@example.com')->first();

        Profile::create([
            'user_id' => $cliente1->id,
            'full_name' => 'Mirta Gaona',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Sarmiento 1249',
            'avatar' => 'https://randomuser.me/api/portraits/women/5.jpg',
            'description' => null,
            'availability' => null,
            'rating' => null,
        ]);
        Profile::create([
            'user_id' => $cliente2->id,
            'full_name' => 'Lucas Fernández',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. López 456',
            'avatar' => 'https://randomuser.me/api/portraits/men/5.jpg',
            'description' => null,
            'availability' => null,
            'rating' => null,
        ]);

        Profile::create([
            'user_id' => $profesional1->id,
            'full_name' => 'Martin Gonzalez',
            'profession' => 'Peluquero',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av Sarmiento 123',
            'avatar' => 'ttps://img.freepik.com/foto-gratis/vista-frontal-peluquero-masculino-tijeras-barberia_23-2148985744.jpg',
            'description' => 'Especialista en tecnicas innovadoras de corte y peinado.',
            'availability' => 'Lunes a Viernes, 09:00 - 16:00',
            'rating' => 4.9,
        ]);
        Profile::create([
            'user_id' => $profesional2->id,
            'full_name' => 'Luis Fernández',
            'profession' => 'Electricista',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Combatientes 456',
            'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg',
            'description' => 'Soy Luis, electricista especializado en instalaciones eléctricas. Con más de 8 años de experiencia, me encargo de realizar instalaciones seguras y eficientes para tu hogar o negocio.',
            'availability' => 'Lunes a Sábado, 10:00 - 19:00',
            'rating' => 4.7,
        ]);
        Profile::create([
            'user_id' => $profesional3->id,
            'full_name' => 'Natalia Gomez',
            'profession' => 'Electricista',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. López y Planes 356',
            'avatar' => 'https://randomuser.me/api/portraits/women/1.jpg',
            'description' => 'Soy Natalia, experta en sistemas de iluminación. Transformo espacios con soluciones lumínicas modernas y eficientes que realzan la belleza de tu hogar.',
            'availability' => 'Lunes a Viernes, 12:00 - 20:00',
            'rating' => 4.9,
        ]);
        Profile::create([
            'user_id' => $profesional4->id,
            'full_name' => 'Ricardo Núñez',
            'profession' => 'Electricista',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. San Martin 789',
            'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg',
            'description' => 'Soy Ricardo, electricista general con amplia experiencia. Resuelvo todo tipo de problemas eléctricos, desde reparaciones menores hasta instalaciones completas.',
            'availability' => 'Lunes a Sábado, 13:00 - 21:00',
            'rating' => 4.5,
        ]);
        Profile::create([
            'user_id' => $profesional5->id,
            'full_name' => 'Marcos Herrera',
            'profession' => 'Carpintería',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Los Pozos 789',
            'avatar' => 'https://randomuser.me/api/portraits/men/3.jpg',
            'description' => 'Soy Marcos, especialista en aberturas de madera. Creo puertas y ventanas únicas que combinan funcionalidad y diseño para embellecer tu hogar.',
            'availability' => 'Lunes a Sábado, 13:00 - 21:00',
            'rating' => 4.8,
        ]);
        Profile::create([
            'user_id' => $profesional6->id,
            'full_name' => 'Andrea Pérez',
            'profession' => 'Carpintería',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Sarmiento 789',
            'avatar' => 'https://randomuser.me/api/portraits/women/2.jpg',
            'description' => 'Soy Andrea, carpintera especializada en muebles a medida. Diseño y construyo piezas únicas que se adaptan perfectamente a tus espacios y necesidades.',
            'availability' => 'Sábados y Domingos, 08:00 - 16:00',
            'rating' => 4.6,
        ]);
        Profile::create([
            'user_id' => $profesional7->id,
            'full_name' => 'Soledad Molina',
            'profession' => 'Plomeria',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Aranduru 789',
            'avatar' => 'https://randomuser.me/api/portraits/women/3.jpg',
            'description' => 'Soy Soledad, experta en machimbre y revestimientos de madera. Transformo tus paredes y techos con acabados naturales de alta calidad.',
            'availability' => 'Lunes a Jueves, 07:00 - 15:00',
            'rating' => 4.4,
        ]);
        Profile::create([
            'user_id' => $profesional8->id,
            'full_name' => 'Daniel Suárez',
            'profession' => 'Limpieza',
            'province' => 'Chaco',
            'department' => 'Resistencia',
            'address' => 'Av. Cervantes 789',
            'avatar' => 'https://randomuser.me/api/portraits/men/4.jpg',
            'description' => 'Soy Daniel, especialista en limpieza de alfombras y tapizados. Devuelvo la vida a tus textiles con técnicas profesionales y productos especializados.',
            'availability' => 'Lunes a Viernes, 08:00 - 17:00',
            'rating' => 4.6,
        ]);
    }
}
