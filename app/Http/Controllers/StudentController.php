<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    // ✅ Show Dashboard
    public function dashboard()
    {
        $student = Session::get('student');
        if (!$student) {
            return ('/login');
        }

        return view('dashboard', ['student' => $student]);
    }

    // ✅ Show Login Form
    public function showLoginForm()
    {
        return view('login'); // Make sure resources/views/login.blade.php exists
    }

    // ✅ Handle Login Request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }

        // Set session manually
        Session::put('student', $student);

        return redirect()->route('dashboard');
    }
    

    // ✅ Handle Logout
    public function logout()
    {
        Session::forget('student');
        Session::flush();

        return redirect('/login')->with('message', 'Logged out successfully.');
    }

    // ✅ Show Change Password Form
    public function showChangePasswordForm()
    {
        $student = Session::get('student');
        if (!$student) {
            return redirect('/login');
        }

        return view('change-password', ['student' => $student]);
    }

    // ✅ Handle Password Change
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

    // ✅ Show Edit Profile Form
    public function editProfile()
    {
        $student = Session::get('student');
        if (!$student) {
            return redirect('/login');
        }

        return view('edit-profile', ['student' => $student]);
    }

    // ✅ Handle Profile Update
    public function updateProfile(Request $request)
    {
        $student = Student::find(Session::get('student')->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'department' => 'nullable|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student->name = $request->name;
        $student->email = $request->email;
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
        Session::put('student', $student); // Refresh session with updated data

        return redirect('/edit-profile')->with('message', 'Profile updated successfully.');
    }

    // ✅ Show Registration Form
    public function showRegistrationForm()
    {
        return view('register'); // Make sure resources/views/register.blade.php exists
    }

    // ✅ Handle Registration Request
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:6|confirmed',
            'department' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->department = $request->department;
        $student->password = \Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $student->profile_picture = $imageName;
        }

        $student->save();

        // Optionally, log the student in after registration
        \Session::put('student', $student);

        return redirect()->route('dashboard')->with('message', 'Registration successful!');
    }
}
