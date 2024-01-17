<!-- resources/views/marks/index.blade.php -->

@extends('Admin.layout.app')

@section('content')
    <h2>Marks</h2>

    <a href="{{ route('admin.mark.add') }}" class="btn btn-primary">Add New Mark</a>
    <table class="table">
        <thead>
            <tr>
                <th>Exam</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Mark Obtained</th>
                <th>Practical Obtained</th>
                <th>Total Mark</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($marks as $mark)
                <tr>
                    <td>{{$mark->exam_id}}</td>
                    <td>{{$mark->student_id}}</td>
                    <td>{{$mark->subject_id}}</td>
                    <td>{{$mark->obtained_marks}}</td>
                    <td>{{$mark->practical_marks}}</td>
                    <td>{{$mark->total_marks}}</td>
                    <td>{{$mark->grade}}</td>
                    {{-- <td>{{$mark->grade}}</td> --}}
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
