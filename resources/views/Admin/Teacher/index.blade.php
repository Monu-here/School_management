@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Teacher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Teachers</a></li>
                        <li class="breadcrumb-item active">All Teachers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <form action="{{ route('admin.teacher.teacherIndex') }}" method="GET">

        <div class="student-group-form">

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Enter Teacher Name"
                            value="{{ $selectedName }}">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    


                                    <a href="{{route('admin.teacher.teacheradd')}}" class="btn btn-primary" ><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="clienttable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>
                                            Action
                                        </th>
                                        <th class="d-none">Created day</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><img src="{{ asset($teacher->image) }}" alt="" width="60"></td>
                                            <td>{{ $teacher->name }}</td>


                                            <td>
                                                <a href="{{ route('admin.teacher.teacherShow', ['teacher' => $teacher->id]) }}"
                                                    class="btn btn-sm btn-success"><i class="fa-solid fa-eye"></i></a>
                                                <a href="" class="btn btn-sm btn-primary"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                            <td>
                                                {{ getAgo($teacher->created_at) }}

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
        </div> --}}
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                             </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="{{ route('admin.teacher.teacheradd') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        SN
                                    </th>
                                    <th>Name</th>
                                    <th>Working Hours</th>

                                    <th class="text-end ">Action</th>
                                    <th class="text-end ">Created at</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($teachers as $teacher)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="" class="avatar avatar-sm me-2"><img
                                                        class="avatar-img rounded-circle" src="{{ asset($teacher->image) }}"
                                                        alt="User Image" /></a>
                                                <a href="">{{ $teacher->name }}</a>
                                            </h2>
                                        </td>
                                        <td>{{$teacher->workinghrs}}</td>

                                        <td>
                                            {{-- <a href="{{ route('admin.teacher.teacherShow', ['teacher' => $teacher->id]) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-eye text-white "></i></a> --}}
                                            <a href="{{ route('admin.teacher.teacheredit', ['teacher' => $teacher->id]) }}"
                                                class="btn btn-sm btn-primary"><i class="fa fa-pen text-white "></i></a>
                                            <a href="{{ route('admin.teacher.teacherdel', ['teacher' => $teacher->id]) }}"
                                                class="btn btn-sm btn-danger "  onclick="return yes()"><i class="fa fa-trash text-white "></i></a>
                                        </td>
                                        <td>
                                            {{ getAgo($teacher->created_at) }}

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
