@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="dashboard-card mb-4">
            <h2 class="text-center mb-4 text-success">🎓 Student Profile</h2>

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
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="dashboard-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-primary mb-0">📚 Registered Courses</h2>
                <a href="{{ route('courses.index') }}" class="btn btn-info">View All Courses</a>
            </div>

            @if($registeredCourses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Title</th>
                            <th>Credit Hours</th>
                            <th>Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registeredCourses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->credit_hours }}</td>
                            <td>{{ $course->instructor }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-4">
                <p class="text-muted mb-0">You haven't registered for any courses yet.</p>
                <a href="{{ route('courses.index') }}" class="btn btn-success mt-3">Browse Courses</a>
            </div>
            @endif
        </div>
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
        height: 100%;
    }

    .profile-pic {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #198754;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .table td {
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .dashboard-card {
            margin-bottom: 1.5rem;
        }

        .table-responsive {
            font-size: 0.9rem;
        }
    }
</style>
@endsection