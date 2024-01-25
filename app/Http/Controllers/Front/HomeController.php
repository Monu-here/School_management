<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $name = 'this is new website designed ';
        return view('Front.home',compact('name'));
    }
    public function about() {
        return view('Front.about');
    }
    public function course() {
        return view('Front.course');
    }
    public function team() {
        return view('Front.team');
    }
    public function testo() {
        return view('Front.testo');
    }
    public function contact() {
        return view('Front.contact');
    }

}
