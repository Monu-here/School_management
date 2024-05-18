<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $name = $request->input('name');
        $idno = $request->input('idno');

        $studentsQuery = Student::query();


        if ($section_id) {
            $studentsQuery->where('section_id', $section_id);
            $selectedSection = $section_id;
        } else {
            $selectedSection = null;
        }

        if ($name) {
            $studentsQuery->where('name', 'like', '%' . $name . '%');
            $selectedName = $name;
        } else {
            $selectedName = null;
        }


        if ($idno) {
            $studentsQuery->where('idno', 'like', '%' . $idno . '%');
            $selectedIdno = $idno;
        } else {
            $selectedIdno = null;
        }

        $students = $studentsQuery->get();
        $sections = DB::table('sections')->get();
        $cls = DB::table('classses')->get();

        return view('Admin.Student.index', compact('cls', 'sections', 'students', 'selectedSection', 'selectedName', 'selectedIdno'));
    }



    public function add(Request $request)
    {

        if ($request->getMethod() == "POST") {
            $student = new Student();

            $student->idno = random_int(1000, 9999);
            $student->name = $request->name;
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
            $student->parent_email = $request->parent_email;
            $student->f_name = $request->f_name;
            $student->f_occ = $request->f_occ;
            $student->f_no = $request->f_no;
            $student->m_name = $request->m_name;
            $student->m_occ = $request->m_occ;
            $student->m_no = $request->m_no;
            $student->f_image = $request->f_image->store('uploads/student/father');
            $student->m_image = $request->m_image->store('uploads/student/mother');
            $student->image = $request->image->store('uploads/student');
            // dd($student);
            $student->save();
            $request->session()->forget('idno');

            return redirect()->back()->with('message', 'Data Add Sucessfully');
        } else {
            $idno = random_int(1000, 9999);
            $classes = DB::table('classses')->get();
            $bloods = DB::table('bloods')->get();
            $sections = DB::table('sections')->get();
            return view('Admin.Student.add', compact('classes', 'bloods', 'sections', 'idno'));
        }
    }

    public function del($student)
    {
        DB::table('students')->where('id', $student)->delete();
        return redirect()->back()->with('message', 'Student Delete Successfully');
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
             $teacher = Teacher::all();
             
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
         }
        
    }
    public function teacherShow($teacher)
    {
        $teacherData = DB::table('teachers')->find($teacher);
        return view('Admin.Teacher.show', compact('teacherData'));
    }
    public function studentShow($student)
    {
        $student = Student::with(['classes', 'blood'])->find($student);

        $classes = DB::table('classses')->get();

        $bloods = DB::table('bloods')->get();
        $sections = DB::table('sections')->get();

        return view('Admin.Student.show', compact('student', 'classes', 'bloods', 'sections'));
    }
}
