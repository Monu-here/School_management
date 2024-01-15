<!-- resources/views/Admin/marks/create.blade.php -->

@extends('Admin.layout.app')


@section('content')
    <div class="container">
        <h2>Create Mark</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.mark.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="student_id" class="form-label">Student</label>
                <select name="student_id" id="student_id" class="form-control">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subject_id" class="form-label">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="exam_id" class="form-label">Exam</label>
                <select name="exam_id" id="exam_id" class="form-control">
                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="class_id" class="form-label">Exam</label>
                <select name="class_id" id="class_id" class="form-control">
                    @foreach ($classes as $cl)
                        <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="mark" class="form-label">Mark</label>
                <input type="text" name="mark" class="form-control">
            </div>

            <div class="mb-3">
                <label for="grade_id" class="form-label">Grade</label>
                <select name="grade_id" id="grade_id" class="form-control">
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Additional Fields -->
            <!-- Include the calculated grade -->
            <div class="mb-3">
                <label for="calculated_grade" class="form-label">Calculated Grade</label>
                <input type="text" name="calculated_grade" class="form-control" disabled>
                <!-- The calculated grade will be displayed here -->
            </div>

            <button type="submit" class="btn btn-primary">Save Mark</button>
        </form>
    </div>

    <!-- JavaScript to calculate and display the grade -->
    <script>
        // Add an event listener to the 'mark' input
        document.getElementById('mark').addEventListener('input', function() {
            // Get the entered mark value
            var mark = parseInt(this.value);

            // Implement your logic to calculate the grade based on the entered mark
            // Replace this with your own logic based on the grading system
            var calculatedGrade;
            if (mark >= 90) {
                calculatedGrade = 'A';
            } else if (mark >= 80) {
                calculatedGrade = 'B';
            } else if (mark >= 70) {
                calculatedGrade = 'C';
            } else if (mark >= 60) {
                calculatedGrade = 'D';
            } else {
                calculatedGrade = 'F';
            }

            // Display the calculated grade in the 'calculated_grade' input
            document.getElementById('calculated_grade').value = calculatedGrade;
        });
    </script>
@endsection
