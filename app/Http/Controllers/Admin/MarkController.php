<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Mark;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function index()
    {
        return view('Admin.mark.index');
    }

    public function add(Request $request)
    {
        $exams = DB::table('exams')->get();
        $classes = DB::table('classses')->get();
        $sections = DB::table('sections')->get();
        $subjects = DB::table('subjects')->get();

        return view('Admin.mark.create', compact('classes', 'sections', 'subjects', 'exams'));
    }

    public function getStudents(Request $request)
    {
        $selectedClass = $request->input('class_id');
        $selectedSection = $request->input('section_id');
        $sec = Section::find($request->input('section_id'));
        $selectedExam = Exam::find($request->input('exam_id'));
        $selectedSubject = Subject::find($request->input('subject_id'));

        $students = Student::with(['classes', 'section'])
            ->when($selectedClass, function ($query) use ($selectedClass) {
                return $query->where('class_id', $selectedClass);
            })
            ->when($selectedSection, function ($query) use ($selectedSection) {
                return $query->where('section_id', $selectedSection);
            })
            ->get();

        $exams = DB::table('exams')->get();
        $marks = Mark::with(['student', 'exam', 'section'])
            ->whereIn('student_id', $students->pluck('id'))
            ->get();

        $classes = DB::table('classses')->get();
        $sections = DB::table('sections')->get();
        $subjects = DB::table('subjects')->get();
        $grades = Grade::all();
        return view('Admin.mark.create', compact('students', 'selectedClass', 'selectedSection', 'classes', 'sections', 'subjects', 'exams', 'selectedExam', 'selectedSubject', 'sec','grades'));
    }

    public function storeMarks(Request $request)
    {
        $selectedExam = Exam::find($request->input('exam_id'));
        $selectedSubject = Subject::find($request->input('subject_id'));

        $grades = Grade::all();

        foreach ($request->input('obtained_marks') as $studentId => $obtainedMarks) {
            $practicalMarks = $request->input("practical_marks.{$studentId}") ?? 0;
            $totalMarks = $obtainedMarks + $practicalMarks;

            $grade = $grades->first(function ($g) use ($totalMarks) {
                return $totalMarks >= $g->min_marks && $totalMarks <= $g->max_marks;
            });

            $student = Student::find($studentId);

            // Update the grade in the marks table
            $mark = new Mark();
            $mark->exam_id = $selectedExam->id;
            $mark->student_id = $studentId;
            $mark->subject_id = $selectedSubject->id;
            $mark->obtained_marks = $obtainedMarks;
            $mark->practical_marks = $practicalMarks;
            $mark->total_marks = $totalMarks;
            $mark->grade = $grade ? $grade->grade : 'N/A';
            $mark->save();
        }

        return redirect()->route('admin.mark.index')->with('success', 'Marks saved successfully!');
    }
}
