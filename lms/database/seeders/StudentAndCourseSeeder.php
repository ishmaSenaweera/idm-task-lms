<?php

namespace Database\Seeders;

use App\Models\StudentCourse;
use Illuminate\Database\Seeder;

class StudentAndCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        StudentCourse::create([
            'student_id' => 4,
            'course_id' => 1,
            'enrollment_year' => '2023',
        ]);

        StudentCourse::create([
            'student_id' => 5,
            'course_id' => 1,
            'enrollment_year' => '2024',
        ]);
    }
}
