<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Obtener la lista de turnos, junto con los detalles del cliente, profesional y servicio.
     */
    public function index()
    {
        return response()->json(Appointment::select('id','client_id','professional_id','service_id','date','time','location','status')->with([
            'client:id,email', 
            'client.profile:id,user_id,full_name', 
            'professional:id,email', 
            'professional.profile:id,user_id,full_name', 
            'service:id,user_id,name,price'
        ])->get(), 200);
    }

    /**
     * Crear un nuevo turno (solo los clientes).
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'client') {
            return response()->json(['message' => 'Solo los clientes pueden solicitar turnos.'], 403);
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:' . implode(',', Appointment::$statuses),
        ]);

        $validated['client_id'] = $user->id;

        // Obtener el profesional del servicio
        $service = Service::with('professional')->findOrFail($validated['service_id']);
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
     * Obtener un turno específico por su ID, junto con los detalles del cliente, profesional y servicio.
     */
    public function show(string $id)
    {
        $appt = Appointment::select('id','client_id','professional_id','service_id','date','time','location','status')->with([
            'client:id,email', 
            'client.profile:id,user_id,full_name', 
            'professional:id,email', 
            'professional.profile:id,user_id,full_name', 
            'service:id,user_id,name,price'
        ])->find($id);
        if (!$appt)
            return response()->json(['message' => 'Turno no encontrado'], 404);

        return response()->json($appt);
    }

    /**
     * Modificar un turno existente.
     */
    public function update(Request $request, string $id)
    {
        $appt = Appointment::find($id);
        if (!$appt)
            return response()->json(['message' => 'Turno no encontrado'], 404);

        $validated = $request->validate([
            'date' => 'sometimes|date|after_or_equal:today',
            'time' => 'sometimes|date_format:H:i',
            'location' => 'sometimes|string|max:255',
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
     * Actualizar el estado de un turno (solo el profesional asignado).
     */
    public function updateStatus(Request $request, string $id)
    {
        $user = $request->user();
        $appt = Appointment::find($id);

        if (!$appt) {
            return response()->json(['message' => 'Turno no encontrado'], 404);
        }

        // Solo el profesional asignado puede modificarlo
        if ($user->role !== 'professional' || $user->id !== $appt->professional_id) {
            return response()->json(['message' => 'No autorizado para cambiar el estado de este turno.'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', Appointment::$statuses),
        ]);

        $appt->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'appointment' => $appt
        ]);
    }

    /**
     * Eliminar un turno existente.
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
