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
                    <h3 class="page-title">Homework</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Homework</a></li>
                        <li class="breadcrumb-item active">Submit</li>
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
                <div class="col-md-6">
                    Assigment Title : <br> <span class="text-capitalize "> {{ $addHomework->title }} </span>
                    <br>
                    <br>
                    Assigment Content : <span  class="text-capitalize ">{!! $addHomework->content !!} </span> 


                </div>
                @role('Student')
                    <div class="col-md-3">
                        <span>Change The Homework Status</span>
                        <form action="{{ route('admin.homework.updatestatus', ['homeworkId' => $addHomework->id]) }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="student_id" value="{{Auth::user()->id}}">
                            <select name="status" class="form-control">
                                <option value="not submitted" {{ $addHomework->status == 'not submitted' ? 'selected' : '' }}>
                                    Not
                                    Submitted</option>
                                <option value="submitted" {{ $addHomework->status == 'submitted' ? 'selected' : '' }}>Submitted
                                </option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                        </form>
                    </div>
                @endrole()
            </div>
        </div>
    </div>
    @role('Student')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.homework.submit', ['nnn' => $addHomework->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ Auth::user()->name }}" name="user_id">
                        <div class="row">
                            <div class="col-md-9">
                                <label for="titile">Homework Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="techer">Submit To</label>

                                <select name="teacher_id" id="teacher_id" class="form-control">
                                    @foreach ($techers as $techer)
                                        <option value="{{ $techer->id }}">{{ $techer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="label">Homework Content</label>
                                <textarea id="summernote" cols="" rows="10" name="content" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary"> Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    @endrole()
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
