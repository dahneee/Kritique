<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $subjects = [
            [
                'subject_id' => 'ITE 359',
                'subject_name' => 'Networking 2',
            ],
            [
                'subject_id' => 'ITE 302',
                'subject_name' => 'Information Assurance and Security 1',
            ],
            [
                'subject_id' => 'ITE 353',
                'subject_name' => 'Data Scalability and Analytics',
            ],
            [
                'subject_id' => 'ITE 307',
                'subject_name' => 'Quantitative Methods',
            ],
            [
                'subject_id' => 'ITE 314',
                'subject_name' => 'Advanced Database Systems',
            ],
            [
                'subject_id' => 'SSP 007',
                'subject_name' => 'Student Success Program 3',
            ],
            [
                'subject_id' => 'ITE 260',
                'subject_name' => 'Computer Programming 1',
            ],
            [
                'subject_id' => 'MAT 152',
                'subject_name' => 'Mathematics in the Modern World',
            ],
            [
                'subject_id' => 'PED 025',
                'subject_name' => 'Movement Enhancement',
            ],
            [
                'subject_id' => 'NST 022',
                'subject_name' => 'National Service Training Program 2',
            ],
            [
                'subject_id' => 'GEN 005',
                'subject_name' => 'The Contemporary World',
            ],
            [
                'subject_id' => 'GEN 004',
                'subject_name' => 'Readings in Philippine History',
            ],
            [
                'subject_id' => 'CHE 025',
                'subject_name' => 'Chemistry',
            ],
            [
                'subject_id' => 'BES 025',
                'subject_name' => 'Statics of Rigid Bodies',
            ],
            [
                'subject_id' => 'BES 043',
                'subject_name' => 'Computer Programming (Eng)',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
