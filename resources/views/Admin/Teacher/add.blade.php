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
                        <li class="breadcrumb-item"><a href="{{ route('admin.teacher.teacherIndex') }}">List</a></li>
                        <li class="breadcrumb-item active">Add Teacher </li>
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
            <div class=" ">
                <div class="">
                    <form action="{{ route('admin.teacher.teacheradd') }}" id="formSubmit" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <marquee behavior="smooth" direction="left">Here Class and Section will Assign which
                                        show in
                                        teacher dashboard which student is belong to that assign class</marquee>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Teacher Information</span></h5>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <br>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label for="name">Name <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ old('name') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select class="form-control" id="gender" name="gender"
                                                        value="{{ old('gender') }}">
                                                        <option selected disabled>Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female
                                                        </option>
                                                        <option value="other">
                                                            Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Working Hours <span class="login-danger">*</span></label>
                                                    <select class="form-control" id="workinghrs" name="workinghrs"
                                                        value="{{ old('workinghrs') }}">
                                                        <option selected disabled>Select Working Hours</option>
                                                        <option value="Part-time">Part Time</option>
                                                        <option value="Full-time">Full Time
                                                        </option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input type="date" class="form-control" id="dob" name="dob"
                                                        value="{{ old('dob') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                        id="number" name="number" value="{{ old('number') }}">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="{{ old('address') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Joinign Date <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" id="jd" name="jd"
                                                        value="{{ old('jd') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Experience <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" id="exp"
                                                        name="exp" value="{{ old('exp') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Qualification <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" id="qual"
                                                        name="qual" value="{{ old('qual') }}" required>
                                                </div>
                                            </div>



                                            <div class="col-12 col-sm-2">
                                                <div class="form-group local-forms">
                                                    <label>Assign faculty <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="faculity_id[]" id="faculty">
                                                        <option value="" disabled selected>Select Faculty</option>
                                                        @foreach ($facts as $fact)
                                                            <option value="{{ $fact->id }}"
                                                                {{ old('faculity_id') == $fact->id ? 'selected' : '' }}>
                                                                {{ $fact->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <button type="button" class="btn btn-success" id="addFaculty">Add
                                                        More
                                                        Faculty</button>
                                                    <input type="hidden" name="faculity_id" id="hiddenFaculty"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-2">
                                                <div class="form-group local-forms">
                                                    <label>Assign Semester <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="class_id[]" id="class">
                                                        <option value="" selected disabled>Select Semester</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}"
                                                                {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <button type="button" class="btn btn-success" id="addclass">Add
                                                        More
                                                        Class</button>
                                                    <input type="hidden" name="class_id" id="hiddenclass"
                                                        value="">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-2" id="userFieldsContainer">
                                                <div class="form-group local-forms">
                                                    <label>Section <span class="login-danger">*</span></label>
                                                    <select class="form-control" name="section_id[]" id="new">
                                                        <option value="" selected disabled>Select Section</option>
                                                        @foreach ($sections as $section)
                                                            <option value="{{ $section->id }}"
                                                                {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                                {{ $section->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <button type="button" class="btn btn-success" id="addUser">Add
                                                        More
                                                        Section</button>
                                                    <input type="hidden" name="section_id" id="hiddensection"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>User Information</span></h5>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>UesrName <span class="login-danger">*</span></label>
                                                    <input type="text" id="formControlLg" class="form-control"
                                                        name="name" />
                                                </div>
                                            </div>
                                            {{-- <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger">*</span></label>
                                                    <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                        id="number" name="number" value="{{ old('number') }}"
                                                        required>
                                                </div>
                                            </div> --}}
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ old('email') }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Password <span class="login-danger">*</span></label>
                                                    <div class="password-container">
                                                        <input type="password" class="form-control" id="password-input"
                                                            name="password" required>
                                                        <i class="fas fa-eye password-toggle" id="password-toggle"
                                                            onclick="togglePasswordVisibility()"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1" id="">
                                                <span>Assign Faculity</span>
                                                <ul id="selectedFacultyList"></ul>
                                            </div>
                                            <div class="col-md-1" id="">
                                                <span>Assign Semester</span>
                                                <ul id="selectedClassList"></ul>
                                            </div>
                                            <div class="col-md-1" id="">
                                                <span>Assign Section</span>
                                                <ul id="selectedSubList"></ul>

                                            </div>


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
                                    {{-- <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>User Login Image <span class="login-danger">*</span></label>
                                            <input type="file" class="form-control photo" name="images"
                                                accept="image/*">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Teacher Image <span class="login-danger">*</span></label>

                                            <input required type="file" name="image" id="image"
                                                class="form-control photo" accept="image/*">


                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group local-forms">

                                            <label>Teacher Cv <span class="login-danger">*</span></label>

                                            <input required type="file" class="form-control photo" name="cv"
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary" onclick="Msg()"
                                            id="saveBtn">Submit</button>
                                        <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                                    </div>
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
    {{-- <script>
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


    </script> --}}
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
        const Msg = (msg = "Would you like to submit this student form  ? ") => {
            return prompt(msg) == 'yes';
            console.log(Msg);
        }
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
            var selectedSubjects = [];

            $('#addclass').on('click', function() {
                var selectedOption = $('#class option:selected');
                var selectedValue = selectedOption.val();
                var selectedText = selectedOption.text();
                if (selectedValue && !selectedSubjects.some(e => e.id === selectedValue)) {
                    selectedSubjects.push({
                        id: selectedValue,
                        name: selectedText
                    });
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedClassList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedClassList').append('<li>' + subject.name + '</li>');
                });

                var cleanString = JSON.stringify(selectedSubjects.map(subject => subject.id)).replace(/["'\\[\]]/g,
                    '');
                $('#hiddenclass').val(cleanString);
            }
        });








        $(document).ready(function() {
            var selectedSubjects = [];

            $('#addUser').on('click', function() {
                var selectedOption = $('#new option:selected');
                var selectedValue = selectedOption.val();
                var selectedText = selectedOption.text();
                if (selectedValue && !selectedSubjects.some(e => e.id === selectedValue)) {
                    selectedSubjects.push({
                        id: selectedValue,
                        name: selectedText
                    });
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedSubList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedSubList').append('<li>' + subject.name + '</li>');
                });

                var cleanString = JSON.stringify(selectedSubjects.map(subject => subject.id)).replace(/["'\\[\]]/g,
                    '');
                $('#hiddensection').val(cleanString);
            }
        });






        $(document).ready(function() {
            var selectedSubjects = [];

            $('#addFaculty').on('click', function() {
                var selectedOption = $('#faculty option:selected');
                var selectedValue = selectedOption.val();
                var selectedText = selectedOption.text();
                if (selectedValue && !selectedSubjects.some(e => e.id === selectedValue)) {
                    selectedSubjects.push({
                        id: selectedValue,
                        name: selectedText
                    });
                    updateSelectedSubjectsList();
                }
            });

            function updateSelectedSubjectsList() {
                $('#selectedFacultyList').empty();
                selectedSubjects.forEach(function(subject) {
                    $('#selectedFacultyList').append('<li>' + subject.name + '</li>');
                });

                var cleanString = JSON.stringify(selectedSubjects.map(subject => subject.id)).replace(/["'\\[\]]/g,
                    '');
                $('#hiddenFaculty').val(cleanString);
            }
        });
    </script>
@endsection
