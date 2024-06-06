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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form action="{{ route('admin.student.studentShow', ['student' => $student->id]) }}" method="POST" --}}
                    {{-- enctype="multipart/form-data">  --}}
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h5 class="form-title"><span>Student Information</span></h5>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group local-forms">
                                <label>Image <span class="login-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control photo"
                                    accept="image/*" data-default-file={{ asset($student->image) }}>

                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Symbol No<span class="login-danger">*</span></label>
                                        <input type="number" id="formControlLg" class="form-control" name="idno"
                                            value="{{ $student->idno }}" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input type="text" id="formControlLg" class="form-control" name="name"
                                            value="{{ $student->name }}" />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span></label>
                                        <input type="hidden" name="gender_hidden"
                                            value="{{ old('gender', $student->gender) }}">
                                        <select class="form-control" name="gender">
                                            <option value="male" {{ old('gender_hidden') == 'Male' ? 'selected' : '' }}>
                                                Male
                                            </option>
                                            <option value="female" {{ old('gender_hidden') == 'Female' ? 'selected' : '' }}>
                                                Female
                                            </option>
                                            <option value="other" {{ old('gender_hidden') == 'Other' ? 'selected' : '' }}>
                                                Other
                                            </option>
                                        </select>



                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date Of Birth <span class="login-danger">*</span></label>
                                        <input type="date" class="form-control" name="dob"
                                            value="{{ $student->dob }}">
                                    </div>
                                </div>


                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Semester <span class="login-danger">*</span></label>

                                        <input type="text" name="class_id" id=""
                                            value="{{ $student->classes->name }}" class="form-control">

                                    </div>
                                </div>




                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Section <span class="login-danger">*</span></label>
                                        @php
                                            $sectionName = $sections
                                                ->where('id', $student->section_id)
                                                ->pluck('name')
                                                ->first();
                                        @endphp
                                        <input type="text" class="form-control" name="section"
                                            value=" {{ $sectionName ?? 'N/A' }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Blood Group <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="blood_id"
                                            value="{{ $student->blood->name }}">

                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger"></span></label>
                                        <input type="number" class="form-control" name="number"
                                            value="{{ $student->user->number }}">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $student->address }}">
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

                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Name<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="f_name" value="{{ $student->f_name }}" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Phone Number<span class="login-danger">*</span></label>
                                                <input type="number" id="formControlLg" class="form-control"
                                                    name="f_no" value="{{ $student->f_no }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Parent Email<span class="login-danger"></span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="parent_email" value="{{ $student->parent_email }}" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Mother Name<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="m_name" value="{{ $student->m_name }}">
                                            </div>
                                        </div>


                                    </div>
                                </div>




                                <div class="d-flex justify-content-between">
                                    <div class="student-submit">
                                        <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                                    </div>
                                    <form
                                        action="{{ route('admin.mark.admin.mark.email', ['sendMail' => $student->id]) }}"
                                        method="POST" id="formSubmit">
                                        @csrf
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Send Marksheet
                                            to
                                            Student</button>
                                    </form>

                                    <a href="{{ route('admin.mark.admin.marksheet', $student->id) }}"
                                        class="btn btn-primary text-white">Show
                                        Marksheet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}


                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

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
        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            var saveBtn = document.getElementById('saveBtn');
            saveBtn. = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                alert('Marksheet has send to parent');
                event.target.submit();
            }, 5000);
        });
    </script>
@endsection
