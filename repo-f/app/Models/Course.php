<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     
    use HasFactory;

    // Optional: If your table isn't named 'courses', uncomment this:
    // protected $table = 'courses';

    protected $fillable = [
       'description',
        'name',
        'title',
        'credit_hours',
        'instructor',
    ];

    // A course has many registrations (one-to-many)
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
        //return $this->hasMany(\App\Models\CourseRegistration::class, 'course_id');
    }

    // A course belongs to many students (many-to-many)
    public function students()
    {
        return $this->belongsToMany(\App\Models\Student::class, 'course_registrations', 'course_id', 'student_id');
    }
}
