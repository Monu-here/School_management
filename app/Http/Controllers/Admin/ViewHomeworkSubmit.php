<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\ViewHomeworkFromTeacher;
use Illuminate\Http\Request;
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

    public function viewHomework()
    {
        $addHomeworks = ViewHomeworkFromTeacher::with('teacher')->get();
        return view('Admin.HomeWork.Addformteacher.index', compact('addHomeworks'));
    }
    public function addHomework(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $addHomework = new ViewHomeworkFromTeacher();
            $addHomework->title = $request->title;
            $addHomework->content = $request->content;
            $addHomework->teacher_id = $request->teacher_id;
            $addHomework->student = $request->student;
            $addHomework->save();
            // dd($addHomework);
            return redirect()->back()->with('message', 'Add Homework Submit Successfully');
        } else {
            $techers = DB::table('teachers')->get();
            $students = DB::table('students')->get();
            return view('Admin.HomeWork.Addformteacher.addhome', compact('techers', 'students'));
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
