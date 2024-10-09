<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            DepartmentSeeder::class,
            SubjectSeeder::class,
            BlockSeeder::class,
            TeacherSeeder::class,
            UserSeeder::class,
        ]);
    }

}
