@extends('layouts.admin')
@section('title', 'Edit Service')

@section('content')
    <h1>Edit Service</h1>
    <a href="{{ route('services.index') }}">Back</a>

    <form method="POST" action="{{ route('services.update', $service->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $service->name) }}">
            @error('name') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <div>
            <label>Fee</label>
            <input type="number" name="fee" step="0.01" value="{{ old('fee', $service->fee) }}">
            @error('fee') <p style="color:red">{{ $message }}</p> @enderror
        </div>
        <button type="submit">Update</button>
    </form>
@endsection