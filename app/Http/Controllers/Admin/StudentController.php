<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // it will filter data also but not all data at first then we select then it will list
    // public function index(Request $request)
    // {
    //     $section = $request->input('section');
    //     $students = Student::where('section', $section)->get();

    //     return view('Admin.Student.index', ['students' => $students, 'selectedSection' => $section]);
    // }
    public function index(Request $request)
    {
        $section_id = $request->input('section_id');

        $students = Student::when($section_id, function ($query) use ($section_id) {
            return $query->where('section_id', $section_id);
        })->get();
        $sections = DB::table('sections')->get();
        return view('Admin.Student.index', compact('sections'),['students' => $students, 'selectedSection' => $section_id ]);
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $student = new Student();
            $student->name = $request->name;
            $student->idno = $request->idno;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
            $student->roll = $request->roll;
            $student->class_id = $request->class_id;
            $student->email = $request->email;
            $student->number = $request->number;
            $student->section = 0;
            $student->address = $request->address;
            $student->blood_id = $request->blood_id;
            $student->reli = $request->reli;
            $student->section_id = $request->section_id;
            $student->session_year = $request->session_year;

            $student->image = $request->image->store('uploads/student');
            $student->save();
            return redirect()->back()->with('message', 'Data Add Sucessfully');
        } else {
            $classes = DB::table('classses')->get();
            $bloods = DB::table('bloods')->get();
            $sections = DB::table('sections')->get();
            return view('Admin.Student.add', compact('classes', 'bloods', 'sections'));
        }
    }
    public function teacherIndex(Request $request)
    {
        $name = $request->input('name');
        $teachers = Teacher::when($name, function ($query) use ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })->get();

        return view('Admin.Teacher.index', ['teachers' => $teachers, 'selectedName' => $name]);
    }

    public function teacheradd(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            $teacher = Teacher::all();
            // dd($teacher);
            $teacher = new Teacher();
            $teacher->image = $request->image->store('uploads/teacher');
            $teacher->cv = $request->cv->store('uploads/teacher');
            $teacher->name = $request->name;
            $teacher->gender = $request->gender;
            $teacher->dob = $request->dob;
            $teacher->number = $request->number;
            $teacher->address = $request->address;
            $teacher->jd = $request->jd;
            $teacher->exp = $request->exp;
            $teacher->email = $request->email;
            $teacher->qual = $request->qual;
            $teacher->sub = json_encode($request->input('sub'));
            $teacher->save();
            return redirect()->back();
            // return response()->json(['teacher' => $teacher]);
        }
    }
    public function teacherShow($teacher)
    {
        $teacherData = DB::table('teachers')->find($teacher);
        return view('Admin.Teacher.show', compact('teacherData'));
    }
    public function studentShow($student)
    {
        // Find the student by ID with the 'class' relationship loaded
        $student = Student::with(['classes', 'blood'])->find($student);
        // dd($student);

        // Check if the student is not found


        // Access the 'class' relationship and its 'name' property, providing a fallback value if null
        // $className = $student->classes ? $student->classes->name : 'N/A';

        // Get all classes (you may want to replace this with your actual logic to get classes)
        $classes = DB::table('classses')->get();

        // Get all blood groups
        $bloods = DB::table('bloods')->get();

        // Return the view with the student, className, classes, and bloods data
        return view('Admin.Student.show', compact('student', 'classes', 'bloods'));
    }
}
