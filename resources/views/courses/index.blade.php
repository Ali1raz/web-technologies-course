@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Courses</h2>

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Credit Hours</th>
                <th>Instructor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->credit_hours }}</td>
                <td>{{ $course->instructor }}</td>
                <td>
                    @if ($course->is_registered)
                        <form action="{{ route('courses.unregister', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm"
                                onclick="return confirm('Unregister from this course?')">Unregister</button>
                        </form>
                    @else
                        <form action="{{ route('courses.register', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Register</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
