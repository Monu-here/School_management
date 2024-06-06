@extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <style>
        .login-danger {
            color: red;
        }

        p {
            font-size: 10px;
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
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Student</a></li>
                        <li class="breadcrumb-item active">Edit / {{ $student->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <div class="">
                <div class="">
                    <form action="{{ route('admin.student.edit', ['student' => $student->id]) }}" id="formSubmit"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Student Information</span></h5>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="symbool">Symbol No <span class="login-danger">*</span> </label>
                                            <input type="number" class="form-control" name="idno" outline="hidden"
                                                value="{{ $student->idno }}" />
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="name">Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $student->name }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option disabled>Select Gender</option>
                                                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control" id="dob" name="dob"
                                                value="{{ $student->dob }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Faculity <span class="login-danger">*</span></label>
                                            <select class="form-control" name="faculity_id">
                                                <option selected disabled>Select Faculity</option>
                                                @foreach ($faculitys as $faculity)
                                                    <option value="{{ $faculity->id }}"
                                                        {{ $student->faculity_id == $faculity->id ? 'selected' : '' }}>
                                                        {{ $faculity->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control" name="class_id">
                                                <option selected disabled>Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ $student->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>



                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Section <span class="login-danger">*</span></label>
                                            <select class="form-control" name="section_id">
                                                <option selected disabled>Select Section</option>

                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ $student->section_id == $section->id ? 'selected' : '' }}>
                                                        {{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Blood Group </label>
                                            <select class="form-control" name="blood_id">
                                                <option selected disabled>Select Blood Group</option>
                                                @foreach ($bloods as $blood)
                                                    <option value="{{ $blood->id }}"
                                                        {{ $student->blood_id == $blood->id ? 'selected' : '' }}>
                                                        {{ $blood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger"></span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $student->email }}" >
                                        </div>
                                    </div> --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone Number <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="number" name="number" value="{{ $student->user->number }}">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $student->address }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Intake Year <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="session_year"
                                                id="session_year" value="{{ $student->session_year }}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Parent Information</span></h5>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father's Name<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="f_name" name="f_name"
                                                value="{{ $student->f_name }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Phone Number<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="f_no" name="f_no" value="{{ $student->f_no }}">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            {{-- //////////  --}}
                                            <label> Email<span class="login-danger"></span></label>
                                            <input type="text" id="formControlLg" class="form-control"
                                                name="parent_email" Email value="{{ $student->parent_email }}" />
                                            {{-- ////////////  --}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Name<span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="m_name" name="m_name"
                                                value="{{ $student->m_name }}">
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Image Section</span></h5>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <input type="file" name="image" id="image"
                                                class="form-control photo" accept="image/*"
                                                data-default-file={{ asset($student->image) }}>
                                            <label>Student Image <span class="login-danger">*</span></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Update</button>
                                    <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.photo').dropify();
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
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password-input');
            var passwordToggle = document.getElementById('password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }
    </script>
@endsection
