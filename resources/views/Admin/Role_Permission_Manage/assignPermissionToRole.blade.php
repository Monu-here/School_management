@extends('Admin.layout.app')
@section('title')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">Role</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Role</a></li>
                    <li class="breadcrumb-item active">Permission to Role</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class=" ">
        <div class="content">
            <form action="{{ route('admin.role-permission.assignPerRole') }}" method="POST" id="formSubmit">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <label for="user">Choose Role</label>
                                <select name="role_id" id="role_id" class="form-control select2">
                                    <option value="null" selected disabled>Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <label for="permission_id">Permission:</label>
                                <select name="permission_id" id="permission_id" class="form-control select2" multiple>
                                    <option value="null" disabled>Select Permission</option>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary " id="saveBtn" >Assign Permission to Role</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="content">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Role / Permission</h3>
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
                                    <th>SN</th>

                                    <th>Role </th>
                                    <th>Permission</th>

                                </tr>
                            </thead>
                            @php

                                 $roles_permissions = DB::table('roles')
                                    ->leftJoin('roles_permissions', 'roles.id', '=', 'roles_permissions.role_id')
                                    ->leftJoin('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
                                    ->select(
                                        'roles.id as role_id',
                                        'roles.name as role_name',
                                        'permissions.name as permission_name',
                                    )
                                    ->get()
                                    ->groupBy('role_id'); // Group by role_id for easy access
                            @endphp
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($roles_permissions as $role_id => $permissions)
                                    <tr data-entry-id="{{ $role_id }}">
                                        <td>{{$i++}}</td>
                                        <td>{{ $permissions->first()->role_name }}</td>
                                        <td>
                                            @foreach ($permissions as $permission)
                                                @if ($permission->permission_name)
                                                    <span
                                                        class="badge bg-info text-white">{{ $permission->permission_name }}</span>
                                                @endif
                                            @endforeach
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
        const Msg = (msg = "Would You Like To Give Permission to Role ? ") => {
            return prompt(msg) == 'yes';
            console.log(Msg);
        }
        var data = {!! json_encode($roles_permissions) !!}
        let html = "";

        // data.forEach(e => {
        //     html += `${e.role_id} ${e.permission_id},`
        // });
        // $('#new').append(html);
        console.log(data.length);
        console.log(data);
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
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
    </script>
@endsection
