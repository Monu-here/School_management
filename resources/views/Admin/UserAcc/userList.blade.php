@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">User Teacher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">User Teacher</a></li>
                        <li class="breadcrumb-item active">All User Teacher</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
    @section('content')
        {{-- <div class="card-body">
            <div class="table-responsive">
                <table id="clienttable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                             <th class="d-none">Created day</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($user->where('role_name', 'Teacher') as $teacher)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <img src="{{asset($teacher->image)}}" alt="" width="50">
                                </td>
                                <td>
                                    {{ $teacher->name }}
                                </td>
                                <td>
                                    {{ $teacher->email }}
                                </td>
                                <td>
                                    {{ $teacher->role_name }}
                                </td>
                                <td>
                                    {{ getAgo($teacher->created_at) }}
                                </td>
                            </tr>
                            <span class="badge badge-pill badge-success">{{ $teacher->name }}</span>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Users</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                            class="feather-list"></i></a>
                                    <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                            class="feather-grid"></i></a>
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
                                    <a href="{{ route('admin.user.add') }}" class="btn btn-primary"><i
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
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </th>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                         <th class="d-none">Created day</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->where('role_name', 'Teacher') as $teacher)
                                    <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something" />
                                                </div>
                                            </td>
                                            <td>{{ $teacher->id }}</td>
                                            <td>
                                                <h2 class="table-avatar">

                                                    <a href="#" class="avatar avatar-sm me-2"><img
                                                            class="avatar-img rounded-circle" src="{{ asset($teacher->image) }}"
                                                            alt="" /></a>
                                                    <a href="#">{{ $teacher->name }}</a>
                                                </h2>
                                            </td>
                                            <td>
                                                {{ $teacher->email }}

                                            </td>
                                            <td>
                                                {{ $teacher->role_name }}
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

            // function showModal() {
            //     $('#openmodel').modal('show');
            // }
        </script>
    @endsection
