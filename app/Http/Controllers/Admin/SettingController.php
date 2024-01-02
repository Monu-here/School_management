<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function add(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            // dd($request->all());
            $setting = Setting::first();
            if ($setting == null) {
                // dd($setting);
                $setting = new Setting();
            }
            if ($request->hasFile('websiteimage')) {
                $setting->websiteimage = $request->websiteimage->store('uploads/setting');
            }
            if ($request->hasFile('favicon')) {
                $setting->favicon = $request->favicon->store('uploads/setting');
            }
            $setting->webistename = $request->webistename;
            $setting->titletext = $request->titletext;
            $setting->save();
            return redirect()->back()->with('message','Data Add Successfully');
        } else {
            $setting = Setting::first();
            return view('Admin.setting.setting', compact('setting'));
        }
    }
}
