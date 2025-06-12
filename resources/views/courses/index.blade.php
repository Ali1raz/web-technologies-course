@extends('layouts.app')

@section('title', 'Available Courses')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h2 class="mb-0 text-primary">Available Courses</h2>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Credit Hours</th>
                        <th>Instructor</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->credit_hours }}</td>
                        <td>{{ $course->instructor }}</td>
                        <td>
                            @if($course->is_registered)
                            <form action="{{ route('courses.unregister', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Unregister
                                </button>
                            </form>
                            @else
                            <form action="{{ route('courses.register', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    Register
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
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

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    @media (max-width: 768px) {
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