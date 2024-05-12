@extends('Admin.layout.app')

@section('linkbar')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Students</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Student</a></li>
                        <li class="breadcrumb-item active">All Students</li>
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
                        <form method="POST" action="{{ route('admin.atten.index') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-10 col-sm-6">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="class_id" style="font-weight: 700; font-size: 12px">
                                                    Class:</label>
                                                <select name="class_id" id="class_id" class="form-control" required>
                                                    <option value="">Select Class</option>
                                                    @foreach ($cc as $class)
                                                        <option value="{{ $class->id }}"
                                                            {{ isset($class_id) ? ($class_id == $class->id ? 'selected' : '') : (old('class') == $class->id ? 'selected' : '') }}>
                                                            {{ $class->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="section_id" style="font-weight: 700; font-size: 12px">
                                                    Section:</label>
                                                <select name="section_id" id="section_id" class="form-control" required>
                                                    <option value="">Select Section</option>

                                                    @foreach ($se as $sec)
                                                        <option value="{{ $sec->id }}"
                                                            {{ isset($section_id) ? ($section_id == $sec->id ? 'selected' : '') : (old('sec') == $sec->id ? 'selected' : '') }}>
                                                            {{ $sec->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Date" style="font-weight: 700; font-size: 12px">Date</label>
                                                <input type="date" name="attendance_date" class="form-control"
                                                    value="{{ isset($date) ? $date : date('Y-m-d') }}">
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="text-right mt-1">
                                        <button type="submit" class="btn btn-primary">Select</button>
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
            <script>
                toastr.error('No students found for the selected class and section.');
            </script>
        @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Students</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                                class="feather-list"></i></a>
                                        <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                                class="feather-grid"></i></a>
                                        <a href="#" class="btn btn-outline-primary me-2"><i
                                                class="fas fa-download"></i>
                                            Download</a>
                                        <a href="{{ route('admin.student.add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
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
                                            <th>ROll NO</th>
                                            <th>NAME</th>
                                            <th>ATTENDENCE</th>
                                            <th>NOTE</th>

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
                                                                        <span>Present</span>
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
                                                                    <div class="radio-style">
                                                                             <p>Present</p>
                                                                            <input type="radio"
                                                                                id="leave_{{ $student->id }}"
                                                                                name="attendance_types[{{ $student->id }}]"
                                                                                class="l" value="L">
                                                                            <label for="leave_{{ $student->id }}"
                                                                                class="label-class">
                                                                            </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group" class="p">
                                                                <input type="text" class="form-control"
                                                                    id="notes_{{ $student->id }}"
                                                                    name="notes[{{ $student->id }}]"
                                                                    placeholder="Enter notes" value="">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            <div class="form-group" style="display: flex; justify-content: end">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @include('Admin.Attendence.add') --}}
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
    </script>
@endsection
