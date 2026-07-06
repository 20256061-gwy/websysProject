@extends('layouts.admin')
@section('title', 'Add Patient')

@section('content')
    <h1>Add Patient</h1>
    <a href="{{ route('patients.index') }}">Back</a>

    <form method="POST" action="{{ route('patients.store') }}">
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
            <label>Birthdate</label>
            <input type="date" name="birthdate" value="{{ old('birthdate') }}">
        </div>
        <div>
            <label>Gender</label>
            <select name="gender">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div>
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="{{ old('contact_number') }}">
        </div>
        <div>
            <label>Address</label>
            <input type="text" name="address" value="{{ old('address') }}">
        </div>
        <button type="submit">Save</button>
    </form>
@endsection