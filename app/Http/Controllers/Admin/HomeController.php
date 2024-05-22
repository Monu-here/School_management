<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $students = DB::table('students')->get();
        $users = DB::table('users')->get();
        $deps = DB::table('departments')->get();
        $cls = DB::table('classses')->get();
        $events = DB::table('events')->get();
        // $assigns = DB::table('assign_subject_to_teachers')->get();
        $event = Event::all();
        $notices = Notice::all();
        // student listing on there dashboard there detail listing
        $user = Auth::user();
        $student = $user->student;
        // techer listing detail and assign class srtdent listing
        $teacher = Auth::user()->teacher;
        // $students = $teacher->students;














        return view('welcome', compact('students', 'users', 'deps', 'cls', 'events', 'event', 'notices', 'student', 'teacher', 'students'));
    }
    // public function index()
    // {
    //     $students = DB::table('students')->get();
    //     $users = DB::table('users')->get();
    //     $deps = DB::table('departments')->get();
    //     $cls = DB::table('classses')->get();
    //     $events = DB::table('events')->get();
    //     $event = Event::all();
    //     $notices = Notice::all();

    //     return view('AdminNew.dashboard', compact('students', 'users', 'deps', 'cls', 'events', 'event', 'notices'));
    // }

    public function viewNotice($id)
    {
        $notice = Notice::findOrFail($id);

        return view('Admin.Notice.show', compact('notice'));
    }




    public function createEvent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        // Check if an event with the same title, start date, and end date already exists
        $existingEvent = Event::where('start', $request->start)
            ->where('end', $request->end)
            ->first();

        if ($existingEvent) {
            // Redirect back with an error message
            return redirect()->route('admin.index')->with('error', 'An event with the same title and dates already exists. Please delete the existing event first.');
        }

        Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return redirect()->route('admin.index')->with('success', 'Event created successfully');
    }
    public function eventDel($event)
    {
        DB::table('events')->where('id', $event)->delete();
        return redirect()->back()->with('message', 'Event delete sucessfully');
    }


    public function monu()
    {
        return view('Front.404');
    }
}
