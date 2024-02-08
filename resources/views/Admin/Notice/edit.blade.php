@extends('Admin.layout.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
@endsection

@section('linkbar')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col ms-4">
                    <h3 class="page-title">User</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">User</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.notice.edit',['notice'=>$notice->id]) }}" method="POST">
                @csrf
                <div class="white-box">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="input-effect mb-30">
                                    <label>Title <span>*</span> </label>
                                    <input class="primary-input form-control" type="text" name="notice_title"
                                        autocomplete="off" value="{{$notice->notice_title}}">
                                </div>
                                <br>
                                <textarea id="summernote" cols="30" rows="10" name="notice_message">{{$notice->notice_message}}</textarea>
                            </div>


                            <div class="col-lg-5">
                                <div class="no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <label>Notice Date <span>*</span> </label>
                                            <input class="primary-input date form-control read-only-input" id="notice_date"
                                                type="date" autocomplete="off" name="notice_date" value="{{$notice->notice_date}}">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <div class="no-gutters input-right-icon">
                                    <div class="col">
                                        <div class="input-effect">
                                            <label>Publish On <span>*</span> </label>
                                            <input class="primary-input date form-control read-only-input" id="publish_on"
                                                type="date" autocomplete="off" name="publish_on" value="{{$notice->publish_on}}">
                                        </div>
                                    </div>
                                    <br>

                                </div>
                                <div class="col-lg-12 mt-50">
                                    <label>Created by</label><br>
                                    <select name="user_id" id="" class="form-control">
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == old('user_id', $notice->user_id) ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="primary-btn fix-gr-bg btn btn-primary">
                                Save </button>
                        </div>
                    </div>
                </div>
            </form>
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
