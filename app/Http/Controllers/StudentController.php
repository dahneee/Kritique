<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            return response()->json(['success' => true, 'message' => 'User updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Some problem occurred']);
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

    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Student ID');
        $sheet->setCellValue('B1', 'First Name');
        $sheet->setCellValue('C1', 'Middle Name');
        $sheet->setCellValue('D1', 'Last Name');
        $sheet->setCellValue('E1', 'Block');
        $sheet->setCellValue('F1', 'Department');
        $sheet->setCellValue('G1', 'User Type');
        $sheet->setCellValue('H1', 'Email');

        $users = User::with(['department', 'block'])->get();
        $row = 2; 

        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->student_id);
            $sheet->setCellValue('B' . $row, $user->first_name);
            $sheet->setCellValue('C' . $row, $user->middle_name);
            $sheet->setCellValue('D' . $row, $user->last_name);
            $sheet->setCellValue('E' . $row, $user->block); 
            $sheet->setCellValue('F' . $row, $user->department); 
            $sheet->setCellValue('G' . $row, $user->user_type);
            $sheet->setCellValue('H' . $row, $user->email);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'students.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    
}