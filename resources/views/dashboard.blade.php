@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-card mx-auto" style="max-width: 700px;">
    <h2 class="text-center mb-4 text-success">🎓 Student Dashboard</h2>

    <div class="text-center mb-4">
        @if ($student->profile_picture)
        <img src="{{ asset('uploads/' . $student->profile_picture) }}" alt="Profile" class="profile-pic">
        @else
        <img src="https://via.placeholder.com/100" class="profile-pic" alt="No Picture">
        @endif
    </div>

    <p><strong>Name:</strong> {{ $student->name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Department:</strong> {{ $student->department }}</p>

    <div class="mt-4 text-center">
        <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">✏️ Edit Profile</a>
        <a href="{{ route('courses.index') }}" class="btn btn-info me-2">📚 View Courses</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .dashboard-card {
        background-color: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .profile-pic {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #198754;
    }
</style>
@endsection