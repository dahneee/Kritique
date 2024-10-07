<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 

class StudentController extends Controller
{
    public function index()
    {
       
        $blocks = User::where('user_type', 'student')
                      ->select('block')
                      ->distinct()
                      ->get()
                      ->pluck('block');

     
        $students = User::where('user_type', 'student')->get();

        return view('admin.view-students', compact('students', 'blocks'));
    }
}
