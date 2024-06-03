@extends('Admin.layout.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Notice</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Notice</a></li>
                        <li class="breadcrumb-item active">All Notice</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin.notice.add') }}" method="POST">
                        @csrf
                        <div class="white-box">
                            <div class="">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="input-effect mb-30">
                                            <label>Title <span style="color: red">*</span> </label>
                                            <input class="primary-input form-control" type="text" name="notice_title"
                                                autocomplete="off" value="">
                                        </div>
                                        <br>
                                        <label>Notice Message <span style="color: red">*</span> </label>

                                        <textarea id="summernote" rows="30" cols="20" name="notice_message"></textarea>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="no-gutters input-right-icon mb-30">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <label>Notice Date <span style="color: red">*</span> </label>
                                                    <input class="primary-input date form-control read-only-input"
                                                        id="notice_date" type="date" autocomplete="off"
                                                        name="notice_date">
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <div class="col">
                                            <div class="input-effect">
                                                <label>Publish On <span style="color: red">*</span> </label>
                                                <input class="primary-input date form-control read-only-input"
                                                    id="publish_on" type="date" autocomplete="off" name="publish_on"
                                                    value="">
                                            </div>
                                        </div>
                                        <br>
                                        <div class=>
                                            <button type="submit" class="btn btn-primary">
                                                Save </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
