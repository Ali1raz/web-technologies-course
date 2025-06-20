@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ $student->name }}</h2>

    <h4>Your Registered Courses</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Course Title</th>
                <th>Instructor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->instructor }}</td>
                    <td>
                        <form action="{{ route('courses.unregister', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Unregister</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
