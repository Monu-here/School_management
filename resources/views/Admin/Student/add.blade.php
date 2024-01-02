@extends('Admin.layout.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <style>
        .login-danger {
            color: red;
        }

        /* .password-container {
                            position: relative;
                        }

                        .password-toggle {
                            position: absolute;
                            right: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            cursor: pointer;
                        } */
    </style>
@endsection
@section('linkbar')
    <ul class="breadcrumb ms-3">
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}" style="text-decoration: none">Student</a></li>
        <li class="breadcrumb-item active">Add Student</li>
    </ul>
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.student.add') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Student Information</span></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Image <span class="login-danger">*</span></label>
                                            <input type="file" name="image" id="image" class="form-control photo"
                                                accept="image/*">

                                            {{-- <input type="file" class="form-control photo" name="image"
                                                placeholder="Enter Image" accept="image/*"> --}}
                                        </div>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>ID No<span class="login-danger">*</span></label>
                                                    <input type="number" id="formControlLg" class="form-control"
                                                        name="idno" placeholder="Enter ID No" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Name <span class="login-danger">*</span></label>
                                                    <input type="text" id="formControlLg" class="form-control"
                                                        name="name" placeholder="Enter Name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="gender">
                                                        <option selected disabled>Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female
                                                        </option>
                                                        <option value="other">
                                                            Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input type="date" class="form-control" name="dob"
                                                        placeholder="Enter Date of Birth">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Roll No <span class="login-danger">*</span></label>
                                                    <input type="number" class="form-control" name="roll"
                                                        placeholder="Enter Roll No">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class <span class="login-danger">*</span></label>
                                                    <input type="number" class="form-control" name="class"
                                                        placeholder="Enter Class">
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Religion <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="gender">
                                                        <option selected disabled>Select Gender</option>
                                                        <option value="hindu">Hindu</option>
                                                        <option value="Christian">Christian
                                                        </option>
                                                        <option value="other">
                                                            Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Section <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="section">
                                                        <option selected disabled>Select Section</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B
                                                        </option>
                                                        <option value="C">
                                                            C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger"></span></label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger"></span></label>
                                                    <input type="number" class="form-control" name="number"
                                                        placeholder="Enter Number">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="student-submit">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        </script> --}}
    {{-- @else
        <script>
            toastr.success('{{ $message }}');
        </script> --}}
    {{-- @endif --}}

    {{-- @include('Admin.tostar.index') --}}
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });

        // function togglePasswordVisibility() {
        //     var passwordInput = document.getElementById('password-input');
        //     var passwordToggle = document.getElementById('password-toggle');

        //     if (passwordInput.type === 'password') {
        //         passwordInput.type = 'text';
        //         passwordToggle.classList.remove('fa-eye');
        //         passwordToggle.classList.add('fa-eye-slash');
        //     } else {
        //         passwordInput.type = 'password';
        //         passwordToggle.classList.remove('fa-eye-slash');
        //         passwordToggle.classList.add('fa-eye');
        //     }
        // }
    </script>
@endsection
