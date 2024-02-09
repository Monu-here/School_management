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
                <!-- Form to select class, section, month, and year -->
                <form method="POST" action="{{ route('admin.atten.report') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="class_id">Select Class:</label>
                                <select name="class_id" id="class_id" class="form-control">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
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
                                        <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                            {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
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
                                @php
                                    $i=1;
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
                                        <td>{{$i++}}</td>
                                        <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->name }}
                                        </td>
                                        <td>{{ $attendanceReport->where('student_id', $studentId)->first()->student->roll }}
                                        </td>
                                        @for ($day = 1; $day <= 30; $day++)
                                            <td>
                                                @if (isset($attendance[$day]))
                                                    {{ $attendance[$day] }}
                                                @else
                                                    <!-- If attendance data for this day is not available -->
                                                @endif
                                            </td>
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
@endsection
