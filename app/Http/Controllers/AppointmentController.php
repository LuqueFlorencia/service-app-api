<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Appointment::with(['client', 'professional', 'service'])->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'status' => 'required|in:' . implode(',', Appointment::$statuses),
        ]);

        // Obtener el profesional del servicio
        $service = Service::findOrFail($validated['service_id']);
        $validated['professional_id'] = $service->professional->id;

        // Validar duplicado para cliente
        $exists = Appointment::where('client_id', $validated['client_id'])
            ->where('service_id', $validated['service_id'])
            ->where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Ya existe un turno para este cliente en ese horario.'], 409);
        }

        // Validar duplicado para profesional
        $existsProf = Appointment::where('professional_id', $validated['professional_id'])
            ->where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->exists();

        if ($existsProf) {
            return response()->json(['message' => 'El profesional ya tiene un turno en ese horario.'], 409);
        }

        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $appt = Appointment::with(['client', 'professional', 'service'])->find($id);
        if (!$appt)
            return response()->json(['message' => 'Turno no encontrado'], 404);

        return response()->json($appt);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $appt = Appointment::find($id);
        if (!$appt)
            return response()->json(['message' => 'Turno no encontrado'], 404);

        $validated = $request->validate([
            'client_id' => 'sometimes|exists:users,id',
            'service_id' => 'sometimes|exists:services,id',
            'date' => 'sometimes|date|after_or_equal:today',
            'time' => 'sometimes|date_format:H:i',
            'status' => 'sometimes|in:' . implode(',', Appointment::$statuses),
        ]);

        $userId = $validated['client_id'] ?? $appt->client_id;
        $serviceId = $validated['service_id'] ?? $appt->service_id;
        $date = $validated['date'] ?? $appt->date;
        $time = $validated['time'] ?? $appt->time;

        // Validar duplicado para cliente
         $existsClient = Appointment::where('client_id', $userId)
            ->where('service_id', $serviceId)
            ->where('date', $date)
            ->where('time', $time)
            ->where('id', '!=', $appt->id)
            ->exists();

        if ($existsClient) {
            return response()->json(['message' => 'Ya existe otro turno para este cliente en ese horario y servicio.'], 409);
        }

        // Validar duplicado para profesional
        $service = Service::with('professional')->find($serviceId);
        if (!$service || !$service->professional) {
            return response()->json(['message' => 'El servicio no tiene un profesional asignado.'], 422);
        }

        $professionalId = $service->professional->id;

        $existsProf = Appointment::where('professional_id', $professionalId)
            ->where('date', $date)
            ->where('time', $time)
            ->where('id', '!=', $appt->id)
            ->exists();

        if ($existsProf) {
            return response()->json(['message' => 'El profesional ya tiene otro turno en ese horario.'], 409);
        }

        $validated['professional_id'] = $professionalId;

        $appt->update($validated);

        return response()->json($appt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appt = Appointment::find($id);
        if (!$appt)
            return response()->json(['message' => 'Turno no encontrado'], 404);

        $appt->delete();

        return response()->json(['message' => 'Turno eliminado correctamente'], 200);
    }
}
