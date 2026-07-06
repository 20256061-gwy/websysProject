@extends('layouts.admin')
@section('title', 'Edit Doctor')

@section('content')
    <h1>Edit Doctor</h1>
    <a href="{{ route('doctors.index') }}">Back</a>

    <form method="POST" action="{{ route('doctors.update', $doctor->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $doctor->user->name) }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization', $doctor->specialization) }}">
            @error('specialization') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $doctor->contact_number) }}">
        </div>
        <button type="submit">Update</button>
    </form>

@endsection