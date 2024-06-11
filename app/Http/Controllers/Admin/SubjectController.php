<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Faculity;
use App\Models\subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $faculitys = DB::table('faculities')->select('id', 'name')->get();
        $classes = DB::table('classses')->select('id', 'name')->get();

        $subjects = null;
        $selecterdFaculity = null;
        $selectedSemester = null;
        if ($request->getMethod() == "POST") {
            $faculity_id = $request->faculity_id;
            $semester_id = $request->semester_id;
            $selecterdFaculity = Faculity::where('id', $faculity_id)->first();
            $selectedSemester = Classs::where('id', $semester_id)->first();
            $subjects = Subject::with('faculity')
                ->where('faculity_id', $faculity_id)
                ->where('semester_id', $semester_id)
                ->select('id', 'name', 'sub_desc', 'sub_code', 'credit', 'level', 'pre_requsisites')
                ->orderBy('sub_desc')
                ->get();

            if ($subjects->isEmpty()) {
                return redirect()->back()->with('error', 'No Record Found');
            }
        }

        return view('Admin.Subject.index', compact('faculitys', 'subjects', 'selecterdFaculity', 'classes','selectedSemester'));
    }

    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->validate([
                'faculity_id' => 'required|exists:faculities,id',
                'semester_id' => 'required|exists:classses,id',
                'sub_desc' => 'required|string',
                'name' => 'required|array',
                'name.*' => 'string',
                'sub_code' => 'nullable|array',
                'sub_code.*' => 'string|nullable',
                'credit' => 'nullable|array',
                'credit.*' => 'string|nullable',
                'level' => 'nullable|array',
                'level.*' => 'string|nullable',
                'pre_requsisites' => 'nullable|array',
                'pre_requsisites.*' => 'string|nullable',
            ]);

            foreach ($data['name'] as $index => $name) {
                $subject = new Subject();
                $subject->name =  $name;
                $subject->faculity_id = $request->faculity_id;
                $subject->semester_id = $request->semester_id;
                $subject->sub_desc = $request->sub_desc;
                $subject->sub_code = $data['sub_code'][$index] ?? null;
                $subject->credit = $data['credit'][$index] ?? null;
                $subject->level = $data['level'][$index] ?? null;
                $subject->pre_requsisites = $data['pre_requsisites'][$index] ?? null;
                // dd($subject);
                $subject->save();
            }

            return redirect()->back()->with('message', 'Successfully created subject');
        }
    }
    public function subjectShow($sub)
    {
        $subject = subject::with('faculity')->where('id', $sub)->first();


        return view('Admin.Subject.show', compact('subject'));
    }
}
