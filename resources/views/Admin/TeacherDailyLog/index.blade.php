@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Teacher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Teacher</a></li>
                        <li class="breadcrumb-item active">Daily Log</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    @php
        $user = Auth::user();
        $setting = getSetting();
    @endphp

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.teacher.index') }}" method="POST" enctype="multipart/form-data"
                                id="">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="name" id="name" class="form-control"
                                        value="{{ Auth::user()->name }}" >

                                    <div class="col-md-4">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="summernote" cols="10" rows="10" class="form-control"></textarea>
                                    </div>
                                     <div class="col-md-2">
                                        <br>
                                         <button class="btn btn-primary">Submit</button>

                                     </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Teacher Daily Log</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                 

                                @role('Teacher')
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fas fa-plus"></i></a>
                                    </button>
                                @endrole()
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

                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>
                                        Description
                                    </th>
                                    <th class="d-none">Created day</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($dailys as $daily)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input d-block" type="checkbox" value="something" />
                                            </div>
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $daily->name }}</td>
                                        <td>{{ $daily->date }}</td>


                                        <td>
                                            {{ $daily->desc }}
                                        </td>
                                        <td>
                                            {{ getAgo($daily->created_at) }}

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
    </script>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
     <script>

        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
