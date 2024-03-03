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
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
@endsection
@section('content')

    <div class="container">
        <table class="table table-responsive ">
            <tr>
                <thead>
                    <th>Student Roll No</th>
                    {{-- <th>Student Class</th> --}}
                    <th>Student Name</th>
                    <th>
                        Attendence
                        <br>
                        <div class="form-group">
                            <div>

                                <div class="checkbox-button">
                                    <div class="checkbox-style">
                                        {{-- <p class="" style="font-size: 12px">Absent</p> --}}
                                        <input type="checkbox" id="selectAll" class="p">
                                        <label for="selectAll" class="checkbox-label-class">
                                        </label>
                                        {{-- <span>Present</span> --}}
                                    </div>

                                    <div class="radio-style">
                                        <input type="checkbox" id="allAbsent" class="a">
                                        <label for="allAbsent" class="checkbox-label-class"></label>
                                    </div>
                                    <div class="radio-style">
                                        <input type="checkbox" id="allLeave" class="l">
                                        <label for="allLeave" class="checkbox-label-class"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                    <th>Note</th>
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
                                {{-- <td>
                                    {{ $student->classes->name }} /
                                    {{ $sections->where('id', $student->section_id)->pluck('name')->first() }}
                                </td> --}}
                                <td>
                                    <img src="{{ asset($student->image) }}" class="card-img-top" alt="StudentImage"
                                        style="width: 25px"> {{ $student->name }}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="radio-button">
                                            <div class="radio-style">
                                                <input type="radio" class="p" id="present_{{ $student->id }}"
                                                    name="attendance_types[{{ $student->id }}]" value="P">
                                                <label for="present_{{ $student->id }}" class="label-class">

                                                </label>
                                            </div>
                                            <div class="radio-style">
                                                <input type="radio" id="absent_{{ $student->id }}"
                                                    name="attendance_types[{{ $student->id }}]" class="a"
                                                    value="A">
                                                <label for="absent_{{ $student->id }}" class="label-class">

                                                </label>

                                            </div>
                                            <div class="radio-style">
                                                <input type="radio" id="leave_{{ $student->id }}"
                                                    name="attendance_types[{{ $student->id }}]" class="l"
                                                    value="L">
                                                <label for="leave_{{ $student->id }}" class="label-class">
                                                </label>


                                            </div>
                                        </div>
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

@endsection
@section('js')
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var radioes = document.querySelectorAll('[class^="p"]');
            radioes.forEach(function(p) {
                p.checked = document.getElementById('selectAll').checked;

            });
        });
        document.getElementById('allAbsent').addEventListener('change', function() {
            var radioes = document.querySelectorAll('[class^="a"]');
            radioes.forEach(function(a) {
                a.checked = document.getElementById('allAbsent').checked;

            });
        });
        document.getElementById('allLeave').addEventListener('change', function() {
            var radioes = document.querySelectorAll('[class^="l"]');
            radioes.forEach(function(l) {
                l.checked = document.getElementById('allLeave').checked;

            });
        });
        // document.getElementById('selectAlls').addEventListener('change', function() {
        //     var radioes = document.querySelectorAll('[class^="a"]');
        //     radioes.forEach(function(a) {
        //         a.checked = document.getElementById('selectAlls').checked = false;
        //     });
        // });
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
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
@endsection
