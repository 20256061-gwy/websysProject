<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient.user', 'doctor.user', 'service'])->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
{
    $doctors = Doctor::with('user')->get();
    $services = Service::all();
    $patients = \App\Models\Patient::with('user')->get();
    return view('admin.appointments.create', compact('doctors', 'services', 'patients'));
}

    public function store(Request $request)
{
    $request->validate([
        'patient_id' => 'required|exists:patients,id',
        'doctor_id' => 'required|exists:doctors,id',
        'service_id' => 'nullable|exists:services,id',
        'appointment_date' => 'required|date',
        'appointment_time' => 'required',
        'reason' => 'nullable|string',
    ]);

    // Check if slot is available FIRST
    $conflict = Appointment::where('doctor_id', $request->doctor_id)
        ->where('appointment_date', $request->appointment_date)
        ->where('appointment_time', $request->appointment_time)
        ->where('status', '!=', 'cancelled')
        ->exists();

    if ($conflict) {
        return back()->withErrors(['appointment_time' => 'This slot is already taken.'])->withInput();
    }

    Appointment::create([
        'patient_id' => $request->patient_id,
        'doctor_id' => $request->doctor_id,
        'service_id' => $request->service_id,
        'appointment_date' => $request->appointment_date,
        'appointment_time' => $request->appointment_time,
        'reason' => $request->reason,
        'status' => 'pending',
    ]);

    return redirect()->route('appointments.index')
        ->with('success', 'Appointment created successfully!');
}

    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::with('user')->get();
        $services = Service::all();
        return view('admin.appointments.edit', compact('appointment', 'doctors', 'services'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'remarks' => 'nullable|string',
        ]);

        $appointment->update($request->only('status', 'remarks'));

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully!');
    }

   public function destroy(Appointment $appointment)
{
    $appointment->delete();

    return redirect()->route('appointments.index')
        ->with('success', 'Appointment deleted successfully!');
}
}