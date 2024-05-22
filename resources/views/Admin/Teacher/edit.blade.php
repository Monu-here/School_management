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
                    <h3 class="page-title">Teachers</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Edit</a></li>
                        <li class="breadcrumb-item active">Teacher / {{ $teacher->id }}</li>
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
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.teacher.teacheredit', ['teacher' => $teacher->id]) }}" id="formSubmit"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <marquee behavior="smooth" direction="left">Here Class and Section will Assign which show in
                                teacher dashboard which student is belong to that assign class</marquee>
                            <div class="col-12">
                                <h5 class="form-title"><span>Teacher Information</span></h5>
                            </div>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group local-forms">
                                    <label>Image <span class="login-danger">*</span></label>

                                    <input required type="file" name="image" id="image" class="form-control photo"
                                        accept="image/*" data-default-file={{ asset($teacher->image) }}>
                                    <br>
                                    <input required type="file" class="form-control photo" name="cv"
                                        accept="image/*" data-default-file={{ asset($teacher->cv) }}>
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <br>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $teacher->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control" id="gender" name="gender"
                                                value="{{ old('gender') }}">
                                                <option selected disabled>Select Gender</option>
                                                <option value="male" {{ $teacher->gender == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female" {{ $teacher->gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ $teacher->gender == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Working Hours <span class="login-danger">*</span></label>
                                            <select class="form-control" id="workinghrs" name="workinghrs"
                                                value="{{ old('workinghrs') }}">
                                                <option selected disabled>Select Working Hours</option>
                                                <option value="Part-time"
                                                    {{ $teacher->workinghrs == 'Part-time' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="Full-time"
                                                    {{ $teacher->workinghrs == 'Full-time' ? 'selected' : '' }}>
                                                    Female</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 ">
                                        <div class="form-group local-forms">
                                            <label>Class Assign <span class="login-danger">*</span></label>
                                            <select class="form-control" name="class_id[]" id="class">
                                                <option selected disabled>Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ collect(old('class_id'))->contains($class->id) ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <button type="button" class="btn btn-success" id="addclass">Add
                                                More Class</button>
                                            <input type="hidden" name="class_id" id="hiddenclass" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4" id="userFieldsContainer">
                                        <div class="form-group local-forms">
                                            <label>Section <span class="login-danger">*</span></label>
                                            <select class="form-control" name="section_id[] " id="new">
                                                <option selected disabled>Select Section</option>

                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}"
                                                        {{ collect(old('section_id'))->contains($section->id) ? 'selected' : '' }}>
                                                        {{ $section->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <br>
                                            <button type="button" class="btn btn-success" id="addUser">Add
                                                More Section</button>
                                            <input type="hidden" name="section_id" id="hiddensection" value="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control" id="dob" name="dob"
                                                value="{{ $teacher->dob }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger"></span></label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $teacher->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone Number <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                id="number" name="number" value="{{ $teacher->number }}">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $teacher->address }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Joinign Date <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="jd" name="jd"
                                                value="{{ $teacher->jd }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Experience <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="exp" name="exp"
                                                value="{{ $teacher->exp }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Qualification <span class="login-danger"></span></label>
                                            <input type="text" class="form-control" id="qual" name="qual"
                                                value="{{ $teacher->qual }}" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Teacher Login Details</span></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Image <span class="login-danger">*</span></label>
                                            <input type="file" class="form-control photo" name="images"
                                                accept="image/*">
                                        </div>

                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>UesrName <span class="login-danger">*</span></label>
                                                    <input type="text" id="formControlLg" class="form-control"
                                                        name="name" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                        id="number" name="number" value="{{ old('number') }}"
                                                        required>


                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ old('email') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Password <span class="login-danger">*</span></label>
                                                    <div class="password-container">
                                                        <input type="password" class="form-control"id="password-input"
                                                            name="password" required>
                                                        <i class="fas fa-eye password-toggle" id="password-toggle"
                                                            onclick="togglePasswordVisibility()"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div> --}}
                        <div class="col-3" id="selectedClassListContainer">
                            <label for="">New Class Assign</label>
                            <li id="selectedClassList"></li>
                        </div>
                        <div class="col-3" id="selectedSubListContainer">
                            <label for="">New Subject Assign</label>
                            <li id="selectedSubList"></li>
                        </div>
                        <div class="col-3" id="selectedClassListContainer">
                            <label for="">Selected Class</label>
                            <li id=" ">
                                {!! htmlspecialchars(str_replace(['"', "'", '\\', '[', ']'], '', $teacher->class_id)) !!}
                            </li>
                        </div>
                        <div class="col-3" id="selectedSubListContainer">
                            <label for="">Selected Subject</label>
                            <li id=" ">

                                {!! htmlspecialchars(str_replace(['"', "'", '\\', '[', ']'], '', $teacher->section->name)) !!}

                            </li>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="edit()" id="saveBtn">Update</button>
                        <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // var data = {!! json_encode($teacher) !!};

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
    <script>
        $(document).ready(function() {
            $('#addclass').on('click', function() {
                var selectedValue = $('#class option:selected').val();
                if (selectedValue) {
                    $('#selectedClassList').append('<li>' + selectedValue + '</li>');
                }
            });
        });
        $(document).ready(function() {
            var selectedSubjects = [];

            $('#addclass').on('click', function() {
                var selectedValue = $('#class option:selected').val();
                if (selectedValue) {
                    selectedSubjects.push(selectedValue);
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedClassList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedClassList').append('<li>' + subject + '</li>');
                });

                var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
                cleanString = cleanString.replace(/["'\\]/g,
                    '');
                $('#hiddenclass').val(cleanString);
            }
        });
        $(document).ready(function() {
            $('#addUser').on('click', function() {
                var selectedValue = $('#new option:selected').val();
                if (selectedValue) {
                    $('#selectedSubList').append('<li>' + selectedValue + '</li>');
                }
            });
        });
        $(document).ready(function() {
            var selectedSubjects = [];

            $('#addUser').on('click', function() {
                var selectedValue = $('#new option:selected').val();
                if (selectedValue) {
                    selectedSubjects.push(selectedValue);
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedSubList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedSubList').append('<li>' + subject + '</li>');
                });

                var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
                cleanString = cleanString.replace(/["'\\]/g,
                    '');
                $('#hiddensection').val(cleanString);
            }
        });
    </script>
@endsection
