@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="card p-4 shadow-lg">
    <h2 class="mb-4 text-primary">Edit Your Profile</h2>

    {{-- Display Errors --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Success Message --}}
    @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $student->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email:
                <span class="text-danger ms-4">You cant change your email</span>
            </label>
            <input type="email" class="form-control" value="{{ $student->email }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Department:</label>
            <input type="text" name="department" class="form-control" value="{{ $student->department }}">
        </div>

        <div class="mb-3">
            <label class="form-label">New Password (optional):</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Profile Picture (optional):</label>
            <input type="file" name="profile_picture" class="form-control">
        </div>

        @if ($student->profile_picture)
        <div class="mb-3">
            <label class="form-label">Current Picture:</label><br>
            <img src="{{ asset('storage/' . $student->profile_picture) }}" width="100" class="rounded-circle shadow">
        </div>
        @endif

        <button type="submit" class="btn btn-success">Update Profile</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary ms-2">Back to Dashboard</a>
    </form>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 12px;
    }

    h2 {
        font-weight: bold;
        color: #2d3436;
    }

    .form-label {
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #00cec9;
        box-shadow: 0 0 0 0.2rem rgba(0, 206, 201, 0.25);
    }

    .btn-success {
        background-color: #00b894;
        border: none;
    }

    .btn-success:hover {
        background-color: #0984e3;
    }

    .btn-secondary:hover {
        background-color: #636e72;
    }
</style>
@endsection