@extends('Admin.layout.app')
@section('linkbar')
    <div class="content container-fluid ">
        <div class="page-header">
            <div class="row">
                <div class="col ms-4">
                    <h3 class="page-title">Mark</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.mark.index') }}">Mark</a></li>
                        <li class="breadcrumb-item active">Create Mark</li>
                    </ul>
                </div>
            </div>
        </div>
    @endsection
    @section('css')
        <style>
            .drop {
                display: none;
            }
        </style>
    @endsection
    @section('content')
        <div class=" ">
            <h2 class="ms-3"> Create Mark</h2>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.mark.marks.students') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-2">
                                        <strong>Exam:</strong>
                                        <select name="exam_id" class="form-control">
                                            @foreach ($exams as $exam)
                                                <option value="{{ $exam->id }}"
                                                    {{ request('exam_id') == $exam->id ? 'selected' : '' }}>
                                                    {{ $exam->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Faculity:</strong>
                                        <select name="faculity_id" class="form-control">
                                            @foreach ($faculitys as $faculity)
                                                <option value="{{ $faculity->id }}"
                                                    {{ request('faculity_id') == $faculity->id ? 'selected' : '' }}>
                                                    {{ $faculity->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Semester:</strong>
                                        <select name="class_id" class="form-control">
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>Section:</strong>
                                        <select name="section_id" class="form-control">
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>Subject:</strong>
                                        <select name="subject_id" class="form-control">
                                            @foreach ($subjects as $subject)
                                                <option value="{{ $subject->id }}"
                                                    {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-3">
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Add Mark</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if (isset($students) && $students->count() > 0)
                    <div class="mt-4">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-center ">
                                <strong> Exam : </strong>
                                <span class="text-capitalize ms-2">
                                    {{ $selectedExam ? $selectedExam->name : 'All Exams' }}</span>
                            </div>
                            <div class="d-flex justify-content-center">
                                @php
                                    $session = getSetting();
                                    $i = 1;
                                @endphp
                                @if ($session)
                                    <strong>Session : </strong> <span class="ms-2">{{ $session->despc }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-center">

                                <strong> Subject: </strong> <span class="ms-2">
                                    {{ $selectedSubject ? $selectedSubject->name : 'All Subjects' }}</span>
                            </div>

                        </div>

                        <br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Symbol No</th>
                                    <th>Name</th>
                                    <th>Semester</th>
                                    <th>CR</th>
                                    <th>Exam Type</th>

                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('admin.mark.store') }}" method="POST">
                                    <div>
                                        @csrf
                                        @foreach ($students as $student)
                                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                            <input type="hidden" name="exam_id" value="{{ $selectedExam->id }}">
                                            <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $student->idno }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->classes->name }}</td>
                                                <td>
                                                    <input type="number" name="obtained_marks[{{ $student->id }}]"
                                                        class="form-control " style="width: 100px">
                                                </td>
                                                <td>
                                                    <select name="exam_type[{{ $student->id }}]" class="form-control"
                                                        onchange="showoption(this, {{ $student->id }})">
                                                        <option value="" selected disabled>Select</option>
                                                        <option value="resit">Resit</option>
                                                        <option value="repeat">Repeat</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="resit[{{ $student->id }}]"
                                                        class="form-control drop" style="width: 100px"
                                                        id="resit_{{ $student->id }}">
                                                </td>


                                            </tr>
                                        @endforeach
                                    </div>
                                    <div class="row d-flex justify-content-lg-end justify-content-center" >
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>No students found for the selected class and section.</p>
                @endif
            </div>
        </div>

    @endsection
    @section('js')
        <script>
            // function showoption(answer, studentId) {
            //     if (answer.value == 'resit') {
            //         document.getElementById('resit_' + studentId).classList.remove('drop');
            //         // document.getElementById('repeat_' + studentId).classList.add('drop');
            //     } else if (answer.value == 'repeat') {
            //         // document.getElementById('repeat_' + studentId).classList.remove('drop');
            //         document.getElementById('resit_' + studentId).classList.add('drop');
            //     } else {
            //         document.getElementById('resit_' + studentId).classList.add('drop');
            //         document.getElementById('xyx_' + studentId).classList.add('drop');
            //         // document.getElementById('repeat_' + studentId).classList.add('drop');
            //     }
            // }
        </script>
    @endsection
