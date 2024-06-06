<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubjectToTeacher;
use App\Models\subject;
use App\Models\Teacher;
use App\Models\TeacherDailyLog;
use App\Models\TimeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $daily = new TeacherDailyLog();
            $daily->name = $request->name;
            $daily->date = $request->date;
            $daily->desc = $request->desc;
            // dd($daily);
            $daily->save();
            return redirect()->back();
        } else {
            // $user = Auth::user()->name;
            //  $dailys = TeacherDailyLog::where('name' , $user)->get();
             $dailys = TeacherDailyLog::all();
            // dd($dailys);
            return view('Admin.TeacherDailyLog.index', compact('dailys'));
        }
    }
    public function addtimetable(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $timeTable = new TimeTable();
            $timeTable->sub = $request->sub;
            $timeTable->date = $request->date;
            $timeTable->time = $request->time;
            $timeTable->day = $request->day;
            $timeTable->save();
            return redirect()->back()->with('message', 'Data add successfully');
        } else {
            $timeTables = TimeTable::all();
            return view('Admin.TimeTable.add', compact('timeTables'));
        }
    }
    public function assign_subject(Request $request)
    {
        $users = DB::table('users')->where('role_name', 'Teacher')->get(['id', 'name']);
        $subjects = DB::table('subjects')->get();
        $assigns = AssignSubjectToTeacher::with('user', 'subject')->get();
        return view('Assign_Subject.index', compact('users', 'subjects', 'assigns'));
    }
    public function assign_subject_add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // Retrieve selected subjects from the form

            $assign_subject = new AssignSubjectToTeacher();
            $assign_subject->user_id = $request->user_id;
            $assign_subject->subject = $request->subject; // Assign each subject
            $assign_subject->save();


            return redirect()->back()->with('message', 'Subjects assigned successfully to the teacher');
        }
    }
    public function assign_subject_del($id)
    {
        $assign_subject = AssignSubjectToTeacher::where('id', $id)->find($id);
        if ($assign_subject == null) {
            return redirect()->back()->with('message', 'Subject assign not found');
        }
        $assign_subject->delete();
        return redirect()->back()->with('message', 'Subject deleted successfully');
    }
}
