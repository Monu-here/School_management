@extends('Admin.layout.app')
@section('title')
    @php
        $user = Auth::user();
        $setting = getSetting();

    @endphp
   




    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Welcome {{ $user->name }}!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        {{-- @if ($teacher->class)
            <h2>Class: {{ $teacher->class->name }}</h2>

            <h3>Students in Your Class</h3>
            @foreach ($students as $student)
                <div>
                    <p>Name: {{ $student->name }}</p>
                    <p>Email: {{ $student->email }}</p>
                    <p>Roll: {{ $student->roll }}</p>
                    <p>Gender: {{ $student->gender }}</p>
                    <!-- Add other data as necessary -->
                </div>
            @endforeach
            @else
            <p>You do not have a class assigned.</p>
            @endif --}}
        @role('Teacher')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-around  mb-4 ">
                            <form action="{{ route('admin.checkinout.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="check-in">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <button type="submit" id="check-in-btn" class="btn">Check In</button>
                            </form>

                            <form action="{{ route('admin.checkinout.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                <input type="hidden" name="action" value="check-out">
                                <button type="submit" id="check-out-btn" class="btn">Check Out</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endrole()
        @role('Teacher')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        @if (isset($teacher))
                            <p>Name: {{ $teacher->name }}</p>
                            <p>Working Hours: {{ $teacher->workinghrs }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endrole()

        @role('SuperAdmin')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Students</h6>
                                <h3>{{ $students->count() }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/newDesign/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        @endrole()

        @role('Student')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            @php
                                $user = Auth::user();
                                $ss = $user->ss;
                                $totalSubmissions = 0;
                            @endphp
                            <div class="db-info">
                                <h6>Total Homework Submit</h6>
                                @if ($ss->isEmpty())
                                    <p>No students have submitted their homework.</p>
                                @else
                                    @foreach ($ss as $submission)
                                        @php
                                            $submissionStatus = is_array($submission->status)
                                                ? $submission->status
                                                : [$submission->status];
                                            $totalSubmissions += count($submissionStatus);
                                        @endphp
                                    @endforeach
                                    <p>Total submissions: {{ $totalSubmissions }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('Student')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            @php
                                $ss = $user->ss;
                                $totalSubmissions = 0;
                                $user = Auth::user();
                                $student = $user->student;
                                $assignedClassIds = explode(',', $student->class_id);
                                $assignedSectionIds = explode(',', $student->section_id);
                                $assignedClassIds = array_map('intval', $assignedClassIds);
                                $assignedSectionIds = array_map('intval', $assignedSectionIds);

                                $mm = App\Models\Attendence::with('student')
                                    ->select('student_id', 'class_id', 'attendance_type')
                                    ->whereHas('student', function ($query) use (
                                        $assignedClassIds,
                                        $assignedSectionIds,
                                    ) {
                                        $query
                                            ->where('class_id', $assignedClassIds)
                                            ->where('section_id', $assignedSectionIds);
                                    })
                                    ->get()
                                    ->groupBy('student_id');
                            @endphp
                            <div class="db-info">

                                <h6>All Attendence</h6>

                                <span>P = Present & A = Absent</span>
                                <br>
                                @foreach ($mm as $studentId => $attendance)
                                    @php
                                        $attendanceCounts = $attendance->groupBy('attendance_type')->map->count();
                                    @endphp
                                    @foreach ($attendanceCounts as $attendanceType => $count)
                                        {{ $attendanceType }}: {{ $count }},
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
        @role('Student')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            @php

                                $user = Auth::user();
                                $student = $user->student;
                                $assignedClassIds = explode(',', $student->class_id);
                                $assignedSectionIds = explode(',', $student->section_id);
                                $assignedClassIds = array_map('intval', $assignedClassIds);
                                $assignedSectionIds = array_map('intval', $assignedSectionIds);
                                // dd($assignedClassIds);
                            @endphp
                            <div class="db-info">

                                <h6>Current Semister</h6>
                                @foreach ($assignedClassIds as $classId)
                                    @php
                                        $class = App\Models\Classs::find($classId);
                                    @endphp
                                    <input type="hidden" value="{{ $classId }}"
                                        {{ isset($class_id) ? ($class_id == $classId ? 'selected' : '') : (request('class_id') == $classId ? 'selected' : '') }}>
                                    {{ $class ? $class->name : 'Class Name Not Found' }}
                                @endforeach
                                &amp;
                                @foreach ($assignedSectionIds as $sectionId)
                                    @php
                                        $section = App\Models\Section::find($sectionId);
                                    @endphp
                                    <input type="hidden" value="{{ $sectionId }}"
                                        {{ isset($section_id) ? ($section_id == $sectionId ? 'selected' : '') : (request('section_id') == $sectionId ? 'selected' : '') }}>
                                    {{ $section ? $section->name : 'Class Name Not Found' }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole



















        @role('Teacher')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            @php
                                $user = Auth::user();
                                $assignedSubjects = $user->assignedSubjects;
                            @endphp
                            <div class="db-info">
                                <h6>Assign Subject</h6>
                                @if ($assignedSubjects->isEmpty())
                                    <p>You have no subjects assigned.</p>
                            </div>
                        @else
                            <ul>
                                @foreach ($assignedSubjects as $subject)
                                    <li>{{ $subject->subject }}</li>
                                @endforeach
                            </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endrole()
        @role('SuperAdmin')
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Teacher</h6>
                                <h3>{{ $users->where('role_name', 'Teacher')->count() }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/newDesign/img/icons/dash-icon-02.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Department</h6>
                                <h3>{{ $deps->count() }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/newDesign/img/icons/dash-icon-03.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-comman w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-info">
                                <h6>Class</h6>
                                <h3>{{ $cls->count() }}</h3>
                            </div>
                            <div class="db-icon">
                                <img src="{{ asset('assets/newDesign/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole()
    </div>

    <div class="row">

        <div class="col-md-12 col-lg-6">

            <div class="card card-chart">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Calander</h5>
                        </div>
                        <div class="col-6">
                            <ul class="chart-list-out">
                                <li>
                                    @role('SuperAdmin')
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#createEventModal">
                                            Add Event
                                        </button>
                                    @endrole()
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="" style="display: flex; justify-content: end; margin: 10px; margin-right: 32px">
                    </div>
                    @include('Admin.Calander.calander')
                </div>
            </div>

        </div>
        <div class="col-md-12 col-lg-6">

            <div class="card card-chart">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Notice Board</h5>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notices as $notice)
                                <tr>
                                    <td>{{ $notice->publish_on }}</td>
                                    <td>{{ $notice->notice_title }}</td>
                                    <td>
                                        <a href="{{ route('admin.showme', ['id' => $notice->id]) }}"
                                            class="btn btn-primary btn-sm text-white view-notice"
                                            data-notice-id="{{ $notice->id }}"
                                            data-notice-title="{{ $notice->notice_title }}"
                                            data-notice-message="{{ $notice->notice_message }}"
                                            data-publish-on="{{ $notice->publish_on }}" data-bs-toggle="modal"
                                            data-bs-target="#opennotice">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('Admin.Notice.show')
                @include('Admin.Calander.show')
            </div>

        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xl-6 d-flex">

            <div class="card flex-fill student-space comman-shadow">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title">Star Students</h5>
                    <ul class="chart-list-out student-ellips">
                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table star-student table-hover table-center table-borderless table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="text-center">Marks</th>
                                    <th class="text-center">Percentage</th>
                                    <th class="text-end">Year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2209</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-02.jpg') }}"
                                                width="25" alt="Star Students">
                                            John Smith
                                        </a>
                                    </td>
                                    <td class="text-center">1185</td>
                                    <td class="text-center">98%</td>
                                    <td class="text-end">
                                        <div>2019</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE1245</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-01.jpg') }}"
                                                width="25" alt="Star Students">
                                            Jolie Hoskins
                                        </a>
                                    </td>
                                    <td class="text-center">1195</td>
                                    <td class="text-center">99.5%</td>
                                    <td class="text-end">
                                        <div>2018</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE1625</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-03.jpg') }}"
                                                width="25" alt="Star Students">
                                            Pennington Joy
                                        </a>
                                    </td>
                                    <td class="text-center">1196</td>
                                    <td class="text-center">99.6%</td>
                                    <td class="text-end">
                                        <div>2017</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2516</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-04.jpg') }}"
                                                width="25" alt="Star Students">
                                            Millie Marsden
                                        </a>
                                    </td>
                                    <td class="text-center">1187</td>
                                    <td class="text-center">98.2%</td>
                                    <td class="text-end">
                                        <div>2016</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">
                                        <div>PRE2209</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <a href="profile.html">
                                            <img class="rounded-circle"
                                                src="{{ asset('assets/newDesign/img/profiles/avatar-05.jpg') }}"
                                                width="25" alt="Star Students">
                                            John Smith
                                        </a>
                                    </td>
                                    <td class="text-center">1185</td>
                                    <td class="text-center">98%</td>
                                    <td class="text-end">
                                        <div>2015</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-6 d-flex">

            <div class="card flex-fill comman-shadow">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title ">Student Activity </h5>
                    <ul class="chart-list-out student-ellips">
                        <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="activity-groups">
                        <div class="activity-awards">
                            <div class="award-boxs">
                                <img src="{{ asset('assets/newDesign/img/icons/award-icon-01.svg') }}" alt="Award">
                            </div>
                            <div class="award-list-outs">
                                <h4>1st place in "Chess”</h4>
                                <h5>John Doe won 1st place in "Chess"</h5>
                            </div>
                            <div class="award-time-list">
                                <span>1 Day ago</span>
                            </div>
                        </div>
                        <div class="activity-awards">
                            <div class="award-boxs">
                                <img src="{{ asset('assets/newDesign/img/icons/award-icon-02.svg') }}" alt="Award">
                            </div>
                            <div class="award-list-outs">
                                <h4>Participated in "Carrom"</h4>
                                <h5>Justin Lee participated in "Carrom"</h5>
                            </div>
                            <div class="award-time-list">
                                <span>2 hours ago</span>
                            </div>
                        </div>
                        <div class="activity-awards">
                            <div class="award-boxs">
                                <img src="{{ asset('assets/newDesign/img/icons/award-icon-03.svg') }}" alt="Award">
                            </div>
                            <div class="award-list-outs">
                                <h4>Internation conference in "St.John School"</h4>
                                <h5>Justin Leeattended internation conference in "St.John School"</h5>
                            </div>
                            <div class="award-time-list">
                                <span>2 Week ago</span>
                            </div>
                        </div>
                        <div class="activity-awards mb-0">
                            <div class="award-boxs">
                                <img src="{{ asset('assets/newDesign/img/icons/award-icon-04.svg') }}" alt="Award">
                            </div>
                            <div class="award-list-outs">
                                <h4>Won 1st place in "Chess"</h4>
                                <h5>John Doe won 1st place in "Chess"</h5>
                            </div>
                            <div class="award-time-list">
                                <span>3 Day ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill fb sm-box">
                <div class="social-likes">
                    <p>Like us on facebook</p>
                    <h6>50,095</h6>
                </div>
                <div class="social-boxs">
                    <img src="{{ asset('assets/newDesign/img/icons/social-icon-01.svg') }}" alt="Social Icon">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill twitter sm-box">
                <div class="social-likes">
                    <p>Follow us on twitter</p>
                    <h6>48,596</h6>
                </div>
                <div class="social-boxs">
                    <img src="{{ asset('assets/newDesign/img/icons/social-icon-02.svg') }}" alt="Social Icon">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill insta sm-box">
                <div class="social-likes">
                    <p>Follow us on instagram</p>
                    <h6>52,085</h6>
                </div>
                <div class="social-boxs">
                    <img src="{{ asset('assets/newDesign/img/icons/social-icon-03.svg') }}" alt="Social Icon">
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card flex-fill linkedin sm-box">
                <div class="social-likes">
                    <p>Follow us on linkedin</p>
                    <h6>69,050</h6>
                </div>
                <div class="social-boxs">
                    <img src="{{ asset('assets/newDesign/img/icons/social-icon-04.svg') }}" alt="Social Icon">
                </div>
            </div>
        </div>
    </div> --}}
    </div>

    </div>
@endsection
@section('js')
    <script>
        //notice showing Start
        document.addEventListener("DOMContentLoaded", function() {
            $('.view-notice').click(function() {
                var noticeId = $(this).data('notice-id');
                var noticeTitle = $(this).data('notice-title');
                var noticeMessage = $(this).data('notice-message');
                var publishOn = $(this).data('publish-on');
                // Set modal content
                $('#modal-notice-title').text(noticeTitle);
                $('#modal-notice-message').text(noticeMessage);
                $('#modal-publish-on').text(publishOn);
                $('#opennotice').modal('show');
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            $('.xyz').click(function() {
                var eventId = $(this).data('event-id');
                var eventTitle = $(this).data('event-title');
                var eventStart = $(this).data('event-start');
                var eventEnd = $(this).data('event-end');
                // Set modal content
                $('#modal-event-title').text(noticeTitle);
                $('#modal-event-start').text(noticeMessage);
                $('#modal-event-end').text(publishOn);
                $('#xxxx').modal('show');
            });
        });

        ShowTost();
        @if (Session::has('status'))
            toastr.success("{{ session('status') }}");
        @endif
        document.addEventListener('DOMContentLoaded', function() {
            let lastAction = "{{ session('last_action', 'default') }}";

            let checkInButton = document.getElementById('check-in-btn');
            let checkOutButton = document.getElementById('check-out-btn');

            if (lastAction === 'check-in') {
                checkInButton.classList.remove('btn-primary');
                checkInButton.classList.add('btn-secondary');

                checkOutButton.classList.remove('btn-secondary');
                checkOutButton.classList.add('btn-primary');
            } else if (lastAction === 'check-out') {
                checkInButton.classList.remove('btn-secondary');
                checkInButton.classList.add('btn-primary');

                checkOutButton.classList.remove('btn-primary');
                checkOutButton.classList.add('btn-secondary');
            } else {
                checkInButton.classList.add('btn-primary');
                checkOutButton.classList.add('btn-secondary');
            }
        });
        // notice showing End
    </script>
@endsection
