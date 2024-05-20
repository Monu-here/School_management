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

                                {{-- <input type="file" class="form-control photo" name="image"
                                                placeholder="Enter Image" accept="image/*"> --}}
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>ID No<span class="login-danger">*</span></label>
                                        <input type="number" id="formControlLg" class="form-control" name="idno"
                                            placeholder="Enter ID No" value="{{ $student->idno }}" disabled />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Name <span class="login-danger">*</span></label>
                                        <input type="text" id="formControlLg" class="form-control" name="name"
                                            placeholder="Enter Name" value="{{ $student->name }}" disabled />
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span></label>
                                        <input type="hidden" name="gender_hidden"
                                            value="{{ old('gender', $student->gender) }}">
                                        <select class="form-control" name="gender" disabled>
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
                                            placeholder="Enter Date of Birth" value="{{ $student->dob }}" disabled>
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
                                        <input type="text" class="form-control" name="reli"
                                            value="{{ $student->reli }}" disabled>
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
                                            value=" {{ $sectionName ?? 'N/A' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Blood Group <span class="login-danger">*</span></label>
                                        <input type="text" class="form-control" name="blood_id"
                                            value="{{ $student->blood->name }}" disabled>

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
                                            placeholder="Enter Number" value="{{ $student->number }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" name="address"
                                            placeholder="Enter Address"value="{{ $student->address }}" disabled>
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
                                        <input type="file" name="f_image" id="image" class="form-control photo"
                                            accept="image/*" data-default-file={{ asset($student->f_image) }}>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Name<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="f_name" placeholder="Enter Father Name"
                                                    value="{{ $student->f_name }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Occuptaion<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="f_occ" placeholder="Enter Father Occuption"
                                                    value="{{ $student->f_occ }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Phone Number<span class="login-danger">*</span></label>
                                                <input type="number" id="formControlLg" class="form-control"
                                                    name="f_no" placeholder="Enter Father Phone Number"
                                                    value="{{ $student->f_no }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Father Email<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="parent_email" placeholder="Enter Father Email"
                                                    value="{{ $student->parent_email }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Mother Name<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="m_name" placeholder="Enter Father Name"
                                                    value="{{ $student->m_name }}"disabled>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Mother Occuptaion<span class="login-danger">*</span></label>
                                                <input type="text" id="formControlLg" class="form-control"
                                                    name="m_occ" placeholder="Enter Father Occuption"
                                                    value="{{ $student->m_occ }}" disabled />
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Mother Phone Number<span class="login-danger">*</span></label>
                                                <input type="number" id="formControlLg" class="form-control"
                                                    name="m_no" placeholder="Enter Father Phone Number"
                                                    value="{{ $student->m_no }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group local-forms">
                                        <label>Mother Image <span class="login-danger">*</span></label>
                                        <input type="file" name="m_image" id="image" class="form-control photo"
                                            accept="image/*" data-default-file={{ asset($student->m_image) }}>
                                    </div>
                                </div>
                                 
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="student-submit">
                                            <a href="{{ route('admin.student.index') }}" class="btn btn-danger">Cancle</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <form
                                            action="{{ route('admin.mark.admin.mark.email', ['sendMail' => $student->id]) }}"
                                            method="POST" id="formSubmit">
                                            @csrf
                                            <button type="submit" class="btn btn-primary" id="saveBtn">Send Marksheet
                                                to
                                                Parent</button>
                                        </form>

                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('admin.mark.admin.marksheet', $student->id) }}"
                                            class="btn btn-primary text-white">Show
                                            Marksheet</a>
                                    </div>
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
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                alert('Marksheet has send to parent');
                event.target.submit();
            }, 5000);
        });
    </script>
@endsection
