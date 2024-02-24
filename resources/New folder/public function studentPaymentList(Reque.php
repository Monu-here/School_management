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
