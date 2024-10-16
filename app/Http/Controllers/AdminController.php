<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Teacher; 

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTeachers = Teacher::count();
        $totalStudents = User::where('user_type', 'student')->count();

        $departments = ['CAHS', 'CAS', 'CCJE', 'CELA', 'CEA', 'CITE', 'CMA']; 
        
        $studentCounts = [];

        $teacherCounts = [];

        foreach ($departments as $department) {
            $studentCounts[] = User::where('department', $department)->count(); 
        }

        foreach ($departments as $department) {
            $teacherCounts[] = Teacher::where('department', $department)->count(); 
        }
        return view('admin.dashboard', compact('totalTeachers', 'totalStudents', 'studentCounts', 'departments', 'teacherCounts'));
    }
}
