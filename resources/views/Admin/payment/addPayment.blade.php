@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col ms-4">
                    <h3 class="page-title">Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Payment</a></li>
                        <li class="breadcrumb-item active">Add Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
@section('content')
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.payment.add') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Title <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="title" value="" type="text" class="form-control"
                                placeholder="Eg. School Fees">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="class_id" class="col-lg-3 col-form-label font-weight-semibold">Class </label>
                        <div class="col-lg-9">
                            <select class="form-control select-search" name="class_id" id="my_class_id">
                                <option value="">All Classes</option>
                                @foreach ($classes as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Year <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="date" name="year" id="" class="form-control">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-lg-3 col-form-label font-weight-semibold">Amount (<span>रु</span>) <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input class="form-control" value="{{ old('amount') }}" required name="amount" id="amount"
                                type="number">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-lg-3 col-form-label font-weight-semibold">Description
                            <span
                                class="text-danger">*</span>
                        </label>
                        <div class="col-lg-9">
                            <input class="form-control" value="{{ old('description') }}" name="description" id="description"
                                type="text" placeholder="Enter Description" >
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save<i
                                class="icon-paperplane ml-2"></i></button>
                        <a href="#" class="btn btn-danger">Cancle<i
                                class="icon-paperplane ml-2"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
