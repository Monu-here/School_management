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
                    <form action="{{ route('admin.role-permission.editRole',['role'=>$role->id]) }}" method="POST">
                        @csrf
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$role->name}}" required>
                        <button class="btn btn-primary mt-3 ">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
