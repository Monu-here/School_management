@extends('Admin.layout.app')
@section('content')
    <div class="container">
        <div class="content">
            <form action="{{ route('admin.assign.permission.to.role') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <label for="user">Choose Role</label>
                                <select name="role_id" id="role_id" class="form-control">
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
                                <select name="permission_id" id="permission_id" class="form-control">
                                    <option value="null" selected disabled>Select Permission</option>
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

    </div>
@endsection
