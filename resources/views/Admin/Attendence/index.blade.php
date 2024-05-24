@extends('Admin.layout.app')

@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students Attendence</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Attendence</a></li>
                        <li class="breadcrumb-item active">All Students Attendence</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .content {
            padding: 1.25rem 1.25rem;
            flex-grow: 1;
        }
    </style>
    <style>
        .present-abbr {
            border: 2px solid blue;
            /* Default border color for present */
        }

        .absent-abbr {
            border: 2px solid red;
            /* Default border color for absent */
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title font-weight-bold">Select Class And Section For Attendence</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('admin.atten.index') }}" id="formSubmit">
                            @csrf
                            <div class="row">
                                <div class="col-md-10 col-sm-6">
                                    @role('SuperAdmin')
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                        Faculity:</label>
                                                    <select name="faculity_id" id="faculity_id" class="form-control" required>
                                                        <option value="">Select Faculity</option>
                                                        @foreach ($facts as $fact)
                                                            <option value="{{ $fact->id }}"
                                                                {{ isset($faculity_id) ? ($faculity_id == $fact->id ? 'selected' : '') : (request('faculity_id') == $fact->id ? 'selected' : '') }}>
                                                                {{ $fact->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                        Semester:</label>
                                                    <select name="class_id" id="class_id" class="form-control" required>
                                                        <option value="">Select Semester</option>
                                                        @foreach ($cc as $class)
                                                            <option value="{{ $class->id }}"
                                                                {{ isset($class_id) ? ($class_id == $class->id ? 'selected' : '') : (request('class_id') == $class->id ? 'selected' : '') }}>
                                                                {{ $class->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="section_id" style="font-weight: 700; font-size: 12px">
                                                        Section:</label>
                                                    <select name="section_id" id="section_id" class="form-control" required>
                                                        <option value="">Select Section</option>

                                                        @foreach ($se as $sec)
                                                            <option value="{{ $sec->id }}"
                                                                {{ isset($section_id) ? ($section_id == $sec->id ? 'selected' : '') : (request('section_id') == $sec->id ? 'selected' : '') }}>
                                                                {{ $sec->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="Date" style="font-weight: 700; font-size: 12px">Date</label>
                                                    <input type="date" name="attendance_date" class="form-control"
                                                        value="{{ isset($date) ? $date : date('Y-m-d') }}">
                                                </div>

                                            </div>
                                        </div>
                                    @endrole()
                                    @role('Teacher')
                                        @php

                                            $user = Auth::user();
                                            $teacher = $user->teacher;
                                            $assignedClassIds = explode(',', $teacher->class_id);
                                            $assignedFaculityIds = explode(',', $teacher->faculity_id);
                                            $assignedSectionIds = explode(',', $teacher->section_id);
                                            $assignedClassIds = array_map('intval', $assignedClassIds);
                                            $assignedSectionIds = array_map('intval', $assignedSectionIds);
                                            $assignedFaculityIds = array_map('intval', $assignedFaculityIds);
                                            @endphp
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                        Faculity:</label>
                                                    <select name="faculity_id" id="faculity_id" class="form-control" required>
                                                        <option value="">Select Faculity</option>
                                                        @foreach ($assignedFaculityIds as $factId)
                                                        @php
                                                        $fact = App\Models\Faculity::find($factId);
                                                    @endphp
                                                            <option value="{{ $factId}}"
                                                                {{ isset($faculity_id) ? ($faculity_id == $factId ? 'selected' : '') : (request('faculity_id') == $factId? 'selected' : '') }}>
                                                                {{ $fact ? $fact->name : 'Faculity Not Found' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                        Semester:</label>
                                                    <select name="class_id" id="class_id" class="form-control" required>
                                                        <option value="">Select Semester</option>
                                                        @foreach ($assignedClassIds as $classId)
                                                            @php
                                                                $class = App\Models\Classs::find($classId);
                                                            @endphp
                                                            <option value="{{ $classId }}"
                                                                {{ isset($class_id) ? ($class_id == $classId ? 'selected' : '') : (request('class_id') == $classId ? 'selected' : '') }}>
                                                                {{ $class ? $class->name : 'Semester Name Not Found' }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="section_id" style="font-weight: 700; font-size: 12px">
                                                        Section:</label>
                                                    <select name="section_id" id="section_id" class="form-control" required>
                                                        <option value="">Select Section</option>

                                                        @foreach ($assignedSectionIds as $sectionId)
                                                            @php
                                                                $section = App\Models\Section::find($sectionId);
                                                            @endphp
                                                            <option value="{{ $sectionId }}"
                                                                {{ isset($section_id) ? ($section_id == $sectionId ? 'selected' : '') : (request('section_id') == $sectionId ? 'selected' : '') }}>
                                                                {{ $section ? $section->name : ' Section Not found' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="Date" style="font-weight: 700; font-size: 12px">Date</label>
                                                    <input type="date" name="attendance_date" class="form-control"
                                                        value="{{ isset($date) ? $date : date('Y-m-d') }}">
                                                </div>

                                            </div>
                                        </div>
                                    @endrole()
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="text-right mt-2">
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Select</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    @if ($students !== null)
        @if ($students->isEmpty())
             
        @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Students Attendence</h3>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <p class=" rounded-circle"
                                            style="width: 20px; height: 20px;background-color: blue;"></p><span>: -
                                            Present</span>
                                        <p class=" rounded-circle"
                                            style="width: 20px; height: 20px;background-color: rgb(255, 0, 0);"></p><span>:
                                            - Absent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                                id="clienttable">
                                <tr>
                                    <thead class="student-thread">
                                        <th>ID</th>
                                        <th>SYMBOOL NO</th>
                                        <th>NAME</th>
                                        <th>ATTENDENCE</th>

                                    </thead>
                                </tr>
                                <tbody>
                                    <form action="{{ route('admin.atten.mark') }}" method="POST">
                                        @csrf
                                        @if ($students)
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($students as $student)
                                                <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                                <input type="hidden" name="class_id[]" value="{{ $student->class_id }}">
                                                <input type="hidden" name="faculity_id[]" value="{{ $student->faculity_id }}">
                                                <input type="hidden" name="section_id[]" value="{{ $student->section_id }}">
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        {{ $student->roll }}

                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="" class="avatar avatar-sm me-2"><img
                                                                    class="avatar-img rounded-circle"
                                                                    src="{{ asset($student->image) }}"
                                                                    alt="User Image" /></a>
                                                            <a href="">{{ $student->name }}</a>
                                                        </h2>

                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="radio-button">

                                                                <div class="radio-style">

                                                                    <abbr title="Present">
                                                                        <input type="radio" class="p"
                                                                            id="present_{{ $student->id }}"
                                                                            name="attendance_types[{{ $student->id }}]"
                                                                            value="P">
                                                                        <label for="present_{{ $student->id }}"
                                                                            class="label-class">

                                                                        </label>
                                                                    </abbr>
                                                                </div>
                                                                <div class="radio-style">
                                                                    <abbr title="Absent">
                                                                        <input type="radio"
                                                                            id="absent_{{ $student->id }}"
                                                                            name="attendance_types[{{ $student->id }}]"
                                                                            class="a" value="A">
                                                                        <label for="absent_{{ $student->id }}"
                                                                            class="label-class">

                                                                        </label>
                                                                    </abbr>


                                                                </div>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <div class="form-group" style="display: flex; justify-content: end">
                                            <button type="submit" class="btn btn-primary"
                                                onclick="atten()">Submit</button>
                                        </div>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endif
    @endif
@endsection
@section('js')
    <script>
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            var saveBtn = document.getElementById('saveBtn');
            saveBtn.disabled = true;
            saveBtn.innerHTML = 'Please wait...';
            setTimeout(function() {
                event.target.submit();
            }, 2000);
        });

        const atten = (msg = "would you like submit today attendence") => {
            return prompt(msg) == 'yes';
        }
    </script>
@endsection
