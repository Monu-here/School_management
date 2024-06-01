<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blood;
use App\Models\Classs;
use App\Models\Faculity;
use App\Models\Mark;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $facts = Faculity::get();


        return view('Admin.Student.index', compact('cls', 'sections', 'students', 'selectedSection', 'selectedName', 'selectedIdno', 'facts'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|string|',
                'dob' => 'nullable|date',
                'class_id' => 'required|exists:classses,id',
                'email' => 'required|email|unique:users,email',
                'address' => 'required|string|max:255',
                'blood_id' => 'nullable|exists:bloods,id',
                'reli' => 'nullable|string|max:50',
                'section_id' => 'required|exists:sections,id',
                'session_year' => 'string|max:4',
                'parent_email' => 'required|email',
                'f_name' => 'required|string|max:255',
                'f_occ' => 'nullable|max:255',
                'f_no' => 'digiats:10',
                'm_name' => 'nullable|string|max:255',
                'm_occ' => 'nullable|max:255',
                'm_no' => 'nullable|digits:10',
                'f_image' => 'required|image',
                'm_image' => 'nullable|image',
                'image' => 'required|image',
                'idno' => 'required',
                'password' => 'required|string|min:8|',
                'faculity_id' => 'required|exists:faculities,id',
            ]);

            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'number' => $request->number,
                    'role_name' => 'Student',
                    'image' => $request->image->store('uploads/user'),
                ]);

                $student = new Student([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'section' => 0,
                    'class_id' => $request->class_id,
                    'address' => $request->address,
                    'blood_id' => $request->blood_id,
                    'reli' => $request->reli,
                    'section_id' => $request->section_id,
                    'session_year' => $request->session_year,
                    'parent_email' => $request->parent_email,
                    'f_name' => $request->f_name,
                    'f_occ' => $request->f_occ,
                    'f_no' => $request->f_no,
                    'm_name' => $request->m_name,
                    'm_occ' => $request->m_occ,
                    'idno' => $request->idno,
                    'm_no' => $request->m_no,
                    'f_image' => $request->file('f_image')->store('uploads/student/father'),
                    'm_image' => $request->file('m_image')->store('uploads/student/mother'),
                    'image' => $request->file('image')->store('uploads/student'),
                    'faculity_id' => $request->faculity_id,
                ]);
                // dd($student);    
                $student->save();
                return redirect()->back()->with('message', 'Student & User added successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error adding student & user: ' . $e->getMessage());
            }
        } else {
            $classes = Classs::all();
            $bloods = DB::table('bloods')->get();
            $sections = Section::all();
            $faculitys = Faculity::all();
            return view('Admin.Student.add', compact('classes', 'bloods', 'sections', 'faculitys'));
        }
    }

    public function studentedit(Request $request, Student $student)
    {
        if ($request->isMethod('post')) {
            $section = 0;
            $student->name = $request->name;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
            $student->class_id = $request->class_id;
            $student->number = $request->number;
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
            $student->idno = $request->idno;
            $student->m_no = $request->m_no;
            $student->faculity_id = $request->faculity_id;

            if ($request->hasFile('image')) {
                $student->image = $request->image->store('uploads/student');
            }

            if ($request->hasFile('f_image')) {
                $student->f_image = $request->f_image->store('uploads/student/father');
            }
            if ($request->hasFile('m_image')) {
                $student->m_image = $request->m_image->store('uploads/student/mother');
            }

            $student->save();

            return redirect()->back()->with('message', 'Student  update successfully');
        } else {
            $classes = Classs::all();
            $bloods = DB::table('bloods')->get();
            $sections = Section::all();
            $faculitys = Faculity::all();

            return view('Admin.Student.edit', compact('classes', 'bloods', 'sections', 'student', 'faculitys'));
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
            $request->validate([
                'name' => 'required|string|max:255',
                'gender' => 'required|string|',
                'dob' => 'required|date',
                'class_id' => 'required|exists:classses,id',
                'email' => 'required|email|unique:users,email',
                'email' => 'required|email|unique:teachers,email',
                'number' => 'required|digits:10',
                'address' => 'required|string|max:255',
                'section_id' => 'required|exists:sections,id',
                'image' => 'required|image',
                'cv' => 'required|image',
                'password' => 'required|string|min:8|',
                'workinghrs' => 'string',
                'faculity_id' => 'required|exists:faculities,id',

            ]);

            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'number' => $request->number,
                    'role_name' => 'Teacher',
                    'image' => $request->image->store('uploads/user'),
                ]);
                $teacher = new Teacher([
                    'user_id' => $user->id,
                    'image' => $request->image->store('uploads/teacher'),
                    'cv' => $request->cv->store('uploads/teacher'),
                    'name' => $request->name,
                    'gender' => $request->gender,
                    'dob' => $request->dob,
                    'email' => $request->email,
                    'number' => $request->number,
                    'address' => $request->address,
                    'jd' => $request->jd,
                    'exp' => $request->exp,
                    'qual' => $request->qual,
                    'class_id' => $request->class_id,
                    'workinghrs' => $request->workinghrs,
                    'section_id' => $request->section_id,
                    'faculity_id' => $request->faculity_id,
                ]);
                //  dd($teacher);
                $teacher->save();
                return redirect()->back()->with('message', 'Teacher and User successfully added');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error adding teacher & user: ' . $e->getMessage());
            }
        } else {
            $classes = Classs::all();
            $sections = Section::all();
            $facts = Faculity::all();
            return view('Admin.Teacher.add', compact('classes', 'sections', 'facts'));
        }
    }
    public function teacherEdit(Request $request, Teacher $teacher)
    {
        if ($request->getMethod() == "POST") {
            $request->validate([
                'name' => 'nullable|string|max:255',
                'gender' => 'nullable|string|',
                'dob' => 'nullable|date',
                'class_id' => 'nullable|exists:classses,id',
                'email' => 'nullable|email|unique:users,email',
                'email' => 'nullable|email|unique:teachers,email',
                'number' => 'nullable|digits:10',
                'address' => 'nullable|string|max:255',
                'section_id' => 'nullable|exists:sections,id',
                'image' => 'nullable|image',
                'cv' => 'nullable|image',
            ]);
            // $user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request->password),
            //     'number' => $request->number,
            //     'role_name' => 'Teacher',
            //     'image' => $request->image->store('uploads/user'),
            // ]);
            if ($request->hasFile('image')) {
                $teacher->image = $request->image->store('uploads/teacher');
            }
            if ($request->hasFile('cv')) {
                $teacher->cv = $request->cv->store('uploads/teacher');
            }
            $teacher->name = $request->name;
            $teacher->gender = $request->gender;
            $teacher->dob = $request->dob;
            $teacher->email = $request->email;
            $teacher->number = $request->number;
            $teacher->address = $request->address;
            $teacher->jd = $request->jd;
            $teacher->exp = $request->exp;
            $teacher->qual = $request->qual;
            $teacher->class_id = $request->class_id;
            $teacher->section_id = $request->section_id;
            $teacher->workinghrs = $request->workinghrs;
            $teacher->faculity_id = $request->faculity_id;

            $teacher->sub = json_encode($request->input('sub'));

            $teacher->save();
            return redirect()->back()->with('message', 'Data added successfully');
        } else {
            $classes = Classs::all();
            $sections = Section::all();
            $facts = Faculity::all();

            return view('Admin.Teacher.edit', compact('classes', 'sections', 'teacher', 'facts'));
        }
    }
    public function teacherShow($teacher)
    {
        $teacherData = DB::table('teachers')->find($teacher);
        $classes = Classs::all();
        $sections = Section::all();
        return view('Admin.Teacher.show', compact('teacherData', 'classes', 'sections'));
    }
    public function teacherDel($teacher)
    {
        DB::table('teachers')->where('id', $teacher)->delete();
        return redirect()->back()->with('message', 'Data delete sucessfully');
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
