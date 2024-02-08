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
                                    <hr>
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
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Address <span class="login-danger"></span></label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Enter Address">
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="form-group local-forms">
                                                    <label>Admit Year <span class="login-danger"></span></label>
                                                    <select id="yearDropdown" name="session_year"
                                                        class="form-control"></select>

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
                                            <div class="col-md-3">
                                                <div class="form-group local-forms">
                                                    <label>Father Image <span class="login-danger">*</span></label>
                                                    <input type="file" name="f_image" id="image"
                                                        class="form-control photo" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Father Name<span class="login-danger">*</span></label>
                                                            <input type="text" id="formControlLg" class="form-control"
                                                                name="f_name" placeholder="Enter Father Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Father Occuptaion<span
                                                                    class="login-danger">*</span></label>
                                                            <input type="text" id="formControlLg" class="form-control"
                                                                name="f_occ" placeholder="Enter Father Occuption" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Father Phone Number<span
                                                                    class="login-danger">*</span></label>
                                                            <input type="number" id="formControlLg" class="form-control"
                                                                name="f_no" placeholder="Enter Father Phone Number" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Father Email<span class="login-danger">*</span></label>
                                                            <input type="text" id="formControlLg" class="form-control"
                                                                name="parent_email" placeholder="Enter Father Email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Mother Name<span class="login-danger">*</span></label>
                                                            <input type="text" id="formControlLg" class="form-control"
                                                                name="m_name" placeholder="Enter Mother Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Mother Occuptaion<span
                                                                    class="login-danger">*</span></label>
                                                            <input type="text" id="formControlLg" class="form-control"
                                                                name="m_occ" placeholder="Enter Mother Occuption" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4">
                                                        <div class="form-group local-forms">
                                                            <label>Mother Phone Number<span
                                                                    class="login-danger">*</span></label>
                                                            <input type="number" id="formControlLg" class="form-control"
                                                                name="m_no" placeholder="Enter Mother Phone Number" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group local-forms">
                                                    <label>Mother Image <span class="login-danger">*</span></label>
                                                    <input type="file" name="m_image" id="image"
                                                        class="form-control photo" accept="image/*">
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
