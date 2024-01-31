<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
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
        $event = Event::all();
        return view('welcome', compact('students', 'users', 'deps', 'cls', 'events','event'));
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
    public function eventDel($event)
    {
        DB::table('events')->where('id', $event)->delete();
        return redirect()->back();
    }
}
