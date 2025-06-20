<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Course;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $table = 'course_registrations';

    protected $fillable = [
        'student_id',
        'course_id',
    ];

    // Relationships

    // Each registration belongs to one student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Each registration belongs to one course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
