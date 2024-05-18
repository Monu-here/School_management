@extends('Admin.layout.app')
@section('content')
    <div class="container">
        <div class="content">
            <form action="{{ route('admin.role-permission.assignPerRole') }}" method="POST">
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
                                    <option value="null"   disabled>Select Permission</option>
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary ">Assign Permission to Role</button>
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
                                    <th>Role </th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                    <th class="d-none">Created day</th>

                                </tr>
                            </thead>
                            <br><br>

                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div id="new"></div>
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
        
        data.forEach(e => {
            html += `${e.role_id}`
        });
        $('#new').append(html);
        console.log(data.length);
        console.log(data);
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
