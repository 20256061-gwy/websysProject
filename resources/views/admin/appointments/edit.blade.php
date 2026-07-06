@extends('layouts.admin')
@section('title', 'Edit Appointment')

@section('content')
    <h1>Edit Appointment</h1>
    <a href="{{ route('appointments.index') }}">Back</a>

    <div>
        <p><strong>Patient:</strong> {{ $appointment->patient->user->name }}</p>
        <p><strong>Doctor:</strong> {{ $appointment->doctor->user->name }}</p>
        <p><strong>Date:</strong> {{ $appointment->appointment_date }}</p>
        <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
    </div>

    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Status</label>
            <select name="status">
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div>
            <label>Remarks</label>
            <textarea name="remarks">{{ old('remarks', $appointment->remarks) }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection