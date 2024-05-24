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
            <div class=" ">
                <div class="">
                    <form action="{{ route('admin.teacher.teacheredit', ['teacher' => $teacher->id]) }}" id="formSubmit"
                        method="POST" enctype="multipart/form-data">
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
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $teacher->name }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Gender <span class="login-danger">*</span></label>
                                                    <select class="form-control" id="gender" name="gender"
                                                        value="{{ old('gender') }}">
                                                        <option selected disabled>Select Gender</option>
                                                        <option value="male"
                                                            {{ $teacher->gender == 'male' ? 'selected' : '' }}>
                                                            Male</option>
                                                        <option value="female"
                                                            {{ $teacher->gender == 'female' ? 'selected' : '' }}>
                                                            Female</option>
                                                        <option value="other"
                                                            {{ $teacher->gender == 'other' ? 'selected' : '' }}>
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
                                                        <option value="Part-time"
                                                            {{ $teacher->workinghrs == 'Part-time' ? 'selected' : '' }}>
                                                            Male</option>
                                                        <option value="Full-time"
                                                            {{ $teacher->workinghrs == 'Full-time' ? 'selected' : '' }}>
                                                            Female</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input type="date" class="form-control" id="dob" name="dob"
                                                        value="{{ $teacher->dob }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Email <span class="login-danger"></span></label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ $teacher->email }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Phone Number <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                                        id="number" name="number" value="{{ $teacher->number }}">

                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="{{ $teacher->address }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Joinign Date <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" id="jd" name="jd"
                                                        value="{{ $teacher->jd }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Experience <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" id="exp"
                                                        name="exp" value="{{ $teacher->exp }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-3">
                                                <div class="form-group local-forms">
                                                    <label>Qualification <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" id="qual"
                                                        name="qual" value="{{ $teacher->qual }}" required>
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
                                                        <option value="" selected disabled>Select Class</option>
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
                                <div class="col-md-1" id="">
                                    <span>Assign Faculity</span>
                                    <ul id="selectedFacultyList"></ul>
                                </div>
                                <div class="col-md-2" id="">
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


                        {{-- <div class="col-3" id="selectedClassListContainer">
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
                        </div> --}}
                        <button type="submit" class="btn btn-primary" onclick="edit()" id="saveBtn">Update</button>
                        <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p id="new"></p>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.photo').dropify();



        });
    </script>
    <script>
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
