<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
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
            $exam->term = $request->term;
            $exam->year = $request->year;
            $exam->save();

        }
    }
}
