@extends('layouts.admin')
@section('title', 'Add Doctor')

@section('content')
    <h1>Add Doctor</h1>
    <a href="{{ route('doctors.index') }}">Back</a>

    <form method="POST" action="{{ route('doctors.store') }}">
        @csrf
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Specialization</label>
            <input type="text" name="specialization" value="{{ old('specialization') }}">
            @error('specialization') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}">
        </div>
        <button type="submit">Save</button>
    </form>
@endsection