<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherDailyLog;
use App\Models\TimeTable;
use Illuminate\Http\Request;

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
}
