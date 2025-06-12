<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseRegistration;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $student = Session::get('student');

        if (!$student) {
            return redirect()->route('login')->with('error', 'You must be logged in to view courses.');
        }

        $courses = Course::with('registrations')->get();

        $registeredCourseIds = CourseRegistration::where('student_id', $student->id)
            ->pluck('course_id')
            ->toArray();

        foreach ($courses as $course) {
            $course->is_registered = in_array($course->id, $registeredCourseIds);
        }

        return view('courses.index', compact('courses'));
    }

    public function register($course_id)
    {
        $student = Session::get('student');

        if (!$student) {
            return redirect()->route('login')->with('error', 'You must be logged in to register.');
        }

        $alreadyRegistered = CourseRegistration::where('student_id', $student->id)
            ->where('course_id', $course_id)
            ->exists();

        if ($alreadyRegistered) {
            return redirect()->back()->with('error', 'You are already registered for this course.');
        }

        try {
            CourseRegistration::create([
                'student_id' => $student->id,
                'course_id' => $course_id,
            ]);

            return redirect()->back()->with('message', 'Course registered successfully!');
        } catch (\Exception $e) {
            Log::error('Course Registration Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function unregister($course_id)
    {
        $student = Session::get('student');

        if (!$student) {
            return redirect()->route('login')->with('error', 'You must be logged in to unregister.');
        }

        try {
            CourseRegistration::where('student_id', $student->id)
                ->where('course_id', $course_id)
                ->delete();

            return redirect()->back()->with('message', 'Course unregistered successfully.');
        } catch (Exception $e) {
            Log::error('Course Unregistration Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to unregister. Please try again.');
        }
    }
}
