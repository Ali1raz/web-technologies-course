<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'email', 'password', 'profile_picture','department'];

    // A student can register for many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_registrations');
    }

    // A student has many registrations
    public function registrations()
    {
        return $this->hasMany(\App\Models\CourseRegistration::class, 'student_id');
    }

    // Shortcut to access registered courses via pivot table
    public function registeredCourses()
    {
        return $this->belongsToMany(\App\Models\Course::class, 'course_registrations', 'student_id', 'course_id');
    }
}
