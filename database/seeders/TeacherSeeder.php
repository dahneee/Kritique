<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Block;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $departments = Department::all();
        $subjects = Subject::all();
        $blocks = Block::all();

        foreach (range(1, 15) as $index) {
            $teacher = Teacher::create([
                'teacher_name' => $faker->name,
                'department' => $departments->random()->department_id, 
            ]);

            $teacher->subjects()->attach(
                $subjects->random(rand(2, 3))->pluck('subject_id')->toArray()
            );

            $teacher->blocks()->attach(
                $blocks->random(rand(3, 4))->pluck('block_id')->toArray()
            );
        }
    }
}
