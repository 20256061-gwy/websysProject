@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
    <h1>Welcome, Admin {{ auth()->user()->name }}!</h1>

    <div>
        <a href="{{ route('services.index') }}">Manage Services</a> |
        <a href="{{ route('doctors.index') }}">Manage Doctors</a> |
        <a href="{{ route('patients.index') }}">Manage Patients</a> |
        <a href="{{ route('appointments.index') }}">Manage Appointments</a>
    </div>
@endsection