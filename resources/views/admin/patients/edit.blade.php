@extends('layouts.admin')
@section('title', 'Edit Patient')

@section('content')
    <h1>Edit Patient</h1>
    <a href="{{ route('patients.index') }}">Back</a>

    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $patient->user->name) }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Birthdate</label>
            <input type="date" name="birthdate" value="{{ old('birthdate', $patient->birthdate) }}">
        </div>
        <div>
            <label>Gender</label>
            <select name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number', $patient->contact_number) }}">
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" value="{{ old('address', $patient->address) }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection