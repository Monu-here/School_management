<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Payment_record;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
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
            return view('Admin.payment.addPayment', compact('classes'));
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
        $selectedClassId = $request->input('class_id');

        $students = Student::when($selectedClassId, function ($query) use ($selectedClassId) {
            return $query->where('class_id', $selectedClassId);
        })->get();

        $classes = DB::table('classses')->get();
        $payment_records = Payment_record::all();
        return view('Admin.payment.studentpayment', compact('classes', 'students', 'selectedClassId','payment_records'));
    }



    public function studentPaymentAdd(Request $request, $student_id)
    {
        if ($request->getMethod() == 'POST') {
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'year' => 'required|string|max:4',
                'amt_paid' => 'required|numeric|min:0',
                'title' => 'required',
            ]);

            // Get the class_id from the student
            $class_id = Student::find($student_id)->class_id;

            // Retrieve the total amount already paid by the student
            $totalAmountPaid = Payment_record::where('student_id', $student_id)->sum('amt_paid');

            // Retrieve the class-specific payments
            $payments = DB::table('payments')
                ->where('class_id', $class_id)
                ->get();

            // Calculate the new balance
            $totalOwed = $payments->sum('amount');
            $balance = $totalOwed - $totalAmountPaid - (int)$request->input('amt_paid');

            // Check if a payment record already exists for the student
            $existingPaymentRecord = Payment_record::where('student_id', $student_id)->first();

            if ($existingPaymentRecord) {
                // Update the existing payment record
                $existingPaymentRecord->update([
                    'amt_paid' => (int)$request->input('amt_paid'),
                    'year' => $request->input('year'),
                    'status' => $request->status,
                    'title' => $request->input('title'),
                    'balance' => $balance,
                    // You might want to update other fields as needed
                ]);
            } else {
                // Use the existing reference number or generate a new one
                $refNo = $this->generateUniqueRefNo();

                // Create a new payment record
                Payment_record::create([
                    'student_id' => $student_id,
                    'ref_no' => $refNo,
                    'amt_paid' => (int)$request->input('amt_paid'),
                    'year' => $request->input('year'),
                    'status' => $request->status,
                    'title' => $request->input('title'),
                    'balance' => $balance,
                    'payment_id' => 1,
                    'paid' => 1,
                ]);
            }

            return redirect()->back();
        } else {
            $payment_records = Payment_record::with('student')
                ->where('student_id', $student_id)
                ->get();

            $student = Student::find($student_id);
            $students = DB::table('students')->get();

            // Get the class_id from the student
            $class_id = $student->class_id;

            // Retrieve class-specific payments
            $payments = DB::table('payments')
                ->where('class_id', $class_id)
                ->get();

            // Calculate the total amount for the class
            $totalOwed = $payments->sum('amount');

            // Retrieve total amount paid by the student
            $totalAmountPaid = Payment_record::where('student_id', $student_id)->sum('amt_paid');
            $classes = DB::table('classses')->get();
            //   $payment_recordsww = Payment_record::with('student')->get();
            //   dd($payment_recordsww);

            return view('Admin.payment.studentPaymentAdd', compact('students', 'student', 'payment_records', 'payments', 'class_id', 'totalAmountPaid', 'totalOwed', 'classes'))
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
