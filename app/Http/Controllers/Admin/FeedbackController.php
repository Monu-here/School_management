<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        if ($request->getMethod() == "POST") {
        
            $feedback = new Feedback();
            $feedback->techer_id = $request->techer_id;
            $feedback->name = $request->name;
            $feedback->desc = $request->desc;
            // dd($feedback);
            $feedback->save();
            return redirect()->back()->with('success', 'Feedback submitted successfully.');
        } else {
            $teachers = DB::table('teachers')->get();
            $feedbacks = Feedback::with('teacher')->get(); 
            return view('Admin.feedback.add', compact('teachers','feedbacks'));
        }
    }
}
