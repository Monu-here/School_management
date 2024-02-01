<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontDetailController extends Controller
{
    public function index(Request $request)
    {
        $services = DB::table('services')->get();
        $sliders = DB::table('sliders')->get();
        $abouts = DB::table('about_us')->get();

        return view('Admin.FrontDetail.index', compact('sliders', 'services','abouts'));
    }
    public function sliderEdit(Request $request,  Slider $slider)
    {
        if ($request->getMethod() == "POST") {
            $slider->short_desc = $request->short_desc;
            $slider->long_desc = $request->long_desc;
            if ($request->hasFile('image')) {
                $slider->image = $request->image->store('uploads/Front/Slider');
            }
            $slider->save();
            return redirect()->route('admin.frontdetail.index')->with('message', 'Slider edit scussefully');
        } else {
            $services = DB::table('services')->get();
            $sliders = DB::table('sliders')->get();
            $abouts = DB::table('about_us')->get();
            return view('Admin.FrontDetail.index', compact('sliders', 'services','abouts'));
        }
    }
    public function slider(Request $request)
    {
        if ($request->getMethod() == "POST") {
            $slider = new Slider();
            $slider->short_desc = $request->short_desc;
            $slider->long_desc = $request->long_desc;
            $slider->image = $request->image->store('uploads/Front/Slider');
            $slider->save();
            return redirect()->back()->with('message', 'Slider add scussefully');
        } else {
            return view('Admin.FrontDetail.Slider.add');
        }
    }
    public function sliderDel($slider)
    {
        DB::table('sliders')->where('id', $slider)->delete();
        return redirect()->back();
    }
    public function service()
    {
        $services = DB::table('services')->get();
        $sliders = DB::table('sliders')->get();
        $abouts = DB::table('about_us')->get();

        return view('Admin.FrontDetail.index', compact('services', 'sliders','abouts'));
    }
    public function serviceAdd(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $service = new Service();
            $service->name = $request->name;
            $service->short_desc = $request->short_desc;
            $service->image = $request->image->store('uploads/Front/service');
            $service->save();
            return redirect()->route('admin.frontdetail.index');
        } else {
            return view('Admin.FrontDetail.Slider.add');
        }
    }
    public function serviceDel($service)
    {
        DB::table('services')->where('id', $service)->delete();
        return redirect()->back();
    }
    public function aboutUs()
    {
        $services = DB::table('services')->get();
        $sliders = DB::table('sliders')->get();
        $abouts = DB::table('about_us')->get();
        return view('Admin.FrontDetail.index', compact('services', 'sliders','abouts'));
    }
    public function aboutUsAdd(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $about = new AboutUs();
            $about->name = $request->name;
            $about->short_desc = $request->short_desc;
            $about->image = $request->image->store('uploads/Front/about');
            $about->save();
            return redirect()->route('admin.frontdetail.index');
        } else {
            return view('Admin.FrontDetail.Slider.add');
        }
    }
}
