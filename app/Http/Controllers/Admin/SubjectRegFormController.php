<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubjectReg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectRegFormController extends Controller
{
    public function index()
    {
        $subject_regs = DB::table('subject_regs')->get();
        $subjects = DB::table('subjects')->get();
        return view('Admin.Subject_Reg.index', compact('subject_regs','subjects'));
    }
    public function regSub(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $subject_reg = new SubjectReg();
            $subject_reg->user_id = $request->user_id;
            $subject_reg->student_code = $request->student_code;
            $subject_reg->subject = $request->subject;
            $subject_reg->save();
            return redirect()->back()->with('message', 'Subject Add Sucessfully');
        }
    }
}
