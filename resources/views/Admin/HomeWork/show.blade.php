@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Homework</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Show</a></li>
                        <li class="breadcrumb-item active"> {{ $homework->id }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Homework</h3>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><label for="Submited To ">Submitted To : </label>
                            <u>{{ $homework->teacher->name }}</u> </div>
                        <div class="col-md-3"><label for="title">Homework Title : </label><u>{{ $homework->title }}</u>
                        </div>
                        <div class="col-md-3"> <label for="submited">Submimted From : </label>
                            <u>{{ $homework->user_id }}</u> </div>
                        <br>
                        <br>
                        <div class="col-md-12"><label for="content">{!! $homework->content !!}</label></div>
                    </div>
                </div>
            </div>
        </div>
</div @endsection
