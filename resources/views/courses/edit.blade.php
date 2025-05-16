@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Edit Course</h2>
                <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to List</a>
            </div>

            <form action="{{ route('courses.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $course->title) }}" >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="instructor" class="form-label">Instructor</label>
                    <input type="text" class="form-control @error('instructor') is-invalid @enderror" 
                           id="instructor" name="instructor" value="{{ old('instructor', $course->instructor) }}" >
                    @error('instructor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="credit_hours" class="form-label">Credit Hours</label>
                    <input type="number" class="form-control @error('credit_hours') is-invalid @enderror" 
                           id="credit_hours" name="credit_hours" value="{{ old('credit_hours', $course->credit_hours) }}"  min="1">
                    @error('credit_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="text" class="form-control @error('semester') is-invalid @enderror" 
                           id="semester" name="semester" value="{{ old('semester', $course->semester) }}" >
                    @error('semester')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Course</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
