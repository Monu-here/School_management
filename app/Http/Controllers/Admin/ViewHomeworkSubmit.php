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
        // Using Eloquent to get the homework with all relationships
        $addHomeworks = ViewHomeworkFromTeacher::with('teacher', 'classs', 'section', 'student')->get();

        $user = Auth::user();
        $student = $user->student;
        $assignedClassIds = explode(',', $student->class_id);
        $assignedSectionIds = explode(',', $student->section_id);
        $assignedClassIds = array_map('intval', $assignedClassIds);
        $assignedSectionIds = array_map('intval', $assignedSectionIds);

        // Using Eloquent to get filtered homework
        $view_homework_from_teachers = ViewHomeworkFromTeacher::with('teacher', 'classs', 'section')
            ->whereIn('class_id', $assignedClassIds)
            ->whereIn('section_id', $assignedSectionIds)
            ->get();

        return view('Admin.HomeWork.Addformteacher.index', compact('addHomeworks', 'view_homework_from_teachers'));
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
            $addHomework->faculity_id = $request->faculity_id;
            $addHomework->save();
    
            return redirect()->back()->with('message', 'Homework submitted successfully');
        } else {
            $user = Auth::user();
            $teacher = $user->teacher;
    
            if (!$teacher) {
                return redirect()->back()->with('error', 'Unauthorized access');
            }
    
            $students = DB::table('students')->get();
            $classes = Classs::all();
            $sections = DB::table('sections')->get();
    
             $views = ViewHomeworkFromTeacher::with('classs', 'section')
                ->where('teacher_id', $teacher->name)
                ->get();
    
            $assignedFaculityIds = explode(',', $teacher->faculity_id);
            $assignedClassIds = explode(',', $teacher->class_id);
            $assignedSectionIds = explode(',', $teacher->section_id);
            $assignedClassIds = array_map('intval', $assignedClassIds);
            $assignedSectionIds = array_map('intval', $assignedSectionIds);
            $assignedFaculityIds = array_map('intval', $assignedFaculityIds);
    
            return view('Admin.HomeWork.Addformteacher.addhome', compact(
                'students', 'classes', 'sections', 'views', 'assignedSectionIds', 'assignedClassIds', 'assignedFaculityIds'
            ));
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
