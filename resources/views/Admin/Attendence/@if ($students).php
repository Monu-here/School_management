@extends('Admin.layout.app')
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
                                        {{-- <label for="attendance_type_{{ $student->id }}">Attendance Type:</label><br> --}}
                                        <input type="checkbox" class="p" id="present_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="P"> Present
                                        <input type="checkbox" id="absent_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="A"> Absent
                                        <input type="checkbox" id="leave_{{ $student->id }}"
                                            name="attendance_types[{{ $student->id }}]" value="L"> Leave
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group" class="p">
                                        {{-- <label for="notes_{{ $student->id }}">Notes:</label> --}}
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



    {{-- <form action="{{ route('admin.atten.mark') }}" method="POST">
        @csrf
        <div class="row">
            @if ($students)
                @foreach ($students as $student)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <img src="{{ asset($student->image) }}" class="card-img-top" alt="...">
                            <input type="text" name="student_ids[]" value="{{ $student->id }}">
                            <!-- Use [] to create an array -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $student->name }}</h5>
                                <p class="card-text">{{ $student->classes->name }}</p>
                                <p class="card-text">Section:
                                    {{ $sections->where('id', $student->section_id)->pluck('name')->first() }}</p>
                                <p class="card-text">Roll: {{ $student->roll }}</p>
                                <div class="form-group">
                                    <label for="attendance_type_{{ $student->id }}">Attendance Type:</label><br>
                                    <input type="checkbox" id="present_{{ $student->id }}"
                                        name="attendance_types[{{ $student->id }}]" value="P"> Present
                                    <input type="checkbox" id="absent_{{ $student->id }}"
                                        name="attendance_types[{{ $student->id }}]" value="A"> Absent
                                    <input type="checkbox" id="leave_{{ $student->id }}"
                                        name="attendance_types[{{ $student->id }}]" value="L"> Leave
                                </div>
                                <div class="form-group">
                                    <label for="notes_{{ $student->id }}">Notes:</label>
                                    <input type="text" class="form-control" id="notes_{{ $student->id }}"
                                        name="notes[{{ $student->id }}]" placeholder="Enter notes">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form> --}}
@endsection
@section('js')
    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('[class^="p"]');
            checkboxes.forEach(function(p) {
                p.checked = document.getElementById('selectAll').checked;
            });
        });

        document.getElementById('selectAlls').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('[class^="p"]');
            checkboxes.forEach(function(p) {
                p.checked = document.getElementById('selectAlls').checked = false;
            });
        });
    </script>
@endsection
