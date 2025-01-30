<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{        // Display all courses
    public function index()
    {

        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    //create course

    public function store(request $request)
    {
        //Validation
        $request->validate([
            'course_name' => 'required|string',
            'description' => 'required|string'
        ]);

        //Store in Db
        $course = new Course;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->save();

        return redirect('/courses')->with('success', 'Course Added Successfully');
    }

    //Update course

    public function update(request $request)
    {
        //Validation
        $request->validate([
            'course_name' => 'required|string',
            'description' => 'required|string|max:255'
        ]);
        //Update
        $course = Course::findOrFail($request->course_id);
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->save();


        return redirect('/courses')->with('success', 'Course Updated Successfully');
    }

    //Delete Course

    public function destroy($id)
    {
        Course::where('id', $id)->delete();

        return redirect('/courses')->with('success', 'Course Deleted Successfully');
    }
}
