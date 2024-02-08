<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $deps = Department::all();
        return view('TeacherDashbaord.Dep.index', compact('deps'));
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            // DD($request->all());
            $Department = new Department();
            $Department->name = $request->name;
            $Department->hod = $request->hod;
            $Department->date = $request->date;
            $Department->nofst = $request->nofst;
            $Department->save();
            return redirect()->back()->with('message', 'Department Add Sucessfully');
        } else {
            return view('TeacherDashbaord.Dep.add');
        }
    }
}
