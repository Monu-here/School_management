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
                    <h3 class="page-title">Permission</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Permission</a></li>
                        <li class="breadcrumb-item active">Permission Edit</li>
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
                    <form action="{{ route('admin.role-permission.editPermission', ['permission' => $permission->id]) }}"
                        method="POST" id="formSubmit">
                        @csrf
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $permission->name }}" required>
                        <button class="btn btn-primary mt-3 " id="saveBtn" ">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        const Msg = (msg = "Would you like to update the permission ? ") => {
            return prompt(msg) == 'yes';
            console.log(Msg);
        }
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
