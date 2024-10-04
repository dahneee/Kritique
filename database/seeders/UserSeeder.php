<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
use App\Models\User; 

class UserSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'first_name' => 'admin',
                'middle_name' => '',
                'last_name' => '', 
                'block' => '', 
                'email' => 'admin@example.com', 
                'password' => Hash::make('admin123123'), 
                'user_type' => 'admin',
            ],
            [
                'student_id' => '03-2021',
                'first_name' => 'John',
                'middle_name' => 'A',
                'last_name' => 'Doe', 
                'block' => 'BSIT3-06', 
                'department' => 'CITE', 
                'email' => 'john@example.com', 
                'password' => Hash::make('password123'), 
            ],
            [
                'student_id' => '02-2023',
                'first_name' => 'Jane',
                'middle_name' => 'B',
                'last_name' => 'Smith',
                'block' => 'BSIT3-07',
                'department' => 'CEA',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '03-2023',
                'first_name' => 'Emily',
                'middle_name' => 'C',
                'last_name' => 'Johnson',
                'block' => 'BSIT3-08',
                'department' => 'CITE',
                'email' => 'emily@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '04-2023',
                'first_name' => 'Michael',
                'middle_name' => 'D',
                'last_name' => 'Williams',
                'block' => 'BSIT3-09',
                'department' => 'CEA',
                'email' => 'michael@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => '05-2023',
                'first_name' => 'Jessica',
                'middle_name' => 'E',
                'last_name' => 'Brown',
                'block' => 'BSIT3-10',
                'department' => 'CITE',
                'email' => 'jessica@example.com',
                'password' => Hash::make('password123'),
                'user_type' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
