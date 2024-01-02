@extends('Admin.layout.app')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/teacher.css') }}"> --}}
    <style>
        .red {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="mahi_holder">
        <div class="container">
            <form action="{{ route('admin.student.teacherShow', ['teacher' => $teacherData->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
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
                                <input class="effect-3" type="text" placeholder="Enter Date of Birth" name="dob"
                                    readonly value="{{$teacherData->dob}}">
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
                            <a href="{{route('admin.student.teacherIndex')}}" class="btn btn-danger">Cancle</a>
                        </div>

                        <!-- Hidden input field to store selected subjects -->
                        <input type="hidden" name="sub" id="hiddenSub" value="">
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('.photo').dropify();
        });

        // $(document).ready(function() {
        //     $('#addUser').on('click', function() {
        //         var selectedValue = $('#new option:selected').val();
        //         if (selectedValue) {
        //             $('#selectedSubList').append('<li>' + selectedValue + '</li>');
        //         }
        //     });
        // });
        // $(document).ready(function() {
        //     var selectedSubjects = [];

        //     $('#addUser').on('click', function() {
        //         var selectedValue = $('#new option:selected').val();
        //         if (selectedValue) {
        //             selectedSubjects.push(selectedValue);
        //             updateSelectedSubjectsList();
        //         }
        //     });

        //     function updateSelectedSubjectsList() {
        //         $('#selectedSubList').empty();
        //         selectedSubjects.forEach(function(subject) {
        //             $('#selectedSubList').append('<li>' + subject + '</li>');
        //         });

        //         // Update hidden input field with the array of subjects
        //         var cleanString = JSON.parse(JSON.stringify(selectedSubjects)).join(',');
        //         cleanString = cleanString.replace(/["'\\]/g,
        //             ''); // Remove double quotes, single quotes, and backslashes
        //         $('#hiddenSub').val(cleanString);
        //     }
        // });
    </script>
@endsection
