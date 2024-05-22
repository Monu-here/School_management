<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Classs;
use App\Models\ViewHomeworkFromTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewHomeworkSubmit extends Controller
{
    // submit homework to teacher
    public function index()
    {
        $homeworks = Homework::with('teacher')->get();
        // dd($homeworks);
        return view('Admin.HomeWork.index', compact('homeworks'));
    }
    public function submit(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $homework = new Homework();

            $homework->title = $request->title;
            $homework->content = $request->content;
            $homework->teacher_id = $request->teacher_id;
            $homework->user_id = $request->user_id;
            $homework->save();
            // dd($homework);
            return redirect()->back()->with('message', 'Homework Submit Successfully');
        } else {
            $techers = DB::table('teachers')->get();

            return view('Admin.HomeWork.submitHomework', compact('techers'));
        }
    }
    // submit homework to teacher

    public function nn($id)
    {
        // $addHomeworks = ViewHomeworkFromTeacher::with('teacher')->get();
        $addHomework = ViewHomeworkFromTeacher::with('teacher')->find($id);
        $techers = DB::table('teachers')->get();

        return view('Admin.HomeWork.submitHomework', compact('addHomework', 'techers'));
    }

    public function viewHomework()
    {
        $addHomeworks = ViewHomeworkFromTeacher::with('teacher', 'classs')->get();
        // $submittedHomeworks = DB::table('view_homework_from_teachers')
        //     ->where('status', 'submitted')
        //     ->get();

        // // Count the number of submitted records
        // $submittedCount = $submittedHomeworks->count();

        // // Display specific student details if needed
        // $submittedStudents = $submittedHomeworks->pluck('student_id');

        // dd([
        //     'submittedCount' => $submittedCount,
        //     'submittedStudents' => $submittedStudents
        // ]);

        
        $user = Auth::user();
        $student = $user->student;
        $assignedClassIds = explode(',', $student->class_id);
        $assignedSectionIds = explode(',', $student->section_id);
        $assignedClassIds = array_map('intval', $assignedClassIds);
        $assignedSectionIds = array_map('intval', $assignedSectionIds);
        $view_homework_from_teachers = DB::table('view_homework_from_teachers')
        ->whereIn('class_id', $assignedClassIds)
        ->whereIn('section_id', $assignedSectionIds)
        ->get();
        
        // dd($student,$assignedClassIds,$assignedSectionIds,$view_homework_from_teachers);
        return view('Admin.HomeWork.Addformteacher.index', compact('addHomeworks','view_homework_from_teachers'));
    }

    public function updateStatus(Request $request, $homeworkId)
    {
        $addHomework = ViewHomeworkFromTeacher::findOrFail($homeworkId);
        $addHomework->status = $request->input('status');
        $addHomework->student_id = $request->student_id;

        $addHomework->save();

        return redirect()->back()
            ->with('success', 'Homework status updated successfully.');
    }
    public function addHomework(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $addHomework = new ViewHomeworkFromTeacher();
            $addHomework->title = $request->title;
            $addHomework->content = $request->content;
            $addHomework->teacher_id = $request->teacher_id;
            $addHomework->class_id = $request->class_id;
            $addHomework->section_id = $request->section_id;
            // $addHomework->student = $request->student;
            $addHomework->save();
            // dd($addHomework);
            return redirect()->back()->with('message', 'Add Homework Submit Successfully');
        } else {
            $students = DB::table('students')->get();
            $classes = Classs::get();
            // dd($classes);
            $sections = DB::table('sections')->get();
            $views = ViewHomeworkFromTeacher::with('classs', 'section')->get();
            // dd($views);
            
            $user = Auth::user();
            $teacher = $user->teacher;
            $assignedClassIds = explode(',', $teacher->class_id);
            $assignedSectionIds = explode(',', $teacher->section_id);
            $assignedClassIds = array_map('intval', $assignedClassIds);
            $assignedSectionIds = array_map('intval', $assignedSectionIds);
            // dd('assignedClassIds:', $assignedClassIds, 'assignedSectionIds', $assignedSectionIds, 'students',);
            return view('Admin.HomeWork.Addformteacher.addhome', compact('students', 'classes', 'sections', 'views','assignedSectionIds','assignedClassIds'));
        }
    }
    public function show($viewId)
    {
        $homework = Homework::with('teacher', 'user')->find($viewId);
        // dd($homework);
        if (!$homework) {
            abort(404, 'View not found');
        }
        return view('Admin.HomeWork.show', compact('homework'));
    }
}
