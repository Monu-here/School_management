@extends('Admin.layout.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <style>
        .login-danger {
            color: red;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endsection
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Role</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Role</a></li>
                        <li class="breadcrumb-item active">Role Manage</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.role-permission.addRole') }}" method="POST" id="roleSubmitForm">
                        @csrf
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="" required>
                        <button class="btn btn-primary mt-3 " id="roleSubmitBtn">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.role-permission.addPermission') }}" method="POST" id="formSubmit">
                        @csrf
                        <label for="name">Permission Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                        <button type="submit" class="btn btn-primary mt-3" id="saveBtn">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Users</h3>
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
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                    <th class="d-none">Created day</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>

                                        <td>
                                            {{ $i++ }}

                                        </td>
                                        <td>
                                            {{ $role->name }}

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.role-permission.delrole', ['role' => $role->id]) }}"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash text-white "></i>
                                            </a>
                                            <a
                                                href="{{ route('admin.role-permission.editRole', ['role' => $role->id]) }}"class="btn btn-sm btn-primary text-white "><i
                                                    class="fa fa-pen"></i></a>

                                            </a>

                                            </a>


                                        </td>
                                        <td>
                                            {{ getAgo($role->created_at) }}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Users</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">

                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttables">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something" />
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Permission Name</th>
                                    <th>Action</th>
                                    <th class="d-none">Created day</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>

                                        <td>
                                            {{ $i++ }}

                                        </td>
                                        <td>
                                            {{ $permission->name }}

                                        </td>

                                        <td>
                                            <a href="{{ route('admin.role-permission.editPermission', ['permission' => $permission->id]) }}"
                                                class="btn btn-sm btn-primary">
                                                <i class="fa fa-pen text-white "></i>
                                            </a>
                                            <a href="{{ route('admin.role-permission.delPermission', ['permission' => $permission->id]) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a>


                                        </td>
                                        <td>
                                            {{ getAgo($permission->created_at) }}
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
        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            var saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                event.target.submit();
            }, 2000);
        });
        document.getElementById('roleSubmitForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var roleSubmitBtn = document.getElementById('roleSubmitBtn');
            roleSubmitBtn.disabled = true;
            roleSubmitBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                event.target.submit();
            }, 2000);
        });
    </script>
    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $('#clienttables').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
