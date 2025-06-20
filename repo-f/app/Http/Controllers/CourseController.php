<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!Session::has('student_id')) {
                Session::flush();
                return redirect()->route('login');
            }

            $student = Student::find(Session::get('student_id'));
            if (!$student) {
                Session::flush();
                return redirect()->route('login');
            }

            $query = Course::query();

            // Search by title or instructor (partial match)
            if ($request->filled('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('instructor', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('name', 'LIKE', '%' . $searchTerm . '%');
                });
            }

            $courses = $query->orderBy('title')->get();

            // Get registered courses for the student
            $registeredCourseIds = CourseRegistration::where('student_id', $student->id)
                ->pluck('course_id')
                ->toArray();

            // Add registration status to each course
            $courses->each(function ($course) use ($registeredCourseIds) {
                $course->is_registered = in_array($course->id, $registeredCourseIds);
            });

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('courses._table', compact('courses'))->render()
                ]);
            }

            return view('courses.index', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Error in CourseController@index: ' . $e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => 'Failed to load courses'], 500);
            }
            return back()->with('error', 'Failed to load courses. Please try again.');
        }
    }

    public function register($id)
    {
        if (!Session::has('student_id')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $course = Course::findOrFail($id);
            $studentId = Session::get('student_id');

            // Check if already registered
            $existingRegistration = CourseRegistration::where('student_id', $studentId)
                ->where('course_id', $id)
                ->first();

            if ($existingRegistration) {
                return response()->json(['message' => 'Already registered for this course'], 400);
            }

            // Create new registration
            CourseRegistration::create([
                'student_id' => $studentId,
                'course_id' => $id
            ]);

            return response()->json(['message' => 'Successfully registered for the course']);
        } catch (\Exception $e) {
            Log::error('Course registration error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to register for the course'], 500);
        }
    }

    public function unregister($id)
    {
        if (!Session::has('student_id')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $registration = CourseRegistration::where('student_id', Session::get('student_id'))
                ->where('course_id', $id)
                ->first();

            if (!$registration) {
                return response()->json(['message' => 'Not registered for this course'], 400);
            }

            $registration->delete();
            return response()->json(['message' => 'Successfully unregistered from the course']);
        } catch (\Exception $e) {
            Log::error('Course unregistration error: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to unregister from the course'], 500);
        }
    }
}
