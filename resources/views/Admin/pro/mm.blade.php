@extends('Admin.layout.app')

@section('content')
    <div class="container">
        <h2>Student List</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.promotion.promote') }}" method="POST">
            @csrf
            <input type="hidden" name="from_class" value="{{ $students->first()->class_id }}">
            <input type="hidden" name="from_section" value="{{ $students->first()->section }}">
            <input type="hidden" name="from_session" value="{{ $students->first()->session }}">
            <input type="hidden" name="to_session" value="YOUR_TO_SESSION_VALUE">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Promote</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class }}</td>
                            <td>{{ $student->section }}</td>
                            <td>
                                <input type="checkbox" name="student_id[]" value="{{ $student->id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Promote Selected Students</button>
        </form>
    </div>
@endsection
