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
        if (!Session::has('student')) {
            return redirect()->route('login');
        }

        $student = Student::find(Session::get('student')->id);
        if (!$student) {
            Session::forget('student');
            return redirect()->route('login');
        }

        $registeredCourses = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->get()
            ->pluck('course');

        return view('dashboard', [
            'student' => $student,
            'registeredCourses' => $registeredCourses
        ]);
    }

    public function showLoginForm()
    {
        if (Session::has('student')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6'
            ], [
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email address',
                'password.required' => 'Please enter your password',
                'password.min' => 'Password must be at least 6 characters'
            ]);

            $student = Student::where('email', $request->email)->first();

            if (!$student) {
                return back()
                    ->withErrors(['email' => 'No account found with this email address'])
                    ->withInput($request->except('password'));
            }

            if (!Hash::check($request->password, $student->password)) {
                return back()
                    ->withErrors(['password' => 'Incorrect password'])
                    ->withInput($request->except('password'));
            }

            Session::put('student', $student);
            return redirect()->route('dashboard');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'An error occurred. Please try again.'])
                ->withInput($request->except('password'));
        }
    }

    public function logout()
    {
        Session::forget('student');
        return redirect()->route('login');
    }

    public function showChangePasswordForm()
    {
        $student = Session::get('student');
        if (!$student) {
            return redirect('/login');
        }

        return view('change-password', ['student' => $student]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $student = Student::find(Session::get('student')->id);

        if (!Hash::check($request->current_password, $student->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        $student->password = Hash::make($request->new_password);
        $student->save();

        return redirect('/dashboard')->with('message', 'Password changed successfully.');
    }

    public function editProfile()
    {
        $student = Session::get('student');
        if (!$student) {
            return redirect()->route('login');
        }
        return view('profile.edit-profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Student::find(Session::get('student')->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student->name = $request->name;
        $student->department = $request->department;

        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $student->profile_picture = $imageName;
        }

        $student->save();
        Session::put('student', $student);

        return redirect()->route('dashboard')->with('message', 'Profile updated successfully.');
    }

    public function showRegistrationForm()
    {
        if (Session::has('student')) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'password' => 'required|min:6|confirmed',
                'department' => 'required|string|max:255',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Please enter your name',
                'name.max' => 'Name cannot exceed 255 characters',
                'email.required' => 'Please enter your email address',
                'email.email' => 'Please enter a valid email address',
                'email.unique' => 'This email is already registered',
                'password.required' => 'Please enter a password',
                'password.min' => 'Password must be at least 6 characters',
                'password.confirmed' => 'Password confirmation does not match',
                'department.required' => 'Please enter your department',
                'profile_picture.image' => 'The file must be an image',
                'profile_picture.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
                'profile_picture.max' => 'The image size cannot exceed 2MB'
            ]);

            $student = new Student();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->department = $request->department;
            $student->password = Hash::make($request->password);

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $student->profile_picture = $imageName;
            }

            $student->save();
            Session::put('student', $student);

            return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome, ' . $student->name . '!');
        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
