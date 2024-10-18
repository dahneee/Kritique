<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Teacher; 
use App\Models\Questionnaire;
use App\Models\Question;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTeachers = Teacher::count();
        $totalStudents = User::where('user_type', 'student')->count();

        $departments = ['CAHS', 'CAS', 'CCJE', 'CELA', 'CEA', 'CITE', 'CMA']; 
        
        $studentCounts = [];
        $studentsPerDepartment = []; 
        $teacherCounts = [];

        foreach ($departments as $department) {
            $studentCounts[] = Questionnaire::whereHas('student', function ($query) use ($department) {
                $query->where('department', $department)
                      ->where('user_type', 'student');
            })->count(); 
            
            $studentsPerDepartment[] = User::where('department', $department)->count(); 
        }

        $totalSubmissions = Questionnaire::count();
        $totalQuestions = Question::count();

        foreach ($departments as $department) {
            $teacherCounts[] = Teacher::where('department', $department)->count(); 
        }

        return view('admin.dashboard', compact('totalTeachers', 'totalStudents', 'studentCounts', 'departments', 
                    'teacherCounts', 'totalSubmissions', 'totalQuestions', 'studentsPerDepartment'));
    }
}
