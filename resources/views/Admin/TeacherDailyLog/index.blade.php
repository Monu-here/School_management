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
@section('content')
    @php
        $user = Auth::user();
        $setting = getSetting();
    @endphp
    @role('Teacher')
    <div class="row" id="add">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.teacher.index')}}" method="POST" enctype="multipart/form-data" id="">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $user->name }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="desc">Description</label>
                                <textarea name="desc" id="desc" cols="5" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-md-2 mt-5">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endrole()
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
                                <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="#add" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <td>{{$daily->date}}</td>


                                        <td>
                                           {{$daily->desc}}
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
@endsection
