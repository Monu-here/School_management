@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Dashbaord</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashbaord</a></li>
                        <li class="breadcrumb-item active">Dashbaord Settings</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
    @section('css')
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
            .icon-3x {
                font-size: 48px;
                color: #C9EDFD;
            }
        </style>
    @endsection
    @section('content')
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body  has-bg-image" style="background-color: #29B6F6">
                    <div class="media" style="display: flex; align-items: flex-start;">
                        <div class="media-body" style="flex: 1;">
                            <h3 class="mb-0 text-white" style="font-size: 1.3125rem;">{{ $students->count() }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold text-white"
                                style="font-size: .6875rem">Total Students</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="fa-solid fa-graduation-cap icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body  has-bg-image" style="background-color: #EF5350">
                    <div class="media" style="display: flex; align-items: flex-start;">
                        <div class="media-body" style="flex: 1;">
                            <h3 class="mb-0 text-white" style="font-size: 1.3125rem;">
                                {{ $users->where('role_name', 'Teacher')->count() }}</h3>

                            <span class="text-uppercase font-size-xs font-weight-bold text-white"
                                style="font-size: .6875rem">Total Teacher</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="fa-solid fa-chalkboard-user icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body  has-bg-image" style="background-color: #66BB6A">
                    <div class="media" style="display: flex; align-items: flex-start;">
                        <div class="media-body" style="flex: 1;">
                            <h3 class="mb-0 text-white" style="font-size: 1.3125rem;">{{ $deps->count() }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold text-white"
                                style="font-size: .6875rem">Total Deapartment</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="fa fa-user icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card card-body  has-bg-image" style="background-color: #5C6BC0">
                    <div class="media" style="display: flex; align-items: flex-start;">
                        <div class="media-body" style="flex: 1;">
                            <h3 class="mb-0 text-white" style="font-size: 1.3125rem;">{{ $cls->count() }}</h3>
                            <span class="text-uppercase font-size-xs font-weight-bold text-white"
                                style="font-size: .6875rem">Total Class</span>
                        </div>
                        <div class="ml-3 align-self-center">
                            <i class="fa fa-user icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="container card-body">
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
                                    <a href="{{route('admin.showme',['id'=>$notice->id])}}" class="btn btn-primary btn-sm text-white view-notice"
                                        data-notice-id="{{ $notice->id }}" data-notice-title="{{ $notice->notice_title }}"
                                        data-notice-message="{{ $notice->notice_message }}"
                                        data-publish-on="{{ $notice->publish_on }}" data-bs-toggle="modal"
                                        data-bs-target="#opennotice">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @include('Admin.Notice.show')










        <div class="" style="display: flex; justify-content: end; margin: 10px; margin-right: 32px">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEventModal">
                Add Event
            </button>


        </div>
        @include('Admin.Calander.calander')
    @endsection

    @section('js')
        <script>
            //notice showing Start
            $(document).ready(function() {
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
