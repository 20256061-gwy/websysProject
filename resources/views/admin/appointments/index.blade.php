@extends('layouts.admin')
@section('title', 'Appointments')

@section('content')
    <h1>Appointments</h1>
    <a href="{{ route('appointments.create') }}">Add New Appointment</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $appointment->patient->user->name }}</td>
                <td>{{ $appointment->doctor->user->name }}</td>
                <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_time }}</td>
                <td>{{ $appointment->status }}</td>
                <td>
                    <a href="{{ route('appointments.edit', $appointment->id) }}">Edit</a>
                    <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $appointments->links() }}
@endsection