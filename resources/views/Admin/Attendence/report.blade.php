{{-- @extends('Admin.layout.app')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Student Attendance Report</h5>
            </div>
            <div class="card-body">
                <!-- Form to select class and section -->
                <form method="POST" action="{{ route('admin.atten.report') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="class_id">Select Class:</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">Select Section:</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Generate Report</button>
                        </div>
                    </div>
                </form>

                <!-- Display attendance report -->
                @if ($attendanceReport->isEmpty())
                    <div class="alert alert-danger" role="alert">
                        No attendance data found for the selected class and section.
                    </div>
                @else
                    <h5>Attendance Report:</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student Roll</th>
                                    @for ($day = 1; $day <= 30; $day++)
                                        <th>
                                            {{ Carbon\Carbon::createFromDate(null, null, $day)->format('l') }} <br>
                                            {{ $day }}
                                        </th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceData as $studentId => $attendance)
                                    <tr>
                                        <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->name }}
                                        </td>
                                        <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->roll }}
                                            @for ($day = 1; $day <= 30; $day++)
                                        <td>{{ $attendance[$day] }}</td>
                                @endfor
                                </tr>
                @endforeach
                </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
    </div>
@endsection --}}
@extends('Admin.layout.app')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Student Attendance Report</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('admin.atten.report') }}" id="formSubmit">
                            @csrf
                            @role('SuperAdmin')
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="faculity_id">Select Faculity:</label>
                                            <select name="faculity_id" id="faculity_id" class="form-control">
                                                <option value="">Select Faculity</option>

                                                @foreach ($facts as $fact)
                                                    <option value="{{ $fact->id }}"
                                                        {{ request('faculity_id') == $fact->id ? 'selected' : '' }}>
                                                        {{ $fact->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="class_id">Select Semester:</label>
                                            <select name="class_id" id="class_id" class="form-control">
                                                <option value="">Select Semester</option>

                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="section_id">Select Section:</label>
                                            <select name="section_id" id="section_id" class="form-control">
                                                <option value="">Select Section</option>

                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                                        {{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="month">Select Month:</label>
                                            <select name="month" id="month" class="form-control">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $i == date('n') ? 'selected' : '' }}>
                                                        {{ Carbon\Carbon::createFromFormat('m', $i)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="year">Select Year:</label>
                                            <select name="year" id="year" class="form-control">
                                                @for ($i = date('Y'); $i >= 2010; $i--)
                                                    <option value="{{ $i }}"
                                                        {{ $i == date('Y') ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 col-lg-12 mt-20 text-right justify-content-end d-flex">
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Generate Report</button>

                                    </div>
                                </div>
                            @endrole()
                            @role('Teacher')
                                @php

                                    $user = Auth::user();
                                    $teacher = $user->teacher;
                                    $assignedFaculityIds = explode(',', $teacher->faculity_id);
                                    $assignedClassIds = explode(',', $teacher->class_id);
                                    $assignedSectionIds = explode(',', $teacher->section_id);
                                    $assignedClassIds = array_map('intval', $assignedClassIds);
                                    $assignedSectionIds = array_map('intval', $assignedSectionIds);
                                    $assignedFaculityIds = array_map('intval', $assignedFaculityIds);

                                @endphp
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                Faculity:</label>
                                            <select name="faculity_id" id="faculity_id" class="form-control" required>
                                                <option value="">Select Faculity</option>
                                                @foreach ($assignedFaculityIds as $factId)
                                                    @php
                                                        $fact = App\Models\Faculity::find($factId);
                                                    @endphp
                                                    <option value="{{ $factId }}"
                                                        {{ isset($faculity_id) ? ($faculity_id == $factId ? 'selected' : '') : (request('faculity_id') == $factId ? 'selected' : '') }}>
                                                        {{ $fact ? $fact->name : 'Faculity Not Found' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="class_id">Select Class:</label>
                                            <select name="class_id" id="class_id" class="form-control" required>
                                                <option value="">Select Class</option>
                                                @foreach ($assignedClassIds as $classId)
                                                    @php
                                                        $class = App\Models\Classs::find($classId);
                                                    @endphp
                                                    <option value="{{ $classId }}"
                                                        {{ isset($class_id) ? ($class_id == $classId ? 'selected' : '') : (request('class_id') == $classId ? 'selected' : '') }}>
                                                        {{ $class ? $class->name : 'Class Name Not Found' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="section_id">Select Section:</label>
                                            <select name="section_id" id="section_id" class="form-control" required>
                                                <option value="">Select Section</option>

                                                @foreach ($assignedSectionIds as $sectionId)
                                                    @php
                                                        $section = App\Models\Section::find($sectionId);
                                                    @endphp
                                                    <option value="{{ $sectionId }}"
                                                        {{ isset($section_id) ? ($section_id == $sectionId ? 'selected' : '') : (request('section_id') == $sectionId ? 'selected' : '') }}>
                                                        {{ $section ? $section->name : ' Section Not found' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="month">Select Month:</label>
                                            <select name="month" id="month" class="form-control">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $i == date('n') ? 'selected' : '' }}>
                                                        {{ Carbon\Carbon::createFromFormat('m', $i)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year">Select Year:</label>
                                            <select name="year" id="year" class="form-control">
                                                @for ($i = date('Y'); $i >= 2010; $i--)
                                                    <option value="{{ $i }}"
                                                        {{ $i == date('Y') ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-20 text-right justify-content-end d-flex">
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Generate Report</button>

                                    </div>
                                </div>
                            @endrole()
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if ($attendanceReport->isEmpty())
            <div class="alert alert-danger" role="alert">
                No attendance data found for the selected class and section.
            </div>
        @else
        @endif
        <div class="card">
            <div class="card-body">
                <h5>Attendance Report:</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="lateday d-flex mt-4">
                            <div class="mr-3">Present: <span class="text-success">P</span></div>
                            <div class="mr-3">Late: <span class="text-warning">L</span></div>
                            <div class="mr-3">Absent: <span class="text-danger">A</span></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive" style="width: 100%">
                    <table id="clienttable" class="table">
                        <thead>
                            @php
                                $i = 1;
                            @endphp
                            <tr>
                                <th>Sn</th>
                                <th>Student Name</th>
                                <th>Student Roll</th>
                                @for ($day = 1; $day <= Carbon\Carbon::createFromDate($selectedYear, $selectedMonth)->daysInMonth; $day++)
                                    <th>
                                        {{ Carbon\Carbon::createFromDate($selectedYear, $selectedMonth, $day)->format('l') }}
                                        <br>
                                        {{ $day }}
                                    </th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendanceData as $studentId => $attendance)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->name }}
                                    </td>
                                    <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->roll }}
                                    </td>
                                    @for ($day = 1; $day <= Carbon\Carbon::createFromDate($selectedYear, $selectedMonth)->daysInMonth; $day++)
                                        <td>
                                            @php
                                                $dayAttendance = isset($attendance[$day]) ? $attendance[$day] : [];

                                                $statusString = '';

                                                if (is_array($dayAttendance)) {
                                                    foreach ($dayAttendance as $periodStatus) {
                                                        $class = '';
                                                        if ($periodStatus == 'P') {
                                                            $class = 'badge badge-pill badge-success';
                                                        } elseif ($periodStatus == 'L') {
                                                            $class = 'badge badge-pill badge-warning';
                                                        } elseif ($periodStatus == 'A') {
                                                            $class = 'badge badge-pill badge-danger';
                                                        }
                                                        $statusString .= "<strong class='badge $class'>$periodStatus</strong> ";
                                                    }
                                                } else {
                                                    $class = '';
                                                    if ($dayAttendance == 'P') {
                                                        $class = 'badge badge-pill badge-success';
                                                    } elseif ($dayAttendance == 'L') {
                                                        $class = 'badge badge-pill badge-warning';
                                                    } elseif ($dayAttendance == 'A') {
                                                        $class = 'badge badge-pill badge-danger';
                                                    }
                                                    $statusString = "<strong class='badge $class'>$dayAttendance</strong>";
                                                }
                                            @endphp
                                            {!! $statusString !!}
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h5 class="card card-body">Number of students present in the month</h5>
        <div class="section_of_present_absent">
            <div class="present">
                <div class="card">
                    <div class="card-body">
                        @if ($mm->isEmpty())
                            <p>No attendance data available for the selected month.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Total Present in Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $j = 1;
                                    @endphp
                                    @foreach ($mm as $studentId => $attendance)
                                        @php
                                            $student =
                                                $attendanceReport->where('student_id', $studentId)->first()->student ??
                                                null;
                                        @endphp
                                        <tr>
                                            <td>{{ $j++ }}</td>
                                            <td>
                                                {{ $student ? $student->name : 'N/A' }}
                                            </td>
                                            <td>
                                                @php
                                                    $attendanceCounts = $attendance
                                                        ->groupBy('attendance_type')
                                                        ->map->count();
                                                @endphp
                                                @foreach ($attendanceCounts as $attendanceType => $count)
                                                    {{ $attendanceType }}: {{ $count }},
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#clienttable').DataTable({
                "responsive": false,
                scrollX: true,
                lengthChange: true,
                autoWidth: true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });

        // var productGroups = {!! json_encode($attendanceReport, JSON_NUMERIC_CHECK) ?? '[]' !!};
    </script>
    <script>
        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            var saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                event.target.submit();
            }, 2000);
        });
        // toastr.error('No students found for the selected class and section.');
    </script>
@endsection
