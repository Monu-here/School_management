@extends('Admin.layout.app')
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Student Attendence</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Attendence</a></li>
                        <li class="breadcrumb-item active">All Attendence</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container">
        <table class="table">
            <tr>
                <thead>
                    <th>Student Roll No</th>
                    <th>Student Class</th>
                    <th>Student Name</th>
                    <th colspan="2">Attendence
                        <br>
                        <input type="checkbox" id="selectAll" class="p">
                        <label for="selectAll">Select</label>
                        <input type="checkbox" id="selectAlls" class="">
                        <label for="selectAlls">Unselect</label>
                    </th>
                </thead>
            </tr>
            <tr>
                <form action="{{ route('admin.atten.mark') }}" method="POST">
                    @csrf
                    @if ($students)
                        @foreach ($students as $student)
                            <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                            <tbody>

                                <td>
                                    {{ $student->roll }}
                                </td>
                                <td>
                                    {{ $student->classes->name }} /
                                    {{ $sections->where('id', $student->section_id)->pluck('name')->first() }}
                                </td>
                                <td>
                                    <img src="{{ asset($student->image) }}" class="card-img-top" alt="StudentImage"
                                        style="width: 25px"> {{ $student->name }}
                                </td>
                                <td>
                                    <div class="form-group">
                                         <input type="radio" class="p" id="present_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="P"> Present
                                        <input type="radio" id="absent_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="A"> Absent
                                        <input type="radio" id="leave_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="L"> Leave
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group" class="p">
                                         <input type="text" class="form-control" id="notes_{{ $student->id }}"
                                            name="notes[{{ $student->id }}]" placeholder="Enter notes" value="">
                                    </div>
                                </td>
                            </tbody>
                        @endforeach
                    @endif
                    <div class="form-group" style="display: flex; justify-content: end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </tr>
        </table>
    </div>
    <br><br>

    {{-- <div class="row">
        <div class="col-sm-12">
            <div class="card card-table comman-shadow">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Users</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="students.html" class="btn btn-outline-gray me-2 active"><i
                                        class="feather-list"></i></a>
                                <a href="students-grid.html" class="btn btn-outline-gray me-2"><i
                                        class="feather-grid"></i></a>
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                                <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped"
                            id="clienttable">
                            <thead class="student-thread">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" id="" value="something" />
                                        </div>
                                    </th>
                                    <th>Student Roll No</th>
                                    <th>Student Class</th>
                                    <th>Student Name</th>
                                    <th>Attendence
                                        <br>
                                        <input type="checkbox" id="selectAll" class="p form-check-input">
                                        <label for="selectAll">Select</label>
                                      </th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tr>
                                <form action="{{ route('admin.atten.mark') }}" method="POST">
                                    @csrf
                                    @if ($students)
                                        @foreach ($students as $student)
                                            <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                            <tbody>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox" value="something" />
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $student->roll }}
                                                </td>
                                                <td>
                                                    {{ $student->classes->name }} /
                                                    {{ $sections->where('id', $student->section_id)->pluck('name')->first() }}
                                                </td>
                                                <td>
                                                    <h2 class="table-avatar">

                                                        <a href="student-details.html" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset($student->image) }}" alt="" /></a>
                                                        <a href="student-details.html">{{ $student->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="radio" class="p form-check-input"
                                                            id="present_{{ $student->id }}"
                                                            name="attendance_types[{{ $student->id }}]" value="P">
                                                        Present
                                                        <input type="radio" id="absent_{{ $student->id }}"
                                                            name="attendance_types[{{ $student->id }}]" value="A" class="form-check-input">
                                                        Absent
                                                        <input type="radio" id="leave_{{ $student->id }}"
                                                            name="attendance_types[{{ $student->id }}]" value="L" class="form-check-input">
                                                        Leave
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group" class="p">
                                                        <input type="text" class="form-control"
                                                            id="notes_{{ $student->id }}"
                                                            name="notes[{{ $student->id }}]" placeholder="Enter notes"
                                                            value="">
                                                    </div>
                                                </td>
                                            </tbody>
                                        @endforeach
                                    @endif
                                    <div class="form-group" style="display: flex; justify-content: end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </tr>
                        </table>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var radioes = document.querySelectorAll('[class^="p"]');
            radioes.forEach(function(p) {
                p.checked = document.getElementById('selectAll').checked;

            });
        });
        document.getElementById('selectAlls').addEventListener('change', function() {
            var radioes = document.querySelectorAll('[class^="p"]');
            radioes.forEach(function(p) {
                p.checked = document.getElementById('selectAlls').checked = false;
            });
        });
        $(function() {
            $('#clienttable').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#clienttable_wrapper .col-md-6:eq(0)');
        });
        var st = {!! json_encode($student) !!}
    </script>
@endsection
