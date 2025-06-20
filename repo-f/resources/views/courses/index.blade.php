@extends('layouts.app')

@section('title', 'Available Courses')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 text-primary">Available Courses</h2>
                </div>
                <div class="col-md-6">
                    <form id="searchForm" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search by title or instructor...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div id="coursesTable">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4">Course Code</th>
                                <th class="px-4">Title</th>
                                <th class="px-4">Description</th>
                                <th class="px-4">Credit Hours</th>
                                <th class="px-4">Instructor</th>
                                <th class="px-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
    }

    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
        border-bottom: 1px solid #dee2e6;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border-radius: 5px;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .input-group {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }

    #searchForm .btn {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    @media (max-width: 768px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }

        .table-responsive {
            font-size: 0.9rem;
        }

        .btn-sm {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }

        #searchForm {
            margin-top: 1rem;
        }

        .px-4 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
    }

    /* Loading spinner styles */
    .spinner-border {
        width: 1.5rem;
        height: 1.5rem;
        border-width: 0.2em;
    }

    /* Alert styles */
    .alert {
        border-radius: 8px;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const coursesTable = $('#coursesTable');
        const searchForm = $('#searchForm');
        const searchInput = $('#searchInput');

        // Function to perform search
        function performSearch() {
            const searchTerm = searchInput.val().trim();

            // Show loading state
            coursesTable.find('tbody').html(`
                <tr>
                    <td colspan="6" class="text-center p-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2 text-muted">Searching courses...</p>
                    </td>
                </tr>
            `);

            $.ajax({
                url: '{{ route("courses.index") }}',
                method: 'GET',
                data: {
                    search: searchTerm
                },
                success: function(response) {
                    if (response.html && response.html.trim()) {
                        coursesTable.find('tbody').html(response.html);
                        attachButtonHandlers();
                    } else {
                        coursesTable.find('tbody').html('<tr><td colspan="6" class="text-center py-4">No courses found</td></tr>');
                    }
                },
                error: function(xhr) {
                    console.error('Search error:', xhr.responseText);
                    showAlert('danger', 'Failed to search courses. Please try again.');
                    coursesTable.find('tbody').html('<tr><td colspan="6" class="text-center py-4">Error loading courses</td></tr>');
                }
            });
        }

        // Form submission handler
        searchForm.on('submit', function(e) {
            e.preventDefault();
            performSearch();
        });

        // Real-time search as user types
        let searchTimeout;
        searchInput.on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 500);
        });

        function attachButtonHandlers() {
            // Register button click handler
            $('.register-btn').click(function() {
                const button = $(this);
                const courseId = button.data('course-id');

                $.ajax({
                    url: `/courses/register/${courseId}`,
                    method: 'POST',
                    beforeSend: function() {
                        button.prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    },
                    success: function(response) {
                        button.replaceWith(`
                        <button type="button" 
                                class="btn btn-danger btn-sm unregister-btn" 
                                data-course-id="${courseId}">
                            <i class="fas fa-times me-1"></i> Unregister
                        </button>
                    `);
                        showAlert('success', 'Course registered successfully!');
                    },
                    error: function(xhr) {
                        button.prop('disabled', false)
                            .html('<i class="fas fa-plus me-1"></i> Register');
                        showAlert('danger', xhr.responseJSON?.message || 'Failed to register for the course.');
                    }
                });
            });

            // Unregister button click handler
            $(document).on('click', '.unregister-btn', function() {
                const button = $(this);
                const courseId = button.data('course-id');

                $.ajax({
                    url: `/courses/unregister/${courseId}`,
                    method: 'POST',
                    beforeSend: function() {
                        button.prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                    },
                    success: function(response) {
                        button.replaceWith(`
                        <button type="button" 
                                class="btn btn-success btn-sm register-btn" 
                                data-course-id="${courseId}">
                            <i class="fas fa-plus me-1"></i> Register
                        </button>
                    `);
                        showAlert('success', 'Course unregistered successfully!');
                    },
                    error: function(xhr) {
                        button.prop('disabled', false)
                            .html('<i class="fas fa-times me-1"></i> Unregister');
                        showAlert('danger', xhr.responseJSON?.message || 'Failed to unregister from the course.');
                    }
                });
            });
        }

        // Function to show alert messages
        function showAlert(type, message) {
            const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show m-3" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

            // Remove any existing alerts
            $('.alert').remove();

            // Add new alert at the top of the card
            $('.card').prepend(alertHtml);

            // Auto dismiss after 3 seconds
            setTimeout(() => {
                $('.alert').alert('close');
            }, 3000);
        }

        // Initial attachment of button handlers
        attachButtonHandlers();
    });
</script>
@endsection