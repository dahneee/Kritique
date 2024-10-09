<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Block;

class UserSeeder extends Seeder
{
    public function run()
    {
        $departments = Department::pluck('department_id')->toArray();
        $blocks = Block::pluck('block_id')->toArray();

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

        $users = [
            [
                'student_id' => '03-2021',
                'first_name' => 'John',
                'middle_name' => 'A',
                'last_name' => 'Doe',
                'block' => '',
                'department' => '',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'student_id' => '02-2023',
                'first_name' => 'Jane',
                'middle_name' => 'B',
                'last_name' => 'Smith',
                'block' => '',
                'department' => '',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'student_id' => '03-2023',
                'first_name' => 'Emily',
                'middle_name' => 'C',
                'last_name' => 'Johnson',
                'block' => '',
                'department' => '',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'student_id' => '04-2023',
                'first_name' => 'Michael',
                'middle_name' => 'D',
                'last_name' => 'Williams',
                'block' => '',
                'department' => '',
                'email' => 'michael@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'student_id' => '05-2023',
                'first_name' => 'Jessica',
                'middle_name' => 'E',
                'last_name' => 'Brown',
                'block' => '',
                'department' => '',
                'email' => 'jessica@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        foreach ($users as &$user) {
            if (isset($user['student_id'])) {
                $user['block'] = $blocks[array_rand($blocks)];
                $user['department'] = $departments[array_rand($departments)];
            }

            if (!User::where('email', $user['email'])->exists()) {
                if (isset($user['department']) && !empty($user['department'])) {
                    User::create($user);
                }
            }
        }
    }
}
