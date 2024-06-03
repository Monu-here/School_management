<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommunicationController extends Controller
{
    public function index()
    {
        $notices = Notice::with('user')->get();
        return view('Admin.Notice.list', compact('notices'));
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $notice = new Notice();
            $notice->notice_title = $request->notice_title;
            $notice->notice_message = $request->notice_message;
            $notice->notice_date = $request->notice_date;
            $notice->publish_on = $request->publish_on;
            $notice->save();
            return redirect()->route('admin.notice.index')->with('message', 'Notice added sucessfully');
        } else {
            $users = DB::table('users')->get();
            return view('Admin.Notice.add', compact('users'));
        }
    }
    public function edit(Request $request, Notice $notice)
    {
        if ($request->getMethod() == "POST") {
            $notice->notice_title = $request->notice_title;
            $notice->notice_message = $request->notice_message;
            $notice->notice_date = $request->notice_date;
            $notice->publish_on = $request->publish_on;
            $notice->save();
            return redirect()->route('admin.notice.index')->with('message', 'Notice update sucessfully');
        } else {
            $users = DB::table('users')->get();
            return view('Admin.Notice.edit', compact('users', 'notice'));
        }
    }
    public function del($notice)
    {
        DB::table('notices')->where('id', $notice)->delete();
        return redirect()->back()->with('message', 'Data Delete successfully');
    }
}
