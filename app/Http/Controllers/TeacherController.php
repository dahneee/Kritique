<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with(['department', 'subjects', 'blocks'])->get();
        return view('admin.view-teachers', compact('teachers'));
    }
}

