@extends('layouts.admin')
@section('title', 'Add Appointment')

@section('content')
    <h1>Add Appointment</h1>
    <a href="{{ route('appointments.index') }}">Back</a>

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div>
    <label>Patient</label>
    <select name="patient_id">
        <option value="">Select Patient</option>
        @foreach($patients as $patient)
            <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                {{ $patient->user->name }}
            </option>
        @endforeach
    </select>
    @error('patient_id') <p style="color:red">{{ $message }}</p> @enderror
</div>
        <div>
            <label>Doctor</label>
            <select name="doctor_id">
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->user->name }} - {{ $doctor->specialization }}
                    </option>
                @endforeach
            </select>
            @error('doctor_id') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Service</label>
            <select name="service_id">
                <option value="">Select Service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }} - ₱{{ $service->fee }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Date</label>
            <input type="date" name="appointment_date" value="{{ old('appointment_date') }}">
            @error('appointment_date') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Time</label>
            <input type="time" name="appointment_time" value="{{ old('appointment_time') }}">
            @error('appointment_time') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Reason</label>
            <textarea name="reason">{{ old('reason') }}</textarea>
        </div>
        <button type="submit" onclick="this.disabled=true; this.form.submit();">Book Appointment</button>
    </form>
@endsection