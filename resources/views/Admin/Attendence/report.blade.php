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
            @if ($attendanceReport->isEmpty())
                <div class="alert alert-danger" role="alert">
                    No attendance data found for the selected class and section.
                </div>
            @else
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('admin.atten.report') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="class_id">Select Class:</label>
                                        <select name="class_id" id="class_id" class="form-control">
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="section_id">Select Section:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="month">Select Month:</label>
                                        <select name="month" id="month" class="form-control">
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $i == date('n') ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-primary">Generate Report</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                                                $status = isset($attendance[$day]) ? $attendance[$day] : ''; // Check if attendance data exists for this day
                                                $class = '';
                                                if ($status == 'P') {
                                                    $class = 'badge badge-pill badge-success';
                                                } elseif ($status == 'L') {
                                                    $class = 'badge badge-pill badge-warning';
                                                } elseif ($status == 'A') {
                                                    $class = 'badge badge-pill badge-danger';
                                                }
                                            @endphp
                                            <strong class="badge {{ $class }}">{{ $status }}</strong>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p>---------------------</p>
        @foreach ($mm as $key => $value)
            <p>Student ID: {{ $key }}</p>
            <ul>
                @foreach ($value as $attendance)
                    <li>Attendance Type: {{ $attendance->attendance_type }}</li>
                @endforeach
            </ul>
        @endforeach
        <p>---------------------</p>
        @foreach ($mm as $studentId => $attendances)
            <p>Student ID: {{ $studentId }}</p>
            <ul>
                @php
                    $attendanceCounts = $attendances->groupBy('attendance_type')->map->count();
                @endphp
                @foreach ($attendanceCounts as $attendanceType => $count)
                    <li>{{ $attendanceType }}: {{ $count }}</li>
                @endforeach
            </ul>
        @endforeach
        <p>---------------------</p>
        @foreach ($mm as $attendanceDate => $attendances)
            <p>Attendance Date: {{ $attendanceDate }}</p>
            <ul>
                @foreach ($attendances as $attendance)
                    <li>{{ $attendance->attendance_type }}</li>
                @endforeach
            </ul>
        @endforeach
        <p>---------------------</p>
        @foreach ($mm as $attendanceDate => $attendances)
            <p>Attendance Date: {{Carbon\Carbon::createFromDate ($attendanceDate)->format('Y-m-d')  }}</p>
            <ul>
                @foreach ($attendances as $attendance)
                    <li>{{ $attendance->attendance_type }}</li>
                @endforeach
            </ul>
        @endforeach


    </div>
@endsection

@section('js')
    <script>
        var monu = {!! json_encode($attendanceDate) !!}
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
        // toastr.error('No students found for the selected class and section.');
    </script>
@endsection
