<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add fake data
        // You can use a library like Faker to generate random data
        // For simplicity, I am using static data here
        $courses = [
            [
                'title' => 'HTML & CSS Fundamentals',
                'instructor' => 'John Doe',
                'credit_hours' => 3,
                'semester' => 'Fall 2025'
            ],
            [
                'title' => 'JavaScript Basics',
                'instructor' => 'Jane Smith',
                'credit_hours' => 3,
                'semester' => 'Fall 2025'
            ],
            [
                'title' => 'Laravel Framework',
                'instructor' => 'Mike Johnson',
                'credit_hours' => 4,
                'semester' => 'Spring 2026'
            ],
            [
                'title' => 'Bootstrap UI Design',
                'instructor' => 'Sarah Williams',
                'credit_hours' => 3,
                'semester' => 'Fall 2025'
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
