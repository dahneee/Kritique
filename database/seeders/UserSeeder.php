<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Block;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $departments = Department::all();
        $blocks = Block::all();
        $years = ['First', 'Second', 'Third', 'Fourth'];

        $adminUser = [
            'first_name' => 'admin',
            'middle_name' => '',
            'last_name' => '',
            'block' => '',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123123'),
            'user_type' => 'admin',
        ];

        if (!User::where('email', $adminUser['email'])->exists()) {
            User::create($adminUser);
        }

        foreach (range(1, 50) as $index) {
            $student = User::create([
                'student_id' => $faker->unique()->numerify('##-####'),
                'first_name' => $faker->firstName,
                'middle_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password123'),
                'block' => $blocks->random()->block_id, 
                'year' => $faker->randomElement($years),
                'department' => $departments->random()->department_id,  
                'user_type' => 'student',
            ]);
        }
    }
}
