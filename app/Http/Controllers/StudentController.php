<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Validation\ValidationException;
use App\Models\CourseRegistration;

class StudentController extends Controller
{
    public function dashboard()
    {
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        $student = Student::find(Session::get('student_id'));
        if (!$student) {
            Session::flush();
            return redirect()->route('login');
        }

        // Get registered courses with course details
        $registeredCourses = CourseRegistration::with('course')
            ->where('student_id', Session::get('student_id'))
            ->get()
            ->pluck('course');

        return view('dashboard', compact('student', 'registeredCourses'));
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Store student data in session
        Session::put('student_id', $student->id);
        Session::put('student_name', $student->name);
        Session::put('student_email', $student->email);
        Session::put('student_department', $student->department);
        Session::put('student_profile_picture', $student->profile_picture);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login');
    }

    public function showChangePasswordForm()
    {
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = Student::find(Session::get('student_id'));

        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $student->password = Hash::make($request->password);
        $student->save();

        return redirect()->route('profile.edit')->with('message', 'Password changed successfully!');
    }

    public function editProfile()
    {
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        $student = Student::find(Session::get('student_id'));
        return view('profile.edit-profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        if (!Session::has('student_id')) {
            return redirect()->route('login');
        }

        $student = Student::find(Session::get('student_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $student->name = $request->name;
        $student->department = $request->department;

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($student->profile_picture) {
                Storage::delete('public/' . $student->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $student->profile_picture = $path;

            // Update profile picture in session
            Session::put('student_profile_picture', $path);
        }

        $student->save();

        // Update session data
        Session::put('student_name', $student->name);
        Session::put('student_department', $student->department);

        return redirect()->route('profile.edit')->with('message', 'Profile updated successfully!');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'department' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        // Store student data in session
        Session::put('student_id', $student->id);
        Session::put('student_name', $student->name);
        Session::put('student_email', $student->email);
        Session::put('student_department', $student->department);
        Session::put('student_profile_picture', $student->profile_picture);

        return redirect()->route('dashboard');
    }
}
