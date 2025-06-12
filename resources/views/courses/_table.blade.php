@foreach($courses as $course)
<tr id="course-row-{{ $course->id }}">
    <td class="px-4">{{ $course->name }}</td>
    <td class="px-4">{{ $course->title }}</td>
    <td class="px-4">{{ $course->description }}</td>
    <td class="px-4">{{ $course->credit_hours }}</td>
    <td class="px-4">{{ $course->instructor }}</td>
    <td class="px-4 text-center">
        @if($course->is_registered)
        <button type="button"
            class="btn btn-danger btn-sm unregister-btn"
            data-course-id="{{ $course->id }}">
            <i class="fas fa-times me-1"></i> Unregister
        </button>
        @else
        <button type="button"
            class="btn btn-success btn-sm register-btn"
            data-course-id="{{ $course->id }}">
            <i class="fas fa-plus me-1"></i> Register
        </button>
        @endif
    </td>
</tr>
@endforeach