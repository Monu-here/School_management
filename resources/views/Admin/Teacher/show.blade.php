{{-- @extends('Admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/teacher.css') }}">
    <style>
        .red {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="mahi_holder">
        <div class="container">
            <div class="row bg_1">
                <h3 class="teacherh3"><i>Basic Information </i></h3>
                <div class="col-md-2">
                    <label for="Image">Image <span class="red">*</span></label>
                    <input class="effect-1 photo" type="file" placeholder="Enter Image " name="image"
                        data-default-file={{ asset($teacherData->image) }}>
                    <span class="focus-border"></span>
                    <br>
                    <label for="Image">CV <span class="red">*</span></label>
                    <input class="effect-1 photo" type="file" placeholder="Enter CV " name="cv"
                        data-default-file={{ asset($teacherData->cv) }}>
                    <span class="focus-border"></span>
                </div>
                <div class="col-md-10">
                    <div class="row">

                        <div class="col-3">
                            <label for="">Name <span class="red">*</span></label>
                            <input class="effect-3" type="text" placeholder="Enter Name " name="name"
                                value="{{ $teacherData->name }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="gender">Gender<span class="red">*</span></label>
                            <select name="gender" id="gender" class="form-control effect-3" disabled>
                                <option value="Male"
                                    {{ old('gender', $teacherData->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"
                                    {{ old('gender', $teacherData->gender) == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other"
                                    {{ old('gender', $teacherData->gender) == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            <span class="focus-border"></span>
                        </div>

                        <div class="col-3">
                            <label for=""> Date Of Birth <span class="red">*</span></label>
                            <input class="effect-3" type="text" placeholder="Enter Date of Birth" name="dob" readonly
                                value="{{ $teacherData->dob }}">
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for=""> Phone Number<span class="red">*</span></label>
                            <input class="effect-3" type="text" placeholder="Enter Phone Number" name="number"
                                value="{{ $teacherData->number }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Address <span class="red">*</span></label>

                            <input class="effect-3" type="text" placeholder="Enter Address" name="address"
                                value="{{ $teacherData->address }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Joining Date <span class="red">*</span></label>

                            <input class="effect-3" type="text" placeholder="Enter Joining date" name="jd"
                                value="{{ $teacherData->jd }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for=""> Experience <span class="red">*</span></label>

                            <input class="effect-3" type="text" placeholder="Enter Experience" name="exp"
                                value="{{ $teacherData->exp }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Email <span class="red">*</span></label>

                            <input class="effect-3" type="text" placeholder="Enter Email" name="email"
                                value="{{ $teacherData->email }}" readonly>
                            <span class="focus-border"></span>
                        </div>
                        <div class="col-3">
                            <label for="">Qualification <span class="red">*</span></label>

                            <input class="effect-3" type="text" placeholder="Enter Qualification " name="qual"
                                value="{{ $teacherData->qual }}" readonly>
                            <span class="focus-border">
                                <i></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-3" id="selectedSubListContainer">
                        <label for="">Selected Subjects</label>

                        <ul id="selectedSubList">
                            <li>
                                {!! htmlspecialchars(str_replace(['"', "'", '\\', '[', ']'], '', $teacherData->sub)) !!}
                            </li>
                        </ul>
                        <a href="{{ route('admin.teacher.teacherIndex') }}" class="btn btn-danger">Cancle</a>
                    </div>

                    <input type="hidden" name="sub" id="hiddenSub" value="">
                </div>
            </div>


        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });
    </script>
@endsection --}}
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
                        <li class="breadcrumb-item"><a href="{{route('admin.teacher.teacherIndex')}}">List</a></li>
                        <li class="breadcrumb-item active">Show Teacher / {{$teacherData->id}}      </li>
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

                    <div class="row">
                        <marquee behavior="smooth" direction="left">Here Class and Section will Assign which show in
                            teacher dashboard which student is belong to that assign class</marquee>
                        <div class="col-12">
                            <h5 class="form-title"><span>Teacher Information </span></h5>
                        </div>
                        <hr>
                        <div class="col-md-3">
                            <div class="form-group local-forms">
                                <label>Image <span class="login-danger">*</span></label>

                                <input required type="file" name="image" id="image" class="form-control photo"
                                    accept="image/*" data-default-file={{ asset($teacherData->image) }}>
                                <br>
                                <input required type="file" class="form-control photo" name="cv" accept="image/*"
                                    data-default-file={{ asset($teacherData->cv) }}>
                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <br>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $teacherData->name }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span></label>
                                        <select class="form-control" id="gender" name="gender"
                                            value="{{ old('gender') }}">
                                            <option selected disabled>Select Gender</option>
                                            <option value="male" {{ $teacherData->gender == 'male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="female" {{ $teacherData->gender == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other" {{ $teacherData->gender == 'other' ? 'selected' : '' }}>
                                                Other</option>
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
                                                    {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        {{-- <button type="button" class="btn btn-success" id="addclass">Add
                                            More Class</button> --}}
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
                                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        {{-- <button type="button" class="btn btn-success" id="addUser">Add
                                            More Section</button> --}}
                                        <input type="hidden" name="section_id" id="hiddensection" value="">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date Of Birth <span class="login-danger">*</span></label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="{{ $teacherData->dob }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Email <span class="login-danger"></span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $teacherData->email }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Phone Number <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" pattern="[1-9]{1}[0-9]{9}"
                                            id="number" name="number" value="{{ $teacherData->number }}">

                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $teacherData->address }}" required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Joinign Date <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" id="jd" name="jd"
                                            value="{{ $teacherData->jd }}"required>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Experience <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" id="exp" name="exp"
                                            value="{{ $teacherData->exp }}" required>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Qualification <span class="login-danger"></span></label>
                                        <input type="text" class="form-control" id="qual" name="qual"
                                            value="{{ $teacherData->qual }}" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    {{-- <h5 class="form-title"><span>Teacher Login Details</span></h5> --}}
                                </div>
                                {{-- <div class="col-md-3">
                                        <div class="form-group local-forms">
                                            <label>Image <span class="login-danger">*</span></label>
                                            <input type="file" class="form-control photo" name="images"
                                                accept="image/*">
                                        </div>

                                    </div> --}}
                                <div class="col-md-9">
                                    <div class="row">
                                        {{-- <div class="col-12 col-sm-4">
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
                                            </div> --}}
                                        <div class="col-3" id="selectedClassListContainer">
                                            <label for="">Selected Class</label>
                                            <li id=" ">

                                                {!! htmlspecialchars(str_replace(['"', "'", '\\', '[', ']'], '', $teacherData->class_id)) !!}
                                            </li>
                                        </div>
                                        <div class="col-3" id="selectedSubListContainer">
                                            <label for="">Selected Subject</label>
                                            <li id=" ">

                                                {!! htmlspecialchars(str_replace(['"', "'", '\\', '[', ']'], '', $teacherData->section->name)) !!}

                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <a href="{{ route('admin.teacher.teacherIndex') }}" class="btn btn-danger">Cancle</a>

                        </div>
                    </div>

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
@endsection
