<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'department_id' => 'CITE',
                'department_name' => 'College of IT',
            ],
            [
                'department_id' => 'CEA',
                'department_name' => 'College of EA',
            ],
            [
                'department_id' => 'CELA',
                'department_name' => 'College of LA',
            ],
            [
                'department_id' => 'CMA',
                'department_name' => 'College of MA',
            ],
            [
                'department_id' => 'CCJE',
                'department_name' => 'College of CJE',
            ],
            [
                'department_id' => 'CAS',
                'department_name' => 'College of AS',
            ],
            [
                'department_id' => 'CAHS',
                'department_name' => 'College of AHS',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
