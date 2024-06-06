<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MyEmail;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Mark;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;

class MarkController extends Controller
{

    // this function list all that marksheet of student that are here START
    public function index()
    {
        $marks = Mark::with('Student', 'subject', 'Exam', 'Grade')->get();

        return view('Admin.mark.index', compact('marks'));
    }
    // this function list all that marksheet of student that are here END

    // i have use this function to show then fomr to enter mark of that student in that subject START
    public function add(Request $request)
    {
        $exams = DB::table('exams')->get();
        $classes = DB::table('classses')->get();
        $sections = DB::table('sections')->get();
        $subjects = DB::table('subjects')->get();

        return view('Admin.mark.create', compact('classes', 'sections', 'subjects', 'exams'));
    }
    // i have use this function to show then fomr to enter mark of that student in that subject END


    // it will list the student from class and from section end enter marks START
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
        return view('Admin.mark.create', compact('students', 'selectedClass', 'selectedSection', 'classes', 'sections', 'subjects', 'exams', 'selectedExam', 'selectedSubject', 'sec', 'grades'));
    }
    // it will list the student from class and from section end enter marks END


    // here will be store marks of student START
    public function storeMarks(Request $request)
    {
        $selectedExam = Exam::find($request->input('exam_id'));
        $selectedSubject = Subject::find($request->input('subject_id'));

        $grades = Grade::all();

        foreach ($request->input('obtained_marks') as $studentId => $obtainedMarks) {
            $practicalMarks = $request->input("practical_marks.{$studentId}") ?? 0;
            $totalMarks = $obtainedMarks + $practicalMarks;



            $totalObtained = $obtainedMarks + $practicalMarks;

            $grade = Grade::where("mark_from", "<=", $totalObtained)->where("mark_to", ">=", $totalObtained)->first();


            $student = Student::find($studentId);

            // Update the grade in the marks table
            $mark = new Mark();
            $mark->exam_id = $selectedExam->id;
            $mark->student_id = $studentId;
            $mark->subject_id = $selectedSubject->id;
            $mark->obtained_marks = $obtainedMarks;
            $mark->practical_marks = $practicalMarks;
            $mark->total_marks = $totalMarks;
            $mark->grade = $grade ? $grade->name : 'N/A';
            $mark->remark = $grade ? $grade->remark : 'N/A';
            $mark->save();
        }
        return redirect()->route('admin.mark.index')->with('success', 'Marks saved successfully!');
    }
    // here will be store marks of student END

    ///        It will show the marksheet of student START
    public function marksheet($studentId)
    {
        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->route('admin.mark.index')->with('error', 'Student not found!');
        }

        $marks = Mark::where('student_id', $studentId)
            ->with('Exam', 'Subject', 'grade')
            ->get();
        $grade = $marks->first()->grade ?? null;

        $totalMarks = $marks->sum('total_marks');
        $percentage = round($totalMarks / 500 * 100, 2);
        $grade = Grade::where("mark_from", "<=", $percentage)->where("mark_to", ">=", $percentage)->first();


        $student->finalMrak = $totalMarks;
        $student->grade = $grade ? $grade->name : 'N/A';
        $student->remark = $grade ? $grade->remark : 'N/A'; // Corrected line
        $parentEmail = optional($student)->parent_email;
        // dd($parentEmail);
        // dd($student);


        if ($parentEmail) {
            // Mail::to($parentEmail)->send(new MyEmail($student, $marks, $percentage, $totalMarks));
        } else {

            return redirect()->route('admin.mark.index')->with('error', 'Parent email not available!');
        }


        $grades = DB::table('grades')->get();
        $date = Carbon::now()
            ->format('l, jS \of F Y');

        return view('Admin.mark.mark_sheet', compact('grades', 'date', 'student', 'marks', 'percentage', 'totalMarks'));
    }
    ///        It will show the marksheet of student END



    // here it will send then marksheet to there parent START
    public function sendMarksheetEmail($studentId)
    {
        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found!');
        }

        $marks = Mark::where('student_id', $studentId)
            ->with('Exam', 'Subject', 'grade')
            ->get();
        $grade = $marks->first()->grade ?? null;

        $totalMarks = $marks->sum('total_marks');
        $percentage = round($totalMarks / 500 * 100, 2);
        $grade = Grade::where("mark_from", "<=", $percentage)->where("mark_to", ">=", $percentage)->first();


        $student->finalMrak = $totalMarks;
        $student->grade = $grade ? $grade->name : 'N/A';
        $student->remark = $grade ? $grade->remark : 'N/A';

        // $parentEmail = $student->email;
        $userEmail = $student->user->email;
        // dd($userEmail);
        $date = Carbon::now()
            ->format('l, jS \of F Y');
        Mail::to($userEmail)->send(new MyEmail($student, $marks, $percentage, $totalMarks, $date));

        return redirect()->back()->with('message', 'Marksheet sent to student successfully!');
    }
    // here it will send then marksheet to there parent END






    // this function is form downloadMarksheet for parent to see there student marksheet START
    public function downloadMarksheet($studentId)
    {
        $student = Student::find($studentId);

        if (!$student) {
            return redirect()->route('admin.mark.index')->with('error', 'Student not found!');
        }

        $marks = Mark::where('student_id', $studentId)
            ->with('Exam', 'Subject', 'grade')
            ->get();
        $grade = $marks->first()->grade ?? null;

        $totalMarks = $marks->sum('total_marks');
        $percentage = round($totalMarks / 500 * 100, 2);
        $grade = Grade::where("mark_from", "<=", $percentage)->where("mark_to", ">=", $percentage)->first();


        $student->finalMrak = $totalMarks;
        $student->grade = $grade ? $grade->name : 'N/A';
        $student->remark = $grade ? $grade->remark : 'N/A';
        $date = Carbon::now()->format('l, jS \of F Y');

        $content = view('Admin.mark.download', compact( 'date', 'student', 'marks', 'totalMarks', 'percentage','grade'))->render();
        // changing name of markshet with student name othen marksheet.pdf
        $filename = Str::slug($student->name) . '_marksheet.pdf';

        // Generate PDF on-the-fly and send it as a download response using DOM pdf composer or package
        return response()->stream(
            function () use ($content) {
                $pdf = FacadePdf::loadHtml($content);
                $pdf->setPaper('a4', 'portrait');
                $pdf->save('php://output');
            },
            200,
            // [
            //     'Content-Type'        => 'application/pdf',
            //     'Content-Disposition' => 'attachment; filename= "marksheet.pdf"',
            // ]
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }
    // this function is form downloadMarksheet for parent to see there student marksheet END
}
