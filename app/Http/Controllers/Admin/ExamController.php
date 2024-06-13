<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Exam;
use App\Models\Faculity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function index()
    {
        $exams = DB::table('exams')->get();
        return view('Admin.Exam.index', compact('exams'));
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $exam = new Exam();
            $exam->name = $request->name;
            $exam->semester_id = $request->semester_id;
            $exam->faculity_id = $request->faculity_id;
            $exam->term = $request->term;
            $exam->year = $request->year;
            $exam->save();
            return redirect()->back()->with('message', 'Exam added successfully');
        } else {
            $faculitys = Faculity::all();
            $classes = Classs::all();

            return view('Admin.Exam.add', compact('faculitys', 'classes'));
        }
    }
}
