<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        
        Department::create([
            'department_id' => 'CITE', 
            'department_name' => 'college of it',
        ]);
        
        Department::create([
            'department_id' => 'CEA', 
            'department_name' => 'college of ea',
        ]);
        
        
    }
}