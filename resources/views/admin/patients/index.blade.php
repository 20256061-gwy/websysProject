@extends('layouts.admin')
@section('title', 'Patients')

@section('content')
    <h1>Patients</h1>
    <a href="{{ route('patients.create') }}">Add New Patient</a>

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
                <th>Name</th>
                <th>Gender</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $patient->user->name }}</td>
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->contact_number }}</td>
                <td>{{ $patient->address }}</td>
                <td>
                    <a href="{{ route('patients.edit', $patient->id) }}">Edit</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $patients->links() }}
@endsection