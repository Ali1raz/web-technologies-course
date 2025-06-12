@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Courses</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Credit Hours</th>
                <th>Instructor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->credit_hours }}</td>
                    <td>{{ $course->instructor }}</td>
                    <td>
                        @if(in_array($course->id, $registeredCourses))
                            <form action="{{ route('courses.unregister', $course->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-warning" type="submit">Unregister</button>
                            </form>
                        @else
                            <form action="{{ route('courses.register', $course->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-primary" type="submit">Register</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
