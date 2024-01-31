<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home() {
         $sliders = DB::table('sliders')->get();
         $services = DB::table('services')->get();
        return view('Front.home',compact('sliders','services'));
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
