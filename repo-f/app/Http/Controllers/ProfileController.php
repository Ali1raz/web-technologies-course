<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\CourseRegistration;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Auth::user();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->get();

        return view('profile.index', compact('student', 'registrations'));
    }
}
