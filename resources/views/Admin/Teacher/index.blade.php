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
    <form action="{{ route('admin.student.teacherIndex') }}" method="GET">

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
    {{-- <form action="{{ route('admin.student.teacherIndex') }}" method="GET">
        <div class="form-group filter mb-4"
            style="display: flex; justify-content: space-around; width: 250px; margin-top: 10px">
            <input type="text" name="name" class="form-control" placeholder="Enter Teacher Name"
                value="{{ $selectedName }}">

            <button type="submit" class="btn btn-success" style="margin-left: 10px"><i
                    class="fa-solid fa-filter"></i></button>
        </div>
    </form> --}}















{{--
    <h3 class="page-title " style="display: flex; justify-content: space-between"> Teacher <button type="button"
            class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openmodel">
            Add Teacher
        </button> --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Students</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                      

                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#openmodel"><i class="fas fa-plus"></i></button>
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
                                                <a href="{{ route('admin.student.teacherShow', ['teacher' => $teacher->id]) }}"
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
