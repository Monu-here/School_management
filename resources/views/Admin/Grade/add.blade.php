@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Grade</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.grade.index')}}">Grade</a></li>
                        <li class="breadcrumb-item active">Add Grade</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5>Make your Grade</h5>
                <form action="{{ route('admin.grade.add') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label for="gardename">Grade In letter</label>
                            <input type="text" name="name" id="" class="form-control">
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="grade-holder">
                                        <label for="mark_from">Mark From</label>
                                        <input type="text" class="form-control" name="mark_from">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="grade-holder">
                                        <label for="mark_to">Mark To</label>
                                        <input type="text" class="form-control" name="mark_to">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="grade-holder">
                                        <label for="remark">Remark</label>
                                        <input type="text" class="form-control" name="remark">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <div class="mt-2">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
