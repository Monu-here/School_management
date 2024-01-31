<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherDashbaordController extends Controller
{
    public function index()
    {
        return view('TeacherDashbaord.Teacher.index');
    }
}
