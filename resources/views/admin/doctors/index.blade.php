@extends('layouts.admin')
@section('title', 'Doctors')

@section('content')
    <h1>Doctors</h1>
    <a href="{{ route('doctors.create') }}">Add New Doctor</a>

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
                <th>Specialization</th>
                <th>Contact Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $doctor->user->name }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->contact_number }}</td>
                <td>
                    <a href="{{ route('doctors.edit', $doctor->id) }}">Edit</a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $doctors->links() }}
@endsection