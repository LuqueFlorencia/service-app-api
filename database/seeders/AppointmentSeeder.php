<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $appointments = [
            [
                'client_email' => 'mirta@example.com',
                'service_name' => 'Instalacion electrica completa',
                'date' => '2024-08-17',
                'time' => '15:00',
                'location' => 'En local',
                'status' => 'confirmado',
            ],
            [
                'client_email' => 'lucas@example.com',
                'service_name' => 'Corte clasico de cabello',
                'date' => '2024-08-19',
                'time' => '11:00',
                'location' => 'A domicilio',
                'status' => 'pendiente',
            ],
            [
                'client_email' => 'mirta@example.com',
                'service_name' => 'Diseño y fabricacion de estantes',
                'date' => '2024-08-20',
                'time' => '10:00',
                'location' => 'A domicilio',
                'status' => 'cancelado',
            ],
        ];

        foreach ($appointments as $appt) {
            $client = User::where('email', $appt['client_email'])->first();
            $service = Service::where('name', $appt['service_name'])->first();
            $professional = $service ? User::find($service->user_id) : null;

            if ($client && $service && $professional) {
                Appointment::create([
                    'client_id' => $client->id,
                    'professional_id' => $professional->id,
                    'service_id' => $service->id,
                    'date' => $appt['date'],
                    'time' => $appt['time'],
                    'location' => $appt['location'],
                    'status' => $appt['status'],
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
