<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classs;
use App\Models\Payment;
use App\Models\Payment_record;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $student_id = $request->input('se$student_id');
        $class_id = $request->input('class_id');
        $section_id = $request->input('section_id');

        $payment_records = Payment_record::query();

        if ($student_id) {
            $payment_records->where('student_id', 'like', '%' . $student_id . '%');
            $selectedName = $student_id;
        } else {
            $selectedName = null;
        }

        if ($class_id) {
            $payment_records->where('class_id', $class_id);
            $selectedClass = $class_id;
        } else {
            $selectedClass = null;
        }
        if ($section_id) {
            $payment_records->where('section_id', $section_id);
            $selectedSection = $section_id;
        } else {
            $selectedSection = null;
        }

        $payment_records = $payment_records->get();
        $students = Student::all();
        $classes = Classs::all(); // Assuming you have a Class model
        $sections = Section::all();

        return view('Admin.payment.paid_payment_list', compact('payment_records', 'students', 'classes', 'sections', 'selectedSection', 'selectedClass', 'selectedName'));
    }

    public function add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            // Generate a unique reference number
            $ref_no = $this->generateUniqueRefNo();

            $payment = new Payment();
            $payment->title = $request->title;
            $payment->amount = $request->amount;
            $payment->ref_no = $ref_no;
            $payment->class_id = $request->class_id;
            $payment->description = $request->description;
            $payment->year = $request->year;
            $payment->save();
            return redirect()->back();
        } else {
            $classes = DB::table('classses')->get();
            $payments = DB::table('payments')->get();
            // $payments = Payment::all()->toArray();
            return view('Admin.payment.addPayment', compact('classes', 'payments'));
        }
    }

    // Function to generate a unique reference number
    // private function generateUniqueRefNo()
    // {
    //     // You can customize this format based on your requirements
    //     $prefix = 'PAY'; // You can change this prefix
    //     $randomComponent = mt_rand(10000, 99999); // Generate a random 5-digit number
    //     $timestamp = now()->format('YmdHis'); // Current date/time in YmdHis format

    //     return $prefix . $timestamp . $randomComponent;
    // }
    private function generateUniqueRefNo()
    {
        // You can customize this format based on your requirements
        $prefix = 'PAY'; // You can change this prefix
        $year = now()->format('Y'); // Get the current year
        $randomComponent = mt_rand(100, 999); // Generate a random 3-digit number

        return $year . '/' . $randomComponent;
    }

    public function studentPaymentList(Request $request)
    {
        $class_id = $request->input('class_$class_id');
        $section_id = $request->input('section_id');
        $name = $request->input('name');
        $idno = $request->input('idno');

        $studentsQuery = Student::query();


        if ($class_id) {
            $studentsQuery->where('class_id', $class_id);
            $selectedClass = $class_id;
        } else {
            $selectedClass = null;
        }
        if ($section_id) {
            $studentsQuery->where('section_id', $section_id);
            $selectedSection = $section_id;
        } else {
            $selectedSection = null;
        }

        if ($name) {
            $studentsQuery->where('name', 'like', '%' . $name . '%');
            $selectedName = $name;
        } else {
            $selectedName = null;
        }


        if ($idno) {
            $studentsQuery->where('idno', 'like', '%' . $idno . '%');
            $selectedIdno = $idno;
        } else {
            $selectedIdno = null;
        }
        $students = $studentsQuery->get();
        $classes = DB::table('classses')->get();
        $payment_records = Payment_record::all();
        $sections = Section::all();
        return view('Admin.payment.studentpayment', compact('classes', 'selectedIdno', 'selectedName', 'students', 'selectedClass', 'payment_records', 'sections', 'selectedSection'));
    }




    public function studentPaymentAdd(Request $request, $student_id)
    {
        $student = Student::find($student_id);
        if ($request->getMethod() == 'POST') {

            $class_id = $student->class_id; // Fetch class_id from the student model
            $section_id = $student->section_id; // Fetch section_id from the student model


            // Retrieve the total amount already paid by the student
            $totalAmountPaid = Payment_record::where('student_id', $student_id)->sum('amt_paid');

            // Retrieve the class-specific payments
            $payments = DB::table('payments')
                ->where('class_id', $class_id)
                ->get();

            // Calculate the new balance
            $totalOwed = $payments->sum('amount');
            $balance = $totalOwed - $totalAmountPaid - (int)$request->input('amt_paid');
            // dd($balance);


            // Use the existing reference number or generate a new one
            $refNo = $this->generateUniqueRefNo();

            // Create a new payment record
            Payment_record::create([
                'student_id' => $student_id,
                'class_id' =>$class_id,
                'section_id' => $section_id,
                'ref_no' => $refNo,
                'amt_paid' => (int)$request->input('amt_paid'),
                'year' => $request->input('year'),
                'status' => $request->status,
                'title' => 'monu',
                'balance' => $balance,
                'payment_id' => 1,
                'paid' => 1,
            ]);
            // }



            return redirect()->back()->with('message', 'Payment Recorded Successfully');
        } else {
            $payment_records = Payment_record::with('student')
                ->where('student_id', $student_id)
                ->get();

            $student = Student::find($student_id);
            $students = DB::table('students')->get();

            // Get the class_id from the student
            $class_id = $student->class_id;
            $section_id = $student->section_id; // Fetch section_id from the student model
            // Retrieve class-specific payments
            $payments = DB::table('payments')
                ->where('class_id', $class_id)
                ->get();

            // Calculate the total amount for the class
            $totalOwed = $payments->sum('amount');

            // Retrieve total amount paid by the student
            $totalAmountPaid = Payment_record::where('student_id', $student_id)->sum('amt_paid');
            // $classses = DB::table('classses')->get();
            // $section = DB::table('sections')->get();
            //   $payment_recordsww = Payment_record::with('student')->get();
            //   dd($payment_recordsww);

            return view('Admin.payment.studentPaymentAdd', compact('students','section_id', 'student', 'payment_records', 'payments', 'class_id', 'totalAmountPaid', 'totalOwed'))
                ->with('success', 'Payment recorded successfully.');
        }
    }


    // Function to generate a unique reference number

    // private function generateUniqueRefNo()
    // {
    //     return 'REF_' . time() . '_' . rand();
    // }








    public function printBill($student_id)
    {
        $student = Student::find($student_id);
        $payment_records = Payment_record::where('student_id', $student_id)->get();

        return view('Admin.payment.billprint', compact('student', 'payment_records'));
    }
}
