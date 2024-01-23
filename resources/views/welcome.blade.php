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
                             <h3 class="mb-0 text-white" style="font-size: 1.3125rem;">{{ $users->where('role_name','Teacher')->count() }}</h3>

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
    @endsection
