<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'specialization' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        $user->doctor()->create([
            'specialization' => $request->specialization,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor created successfully!');
    }

    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
        ]);

        $doctor->user->update([
            'name' => $request->name,
        ]);

        $doctor->update([
            'specialization' => $request->specialization,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('doctors.index')
            ->with('success', 'Doctor updated successfully!');
    }

   public function destroy(Doctor $doctor)
    {
    if ($doctor->appointments()->exists()) {
        return redirect()->route('doctors.index')
            ->with('error', 'Doctor cannot be deleted because they have existing appointments!');
    }

    $doctor->user?->delete();
    $doctor->delete();

    return redirect()->route('doctors.index')
        ->with('success', 'Doctor deleted successfully!');
    }
}