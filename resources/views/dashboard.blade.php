@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Student Profile Card -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-body text-center">
                @if($student->profile_picture)
                <img src="{{ asset('storage/' . $student->profile_picture) }}"
                    alt="Profile Picture"
                    class="rounded-circle mb-3 profile-picture">
                @else
                <div class="profile-picture-placeholder mb-3">
                    <i class="fas fa-user"></i>
                </div>
                @endif
                <h3 class="card-title">{{ $student->name }}</h3>
                <p class="text-muted">{{ $student->email }}</p>
                <p class="text-muted">Department: {{ $student->department }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Registered Courses Card -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Registered Courses</h3>
                <a href="{{ route('courses.index') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Browse Courses
                </a>
            </div>
            <div class="card-body">
                @if($registeredCourses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Title</th>
                                <th>Credit Hours</th>
                                <th>Instructor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registeredCourses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->instructor }}</td>
                                <td>
                                    <form action="{{ route('courses.unregister', $course->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i> Unregister
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-book fa-3x text-muted mb-3"></i>
                    <p class="text-muted">You haven't registered for any courses yet.</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Browse Available Courses
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .profile-picture {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-picture-placeholder {
        width: 150px;
        height: 150px;
        background-color: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 4rem;
        color: #adb5bd;
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        background-color: #fff;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {

        .profile-picture,
        .profile-picture-placeholder {
            width: 120px;
            height: 120px;
        }

        .table-responsive {
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 0.2rem 0.4rem;
            font-size: 0.8rem;
        }
    }
</style>
@endsection