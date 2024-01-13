<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $students = DB::table('students')->get();
        $users = DB::table('users')->get();
        $deps = DB::table('departments')->get();
        $cls = DB::table('classses')->get();
        return view('welcome', compact('students', 'users', 'deps','cls'));
    }
}
