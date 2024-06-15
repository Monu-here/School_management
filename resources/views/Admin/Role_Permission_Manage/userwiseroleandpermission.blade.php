@extends('Admin.layout.app')
@section('title')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">Role Permission Manage</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Role</a></li>
                    <li class="breadcrumb-item active">User Wise Role</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
    <div class=" ">
        <form action="{{ route('admin.role-permission.giveRole') }}" method="POST" id="formSubmit">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="user">Choose User</label>
                            <select name="user_id" id="user_id" class="form-control select2" required>
                                <option value="null" selected disabled>Select User</option>
                                @foreach ($users->where('role_name', 'SuperAdmin') as $user)
                                    <option value="{{ $user->id }}" old={{ $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                                <option value="null"   disabled>Teacher</option>
                                @foreach ($users->where('role_name', 'Teacher') as $user)
                                    <option value="{{ $user->id }}" old={{ $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                                <option value="null"   disabled>Student</option>
                                @foreach ($users->where('role_name', 'Student') as $user)
                                    <option value="{{ $user->id }}" old={{ $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="role_id">Choose Role</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="null" selected disabled>Select Role</option>

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="permission_id">Choose Permission</label>
                            <select name="permission_id[]" id="permission_id" class="form-control select2" multiple
                                required>

                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ in_array($permission->id, old('permission', [])) ? 'selected' : '' }}>
                                        {{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    {{-- <div class="card"> --}}
                        {{-- <div class="card-body"> --}}
                            <button class="btn  btn-primary"  id="saveBtn">Submit</button>
                        {{-- </div> --}}
                    {{-- </div> --}}
                </div>


            </div>
        </form>
        <div class="content">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Permission / User</h3>
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
                                        SN
                                    </th>
                                    <th>Permission Name </th>
                                    <th>User Name</th>
                                 </tr>
                            </thead>
                            <tbody>
                                @php
                                    $previous_user_id = null;
                                    $j = 1;
                                @endphp

                                @foreach ($users_permissions as $key => $users_permission)
                                    @if ($previous_user_id !== $users_permission->user_id)
                                        @php

                                            $permissions = DB::table('users_permissions')
                                                ->join(
                                                    'permissions',
                                                    'users_permissions.permission_id',
                                                    '=',
                                                    'permissions.id',
                                                )
                                                ->select('permissions.name as permission_name')
                                                ->where('users_permissions.user_id', $users_permission->user_id)
                                                ->get();

                                            $user = DB::table('users')
                                                ->select('users.name as user_name')
                                                ->where('users.id', $users_permission->user_id)
                                                ->first();

                                        @endphp
                                        <tr data-entry-id="{{ $users_permission->user_id }}">
                                            <td>
                                                {{ $j++ }}

                                            </td>
                                            <td>
                                                @foreach ($permissions as $permission)
                                                    <span
                                                        class="badge bg-info text-white">{{ $permission->permission_name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $user->user_name }}
                                            </td>
                                            

                                        </tr>

                                        @php
                                            $previous_user_id = $users_permission->user_id;
                                        @endphp
                                    @endif
                                @endforeach
                                {{-- @php
                                    $permissions = DB::table('users_permissions')
                                        ->join('permissions', 'users_permissions.permission_id', '=', 'permissions.id')
                                        ->select('permissions.name as permission_name')
                                        ->where('users_permissions.user_id', $users_permission->user_id)
                                        ->get();

                                    $permission_names = [];
                                    foreach ($permissions as $permission) {
                                        $permission_names[] = $permission->permission_name;
                                    }
                                    $permission_string = implode(', ', $permission_names);
                                @endphp --}}
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
        var data = {!! json_encode($users_permissions) !!};
        let html = "";
        // data.forEach(e => {
        //     html += `${e.permission_id}

    //                         <tr>
    //                             <td>
    //                                 <div class="form-check check-tables">
    //                                     <input class="form-check-input d-block " type="checkbox" value="something" />
    //                                 </div>
    //                             </td>
    //                             <td>
    //                                 ${e.permission_id}
    //                             </td>
    //                             <td>
    //                                 ${e.user_id}
    //                             </td>
    //                             <td>
    //                                 <a href="" class="btn btn-sm btn-success">
    //                                     <i class="fa fa-eye text-white "></i>
    //                                 </a>
    //                             </td>

    //                         </tr>
    //     `;
        //     console.log("HTML:", html);
        //  });
        // var users = {!! json_encode($users) !!}
        // const roleMsg = (msg = "Would You Like To Give Role & Permission to  /${user}? ") => {
        //     return prompt(msg) == 'yes';
        //     console.log(role);
        // }
        const roleMsg = () => {
            const selectElement = document.getElementById("user_id");
            const selectedUserName = selectElement.options[selectElement.selectedIndex].text;
            console.log(selectedUserName);
            const msg = `Would you like to give role & permission to ${selectedUserName}?`;
            return prompt(msg) === 'yes';
        };
        $(document).ready(function() {
            $('.select2').select2();
        });P
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                 "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
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
