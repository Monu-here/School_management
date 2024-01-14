<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    public function index()
    {
        $grades = DB::table('grades')->get();
        return view('Admin.Grade.index',compact('grades'));
    }
}
