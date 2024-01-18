<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        $grades = DB::table('grades')->get();
        return view('Admin.Grade.index', compact('grades'));
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $grade = new Grade();
            $grade->name = $request->name;
            $grade->mark_from = $request->mark_from;
            $grade->mark_to = $request->mark_to;
            $grade->remark = $request->remark;
            $grade->save();
            return redirect()->back()->with('message', 'Data Add successfully');
        } else {
            return view('Admin.Grade.add');
        }
    }
}
