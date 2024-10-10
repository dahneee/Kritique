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

    public function create()
    {
        return view('admin.create-student');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'student_id' => 'required|unique:users,student_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_type' => 'required|in:student,admin',
            'block' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $validation['password'] = bcrypt($validation['password']);

        $data = User::create($validation);

        if ($data) {
            session()->flash('success', 'User added successfully');
            return redirect(route('view-student'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('create-student'));
        }
    }

    public function edit($id)
    {
        $students = User::findOrFail($id);
        return view('admin.update-student', compact('students'));
    }

    public function update(Request $request, $id)
    {
        $students = User::findOrFail($id);

        $validation = $request->validate([
            'student_id' => 'required|unique:users,student_id,' . $id, 
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_type' => 'required|in:student,admin',
            'block' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, 
        ]);

        $students->student_id = $validation['student_id'];
        $students->first_name = $validation['first_name'];
        $students->middle_name = $validation['middle_name'];
        $students->last_name = $validation['last_name'];
        $students->user_type = $validation['user_type'];
        $students->block = $validation['block'];
        $students->department = $validation['department'];
        $students->email = $validation['email'];

        $data = $students->save();

        if ($data) {
            session()->flash('success', 'User updated successfully');
            return redirect(route('view-student'));
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('update-student', $id));
        }
    }

    public function delete($id)
    {
        $students = User::findOrFail($id)->delete();
        if ($students) {
            session()->flash('success', 'Student Deleted Successfully');
            return redirect(route('view-student'));
        } else {
            session()->flash('error', 'Student Delete Unsuccessful');
            return redirect(route('view-student'));
        }
    }

}
