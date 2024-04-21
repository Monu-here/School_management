@extends('Admin.layout.app')
@section('title')
    @php
        $user = Auth::user();
        $setting = getSetting();

    @endphp
    {{-- @if (Auth::user()->role_name) --}}
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
                                    {{-- @role('SuperAdmin') --}}
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#createEventModal">
                                        Add Event
                                    </button>
                                    {{-- @endrole() --}}
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
                            <ul class="chart-list-out">
                                <li><span class="circle-blue"></span>Teacher</li>
                                <li><span class="circle-green"></span>Student</li>
                                <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                            </ul>
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

    <div class="row">
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
    </div>
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
        
        // notice showing End
    </script>
@endsection
