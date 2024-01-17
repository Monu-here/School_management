<!-- resources/views/Admin/mark/create.blade.php -->

@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <h2>Create Mark</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.mark.marks.students') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Exam:</strong>
                                    <select name="exam_id" class="form-control">
                                        @foreach ($exams as $exam)
                                            <option value="{{ $exam->id }}"
                                                {{ old('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <strong>Class:</strong>
                                    <select name="class_id" class="form-control">
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <strong>Section:</strong>
                                    <select name="section_id" class="form-control">
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <strong>Subject:</strong>
                                    <select name="subject_id" class="form-control">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 mt-3">
                            <button type="submit" class="btn btn-primary">Manage Mark</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (isset($students) && $students->count() > 0)
            <div class="mt-4">
                <h3>Students:</h3>
                <strong> Exam: </strong>{{ $selectedExam ? $selectedExam->name : 'All Exams' }}
                @php
                    $session = getSetting();
                    $i = 1;

                @endphp
                @if ($session)
                    {{ $session->despc }}
                @endif
                <br>
                <strong> Subject: </strong>{{ $selectedSubject ? $selectedSubject->name : 'All Subjects' }}
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sn</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Obtained Mark</th>
                            <th>Practical Marks</th>
                            <th>Total Marks</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('admin.mark.store') }}" method="POST">
                            @csrf
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $student->id }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->classes->name }}</td>
                                    <td>{{ $student->section_id }}</td>
                                    <td>
                                        <input type="text" name="obtained_marks[{{ $student->id }}]"
                                            class="form-control" oninput="calculateTotalMarks({{ $student->id }})">
                                    </td>
                                    <td>
                                        <input type="text" name="practical_marks[{{ $student->id }}]"
                                            class="form-control" oninput="calculateTotalMarks({{ $student->id }})">

                                    </td>
                                    <td>
                                        <!-- Display the total marks -->
                                        <span id="total_marks_{{ $student->id }}"></span>
                                    </td>
                                    <td>
                                       {{$grade->name}}
                                     </td>

                                    <td>
                                        <!-- Hidden inputs for student-related information -->
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <input type="hidden" name="exam_id" value="{{ $selectedExam->id }}">
                                        <input type="hidden" name="subject_id" value="{{ $selectedSubject->id }}">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
        @else
            <p>No students found for the selected class and section.</p>
        @endif
    </div>
@endsection
@section('js')
<script>
    // Calculate and display the total marks for a given student
    function calculateTotalMarks(studentId) {
        var obtainedMarks = parseFloat(document.getElementsByName("obtained_marks[" + studentId + "]")[0].value) || 0;
        var practicalMarks = parseFloat(document.getElementsByName("practical_marks[" + studentId + "]")[0].value) || 0;
        var totalMarks = obtainedMarks + practicalMarks;

        // Display total marks
        document.getElementById("total_marks_" + studentId).textContent = totalMarks;
    }
</script>

@endsection
