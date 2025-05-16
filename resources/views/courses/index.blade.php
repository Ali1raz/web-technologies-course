@extends('layouts.app')

@section('title', 'Course List')

@section('content')
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Course List</h2>
        </div>
        <div class="col-md-6">
            <form class="d-flex" action="{{ route('courses.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search courses..." value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Instructor</th>
                    <th>Credit Hours</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->instructor }}</td>
                        <td>{{ $course->credit_hours }}</td>
                        <td>{{ $course->semester }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No courses found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
