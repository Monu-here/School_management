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
                            <form action="{{ route('admin.student.studentShow', ['student' => $student->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Student Information</span></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Image <span class="login-danger">*</span></label>
                                            <input type="file" name="image" id="image" class="form-control photo"
                                                accept="image/*"  data-default-file={{ asset($student->image) }} >

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
                                                        name="idno" placeholder="Enter ID No"
                                                        value="{{ $student->idno }}" disabled />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Name <span class="login-danger">*</span></label>
                                                    <input type="text" id="formControlLg" class="form-control"
                                                        name="name" placeholder="Enter Name" value="{{ $student->name }}"
                                                        disabled />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <input type="hidden" name="gender_hidden"
                                                        value="{{ old('gender', $student->gender) }}">
                                                    <select class="form-control" name="gender" disabled>
                                                        <option value="male"
                                                            {{ old('gender_hidden') == 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="female"
                                                            {{ old('gender_hidden') == 'Female' ? 'selected' : '' }}>Female
                                                        </option>
                                                        <option value="other"
                                                            {{ old('gender_hidden') == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>



                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input type="date" class="form-control" name="dob"
                                                        placeholder="Enter Date of Birth" value="{{ $student->dob }}"
                                                        disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Roll No <span class="login-danger">*</span></label>
                                                    <input type="number" class="form-control" name="roll"
                                                        placeholder="Enter Roll No" value="{{ $student->roll }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Class <span class="login-danger">*</span></label>

                                                    <input type="text" name="class_id" id=""
                                                        value="{{ $student->classes->name }}" class="form-control" disabled>

                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Religion <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="reli" value="{{$student->reli}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Section <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="section" value="{{$student->section}}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Blood Group <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" name="blood_id" value="{{$student->blood->name}}" disabled>

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger"></span></label>
                                                    <input type="email" class="form-control" name="email"
                                                        placeholder="Enter Email" value="{{ $student->email }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger"></span></label>
                                                    <input type="number" class="form-control" name="number"
                                                        placeholder="Enter Number" value="{{ $student->number }}"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Enter Address"value="{{ $student->address }}"
                                                        disabled>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="student-submit">
                                                    <a href="{{route('admin.student.index')}}" class="btn btn-danger">Cancle</a>
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
