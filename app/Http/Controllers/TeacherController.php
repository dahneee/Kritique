<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('admin.view-teachers', compact('teachers'));
    }

    public function create()
    {
        return view('admin.create-teacher');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'teacher_first_name' => 'required|string|max:255',
            'teacher_middle_name' => 'nullable|string|max:255',
            'teacher_last_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
        ]);

        Teacher::create($validation);
        session()->flash('success', 'Teacher added successfully');
        return redirect(route('view-teachers'));
    }

    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('admin.update-teacher', compact('teacher'));
    }

    public function update(Request $request, $id)
{
    $teacher = Teacher::findOrFail($id);

    $validation = $request->validate([
        'teacher_first_name' => 'required|string|max:255',
        'teacher_middle_name' => 'nullable|string|max:255',
        'teacher_last_name' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'email' => 'required|email|unique:teachers,email,' . $id,
    ]);

    $teacher->teacher_first_name = $validation['teacher_first_name'];
    $teacher->teacher_middle_name = $validation['teacher_middle_name'];
    $teacher->teacher_last_name = $validation['teacher_last_name'];
    $teacher->department = $validation['department'];
    $teacher->email = $validation['email'];

    $data = $teacher->save();

    if ($data) {
        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    } else {
        return response()->json(['success' => false, 'message' => 'Some problem occurred']);
    }
}


    public function delete($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        session()->flash('success', 'Teacher Deleted Successfully');
        return redirect(route('view-teachers'));
    }
}
