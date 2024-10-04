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
                'student_id' => '03-2021',
                'first_name' => 'John',
                'middle_name' => '',
                'last_name' => 'Doe', 
                'block' => 'BSIT3-06', 
                'department' => 'CITE', 
                'email' => 'john@example.com', 
                'password' => Hash::make('password123'), 
            ],
            [
                'first_name' => 'admin',
                'middle_name' => '',
                'last_name' => '', 
                'block' => '', 
                'email' => 'admin@example.com', 
                'password' => Hash::make('admin123123'), 
            ],
        ];

        // Insert each user into the database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
