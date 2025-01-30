<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{      //Displays all  students 
    public function index()
    {

        $students = Student::all();
        return view('students.index', compact('students'));
    }

    //Create student
    public function store(request $request)
    {          //Validation
        $request->validate([
            'student_name' => 'required|string',
            'email' => 'required|unique:students,email',
            'phone' => 'required|string|min:10'
        ]);
        //store to the Db
        $student = new Student;
        $student->student_name = $request->student_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect('/students')->with('success', 'Student Added Successfully');
    }

    //update student

    public function update(request $request)
    {
        //validation
        $request->validate([
            'student_name' => 'required|string',
            'email' => 'required|unique:students,email,' . $request->student_id,
            'phone' => 'required|string|min:10'
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->student_name = $request->student_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect('/students')->with('success', 'Student Updated Successfully');

    }

    //Delete Student

    public function destroy($id)
    {

        Student::where('id', $id)->delete();

        return redirect('/students')->with('success', 'Student Deleted Successfully');
    }
}
