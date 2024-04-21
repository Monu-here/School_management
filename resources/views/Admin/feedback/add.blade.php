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
                    <h3 class="page-title">Feedback</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Feedback</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.feedback.addFeedback') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <div class="row">

                            <div class="col-md-3">
                                <label for="techer">Select Teacher</label>

                                <select name="techer_id" id="" class="form-control">
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="label">Feedback Contnet</label>
                                <textarea id="summernote" cols="" rows="10" name="desc" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary"> Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
       <div class="col-md-6">
        <div class="card card-table comman-shadow">
            <div class="card-body">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Homework</h3>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                        id="clienttable">
                        <thead class="student-thread">
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox" value="something" />
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Name </th>
                                <th>Teacher</th>
                                <th>Content</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                                <tr>
                                    <td>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something" />
                                        </div>
                                    </td>
                                    <td>hey</td>
                                    <td>
                                        {{ $feedback->name }}
                                    </td>
                                    <td>
                                        {{ $feedback->techer_id }}
                                        {{-- {{$feedback->teacher->name}} --}}
                                        {{-- {{ optional($feedback->teacher)->name }} <!-- Use optional() to handle null --> --}}
                                    </td>

                                    <td>

                                        <div class="con">
                                            {!! $feedback->desc !!}
                                        </div>

                                    </td>



                                </tr>
                            @endforeach

                        </tbody>
                    </table>
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
