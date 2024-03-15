<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendence;
use App\Models\Classs;
use App\Models\Section;
use Carbon\Carbon;

use App\Models\Student;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendenceController extends Controller
{
    public function monu() {
        return response()->json(Attendence::all());
    }
    public function index(Request $request)
    {
        $cc = Classs::all();
        $ss = Student::all();
        $se = Section::all();
        $sections = DB::table('sections')->get();
        $attendanceDate = now();
        $students = null;
        if ($request->getMethod() == "POST") {
            if ($request->filled('class_id') && $request->filled('section_id')) {
                $fromClass = $request->input('class_id');
                $fromSection = $request->input('section_id');

                // Query students based on the selected class and section
                $students = Student::whereHas('classes', function ($query) use ($fromClass, $fromSection) {
                    $query->where('class_id', $fromClass)->where('section_id', $fromSection);
                })->get();
            } else {
                // If the form is not submitted, retrieve all students
                $students = Student::all();
            }
        }
        return view('Admin.Attendence.index', compact('cc', 'ss', 'students', 'se', 'sections', 'attendanceDate'));
    }

    public function mark(Request $request)
    {
        if ($request->getMethod() == 'POST') {
                // dd($request->all());
            $attendanceDate = now()->toDateString(); // Get the current date

            // Iterate over submitted form data for each student
            foreach ($request->input('student_ids') as $studentId) {
                // Retrieve attendance data for the current student
                $attendanceType = $request->input('attendance_types')[$studentId];
                $notes = $request->input('notes')[$studentId];

                // Check if attendance already exists for the student on the current date
                $existingAttendance = Attendence::where('student_id', $studentId)
                    ->whereDate('attendance_date', $attendanceDate)
                    ->first();

                if ($existingAttendance) {
                    return redirect()->back()->with('error', 'Attendance for this student on this date has already been marked.');
                }

                // Check if attendance exists for the student on the previous day
                $previousDate = now()->subDay()->toDateString(); // Get the previous day's date
                $previousAttendance = Attendence::where('student_id', $studentId)
                    ->whereDate('attendance_date', $previousDate)
                    ->first();
                // dd($previousDate);
                // If attendance exists for the previous day, delete it
                // if ($previousAttendance) {
                //     $previousAttendance->delete();
                // }

                // Save attendance for the current student
                $attendance = new Attendence();
                $attendance->student_id = $studentId;
                $attendance->attendance_type = $attendanceType;
                $attendance->notes = $notes;
                $attendance->attendance_date = $attendanceDate;
                $attendance->save();
            }

            return redirect()->back()->with('success', 'Attendance marked successfully');
        } else {
            // If it's not a POST request, retrieve student data and load the view
            $students = Student::all();
            return view('Admin.Attendence.add', compact('students'));
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
        // Get the selected class, section, month, and year from the form submission
        $classId = $request->input('class_id');
        $sectionId = $request->input('section_id');
        $selectedMonth = $request->input('month');
        $selectedYear = $request->input('year');

        // Fetch attendance records for students belonging to the selected class and section
        $attendanceReport = Attendence::with('student')
            ->whereHas('student', function ($query) use ($classId, $sectionId) {
                $query->where('class_id', $classId)
                    ->where('section_id', $sectionId);
            })
            ->whereYear('attendance_date', $selectedYear)
            ->whereMonth('attendance_date', $selectedMonth)
            ->get();
            // if ($attendanceReport->isEmpty()) {
            //     return redirect()->back()->with('error', 'No Data found for selected Month or Year! Please try again.');
            // }

            // stroing attendenc of each student in array
            $attendanceData = [];

            // Initialize attendance data for each student for days from 1 to 30
            foreach ($attendanceReport as $record) {
            $studentId = $record->student->id;

            // Ensure $attendanceData[$studentId] is initialized
            if (!isset($attendanceData[$studentId])) {
                $attendanceData[$studentId] = array_fill(1, 30, null); // Initialize for 30 days
            }

            // Get the day of the month for the current record
            $dayOfMonth = (int) Carbon::parse($record->attendance_date)->format('d');

            // Get the attendance type for the current record
            $attendanceType = $record->attendance_type;

            // Store the attendance type in the array
            $attendanceData[$studentId][$dayOfMonth] = $attendanceType;
        }

        // Fetch classes and sections for the form
        $classes = Classs::all();
        $sections = Section::all();

        // Pass attendance data, classes, sections, and attendance report to the view
        return view('Admin.Attendence.report', compact('attendanceData', 'classes', 'sections', 'attendanceReport', 'selectedMonth', 'selectedYear'));
    }
}
