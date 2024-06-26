<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Classs;
use App\Models\Faculity;
use App\Models\Section;
use Carbon\Carbon;

use App\Models\Student;
use App\Models\subject;
use App\Models\Teacher;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendenceController extends Controller
{
    public function monu()
    {
        return response()->json(Attendence::all());
    }
    public function index(Request $request)
    {
        $cc = Classs::all();
        $ss = Student::all();
        $se = Section::all();
        $facts = Faculity::all();
        $sections = DB::table('sections')->get();
        $subjects = DB::table('subjects')->get();
        $attendanceDate = now();
        $students = null;
        if ($request->getMethod() == "POST") {
            // dd($request->all());
            if ($request->filled('faculity_id') && $request->filled('class_id') && $request->filled('section_id')) {
                $fromFaculity = $request->input('faculity_id');
                $fromClass = $request->input('class_id');
                $fromSection = $request->input('section_id');

                // Query students based on the selected class and section
                $students = Student::whereHas('classes', function ($query) use ($fromFaculity, $fromClass, $fromSection) {
                    $query->where('faculity_id', $fromFaculity)->where('class_id', $fromClass)->where('section_id', $fromSection);
                })->get();
                if ($students->isEmpty()) {
                    return redirect()->back()->with('error', 'No Record  Found');
                }
            } else {
                $students = Student::all();
            }
        }
        return view('Admin.Attendence.index', compact('cc', 'ss', 'students', 'se', 'sections', 'attendanceDate', 'facts', 'subjects'));
    }
    //this si currentlu working
    // public function mark(Request $request)
    // {
    //     if ($request->getMethod() == 'POST') {
    //         // dd($request->all());
    //         $note = "note";
    //         $attendanceDate = now()->toDateString(); // Get the current date

    //         // Iterate over submitted form data for each student
    //         foreach ($request->input('student_ids') as $studentId) {
    //             // Retrieve attendance data for the current student
    //             $attendanceType = $request->input('attendance_types')[$studentId];
    //             $notes = $note;

    //             // Check if attendance already exists for the student on the current date
    //             $existingAttendance = Attendence::where('student_id', $studentId)
    //                 ->whereDate('attendance_date', $attendanceDate)
    //                 ->first();

    //             if ($existingAttendance) {
    //                 return redirect()->back()->with('error', 'Attendance for this student on this date has already been marked.');
    //             }

    //             // Check if attendance exists for the student on the previous day
    //             $previousDate = now()->subDay()->toDateString(); // Get the previous day's date
    //             $previousAttendance = Attendence::where('student_id', $studentId)
    //                 ->whereDate('attendance_date', $previousDate)
    //                 ->first();
    //             // dd($previousDate);
    //             // If attendance exists for the previous day, delete it
    //             // if ($previousAttendance) {
    //             //     $previousAttendance->delete();
    //             // }

    //             // Save attendance for the current student
    //             $attendance = new Attendence();
    //             $attendance->student_id = $studentId;
    //             $attendance->attendance_type = $attendanceType;
    //             $attendance->notes = $notes;
    //             $attendance->attendance_date = $attendanceDate;
    //             $attendance->save();
    //         }

    //         return redirect()->back()->with('success', 'Attendance marked successfully');
    //     } else {
    //         // If it's not a POST request, retrieve student data and load the view
    //         $students = Student::all();
    //         return view('Admin.Attendence.add', compact('students'));
    //     }
    // }

    // thsi sis currentlu worju


    public function mark(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $note = "note";
            $attendanceDate = now()->toDateString();
            foreach ($request->input('student_ids') as $studentId) {
                $attendanceType = $request->input('attendance_types')[$studentId];
                $subjectId = $request->input('subject_id')[$studentId];
                // dd($attendanceType , $subjectId);
                $notes = $note;

                $classIds = is_array($request->class_id) ? $request->class_id : [$request->class_id];
                $faculityIds = is_array($request->faculity_id) ? $request->faculity_id : [$request->faculity_id];
                $sectiondIds = is_array($request->section_id) ? $request->section_id : [$request->section_id];
                $existingAttendance = Attendence::where('student_id', $studentId)
                    ->whereDate('attendance_date', $attendanceDate)
                    ->first();

                $previousAttendanceType = null;

                if ($existingAttendance) {
                    $attendanceTypes = $existingAttendance->attendance_type ?? [];
                    $subjectIds = $existingAttendance->subject_id ?? [];

                    if (is_string($attendanceTypes)) {
                        $attendanceTypes = json_decode($attendanceTypes, true) ?? [];
                    }
                    if (is_string($subjectIds)) {
                        $subjectIds = json_decode($subjectIds, true) ?? [];
                    }
                    $attendanceTypes[] = $attendanceType;
                    $subjectIds[] = $subjectId; // Make sure $subjectId is defined earlier in your code

                    $existingAttendance->update([
                        'attendance_type' => $attendanceTypes,
                        'subject_id' => $subjectIds,
                        'notes' => $notes,
                    ]);
                } else {
                    $attendance = new Attendence();
                    $attendance->student_id = $studentId;
                    $attendance->attendance_type = [$attendanceType];
                    $attendance->subject_id = [$subjectId];
                    $attendance->notes = $notes;
                    $attendance->attendance_date = $attendanceDate;
                    foreach ($classIds as $classId) {
                        $attendance->class_id = $classId;
                    }
                    foreach ($faculityIds as $faculityId) {
                        $attendance->faculity_id = $faculityId;
                    }
                    foreach ($sectiondIds as $sectiondId) {
                        $attendance->section_id = $sectiondId;
                    }
                    $attendance->save();
                    // dd($attendance);
                }
            }
            return redirect()->back()->with('success', 'Attendance marked successfully');
        } else {
            return redirect()->back();
            // $students = Student::all();
            // return view('Admin.Attendence.add', compact('students'));
        }
    }







    // public function report(Request $request)
    // {
    //     // Get the selected class and section IDs from the form submission
    //     $classId = $request->input('class_id');
    //     $sectionId = $request->input('section_id');

    //     // Fetch attendance records for students belonging to the selected class and section
    //     $attendanceReport = Attendence::with('student')
    //         ->whereHas('student', function ($query) use ($classId, $sectionId) {
    //             $query->where('class_id', $classId)
    //                 ->where('section_id', $sectionId);
    //         })
    //         ->get();

    //     // Create an array to store attendance data for each student for each day of the month
    //     $attendanceData = [];

    //     // Loop through each attendance record
    //     foreach ($attendanceReport as $record) {
    //         // Get the student ID
    //         $studentId = $record->student->id;

    //         // Initialize an array for the student if it doesn't exist
    //         if (!isset($attendanceData[$studentId])) {
    //             $attendanceData[$studentId] = [];
    //         }

    //         // Loop through each day of the month
    //         for ($day = 1; $day <= 30; $day++) {
    //             // Get the attendance type for the current day
    //             $attendanceType = $record->whereDate('attendance_date', Carbon::createFromDate(null, null, $day)->toDateString())->first()->attendance_type ?? '';

    //             // Store the attendance type in the array
    //             $attendanceData[$studentId][$day] = $attendanceType;
    //         }
    //     }

    //     // Fetch classes and sections for the form
    //     $classes = Classs::all();
    //     $sections = Section::all();

    //     // Pass attendance data, classes, sections, and attendance report to the view
    //     return view('Admin.Attendence.report', compact('attendanceData', 'classes', 'sections', 'attendanceReport'));
    // }



    public function report(Request $request)
    {
        $faculityId = $request->input('faculity_id');
        $classId = $request->input('class_id');
        $sectionId = $request->input('section_id');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');
        $attendanceReport = Attendence::with('student')
            ->whereHas('student', function ($query) use ($classId, $faculityId, $sectionId) {
                $query->where('class_id', $classId)
                    ->where('faculity_id', $faculityId)
                    ->where('section_id', $sectionId);
            })
            ->whereYear('attendance_date', $selectedYear)
            ->whereMonth('attendance_date', $selectedMonth)
            ->get();

        // dd($attendanceReport);

        $attendanceData = [];

        foreach ($attendanceReport as $record) {
            $studentId = $record->student->id;

            if (!isset($attendanceData[$studentId])) {
                $attendanceData[$studentId] = array_fill(1, 30, null);
            }

            $dayOfMonth = (int) Carbon::parse($record->attendance_date)->format('d');

            $attendanceType = $record->attendance_type;

            $attendanceData[$studentId][$dayOfMonth] = $attendanceType;
        }

        $classes = Classs::all();
        $sections = Section::all();
        $facts = Faculity::all();
        $subjects = subject::all();
        $mm = Attendence::with(['student']) // Ensure 'subject' relation is loaded
            ->select('student_id', 'class_id', 'faculity_id', 'attendance_type', 'subject_id')
            ->whereHas('student', function ($query) use ($classId, $sectionId, $faculityId) {
                $query->where('class_id', $classId)
                    ->where('faculity_id', $faculityId)
                    ->where('section_id', $sectionId);
            })
            ->get()
            ->groupBy('student_id');

        // dd($mm); 



        // echo "Attendance Type: $subjectAttendance

        return view('Admin.Attendence.report', compact('attendanceData', 'mm', 'classes', 'facts', 'sections', 'attendanceReport', 'selectedMonth', 'selectedYear', 'subjects'));
    }
}
