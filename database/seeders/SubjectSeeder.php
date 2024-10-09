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
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
