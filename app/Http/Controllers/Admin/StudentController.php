<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $section = $request->input('section');

        $students = Student::when($section, function ($query) use ($section) {
            return $query->where('section', $section);
        })->get();

        return view('Admin.Student.index', ['students' => $students, 'selectedSection' => $section]);
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
            $student->class = $request->class;
            $student->email = $request->email;
            $student->number = $request->number;
            $student->section = $request->section;
            $student->image = $request->image->store('uploads/student');
            $student->save();
            return redirect()->back()->with('message', 'Data Add Sucessfully');
        } else {
            return view('Admin.Student.add');
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
}
