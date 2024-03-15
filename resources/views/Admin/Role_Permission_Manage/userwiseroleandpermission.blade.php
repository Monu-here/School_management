@extends('Admin.layout.app')
@section('content')
    <div class="container">
        <form action="{{ route('admin.give.role') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="user">Choose User</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="null" selected disabled>Select User</option>

                                @foreach ($users as $user)
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
                            <select name="permission_id" id="permission_id" class="form-control" required>
                                <option value="null" selected disabled>Select Permission</option>

                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}" >{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary" onclick="return roleMsg()">Submit</button>
                        </div>
                    </div>
                </div>


            </div>
        </form>
        <div class="content">
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
                                <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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

                                @foreach ($users_permissions as $users_permission)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something" />
                                            </div>
                                        </td>

                                        <td>


                                        </td>
                                        <td>
                                            {{-- {{$users_permission->user->name}} --}}
                                            {{-- @php
                                                $sectionName = $users_permissions
                                                    ->where($users_permissions->user_id)
                                                    ->pluck('name')
                                                    ->first();
                                            @endphp
                                            {{ $sectionName ?? 'N/A' }} --}}

                                        </td>

                                        <td>
                                            <a href="" class="btn btn-sm btn-success">
                                                <i class="fa fa-eye text-white "></i>
                                            </a>


                                        </td>
                                        <td>
                                            test
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div id="hett"></div>
    </div>
@endsection
@section('js')
    <script>
        var data = {!! json_encode($users_permissions) !!};
        let html = "";
        data.forEach(e => {
            html += `${e.permission_id}`;
            console.log("HTML:", html);
            $('#hett').append(html);
        });
        var users = {!! json_encode($users) !!}
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
    </script>
@endsection
