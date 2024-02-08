<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherDashbaordController extends Controller
{
    public function index()
    {
        // $students = Student::get()->toArray();
        $students = DB::table('students')->get();
        $users = DB::table('users')->get();
        $deps = DB::table('departments')->get();
        $cls = DB::table('classses')->get();
        $events = DB::table('events')->get();
        $event = Event::all();
        return view('TeacherDashbaord.Teacher.index', compact('students', 'users', 'deps', 'cls', 'events','event'));
    }
    public function createEvent(Request $request)
    {

        Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('admin.index')->with('success', 'Event created successfully');
    }
}
