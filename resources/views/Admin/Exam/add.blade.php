@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Exam</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.exam.index') }}">Exam</a></li>
                        <li class="breadcrumb-item active">Edit Exam</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
    @section('content')
        <div class="card">
            <div class="card-header header-elements-inline">
                <h6 class="card-title">Edit Exam</h6>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Name <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="name" required type="text" class="form-control"
                                        placeholder="Name of Exam">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Select
                                    Faculity</label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select Teacher" class="form-control select-search"
                                        name="faculity_id" id="term">
                                        @foreach ($faculitys as $faculity)
                                            <option value="{{ $faculity->id }}">{{ $faculity->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Select
                                    Semester</label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select Teacher" class="form-control select-search"
                                        name="semester_id" id="term">
                                        @foreach ($classes as $clsses)
                                            <option value="{{ $clsses->id }}">{{ $clsses->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="term" class="col-lg-3 col-form-label font-weight-semibold">Term</label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Select Teacher" class="form-control select-search"
                                        name="term" id="term">
                                        <option value="1">First Term</option>
                                        <option value="2">Second Term</option>
                                        <option value="3">Third Term</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Year <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="year" required type="text" class="form-control" placeholder="Year">
                                </div>
                            </div>



                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submit <i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
