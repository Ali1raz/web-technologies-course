<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'title' => 'Programming fundamentals',
                'name' => 'CS101',
                'description' => 'Fundamentals of programming concepts and problem-solving',
                'credit_hours' => 3,
                'instructor' => 'Kaleem Satar'
            ],
            [
                'title' => 'Data Structures and Algorithms',
                'name' => 'CS201',
                'description' => 'Study of fundamental data structures and algorithm design',
                'credit_hours' => 4,
                'instructor' => 'Kaleem Satar'
            ],
            [
                'title' => 'Database Management Systems',
                'name' => 'CS301',
                'description' => 'Design and implementation of database systems',
                'credit_hours' => 3,
                'instructor' => 'Umar Rashid'
            ],
            [
                'title' => 'Web Development',
                'name' => 'CS401',
                'description' => 'Modern web development technologies and frameworks',
                'credit_hours' => 3,
                'instructor' => 'Yasmeen jana'
            ],
            [
                'title' => 'Software Engineering',
                'name' => 'CS501',
                'description' => 'Software development lifecycle and methodologies',
                'credit_hours' => 4,
                'instructor' => 'Manzoor Ahmed'
            ],
            [
                'title' => 'Computer Networks',
                'name' => 'CS601',
                'description' => 'Network protocols and communication systems',
                'credit_hours' => 3,
                'instructor' => 'Yasir munir'
            ],
            [
                'title' => 'Artificial Intelligence',
                'name' => 'CS701',
                'description' => 'Introduction to AI and machine learning concepts',
                'credit_hours' => 4,
                'instructor' => 'Kaleem Satar'
            ],
            [
                'title' => 'Operating Systems',
                'name' => 'CS801',
                'description' => 'OS concepts, processes, and memory management',
                'credit_hours' => 3,
                'instructor' => 'Yasmeen Jana'
            ],
            [
                'title' => 'Mobile App Development',
                'name' => 'CS901',
                'description' => 'Development of mobile applications',
                'credit_hours' => 3,
                'instructor' => 'Sir Abdullah'
            ],
            [
                'title' => 'Cybersecurity',
                'name' => 'CS1001',
                'description' => 'Security principles and practices',
                'credit_hours' => 4,
                'instructor' => 'Sir Abdullah'
            ],
            [
                'title' => 'Cloud Computing',
                'name' => 'CS1101',
                'description' => 'Cloud services and distributed systems',
                'credit_hours' => 3,
                'instructor' => 'Komal Hassan'
            ],
            [
                'title' => 'Big Data Analytics',
                'name' => 'CS1201',
                'description' => 'Processing and analysis of large datasets',
                'credit_hours' => 4,
                'instructor' => 'Sir Abdullah'
            ],
            [
                'title' => 'Blockchain Technology',
                'name' => 'CS1301',
                'description' => 'Blockchain fundamentals and applications',
                'credit_hours' => 3,
                'instructor' => 'Sir Adbul-Rehman'
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
