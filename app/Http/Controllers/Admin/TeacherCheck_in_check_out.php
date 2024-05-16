<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckInOut;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeacherCheck_in_check_out extends Controller
{
    public function store(Request $request)
    {
         // $request->validate([
        //     'action' => 'required|string|in:check-in,check-out',
        // ]);
        $message = '';
         $now = Carbon::now();

        $s = new CheckInOut();
        $s->user_id = $request->user_id;
        $s->action = $request->action;
        $s->timestamps = $now;
        $s->created_at = $now;
        $s->updated_at = $now;
        // dd($s);
        $s->save();


        if ($request->action === 'check-in') {
            $message = 'Check-in   successfully!';
            session(['last_action' => 'check-in']);
        } elseif ($request->action === 'check-out') {
            $message = 'Check-out   successfully!';
            session(['last_action' => 'check-out']);
        }
    
        return redirect()->back()->with('status', $message);
    }
}
