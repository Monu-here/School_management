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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.student.add') }}" id="form1" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <marquee>Id no will be auto generate</marquee>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Student Information</span></h5>
                            </div>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group local-forms">
                                    <label>Student Image <span class="login-danger">*</span></label>
                                    <input required type="file" name="image" id="image" class="form-control photo"
                                        accept="image/*">
                                    <br>

                                    <label>Father Image <span class="login-danger">*</span></label>
                                    <input required type="file" class="form-control photo" name="f_image"
                                        placeholder="Enter Image" accept="image/*">
                                    <br>
                                    <label>Student Image <span class="login-danger">*</span></label>

                                    <input required type="file" class="form-control photo" name="m_image"
                                        placeholder="Enter Image" accept="image/*">
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <br>
                                    <div class="col-12 col-sm-4" hidden>
                                        <div class="form-group local-forms">
                                            <label>ID No<span class="login-danger">*</span></label>
                                            <input required type="number" id="formControlLg" class="form-control" readonly
                                                name="idno" value="{{ isset($idno) ? $idno : '' }}"
                                                placeholder="Autogenerate ID No" outline="hidden" hidden />
                                        </div>

                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
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
                                            <input required type="date" class="form-control" name="dob"
                                                placeholder="Enter Date of Birth">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Roll No <span class="login-danger">*</span></label>
                                            <input required type="number" class="form-control" name="roll"
                                                placeholder="Enter Roll No">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control" name="class_id">
                                                <option selected disabled>Select Class</option>
                                                @foreach ($classes as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select class="form-control" name="reli">
                                                <option selected disabled>Select Gender</option>
                                                <option value="hindu">Hindu</option>
                                                <option value="Christian">Christian</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Section <span class="login-danger">*</span></label>
                                            <select class="form-control" name="section_id">
                                                <option selected disabled>Select Section</option>

                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}
                                                    </option>
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
                                                    <option value="{{ $blood->id }}">{{ $blood->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger"></span></label>
                                            <input required type="email" class="form-control" name="email"
                                                placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone Number <span class="login-danger"></span></label>
                                            <input required type="number" class="form-control" name="number"
                                                placeholder="Enter Number">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address <span class="login-danger"></span></label>
                                            <input required type="text" class="form-control" name="address"
                                                placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Admit Year <span class="login-danger"></span></label>
                                            <select id="yearDropdown" name="session_year" class="form-control"></select>

                                        </div>
                                    </div>
                                    <hr style="border-top: 1px dashed #8c8b8b">
                                    <p class="form-title text-start"><span><u>Parent Information</u> </span></p>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Name<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="f_name" placeholder="Enter Father Name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Occuptaion<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="f_occ" placeholder="Enter Father Occuption" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Phone Number<span class="login-danger">*</span></label>
                                            <input required type="number" id="formControlLg" class="form-control"
                                                name="f_no" placeholder="Enter Father Phone Number" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Father Email<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="parent_email" placeholder="Enter Father Email" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Name<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="m_name" placeholder="Enter Mother Name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Occuptaion<span class="login-danger">*</span></label>
                                            <input required type="text" id="formControlLg" class="form-control"
                                                name="m_occ" placeholder="Enter Mother Occuption" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mother Phone Number<span class="login-danger">*</span></label>
                                            <input required type="number" id="formControlLg" class="form-control"
                                                name="m_no" placeholder="Enter Mother Phone Number" />
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.add') }}" id="form2" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title"><span>Student Login Details</span></h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group local-forms">
                                    <label>Image <span class="login-danger">*</span></label>
                                    <input type="file" class="form-control photo" name="image"
                                        placeholder="Enter Image" accept="image/*">
                                </div>

                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input type="text" id="formControlLg" class="form-control"
                                                name="name" placeholder="Enter Name" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone Number <span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" name="number"
                                                placeholder="Enter Number">

                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Role <span class="login-danger">*</span></label>
                                            <select class="form-control" name="role_name">
                                                <option selected disabled>Select Role</option>
                                                @role('SuperAdmin')
                                                    <option value="Admin">Admin</option>
                                                @endrole()
                                                <option value="Teacher">Teacher
                                                </option>
                                                <option value="Student">
                                                    Student</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Password <span class="login-danger">*</span></label>
                                            <div class="password-container">
                                                <input type="password" class="form-control" name="password"
                                                    id="password-input" placeholder="Enter Password">
                                                <i class="fas fa-eye password-toggle" id="password-toggle"
                                                    onclick="togglePasswordVisibility()"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="student-submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById("submitBtn").addEventListener("click", function(event) {
            event.preventDefault();

            // Submit both forms
            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");

            // Submit Form 1
            var formData1 = new FormData(form1);
            fetch(form1.action, {
                    method: 'POST',
                    body: formData1
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log("Form 1 submitted successfully");
                    return response.text();
                })
                .catch(error => {
                    console.error("Error submitting Form 1:", error);
                });

            // Submit Form 2
            var formData2 = new FormData(form2);
            fetch(form2.action, {
                    method: 'POST',
                    body: formData2
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log("Form 2 submitted successfully");
                    return response.text();
                })
                .then(data => {
                    console.log("Form 2 submission response:", data);
                    alert("Forms submitted successfully");

                    location.reload(); // Reload the page
                })
                .catch(error => {
                    console.error("Error submitting Form 2:", error);
                });
        });
    </script>









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
    <script>
        // Function to populate the year dropdown from 2000 to the current year
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

        // Call the function to populate the dropdown on page load
        populateYearDropdown();

        // Optionally, you can update the dropdown dynamically if the current year changes
        setInterval(function() {
            var currentYear = new Date().getFullYear();
            var dropdown = document.getElementById("yearDropdown");

            // Check if the last year in the dropdown is less than the current year
            if (parseInt(dropdown.options[dropdown.options.length - 1].value) < currentYear) {
                // Clear the current dropdown options
                dropdown.options.length = 0;

                // Repopulate the dropdown with updated years
                populateYearDropdown();
            }
        }, 5000); // Update every 1000 milliseconds (1 second)
    </script>
@endsection
