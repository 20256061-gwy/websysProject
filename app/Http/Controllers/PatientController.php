<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('user')->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('admin.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => 'patient',
        ]);

        $user->patient()->create([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully!');
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|string',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $patient->user->update([
            'name' => $request->name,
        ]);

        $patient->update([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully!');
    }

   public function destroy(Patient $patient)
    {
    if ($patient->appointments()->exists()) {
        return redirect()->route('patients.index')
            ->with('error', 'Patient cannot be deleted because they have existing appointments!');
    }

    $patient->user?->delete();
    $patient->delete();

    return redirect()->route('patients.index')
        ->with('success', 'Patient deleted successfully!');
    }
}