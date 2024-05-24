<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Faculity;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentPromotion as ModelsStudentPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPromotion extends Controller
{
    public function list()
    {
        $sts = Student::all();
        $cls = Classs::all();
        $sections = DB::table('sections')->get();
        $student = Student::all();
        $pros = ModelsStudentPromotion::all(); // Update this line

        return view('Admin.pro.index', compact('sts', 'cls', 'pros', 'sections', 'student'));
    }

    public function index(Request $request)
    {
        $cc = Classs::all();
        $ss = Student::all();
        $se = Section::all();
        $facu = Faculity::all();
        $sections = DB::table('sections')->get();

        $students = null;
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            if ($request->filled('from_faculity') && $request->filled('from_class') && $request->filled('from_section')) {
                $fromFaculity = $request->input('from_faculity');
                $fromClass = $request->input('from_class');
                $fromSection = $request->input('from_section');

                // Query students based on the selected class and section
                $students = Student::whereHas('classes', function ($query) use ($fromFaculity, $fromClass, $fromSection) {
                    $query->where('faculity_id', $fromFaculity)->where('class_id', $fromClass)->where('section_id', $fromSection);
                })->get();
            } else {
                // If the form is not submitted, retrieve all students
                $students = Student::all();
            }
        }
        return view('Admin.pro.lll', compact('cc', 'ss', 'students', 'se', 'sections', 'facu'));
    }

    public function p(Request $request)
    {
        // Validate the form data
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'to_class' => 'required|string', // Update to match your actual table name
            'to_section' => 'required|string',
            // 'to_section' => 'required|string',
            'status' => 'required|in:promote,not_promote',
        ]);

        // Retrieve data from the form
        $studentId = $request->input('student_id');
        $toClass = $request->input('to_class');
        $toSection = $request->input('to_section');
        $status = $request->input('status');

        // Retrieve from_class and from_section based on the student_id
        $student = Student::findOrFail($studentId);
        $fromClass = $student->class_id; // Adjust this based on your actual relationship
        $fromFaculity = $student->faculity_id;
        $fromSession = '1'; // Set a default value
        $toSession = '2';
        //checking if data is already lsave
        $existingStudentPro = ModelsStudentPromotion::where('student_id', $studentId)->first();
        if ($existingStudentPro) {
            $existingStudentPro->update([
                'student_id' => $studentId,
                'from_class' => $fromClass,
                'from_section' => $student->section_id,
                'to_class' => $toClass,
                'to_section' => $toSection,
                'from_session' => $fromSession,
                'to_session' => $toSession,
                'status' => $status,
                'from_faculity' => $fromFaculity,

            ]);
        } else {

            ModelsStudentPromotion::create([
                'student_id' => $studentId,
                'from_faculity' => $fromFaculity,
                'from_class' => $fromClass,
                'from_section' => $student->section_id,
                'to_class' => $toClass,
                'to_section' => $toSection,
                'from_session' => $fromSession,
                'to_session' => $toSession,
                'status' => $status,
            ]);
        }


        // Save the promotion data to the StudentPromotion model/table
        if ($status === 'not_promote') {
            // If the status is "Not Promote", don't update the student's data
            return redirect()->route('admin.promotion.index');
        }
        // Update the student data from the students table
        $student->update([
            'class_id' => $toClass,
            'section_id' => $toSection,
        ]);

        // Redirect back to the promotion index page
        return redirect()->route('admin.promotion.index');
    }
}
