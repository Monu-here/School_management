<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubjectToTeacher;
use App\Models\subject;
use App\Models\Teacher;
use App\Models\TeacherDailyLog;
use App\Models\TimeTable;
use Illuminate\Http\Request;
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
            $dailys = TeacherDailyLog::all();
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
        // dd($users);
        $subjects = DB::table('subjects')->get();
        $assigns = AssignSubjectToTeacher::with('user','subject')->get(); 
        // dd($assigns);
        return view('Assign_Subject.index', compact('users', 'subjects','assigns'));
    }
    public function assign_subject_add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $assign_subject = new AssignSubjectToTeacher();
            $assign_subject->user_id = $request->user_id;
            $assign_subject->subject = $request->subject;
             $assign_subject->save();
            return redirect()->back()->with('message', 'Subject assign successfully to techer');
        }
    }
}
