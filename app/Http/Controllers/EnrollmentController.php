<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{           //Display Students & Courses
    public function index()
    {
        $students = Student::with('courses')->get();
        $courses = Course::all();
        return view('enroll.index', compact('students', 'courses'));
    }
    public function store(Request $request)
    {     //Validation

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);
        // Enrollment
        $student = Student::findOrFail($request->student_id);
        $student->courses()->attach($request->course_id);

        return redirect('/enroll')->with('success', 'Student enrolled successfully!');
    }

    public function destroy($student_id)
    {
        $student = Student::findOrFail($student_id);
        $student->courses()->detach(); // Remove all courses

        return redirect('/enroll')->with('success', 'Student unenrolled from courses.');
    }

}
