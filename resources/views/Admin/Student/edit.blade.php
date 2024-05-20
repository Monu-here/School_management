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
@section('linkbar')
    <ul class="breadcrumb ms-3">
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}" style="text-decoration: none">Student</a></li>
        <li class="breadcrumb-item active">Add Student</li>
    </ul>
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
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.student.edit', ['student' => $student->id]) }}" id="formSubmit"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Student Information</span></h5>
                            </div>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group local-forms">
                                    <input required type="file" name="image" id="image" class="form-control photo"
                                        accept="image/*" data-default-file={{ asset($student->image) }}>
                                    <br>
                                    <label>Father Image <span class="login-danger">*</span></label>
                                    <input required type="file" class="form-control photo" name="f_image"
                                        accept="image/*"data-default-file={{ asset($student->f_image) }}>
                                    <br>
                                    <label>Student Image <span class="login-danger">*</span></label>

                                    <input required type="file" class="form-control photo" name="m_image"
                                        accept="image/*" data-default-file={{ asset($student->m_image) }}>
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <br>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="symbool">Symbol No</label>
                                            <input required type="number" class="form-control" name="idno"
                                                outline="hidden" value="{{ $student->idno }}" />
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $student->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option disabled>Select Gender</option>
                                                <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female"
                                                    {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control" id="dob" name="dob"
                                                value="{{ $student->dob }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Roll No <span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" id="roll" name="roll"
                                                value="{{ $student->roll }}" required>
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
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select class="form-control" id="reli" name="reli"
                                                value="{{ old('reli') }}">
                                                <option selected disabled>Select Gender</option>
                                                <option value="hindu" {{ $student->reli == 'hindu' ? 'selected' : '' }}>
                                                    Hindu
                                                </option>
                                                <option
                                                    value="Christian"{{ $student->reli == 'Christian' ? 'selected' : '' }}>
                                                    Christian</option>
                                                <option value="other"{{ $student->reli == 'other' ? 'selected' : '' }}>
                                                    Other</option>
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
                                            <label>Blood Group <span class="login-danger">*</span></label>
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
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger"></span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $student->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone Number <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="number" name="number" value="{{ $student->number }}">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $student->address }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Admit Year <span class="login-danger"></span></label>
                                            <select id="yearDropdown" name="session_year" class="form-control">
                                                <option selected disabled>Select Session Year</option>
                                                @for ($year = date('Y'); $year >= 2000; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ $student->session_year == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>


                                        </div>
                                    </div>
                                    <hr style="border-top: 1px dashed #8c8b8b">
                                    <p class="form-title text-start"><span><u>Parent Information</u> </span></p>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father's Name<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="f_name" name="f_name"
                                                value="{{ $student->f_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father's Occupation<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="f_occ" name="f_occ"
                                                value="{{ $student->f_occ }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Phone Number<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="f_no" name="f_no" value="{{ $student->f_no }}" required>

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            {{-- //////////  --}}
                                            <label>Father Email<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="parent_email" Email value="{{ $student->parent_email }}" />
                                            {{-- ////////////  --}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Name<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="m_name" name="m_name"
                                                value="{{ $student->m_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Occupation<span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="m_occ" name="m_occ"
                                                value="{{ $student->m_occ }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Phone Number<span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="m_no" name="m_no" value="{{ $student->m_no }}" required>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" id="saveBtn">Update</button>
                        <a href="{{route('admin.student.index')}}" class="btn btn-danger">Cancle</a>
                    </form>
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
            function populateYearDropdown() {
                var currentYear = new Date().getFullYear();
                var dropdown = document.getElementById("yearDropdown");

                for (var year = 2000; year <= currentYear; year++) {
                    var option = document.createElement("option");
                    option.value = year;
                    option.text = year;
                    dropdown.add(option);
                }
            }

            populateYearDropdown();

            setInterval(function() {
                var currentYear = new Date().getFullYear();
                var dropdown = document.getElementById("yearDropdown");

                if (parseInt(dropdown.options[dropdown.options.length - 1].value) < currentYear) {
                    dropdown.options.length = 0;

                    populateYearDropdown();
                }
            }, 5000);

            const Msg = (msg = "Would you like to submit this student form  ? ") => {
                return prompt(msg) == 'yes';
                console.log(Msg);
            }
             
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
